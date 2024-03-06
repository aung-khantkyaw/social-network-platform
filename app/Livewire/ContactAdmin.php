<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ContactAdmin extends Component
{
    public function render()
    {
        return view('livewire.contact-admin')->extends('layouts.guest');
    }

    public function contact($userid)
    {
        return redirect()->route('contact-admin');
    }
}
