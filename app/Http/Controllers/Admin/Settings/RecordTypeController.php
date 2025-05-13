<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\RecordType;
use Illuminate\Http\Request;

class RecordTypeController extends Controller
{
    public function index()
    {
        $recordTypes = RecordType::all();
        return view('admin.settings.record-types.index', compact('recordTypes'));
    }

    public function create()
    {
        return view('admin.settings.record-types.create');
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'charge' => 'required|numeric|min:0',
            'custom_fields' => 'nullable|array',
            'custom_fields.*.name' => 'required|string|max:255',
            'custom_fields.*.type' => 'required|string|in:text,number,date,select,checkbox',
        ]);
    
        // Create the record type
        RecordType::create([
            'name' => $request->name,
            'charge' => $request->charge,
            'custom_fields' => $request->custom_fields ? json_encode($request->custom_fields) : null,
        ]);
    
        return redirect()->route('admin.settings.record-types.index')
                         ->with('success', 'Record Type created successfully.');
    }
    public function edit($id)
    {
        $recordType = RecordType::findOrFail($id);
        return view('admin.settings.record-types.edit', compact('recordType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'charge' => 'required|numeric|min:0',
        ]);

        $recordType = RecordType::findOrFail($id);
        $recordType->update([
            'name' => $request->name,
            'charge' => $request->charge,
        ]);

        return redirect()->route('admin.settings.record-types.index')
            ->with('success', 'Record Type updated successfully.');
    }

    public function destroy($id)
    {
        $recordType = RecordType::findOrFail($id);
        $recordType->delete();

        return redirect()->route('admin.settings.record-types.index')
            ->with('success', 'Record Type deleted successfully.');
    }
}
