<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['customer','service','staff'])->latest()->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        $staff = Staff::all();

        return view('admin.appointments.create', compact('customers','services','staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'=>'required',
            'service_id'=>'required',
            'staff_id'=>'required',
            'appointment_date'=>'required|date',
            'appointment_time'=>'required',
            'status'=>'required',
            'remarks'=>'nullable'
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index')
                ->with('success','Appointment Added Successfully');
    }

    public function edit(Appointment $appointment)
    {
        $customers = Customer::all();
        $services = Service::all();
        $staff = Staff::all();

        return view('admin.appointments.edit',
            compact('appointment','customers','services','staff'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'customer_id'=>'required',
            'service_id'=>'required',
            'staff_id'=>'required',
            'appointment_date'=>'required|date',
            'appointment_time'=>'required',
            'status'=>'required',
            'remarks'=>'nullable'
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')
                ->with('success','Appointment Updated Successfully');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
                ->with('success','Appointment Deleted Successfully');
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }
}