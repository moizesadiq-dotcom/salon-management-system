<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Staff; // Staff Model Import Kiya
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $bookingQuery = Booking::query();
        $paymentQuery = Payment::query();

        if ($from) {
            $bookingQuery->whereDate('created_at', '>=', $from);
            $paymentQuery->whereDate('created_at', '>=', $from);
        }

        if ($to) {
            $bookingQuery->whereDate('created_at', '<=', $to);
            $paymentQuery->whereDate('created_at', '<=', $to);
        }

        $totalBookings = $bookingQuery->count();
        $totalCustomers = Customer::count();
        $totalServices = Service::count();

        $totalRevenue = $paymentQuery
            ->where('status', 'paid')
            ->sum('amount');

        $bookings = $bookingQuery
            ->with('customer')
            ->latest()
            ->get();

        $payments = $paymentQuery
            ->with('booking.customer')
            ->where('status', 'paid')
            ->latest()
            ->get();

        // --- NEW STAFF CATEGORIZATION CODE ---
        // 1. Stylists Fetch Karein
        $stylists = Staff::where('position', 'Stylist')->get();

        // 2. Receptionists Fetch Karein
        $receptionists = Staff::where('position', 'Receptionist')->get();

        return view('admin.reports.index', compact(
            'totalBookings',
            'totalCustomers',
            'totalServices',
            'totalRevenue',
            'bookings',
            'payments',
            'stylists',       // Added
            'receptionists',   // Added
            'from',
            'to'
        ));
    }
}