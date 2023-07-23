<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.projects.create") }}">
            <i class="fa-fw fas fa-plus"></i> Add Project
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Project Lists
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Category table-sm">
                <thead>
                    <th width="10"></th>
                    <th>ID</th>
                    <th>Project ID</th>
                    <th>Title</th>
                    <th>Account</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @forelse($projects as $key => $project)
                        <tr data-entry-id="{{ $project->id }}">
                            <td></td>
                            <td>{{ $project->id ?? '' }}</td>
                            <td>{{ $project->uid ?? '' }}</td>
                            <td>{{ $project->title ?? '' }}</td>                            
                            <td>{{ $project->company->title ?? '' }}</td>
                            <td>{{ $project->contact->first_name ?? '' }}</td>
                            <td>
                                @if($project->status == 1)
                                    <span class="badge badge-success">Approve</span>
                                @else
                                    <span class="badge badge-danger">Disapprove</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.projects.show', $project->id) }}">
                                    View
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.projects.edit', $project->id) }}">
                                    Edit
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('are you confirm.');" style="display: inline-block;">
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
            url: "{{ route('admin.projects.massDestroy') }}",
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