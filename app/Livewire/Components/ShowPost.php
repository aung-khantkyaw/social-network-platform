<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;


class ShowPost extends Component
{


    public function render()
    {
        return view('livewire.components.show-post')->extends('layouts.app');
    }

    // public function show(Post $post)
    // {
    //     return view('livewire.components.show-post', compact('post'))->extends('layouts.app');
    // }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class)->where('status', 'published');
    // }

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
}