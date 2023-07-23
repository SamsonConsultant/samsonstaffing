<div class="wallet-balance-card-1 d-sm-flex align-items-center justify-content-between">
    <div>
        <h2>Manage Reviews</h2>
    </div>
    <div class="d-flex">
        <a href="{{ route('admin.add.review') }}" class="btn btn-Sub-Category"><i class="fa fa-plus" aria-hidden="true"></i> Add Review</a>
    </div>
</div>
        

<div class="row">    
    <div class="col-md-12 col-lg-12 mt-3">
      	<div class="row" id="donationurl">
        	{{-- <div class="col-lg-12 color-black"><h6>Live Donation URL</h6></div> --}}
        	@forelse($posts as $post)
				<div class="col-lg-3 col-md-6 text-center mt-2" data-aos="zoom-in" data-aos-delay="100" style="position: relative;">
                    <div class="donation-thumbnail">
    		  			@if(!empty($post['src_url']))
    		  				<img src="{{ asset('public') }}/{{ $post['src_url'] }}" class="donation-cardImg img-thumbnail">
    		  			@else
    		  				<img src="{{ asset('public/assets/img/sorry-no-image.png') }}" class="donation-cardImg img-thumbnail">            		  				
    		  			@endif                		  			
                    </div>
                    <p class="card-name"><a class="donations-url" href="{{ $post['short_content'] }}" target="_blank">{{ $post['post_title'] }}</a></p>
                    <div class="d-flex justify-content-between">
    		  			<div class="edit-link-sm-card">
    		  				<a class="url-edit" href="{{ route('admin.manage.review', $post['id']) }}">
                                <i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Edit
                            </a>
    		  			</div>
			  				<a class="url-delete" href="{{ route('admin.destroy', $post['id']) }}" onclick="return confirm('Are you sure you want to delete?')">
	                            <i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Delete
	                        </a>                                    
                    </div>
				</div>
        	@empty
        	@endforelse
  		</div>
	</div>
</div>