@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-white mb-0">Bookings</h4>

            <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i> Add Booking
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Responsive Table -->
        <div class="table-responsive">

            <table class="table table-dark table-bordered table-hover align-middle text-nowrap">

                <thead class="text-center">

                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Stylist</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th width="180">Action</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($bookings as $booking)

                    <tr>

                        <td>{{ $booking->id }}</td>

                        <td>{{ $booking->customer->name ?? '-' }}</td>

                        <td>{{ $booking->service->service_name ?? '-' }}</td>

                        <td>{{ $booking->staff->name ?? '-' }}</td>

                        <td>{{ $booking->booking_date }}</td>

                        <td>{{ $booking->booking_time }}</td>

                        <td>Rs. {{ number_format($booking->amount,2) }}</td>

                        <td class="text-center">
                            <span class="badge bg-info">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>

                        <td>{{ $booking->remarks }}</td>

                        <td class="text-center">

                            <a href="{{ route('bookings.edit',$booking->id) }}"
                               class="btn btn-warning btn-sm mb-1">
                                Edit
                            </a>

                            <form action="{{ route('bookings.destroy',$booking->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete this booking?')"
                                        class="btn btn-danger btn-sm">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="text-center">
                            No Bookings Found
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection