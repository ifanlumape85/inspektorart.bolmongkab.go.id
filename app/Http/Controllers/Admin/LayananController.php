<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LayananRequest;
use App\Models\Jenis;
use App\Models\JenisLayanan;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:layanan-list|layanan-create|layanan-edit|layanan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:layanan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:layanan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:layanan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Layanan::latest()->paginate(10);
        return view('pages.layanan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Layanan();
        $jeniss = Jenis::all();
        $jenis_layanans = JenisLayanan::all();
        $users = User::all();
        return view('pages.layanan.create', compact('item', 'jeniss', 'jenis_layanans', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LayananRequest $request)
    {
        $data = $request->all();
        // dd($data);
        $layanans = auth()->user()->layanan()->create($data);
        $layanans->users()->attach($request->user_id);
        session()->flash('success', 'Item was created.');
        return redirect()->route('layanan.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Layanan::findOrFail($id);
        $jeniss = Jenis::all();
        $jenis_layanans = JenisLayanan::all();
        $users = User::all();
        return view('pages.layanan.edit', compact('item', 'jeniss', 'jenis_layanans', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LayananRequest $request, $id)
    {
        $data = $request->all();
        $item = Layanan::findOrFail($id);
        $item->update($data);
        $item->users()->sync($request->user_id);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('layanan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Layanan::findOrFail($id);
        $item->users()->detach();
        $item->delete();
        return redirect()->route('layanan.index');
    }
}
