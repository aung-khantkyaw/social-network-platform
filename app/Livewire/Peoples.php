<?php

namespace App\Livewire;

use Livewire\Component;

class Peoples extends Component
{
    public function render()
    {
        return view('livewire.peoples')->extends('layouts.app');
    }
}