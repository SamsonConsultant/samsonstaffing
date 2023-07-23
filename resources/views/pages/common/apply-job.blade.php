<form method="post" id="admin-frm-data" action="{{ route('admin.store.profile') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header"><h2>General Form</h2></div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Job Title <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                        <select class="form-control" style="width: 100%;" name="job_id" id="country-list">
                            <option value="">-- Select --</option>
                            @foreach($all_job as $jb)
                                <option value="{{ $jb->id }}">{{ $jb->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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
                        <label>Gender <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                        <select class="form-control" style="width: 100%;" name="gender">
                            <option value="">-- Select --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Current CTC<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                        <input type="text" class="form-control" placeholder="Enter ..." name="current_ctc"  value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Notice Period<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                        <input type="text" class="form-control" placeholder="Enter ..." name="notice_period"  value="">
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