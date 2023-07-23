<div class="card">
    <div class="card-header">
        Show Contact
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $contact->id }}</td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>{{ $contact->first_name }}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ $contact->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $contact->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $contact->phone_code ?? '' }}{{ $contact->phone }}</td>
                    </tr>
                    <tr>
                        <th>Contact ID</th>
                        <td>{{ $contact->uid }}</td>
                    </tr>                    
                    <tr>
                        <th>Contact Detail</th>
                        <td>{!! $contact->detail !!}</td>
                    </tr>
                </tbody>                
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                Back to List
            </a>
            @if(isEmployer($contact->email) == 'No')
                <a style="margin-top:20px;" class="btn btn-dark" href="{{ route('admin.create.user', $contact->id) }}" onclick="return confirm('Are you sure.?');">
                    Create a Employer
                </a>
            @endif
        </div>
    </div>
</div>