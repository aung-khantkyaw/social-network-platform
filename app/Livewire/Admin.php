<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;

class Admin extends Component
{
    public function render()
    {
        return view('livewire.admin')->extends('layouts.app');
    }
}
