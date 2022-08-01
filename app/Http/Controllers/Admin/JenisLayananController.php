<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JenisLayananRequest;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:jenis_layanan-list|jenis_layanan-create|jenis_layanan-edit|jenis_layanan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:jenis_layanan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jenis_layanan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jenis_layanan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = JenisLayanan::latest()->paginate(10);
        return view('pages.jenis_layanan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new JenisLayanan();
        return view('pages.jenis_layanan.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisLayananRequest $request)
    {
        $data = $request->all();
        JenisLayanan::create($data);
        session()->flash('success', 'Item was created.');
        return redirect()->route('jenis_layanan.create');
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
        $item = JenisLayanan::findOrFail($id);
        return view('pages.jenis_layanan.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JenisLayananRequest $request, $id)
    {
        $data = $request->all();
        $item = JenisLayanan::findOrFail($id);
        $item->update($data);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('jenis_layanan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = JenisLayanan::findOrFail($id);
        $item->delete();
        return redirect()->route('jenis_layanan.index');
    }
}
