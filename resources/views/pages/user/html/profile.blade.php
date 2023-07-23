<style type="text/css">
    .labelRequiredIcon{
        color: red;
    }
</style>

@push('js')
<script type="text/javascript">
    $(document).ready(function(){
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

<div class="container card">
    <div class="row card-body">
        <form method="post" id="frm-data" action="{{ route('user.store.profile') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="card">
                <div class="card-header"><h2>General Form</h2></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="first_name" value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="last_name" value="{{ $user->last_name }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Gender <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <select class="form-control" style="width: 100%;" name="gender">
                                    <option value="">-- Select --</option>
                                    <option value="Male" @if($user->gender == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($user->gender == 'Female') selected @endif>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mobile phone number <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="contact_number"  value="{{ $user->contact_number }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Home phone number <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="home_phone"  value="{{ $user->home_phone }}">
                            </div>
                        </div>
                        {{-- <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="email" class="form-control" placeholder="Enter ..." name="email" required value="{{ $user->email }}">
                            </div>
                        </div> --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Country <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <select class="form-control select2" style="width: 100%;" name="country_id" id="country-list">
                                    <option value="">-- Select --</option>
                                    @foreach($country as $ct)
                                        <option value="{{ $ct->id }}" @if($ct->id == $user->country_id) selected @endif>{{ $ct->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 state-list">
                            <div class="form-group">
                                <label>State <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <select class="form-control select2" style="width: 100%;" name="state_id">
                                    <option value="">-- Select --</option>
                                    @foreach($state as $st)
                                        <option value="{{ $st->id }}" @if($st->id == $user->state_id) selected @endif>{{ $st->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="address" value="{{ $user->address }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>City <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="city" value="{{ $user->city }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Zip Code <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="zip_code" value="{{ $user->zip_code }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Current CTC<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="current_ctc"  value="{{ $user->current_ctc }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Notice Period<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="notice_period"  value="{{ $user->notice_period }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">Work Experience</h2>
                    <button type="button" class="btn btn-primary float-right" id="add-experince">Add More</button>
                </div>
                <div class="card-body">
                    @forelse($user_exp as $exp)
                        <div id="inputFormRow" class="row">
                            <input type="hidden" name="exp_id[]" value="{{ $exp->id }}">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Company Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="company_name[]" value="{{ $exp->company_name }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Position Title <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="position_title[]" value="{{ $exp->position_title }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Is current position? <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="current_position[]" value="{{ $exp->current_position }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="date" class="form-control" placeholder="Enter ..." name="start_date[]" value="{{ $exp->start_date }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="date" class="form-control" placeholder="Enter ..." name="end_date[]" value="{{ $exp->end_date }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Experience In Year <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="number" class="form-control" placeholder="Enter ..." name="exp_year[]" min="0" max="30" value="{{ $exp->exp_year }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Experience In Month <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="number" class="form-control" placeholder="Enter ..." name="exp_month[]" min="0" max="11" value="{{ $exp->exp_month }}">
                                </div>
                            </div>
                        </div>
                    @empty
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
                        </div>
                    @endforelse                        
                    <div id="new-experince"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">Education History</h2>
                    <button type="button" class="btn btn-primary float-right" id="add-education">Add More</button>
                </div>
                <div class="card-body">
                    @forelse($user_edu as $edu)
                        <div id="eduFormRow" class="row">
                            <input type="hidden" name="edu_id[]" value="{{ $edu->id }}">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>College Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="college_name[]" value="{{ $edu->college_name }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Degree Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="degree_name[]" value="{{ $edu->degree_name }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>University <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter ..." name="university_name[]" value="{{ $edu->university_name }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="date" class="form-control" placeholder="Enter ..." name="ed_start_date[]" value="{{ $edu->start_date }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                    <input type="date" class="form-control" placeholder="Enter ..." name="ed_end_date[]" value="{{ $edu->end_date }}">
                                </div>
                            </div>                                
                        </div>
                    @empty
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
                        </div>
                    @endforelse
                    <div id="new-education"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h2>Languages</h2></div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $lang = explode(',', $user->user_lang);
                        @endphp
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Written Level <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <select class="form-control select2" style="width: 100%;" name="lang_speak">
                                    <option value="">-- select --</option>
                                    <option value="Good" @if($user->lang_written == 'Good') selected @endif>Good</option>
                                    <option value="Average" @if($user->lang_written == 'Average') selected @endif>Average</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Spoken Level <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <select class="form-control select2" style="width: 100%;" name="lang_written">
                                    <option value="">-- select --</option>
                                    <option value="Good" @if($user->lang_written == 'Good') selected @endif>Good</option>
                                    <option value="Average" @if($user->lang_written == 'Average') selected @endif>Average</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Language <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="English" name="user_lang[]" @if(in_array('English', $lang)) checked @endif>
                                    <label class="form-check-label" for="inlineCheckbox1">English</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Hindi" name="user_lang[]" @if(in_array('Hindi', $lang)) checked @endif>
                                    <label class="form-check-label" for="inlineCheckbox2">Hindi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Both" name="user_lang[]" @if(in_array('Both', $lang)) checked @endif>
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