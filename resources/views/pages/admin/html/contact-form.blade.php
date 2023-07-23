<div class="wallet-balance-card-1 d-sm-flex align-items-center justify-content-between">
    <div>
        <h2>Manage Conatact From Data</h2>
    </div>
</div>
        
<div class="row">
    <div class="col-md-12 col-lg-12 mt-3">
        <div class="row" id="donationurl">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company Name</th>
                            <th>Phone Number</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $post)
                            <tr data-entry-id="{{ $post->id }}">
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->email }}</td>
                                <td>{{ $post->company_name }}</td>
                                <td>{{ $post->phone_number }}</td>
                                <td>{{ $post->message }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>          
        </div>
    </div>    
</div>