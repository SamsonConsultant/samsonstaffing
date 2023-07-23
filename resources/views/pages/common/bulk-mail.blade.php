<div class="modal fade" id="bulkMail" tabindex="-1" role="dialog" aria-labelledby="bulkMailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bulk Mail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="send-bulk-mail" action="{{ route('admin.send.bulk.mail') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="items_id" id="items_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <label>To Email</label>
                            <div class="form-group">
                                <input type="text" name="to_email" value="" class="form-control" value="">
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <label>Cc Email</label>
                            <div class="form-group">
                                <input type="text" name="cc_email" value="" class="form-control" value="">
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <label>Subject</label>
                            <div class="form-group">
                                <input type="text" name="subject" value="" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Body Content</label>
                            <div class="form-group">
                                <textarea name="body" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            @foreach(getMailFormate() as $k => $m)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="{{ $m }}" name="mail_format[]">
                                    <label for="{{ $m }}">{{ $m }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="bulk_mail_send">Send</button>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mail-error-msg"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>