<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ApplyRequest;
use App\Http\Requests\Admin\ContactRequest;
use App\Models\Apply;
use App\Models\Contact;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function contact(ContactRequest $request)
    {
        $data = $request->all();
        Contact::create($data);
        return back()->with('success', 'Success');
    }

    public function apply(ApplyRequest $request)
    {
        $data = $request->all();
        Apply::create($data);
        return back()->with('success', 'Success');
    }
}
