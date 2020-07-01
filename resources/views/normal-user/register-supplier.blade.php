@extends('layouts.app')

@section('content')
    <section id="auth">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                        <div class="card">
                                <div class="card-header"> {{ __('Supplier Registration') }}</div>
            
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" action='{{ url("registersupplier") }}'>
                                        @csrf

                        <div class="card-body">
                            <form method="POST" action="registersupplier}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}">
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                    <div class="col-md-6">
                                        <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="certificate" class="col-md-4 col-form-label text-md-right">{{ __('Company Certificate') }}</label>
                                        <div class="col-md-6">
                                            <input id="certificate" type="file" class="form-control-file{{ $errors->has('certificate') ? ' is-invalid' : '' }}" name="certificate">
                                            @if ($errors->has('certificate'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('certificate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success form-control">
                                            {{ __('Register') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link forgot-pass" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
            </div>
        </div>
    </section>
@endsection
