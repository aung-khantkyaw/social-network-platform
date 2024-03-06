<?php

namespace App\Livewire\Components;

use App\Models\Notification;
use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\PostMedia;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;
    public $title;
    public $content;
    public $thumbnail;
    public function render()
    {
        return view('livewire.components.create-post')->extends('layouts.app');
    }

    public function createpost(Request $request)
    {
        function wrapInputWithDiv($input)
        {
            return "<div class='text-gray-700 dark:text-gray-100'>{$input}</div>";
        }

        $request->validate([
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

            // check post content has [abc, def, ghi] and then notification to admin
            $checkContent = ['abc', 'def', 'ghi'];
            foreach ($checkContent as $content) {
                if (strpos($request->content, $content) !== false) {
                    // send notification to admin
                    Notification::create([
                        "type" => "Admin Notification",
                        "user_id" => 8,
                        "message" =>  auth()->user()->username . " Post created with " . $content,
                        "url" => "/post/" . $post->uuid
                    ]);
                }
            }
            DB::commit();
            session()->flash('success', 'Post created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }



        unset($this->title);
        unset($this->content);
        unset($this->thumbnail);

        session()->flash('message', 'Post created successfully.');

        return redirect()->route('create-post');
    }
}
