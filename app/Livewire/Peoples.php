<?php

namespace App\Livewire;

use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Peoples extends Component
{
    public function render()
    {
        return view('livewire.peoples')->extends('layouts.app');
    }

    // Add friend
    public function addFriend($id)
    {
        $user = User::findOrFail($id);
        DB::beginTransaction();
        try {
            Friend::create([
                'user_id' => auth()->user()->id,
                'friend_id' => $id,
            ]);
            Notification::create([
                "type" => "Friend Request",
                "user_id" => $id,
                "message" => auth()->user()->username . " sent you a friend request",
                "url" => "/friends"
            ]);
            DB::commit();
            session()->flash('success', 'Friend request sent to ' . $user->username);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }
        return redirect()->back();
    }

    // Cancle friend request
    public function cancleFriend($id)
    {
        $user = User::findOrFail($id);
        DB::beginTransaction();
        try {
            Friend::where([
                'user_id' => auth()->user()->id,
                'friend_id' => $id,
            ])->first()->delete();
            DB::commit();
            session()->flash('success', 'Cancle Friend request sent to ' . $user->username);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }
        return redirect()->back();
    }

    // Accept friend request
    public function acceptFriend($id)
    {
        $user = User::where('id', $id)->first();
        DB::beginTransaction();
        try {
            $req = Friend::where([
                'user_id' => $id,
                'friend_id' => auth()->id(),
            ])->first();
            $req->accepted_at = now();
            $req->status = "accepted";
            $req->save();
            Notification::create([
                "type" => "Friend Request Accepted",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " accepted your friend request",
                "url" => "/friends"
            ]);
            DB::commit();
            session()->flash('success', 'Accept Friend request From ' . $user->username);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }
        return redirect()->back();
    }

    // Reject friend request
    public function rejectFriend($id)
    {
        $user = User::where('id', $id)->first();
        DB::beginTransaction();
        try {
            $req = Friend::where([
                'user_id' => $id,
                'friend_id' => auth()->id(),
            ])->first();
            $req->status = "rejected";
            $req->save();
            DB::commit();
            session()->flash('success', 'Reject Friend request From ' . $user->username);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }
        return redirect()->back();
    }

    // Unfriend
    public function unFriend($id)
    {
        $user = User::findOrFail($id);
        $friendship1 = Friend::where('user_id', auth()->user()->id)->where('friend_id', $id)->first();
        $friendship2 = Friend::where('user_id', $id)->where('friend_id', auth()->user()->id)->first();

        if ($friendship1) {
            $friendship1->delete();
        }

        if ($friendship2) {
            $friendship2->delete();
        }

        session()->flash('success', 'You have successfully unfriend ' . $user->username);
        return redirect()->back();
    }
}
