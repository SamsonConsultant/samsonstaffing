<div class="col-md-6 form-group {{ $errors->has('state_id') ? 'has-error' : '' }} state-list">
    <label for="state_id">State*</label>
    <select name="state_id" class="form-control select2">
        <option value="">-- Select --</option>
        @foreach($state_list as $st)
            <option value="{{ $st->id }}">{{ $st->name }}</option>
        @endforeach
    </select>
    @if($errors->has('state_id'))
        <em class="invalid-feedback">
            {{ $errors->first('state_id') }}
        </em>
    @endif
</div>