<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:profile-list|profile-create|profile-edit|profile-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:profile-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:profile-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:profile-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Profile::latest()->paginate(10);
        return view('pages.profile.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Profile();
        return view('pages.profile.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('assets/profile', 'public');
        }
        profile::create($data);
        return redirect()->route('profile.index');
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
        $item = profile::findOrFail($id);
        return view('pages.profile.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $data = $request->all();
        $item = profile::findOrFail($id);
        if ($request->file('image')) {
            Storage::delete($item->image);
            $data['image'] = $request->file('image')->store('assets/profile', 'public');
        }

        $item->update($data);
        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = profile::findOrFail($id);
        Storage::delete($item->image);
        $item->delete();
        return redirect()->route('profile.index');
    }

    public function profilePicture()
    {
        dd('ok');
    }
}
