<?php

namespace App\Livewire;

use Livewire\Component;

class ShowSquadPost extends Component
{
    public function render()
    {
        return view('livewire.show-squad-post')->extends('layouts.app');;
    }
}
