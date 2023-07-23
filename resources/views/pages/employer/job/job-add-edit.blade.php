@extends('layouts.employer')

@section('content')
    
    @include('pages.employer.navigation', ['title' => 'Job Add / Edit'])

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Update Job</h4>                
                    <div class="d-flex">
                        <a href="{{ route('employer.jobs.index') }}" class="btn btn-Sub-Category"><i class="fa fa-arrow-left"></i> Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route("employer.jobs.store") }}" method="POST" enctype="multipart/form-data" id="admin-form">
                        @csrf
                        <input type="hidden" name="redirect_url" id="redirect_url" value="{{ route('employer.jobs.index') }}">
                        @if(isset($job))
                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                        @endif

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label for="title">Title*</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($job) ? $job->title : '') }}" required>
                                    @if($errors->has('title'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </em>
                                    @endif
                                    <p class="helper-block"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('exp_year') ? 'has-error' : '' }}">
                                    <label for="exp_year">Experience Year</label>
                                    <select name="exp_year" class="form-control" required>
                                        @for($i=0;$i<=30;$i++)
                                            @if($i==30)
                                                <option value="{{ $i }}" @if(isset($job) && $i == $job->exp_year) selected @endif>{{ $i }}+ Year</option>
                                            @else
                                                <option value="{{ $i }}" @if(isset($job) && $i == $job->exp_year) selected @endif>{{ $i }} Year</option>
                                            @endif
                                        @endfor
                                    </select>
                                    @if($errors->has('exp_year'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('exp_year') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('exp_month') ? 'has-error' : '' }}">
                                    <label for="exp_month">Experience Month</label>
                                    <select name="exp_month" class="form-control" required>
                                        @for($i=0;$i<=11;$i++)                                
                                            <option value="{{ $i }}" @if(isset($job) && $i == $job->exp_month) selected @endif>{{ $i }} Month</option>                                
                                        @endfor
                                    </select>
                                    @if($errors->has('exp_month'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('exp_month') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('role_responsibilty') ? 'has-error' : '' }}">
                                    <label for="role_responsibilty">Roles and Responsibilities</label>
                                    <textarea name="role_responsibilty" class="form-control ckeditor" rows="5">{!! old('title', isset($job) ? $job->role_responsibilty : '') !!}</textarea>
                                    @if($errors->has('role_responsibilty'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('role_responsibilty') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('candidate_profile') ? 'has-error' : '' }}">
                                    <label for="candidate_profile">Desired Candidate Profile</label>
                                    {{-- <select name="candidate_profile[]" class="form-control select2" required multiple>
                                        @forelse($candidate_profile as $post)
                                            <option value="{{ $post['post_title'] }}" @if(isset($job) && in_array($post['post_title'], convert_string_to_array($job->candidate_profile))) selected @endif>{{ $post['post_title'] }}</option>
                                        @empty
                                        @endforelse
                                    </select> --}}
                                    <input type="text" id="candidate_profile" name="candidate_profile" class="form-control" value="{{ old('candidate_profile', isset($job) ? $job->candidate_profile : '') }}" required>
                                    @if($errors->has('candidate_profile'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('candidate_profile') }}
                                        </em>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('industry_type') ? 'has-error' : '' }}">
                                    <label for="industry_type">Industry Type</label>
                                    <select name="industry_type[]" class="form-control select2" required multiple>
                                        @forelse($industry_type as $post)
                                            <option value="{{ $post['post_title'] }}" @if(isset($job) && in_array($post['post_title'], convert_string_to_array($job->industry_type))) selected @endif>{{ $post['post_title'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if($errors->has('industry_type'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('industry_type') }}
                                        </em>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('education') ? 'has-error' : '' }}">
                                    <label for="education">Education</label>
                                    <select name="education[]" class="form-control select2" required multiple>
                                        @forelse($education as $post)
                                            <option value="{{ $post['post_title'] }}" @if(isset($job) && in_array($post['post_title'], convert_string_to_array($job->education))) selected @endif>{{ $post['post_title'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if($errors->has('education'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('education') }}
                                        </em>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Additional Education</label>
                                    <input type="text" name="addition_education" value="" class="form-control" value="{!! old('title', isset($job) ? $job->addition_education : '') !!}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('functional_area') ? 'has-error' : '' }}">
                                    <label for="functional_area">Functional Area</label>
                                    <select name="functional_area[]" class="form-control select2" required multiple>
                                        @forelse($area as $post)
                                            <option value="{{ $post['post_title'] }}" @if(isset($job) && in_array($post['post_title'], convert_string_to_array($job->functional_area))) selected @endif>{{ $post['post_title'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if($errors->has('functional_area'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('functional_area') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('employement_type') ? 'has-error' : '' }}">
                                    <label for="employement_type">Employment Type</label>
                                    <select name="employement_type[]" class="form-control select2" required multiple>
                                        @forelse($employement_type as $post)
                                            <option value="{{ $post['post_title'] }}" @if(isset($job) && in_array($post['post_title'], convert_string_to_array($job->employement_type))) selected @endif>{{ $post['post_title'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if($errors->has('employement_type'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('employement_type') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('key_skills') ? 'has-error' : '' }}">
                                    <label for="key_skills">Key Skills</label>
                                    <select name="key_skills[]" class="form-control select2" required multiple>
                                        @forelse($skills as $post)
                                            <option value="{{ $post['post_title'] }}" @if(isset($job) && in_array($post['post_title'], convert_string_to_array($job->key_skills))) selected @endif>{{ $post['post_title'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if($errors->has('key_skills'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('key_skills') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
                                    <label for="client_id">Account ID</label>
                                    <select name="client_id" class="form-control" id="client_id" required>
                                        <option value="">-- Select --</option>
                                        @forelse($companies as $com)
                                            <option value="{{ $com->id }}" {{ (isset($job) && $job->client_id ? $job->client_id : old('client_id')) == $com->id ? 'selected' : '' }}>{{ $com->title }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if($errors->has('client_id'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('client_id') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 carrier_product">
                                <div class="form-group {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                    <label for="project_id">Project ID</label>
                                    <select name="project_id" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        @forelse($projects as $pr)
                                            <option value="{{ $pr->id }}" {{ (isset($job) && $job->project_id ? $job->project_id : old('project_id')) == $pr->id ? 'selected' : '' }}>{{ $pr->title }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if($errors->has('project_id'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('project_id') }}
                                        </em>
                                    @endif
                                </div>
                            </div>                            
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('job_description') ? 'has-error' : '' }}">
                                    <label for="job_description">Project Details</label>
                                    <textarea id="job_description" name="job_description" class="form-control ckeditor">{{ old('job_description', isset($job) ? $job->job_description : '') }}</textarea>
                                    @if($errors->has('job_description'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('job_description') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('about_company') ? 'has-error' : '' }}">
                                    <label for="about_company">About Company</label>
                                    <textarea id="about_company" name="about_company" class="form-control ckeditor">{{ old('about_company', isset($job) ? $job->about_company : '') }}</textarea>
                                    @if($errors->has('about_company'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('about_company') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('company_info') ? 'has-error' : '' }}">
                                    <label for="company_info">Company Info</label>
                                    <textarea id="company_info" name="company_info" class="form-control ckeditor">{{ old('company_info', isset($job) ? $job->company_info : '') }}</textarea>
                                    @if($errors->has('company_info'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('company_info') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-danger add-podcast-btn" type="submit">Save</button>
                            </div>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script type="text/javascript">
$(document).ready(function() {    
    $(document).on('change','#client_id',function(){
        $('#dly').show();
        var element = $(this).find('option:selected'); 
        var id = element.attr("value");
        $.ajax({
            type:'post',
            url : "{{ route('admin.project') }}",
            data:{carrier_id:id},
            dataType : 'json',
            success : function(data){
                $('#dly').hide();
                $(".carrier_product").replaceWith(data.cp);
            }
        })
    });
});
</script>
@endpush