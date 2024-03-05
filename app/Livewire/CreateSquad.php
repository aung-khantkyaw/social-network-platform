<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Group;


class CreateSquad extends Component
{
    public function render()
    {
        return view('livewire.create-squad')->extends('layouts.app');;
    }

    public function createSquad(Request $request)
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
            $path = public_path('images/squads');
            $request->icon->move($path, $icon);

            $thumbnail = time() . '.' . $request->thumbnail->extension();
            $path = public_path('images/squads/thumbnails');
            $request->thumbnail->move($path, $thumbnail);

            Group::create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'icon' => $icon,
                'thumbnail' => $thumbnail,
                'description' => $request->description,
                'name' => $request->name,
                'location' => $request->location,
                'type' => $request->type,
            ]);
            session()->flash('success', 'Squad created successfully.');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }
        return redirect()->route('my-squads');
    }
}
