<?php

namespace App\Livewire;

use Livewire\Component;

class Channel extends Component
{
    public function render()
    {
        return view('livewire.channel')->extends('layouts.app');
    }
}
