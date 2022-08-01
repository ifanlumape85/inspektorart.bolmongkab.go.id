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
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') ?? $item->name }}">
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea class="form-control" rows="3" placeholder="Enter ..." name="body" id="body">{{ old('body') ?? $item->body }}</textarea>
    </div>
    <div class="form-group">
        <label for="event_date">Event Data</label>
        <input type="date" class="form-control" id="event_date" name="event_date" placeholder="event_date" value="{{ old('event_date') ?? $item->event_date }}">
    </div>
    <div class="form-group">
        <label for="event_time">Event Time</label>
        <input type="time" class="form-control" id="event_time" name="event_time" placeholder="event_time" value="{{ old('event_time') ?? $item->event_time }}">
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="location" value="{{ old('location') ?? $item->location }}">
    </div>
    @if(Storage::disk('public')->exists($item->image ?? null))
    <img src="{{ Storage::url($item->image ?? null) }}" width="200px" />
    @endif
    <div class="form-group">
        <label for="image">Image(JPEG,JPG)</label>
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