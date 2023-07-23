@extends('layouts.app')

@section('content')
    @include('pages.common.header')
    
    <div class="container-md b-second-sec-row">
        <div class="row">
            @forelse($blogs as $blog)
                <div class="col-md mt-5">
                    <a href="{{ route('frontend.show.blog', base64_encode($blog['id'])) }}">
                        @if(isset($blog['src_url']) && !empty($blog['src_url']))
                            <img src="{{ asset('public') }}/{!! $blog['src_url'] !!}" alt="alternative">
                        @else
                            <img src="{{ asset('public/images/no-image.png') }}" alt="alternative">
                        @endif
                    </a>
                    <p><i aria-hidden="true" class="fas fa-calendar-alt"></i> {{ $blog['_date'] }}</p>
                    <a href="{{ route('frontend.show.blog', base64_encode($blog['id'])) }}"><h2>{{ $blog['post_title'] }}</h2></a>
                    @if(isset($blog['short_content']) && !empty($blog['short_content']))
                        <p>{!! $blog['short_content'] !!}...</p>
                    @else
                        <p>{!! shorter($blog['full_content'], 150) !!}</p>
                    @endif
                </div>
            @empty
            @endforelse
        </div>
    </div>

    @include('pages.common.footer')
@endsection

