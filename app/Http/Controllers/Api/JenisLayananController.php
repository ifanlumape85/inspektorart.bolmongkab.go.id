<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    public function index(Request $request)
    {
        $items = JenisLayanan::where(function ($query) use ($request) {
            return $request->input('query') ?
            $query->where('jenis_layanans.nama', 'LIKE', '%' . $request->input('query') . '%') : '';
        })->orderBy('jenis_layanans.id', 'desc')
        ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();

        $response = [
            'code' => 1,
            'message' => 'Sukses',
            'jenis_layanans' => $items->toArray()
        ];
        return response()->json($response, 200);
    }
}
