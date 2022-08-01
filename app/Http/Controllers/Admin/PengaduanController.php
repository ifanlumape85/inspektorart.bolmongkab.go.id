<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PengaduanRequest;
use App\Models\Pengaduan;
use App\Models\PihakTerkait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pengaduan-list|pengaduan-create|pengaduan-edit|pengaduan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:pengaduan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengaduan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengaduan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Pengaduan::latest()->paginate(10);
        return view('pages.pengaduan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Pengaduan();
        return view('pages.pengaduan.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengaduanRequest $request)
    {
        $data = $request->all();
        if ($request->file('bukti')) {
            $data['bukti'] = $request->file('bukti')->store(
                'assets/bukti',
                'public'
            );
        }

        $pengaduan = auth()->user()->pengaduan()->create($data);
        $id_pengaduan = $pengaduan->id;

        if ($request->nama) {
            foreach ($request->nama as $i => $v) {
                if ($v != "") {
                    $pihak_terkait['nama'] = $v;
                    $pihak_terkait['id_pengaduan'] = $id_pengaduan;
                    $pihak_terkait['alamat'] = $request->input("alamat.$i");
                    $pihak_terkait['jabatan'] = $request->input("jabatan.$i");

                    $id = $request->input("id.$i");
                    if ($id == "") {
                        PihakTerkait::create($pihak_terkait);
                    } else {
                        $item = PihakTerkait::findOrFail($id);
                        $item->update($pihak_terkait);
                    }
                }
            }
        }
        session()->flash('success', 'Item was created.');
        return redirect()->route('pengaduan.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Pengaduan::findOrFail($id);
        return view('pages.pengaduan.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PengaduanRequest $request, $id)
    {
        $data = $request->all();
        $item = Pengaduan::findOrFail($id);
        if ($request->file('bukti')) {
            Storage::delete($item->bukti);
            $data['bukti'] = $request->file('bukti')->store('assets/bukti', 'public');
        }

        if ($request->nama) {
            foreach ($request->nama as $i => $v) {
                if ($v != "") {
                    $pihak_terkait['nama'] = $v;
                    $pihak_terkait['id_pengaduan'] = $id;
                    $pihak_terkait['alamat'] = $request->input("alamat.$i");
                    $pihak_terkait['jabatan'] = $request->input("jabatan.$i");

                    $id = $request->input("id.$i");
                    if ($id == "") {
                        PihakTerkait::create($pihak_terkait);
                    } else {
                        $item = PihakTerkait::findOrFail($id);
                        $item->update($pihak_terkait);
                    }
                }
            }
        }

        $item->update($data);
        session()->flash('success', 'Item was updated.');

        return redirect()->route('pengaduan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pengaduan::findOrFail($id);
        Storage::delete($item->bukti);
        $item->delete();
        session()->flash('success', 'Item was deleted.');

        return redirect()->route('pengaduan.index');
    }

    public function listPihakTerkait($idx)
    {
        $html = '<tr>';
        $html .= '<td style="width:35%"><input type="text" data-idx="' . $idx . '" id="nama_' . $idx . '" name="nama[' . $idx . ']" class="form-control input_nama" /></td>';
        $html .= '<td><input type="text" data-idx="' . $idx . '" id="alamat_' . $idx . '" name="alamat[' . $idx . ']" class="form-control input_alamat" /></td>';
        $html .= '<td><input type="text" data-idx="' . $idx . '" id="jabatan_' . $idx . '" name="jabatan[' . $idx . ']" class="form-control input_jabatan" /></td>';
        $html .= '
        <td>
        <input type="hidden" data-idx="' . $idx . '" id="id_' . $idx . '" name="id[' . $idx . ']" value="" />
        <a class="btn btn-danger btn-delete-row" data-type="manual" data-value="" value=""><i class="fas fa-trash"></i></a>
        </td>';
        $html .= '</tr>';

        echo $html;
    }
}
