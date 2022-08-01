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
        <label for="departemen_head">Departemen Head</label>
        <p class="text-secondary">{{ $item->departemen_head ?? null }}</p>
    </div>

    @if(Storage::disk('public')->exists($item->profile_picture ?? null))
    <img src="{{ Storage::url($item->profile_picture ?? null) }}" width="100px" />
    @endif
    <div class="form-group">
        <label for="exampleInputFile">Profile Picture (PNG)</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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