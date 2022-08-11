<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\TanggapanLayanan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class TanggapanLayananController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_layanan' => ['required', 'exists:layanans,id'],
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
            $tanggapan = [
                'id_layanan' => $request->id_layanan,
                'tanggapan' => $request->catatan
            ];

            TanggapanLayanan::create($tanggapan);

            $layanan = Layanan::findOrFail($request->id_layanan);
            $layanan->status = '2';
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
}
