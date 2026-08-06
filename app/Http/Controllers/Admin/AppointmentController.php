<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display Appointment List
     */
    public function index(Request $request)
    {
        $appointments = Appointment::with(['customer', 'service', 'staff'])

            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('customer', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
            })

            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })

            ->latest()
            ->paginate(10);

        // Dropdown ke liye saare customers fetch kiye hain
        $customers = Customer::all();

        // Today's Appointments
        $todayAppointments = Appointment::with(['customer','service','staff'])
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();

        // Tomorrow Appointments
        $tomorrowAppointments = Appointment::with(['customer','service','staff'])
            ->whereDate('appointment_date', today()->addDay())
            ->orderBy('appointment_time')
            ->get();

        // Upcoming Appointments
        $upcomingAppointments = Appointment::with(['customer','service','staff'])
            ->whereDate('appointment_date', '>', today()->addDay())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('admin.appointments.index', compact(
            'appointments',
            'customers',
            'todayAppointments',
            'tomorrowAppointments',
            'upcomingAppointments'
        ));
    } 

    /**
     * Show Create Form
     */
    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        $staff = Staff::all();

        return view('admin.appointments.create', compact(
            'customers',
            'services',
            'staff'
        ));
    }

    /**
     * Store Appointment
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required',
            'notes' => 'nullable|string',
        ]);

        Appointment::create([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'staff_id' => $request->staff_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment added successfully.');
    }
    
    public function show(Appointment $appointment)
    {
        $appointment->load(['customer', 'service', 'staff']);

        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show Edit Form
     */
    public function edit(Appointment $appointment)
    {
        $customers = Customer::all();
        $services = Service::all();
        $staff = Staff::all();

        return view('admin.appointments.edit', compact(
            'appointment',
            'customers',
            'services',
            'staff'
        ));
    }

    /**
     * Update Appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required',
            'notes' => 'nullable|string',
        ]);

        $appointment->update([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'staff_id' => $request->staff_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Delete Appointment
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}