<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\Page;
use Illuminate\Support\Str;

class CreateChannel extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $type;
    public $icon;
    public $thumbnail;
    public $location;
    public function render()
    {
        return view('livewire.create-channel')->extends('layouts.app');
    }

    public function createChannel(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3', 'max:255'],
            'type' => ['required', 'min:3', 'max:255'],
            'icon' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'location' => ['required', 'min:3', 'max:255'],
        ]);



        DB::beginTransaction();
        try {
            $icon = time() . '.' . $request->icon->extension();
            $path = public_path('images/pages');
            $request->icon->move($path, $icon);

            $thumbnail = time() . '.' . $request->thumbnail->extension();
            $path = public_path('images/pages/thumbnails');
            $request->thumbnail->move($path, $thumbnail);

            Page::create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'icon' => $icon,
                'thumbnail' => $thumbnail,
                'description' => $request->description,
                'name' => $request->name,
                'location' => $request->location,
                'type' => $request->type,
            ]);
            session()->flash('success', 'Channel created successfully.');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }
        return redirect()->route('channels');
    }
}
