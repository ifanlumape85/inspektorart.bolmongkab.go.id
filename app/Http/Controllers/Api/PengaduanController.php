<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->id_role == "2") {
            $items = Pengaduan::with('user', 'pihak_terkait', 'tanggapan')->where(function ($query) use ($request) {
                return $request->input('id') ?
                    $query->where('pengaduans.id_user', $request->input('id')) : '';
            })->where(function ($query) use ($request) {
                return $request->input('query') ?
                    $query->where('pengaduans.judul', 'LIKE', '%' . $request->input('query') . '%') : '';
            })->orderBy('pengaduans.id', 'desc')
                ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();
        } else if ($request->id_role == "3") {
            $items = Pengaduan::select([
                'pengaduans.id',
                'pengaduans.judul',
                'pengaduans.uraian',
                'pengaduans.lokasi',
                'pengaduans.waktu',
                'pengaduans.penyebab',
                'pengaduans.proses',
                'pengaduans.kerugian',
                'pengaduans.bukti',
                'pengaduans.id_user',
                'pengaduans.created_at',
                'pengaduans.updated_at',
                'pengaduans.status'
            ])->with('user','pihak_terkait', 'tanggapan')
                ->where(function ($query) use ($request) {
                    return $request->input('id') ?
                        $query->where('disposisi_pengaduans.id_user', $request->input('id')) : '';
                })->join('disposisi_pengaduans', 'pengaduans.id', '=', 'disposisi_pengaduans.id_pengaduan')
                ->orderBy('pengaduans.id', 'desc')
                ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();
        } else {
            $items = Pengaduan::with('user','pihak_terkait', 'tanggapan')
                ->where(function ($query) use ($request) {
                    return $request->input('query') ?
                        $query->where('pengaduans.judul', 'LIKE', '%' . $request->input('query') . '%') : '';
                })->orderBy('pengaduans.id', 'desc')
                ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();
        }

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
            'id' => ['required', 'exists:users,id'],
            'judul' => ['required'],
            'uraian' => ['required'],
            'lokasi' => ['required'],
            'waktu' => ['required'],
            'penyebab' => ['required'],
            'proses' => ['required'],
            'jumlah' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => 'Lengkapi form'
            ];
            return response()->json($validator->errors(), 200);
        }

        try {

            if ($request->bukti) {
                $image = $request->bukti;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(60) . '.png';
                Storage::disk('local')->put('/public/assets/bukti/' . $imageName, base64_decode($image));

                $pengaduan = [
                    'id_user' => $request->id,
                    'judul' => $request->judul,
                    'uraian' => $request->uraian,
                    'lokasi' => $request->lokasi,
                    'waktu' => $request->waktu,
                    'penyebab' => $request->penyebab,
                    'proses' => $request->proses,
                    'kerugian' => $request->jumlah,
                    'bukti' => 'assets/bukti/' . $imageName
                ];
            } else {
                $pengaduan = [
                    'id_user' => $request->id,
                    'judul' => $request->judul,
                    'uraian' => $request->uraian,
                    'lokasi' => $request->lokasi,
                    'waktu' => $request->waktu,
                    'penyebab' => $request->penyebab,
                    'proses' => $request->proses,
                    'kerugian' => $request->jumlah
                ];
            }

            $pengaduan = Pengaduan::create($pengaduan);

            $response = [
                'code' => '1',
                'status' => 'success',
                'id' => $pengaduan->id,
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
            'id' => ['required', 'exists:pengaduans,id'],
            'judul' => ['required'],
            'uraian' => ['required'],
            'lokasi' => ['required'],
            'waktu' => ['required'],
            'penyebab' => ['required'],
            'proses' => ['required'],
            'jumlah' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => 'Lengkapi form'
            ];
            return response()->json($validator->errors(), 200);
        }

        try {

            $pengaduan = Pengaduan::findOrFail($request->id);
            if ($request->bukti) {
                Storage::delete($pengaduan->bukti);
                $image = $request->bukti;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(60) . '.png';
                Storage::disk('local')->put('/public/assets/bukti/' . $imageName, base64_decode($image));

                $pengaduan->judul = $request->judul;
                $pengaduan->uraian = $request->uraian;
                $pengaduan->lokasi = $request->lokasi;
                $pengaduan->waktu = $request->waktu;
                $pengaduan->penyebab = $request->penyebab;
                $pengaduan->proses = $request->proses;
                $pengaduan->kerugian = $request->jumlah;
                $pengaduan->bukti = 'assets/bukti/' . $imageName;
            } else {
                $pengaduan->judul = $request->judul;
                $pengaduan->uraian = $request->uraian;
                $pengaduan->lokasi = $request->lokasi;
                $pengaduan->waktu = $request->waktu;
                $pengaduan->penyebab = $request->penyebab;
                $pengaduan->proses = $request->proses;
                $pengaduan->kerugian = $request->jumlah;
            }

            Pengaduan::create($pengaduan);

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
        $pengaduan = Pengaduan::findOrFail($request->id);
        Storage::delete($pengaduan->bukti);
        $pengaduan->delete();
        $response = [
            'code' => '1',
            'status' => 'success',
            'message' => 'success'
        ];

        return response()->json($response, 200);
    }
}
