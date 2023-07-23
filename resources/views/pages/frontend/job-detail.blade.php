@extends('layouts.app')

@section('content')
    @include('pages.common.header')

    <div class="first-section">
        <div class="container">
            <div class="row">
                <h1>{{ $job->company->title ?? '' }}</h1>
            </div>
        </div>
    </div>

    <div class="second-section mb-5 mt-4">
        <div class="container">
            <div class="card">
                <div class="col-md">
                    <h2 class="pt-3 text-center">{{ $job->title ?? '' }}</h2>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="d-flex align-items-center pt-3 pb-3 border-bottom">Job Requirements</h4>
                            <p><b>Experience:</b> {{ $job->exp_year }} Year {{ $job->exp_month }} Month</p>
                            <p><b>Education:</b> {{ $job->education }}</p>
                            <p><b>Additional Education:</b> {{ $job->addition_education }}</p>
                            <p><b>Industry Type:</b> {{ $job->industry_type }}</p>
                            <p><b>Functional Area:</b> {{ $job->functional_area }}</p>
                            <p><b>Key Skills:</b> {!! $job->key_skills !!}</p>
                            <p><b>Employment Type:</b> {!! $job->employement_type !!}</p>
                            <p><b>Candidate Profile: </b> {!! $job->candidate_profile !!}</p>
                        </div>
                        <div class="col-md-4">
                            <h4 class="d-flex align-items-center pt-3 pb-3 border-bottom">About Company</h4>
                            <p><b>Company Name:</b> {{ $job->company->title ?? '' }}</p>
                            <p><b>Company Type:</b> {{ $job->company->account_type ?? '' }}</p>
                            <p><b>Company Address:</b> {{ $job->company->address ?? '' }}</p>
                            <p><b>Company Phone:</b> {{ $job->company->phone_code ?? '' }}-{{ $job->company->phone ?? '' }}</p>
                        </div>
                        <div class="col-md-4">
                            <h4 class="d-flex align-items-center pt-3 pb-3 border-bottom">Job Contact</h4>
                            <p><b>Person Name:</b> {{ $job->project->contact->first_name ?? '' }} {{ $job->project->contact->last_name ?? '' }}</p>
                            <p><b>Person Email:</b> {{ $job->project->contact->email ?? '' }}</p>
                            <p><b>Person Phone:</b> {{ $job->project->contact->phone_code ?? '' }}-{{ $job->project->contact->phone ?? '' }}</p>
                        </div>
                    </div>
                    <div class="row pt-4 second-section-row-5">
                        <h4 class="d-flex align-items-center pt-3 pb-3 border-bottom">Roles and Responsibilities</h4>
                        <div class="col-md-9">
                            {!! $job->role_responsibilty !!}
                        </div>

                        <div class="col-md-3 in-2-second-section">
                            @guest
                                <a class="outline-btn" href="{{ route('login') }}">Apply</a>
                            @else
                                <a href="javascript:void(0)" class="outline-btn" data-toggle="modal" data-target="#exampleModal">Apply</a>
                            @endif
                        </div>
                    </div>
                    <div class="row pt-4 second-section-row-5">
                        <h4 class="d-flex align-items-center pt-3 pb-3 border-bottom">Job Company Information</h4>
                        <div class="col-md-12">
                            {!! $job->about_company !!}
                        </div>
                    </div>
                    {{-- <div class="row pt-4 second-section-row-5">
                        <h4 class="d-flex align-items-center pt-3 pb-3 border-bottom">Job Details</h4>
                        <div class="col-md-12">
                            {!! $job->job_description !!}
                        </div>
                    </div> --}}                    
                    {{-- <div class="row pt-4 second-section-row-5">
                        <h4 class="d-flex align-items-center pt-3 pb-3 border-bottom">Company Information</h4>
                        <div class="col-md-12">
                            {!! $job->company_info !!}
                        </div>
                    </div> --}}
                </div>                
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $job->title ?? '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('user.apply.job') }}" id="frm-data" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->id ?? '' }}">
                        <div class="form-group">
                            <label>First name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                            <input type="text" class="form-control" placeholder="Enter ..." name="first_name" value="{{ $user->first_name ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label>Last name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                            <input type="text" class="form-control" placeholder="Enter ..." name="last_name" value="{{ $user->last_name ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label>Email <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                            <input type="email" class="form-control" placeholder="Enter ..." name="email" value="{{ $user->email ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label>Resume <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                            <input type="file" class="form-control" placeholder="Enter ..." name="myfile" value="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary add-podcast-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('pages.common.footer')
@endsection