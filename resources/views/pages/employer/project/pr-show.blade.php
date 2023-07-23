@extends('layouts.employer')

@section('content')
    
    @include('pages.employer.navigation', ['title' => 'Project'])

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Show Project
                </div>

                <div class="card-body">
                    <div class="mb-2">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <td>
                                        {{ $projects->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Title
                                    </th>
                                    <td>
                                        {{ $projects->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Project ID
                                    </th>
                                    <td>
                                        {{ $projects->uid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Account
                                    </th>
                                    <td>
                                        {{ $projects->company->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Contact
                                    </th>
                                    <td>
                                        {{ $projects->contact->first_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Detail
                                    </th>
                                    <td>
                                        {!! $projects->detail !!}
                                    </td>
                                </tr>
                            </tbody>                
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection