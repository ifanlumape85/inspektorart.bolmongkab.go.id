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
        <label for="link">Link</label>
        <input type="text" class="form-control" id="link" name="link" placeholder="http://www.unima.ac.id" value="{{ old('link') ?? $item->link }}">
    </div>
    <img src="{{ Storage::url($item->image ?? null) }}" width="200px" />
    <div class="form-group">
        <label for="image">Image(JPG,JPEG) 340x500</label>
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