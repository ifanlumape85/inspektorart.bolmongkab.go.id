<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Information;
use App\Models\Menu;
use App\Models\News;
use App\Models\Slide;
use App\Models\Tag;
use App\Models\Profile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slides = Slide::take(3)->get();
        $profile = Profile::firstOrFail();
        $menus = Menu::with('pages')->where('position', 'Top')->get();
        $bottomMenus = Menu::with('pages')->where('position', 'Bottom')->get();
        $categories = Category::get();
        $information = Information::take(4)->get();
        $events = Event::take(4)->get();
        $news = News::take(3)->get();
        $galleries = Gallery::get();

        return view('home', compact(
            'slides',
            'profile',
            'menus',
            'bottomMenus',
            'events',
            'news',
            'galleries',
            'categories',
            'information'
        ));
    }

    public function event()
    {
        $events = Event::latest()->paginate(4);
        $profile = Profile::firstOrFail();
        $menus = Menu::with('pages')->where('position', 'Top')->get();
        $bottomMenus = Menu::with('pages')->where('position', 'Bottom')->get();
        $categories = Category::get();
        $breadcrumb_h1 = 'Event Calendar';
        $breadcrumb_title = 'Event Calendar';

        return view('events', compact(
            'events',
            'profile',
            'menus',
            'bottomMenus',
            'categories',
            'breadcrumb_h1',
            'breadcrumb_title'
        ));
    }

    public function contact()
    {
        $profile = Profile::firstOrFail();
        $menus = Menu::with('pages')->where('position', 'Top')->get();
        $bottomMenus = Menu::with('pages')->where('position', 'Bottom')->get();
        $categories = Category::get();
        $breadcrumb_h1 = 'Contacts';
        $breadcrumb_title = 'Form';
        return view('contact', compact(
            'menus',
            'bottomMenus',
            'profile',
            'categories',
            'breadcrumb_h1',
            'breadcrumb_title'
        ));
    }


    public function news()
    {
        $items = News::latest()->paginate(4);
        $recents = News::take(3)->get();
        $breadcrumb_h1 = 'All News';
        $breadcrumb_title = 'Page'; //$category->name;
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
