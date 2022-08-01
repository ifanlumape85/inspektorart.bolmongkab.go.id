<div class="card-body">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="form-group">
        <label for="menu">Menu</label>
        <select class="form-control select2" name="menus_id">
            <option value=""></option>
            @foreach($menus as $menu)
            <option @if($item->menus_id == $menu->id) selected @endif value="{{ $menu->id }}">{{ $menu->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') ?? $item->name }}">
    </div>

    <div class="form-group">
        <label>Body</label>
        <textarea class="form-control" rows="3" placeholder="Enter ..." name="body" id="summernote">{{ old('body') ?? $item->body }}</textarea>
    </div>

    <div class="form-group">
        <label for="link">Link</label>
        <input type="text" class="form-control" id="link" name="link" placeholder="link" value="{{ old('link') ?? $item->link }}">
    </div>
    @if(Storage::disk('public')->exists($item->image ?? null))
    <img src="{{ Storage::url($item->image ?? null) }}" width="200px" />
    @endif
    <div class="form-group">
        <label for="image">Image (JPG,JPEG)</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Create' }}</button>
</div>