@extends('layouts.employer')

@section('content')
    
    @include('pages.employer.navigation', ['title' => 'Jobs'])

    <div class="content">
        <div class="container-fluid">
            <div style="margin-bottom: 10px;" class="row">
                {{-- <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route("employer.jobs.create") }}">
                        <i class="fa fa-plus"></i> Add Job
                    </a>
                </div> --}}
            </div>

            <div class="card">
                <div class="card-header">Job Lists</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Category table-sm">
                            <thead>
                                <th width="10"></th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Account Name</th>
                                <th>Contact Name</th>
                                <th>Experience</th>
                                <th>Industry Type</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @forelse($jobs as $job)
                                    <tr data-entry-id="{{ $job->id }}">
                                        <td></td>
                                        <td>{{ $job->id ?? '' }}</td>
                                        <td>{{ $job->title ?? '' }}</td>
                                        <td>{{ $job->company->title ?? '' }}</td>
                                        <td>{{ $job->project->contact->first_name ?? '' }} {{ $job->project->contact->last_name ?? '' }}</td>
                                        <td>{{ $job->exp_year }} Year {{ $job->exp_month }} Month</td>
                                        <td>{{ $job->industry_type ?? '' }}</td>
                                        {{-- <td>{{ $job->role ?? '' }}</td> --}}
                                        <td>
                                            @if($job->status == 1)
                                                <span class="badge badge-success">Approve</span>
                                            @else
                                                <span class="badge badge-danger">Disapprove</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" href="{{ route('employer.jobs.show', $job->id) }}">
                                                <i class="fa fa-eye"></i> View
                                            </a>

                                            {{-- <a class="btn btn-xs btn-info" href="{{ route('employer.jobs.create', $job->id) }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a class="btn btn-xs btn-danger" href="{{ route('employer.jobs.destroy', $job->id) }}" onclick="return confirm('are you confirm.');">
                                                <i class="fa fa-trash"></i> DELETE
                                            </a> --}}
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
    </div>

@endsection

@push('js')
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let deleteButtonTrans = 'Deleted'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.jobs.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
              var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                  return $(entry).data('entry-id')
              });

              if (ids.length === 0) {
                alert('Zero selected')

                return
              }

              if (confirm('are you sure')) {
                $.ajax({
                  headers: {'x-csrf-token': _token},
                  method: 'POST',
                  url: config.url,
                  data: { ids: ids, _method: 'DELETE' }})
                  .done(function () { location.reload() })
              }
            }
        }
        dtButtons.push(deleteButton)

        $.extend(true, $.fn.dataTable.defaults, {
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });

        $('.datatable-Category:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    });
</script>
@endpush