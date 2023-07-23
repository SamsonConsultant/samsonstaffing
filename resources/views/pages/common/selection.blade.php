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
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
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