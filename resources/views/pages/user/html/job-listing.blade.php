<div class="container card">
    <div class="row card-body">        
        <div class="col-md-12 pt-4 second-section-row-5">
            <h4 class="d-flex align-items-center">Postions I have applied to</h4>
            <p class="mt-3">If you would like to make updates to your profile after application, please use the Update your Profile feature at the top of the page directly vs. withdrawing your application and re-applying for the position.</p>
            <table class="mb-4">
                <thead>
                    <tr>
                        <th>POSITION</th>
                        <th>Project</th>
                        <th>Apply Date</th>
                        <th>STATUS</th>
                        <th>CV Attachment</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($all_job as $job)
                        <tr>
                            <td class="table-col">{{ $job->job->title }}</td>
                            <td class="table-col">{{ $job->job->project->title }}</td>
                            <td>{{ date('Y-m-d', strtotime($job->created_at)) }}</td>
                            <td>{{ getStatusType($job->status) }}</td>
                            <td class="table-col">
                                <a href="{{ asset($job->cv_path) }}" target="_blank">View</a> | 
                                <a href="{{ asset($job->cv_path) }}" download="w3logo">
                                    Download
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