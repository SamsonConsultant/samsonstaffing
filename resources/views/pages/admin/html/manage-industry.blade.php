<div class="wallet-balance-card-1 d-sm-flex align-items-center justify-content-between">
    <div>
        <h2>Manage Industry Type</h2>
    </div>
</div>
        
<div class="row">
    <div class="col-md-12 col-lg-12">
    	<form method="post" id="create-form" action="{{ route('admin.store.data') }}" enctype="multipart/form-data">
            <div class="wallet-balance-card mt-2 p-3">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                    	<label>Title*</label>
                      	<input type="text" name="post_title" class="form-control crypto-search" placeholder="Enter Name here..." value="{{ old('post_title', isset($post) ? $post->post_title : '') }}" required>
                        <input type="hidden" name="post_type" value="industry_type">
                    </div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <input type="hidden" name="post_id" value="{{ (isset($post)) ? $post->id : '' }}">
                    <input type="hidden" id="redirect_url" value="{{ route('admin.manage.industry') }}">
                  	<button class="btn btn-new-url add-podcast-btn" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Save</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12 col-lg-12 mt-3">
        <div class="row" id="donationurl">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr data-entry-id="{{ $post['id'] }}">
                                <td>
                                    {{ $post['id'] }}
                                </td>
                                <td>
                                    {{ $post['post_title'] }}
                                </td>                                
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.manage.industry', $post['id']) }}">
                                        <i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Edit
                                    </a>
                                    <a class="btn btn-xs btn-danger" href="{{ route('admin.destroy', $post['id']) }}" onclick="return confirm('Are you sure you want to delete?')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>          
        </div>
    </div>
</div>