@extends('layouts.app')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form action="/createpost" method="post" enctype="multipart/form-data" id="location-form">
                @csrf
                <div class="form-group m-3">
                    <textarea class="form-control" placeholder="Please Enter Your Status" id="" name="status" rows="7" required></textarea>
                    @if ($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                </div>
                <div class="form-group m-3">
                    <label for="Image">Choose your image</label>
                    <input type="file" class="form-control-file" id="" name="image">
                    <div id="image-validation-error" class="invalid-feedback"></div>
                    @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif
                </div>
                <div class="form-group m-3">
                    <input type="text" class="form-control" name="location" placeholder="Location" id="">
                    @if ($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                    @endif
                </div>
                <div class="form-row m-3">

                    <div class="row">

                        <div class="col">
                            <input type="text" class="form-control" name="latitude" placeholder="Latitude" id="latitude">
                            @if ($errors->has('latitude'))
                            <span class="text-danger">{{ $errors->first('latitude') }}</span>
                            @endif
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="longitude" placeholder="Longitude" id="longitude">
                            @if ($errors->has('longitude'))
                            <span class="text-danger">{{ $errors->first('longitude') }}</span>
                            @endif
                        </div>
                        <i style="font-size: 13px;"><b>NOTE:</b>&nbsp; If you know your location add your latitude and longitude. If Not Click on the submit button. Location will be added automatically</i>
                    </div>
                    <div id="location-message" style="display: none;">Latitude and Longitude have been added automatically.</div>



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
    const locationMessage = document.getElementById('location-message');

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

                locationMessage.style.display = 'block';
            }
        });
    });

    //image validation
    const fileInput = document.getElementById('image');

    fileInput.addEventListener('change', () => {
        validateImageFileType(fileInput);
    });

    function validateImageFileType(fileInput) {
        const validationError = document.getElementById('image-validation-error');
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        const selectedFileName = fileInput.value;
        const fileExtension = selectedFileName.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            fileInput.classList.add('is-invalid');
            validationError.textContent = 'Please select a valid image file (jpg, jpeg, png, gif).';
        } else {
            fileInput.classList.remove('is-invalid');
            validationError.textContent = '';
        }
    }
</script>

@endsection