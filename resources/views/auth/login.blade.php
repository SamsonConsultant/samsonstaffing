@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('public/css/login.css') }}?v=<?php echo time(); ?>">
@endpush

@section('content')
    @include('pages.common.header')

    <div class="reg-login-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-form">
                        <div class="card card-outline card-primary">
                            <div class="card-header text-center">
                                <a href="{{ url('/') }}" class="h1"><b>{{ get_site_title() }}</b></a>
                            </div>
                            <div class="card-body">
                                <p class="login-box-msg">Sign in to start your session</p>
                                @include('pages/errors-and-messages')
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">                            
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="icheck-primary">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                        </div>
                                    </div>
                                </form>
                                @if (Route::has('password.request'))
                                    <p class="mb-1">
                                        <a class="btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </p>
                                @endif
                                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="pl-1 btn-link text-center">Signup Here</a></p>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.common.footer')
@endsection
