<?php

namespace App\Livewire;

use Livewire\Component;

class PostEdit extends Component
{
    public function render()
    {
        return view('livewire.post-edit')->extends('layouts.app');
    }
}
