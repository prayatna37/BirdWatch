@extends('layouts.app')
@section('content')

@include('partials.error')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form action="/createpost" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group m-3">
                    <textarea class="form-control" placeholder="Please Enter Your Status" id="exampleFormControlTextarea1" name="status" rows="3" required></textarea>
                </div>
                <div class="form-group m-3">
                    <label for="exampleFormControlFile1">Choose your image</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                </div>
                <div class="form-group m-3">
                    <input type="text" class="form-control" name="location" placeholder="Location" id="exampleFormControlFile1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
@endsection