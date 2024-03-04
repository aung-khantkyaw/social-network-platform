<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\SavedPost;

class SavedPostController extends Component
{

    public function render()
    {
        return view('livewire.saved-post')->extends('layouts.app');
    }

    public function savePost($post_id)
    {
        DB::beginTransaction();
        try {
            $save = SavedPost::firstOrCreate(["post_id" => $post_id, "user_id" => auth()->id()]);
            Notification::create([
                "type" => "Save Post",
                "user_id" => $save->post->user_id,
                "message" => auth()->user()->username . " saved your post",
                "url" => "/post/" . $save->post->uuid
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        session()->flash('message', 'Save post successfully.');
        return redirect()->back();
    }

    public function unsavePost($post_id)
    {
        DB::beginTransaction();
        try {
            $save = SavedPost::where(["post_id" => $post_id, "user_id" => auth()->id()])->first();
            $save->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        session()->flash('message', 'Unsave Post successfully.');
        return redirect()->back();
    }
}
