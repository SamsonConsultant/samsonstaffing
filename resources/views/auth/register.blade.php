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
                                <p class="login-box-msg">Register a new membership</p>
                                @include('pages/errors-and-messages')
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="input-group mb-3">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full name">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="role_id" value="3" checked>
                                            <label for="customRadio1" class="custom-control-label">Employee</label>
                                        </div>
                                        {{-- <div class="custom-control custom-radio">
                                            <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" id="customRadio2" name="role_id" value="2">
                                            <label for="customRadio2" class="custom-control-label">Employer</label>
                                        </div> --}}
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>

                                        <p>Already have an account? <a class="btn-link" href="{{ route('login') }}"> Login</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.common.footer')
@endsection
