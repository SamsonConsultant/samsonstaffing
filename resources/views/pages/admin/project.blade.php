<div class="col-md-6 carrier_product">
    <div class="form-group {{ $errors->has('project_id') ? 'has-error' : '' }}">
        <label for="project_id">Project ID</label>
        <select name="project_id" class="form-control" required>
            <option value="">-- Select --</option>
            @forelse($cp as $pr)
                <option value="{{ $pr->id }}">{{ $pr->title }}</option>
            @empty
            @endforelse
        </select>
        @if($errors->has('project_id'))
            <em class="invalid-feedback">
                {{ $errors->first('project_id') }}
            </em>
        @endif
    </div>
</div>