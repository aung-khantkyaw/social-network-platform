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
                "type" => "friend_request",
                "user_id" => $id,
                "message" => auth()->user()->name . " sent you a friend request",
                "url" => "/friends"
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            session()->flash('error', 'Something went wrong');
        }
        session()->flash('friend_request', 'Friend request sent to ' . $user->username);
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
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            session()->flash('error', 'Something went wrong');
        }
        session()->flash('friend_request', 'Cancle Friend request sent to ' . $user->username);
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
                "type" => "friend_accepted",
                "user_id" => $user->id,
                "message" => auth()->user()->name . " accepted your friend request",
                "url" => "#"
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            session()->flash('error', 'Something went wrong');
        }
        session()->flash('friend_request', 'Accept Friend request From ' . $user->username);
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
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            session()->flash('error', 'Something went wrong');
        }
        session()->flash('friend_request', 'Reject Friend request From ' . $user->username);
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

        session()->flash('friend_request', 'Unfriend ' . $user->username);
        return redirect()->back();
    }
}
