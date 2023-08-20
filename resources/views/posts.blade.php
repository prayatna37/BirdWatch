@extends('layouts.app')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form action="/createpost" method="post" enctype="multipart/form-data" id="location-form">
                @csrf
                <div class="form-group m-3">
                    <textarea class="form-control" placeholder="Please Enter Your Status" id="" name="status" rows="7" required></textarea>
                </div>
                <div class="form-group m-3">
                    <label for="Image">Choose your image</label>
                    <input type="file" class="form-control-file" id="" name="image">
                </div>
                <div class="form-group m-3">
                    <input type="text" class="form-control" name="location" placeholder="Location" id="">
                </div>
                <div class="form-row m-3">

                    <div class="row">
                        <div class="col">
                            <input type="number" class="form-control" name="latitude" placeholder="Latitude" id="latitude">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="longtitude" placeholder="Longtitude" id="longtitude">
                        </div>
                    </div>


                </div>
                <div class="form-group m-3">

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');

    // Function to get user's location
    function getUserLocation() {
        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Populate inputs only if they are empty
                    if (!latitudeInput.value) {
                        latitudeInput.value = latitude;
                    }
                    if (!longitudeInput.value) {
                        longitudeInput.value = longitude;
                    }
                },
                function(error) {
                    console.error('Error getting location:', error);
                }
            );
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    }

    // Attach the function to the form's submit event
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('location-form');
        form.addEventListener('submit', function(event) {
            // If latitude or longitude is empty, get user's location
            if (!latitudeInput.value || !longitudeInput.value) {
                event.preventDefault();
                getUserLocation(); // Get user's location before form submission
            }
        });
    });
</script>

@endsection