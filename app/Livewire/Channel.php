<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;
use App\Models\Page;
use App\Models\PageLike;
use Illuminate\Support\Facades\DB;

class Channel extends Component
{
    public function render()
    {
        return view('livewire.channel')->extends('layouts.app');
    }

    public function followChannel($id)
    {
        $page = Page::findOrFail($id);
        DB::beginTransaction();
        try {
            PageLike::create([
                'page_id' => $id,
                'user_id' => auth()->id()
            ]);
            Notification::create([
                'user_id' => $page->user_id,
                'type' => 'follow',
                'message' => auth()->user()->name . ' followed your channel',
                'url' => '#'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->back();
    }
}
