<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $items = News::where(function ($query) use ($request) {
            return $request->input('query') ?
                $query->where('news.name', 'LIKE', '%' . $request->input('query') . '%') : '';
        })->orderBy('news.id', 'desc')
            ->skip($request->input('start') ?? 0)->take($request->input('limit') ?? 10)->get();

        $response = [
            'code' => 1,
            'message' => 'Sukses',
            'news' => $items->toArray()
        ];
        return response()->json($response, 200);
    }
}
