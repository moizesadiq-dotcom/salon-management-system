@extends('admin.admin')

@section('content')
<div class="container-fluid pt-4 px-4">

    {{-- Header & Back Button --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white fw-bold m-0">
            <i class="fa fa-edit text-warning me-2"></i>Edit Appointment
        </h3>
        <a href="{{ route('appointments.index') }}" class="btn btn-danger px-4 py-2 rounded-3 shadow-sm fw-bold">
            <i class="fa fa-arrow-left me-2"></i>Back
        </a>
    </div>

    {{-- Edit Form Card --}}
    <div class="bg-secondary rounded-3 p-4 border border-dark">
        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                {{-- Customer Selection --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Customer</label>
                    <select name="customer_id" class="form-select custom-dark-select" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $appointment->customer_id == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Service Selection --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Service</label>
                    <select name="service_id" class="form-select custom-dark-select" required>
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ $appointment->service_id == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} ( ${{ $service->price }} )
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
                            <option value="{{ $member->id }}" {{ $appointment->staff_id == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status Selection --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Status</label>
                    <select name="status" class="form-select custom-dark-select" required>
                        <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="In Progress" {{ $appointment->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                {{-- Appointment Date --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-control bg-dark border-secondary text-white" value="{{ $appointment->appointment_date }}" required>
                </div>

                {{-- Appointment Time --}}
                <div class="col-md-6">
                    <label class="form-label text-muted">Appointment Time</label>
                    <input type="time" name="appointment_time" class="form-control bg-dark border-secondary text-white" value="{{ $appointment->appointment_time }}" required>
                </div>

                {{-- Notes --}}
                <div class="col-12">
                    <label class="form-label text-muted">Notes</label>
                    <textarea name="notes" class="form-control bg-dark border-secondary text-white" rows="3" placeholder="Optional notes...">{{ $appointment->notes }}</textarea>
                </div>

                {{-- Submit Button --}}
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-warning px-4 py-2 fw-bold text-dark">
                        <i class="fa fa-save me-2"></i>Update Appointment
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