<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\Group;
use App\Models\User;
use App\Models\Notification;

class CreateSquadPost extends Component
{
    public function render()
    {
        return view('livewire.create-squad-post')->extends('layouts.app');
    }

    public function createPost(Request $request)
    {

        $group = Group::findOrFail($request->group_id);
        $user = User::findOrFail($group->user_id);
        // create post
        function wrapInputWithDiv($input)
        {
            return "<div class='text-gray-700 dark:text-gray-100'>{$input}</div>";
        }

        $request->validate([
            'group_id' => ['required', 'string'],
            'thumbnail' => ['required', 'image', 'mimes:svg,png,jpeg,jpg,gif', 'max:5120'],
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
        ]);

        DB::beginTransaction();
        try {

            $thumbnail = time() . '.' . $request->thumbnail->extension();
            $path = public_path('images/thumbnails');
            $request->thumbnail->move($path, $thumbnail);

            $post = Post::create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'is_group_post' => 1,
                'group_id' => $request->group_id,
                'content' => wrapInputWithDiv($request->content),
                'title' => $request->title,
                'thumbnail' => $thumbnail,
            ]);

            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $path = public_path('images/posts');
                    $image->move($path, $imageName);
                    $images[] = $imageName;
                }
                PostMedia::create([
                    'post_id' => $post->id,
                    'file_type' => 'image',
                    'file' => json_encode($images),
                    'position' => "general",
                ]);
            }

            Notification::create([
                "type" => "New Post",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " created a new post in your squad",
                "url" => "/squad/" . $group->uuid
            ]);
            session()->flash('success', 'Post created successfully.');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }



        unset($this->title);
        unset($this->content);
        unset($this->thumbnail);
        return redirect()->back();
    }
}
