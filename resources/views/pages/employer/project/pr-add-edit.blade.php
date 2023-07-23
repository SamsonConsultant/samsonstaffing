@extends('layouts.employer')

@section('content')
    
    @include('pages.employer.navigation', ['title' => 'Project Add / Edit'])

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Project</h4>

                    <a style="margin-top:20px;" class="btn btn-default" href="{{ route('employer.projects.index') }}">
                        Back to List
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route("employer.projects.store") }}" method="POST" enctype="multipart/form-data" id="admin-form">
                        @csrf
                        <input type="hidden" name="redirect_url" id="redirect_url" value="{{ route('employer.projects.index') }}">
                        @if(isset($projects))
                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                        @endif

                        <div class="row">

                            <div class="col-md-6 form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">Title*</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($projects) ? $projects->title : '') }}" required>
                                @if($errors->has('title'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </em>
                                @endif
                                <p class="helper-block"></p>
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('uid') ? 'has-error' : '' }}">
                                <label for="uid">Project ID*</label>
                                <input type="text" id="uid" name="uid" class="form-control" value="{{ old('uid', isset($projects) ? $projects->uid : mt_rand(0,9999)) }}" required>
                                @if($errors->has('uid'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('uid') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('account_id') ? 'has-error' : '' }}">
                                <label for="account_id">Account</label>
                                <select name="account_id" class="form-control" required>
                                    <option value="">-- Select --</option>
                                    @forelse($companies as $com)
                                        <option value="{{ $com->id }}" @if(isset($projects) && $com->id == $projects->account_id) selected @endif>{{ $com->title }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @if($errors->has('account_id'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('account_id') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('contact_id') ? 'has-error' : '' }}">
                                <label for="contact_id">Contact</label>
                                <select name="contact_id" class="form-control" required>
                                    <option value="">-- Select --</option>
                                    @forelse($contacts as $con)
                                        <option value="{{ $con->id }}" @if(isset($projects) && $con->id == $projects->contact_id) selected @endif>{{ $con->first_name }} {{ $con->last_name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @if($errors->has('contact_id'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('contact_id') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-12 form-group {{ $errors->has('detail') ? 'has-error' : '' }}">
                                <label for="detail">Project Details</label>
                                <textarea id="detail" name="detail" class="form-control ckeditor">{{ old('detail', isset($projects) ? $projects->detail : '') }}</textarea>
                                @if($errors->has('detail'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('detail') }}
                                    </em>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                <button class="btn btn-danger add-podcast-btn" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection