<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DisposisiPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class DisposisiPengaduanController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => ['required', 'exists:users,id'],
            'id_pengaduan' => ['required', 'exists:pengaduans,id', 'unique:disposisi_pengaduans,id_pengaduan'],
            'catatan' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => $validator->errors()->first()
            ];
            return response()->json($response, 200);
        }

        try {
            $disposisi = [
                'id_user' => $request->id_user,
                'id_pengaduan' => $request->id_pengaduan,
                'catatan' => $request->catatan
            ];

            DisposisiPengaduan::create($disposisi);

            $pengaduan = Pengaduan::findOrFail($request->id_pengaduan);
            $pengaduan->status = '1';
            $pengaduan->update();

            $response = [
                'code' => '1',
                'status' => 'success',
                'message' => 'success'
            ];

            return response()->json($response, 200);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'code' => '2',
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }
}
