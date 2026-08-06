<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Notification;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['customer', 'service', 'staff'])
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        $staff = Staff::all();

        return view('admin.bookings.create', compact(
            'customers',
            'services',
            'staff'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'  => 'required|exists:customers,id',
            'service_id'   => 'required|exists:services,id',
            'staff_id'     => 'required|exists:staff,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'amount'       => 'required|numeric',
            'status'       => 'required',
            'remarks'      => 'nullable'
        ]);

        // Booking Save
        $booking = Booking::create([
            'customer_id'  => $request->customer_id,
            'service_id'   => $request->service_id,
            'staff_id'     => $request->staff_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'amount'       => $request->amount,
            'status'       => $request->status,
            'remarks'      => $request->remarks,
        ]);

        // Customer & Service Details
        $customer = Customer::find($request->customer_id);
        $service  = Service::find($request->service_id);

        // Notification Save
        Notification::create([
            'title'   => 'New Booking',
            'message' => ($customer->name ?? 'Customer') . ' booked ' . ($service->name ?? 'Service'),
            'is_read' => 0,
        ]);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking Added Successfully');
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $customers = Customer::all();
        $services  = Service::all();
        $staff      = Staff::all();

        return view('admin.bookings.edit', compact(
            'booking',
            'customers',
            'services',
            'staff'
        ));
    }

    public function update(Request $request, Booking $booking)
    {
        // Validation including Foreign Keys
        $request->validate([
            'customer_id'  => 'required|exists:customers,id',
            'service_id'   => 'required|exists:services,id',
            'staff_id'     => 'required|exists:staff,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'amount'       => 'required|numeric',
            'status'       => 'required',
            'remarks'      => 'nullable'
        ]);

        // Complete Booking Update
        $booking->update([
            'customer_id'  => $request->customer_id,
            'service_id'   => $request->service_id,
            'staff_id'     => $request->staff_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'amount'       => $request->amount,
            'status'       => $request->status,
            'remarks'      => $request->remarks,
        ]);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking Updated Successfully');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking Deleted Successfully');
    }
}