@extends('layouts.app')
@section('content')
<div class="container">
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
                    <b style="font-size:15px;">Post By: <a href="/profile/{{$post->user_id}}'" class="post-user">{{$post->user->name}}</a></b>

                </div>
            </div>


        </div>

        @endforeach
    </div>
</div>
@endsection