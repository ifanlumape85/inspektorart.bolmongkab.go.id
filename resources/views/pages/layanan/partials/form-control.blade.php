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
        <label for="jenis">Jenis</label>
        <select class="form-control select2" name="id_jenis" style="width: 100%;">
            <option value="" selected disabled>Choose One</option>
            @foreach($jeniss as $jenis)
            <option @if($item->id_jenis == $jenis->id || old('id_jenis') == $jenis->id) selected @endif value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="jenis_layanan">Jenis Layanan</label>
        <select class="form-control select2" name="id_jenis_layanan" style="width: 100%;">
            <option value="" selected disabled>Choose One</option>
            @foreach($jenis_layanans as $jenis_layanan)
            <option @if($item->id_jenis_layanan == $jenis_layanan->id || old('id_jenis_layanan') == $jenis_layanan->id) selected @endif value="{{ $jenis_layanan->id }}">{{ $jenis_layanan->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" rows="3" placeholder="Deskripsi ..." name="deskripsi" id="deskripsi">{{ old('deskripsi') ?? $item->deskripsi }}</textarea>
    </div>
    <div class="form-group">
        <label for="id_user">Disposisi</label>
        <select class="select2" name="user_id[]" multiple="multiple" data-placeholder="Choose some users" style="width: 100%;">
            @foreach($item->users as $user)
            <option selected value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
            @foreach($users as $user)
            <option @if($item->id_user == $user->id) selected @endif value="{{ $user->id }}" value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Create' }}</button>
</div>