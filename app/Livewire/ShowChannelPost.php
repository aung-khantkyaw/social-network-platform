<?php

namespace App\Livewire;

use Livewire\Component;

class ShowChannelPost extends Component
{
    public function render()
    {
        return view('livewire.show-channel-post')->extends('layouts.app');
    }
}
