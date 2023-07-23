<div class="card">
    <div class="card-header">
        Show Job
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $job->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Title
                        </th>
                        <td>
                            {{ $job->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Experience
                        </th>
                        <td>
                            {{ $job->exp_year }} Year {{ $job->exp_month }} Month
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Job description
                        </th>
                        <td>
                            {!! $job->job_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Education
                        </th>
                        <td>
                            {{ $job->education }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Industry Type
                        </th>
                        <td>
                            {{ $job->industry_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Functional Area
                        </th>
                        <td>
                            {{ $job->functional_area }}
                        </td>
                    </tr>                    
                    <tr>
                        <th>
                            Key Skills
                        </th>
                        <td>
                            {!! $job->key_skills !!}
                        </td>
                    </tr>
                </tbody>                
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                Back to List
            </a>
        </div>
    </div>
</div>