<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;



class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',

        ]);

        $post = new Post();
        $post->status = request('status');
        $post->location = request('location');
        $post->latitude = $request->input('latitude');
        $post->longtitude = $request->input('longtitude');

        if (request()->hasfile('image')) {

            $file = request('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            Image::make($file)->save(public_path('uploads/userposts/' . $filename));
            $post->image = $filename;
        }

        request()->user()->posts()->save($post);
        return back()->with('success', 'Post Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $post = Post::findOrFail($id);
        if (Auth::user()->id === $post->user_id) {
            $post->delete();

            return back()->with('success', 'Post deleted successfully.');
        } else {
            return back();
        }
    }
}
