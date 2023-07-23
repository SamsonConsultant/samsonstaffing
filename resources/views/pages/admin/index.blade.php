@extends('layouts.admin.main')

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
                            
                            <div class="error-msg mt-2"></div>

                            @include('pages.admin.html.'.$template)
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
