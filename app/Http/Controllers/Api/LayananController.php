<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DisposisiLayanan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        if ($request->id_role == "2") {
            $items = Layanan::with('user', 'jenis', 'jenis_layanan')
                ->where(function ($query) use ($request) {
                    return $request->input('id') ?
                        $query->where('layanans.id_user', $request->input('id')) : '';
                })->where(function ($query) use ($request) {
                    return $request->input('query') ?
                        $query->where('layanans.deskripsi', 'LIKE', '%' . $request->input('query') . '%') : '';
                })->orderBy('layanans.id', 'desc')
                ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();
        } else if ($request->id_role == "3") {
            $items = Layanan::select([
                'layanans.id',
                'layanans.id_jenis',
                'layanans.id_jenis_layanan',
                'layanans.deskripsi',
                'layanans.id_user',
                'layanans.created_at',
                'layanans.updated_at',
                'layanans.status'
            ])->with('user', 'jenis', 'jenis_layanan')
                ->where(function ($query) use ($request) {
                    return $request->input('id') ?
                        $query->where('disposisi_layanans.id_user', $request->input('id')) : '';
                })->join('disposisi_layanans', 'layanans.id', '=', 'disposisi_layanans.id_layanan')
                ->orderBy('layanans.id', 'desc')
                ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();
        } else {
            $items = Layanan::with('user', 'jenis', 'jenis_layanan')
                ->where(function ($query) use ($request) {
                    return $request->input('query') ?
                        $query->where('layanans.deskripsi', 'LIKE', '%' . $request->input('query') . '%') : '';
                })->orderBy('layanans.id', 'desc')
                ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();
        }

        $response = [
            'code' => 1,
            'message' => 'Sukses',
            'layanans' => $items->toArray()
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => ['required', 'exists:users,id'],
            'id_jenis' => ['required', 'exists:jenis,id'],
            'id_jenis_layanan' => ['required', 'exists:jenis_layanans,id'],
            'deskripsi' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => 'Lengkapi form'
            ];
            return response()->json($validator->errors(), 200);
        }

        try {
            $layanan = [
                'id_user' => $request->id_user,
                'id_jenis' => $request->id_jenis,
                'id_jenis_layanan' => $request->id_jenis_layanan,
                'deskripsi' => $request->deskripsi
            ];

            Layanan::create($layanan);

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
            'id' => ['required', 'exists:layanans,id'],
            'id_user' => ['required', 'exists:users,id'],
            'id_jenis' => ['required', 'exists:jenis,id'],
            'id_jenis_layanan' => ['required', 'exists:jenis_layanans,id'],
            'deskripsi' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => 'Lengkapi form'
            ];
            return response()->json($validator->errors(), 200);
        }

        try {

            $layanan = Layanan::findOrFail($request->id);
            $layanan->id_user = $request->id_user;
            $layanan->id_jenis = $request->id_jenis;
            $layanan->id_jenis_layanan = $request->id_jenis_layanan;
            $layanan->deskripsi = $request->deskripsi;
            $layanan->update();

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
        $layanan = Layanan::findOrFail($request->id);
        $layanan->delete();
        $response = [
            'code' => '1',
            'status' => 'success',
            'message' => 'success'
        ];

        return response()->json($response, 200);
    }
}
