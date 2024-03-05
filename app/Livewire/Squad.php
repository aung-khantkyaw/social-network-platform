<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Share;

class Squad extends Component
{
    public function render()
    {
        return view('livewire.squad')->extends('layouts.app');;
    }

    public function joinSquad($id)
    {
        $group = Group::findOrFail($id);
        DB::beginTransaction();
        try {
            GroupMember::create([
                'group_id' => $id,
                'user_id' => auth()->id()
            ]);
            $group->update([
                'members' => $group->members + 1
            ]);
            Notification::create([
                "type" => "Joined Channel",
                "user_id" => $group->user_id,
                "message" => auth()->user()->username . " joined your squad",
                "url" => "/squad/" . $group->uuid
            ]);
            DB::commit();
            session()->flash('success', 'You have successfully joined the squad');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $th;
        }
        return redirect()->back();
    }

    public function leaveSquad($id)
    {
        $group = Group::findOrFail($id);
        DB::beginTransaction();
        try {
            GroupMember::where('group_id', $id)->where('user_id', auth()->id())->delete();
            $group->update([
                'members' => $group->members - 1
            ]);
            Notification::create([
                "type" => "Left Channel",
                "user_id" => $group->user_id,
                "message" => auth()->user()->username . " left your squad",
                "url" => "/squad/" . $group->uuid
            ]);
            DB::commit();
            session()->flash('success', 'You have successfully left the squad');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $th;
        }
        return redirect()->back();
    }

    public function deleteSquad($id)
    {

        $squad = Group::findOrFail($id);
        $posts = Post::where('group_id', $id)->get();
        $members = GroupMember::where('group_id', $id)->get();
        DB::beginTransaction();
        try {
            foreach ($posts as $post) {
                $comments = Comment::where('post_id', $post->id)->get();
                $upvotes = Like::where('post_id', $post->id)->get();
                $share = Share::where('post_id', $post->id)->get();
                foreach ($comments as $comment) {
                    $comment->delete();
                }
                foreach ($upvotes as $upvote) {
                    $upvote->delete();
                }
                foreach ($share as $sh) {
                    $sh->delete();
                }
                $post->delete();
            }
            foreach ($members as $member) {
                $member->delete();
            }
            $squad->delete();
            DB::commit();
            session()->flash('success', 'You have successfully deleted the squad');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $th;
        }
        return redirect()->to('/my-squads');
    }
}
