namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        // Fetch patients associated with this doctor through appointments
        $patients = Appointment::where('doctor_id', $doctor->id)
            ->with(['patient', 'patient.medicalRecords']) // Eager load medical records through patient
            ->get()
            ->pluck('patient')
            ->unique('id'); // Ensures no duplicates

        // Get the latest medical record for each patient
        $latestMedicalRecords = MedicalRecord::whereIn('patient_id', $patients->pluck('id'))
            ->latest()
            ->get()
            ->keyBy('patient_id'); // Keyed by patient_id to ensure we get the latest per patient

        return view('doctor.patients.index', compact('patients', 'latestMedicalRecords'));
    }

    public function show($id)
    {
        $doctor = Auth::user()->doctor;

        // Check if this patient has an appointment with the current doctor
        $hasAppointment = Appointment::where('doctor_id', $doctor->id)
            ->where('patient_id', $id)
            ->exists();

        if (!$hasAppointment) {
            return redirect()->route('doctor.patients.index')
                ->with('error', 'You do not have permission to view this patient.');
        }

        $patient = Patient::with(['user', 'medicalRecords' => function ($query) {
            $query->latest(); // Sort medical records by newest first
        }])->findOrFail($id);

        return view('doctor.patient-show', compact('patient'));
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('doctor.patient-edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        // Update the patient's details
        $patient->update($request->all());

        return redirect()->route('doctor.patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('doctor.patients.index')->with('success', 'Patient deleted successfully');
    }
}
