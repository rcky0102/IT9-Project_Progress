<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\RecordType;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RecordTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = RecordType::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $recordTypes = $query->orderBy('name')->get();

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
        ]);
        
    
        // Create the record type
        RecordType::create([
            'name' => $request->name,
            'charge' => $request->charge,
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
        try {
            RecordType::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Record type deleted successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Cannot delete this record type because it is being used by medical records.');
        }
    }

}
