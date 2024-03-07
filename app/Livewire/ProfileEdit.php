<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class ProfileEdit extends Component
{
    public function render()
    {
        return view('livewire.profile-edit')->extends('layouts.app');
    }

    public function profileEdit(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $sender = User::where('username', $request->partner)->first();

        DB::beginTransaction();
        try {
            $this->updateUser($user, $request);
            if ($request->relationship != 'single') {
                $this->updateRelationship($user, $sender, $request);
            }
            DB::commit();
            session()->flash('success', 'Your profile has been updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }

        $this->updateProfilePicture($user, $request);
        $this->updateThumbnail($user, $request);

        return redirect()->route('profile.show', Auth::user()->username);
    }

    private function updateUser(User $user, Request $request)
    {
        $partner = ($request->relationship == 'single') ? null : $request->partner;

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'description' => $request->description,
            'school' => $request->school,
            'college' => $request->college,
            'university' => $request->university,
            'relationship' => $request->relationship,
            'partner' => $partner,
            'work' => $request->work,
            'address' => $request->address,
            'website' => $request->website,
        ]);
    }

    private function updateRelationship(User $user, User $sender, Request $request)
    {
        if ($request->relationship != 'Single') {
            if ($request->partner != $user->partner) {
                $sender->update([
                    'relationship' => $request->relationship,
                    'partner' => $user->username
                ]);
                Notification::create([
                    "type" =>  "Relationship Status",
                    "user_id" => $sender->id,
                    "message" => auth()->user()->username . " is now in a relationship with " . $request->partner,
                    "url" => '/profile/' . $request->partner . '/edit'
                ]);
            }
        }
    }

    private function updateProfilePicture(User $user, Request $request)
    {
        if ($request->hasFile('profile') && $request->profile->getClientOriginalName() != $user->profile) {
            $oldProfile = public_path('storage/' . $user->profile);
            if (file_exists($oldProfile)) {
                unlink($oldProfile);
            }

            $profile = time() . '.' . $request->profile->extension();
            $path = public_path('images/profiles');
            $request->profile->move($path, $profile);
            $user->profile = $profile;
            $user->save();
        }
    }

    private function updateThumbnail(User $user, Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            $thumbnail = time() . '.' . $request->thumbnail->extension();
            $path = public_path('images/profiles/thumbnails');
            $request->thumbnail->move($path, $thumbnail);
            $user->thumbnail = $thumbnail;
            $user->save();
        }
    }
}
