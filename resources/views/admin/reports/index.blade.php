@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    {{-- Page Heading --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="text-white mb-1">Reports</h3>
            <p class="text-muted mb-0">Salon management reports and analytics</p>
        </div>
    </div>


    {{-- Date Filter --}}
    <div class="bg-secondary rounded p-4 mb-4">

        <h6 class="text-white mb-3">
            <i class="fa fa-filter me-2"></i>Filter Report
        </h6>

        <form action="{{ route('reports.index') }}" method="GET">

            <div class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label class="form-label text-white">From Date</label>
                    <input
                        type="date"
                        name="from"
                        value="{{ $from }}"
                        class="form-control bg-dark text-white border-0"
                    >
                </div>

                <div class="col-md-4">
                    <label class="form-label text-white">To Date</label>
                    <input
                        type="date"
                        name="to"
                        value="{{ $to }}"
                        class="form-control bg-dark text-white border-0"
                    >
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa fa-search me-1"></i> Filter
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('reports.index') }}"
                       class="btn btn-dark w-100">
                        <i class="fa fa-refresh me-1"></i> Reset
                    </a>
                </div>

            </div>

        </form>

    </div>


    {{-- Report Cards --}}
    <div class="row g-4 mb-4">

        {{-- Bookings --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">

                <i class="fa fa-calendar-check fa-3x text-primary"></i>

                <div class="ms-3">
                    <p class="mb-2 text-white">Total Bookings</p>
                    <h6 class="mb-0 text-white">
                        {{ $totalBookings }}
                    </h6>
                </div>

            </div>
        </div>


        {{-- Customers --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">

                <i class="fa fa-users fa-3x text-success"></i>

                <div class="ms-3">
                    <p class="mb-2 text-white">Total Customers</p>
                    <h6 class="mb-0 text-white">
                        {{ $totalCustomers }}
                    </h6>
                </div>

            </div>
        </div>


        {{-- Services --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">

                <i class="fa fa-scissors fa-3x text-warning"></i>

                <div class="ms-3">
                    <p class="mb-2 text-white">Total Services</p>
                    <h6 class="mb-0 text-white">
                        {{ $totalServices }}
                    </h6>
                </div>

            </div>
        </div>


        {{-- Revenue --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">

                <i class="fa fa-dollar-sign fa-3x text-info"></i>

                <div class="ms-3">
                    <p class="mb-2 text-white">Total Revenue</p>
                    <h6 class="mb-0 text-white">
                        ${{ number_format($totalRevenue, 2) }}
                    </h6>
                </div>

            </div>
        </div>

    </div>


    {{-- Booking Report --}}
    <div class="bg-secondary rounded p-4 mb-4">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 text-white">
                <i class="fa fa-calendar me-2"></i>Booking Report
            </h6>
        </div>

        <div class="table-responsive">

            <table class="table table-dark table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Booking Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $booking->customer->name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $booking->created_at->format('d M Y') }}
                            </td>

                            <td>
                                ${{ number_format($booking->amount ?? 0, 2) }}
                            </td>

                            <td>

                                @if(isset($booking->status))

                                    @if($booking->status == 'completed')

                                        <span class="badge bg-success">
                                            Completed
                                        </span>

                                    @elseif($booking->status == 'pending')

                                        <span class="badge bg-warning">
                                            Pending
                                        </span>

                                    @else

                                        <span class="badge bg-info">
                                            {{ ucfirst($booking->status) }}
                                        </span>

                                    @endif

                                @else

                                    <span class="badge bg-secondary">
                                        N/A
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No booking records found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Payment Report --}}
    <div class="bg-secondary rounded p-4 mb-4">

        <div class="d-flex align-items-center justify-content-between mb-4">

            <h6 class="mb-0 text-white">
                <i class="fa fa-credit-card me-2"></i>Payment Report
            </h6>

        </div>

        <div class="table-responsive">

            <table class="table table-dark table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($payments as $payment)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $payment->booking->customer->name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ ucfirst($payment->payment_method ?? 'Cash') }}
                            </td>

                            <td>
                                ${{ number_format($payment->amount ?? 0, 2) }}
                            </td>

                            <td>

                                @if($payment->status == 'paid')

                                    <span class="badge bg-success">
                                        Paid
                                    </span>

                                @else

                                    <span class="badge bg-warning">
                                        {{ ucfirst($payment->status) }}
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $payment->created_at->format('d M Y') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No payment records found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection