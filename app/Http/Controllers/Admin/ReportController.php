<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecordType;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

public function edit($id)
{
    $recordType = RecordType::findOrFail($id);  // Find the record type by ID

    return view('admin.settings.record-types.edit', compact('recordType'));  // Pass the record type to the edit view
}


public function update(Request $request, $id)
{
    // Validate the input fields
    $request->validate([
        'name' => 'required|string|max:255',
        'charge' => 'required|numeric|min:0',
    ]);

    $recordType = RecordType::findOrFail($id);  // Find the record type by ID
    $recordType->name = $request->name;
    $recordType->charge = $request->charge;



    $recordType->save();  // Save the updated record type

    return redirect()->route('settings.record-types.index')->with('success', 'Record Type updated successfully!');
}

}
