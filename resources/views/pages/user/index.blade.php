@extends('layouts.app')

@push('css')
    <link href="{{ asset('public/user/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
    @include('pages.common.header')

    <div class="first-section">
        <div class="container">
            <div class="row">
                <h1>{{ Auth::user()->name }}</h1>
            </div>
        </div>
    </div>

    <div id="wrapper">
        @include('pages.user.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('pages.errors-and-messages')
                
                <div class="second-section mb-5 mt-3">
                    @include('pages.user.html.'.$template)
                </div>
            </div>
        </div>
    </div>

    @include('pages.common.footer')
@endsection

