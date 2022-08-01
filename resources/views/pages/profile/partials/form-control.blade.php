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
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') ?? $item->phone }}">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address') ?? $item->address }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') ?? $item->email }}">
    </div>
    <div class="form-group">
        <label for="opening_hours">Opening Hours</label>
        <input type="text" class="form-control" id="opening_hours" name="opening_hours" placeholder="Opening Hours" value="{{ old('opening_hours') ?? $item->opening_hours }}">
    </div>
    <div class="form-group">
        <label for="facebook">Facebook</label>
        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="facebook" value="{{ old('facebook') ?? $item->facebook }}">
    </div>
    <div class="form-group">
        <label for="twitter">Twitter</label>
        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter" value="{{ old('twitter') ?? $item->twitter }}">
    </div>
    <div class="form-group">
        <label for="google_plus">Google Plus</label>
        <input type="google_plus" class="form-control" id="google_plus" name="google_plus" placeholder="Google Plus" value="{{ old('google_plus') ?? $item->google_plus }}">
    </div>
    <div class="form-group">
        <label for="google_maps">Maps (iframe)</label>
        <textarea name="google_maps" id="google_maps" cols="30" rows="10" class="form-control">{{ old('google_maps') ?? $item->google_maps }}</textarea>
    </div>
    <div class="form-group">
        <label for="instagram">Instagram</label>
        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="{{ old('instagram') ?? $item->instagram }}">
    </div>

    <div class="form-group">
        <label>About</label>
        <textarea class="form-control" rows="3" placeholder="Enter ..." name="about" id="about">{{ old('about') ?? $item->about }}</textarea>
    </div>

    <div class="form-group">
        <label for="video_embed">Video Embed</label>
        <textarea name="video_embed" id="video_embed" cols="30" rows="10" class="form-control">{{ old('video_embed') ?? $item->video_embed }}</textarea>
    </div>
    @if(Storage::disk('public')->exists($item->image ?? null))
    <img src="{{ Storage::url($item->image ?? null) }}" width="100px" />
    @endif
    <div class="form-group">
        <label for="exampleInputFile">Logo (PNG)</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="departemen_head">Departemen Head [<a href="{{ route('profile_picture.edit', $item->id) }}">Upload Photo</a>]</label>
        <input type="text" class="form-control" id="departemen_head" name="departemen_head" placeholder="Departemen Head" value="{{ old('departemen_head') ?? $item->departemen_head }}">
    </div>

    <div class="form-group">
        <label>Welcome Speech</label>
        <textarea class="form-control" id="summernote" rows="3" placeholder="Welcome Speech ..." name="welcome_speech">{{ old('welcome_speech') ?? $item->welcome_speech }}</textarea>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Create' }}</button>
</div>