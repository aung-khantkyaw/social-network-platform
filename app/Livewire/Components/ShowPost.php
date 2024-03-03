<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ShowPost extends Component
{


    public function render()
    {
        return view('livewire.components.show-post')->extends('layouts.app');
    }

    public function saveComment($post_id, Request $request)
    {
        $request->validate([
            "comment" => "required|string"
        ]);
        DB::beginTransaction();
        try {
            Comment::firstOrCreate([
                "post_id" => $post_id,
                "comment" => $request->comment,
                "user_id" => auth()->id()
            ]);
            $post = Post::findOrFail($post_id);
            $post->comments += 1;
            $post->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        unset($this->comment);

        return redirect()->back();
    }

    public function deletePost($post_id)
    {
        // search post by uuid
        $post = Post::where('uuid', $post_id)->first();
        // delete post
        $post->delete();
        return redirect()->route('profile.show', Auth::user()->username);
    }
}
