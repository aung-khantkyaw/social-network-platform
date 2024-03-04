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
            $page->update([
                'members' => $page->members + 1
            ]);
            Notification::create([
                "type" => "Follow Channel",
                "user_id" => $page->user_id,
                "message" => auth()->user()->username . " followed your channel",
                "url" => "/channel/" . $page->uuid
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->back();
    }

    public function unfollowChannel($id)
    {
        $page = Page::findOrFail($id);
        DB::beginTransaction();
        try {
            PageLike::where('page_id', $id)->where('user_id', auth()->id())->delete();
            $page->update([
                'members' => $page->members - 1
            ]);
            // Notification::where('user_id', $page->user_id)->where('type', 'follow')->where('message', auth()->user()->name . ' followed your channel')->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->back();
    }
}
