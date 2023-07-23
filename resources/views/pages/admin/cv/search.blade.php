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
                                    <h2>Search CV</h2>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Search</h5>
                                </div>
                                <div class="card-body">
                                    <form method="get" action="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="s" class="form-control" placeholder="Enter employee name or email">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger btn-sm">Search</button>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <a href="{{ route('admin.search.cv') }}" class="btn btn-dark btn-sm">Reset</a>
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
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Employee Name</th>
                                                            <th>Employee Phone</th>
                                                            <th>Position For</th>
                                                            <th>Qualification</th>
                                                            <th>Gender</th>
                                                            <th>Location</th>
                                                            <th>Experience in Year</th>
                                                            <th>Notice Period</th>
                                                            <th>Current Salary</th>
                                                            <th>Attached CV</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($jobs as $post)
                                                            <tr data-entry-id="{{ $post->id }}">
                                                                <td>{{ date('d/M/Y', strtotime($post->created_at)) }}</td>
                                                                <td>{{ $post->user->name ?? $post->user->first_name  }}</td>
                                                                <td>{{ $post->user->contact_number ?? $post->user->home_phone  }}</td>
                                                                <td>{{ $post->job->title ?? '' }}</td>
                                                                <td>{{ $post->user->education_list ?? '' }}</td>
                                                                <td>{{ $post->user->gender ?? ''  }}</td>
                                                                <td>{{ $post->job->company->address ?? '' }}, {{ $post->job->company->city ?? '' }}, {{ $post->job->company->zip_code ?? '' }}</td>
                                                                <td>{{ getUserExperince($post->user_id) }} Year</td>
                                                                <td>{{ $post->user->notice_period ?? ''  }}</td>
                                                                <td>{{ $post->user->current_ctc ?? ''  }}</td>
                                                                <td>
                                                                    @if(!empty($post->cv_path))
                                                                        <a href="{{ asset('public/'.$post->cv_path) }}" class="btn btn-success btn-sm" target="_blank">
                                                                            <i class="fa fa-eye"></i> View
                                                                        </a>
                                                                    @else
                                                                        None
                                                                    @endif
                                                                </td>
                                                                <td>{{ getStatusType($post->status) }}</td>                     
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
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
