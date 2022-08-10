<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(Request $request)
    {
        $items = Jenis::where(function ($query) use ($request) {
            return $request->input('query') ?
            $query->where('jenis.nama', 'LIKE', '%' . $request->input('query') . '%') : '';
        })->orderBy('jenis.id', 'desc')
        ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();

        $response = [
            'code' => 1,
            'message' => 'Sukses',
            'jenis' => $items->toArray()
        ];
        return response()->json($response, 200);
    }
}
