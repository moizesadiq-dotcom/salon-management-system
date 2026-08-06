@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="text-white mb-0">
                <i class="fa fa-money-bill me-2 text-primary"></i>
                Payments
            </h4>

            <a href="{{ route('payments.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>
                Add Payment
            </a>

        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Payment Table -->
        <div class="table-responsive">

            <table class="table table-dark table-bordered table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Booking</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th style="min-width: 100px;">Action</th>
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
                            #{{ $payment->booking->id ?? 'N/A' }}
                        </td>

                        <td>
                            Rs. {{ number_format($payment->amount, 2) }}
                        </td>

                        <td>
                            {{ $payment->payment_method ?? 'N/A' }}
                        </td>

                        <td>
                            <span class="badge bg-info">
                                {{ $payment->status ?? 'N/A' }}
                            </span>
                        </td>

                        <td>

                            <form action="{{ route('payments.destroy', $payment->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this payment?')">

                                    <i class="fa fa-trash me-1"></i>
                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center py-4">
                            No Payments Found
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection