<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:news-list|news-create|news-edit|news-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:news-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:news-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:news-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = News::with('category')->latest()->paginate(10);
        return view('pages.news.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new News;
        $categories = Category::get();
        $tags = Tag::get();
        return view('pages.news.create', compact('item', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store(
                'assets/news',
                'public'
            );
        }

        $news = auth()->user()->news()->create($data);
        $news->tags()->attach($request->tags_id);
        session()->flash('success', 'News was created.');
        return redirect()->route('news.create');
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
        $item = News::findOrFail($id);
        $categories = Category::get();
        $tags = Tag::get();
        return view('pages.news.edit', compact('item', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $data = $request->all();
        $item = News::findOrFail($id);
        if ($request->file('image')) {
            Storage::delete($item->image);
            $data['image'] = $request->file('image')->store('assets/news', 'public');
        }
        $data['slug'] = Str::slug($request->name);
        $item->update($data);
        $item->tags()->sync($request->tags_id);
        session()->flash('success', 'News was updated.');

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = News::findOrFail($id);
        Storage::delete($item->image);
        $item->tags()->detach();
        $item->delete();
        session()->flash('success', 'News was deleted.');

        return redirect()->route('news.index');
    }
}
