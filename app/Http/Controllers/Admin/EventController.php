<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Models\Event;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:event-list|event-create|event-edit|event-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:event-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:event-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Event::latest()->paginate(10);
        return view('pages.event.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Event();
        return view('pages.event.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store(
                'assets/event',
                'public'
            );
        }
        Event::create($data);
        session()->flash('success', 'Event was created.');
        return redirect()->route('event.create');
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
        $item = Event::findOrFail($id);
        return view('pages.event.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        $data = $request->all();
        $item = Event::findOrFail($id);
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            Storage::delete($item->image);
            $data['image'] = $request->file('image')->store('assets/event', 'public');
        }
        $item->update($data);
        session()->flash('success', 'Event was updated.');

        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Event::findOrFail($id);
        Storage::delete($item->image);
        $item->delete();
        session()->flash('success', 'Event was deleted.');

        return redirect()->route('event.index');
    }
}
