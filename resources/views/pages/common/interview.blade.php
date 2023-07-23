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
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Title <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="title" value="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>To Email <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="email" class="form-control" placeholder="Enter ..." name="email" id="to_email" value="">
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
                                <label>From Email<span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
                                <input type="email" class="form-control" placeholder="Enter ..." name="fr_email" id="fr_email" value="">
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