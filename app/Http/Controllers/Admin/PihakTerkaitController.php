<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PihakTerkait;
use Illuminate\Http\Request;

class PihakTerkaitController extends Controller
{
    public function listPihakTerkait(Request $request)
    {
        $id = $request->id_pengaduan;
        $idx = 2222;

        $pihak_terkait = PihakTerkait::where('id_pengaduan', $id)->get();
        $html = '';

        foreach ($pihak_terkait as $j => $pihak) {

            $html .= '<tr>';
            $html .= '<td style="width:35%"><input value="' . $pihak->nama . '" type="text" data-idx="' . $idx . '" id="nama_' . $idx . '" name="nama[' . $idx . ']" class="form-control input_nama" /></td>';
            $html .= '<td><input value="' . $pihak->jumlah . '" type="text" data-idx="' . $idx . '" id="alamat_' . $idx . '" name="alamat[' . $idx . ']" class="form-control input_alamat" /></td>';
            $html .= '<td><input value="' . $pihak->harga . '" type="text" data-idx="' . $idx . '" id="jabatan_' . $idx . '" name="jabatan[' . $idx . ']" class="form-control input_jabatan" /></td>';
            $html .= '
            <td>
                <input value="' . $pihak->id . '" type="hidden" data-idx="' . $idx . '" id="id_' . $idx . '" name="id[' . $idx . ']" />
                <a class="btn btn-danger btn-delete-row" data-type="manual" data-value="' . $pihak->id . '"><i class="fas fa-trash"></i></a>
            </td>';
            $html .= '</tr>';
            $idx++;
        }

        return response()->json([
            'idx_item' => $idx,
            'html' => $html
        ]);
    }

    public function deletePihakTerkait($id)
    {
        $item = PihakTerkait::findOrFail($id);
        $item->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
