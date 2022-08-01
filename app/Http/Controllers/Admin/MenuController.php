<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu-list|menu-create|menu-edit|menu-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:menu-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:menu-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:menu-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Menu::latest()->paginate(10);
        return view('pages.menu.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Menu;
        return view('pages.menu.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        Menu::create($data);
        session()->flash('success', 'Menu was created.');
        return redirect()->route('menu.create');
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
        $item = Menu::findOrFail($id);
        return view('pages.menu.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $data = $request->all();
        $item = Menu::findOrFail($id);
        $item->update($data);
        session()->flash('success', 'Menu was updated.');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Menu::findOrFail($id);
        $item->pages()->delete();
        $item->delete();
        return redirect()->route('menu.index');
    }
}
