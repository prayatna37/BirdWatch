@extends('layouts.app')
@section('content')
@include('partials.error')

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
                    <p class="card-subtitle mb-2 text-muted"><span>User Email: </span> {{$userprofile->username}}</p>
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
                @auth
                @if(auth()->user()->id===$userprofile->user_id)
                <div class="col-md-2">
                    <a class="navbar-brand" onclick="profileedit()" href="#">Profile Edit</a>
                </div>
                @endif
                @endauth
            </div>
            <div id="user-posts">
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-md-12 mb-3">

                        <div class="card">
                            <div class="card-body">
                                @if ($post->image)
                                <img src="{{URL::to('uploads/userposts/'.$post->image)}}" class="card-img-top post-image" style="width: auto ;">
                                @endif
                                <p class="card-text">{{$post->status}}</p>
                                <p class="card-text">{{$post->location}}</p>
                                <i class="card-text">{{$post->latitude}},&nbsp;{{$post->longitude}} </i><br>
                                @auth
                                @if(auth()->user()->id===$userprofile->user_id)
                                <form action="/post/destroy/{{$post->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Post</button>
                                </form>
                                @endif
                                @endauth
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
                                <div id="fullname-validation-error" class="invalid-feedback"></div>
                                @if ($errors->has('fullname'))
                                <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                @endif
                            </div>
                            <div class="form-group  mt-2">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$userprofile->email}}" readonly>
                                <div id="email-validation-error" class="invalid-feedback"></div>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif

                            </div>
                            <div class="form-group mt-2">
                                <label for="bio">Bio:</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3" value="{{$userprofile->bio}}">{{$userprofile->bio}}</textarea>

                                @if ($errors->has('bio'))
                                <span class="text-danger">{{ $errors->first('bio') }}</span>
                                @endif
                            </div>
                            <div class="form-group mt-2">
                                <label for="contact">Contact:</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="{{$userprofile->contact}}">
                                <div id="contact-validation-error" class="invalid-feedback"></div>
                                @if ($errors->has('contact'))
                                <span class="text-danger">{{ $errors->first('contact') }}</span>
                                @endif
                            </div>
                            <div class="form-group mt-2">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$userprofile->address}}">

                                @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="form-group mt-2">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                                <div id="dob-validation-error" class="invalid-feedback"></div>
                                @if ($errors->has('dob'))
                                <span class="text-danger">{{ $errors->first('dob') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
<script>
    const nameInput = document.getElementById('fullname');
    const nameValidationError = document.getElementById('fullname-validation-error');

    nameInput.addEventListener('input', () => {
        const nameValue = nameInput.value;

        if (nameValue.length > 0) {

            if (nameValue.length < 3) {
                nameInput.classList.add('is-invalid');
                nameValidationError.textContent = 'Name must be at least 3 characters.';
            } else {
                nameInput.classList.remove('is-invalid');
                nameValidationError.textContent = '';
            }
        } else {
            nameInput.classList.remove('is-invalid');
            nameValidationError.textContent = '';
        }
    });
    const emailInput = document.getElementById('email');

    emailInput.addEventListener('input', () => {
        validateEmail(emailInput);
    });

    function validateEmail(input) {
        const validationError = document.getElementById('email-validation-error');
        const email = input.value;

        if (!email.includes('@')) {
            input.classList.add('is-invalid');
            validationError.textContent = 'Email must contain "@" symbol.';
        } else {
            input.classList.remove('is-invalid');
            validationError.textContent = '';
        }
    }
    const contactInput = document.getElementById('contact');

    contactInput.addEventListener('input', () => {
        validateContactField(contactInput);
    });

    function validateContactField(contactInput) {
        const validationError = document.getElementById('contact-validation-error');
        const contactValue = contactInput.value;

        if (!/^\d{1,10}$/.test(contactValue)) {
            contactInput.classList.add('is-invalid');
            validationError.textContent = 'Please enter a valid contact number with up to 10 digits.';
        } else {
            contactInput.classList.remove('is-invalid');
            validationError.textContent = '';
        }
    }
</script>


@endsection