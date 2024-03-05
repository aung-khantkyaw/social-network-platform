<?php

namespace App\Livewire;

use Livewire\Component;

class MySquad extends Component
{
    public function render()
    {
        return view('livewire.my-squad')->extends('layouts.app');;
    }
}
