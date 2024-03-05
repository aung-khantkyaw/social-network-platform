<?php

namespace App\Livewire;

use Livewire\Component;

class Squads extends Component
{
    public function render()
    {
        return view('livewire.squads')->extends('layouts.app');;
    }
}
