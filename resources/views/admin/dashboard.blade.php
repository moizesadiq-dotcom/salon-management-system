@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="row g-4">

        <!-- Total Services -->
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('services.index') }}" class="text-decoration-none">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-cut fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-white">Total Services</p>
                        <h4 class="text-white">{{ $totalServices }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Customers -->
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('customers.index') }}" class="text-decoration-none">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-success"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-white">Total Customers</p>
                        <h4 class="text-white">{{ $totalCustomers }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Staff -->
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('staff.index') }}" class="text-decoration-none">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user-tie fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-white">Total Staff</p>
                        <h4 class="text-white">{{ $totalStaff }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Bookings -->
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('bookings.index') }}" class="text-decoration-none">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar fa-3x text-info"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-white">Total Bookings</p>
                        <h4 class="text-white">{{ $totalBookings }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Payments -->
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('payments.index') }}" class="text-decoration-none">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-money-bill fa-3x text-success"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-white">Total Payments</p>
                        <h4 class="text-white">{{ $totalPayments }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Appointments -->
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('appointments.index') }}" class="text-decoration-none">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-check fa-3x text-danger"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-white">Total Appointments</p>
                        <h4 class="text-white">{{ $totalAppointments }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Reports -->
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('reports.index') }}" class="text-decoration-none">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-white">Total Reports</p>
                        <h4 class="text-white">{{ $totalReports }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Commission -->
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('commission.index') }}" class="text-decoration-none">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-percentage fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-white">Total Commission</p>
                        <h4 class="text-white">{{ $totalCommission }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Feedbacks -->
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('feedbacks.index') }}" class="text-decoration-none">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-comments fa-3x text-info"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-white">Total Feedbacks</p>
                        <h4 class="text-white">{{ $totalFeedbacks }}</h4>
                    </div>
                </div>
            </a>
        </div>

    </div>

</div>

@endsection