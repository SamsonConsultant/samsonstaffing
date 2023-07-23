<div class="wallet-balance-card-1 d-sm-flex align-items-center justify-content-between">
    <div>
    	<h2>Add New Page</h2>
    </div>
    <div class="d-flex">
        <button class="btn btn-back" onclick="window.location.href='{{ route('admin.pages') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button>
    </div>
</div>
<div class="row">
	<form method="post" id="create-form" action="{{ route('admin.page.store') }}" enctype="multipart/form-data">
		<div class="modal-body">
			<div class="row personal-details-input-1">
	  			<div class="row add-container">
	  				<div class="col-md-12">
	  					<label>Title</label>
	  					<input type="text" name="post_title" placeholder="Title" class="form-control">
	  				</div>
	    			<div class="col-md-12 mt-3">
	    				<label>Short Description</label>
	    				<textarea class="form-control" name="short_content" id="short_content"></textarea>
	    			</div>
	    			<div class="col-md-12 mt-3">
	    				<label>Long Description</label>
	    				<textarea class="form-control" name="full_content" id="full_content"></textarea>
	    			</div>
	    			<div class="col-md-12 mt-2">
	    				<div class="wallet-balance-card mt-3">
	    					<label>Thumbnail</label>
	    					<input type="file" id="myfile" name="myfile" placeholder="Upload Icon" class="mt-4 w-100 form-control">
	    				</div>
	    			</div>
	  			</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="hidden" name="post_type" value="page">
			<button class="btn btn add-podcast-btn save-data" type="submit">Save</button>
		</div>
	</form>
</div>

@push('js')
	<script type="text/javascript">       	
	    $(document).ready(function() {	       	
	       	CKEDITOR.replace('full_content', {
       	        filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
       	        filebrowserUploadMethod: 'form',
       	        uiColor: '#CCEAEE',
       	        height: 550,
       	    });
	    });	    
	</script>
@endpush