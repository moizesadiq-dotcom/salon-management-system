@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="text-white">
                <i class="fa fa-calendar-check me-2"></i>
                Appointment Details
            </h4>

            <div>
                <button onclick="window.print()" class="btn btn-success me-2">
                    <i class="fa fa-print"></i> Print
                </button>

                <a href="{{ route('appointments.index') }}" class="btn btn-danger">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

        </div>

        <div class="row">

            <!-- Customer Information -->
            <div class="col-md-6">
                <div class="card bg-dark text-white mb-3">
                    <div class="card-header bg-primary">
                        <i class="fa fa-user me-2"></i> Customer Information
                    </div>

                    <div class="card-body">

                        <p><strong>Name:</strong>
                            {{ $appointment->customer->name ?? '-' }}
                        </p>

                        <p><strong>Email:</strong>
                            {{ $appointment->customer->email ?? '-' }}
                        </p>

                        <p><strong>Phone:</strong>
                            {{ $appointment->customer->phone ?? '-' }}
                        </p>

                    </div>
                </div>
            </div>

            <!-- Appointment Information -->
            <div class="col-md-6">
                <div class="card bg-dark text-white mb-3">

                    <div class="card-header bg-info">
                        <i class="fa fa-calendar me-2"></i>
                        Appointment Information
                    </div>

                    <div class="card-body">

                        <p>
                            <strong>Service:</strong>
                            {{ $appointment->service->name ?? '-' }}
                        </p>

                        <p>
                            <strong>Stylist:</strong>
                            {{ $appointment->staff->name ?? '-' }}
                        </p>

                        <p>
                            <strong>Date:</strong>
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                        </p>

                        <p>
                            <strong>Time:</strong>
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </p>

                    </div>

                </div>
            </div>

            <!-- Status -->
            <div class="col-md-6">

                <div class="card bg-dark text-white mb-3">

                    <div class="card-header bg-warning text-dark">
                        <i class="fa fa-check-circle me-2"></i>
                        Appointment Status
                    </div>

                    <div class="card-body">

                        @if($appointment->status == 'Pending')
                            <span class="badge bg-warning fs-6">Pending</span>

                        @elseif($appointment->status == 'Confirmed')
                            <span class="badge bg-info fs-6">Confirmed</span>

                        @elseif($appointment->status == 'In Progress')
                            <span class="badge bg-primary fs-6">In Progress</span>

                        @elseif($appointment->status == 'Completed')
                            <span class="badge bg-success fs-6">Completed</span>

                        @else
                            <span class="badge bg-danger fs-6">Cancelled</span>
                        @endif

                    </div>

                </div>

            </div>

            <!-- Notes -->
            <div class="col-md-6">

                <div class="card bg-dark text-white mb-3">

                    <div class="card-header bg-secondary">
                        <i class="fa fa-sticky-note me-2"></i>
                        Notes
                    </div>

                    <div class="card-body">

                        {{ $appointment->notes ?: 'No Notes Available.' }}

                    </div>

                </div>

            </div>

            <!-- Created At -->
            <div class="col-md-6">

                <div class="card bg-dark text-white mb-3">

                    <div class="card-header bg-success">
                        Created At
                    </div>

                    <div class="card-body">
                        {{ $appointment->created_at->format('d M Y h:i A') }}
                    </div>

                </div>

            </div>

            <!-- Updated At -->
            <div class="col-md-6">

                <div class="card bg-dark text-white mb-3">

                    <div class="card-header bg-danger">
                        Last Updated
                    </div>

                    <div class="card-body">
                        {{ $appointment->updated_at->format('d M Y h:i A') }}
                    </div>

                </div>

            </div>

        </div>

        <hr>

        <div class="text-end">

            <a href="{{ route('appointments.edit',$appointment->id) }}"
               class="btn btn-warning">
                <i class="fa fa-edit"></i>
                Edit
            </a>

            <a href="{{ route('appointments.index') }}"
               class="btn btn-secondary">
                Close
            </a>

        </div>

    </div>

</div>

@endsection