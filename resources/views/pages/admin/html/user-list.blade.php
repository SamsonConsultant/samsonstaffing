<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.users.create") }}">
            Add User
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">User List</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Email Verified At</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th>Approve/Disapprove</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td></td>
                            <td>{{ $user->id ?? '' }}</td>
                            <td>{{ $user->name ?? '' }}</td>
                            <td>{{ $user->email ?? '' }}</td>
                            <td>{{ $user->email_verified_at ?? '' }}</td>
                            <td>
                                @forelse($user->roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->role_name }}</span>
                                @empty
                                    @php
                                        if($user->role->role_name == 'Employer'){
                                            $cl = 'badge-dark';
                                        } elseif($user->role->role_name == 'Admin'){
                                            $cl = 'badge-warning';
                                        } else {
                                            $cl = 'badge-info';
                                        }
                                    @endphp                                    

                                    <span class="badge {{ $cl }}">{{ $user->role->role_name ?? '' }}</span>
                                @endforelse
                            </td>
                            <td>
                                @if($user->status == 1)
                                    <span class="badge badge-success">Approve</span>
                                @else
                                    <span class="badge badge-danger">Disapprove</span>
                                @endif
                            </td>
                            <td>
                                @if($user->status == 1)
                                    <a href="{{ route('admin.users.inactive', $user->id) }}">
                                        <span class="badge badge-danger">Disapprove</span>
                                    </a>
                                @else
                                    <a href="{{ route('admin.users.active', $user->id) }}">
                                        <span class="badge badge-success">Approve</span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                    view
                                </a>                                
                                <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                    edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('are you confirm');" style="display: inline-block;">
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
            url: "{{ route('admin.users.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('Zero selected data');
                    return;
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }
                    })
                    .done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)

        $.extend(true, $.fn.dataTable.defaults, {
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });
        $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
        });
    });
</script>
@endpush