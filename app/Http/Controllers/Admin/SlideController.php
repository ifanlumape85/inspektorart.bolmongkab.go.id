<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlideRequest;
use App\Models\Slide;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:slide-list|slide-create|slide-edit|slide-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:slide-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:slide-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:slide-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Slide::latest()->paginate(10);
        return view('pages.slide.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Slide;
        return view('pages.slide.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store(
                'assets/slide',
                'public'
            );
        }
        Slide::create($data);
        session()->flash('success', 'Slide was created.');
        return redirect()->route('slide.create');
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
        $item = Slide::findOrFail($id);
        return view('pages.slide.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlideRequest $request, $id)
    {
        $data = $request->all();
        $item = Slide::findOrFail($id);
        if ($request->file('image')) {
            Storage::delete($item->image);
            $data['image'] = $request->file('image')->store('assets/slide', 'public');
        }
        $item->update($data);
        session()->flash('success', 'Slide was updated.');

        return redirect()->route('slide.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Slide::findOrFail($id);
        Storage::delete($item->image);
        $item->delete();
        session()->flash('success', 'Slide was deleted.');

        return redirect()->route('slide.index');
    }
}
