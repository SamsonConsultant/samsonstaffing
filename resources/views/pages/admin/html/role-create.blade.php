<div class="card">
    <div class="card-header">
        Create Role
    </div>

    <div class="card-body">
        <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">Title*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($role) ? $role->title : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            {{-- <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                <label for="permissions">Permissions*
                    <span class="btn btn-info btn-xs select-all">Select All</span>
                    <span class="btn btn-info btn-xs deselect-all">Deselect All</span>
                </label>
                <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required>
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                    <em class="invalid-feedback">
                        {{ $errors->first('permissions') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div> --}}
            <div>
                <input class="btn btn-danger" type="submit" value="Save">
            </div>
        </form>
    </div>
</div>