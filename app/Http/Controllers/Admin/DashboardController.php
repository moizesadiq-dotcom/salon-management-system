<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\Commission; 
use App\Models\Feedback; // <-- 1. Feedback Model Import Kar Diya

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard.
     */
    public function index()
    {
        // Dashboard Counts
        $totalServices     = Service::count();
        $totalCustomers    = Customer::count();
        $totalStaff        = Staff::count();
        $totalBookings     = Booking::count();
        $totalPayments     = Payment::count();
        $totalAppointments = Appointment::count();

        // Total Commission Count
        $totalCommission   = Commission::count(); 

        // Total Feedbacks Count
        $totalFeedbacks    = Feedback::count(); // <-- 2. Feedback Fetch Kar Diya

        // Reports (Temporary)
        $totalReports      = $totalBookings;

        // Sirf Unread Notifications
        $notifications     = Notification::where('is_read', false)
            ->latest()
            ->take(5)
            ->get();

        // Unread Count
        $unreadNotifications = Notification::where('is_read', false)
            ->count();

        // 3. Compact Mein 'totalFeedbacks' Add Kar Diya
        return view('admin.dashboard', compact(
            'totalServices',
            'totalCustomers',
            'totalStaff',
            'totalBookings',
            'totalPayments',
            'totalAppointments',
            'totalReports',
            'totalCommission',
            'totalFeedbacks', // <-- Yahan add kiya
            'notifications',
            'unreadNotifications'
        ));
    }
}