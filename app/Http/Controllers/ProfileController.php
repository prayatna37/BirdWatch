<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index($id)
    {
        $userprofile = Profile::find($id);
        $user = User::with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($id);
        $posts = $user->posts;


        return view('profile', [
            'userprofile' => $userprofile,
            'posts' => $posts,
        ]);
    }
    public function edit(Request $request, $id)
    {
        // dd(Auth::user()->id, (int)$id);
        if (Auth::user()->id !== (int)$id) {
            return back()->with('error', 'You cannot edit the users profile');
        }
        // dd('test');
        $this->validate($request, [
            'fullname' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'contact' => 'nullable|string|numeric|digits:10',
            'email' => 'required|string|email|max:255',
            'address' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
        ]);

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
