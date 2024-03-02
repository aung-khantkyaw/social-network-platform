<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\like;
use Illuminate\Support\Facades\DB;

class Home extends Component
{

    public function like($id)
    {
        DB::beginTransaction();
        try {
            Like::firstOrCreate(["post_id" => $id, "user_id" => auth()->id()]);
            $post = Post::findOrFail($id);
            $post->likes += 1;
            $post->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->back();
    }

    public function dislike($id)
    {
        DB::beginTransaction();
        try {
            $like = Like::where(["post_id" => $id, "user_id" => auth()->id()])->first();
            $like->delete();
            $post = Post::findOrFail($id);
            $post->likes -= 1;
            $post->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.home', ['posts' => Post::with("user")->latest()->paginate(10)])->extends('layouts.app');
    }
}
