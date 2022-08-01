<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\News;
use App\Models\Perizinan;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PerizinanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:perizinan-list|perizinan-create|perizinan-edit|perizinan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:perizinan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:perizinan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:perizinan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Perizinan::orderBy('id', 'desc')->paginate(10);
        return view('pages.perizinan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Perizinan();
        return view('pages.perizinan.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_perizinan);
        Perizinan::create($data);
        session()->flash('success', 'Data was created.');
        return redirect()->route('perizinan.create');
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
        $item = Perizinan::findOrFail($id);
        return view('pages.perizinan.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Perizinan::findOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_perizinan);
        $item->update($data);
        session()->flash('success', 'Data was updated.');
        return redirect()->route('perizinan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Perizinan::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Data was Deleted.');
        return redirect()->route('perizinan.index');
    }

    public function listPerizinan()
    {
        $items = Perizinan::get();
        $recents = News::take(3)->get();
        $breadcrumb_h1 = 'Perizinan';
        $breadcrumb_title = 'Perizinan';
        $profile = Profile::firstOrFail();
        $menus = Menu::with('pages')->where('position', 'Top')->get();
        $bottomMenus = Menu::with('pages')->where('position', 'Bottom')->get();
        $categories = Category::get();
        $galleries = Gallery::get();
        $tags = Tag::get();
        $banner = Banner::firstOrFail();

        return view('perizinan', compact(
            'items',
            'recents',
            'breadcrumb_h1',
            'breadcrumb_title',
            'profile',
            'menus',
            'bottomMenus',
            'categories',
            'galleries',
            'tags',
            'banner'
        ));
    }
}
