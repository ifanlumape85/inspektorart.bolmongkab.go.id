<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PihakTerkait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class PihakTerkaitController extends Controller
{
    public function index(Request $request)
    {
        $items = PihakTerkait::with('user', 'pihak_terkait')->where(function ($query) use ($request) {
            return $request->input('id') ?
                $query->where('pihak_terkaits.id_pengaduan', $request->input('id')) : '';
        })->orderBy('pihak_terkaits.id', 'desc')
            ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();

        $response = [
            'code' => 1,
            'message' => 'Sukses',
            'pengaduans' => $items->toArray()
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:pengaduans,id'],
            'nama' => ['required'],
            'alamat' => ['required'],
            'jabatan' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => 'Lengkapi form'
            ];
            return response()->json($validator->errors(), 200);
        }

        try {

            $terkait = [
                'id_pengaduan' => $request->id,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jabatan' => $request->jabatan
            ];

            PihakTerkait::create($terkait);

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

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:pihak_terkaits,id'],
            'nama' => ['required'],
            'alamat' => ['required'],
            'jabatan' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => 'Lengkapi form'
            ];
            return response()->json($validator->errors(), 200);
        }

        try {

            $terkait = PihakTerkait::findOrFail($request->id);
            $terkait->jabatan = $request->jabata;
            $terkait->nama = $request->nama;
            $terkait->alamat = $request->alamat;
            $terkait->update();

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

    public function destroy(Request $request)
    {
        $terkait = PihakTerkait::findOrFail($request->id);
        $terkait->delete();
        $response = [
            'code' => '1',
            'status' => 'success',
            'message' => 'success'
        ];

        return response()->json($response, 200);
    }
}
