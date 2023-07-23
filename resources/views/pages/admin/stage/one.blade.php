<div class="table-responsive">
    <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
        <thead>
            <tr>
                <th><input name="select_all" value="1" id="select-all" type="checkbox"></th>
                <th>Date</th>
                <th>Employee Name</th>
                <th>Employee Phone</th>
                <th>Position For</th>
                <th>Qualification</th>
                <th>Gender</th>
                <th>Location</th>
                <th>Experience in Year</th>
                <th>Notice Period</th>
                <th>Current Salary</th>
                <th>Attached CV</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jobs as $post)
                <tr data-entry-id="{{ $post->id }}">
                    <td class="ws">
                        <input name="jobm_ids[]" value="{{ $post->id }}" type="checkbox" class="selectone" />
                    </td>
                    <td>{{ date('d/M/Y', strtotime($post->created_at)) }}</td>
                    <td>{{ $post->user->name ?? $post->user->first_name  }}</td>
                    <td>{{ $post->user->contact_number ?? $post->user->home_phone  }}</td>
                    <td>{{ $post->job->title ?? '' }}</td>
                    <td>{{ $post->user->education_list ?? '' }}</td>
                    <td>{{ $post->user->gender ?? ''  }}</td>
                    <td>{{ $post->job->company->address ?? '' }}, {{ $post->job->company->city ?? '' }}, {{ $post->job->company->zip_code ?? '' }}</td>
                    <td>{{ getUserExperince($post->user_id) }} Year</td>
                    <td>{{ $post->user->notice_period ?? ''  }}</td>
                    <td>{{ $post->user->current_ctc ?? ''  }}</td>
                    <td>
                        @if(!empty($post->cv_path))
                            <a href="{{ asset('public/'.$post->cv_path) }}" class="btn btn-success btn-sm" target="_blank">
                                <i class="fa fa-eye"></i> View
                            </a>
                        @else
                            None
                        @endif
                    </td>
                    <td>{{ getStatusType($post->status) }}</td>
                    <td>
                        <a href="{{ route('admin.job.status', [$post->id, '7', Auth::user()->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure.?')">Rejected</a>
                        <a href="{{ route('admin.job.status', [$post->id, '2', Auth::user()->id]) }}" class="btn btn-success btn-sm" onclick="return confirm('Are you sure.?')">Selected</a>
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>