@extends('layouts.admin.main')

@push('css')
<style type="text/css">
    .labelRequiredIcon{
        color: red;
    }
</style>
@endpush

@push('js')
<script type="text/javascript">
    $(document).ready(function() {       
        $(document).on('change','#country-list',function(){
            let id = $(this).val();
            $.ajax({
                type:'get',
                url : "{{ route('admin.country.state') }}",
                data:{country_id:id},
                dataType : 'json',
                success : function(data){
                    $(".state-list").replaceWith(data.html);
                }
            })
        });
    });
</script>
@endpush

@section('content')

    @include('pages.admin.header')

    <div id="wrapper">
        @include('pages.admin.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <section class="overview-card-list dashboard-data-bg mt-4">
                        <div class="overview-card-body">
                            @include('pages.errors-and-messages')
                            
                            <div class="error-msg mt-2"></div>

                            <div class="wallet-balance-card-1 d-sm-flex align-items-center justify-content-between">
                                <div class="text-left">
                                    <h2>Project Management</h2>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('admin.job.manage') }}" class="btn btn-danger">Back</a>
                                </div>
                            </div>
                                    
                            <div class="row">
                                <div class="col-md-12 col-lg-12 mt-3">
                                    <div class="text-center">
                                        <h4>Project ID #{{ $project->uid }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 mt-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Project Detail</h4>
                                        </div>
                                        <div class="card-body">
                                            {!! $project->detail !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 mt-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6 class="card-title">Applied</h6>
                                            <span>{{ getApply($job->id) }}</span>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="card-title">Screening</h6>
                                            <span>{{ getScreening($job->id) }}</span>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="card-title">Selected</h6>
                                            <span>{{ getSelected($job->id) }}</span>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="card-title">Rejected</h6>
                                            <span>{{ getRejected($job->id) }}</span>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="card-title">Offered</h6>
                                            <span>{{ getOffered($job->id) }}</span>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="card-title">Under Process</h6>
                                            <span>{{ getUnderProcess($job->id) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('admin.send.bulk.mail') }}" method="post" id="send-bulk-mail" class="col-md-12 col-lg-12">
                                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                    <div class="col-md-12 col-lg-12 mt-3">
                                        <div class="mail-error-msg"></div>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">Upload CV</button>
                                            <button type="submit" class="btn btn-default" id="mail_send">Send Mail</button>
                                        </div>
                                        <div class="table-responsive mt-3">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <th><input name="select_all" value="1" id="select-all" type="checkbox"></th>
                                                    <th>Candidate Name</th>
                                                    <th>Candidate CV</th>
                                                    <th>Experince</th>
                                                    <th>SKills</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>Interview Date&time</th>
                                                    <th>Offer Letter/Call Letter</th>
                                                </thead>
                                                <tbody>                                                
                                                    @forelse($related_jobs as $jb)
                                                        <tr>
                                                            <td class="ws">
                                                                <input name="jobm_ids[]" value="{{ $jb->id }}" type="checkbox" class="selectone" />
                                                            </td>
                                                            <td>{{ $jb->user->name ?? '' }}</td>
                                                            <td><a href="{{ asset($jb->cv_path) }}" target="_blank">PDF</a></td>
                                                            <td>{{ getUserExperince($jb->user_id) }}</td>
                                                            <td>{{ $jb->job->key_skills ?? '' }}</td>
                                                            <td>{{ getStatusType($jb->status) }}</td>
                                                            <td>
                                                                @if($jb->status == 1)
                                                                    <a href="{{ route('admin.job.status', [$jb->id, '2']) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure.?')">Rejected</a>
                                                                    <a href="{{ route('admin.job.status', [$jb->id, '3']) }}" class="btn btn-success btn-sm" onclick="return confirm('Are you sure.?')">Selected</a>
                                                                @endif

                                                                @if($jb->status == 2)                                                                    
                                                                    <a href="{{ route('admin.job.status', [$jb->id, '3']) }}" class="btn btn-success btn-sm" onclick="return confirm('Are you sure.?')">Selected</a>
                                                                @endif

                                                                @if($jb->status == 3)
                                                                    <a href="{{ route('admin.job.status', [$jb->id, '2']) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure.?')">Rejected</a>
                                                                    <a href="{{ route('admin.job.status', [$jb->id, '4']) }}" class="btn btn-info btn-sm" onclick="return confirm('Are you sure.?')">Screening</a>
                                                                @endif

                                                                @if($jb->status == 4 && empty($jb->st_date))
                                                                    <button type="button" class="btn btn-warning btn-sm inter-btn" data-id="{{ $jb->id }}" data-user="" data-toggle="modal" data-target="#interviewModal">Send Call</button>
                                                                @endif

                                                                @if($jb->status == 4 && !empty($jb->st_date) && $jb->interview_status =='0')
                                                                    <a href="{{ route('admin.interview.status', [$jb->id, '2']) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure.?')">Rejected</a>                  
                                                                    <button type="button" class="btn btn-warning btn-sm inter-btn" data-id="{{ $jb->id }}" data-user="{{ $jb->user->name }}" data-toggle="modal" data-target="#selectionModal">Selected</button>
                                                                @endif

                                                                @if($jb->status == 4 && !empty($jb->st_date) && $jb->interview_status =='1')
                                                                    <a href="{{ route('admin.interview.status', [$jb->id, '1']) }}" class="btn btn-success btn-sm" onclick="return confirm('Are you sure.?')">Selected</a>
                                                                @endif

                                                                @if($jb->status == 5)
                                                                    <a href="{{ route('admin.job.status', [$jb->id, '6']) }}" class="btn btn-info btn-sm" onclick="return confirm('Are you sure.?')">Joined</a>
                                                                @endif

                                                                @if($jb->status == 6)
                                                                    <a href="#" class="btn btn-info btn-sm" onclick="return confirm('Are you sure.?')">Generate Invoice</a>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{ $jb->st_date }} {{ $jb->st_time }}
                                                            </td>
                                                            <td>
                                                                @if(!empty($jb->offer_letter))
                                                                    <a href="{{ asset($jb->offer_letter) }}">PDF</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="6"></td></tr>
                                                    @endforelse                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    {{-- interview schdule --}}
    <div class="modal fade" id="interviewModal" tabindex="-1" role="dialog" aria-labelledby="interviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Interview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="inter-frm-data" action="{{ route('admin.store.interview') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_mg_id" id="job_mg_id" class="job_mg_id" value="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Title <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="title" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="email" class="form-control" placeholder="Enter ..." name="email" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>CC Email (optional) <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="email" class="form-control" placeholder="Enter ..." name="cc_email" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="date" class="form-control" placeholder="Enter ..." name="st_date" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Time<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="time" class="form-control" placeholder="Enter ..." name="st_time" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="date" class="form-control" placeholder="Enter ..." name="ed_date" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Time<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="time" class="form-control" placeholder="Enter ..." name="ed_time" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Meating Url<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="meating_url" value="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="inter_send">Send Calender</button>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="inter-error-msg"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- selection model --}}
    <div class="modal fade" id="selectionModal" tabindex="-1" role="dialog" aria-labelledby="interviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details for Joining Letter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="selection-frm-data" action="{{ route('admin.store.letter') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_mg_id" id="job_mg_id" class="job_mg_id" value="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="user_name" id="user_name" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>File choose for ID card (Aadhar , Passport) <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="file" class="form-control" placeholder="Enter ..." name="id_card" id="id_card" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>File choose (.pdf of offer letter) <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="file" class="form-control" placeholder="Enter ..." name="offer_letter" id="offer_letter" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Office Location <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="office_location" id="office_location" value="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <h3>Reporting Person's Details</h3>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="person_name" id="person_name" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contact<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="person_contact" id="person_contact" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="selection_send">Send</button>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="selection-error-msg"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- model --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apply Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="admin-frm-data" action="{{ route('admin.store.profile') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <div class="card">
                            <div class="card-header"><h2>General Form</h2></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>First name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="first_name" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Last name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="last_name" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Mobile phone number <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="contact_number"  value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Home phone number <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="home_phone"  value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="email" class="form-control" placeholder="Enter ..." name="email" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Country <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <select class="form-control" style="width: 100%;" name="country_id" id="country-list">
                                                <option value="">-- Select --</option>
                                                @foreach($country as $ct)
                                                    <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 state-list">
                                        <div class="form-group">
                                            <label>State <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <select class="form-control" style="width: 100%;" name="state_id">
                                                <option value="">-- Select --</option>
                                                @foreach($state as $st)
                                                    <option value="{{ $st->id }}">{{ $st->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Address <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="address" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>City <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="city" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Zip Code <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="zip_code" value="">
                                        </div>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><h2>Work Experience</h2></div>
                            <div class="card-body">                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Company Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="company_name[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Position Title <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="position_title[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Is current position? <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="current_position[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Start Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="date" class="form-control" placeholder="Enter ..." name="start_date[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>End Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="date" class="form-control" placeholder="Enter ..." name="end_date[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Experience In Year <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="number" class="form-control" placeholder="Enter ..." name="exp_year[]" min="0" max="30">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Experience In Month <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="number" class="form-control" placeholder="Enter ..." name="exp_month[]" min="0" max="11">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-primary" id="job-add-experince">Add More</button>
                                    </div>
                                </div>                                
                                <div id="new-experince"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><h2>Education History</h2></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>College Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="college_name[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Degree Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="degree_name[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>University <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="university_name[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Start Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="date" class="form-control" placeholder="Enter ..." name="ed_start_date[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>End Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <input type="date" class="form-control" placeholder="Enter ..." name="ed_end_date[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-primary" id="job-add-education">Add More</button>
                                    </div>
                                </div>
                                <div id="new-education"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><h2>Languages</h2></div>
                            <div class="card-body">
                                <div class="row">                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Written Level <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <select class="form-control" style="width: 100%;" name="lang_speak">
                                                <option value="">-- select --</option>
                                                <option value="Good">Good</option>
                                                <option value="Average">Average</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Spoken Level <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <select class="form-control" style="width: 100%;" name="lang_written">
                                                <option value="">-- select --</option>
                                                <option value="Good">Good</option>
                                                <option value="Average">Average</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Language <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="English" name="user_lang[]">
                                                <label class="form-check-label" for="inlineCheckbox1">English</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Hindi" name="user_lang[]">
                                                <label class="form-check-label" for="inlineCheckbox2">Hindi</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Both" name="user_lang[]">
                                                <label class="form-check-label" for="inlineCheckbox3">Both</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><h2>Upload Resume</h2></div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="myfile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <small class="d-block">In accordance with applicable data protection laws and Lenovo data privacy principles, we request that you remove any Special Categories or Sensitive Personal Data on your resume or CV before applying to any Lenovo positions or our Talent Community.</small>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="checkMe" value="Yes">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary add-podcast-btn">Submit</button>
                                <div class="error-msg"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
