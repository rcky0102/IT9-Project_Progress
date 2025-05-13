<?php
namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        dd($appointments);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function updateStatus(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = $request->status;  // Status like 'confirmed', 'cancelled', etc.
    $appointment->save();

    return redirect()->route('admin.appointments.index')->with('status', 'Appointment status updated!');
}
}
