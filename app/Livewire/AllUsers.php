<?php

namespace App\Livewire;

use Livewire\Component;

class AllUsers extends Component
{
    public function render()
    {
        return view('livewire.all-users')->extends('layouts.app');
    }
}
