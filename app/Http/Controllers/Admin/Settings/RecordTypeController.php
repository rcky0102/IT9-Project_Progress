<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\RecordType;
use Illuminate\Http\Request;

class RecordTypeController extends Controller
{
    public function index()
    {
        return view('admin.settings.record-types.index');
    }

    public function create()
    {
        return view('admin.settings.record-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        RecordType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.settings.record-types.index')->with('success', 'Record Type created successfully.');
    }
}
