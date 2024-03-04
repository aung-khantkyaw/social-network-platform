<?php

namespace App\Livewire;

use Livewire\Component;

class MyChannels extends Component
{
    public function render()
    {
        return view('livewire.my-channels')->extends('layouts.app');
    }
}
