<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JenisRequest;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:jenis-list|jenis-create|jenis-edit|jenis-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:jenis-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jenis-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jenis-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Jenis::latest()->paginate(10);
        return view('pages.jenis.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Jenis();
        return view('pages.jenis.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisRequest $request)
    {
        $data = $request->all();
        Jenis::create($data);
        session()->flash('success', 'Item was created.');
        return redirect()->route('jenis.create');
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
        $item = Jenis::findOrFail($id);
        return view('pages.jenis.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JenisRequest $request, $id)
    {
        $data = $request->all();
        $item = Jenis::findOrFail($id);
        $item->update($data);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('jenis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Jenis::findOrFail($id);
        $item->delete();
        return redirect()->route('jenis.index');
    }
}
