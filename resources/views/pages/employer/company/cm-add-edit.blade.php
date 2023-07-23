@extends('layouts.employer')

@section('content')
    
    @include('pages.employer.navigation', ['title' => 'Account Add / Edit'])

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Create Account</h4>
                    <a style="margin-top:20px;" class="btn btn-default" href="{{ route('employer.companies.index') }}">
                        Back to List
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route("employer.companies.store") }}" method="POST" enctype="multipart/form-data" id="admin-form">
                        @csrf
                        <input type="hidden" name="redirect_url" id="redirect_url" value="{{ route('employer.companies.index') }}">
                        @if(isset($company))
                            <input type="hidden" name="company_id" value="{{ $company->id }}">
                        @endif

                        <div class="row">
                            <div class="col-md-6 form-group {{ $errors->has('uid') ? 'has-error' : '' }}">
                                <label for="uid">Account ID*</label>
                                <input type="text" id="uid" name="uid" class="form-control" value="{{ old('uid', isset($company) ? $company->uid : mt_rand(0,9999)) }}" required>
                                @if($errors->has('uid'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('uid') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">Title*</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($company) ? $company->title : '') }}" required>
                                @if($errors->has('title'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </em>
                                @endif
                                <p class="helper-block"></p>
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('account_type') ? 'has-error' : '' }}">
                                <label for="account_type">Account Type*</label>
                                <select name="account_type" class="form-control">
                                    <option value="">-- Select --</option>
                                    @forelse($posts as $post)
                                        <option value="{{ $post['post_title'] }}" @if(isset($company) && $company->account_type == $post['post_title']) selected @endif>{{ $post['post_title'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @if($errors->has('account_type'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('account_type') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('customer_since') ? 'has-error' : '' }}">
                                <label for="customer_since">Customer Since*</label>
                                <input type="text" id="customer_since" name="customer_since" class="form-control" value="{{ old('customer_since', isset($company) ? $company->customer_since : '') }}" required>
                                @if($errors->has('customer_since'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('customer_since') }}
                                    </em>
                                @endif
                                <p class="helper-block"></p>
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                                <label for="country_id">Country*</label>                    
                                <select name="country_id" class="form-control select2" id="country-list">
                                    <option value="">-- Select --</option>
                                    @foreach($country as $ct)
                                        <option value="{{ $ct->id }}" @if(isset($company) && $ct->id == $company->country_id) selected @endif>{{ $ct->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('country_id'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('country_id') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('state_id') ? 'has-error' : '' }} state-list">
                                <label for="state_id">State*</label>                    
                                <select name="state_id" class="form-control select2">
                                    <option value="">-- Select --</option>
                                    @foreach($state as $st)
                                        <option value="{{ $st->id }}" @if(isset($company) && $st->id == $company->state_id) selected @endif>{{ $st->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('state_id'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('state_id') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" class="form-control" value="{{ old('city', isset($company) ? $company->city : '') }}" required>
                                @if($errors->has('city'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('city') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                                <label for="zip_code">Zip Code</label>
                                <input type="text" id="zip_code" name="zip_code" class="form-control" value="{{ old('zip_code', isset($company) ? $company->zip_code : '') }}" required>
                                @if($errors->has('zip_code'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('zip_code') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('phone_code') ? 'has-error' : '' }}">
                                <label for="phone_code">Phone Code*</label>                    
                                <select name="phone_code" class="form-control select2">
                                    <option value="">-- Select --</option>
                                    @foreach($country as $ct)
                                        <option value="{{ $ct->phonecode }}" @if(isset($company) && $ct->phonecode == $company->phone_code) selected @endif>{{ $ct->name }} ({{ $ct->phonecode }})</option>
                                    @endforeach
                                </select>
                                @if($errors->has('phone_code'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('phone_code') }}
                                    </em>
                                @endif
                                <p class="helper-block"></p>
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label for="phone">Phone*</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($company) ? $company->phone : '') }}" required>
                                @if($errors->has('phone'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </em>
                                @endif
                                <p class="helper-block"></p>
                            </div>

                            <div class="col-md-6 form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($company) ? $company->address : '') }}" required>
                                @if($errors->has('address'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </em>
                                @endif
                            </div>

                            <div class="col-md-12 form-group {{ $errors->has('detail') ? 'has-error' : '' }}">
                                <label for="detail">Account Details</label>
                                <textarea id="detail" name="detail" class="form-control ckeditor">{{ old('detail', isset($company) ? $company->detail : '') }}</textarea>
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

@push('js')
<script type="text/javascript">
    $(document).ready(function(){
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