<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function news(Request $request)
    {
        $query = $request->s;
        $items = News::where("name", "like", "%$query%")->latest()->paginate(4);
        if ($items->count() < 1) {
            $items = News::latest()->paginate(4);
        }
        $recents = News::take(3)->get();
        $breadcrumb_h1 = 'Search Result';
        $breadcrumb_title = 'Search Result'; //$category->name;
        $profile = Profile::firstOrFail();
        $menus = Menu::with('pages')->where('position', 'Top')->get();
        $bottomMenus = Menu::with('pages')->where('position', 'Bottom')->get();
        $categories = Category::get();
        $galleries = Gallery::get();
        $tags = Tag::get();
        return view('pages.detail', compact(
            'items',
            'profile',
            'menus',
            'bottomMenus',
            'categories',
            'galleries',
            'recents',
            'tags',
            'breadcrumb_h1',
            'breadcrumb_title'
        ));
    }
}
