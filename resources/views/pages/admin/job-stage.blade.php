@extends('layouts.admin.main')

@push('css')
<style type="text/css">
    .labelRequiredIcon{
        color: red;
    }
</style>
@endpush

@push('js')
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
        $(document).on('click','#select_all',function(){
            if ($(this).prop('checked')==true){ 
                $(".check_class").attr("checked", true);
            }else{
                $(".check_class").attr("checked", false);
            }
        });
    });
</script>
@endpush

@section('content')

    @include('pages.admin.header')

    <div id="wrapper">
        @include('pages.admin.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <section class="overview-card-list dashboard-data-bg mt-4">
                        <div class="overview-card-body">
                            @include('pages.errors-and-messages')
                            
                            <div class="wallet-balance-card-1 d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h2>Job Stage {{ ucfirst($template) }}</h2>
                                </div>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-Sub-Category" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Apply Job
                                    </button>
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

                                        <div class="text-left mb-2">
                                            <button type="button" class="btn btn-dark" id="mail_send">Send Mail</button>
                                        </div>

                                        @include('pages.admin.stage.'.$template)

                                        <div class="pagination">
                                            {{ $jobs->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    {{-- model --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apply Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('pages.common.apply-job')
                </div>
            </div>
        </div>
    </div>

    @include('pages.common.bulk-mail')
@endsection
