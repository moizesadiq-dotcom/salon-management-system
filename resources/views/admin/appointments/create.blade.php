@extends('admin.admin')

@section('content')
<div class="container-fluid pt-4 px-4">

    {{-- Header & Back Button --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white fw-bold m-0">
            <i class="fa fa-plus-circle text-danger me-2"></i>Add Appointment
        </h3>
        <a href="{{ route('appointments.index') }}" class="btn btn-danger px-4 py-2 rounded-3 shadow-sm fw-bold">
            <i class="fa fa-arrow-left me-2"></i>Back
        </a>
    </div>

    {{-- Create Form Card --}}
    <div class="bg-secondary rounded-3 p-4 border border-dark">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                {{-- Customer Selection --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Customer</label>
                    <select name="customer_id" class="form-select custom-dark-select" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name ?? $customer->customer_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Service Selection --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Service</label>
                    <select name="service_id" class="form-select custom-dark-select" required>
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->name ?? $service->service_name ?? $service->title ?? 'Service' }} - ${{ $service->price ?? 0 }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Staff / Stylist Selection --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Stylist</label>
                    <select name="staff_id" class="form-select custom-dark-select" required>
                        <option value="">Select Stylist</option>
                        @foreach($staff as $member)
                            <option value="{{ $member->id }}">{{ $member->name ?? $member->staff_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Status Selection --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Status</label>
                    <select name="status" class="form-select custom-dark-select" required>
                        <option value="Confirmed">Confirmed</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                {{-- Appointment Date --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-control bg-dark border-secondary text-white" required>
                </div>

                {{-- Appointment Time --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Appointment Time</label>
                    <input type="time" name="appointment_time" class="form-control bg-dark border-secondary text-white" required>
                </div>

                {{-- Notes --}}
                <div class="col-12">
                    <label class="form-label text-muted">Notes</label>
                    <textarea name="notes" class="form-control bg-dark border-secondary text-white" rows="3" placeholder="Enter appointment notes..."></textarea>
                </div>

                {{-- Submit Button --}}
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-danger px-4 py-2 fw-bold">
                        <i class="fa fa-save me-2"></i>Save Appointment
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

{{-- Custom Style to Fix Dropdown Option Visibility in Dark Theme --}}
<style>
    .custom-dark-select {
        background-color: #212529 !important;
        color: #ffffff !important;
        border-color: #495057 !important;
    }
    .custom-dark-select option {
        background-color: #212529 !important;
        color: #ffffff !important;
    }
</style>
@endsection