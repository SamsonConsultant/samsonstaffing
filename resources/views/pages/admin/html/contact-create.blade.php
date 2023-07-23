<div class="card">
    <div class="card-header">
        <h4>Create Contact</h4>

        <a style="margin-top:20px;" class="btn btn-default" href="{{ route('admin.contacts.index') }}">
            Back to List
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.contacts.store") }}" method="POST" enctype="multipart/form-data" id="admin-form">
            @csrf
            <input type="hidden" name="redirect_url" id="redirect_url" value="{{ route('admin.contacts.index') }}">
            <div class="row">
                <div class="col-md-6 form-group {{ $errors->has('uid') ? 'has-error' : '' }}">
                    <label for="uid">Contact ID*</label>
                    <input type="text" id="uid" name="uid" class="form-control" value="{{ old('uid', isset($contact) ? $contact->uid : mt_rand(0,9999)) }}" required>
                    @if($errors->has('uid'))
                        <em class="invalid-feedback">
                            {{ $errors->first('uid') }}
                        </em>
                    @endif
                </div>

                <div class="col-md-6 form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="first_name">First Name*</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($contact) ? $contact->first_name : '') }}" required>
                    @if($errors->has('first_name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('first_name') }}
                        </em>
                    @endif
                    <p class="helper-block"></p>
                </div>

                <div class="col-md-6 form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="last_name">Last Name*</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', isset($contact) ? $contact->last_name : '') }}" required>
                    @if($errors->has('last_name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('last_name') }}
                        </em>
                    @endif
                    <p class="helper-block"></p>
                </div>

                <div class="col-md-6 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Email*</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($contact) ? $contact->email : '') }}" required>
                    @if($errors->has('email'))
                        <em class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </em>
                    @endif
                    <p class="helper-block"></p>
                </div>

                <div class="col-md-6 form-group {{ $errors->has('phone_code') ? 'has-error' : '' }}">
                    <label for="phone_code">Phone Code*</label>
                    {{-- <input type="text" id="phone_code" name="phone_code" class="form-control" value="{{ old('phone_code', isset($contact) ? $contact->phone_code : '') }}" required> --}}
                    <select name="phone_code" class="form-control select2">
                        <option value="">-- Select --</option>
                        @foreach($country as $ct)
                            <option value="{{ $ct->phonecode }}">{{ $ct->name }} ({{ $ct->phonecode }})</option>
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
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($contact) ? $contact->phone : '') }}" required>
                    @if($errors->has('phone'))
                        <em class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </em>
                    @endif
                    <p class="helper-block"></p>
                </div>

                <div class="col-md-6 form-group {{ $errors->has('account_id') ? 'has-error' : '' }}">
                    <label for="account_id">Account</label>
                    <select name="account_id" class="form-control" required>
                        <option value="">-- Select --</option>
                        @forelse($companies as $com)
                            <option value="{{ $com->id }}">{{ $com->title }}</option>
                        @empty
                        @endforelse
                    </select>
                    @if($errors->has('account_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('account_id') }}
                        </em>
                    @endif
                </div>

                {{-- <div class="form-group {{ $errors->has('account_detail') ? 'has-error' : '' }}">
                    <label for="account_detail">Account Detail</label>
                    <input type="text" id="account_detail" name="account_detail" class="form-control" value="{{ old('account_detail', isset($contact) ? $contact->account_detail : '') }}" required>
                    @if($errors->has('account_detail'))
                        <em class="invalid-feedback">
                            {{ $errors->first('account_detail') }}
                        </em>
                    @endif
                </div> --}}

                <div class="col-md-12 form-group {{ $errors->has('detail') ? 'has-error' : '' }}">
                    <label for="detail">Contact Notes</label>
                    <textarea id="detail" name="detail" class="form-control ckeditor">{{ old('detail', isset($contact) ? $contact->detail : '') }}</textarea>
                    @if($errors->has('detail'))
                        <em class="invalid-feedback">
                            {{ $errors->first('detail') }}
                        </em>
                    @endif
                </div>
                
                <div class="col-md-12 form-group">
                    <button class="btn btn-danger add-podcast-btn" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>