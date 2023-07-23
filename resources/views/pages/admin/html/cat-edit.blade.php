<div class="card">
    <div class="card-header">
        Category Edit
    </div>

    <div class="card-body">
        <form action="{{ route("admin.categories.update", [$category->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="name">Title*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($category) ? $category->title : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block"></p>
            </div>

            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                <label for="name">Description*</label>
                <textarea id="content" name="content" class="form-control ckeditor">{!! old('content', isset($category) ? $category->content : '') !!}</textarea>
                @if($errors->has('content'))
                    <em class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </em>
                @endif
                <p class="helper-block"></p>
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="Save">
            </div>
        </form>
    </div>
</div>