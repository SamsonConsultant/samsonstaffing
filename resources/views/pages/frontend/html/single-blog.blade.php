@extends('layouts.app')

@section('content')
    @include('pages.common.header')
        
    <div class="container pt-5 mt-5 mb-md-5">
        @if(isset($page->src_url) && !empty($page->src_url))
            <img src="{{ asset('public') }}/{!! $page->src_url !!}" alt="alternative">        
        @endif

        <div class="row mt-md-5 pt-md-5 mb-2 pb-2">
            <div class="col-md">
                <h1 class="text-start">{!! $page->post_title !!}</h1>
                <p><i aria-hidden="true" class="fas fa-calendar-alt"></i> {{ date('d M Y', strtotime($page->created_at)) }}</p>
            </div>
        </div>
    </div>

    <div class="container mt-4 pt-5 mb-5 pb-5">
        {!! $page->full_content !!}
    </div>

    @include('pages.common.footer')
@endsection

