<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileEdit extends Component
{
    public function render()
    {
        return view('livewire.profile-edit')->extends('layouts.app');
    }

    public function profileEdit(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        DB::beginTransaction();
        try {
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
                'partner' => $request->partner,
                'work' => $request->work,
                'address' => $request->address,
                'website' => $request->website,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            session()->flash('error', 'Something went wrong');
        }

        // when the name of the input field in the form for the profile picture is not equal to the original profile picture name in the database table of the user, then the profile picture will be updated
        if ($request->hasFile('profile') && $request->profile->getClientOriginalName() != $user->profile) {
            // the old profile picture will be deleted from the storage
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

        // Handle the user's thumbnail
        if ($request->hasFile('thumbnail')) {
            // the old thumbnail will be deleted from the storage
            $thumbnail = time() . '.' . $request->thumbnail->extension();
            $path = public_path('images/profiles/thumbnails');
            $request->thumbnail->move($path, $thumbnail);
            $user->thumbnail = $thumbnail;
            $user->save();
        }
        // Redirect the user back to their profile page with a success message
        return redirect()->back()->with('success', 'Your profile has been updated.');
    }
}
