@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">

            <div class="row">
                {{$userprofile->profilepicture}}
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$userprofile->fullname}}</h5>
                    <p class="card-subtitle mb-2 text-muted"><span>User Email: </span> {{$userprofile->email}}</p>
                    <p class="card-subtitle mb-2 text-muted"><span>Date of Birth </span> {{$userprofile->dob}}</p>
                    <p class="card-text">{{$userprofile->bio}}</p>
                    <p class="card-subtitle mb-2 text-muted"><span>Address </span>{{$userprofile->address}}</p>
                    <p class="card-subtitle mb-2 text-muted"><span>Contact </span>{{$userprofile->contact}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row userprofile-navbar m-1">
                <div class="col-md-2">
                    <a class="navbar-brand" href="#" onclick="userposts()">User Posts</a>
                </div>
                @if(auth()->user()->id===$userprofile->user_id)
                <div class="col-md-2">
                    <a class="navbar-brand" onclick="profileedit()" href="#">Profile Edit</a>
                </div>
                @endif

            </div>
            <div id="user-posts">
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-md-12 mb-3">

                        <div class="card">
                            <div class="card-body">
                                @if ($post->image)
                                <img src="{{URL::to('uploads/userposts/'.$post->image)}}" class="card-img-top post-image">
                                @endif
                                <p class="card-text">{{$post->status}}</p>
                                <p class="card-text">{{$post->location}}</p>
                                @if(auth()->user()->id===$userprofile->user_id)
                                <form action="/post/destroy/{{$post->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Post</button>
                                </form>
                                @endif
                            </div>
                        </div>




                    </div>
                    @endforeach
                </div>
            </div>
            <div id="profile-edit" style="display: none;">
                <div class="container-fluid profile-edit m-1">
                    <div class="row">
                        <h4 class="mt-2">Edit User Profile</h4>
                        <form class="mb-2" action="/profile/edit/{{$userprofile->id}}" method="POST">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="email">Full Name:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{$userprofile->fullname}}">
                            </div>
                            <div class="form-group  mt-2">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$userprofile->email}}" readonly>
                            </div>
                            <div class="form-group mt-2">
                                <label for="bio">Bio:</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3" value="{{$userprofile->bio}}">{{$userprofile->bio}}</textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="contact">Contact:</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="{{$userprofile->contact}}">
                            </div>
                            <div class="form-group mt-2">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$userprofile->address}}">
                            </div>
                            <div class="form-group mt-2">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>


    </div>
</div>


@endsection