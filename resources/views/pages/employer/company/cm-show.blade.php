@extends('layouts.employer')

@section('content')
    
    @include('pages.employer.navigation', ['title' => 'Account Add / Edit'])

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Show Account
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
                                        {{ $company->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Account ID
                                    </th>
                                    <td>
                                        {{ $company->uid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Title
                                    </th>
                                    <td>
                                        {{ $company->title }}
                                    </td>
                                </tr>                                
                                <tr>
                                    <th>
                                        Account Type
                                    </th>
                                    <td>
                                        {{ $company->account_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Customer Since
                                    </th>
                                    <td>
                                        {{ $company->customer_since }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Account Address
                                    </th>
                                    <td>
                                        {{ $company->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Detail
                                    </th>
                                    <td>
                                        {!! $company->detail !!}
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