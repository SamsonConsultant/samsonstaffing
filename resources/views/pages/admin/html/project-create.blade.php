@push('js')
<script type="text/javascript">
$(document).ready(function() {    
    $(document).on('change','#client_id',function(){
        $('#dly').show();
        var element = $(this).find('option:selected'); 
        var id = element.attr("value");
        $.ajax({
            type:'post',
            url : "{{ route('admin.contact.list') }}",
            data:{account_id:id},
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

<div class="card">
    <div class="card-header">
        <h4>Create Project</h4>

        <a style="margin-top:20px;" class="btn btn-default" href="{{ route('admin.projects.index') }}">
            Back to List
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.projects.store") }}" method="POST" enctype="multipart/form-data" id="admin-form">
            @csrf
            <input type="hidden" name="redirect_url" id="redirect_url" value="{{ route('admin.projects.index') }}">
            <div class="row">
                <div class="col-md-6 form-group {{ $errors->has('uid') ? 'has-error' : '' }}">
                    <label for="uid">Project ID*</label>
                    <input type="text" id="uid" name="uid" class="form-control" value="{{ old('uid', isset($projects) ? $projects->uid : mt_rand(0,9999)) }}" required>
                    @if($errors->has('uid'))
                        <em class="invalid-feedback">
                            {{ $errors->first('uid') }}
                        </em>
                    @endif
                </div>

                <div class="col-md-6 form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Project Name*</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($projects) ? $projects->title : '') }}" required>
                    @if($errors->has('title'))
                        <em class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </em>
                    @endif
                    <p class="helper-block"></p>
                </div>

                <div class="col-md-6 form-group {{ $errors->has('account_id') ? 'has-error' : '' }}">
                    <label for="account_id">Account <span id="dly" style="color: red; display: none;">Loading...</span></label>
                    <select name="account_id" class="form-control" required id="client_id">
                        <option value="">-- Select --</option>
                        @forelse($companies as $com)
                            <option value="{{ $com->id }}">{{ $com->title }}</option>
                        @empty
                        @endforelse
                    </select>
                    @if($errors->has('account_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('account_id') }}
                        </em>
                    @endif
                </div>

                <div class="col-md-6 form-group {{ $errors->has('contact_id') ? 'has-error' : '' }} carrier_product">
                    <label for="contact_id">Contact</label>
                    <select name="contact_id" class="form-control" required>
                        <option value="">-- Select --</option>
                        @forelse($contacts as $con)
                            <option value="{{ $con->id }}">{{ $con->first_name }} {{ $con->last_name }}</option>
                        @empty
                        @endforelse
                    </select>
                    @if($errors->has('contact_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('contact_id') }}
                        </em>
                    @endif
                </div>

                <div class="col-md-12 form-group {{ $errors->has('detail') ? 'has-error' : '' }}">
                    <label for="detail">Project Details</label>
                    <textarea id="detail" name="detail" class="form-control ckeditor">{{ old('detail', isset($projects) ? $projects->detail : '') }}</textarea>
                    @if($errors->has('detail'))
                        <em class="invalid-feedback">
                            {{ $errors->first('detail') }}
                        </em>
                    @endif
                </div>
                
                <div class="col-md-6">
                    <button class="btn btn-danger add-podcast-btn" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>