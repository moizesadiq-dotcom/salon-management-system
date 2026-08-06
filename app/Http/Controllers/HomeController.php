<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\Commission;
use App\Models\Feedback;

class HomeController extends Controller
{
    public function index()
    {
        $totalServices = Service::count();
        $totalCustomers = Customer::count();
        $totalStaff = Staff::count();
        $totalBookings = Booking::count();
        $totalPayments = Payment::count();
        $totalAppointments = Appointment::count();
        $totalReports = Report::count(); 
        $totalCommission = Commission::count(); 
        $totalFeedbacks = Feedback::count(); // Ye line add ki hai

        return view('admin.dashboard', compact(
            'totalServices', 
            'totalCustomers', 
            'totalStaff', 
            'totalBookings', 
            'totalPayments', 
            'totalAppointments', 
            'totalReports', 
            'totalCommission',
            'totalFeedbacks' // Ye bhi add kiya hai
        ));
    }
}