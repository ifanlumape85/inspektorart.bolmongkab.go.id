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
        <label for="nama_perizinan">Perizinan</label>
        <input type="text" class="form-control" id="nama_perizinan" name="nama_perizinan" placeholder="Nama Perizinan" value="{{ old('nama_perizinan') ?? $item->nama_perizinan }}">
    </div>

    <div class="form-group">
        <label>Persyaratan</label>
        <textarea class="form-control" rows="3" placeholder="Persyaratan ..." name="persyaratan" id="persyaratan">{{ old('persyaratan') ?? $item->persyaratan }}</textarea>
    </div>

    <div class="form-group">
        <label for="biaya">Biaya</label>
        <input type="text" class="form-control" id="biaya" name="biaya" placeholder="biaya" value="{{ old('biaya') ?? $item->biaya }}">
    </div>

    <div class="form-group">
        <label>Cara Penanganan</label>
        <textarea class="form-control" rows="3" placeholder="Cara Penanganan ..." name="cara_penanganan" id="cara_penanganan">{{ old('cara_penanganan') ?? $item->cara_penanganan }}</textarea>
    </div>

    <div class="form-group">
        <label for="waktu">Waktu</label>
        <input type="number" class="form-control" id="waktu" name="waktu" placeholder="waktu" value="{{ old('waktu') ?? $item->waktu }}">
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Create' }}</button>
</div>