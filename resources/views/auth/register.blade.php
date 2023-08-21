@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <div id="name-validation-error" class="invalid-feedback"></div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                <div id="username-validation-error" class="invalid-feedback"></div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <div id="email-validation-error" class="invalid-feedback"></div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <div id="password-validation-error" class="invalid-feedback"></div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div id="password-confirm-validation-error" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Validating name
        const nameInput = $('#name');
        const nameValidationError = $('#name-validation-error');

        nameInput.on('input', function() {
            const nameValue = nameInput.val();

            if (nameValue.length > 0) {
                if (nameValue.length < 3) {
                    nameInput.addClass('is-invalid');
                    nameValidationError.text('Name must be at least 3 characters.');
                } else {
                    nameInput.removeClass('is-invalid');
                    nameValidationError.text('');
                }
            } else {
                nameInput.removeClass('is-invalid');
                nameValidationError.text('');
            }
        });

        // Validating username

        const usernameInput = $('#username');
        const usernameValidationError = $('#username-validation-error');

        usernameInput.on('input', function() {
            validateUsername(usernameInput);
        });

        function validateUsername(input) {
            const username = input.val();

            if (username.length < 5) {
                input.addClass('is-invalid');
                usernameValidationError.text('Username must be at least 5 characters.');
            } else if (!/^[a-zA-Z0-9]+$/.test(username)) {
                input.addClass('is-invalid');
                usernameValidationError.text('Username must be alphanumeric.');
            } else {
                input.removeClass('is-invalid');
                usernameValidationError.text('');
            }
        }

        // Validating email
        const emailInput = $('#email');

        emailInput.on('input', function() {
            validateEmail(emailInput);
        });

        function validateEmail(input) {
            const validationError = $('#email-validation-error');
            const email = input.val();

            if (!email.includes('@')) {
                input.addClass('is-invalid');
                validationError.text('Email must contain "@" symbol.');
            } else {
                input.removeClass('is-invalid');
                validationError.text('');
            }
        }

        // Validating password
        const passwordInput = $('#password');

        passwordInput.on('input', function() {
            validatePassword(passwordInput);
        });

        function validatePassword(input) {
            const validationError = $('#password-validation-error');
            const password = input.val();

            if (password.length < 8) {
                input.addClass('is-invalid');
                validationError.text('Password must be at least 8 characters.');
            } else if (!/^[a-zA-Z0-9]+$/.test(password)) {
                input.addClass('is-invalid');
                validationError.text('Password must be alphanumeric.');
            } else {
                input.removeClass('is-invalid');
                validationError.text('');
            }
        }

        // Checking password confirmation
        const confirmPasswordInput = $('#password-confirm');

        confirmPasswordInput.on('input', function() {
            validatePasswordConfirmation(passwordInput, confirmPasswordInput);
        });

        function validatePasswordConfirmation(passwordInput, confirmPasswordInput) {
            const validationError = $('#password-confirm-validation-error');
            const password = passwordInput.val();
            const passwordConfirm = confirmPasswordInput.val();

            if (password !== passwordConfirm) {
                confirmPasswordInput.addClass('is-invalid');
                validationError.text('Passwords do not match.');
            } else {
                confirmPasswordInput.removeClass('is-invalid');
                validationError.text('');
            }
        }
    });
</script>

@endsection