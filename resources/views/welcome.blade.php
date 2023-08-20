@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @if(isset($posts))
        @foreach($posts as $post)
        <div class="col-md-12 mb-3">

            <div class="card">
                <div class="card-body">
                    @if ($post->image)
                    <img src="{{URL::to('uploads/userposts/'.$post->image)}}" class="card-img-top post-image" style="width:auto;">
                    @endif
                    <p class="card-text">{{$post->status}}</p>
                    <p class="card-text">{{$post->location}}</p>
                    <i class="card-text">{{$post->latitude}},&nbsp;{{$post->longitude}} </i><br>

                    @if ($post->user)
                    <b style="font-size:15px;">Post By: <a href="/profile/{{$post->user_id}}'" class="post-user">{{$post->user->name}}</a></b>
                    @else
                    Anonymous User
                    @endif


                </div>
            </div>


        </div>

        @endforeach
        @else
        <h1>Add New Post</h1>
        @endif
    </div>
</div>
@endsection