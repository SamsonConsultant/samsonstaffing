<div class="wallet-balance-card-1 d-sm-flex align-items-center justify-content-between">
    <div>
    	<h2>Edit Blog</h2>
    </div>
    <div class="d-flex">
        <button class="btn btn-back" onclick="window.location.href='{{ route('admin.blogs.index') }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button>
    </div>
</div>
<div class="row">
	<form method="post" id="create-form" action="{{ route('admin.page.store') }}" enctype="multipart/form-data">
		<div class="modal-body">
			<div class="row personal-details-input-1">
	  			<div class="row add-container">
	  				<div class="col-md-12">
	  					<label>Title</label>
	  					<input type="text" name="post_title" placeholder="Title" class="form-control" value="{{ $page->post_title }}">
	  				</div>
	    			<div class="col-md-12 mt-3">
	    				<label>Short Description</label>
	    				<textarea class="form-control" name="short_content" id="short_content">{!! $page->short_content !!}</textarea>
	    			</div>
	    			<div class="col-md-12 mt-3">
	    				<label>Long Description</label>
	    				<textarea class="form-control" name="full_content" id="full_content">{!! $page->full_content !!}</textarea>
	    			</div>
	    			<div class="col-md-12 mt-2">
	    				<div class="wallet-balance-card mt-3">
	    					<label>Thumbnail</label>
	    					<input type="file" id="myfile" name="myfile" placeholder="Upload Icon" class="mt-4 w-100 form-control">
	    					@if(!empty($page->src_url))
	    						<img src="{{ asset('public') }}/{{ $page->src_url }}" class="img-thumbnail mt-3" width="150">
	    					@endif
	    				</div>
	    			</div>
	  			</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="hidden" name="post_id" value="{{ $page->id }}">			
			<input type="hidden" name="post_type" value="blog">			
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
       	    });
	    });	    
	</script>
@endpush