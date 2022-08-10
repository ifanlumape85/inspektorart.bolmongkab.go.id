<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DisposisiLayanan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class DisposisiLayananController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => ['required', 'exists:users,id'],
            'id_layanan' => ['required', 'exists:layanans,id', 'unique:disposisi_layanans,id_layanan'],
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
                'id_layanan' => $request->id_layanan,
                'catatan' => $request->catatan
            ];

            DisposisiLayanan::create($disposisi);

            $layanan = Layanan::findOrFail($request->id_layanan);
            $layanan->status = '1';
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
