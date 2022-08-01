<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:gallery-list|gallery-create|gallery-edit|gallery-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:gallery-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gallery-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gallery-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Gallery::latest()->paginate(10);
        return view('pages.gallery.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Gallery();
        return view('pages.gallery.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->all();
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store(
                'assets/gallery',
                'public'
            );
        }
        Gallery::create($data);
        session()->flash('success', 'Gallery was created.');
        return redirect()->route('gallery.create');
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
        $item = Gallery::findOrFail($id);
        return view('pages.gallery.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $data = $request->all();
        $item = Gallery::findOrFail($id);
        if ($request->file('image')) {
            Storage::delete($item->image);
            $data['image'] = $request->file('image')->store('assets/gallery', 'public');
        }
        $item->update($data);
        session()->flash('success', 'Gallery was updated.');

        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Gallery::findOrFail($id);
        Storage::delete($item->image);
        $item->delete();
        session()->flash('success', 'Gallery was deleted.');

        return redirect()->route('gallery.index');
    }
}
