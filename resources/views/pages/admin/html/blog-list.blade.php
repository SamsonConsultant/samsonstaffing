<div class="card-1 d-sm-flex align-items-center justify-content-between">
    <div>
        <h2>Blog Lists</h2>
    </div>
    <div class="d-flex">
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-Sub-Category"><i class="fa fa-plus" aria-hidden="true"></i> Add New Blog</a>
    </div>
</div>

<div class="row mt-3">
    @forelse($blogs as $blog)
        <div class="col-lg-12 card">
            <div class="row card-body">
                <div class="col-md-4">
                    <div class="feature-card">
                        @if(isset($blog['src_url']) && !empty($blog['src_url']))
                            <img class="img-fluid" src="{{ asset('public') }}/{!! $blog['src_url'] !!}" alt="alternative" style="object-fit: cover; min-height: 233px;">
                        @else
                            <img class="img-fluid" src="{{ asset('public/images/no-image.png') }}" alt="alternative" style="object-fit: cover; min-height: 233px;">
                        @endif                        
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="feature-card-tilte">
                        <h3>{!! $blog['post_title'] !!}</h3>
                    </div>                    
                    <div class="">
                        @if(isset($blog['short_content']) && !empty($blog['short_content']))
                            <p class="card-text f-light text-dark">{!! shorter($blog['short_content'], 150) !!} <a class="blue no-line" href="" target="_blank">...Read more</a></p>
                        @else
                            <p class="card-text f-light text-dark">{!! shorter($blog['full_content'], 150) !!} <a class="blue no-line" href="" target="_blank">Read more</a></p>
                        @endif
                    </div>
                    <div class="feature-card-deatails mt-3">
                        <div>
                            <a class="btn btn-back mr-2" href="{{ route('admin.blogs.edit', $blog['id']) }}"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-back" href="{{ route('admin.page.delete', $blog['id']) }}" onclick="return confirm('Are you sure you want to delete?')"> <i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
    @endforelse
</div>