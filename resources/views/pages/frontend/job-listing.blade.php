@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('public/css/s1.css') }}">
@endpush

@push('js')
<script src="{{ asset('public/js/share.js') }}"></script>
@endpush

@section('content')
    @include('pages.common.header')
    
    <div class="container-fluid l-second-sec">
        <div class="container">
            <form method="get" action="{{ route('frontend.jobs') }}">
                <div class="row">
                    <div class="col-md-12 border-bottom mb-4">
                        <h1>Smarts takes you</h1>
                    </div>
                    <div class="col-md-6">  
                        <div class="form-group">
                        <label for="search">Keywords</label>
                        <input type="text" id="keyword" name="keyword" placeholder="Enter the value" class="main-job-search form-control" value="{{ $all_data['keyword'] ?? '' }}">
                        </div>                      
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="counrty/region">Counrty</label>
                        <select class="form-control" aria-label="Default select example" name="counrty">
                            <option value="">- Select an option -</option>
                            @forelse($country as $cn)
                                <option value="{{ $cn->id }}">{{ $cn->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="state">State</label> 
                        <select class="form-control" aria-label="Default select example" name="state">
                            <option value="">- Select an option -</option>
                            @forelse($state as $sn)
                                <option value="{{ $sn->id }}">{{ $sn->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="counrty/region">City</label>
                        <select class="form-control" aria-label="Default select example" name="city">
                            <option value="">- Select an option -</option>
                            @forelse($ct_id as $ct)
                                <option value="{{ $ct }}">{{ $ct }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="counrty/region">Carrer area</label>
                        <select class="form-control" aria-label="Default select example" name="functional_area">
                            <option value="">- Select an option -</option>
                            @forelse($area as $post)
                                <option value="{{ $post['post_title'] }}">{{ $post['post_title'] }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="counrty/region">Position type</label>
                        <select class="form-control" aria-label="Default select example" name="industry_type">
                            <option value="">- Select an option -</option>
                            @forelse($industry_type as $post)
                                <option value="{{ $post['post_title'] }}">{{ $post['post_title'] }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    </div>
                    <div class="col mt-4">
                        <button type="submit" class="search">Search</button>
                        <a href="{{ route('frontend.jobs') }}" class="reset">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="alert alert-danger">Showing <strong>{{ $jobs->firstItem() }}</strong> to <strong>{{ $jobs->lastItem() }}</strong> of Total <strong>{{ $jobs->total() }}</strong> Jobs</p>
                </div>
                {{-- <div class="col-md-12">
                    @if(!empty($jobs))
                        {{ $jobs->appends(Request::except('page'))->onEachSide(2)->links() }}
                    @endif
                </div> --}}
            </div>
            @forelse($jobs as $job)
                <div class="row l-third-sec-row-2 l-ancher-hover border-bottom">
                    <div class="col-md-8">
                        <h4>{{ $job->title ?? '' }}</h4>
                        <h5><b>Company:-</b> {{ $job->company->title ?? '' ?? '' }}</h5>
                        <h5><b>Project:-</b> {{ $job->project->title ?? '' }}</h5>
                        <h5><b>Required Experince:-</b> {{ $job->exp_year }} Year {{ $job->exp_month }} Month</h5>
                        <h5><b>Industry Type:-</b> {{ $job->industry_type ?? '' }}</h5>
                        <p>{{ shorter($job->about_company, 150) }}</p>
                    </div>
                    <div class="col-md-4 align-self-center text-center">
                        <a href="{{ route('frontend.job.detail', base64_encode($job->id)) }}" class="apply">View Detail</a>
                        {!!
                            Share::page(route('frontend.job.detail', base64_encode($job->id)), $job->title)
                                ->facebook()
                                ->twitter()
                                ->linkedin()
                                ->whatsapp();
                        !!}
                        {{-- <a href="#"><img src="{{ asset('public/images/share-icon.png') }}" alt="Share icon png" /></a> --}}
                    </div>
                </div>
            @empty
            @endforelse
            
            <div class="row">
                <div class="col-md-4 offset-md-8 l-third-sec-col-2">
                    <div class="d-flex justify-content-around">
                    @if(!empty($jobs))
                            {{ $jobs->appends(Request::except('page'))->onEachSide(2)->links() }}
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('pages.common.footer')
@endsection

