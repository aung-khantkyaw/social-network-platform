<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.profile')->extends('layouts.app');
    }

    public function deleteProfile()
    {
        $user = auth()->user();
        User::where('uuid', $user->uuid)->delete();
        return redirect()->route('home');
    }
}
