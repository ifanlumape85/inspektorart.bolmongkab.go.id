<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\News;
use App\Models\Page;
use App\Models\Perizinan;
use App\Models\Tag;
use App\Models\Profile;
use Illuminate\Http\Request;

class DetailPageController extends Controller
{
    public function index(Request $request, $slug)
    {
        $item = Page::with('menu')->where('slug', $slug)->firstOrFail();
        $recents = News::take(3)->get();
        $breadcrumb_h1 = 'Page';
        $breadcrumb_title = $item->name;
        $profile = Profile::firstOrFail();
        $menus = Menu::with('pages')->where('position', 'Top')->get();
        $bottomMenus = Menu::with('pages')->where('position', 'Bottom')->get();
        $categories = Category::get();
        $galleries = Gallery::get();
        $tags = Tag::get();
        $banner = Banner::firstOrFail();
        return view('pages.page.detail', compact(
            'item',
            'banner',
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

    public function event(Request $request, $slug)
    {
        $event = Event::with('lecture')->where('slug', $slug)->firstOrFail();
        $recents = News::take(3)->get();
        $events = Event::take(4)->get();
        $breadcrumb_h1 = 'Event';
        $breadcrumb_title = $event->name;
        $profile = profile::firstOrFail();
        $menus = Menu::with('pages')->where('position', 'Top')->get();
        $bottomMenus = Menu::with('pages')->where('position', 'Bottom')->get();
        $categories = Category::get();
        $galleries = Gallery::get();
        $tags = Tag::get();
        return view('event', compact(
            'event',
            'events',
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

    public function news(Request $request, $slug)
    {
        $item = News::with('category')->where('slug', $slug)->firstOrFail();
        $recents = News::take(3)->get();
        $breadcrumb_h1 = 'News';
        $breadcrumb_title = $item->name;
        $profile = profile::firstOrFail();
        $menus = Menu::with('pages')->where('position', 'Top')->get();
        $bottomMenus = Menu::with('pages')->where('position', 'Bottom')->get();
        $categories = Category::get();
        $galleries = Gallery::get();
        $tags = Tag::get();
        return view('pages.page.detail', compact(
            'item',
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

    public function category(Category $category)
    {
        $items = $category->news()->latest()->paginate(4);
        $recents = News::take(3)->get();
        $breadcrumb_h1 = 'Category';
        $breadcrumb_title = $category->name;
        $profile = profile::firstOrFail();
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

    public function tag(Tag $tag)
    {
        $items = $tag->news()->latest()->paginate(4);
        $recents = News::take(3)->get();
        $breadcrumb_h1 = 'Tag';
        $breadcrumb_title = $tag->name;
        $profile = profile::firstOrFail();
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

    public function perizinan(Request $request, $slug)
    {
        $item = Perizinan::where('slug', $slug)->firstOrFail();
        $items = Perizinan::where('slug', '!=', $slug)->get();
        $recents = News::take(3)->get();
        $breadcrumb_h1 = 'Perizinan';
        $breadcrumb_title = $item->nama_perizinan;
        $profile = profile::firstOrFail();
        $menus = Menu::with('pages')->where('position', 'Top')->get();
        $bottomMenus = Menu::with('pages')->where('position', 'Bottom')->get();
        $categories = Category::get();
        $galleries = Gallery::get();
        $tags = Tag::get();
        return view('detail-perizinan', compact(
            'item',
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
