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
    const nameInput = document.getElementById('name');
    const nameValidationError = document.getElementById('name-validation-error');

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
    //validating username
    const usernameInput = document.getElementById('username');

    usernameInput.addEventListener('input', () => {
        validateUsername(usernameInput);
    });

    function validateUsername(input) {
        const validationError = document.getElementById('username-validation-error');
        const username = input.value;

        if (username.length < 5) {
            input.classList.add('is-invalid');
            validationError.textContent = 'Username must be at least 5 characters.';
        } else if (!/^[a-zA-Z0-9]+$/.test(username)) {
            input.classList.add('is-invalid');
            validationError.textContent = 'Username must be alphanumeric.';
        } else {
            input.classList.remove('is-invalid');
            validationError.textContent = '';
        }
    }


    //validating email
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

    //validating password
    const passwordInput = document.getElementById('password');

    passwordInput.addEventListener('input', () => {
        validatePassword(passwordInput);
    });

    function validatePassword(input) {
        const validationError = document.getElementById('password-validation-error');
        const password = input.value;

        if (password.length < 8) {
            input.classList.add('is-invalid');
            validationError.textContent = 'Password must be at least 8 characters.';
        } else if (!/^[a-zA-Z0-9]+$/.test(password)) {
            input.classList.add('is-invalid');
            validationError.textContent = 'Password must be alphanumeric.';
        } else {
            input.classList.remove('is-invalid');
            validationError.textContent = '';
        }
    }

    //checking password confirmation

    const confirmpasswordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password-confirm');

    passwordConfirmInput.addEventListener('input', () => {
        validatePasswordConfirmation(confirmpasswordInput, passwordConfirmInput);
    });

    function validatePasswordConfirmation(confirmpasswordInput, passwordConfirmInput) {
        const validationError = document.getElementById('password-confirm-validation-error');
        const password = confirmpasswordInput.value;
        const passwordConfirm = passwordConfirmInput.value;

        if (password !== passwordConfirm) {
            passwordConfirmInput.classList.add('is-invalid');
            validationError.textContent = 'Passwords do not match.';
        } else {
            passwordConfirmInput.classList.remove('is-invalid');
            validationError.textContent = '';
        }
    }
</script>

@endsection