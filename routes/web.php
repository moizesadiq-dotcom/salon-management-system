<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\FeedbackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Website Home
Route::get('/', function () {
    return view('welcome');
});


// Authentication Routes
Auth::routes();


// Home
Route::get('/home', [HomeController::class, 'index'])
    ->name('home');


// ===================== ADMIN DASHBOARD =====================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');


// ===================== SERVICES =====================

Route::resource('services', ServiceController::class);


// ===================== CUSTOMERS =====================

Route::resource('customers', CustomerController::class);


// ===================== STAFF =====================

Route::resource('staff', StaffController::class);


// Add Stylist
Route::get('/staff/create/stylist', function () {
    return redirect()->route('staff.create', [
        'position' => 'Stylist'
    ]);
})->name('staff.create.stylist');


// Add Receptionist
Route::get('/staff/create/receptionist', function () {
    return redirect()->route('staff.create', [
        'position' => 'Receptionist'
    ]);
})->name('staff.create.receptionist');


// ===================== APPOINTMENTS =====================

Route::resource('appointments', AppointmentController::class);


// ===================== BOOKINGS =====================

Route::resource('bookings', BookingController::class);


// ===================== PAYMENTS =====================

Route::resource('payments', PaymentController::class);


// ===================== REPORTS =====================

Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');


// ===================== COMMISSION =====================

Route::resource('commission', CommissionController::class);

// ===================== NOTIFICATIONS =====================

// Notifications List Page
Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');

// Individual Notification Read & Redirect Route
Route::get('/notifications/read/{id}', [NotificationController::class, 'read'])
    ->name('notifications.read');

// AJAX Mark All Notifications As Read Route
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])
    ->name('notifications.markAsRead');

// Single Notification Delete
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
    ->name('notifications.destroy');

// Clear All Read Notifications
Route::post('/notifications/clear-all', [NotificationController::class, 'clearAll'])
    ->name('notifications.clearAll');

    // ===================== FEEDBACKS =====================



Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy'); 