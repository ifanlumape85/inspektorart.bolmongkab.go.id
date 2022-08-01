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
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') ?? $item->name }}">
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea class="form-control" rows="3" placeholder="Enter ..." name="body" id="summernote">{{ old('body') ?? $item->body }}</textarea>
    </div>
    <div class="form-group">
        <label for="link">Name</label>
        <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{ old('link') ?? $item->link }}">
    </div>
    <div class="form-group">
        <label>Mega Menu?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="mega_menu" value="Y" @if($item->mega_menu == 'Y' || old('mega_menu') == 'Y') ? checked : '' @endif>
            <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="mega_menu" value="N" @if($item->mega_menu == 'N' || old('mega_menu') == 'N') ? checked : '' @endif>
            <label class="form-check-label">No</label>
        </div>
    </div>
    <div class="form-group">
        <label>Position?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="position" value="Top" @if($item->position == 'Top' || old('position') == 'Top') ? checked : '' @endif>
            <label class="form-check-label">Top</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="position" value="Bottom" @if($item->position == 'Bottom' || old('position') == 'Bottom') ? checked : '' @endif>
            <label class="form-check-label">Bottom</label>
        </div>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Create' }}</button>
</div>