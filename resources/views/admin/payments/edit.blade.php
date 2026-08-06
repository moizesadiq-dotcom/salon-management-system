@extends('layouts.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <h4 class="text-white mb-4">
            Edit Payment
        </h4>


        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif



        <form action="{{ route('payments.update',$payment->id) }}" method="POST">

            @csrf
            @method('PUT')


            <div class="mb-3">

                <label class="form-label text-white">
                    Booking
                </label>


                <select name="booking_id" class="form-control">


                    @foreach($bookings as $booking)

                        <option value="{{ $booking->id }}"
                            
                            {{ $payment->booking_id == $booking->id ? 'selected' : '' }}>

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
                       value="{{ $payment->amount }}">

            </div>




            <div class="mb-3">

                <label class="form-label text-white">
                    Payment Method
                </label>


                <select name="payment_method" class="form-control">


                    <option value="cash"
                    {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>
                        Cash
                    </option>


                    <option value="card"
                    {{ $payment->payment_method == 'card' ? 'selected' : '' }}>
                        Card
                    </option>


                    <option value="online"
                    {{ $payment->payment_method == 'online' ? 'selected' : '' }}>
                        Online
                    </option>


                </select>


            </div>




            <div class="mb-3">

                <label class="form-label text-white">
                    Status
                </label>


                <select name="status" class="form-control">


                    <option value="paid"
                    {{ $payment->status == 'paid' ? 'selected' : '' }}>
                        Paid
                    </option>


                    <option value="pending"
                    {{ $payment->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>


                </select>


            </div>




            <button class="btn btn-success">
                Update Payment
            </button>


            <a href="{{ route('payments.index') }}" 
               class="btn btn-light">

                Back

            </a>


        </form>


    </div>

</div>


@endsection
