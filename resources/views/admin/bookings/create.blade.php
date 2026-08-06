@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="bg-secondary rounded p-4">

                <h3 class="text-white mb-4">Add Booking</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-white">Customer</label>
                        <select name="customer_id" class="form-select" required>
                            <option value="">Select Customer</option>

                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Service</label>
                        <select name="service_id" class="form-select" required>

                            <option value="">Select Service</option>

                            @foreach($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->service_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Stylist</label>
                        <select name="staff_id" class="form-select" required>

                            <option value="">Select Stylist</option>

                            @foreach($staff as $member)
                                <option value="{{ $member->id }}">
                                    {{ $member->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Booking Date</label>
                        <input type="date"
                               name="booking_date"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Booking Time</label>
                        <input type="time"
                               name="booking_time"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Amount</label>
                        <input type="number"
                               step="0.01"
                               name="amount"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Status</label>

                        <select name="status" class="form-select">

                            <option value="Pending">Pending</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-white">Remarks</label>

                        <textarea
                            name="remarks"
                            rows="3"
                            class="form-control"
                        ></textarea>
                    </div>

                    <button class="btn btn-primary">
                        Save Booking
                    </button>

                    <a href="{{ route('bookings.index') }}"
                       class="btn btn-secondary">
                        Back
                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection