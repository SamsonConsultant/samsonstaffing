<div class="wallet-balance-card-1 d-sm-flex align-items-center justify-content-between">
    <div>
        <h2>Manage Location</h2>
    </div>
</div>
        
<div class="row">
    <div class="col-md-12 col-lg-12">
    	<form method="post" id="create-form" action="{{ route('admin.store.location') }}" enctype="multipart/form-data">
            <div class="wallet-balance-card mt-2 p-3">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                    	<label>Name*</label>
                      	<input type="text" name="name" class="form-control crypto-search" placeholder="Enter Name here..." value="{{ old('name', isset($post) ? $post->name : '') }}" required>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <label>Address*</label>
                        <input type="text" name="address" class="form-control crypto-search" placeholder="Enter Address here..." value="{{ old('address', isset($post) ? $post->address : '') }}" required>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <input type="hidden" name="post_id" value="{{ (isset($post)) ? $post->id : '' }}">
                  	<button class="btn btn-new-url add-podcast-btn" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Save</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12 col-lg-12 mt-3">
      	<div class="row" id="donationurl">
        	<div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $key => $role)
                            <tr data-entry-id="{{ $role->id }}">
                                <td></td>
                                <td>
                                    {{ $role->id ?? '' }}
                                </td>
                                <td>
                                    {{ $role->name ?? '' }}
                                </td>
                                <td>
                                    {{ $role->address ?? '' }}
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.manage.locations', $role->id) }}">
                                        <i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Edit
                                    </a>
                                    <a class="btn btn-xs btn-danger" href="{{ route('admin.location.destroy', $role->id) }}" onclick="return confirm('Are you sure you want to delete?')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Delete
                                    </a>                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
  		</div>
	</div>
</div>

@push('js')
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = 'Selected Delete'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.locations.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

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
  $('.datatable-Role:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endpush