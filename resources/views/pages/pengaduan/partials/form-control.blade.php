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
        <label for="judul">Judul pengaduan</label>
        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" value="{{ old('judul') ?? $item->judul }}">
    </div>
    <div class="form-group">
        <label>Uraian pengaduan</label>
        <textarea class="form-control" rows="3" placeholder="Uraian ..." name="uraian" id="uraian">{{ old('uraian') ?? $item->uraian }}</textarea>
    </div>
    <label>Pihak Terkait/Pelaku</label>
    <table class="table mb-2 table-item-manual">
        <tr>
            <td>Nama</td>
            <td>Alamat</td>
            <td>Jabatan</td>
            <td><a class="btn btn-danger btn-add-item-manual"><i class="fas fa-plus"></i></a></td>
        </tr>
        @if($item->pihak_terkait)
        @foreach($item->pihak_terkait as $pk)
        <tr>
            <td><input type="text" name="nama[]" class="form-control" value="{{ $pk->nama ?? null }}" /></td>
            <td><input type="text" name="alamat[]" class="form-control" value="{{ $pk->alamat ?? null }}" /></td>
            <td>
                <input type="text" name="jabatan[]" class="form-control" value="{{ $pk->jabatan ?? null }}" />
                <input type="hidden" name="id[]" class="form-control" value="{{ $pk->id ?? null }}" />
            </td>
            <td>
                <a class="btn btn-danger btn-delete-row" data-type="manual" data-value="{{ $pk->id ?? null }}" value="{{ $pk->id ?? null }}"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </table>
    <div class="form-group">
        <label for="lokasi">Lokasi kejadian</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="lokasi" value="{{ old('lokasi') ?? $item->lokasi }}">
    </div>
    <div class="form-group">
        <label for="waktu">Waktu kejadian</label>
        <input type="text" class="form-control" id="waktu" name="waktu" placeholder="waktu" value="{{ old('waktu') ?? $item->waktu }}">
    </div>
    <div class="form-group">
        <label for="penyebab">Penyebab kejadian</label>
        <input type="text" class="form-control" id="penyebab" name="penyebab" placeholder="penyebab" value="{{ old('penyebab') ?? $item->penyebab }}">
    </div>
    <div class="form-group">
        <label for="proses">Proses terjadi masalah</label>
        <input type="text" class="form-control" id="proses" name="proses" placeholder="proses" value="{{ old('proses') ?? $item->proses }}">
    </div>
    <div class="form-group">
        <label for="kerugian">Jumlah indikasi kerugian</label>
        <input type="number" class="form-control" id="kerugian" name="kerugian" placeholder="kerugian" value="{{ old('kerugian') ?? $item->kerugian }}">
    </div>
    @if(Storage::disk('public')->exists($item->bukti ?? null))
    <img src="{{ Storage::url($item->bukti ?? null) }}" width="200px" />
    @endif
    <div class="form-group">
        <label for="image">Image(JPG,JPEG)</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="bukti" name="bukti">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
        </div>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Create' }}</button>
</div>