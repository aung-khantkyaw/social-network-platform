<?php

namespace App\Livewire;

use Livewire\Component;

class Channels extends Component
{
    public function render()
    {
        return view('livewire.channels')->extends('layouts.app');
    }
}
