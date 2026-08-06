@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <h4 class="text-white mb-4">Add Payment</h4>


        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif



        <form action="{{ route('payments.store') }}" method="POST">

            @csrf


            <div class="mb-3">

                <label class="form-label text-white">
                    Booking
                </label>

                <select name="booking_id" class="form-control">

                    <option value="">
                        Select Booking
                    </option>


                    @foreach($bookings as $booking)

                        <option value="{{ $booking->id }}">

                            #{{ $booking->id }} -
                            {{ $booking->customer->name ?? 'N/A' }}

                        </option>

                    @endforeach


                </select>

            </div>



            <div class="mb-3">

                <label class="form-label text-white">
                    Amount
                </label>

                <input type="number"
                       name="amount"
                       class="form-control"
                       placeholder="Enter Amount">

            </div>



            <div class="mb-3">

                <label class="form-label text-white">
                    Payment Method
                </label>


                <select name="payment_method" class="form-control">

                    <option value="cash">
                        Cash
                    </option>

                    <option value="card">
                        Card
                    </option>

                    <option value="online">
                        Online
                    </option>

                </select>

            </div>




            <div class="mb-3">

                <label class="form-label text-white">
                    Status
                </label>


                <select name="status" class="form-control">

                    <option value="paid">
                        Paid
                    </option>

                    <option value="pending">
                        Pending
                    </option>

                </select>


            </div>



            <button class="btn btn-primary">
                Save Payment
            </button>


            <a href="{{ route('payments.index') }}" 
               class="btn btn-light">

                Back

            </a>


        </form>


    </div>

</div>


@endsection