@extends('layouts.employer')

@section('content')
    
    @include('pages.employer.navigation', ['title' => 'Dashboard'])

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h5>{{ __('Total Project') }}</h5></div>
                        <div class="card-body">
                            <span class="nav-link"><i class="fa-fw fas fa-book nav-icon"></i> {{ count($projects) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h5>{{ __('Total Job') }}</h5></div>
                        <div class="card-body">
                            <span class="nav-link"><i class="fa-fw fas fa-briefcase nav-icon"></i> {{ count($jobs) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h5>{{ __('Dashboard') }}</h5></div>
                        <div class="card-body">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" id="password-form" action="{{ route('employer.password.update') }}" enctype="multipart/form-data">
                                <div class="row personal-details-input">
                                    <div class="col-md-12">
                                        <input type="password" name="old_password" placeholder="Old Password">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="password" name="password" placeholder="New Password">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="password" name="password_confirmation" placeholder="Confirm New Password">
                                    </div>
                                    <div class="col-md-12 mb-4 d-flex justify-content-end">
                                        <button class="btn btn add-podcast-btn" type="submit">Change Password </button>
                                        <input type="hidden" id="redirect_url" value="{{ route('employer.dashboard') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </div>

@endsection
