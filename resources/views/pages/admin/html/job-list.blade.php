<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.jobs.create") }}">
            <i class="fa fa-plus"></i> Add Job
        </a>
    </div>
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
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.jobs.show', $job->id) }}">
                                    View
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.jobs.edit', $job->id) }}">
                                    Edit
                                </a>
                                <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('are you confirm.');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


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