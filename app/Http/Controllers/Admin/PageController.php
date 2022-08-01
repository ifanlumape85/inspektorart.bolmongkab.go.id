<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:page-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Page::with('menu')->paginate(10);
        return view('pages.page.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Page;
        $menus = Menu::all();
        return view('pages.page.create', compact('item', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store(
                'assets/page',
                'public'
            );
        }
        Page::create($data);
        session()->flash('success', 'Page was created.');
        return redirect()->route('page.create');
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
        $item = Page::findOrFail($id);
        $menus = Menu::all();
        return view('pages.page.edit', compact('item', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $item = Page::findOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            Storage::delete($item->image);
            $data['image'] = $request->file('image')->store('assets/page', 'public');
        }
        $item->update($data);
        session()->flash('success', 'Page was updated.');
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Page::findOrFail($id);
        Storage::delete($item->image);
        $item->delete();
        session()->flash('success', 'Page was Deleted.');
        return redirect()->route('page.index');
    }
}
