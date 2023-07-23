<div class="wallet-balance-card-1 d-sm-flex align-items-center justify-content-between">
    <div>
        <h2>Add Reviews</h2>
    </div>
</div>
        

<div class="row">
    <div class="col-md-12 col-lg-12">
    	<form method="post" id="create-form" action="{{ route('admin.store.review') }}" enctype="multipart/form-data">
            <div class="wallet-balance-card mt-2 p-3">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                    	<label>Name</label>
                      	<input type="text" name="post_title" class="form-control crypto-search" placeholder="Enter Name here..." value="{{ old('post_title', isset($post) ? $post->post_title : '') }}">
                    </div>
                    <div class="col-md-6 col-lg-6">
                    	<label>Address</label>
                      	<input type="text" name="short_content" class="form-control crypto-search" placeholder="Enter Address here..." value="{{ old('short_content', isset($post) ? $post->short_content : '') }}">
                    </div>
                    <div class="col-md-6 col-lg-6 mt-2">
                    	<label>Client Picture</label>
                      	<input type="file" id="myfile" name="myfile" placeholder="Upload Icon" class="form-control">
                    </div>
                    <div class="col-md-6 col-lg-6 mt-2">
                    	<label>Rating</label>
                      	<input type="text" id="rating" name="rating" class="form-control" value="{{ old('rating', isset($post) ? get_post_extra($post->id,'rating') : '') }}">
                    </div>
                    <div class="col-md-12 col-lg-12 mt-2">
                    	<label>About Client</label>
                      	<textarea name="full_content" class="form-control ckeditor" rows="5">{!! old('full_content', isset($post) ? $post->full_content : '') !!}</textarea>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <a class="btn btn-new-url-outline" href="{{ route('admin.manage.review') }}"><i class="fa fa-arrow-left" aria-hidden="true"> &nbsp;</i>Back</a>
                  	<button class="btn btn-new-url add-podcast-btn" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>