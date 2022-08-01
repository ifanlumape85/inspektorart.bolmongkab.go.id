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
        <label for="category">Category</label>
        <select class="form-control select2" name="category_id" style="width: 100%;">
            <option value="" selected disabled>Choose One</option>
            @foreach($categories as $category)
            <option @if($item->category_id == $category->id || old('category_id') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') ?? $item->name }}">
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea class="form-control" rows="3" placeholder="Enter ..." name="body" id="body">{{ old('body') ?? $item->body }}</textarea>
    </div>
    <div class="form-group">
        <label for="tag">Tag</label>
        <select class="select2" name="tags_id[]" multiple="multiple" data-placeholder="Choose some Tags" style="width: 100%;">
            @foreach($item->tags as $tag)
            <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
            @foreach($tags as $tag)
            <option @if($item->tags_id == $tag->id) selected @endif value="{{ $tag->id }}" value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    @if(Storage::disk('public')->exists($item->image ?? null))
    <img src="{{ Storage::url($item->image ?? null) }}" width="200px" />
    @endif
    <div class="form-group">
        <label for="image">Image(JPG,JPEG)</label>
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