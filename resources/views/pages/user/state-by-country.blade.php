<div class="col-sm-6 state-list">
    <div class="form-group">
        <label>State <span aria-hidden="true" class="labelRequiredIcon"> *</span></label>
        <select class="form-control select2" style="width: 100%;" name="state_id">
            <option value="">-- Select --</option>
            @foreach($state_list as $st)
                <option value="{{ $st->id }}">{{ $st->name }}</option>
            @endforeach
        </select>
    </div>
</div>