@extends('layouts.app')

@section('content')
    @include('pages.common.header')
    {{-- @include('pages.errors-and-messages') --}}

    @if(!empty($template))
        @include('pages.frontend.html.'.$template)
    @else
        @include('pages.frontend.html.home')
    @endif

    @include('pages.common.footer')
@endsection

