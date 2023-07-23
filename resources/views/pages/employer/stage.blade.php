@extends('layouts.employer')

@push('css')
<style type="text/css">
    .labelRequiredIcon{
        color: red;
    }
</style>
@endpush

@section('content')
    
    @include('pages.employer.navigation', ['title' => 'Job Stage'])

    <div class="content">
        <div class="container-fluid">            
            <div class="card">
                <div class="card-header">
                    Job Lists                    
                </div>                
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title">Search</h5>
                </div>
                <div class="card-body">
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="s" class="form-control" placeholder="Enter employee name or email" value="{{ Request::get('s') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="a" class="form-control">
                                        <option value="">-- Choose Account --</option>
                                        @forelse($account as $ac)
                                            <option value="{{ $ac->id }}" @if($ac->id == Request::get('a')) selected @endif>{{ $ac->title }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="c" class="form-control">
                                        <option value="">-- Choose Contact --</option>
                                        @forelse($contact as $cc)
                                            <option value="{{ $cc->id }}" @if($cc->id == Request::get('c')) selected @endif>{{ $cc->first_name }} {{ $cc->first_name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="p" class="form-control">
                                        <option value="">-- Choose Project --</option>
                                        @forelse($project as $pr)
                                            <option value="{{ $pr->id }}" @if($pr->id == Request::get('p')) selected @endif>{{ $pr->title }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-sm">Search</button>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <a href="{{ url('/') }}/admin/job/stage/{{ $template }}" class="btn btn-dark btn-sm">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title">List</h5>
                </div>
                <div class="card-body">
                    @if(!empty($jobs))
                        <div class="alert alert-primary mt-3">
                            <b>Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of total {{$jobs->total()}} entries</b>
                        </div>
                        @include('pages.employer.stage.'.$template)
                        <div class="pagination">
                            {{ $jobs->links() }}
                        </div>
                    @endif
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
        // dtButtons.push(deleteButton)

        $.extend(true, $.fn.dataTable.defaults, {
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });

        // $('.datatable-Role:not(.ajaxTable)').DataTable({ buttons: dtButtons });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('change','#country-list',function(){
            let id = $(this).val();
            $.ajax({
                type:'get',
                url : "{{ route('admin.country.state') }}",
                data:{country_id:id},
                dataType : 'json',
                success : function(data){
                    $(".state-list").replaceWith(data.html);
                }
            })
        });
    });
</script>
@endpush