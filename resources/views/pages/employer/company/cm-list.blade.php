@extends('layouts.employer')

@section('content')
    
    @include('pages.employer.navigation', ['title' => 'Account'])

    <div class="content">
        <div class="container-fluid">
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route("employer.companies.create") }}">
                        <i class="fa-fw fas fa-plus"></i> Add Account
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Account List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable datatable-Category table-sm">
                            <thead>
                                <th width="10"></th>
                                <th>ID</th>
                                <th>Account ID</th>
                                <th>Title</th>
                                <th>Account Type</th>
                                <th>Customer Since</th>
                                <th>Account Address</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @forelse($companies as $key => $company)
                                    <tr data-entry-id="{{ $company->id }}">
                                        <td></td>
                                        <td>{{ $company->id ?? '' }}</td>
                                        <td>{{ $company->uid ?? '' }}</td>
                                        <td>{{ $company->title ?? '' }}</td>
                                        <td>{{ $company->account_type ?? '' }}</td>
                                        <td>{{ $company->customer_since ?? '' }}</td>
                                        <td>{{ $company->address ?? '' }}</td>
                                        <td>
                                            @if($company->status == 1)
                                                <span class="badge badge-success">Approve</span>
                                            @else
                                                <span class="badge badge-danger">Disapprove</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" href="{{ route('employer.companies.show', $company->id) }}">
                                                <i class="fa fa-eye"></i> View
                                            </a>

                                            <a class="btn btn-xs btn-info" href="{{ route('employer.companies.create', $company->id) }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <a class="btn btn-xs btn-danger" href="{{ route('employer.companies.destroy', $company->id) }}" onclick="return confirm('are you confirm.');">
                                                <i class="fa fa-trash"></i> DELETE
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
    </div>

@endsection

@push('js')
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let deleteButtonTrans = 'Deleted'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.companies.massDestroy') }}",
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