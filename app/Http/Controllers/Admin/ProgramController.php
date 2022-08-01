<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProgramRequest;
use App\Models\Academic;
use App\Models\Mode;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:program-list|program-create|program-edit|program-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:program-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:program-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:program-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Program::with('academic')->latest()->paginate(10);
        return view('pages.program.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Program;
        $academics = Academic::all();
        $modes = Mode::all();
        return view('pages.program.create', compact('item', 'academics', 'modes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store(
                'assets/program',
                'public'
            );
        }
        Program::create($data);
        session()->flash('success', 'Program was created.');
        return redirect()->route('program.index');
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
        $item = Program::findOrFail($id);
        $academics = Academic::all();
        $modes = Mode::all();
        return view('pages.program.edit', compact('item', 'academics', 'modes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramRequest $request, $id)
    {
        $data = $request->all();
        $item = Program::findOrFail($id);
        if ($request->file('image')) {
            Storage::delete($item->image);
            $data['image'] = $request->file('image')->store('assets/program', 'public');
        }
        $item->update($data);
        session()->flash('success', 'Program was updated.');
        return redirect()->route('program.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Program::findOrFail($id);
        Storage::delete($item->image);
        $item->delete();
        session()->flash('success', 'Program was Deleted.');
        return redirect()->route('program.index');
    }
}
