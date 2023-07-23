<div class="col-md-6 form-group {{ $errors->has('contact_id') ? 'has-error' : '' }} carrier_product">
    <label for="contact_id">Contact</label>
    <select name="contact_id" class="form-control" required>
        <option value="">-- Select --</option>
        @forelse($cp as $con)
            <option value="{{ $con->id }}">{{ $con->first_name }} {{ $con->last_name }}</option>
        @empty
        @endforelse
    </select>
    @if($errors->has('contact_id'))
        <em class="invalid-feedback">
            {{ $errors->first('contact_id') }}
        </em>
    @endif
</div>