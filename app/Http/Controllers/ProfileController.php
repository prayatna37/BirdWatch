<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index($id)
    {
        $userprofile = Profile::find($id);
        $user = User::with('posts')->find($id);
        $posts = $user->posts;


        return view('profile', [
            'userprofile' => $userprofile,
            'posts' => $posts,
        ]);
    }
    public function edit(Request $request, $id)
    {
        if (Auth::user()->id !== $id) {
            return back()->with('error', 'You cannot edit the users profile');
        }
        $profile = Profile::FindOrFail($id);
        $profile->update([
            'fullname' => request('fullname'),
            'bio' => request('bio'),
            'contact' => request('contact'),
            'email' => request('email'),
            'address' => request('address'),
            'dob' => request('dob'),

        ]);

        $user = User::FindOrFail($id);
        $user->update([
            'name' => request('fullname'),
            'email' => request('email'),
        ]);
        return back()->with('success', 'Profile has been updated');
    }
}
