<?php

namespace App\Livewire;

use App\Models\Notification as ModelsNotification;
use Livewire\Component;


class Notification extends Component
{
    public function render()
    {
        return view('livewire.notification')->extends('layouts.app');
    }

    public function markAsRead($id)
    {
        $notification = ModelsNotification::find($id);
        $notification->update(['read_at' => now()]);
        return redirect()->route('notification');
    }

    public function markAllAsRead()
    {
        ModelsNotification::where('user_id', auth()->id())->update(['read_at' => now()]);
        return redirect()->route('notification');
    }
}
