@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

<div class="bg-secondary rounded p-4">

<h4 class="text-white mb-4">Edit Booking</h4>

<form action="{{ route('bookings.update',$booking->id) }}" method="POST">

@csrf
@method('PUT')


<div class="mb-3">
<label class="text-white">Customer</label>

<select name="customer_id" class="form-control">

@foreach($customers as $customer)

<option value="{{ $customer->id }}"
{{ $booking->customer_id == $customer->id ? 'selected' : '' }}>

{{ $customer->name }}

</option>

@endforeach

</select>
</div>



<div class="mb-3">
<label class="text-white">Service</label>

<select name="service_id" class="form-control">

@foreach($services as $service)

<option value="{{ $service->id }}"
{{ $booking->service_id == $service->id ? 'selected' : '' }}>

{{ $service->name }}

</option>

@endforeach

</select>

</div>



<div class="mb-3">
<label class="text-white">Staff</label>

<select name="staff_id" class="form-control">

@foreach($staff as $member)

<option value="{{ $member->id }}"
{{ $booking->staff_id == $member->id ? 'selected' : '' }}>

{{ $member->name }}

</option>

@endforeach

</select>

</div>



<div class="mb-3">
<label class="text-white">Booking Date</label>

<input type="date"
name="booking_date"
value="{{ $booking->booking_date }}"
class="form-control">

</div>



<div class="mb-3">
<label class="text-white">Booking Time</label>

<input type="time"
name="booking_time"
value="{{ $booking->booking_time }}"
class="form-control">

</div>



<div class="mb-3">
<label class="text-white">Amount</label>

<input type="number"
name="amount"
value="{{ $booking->amount }}"
class="form-control">

</div>



<div class="mb-3">
<label class="text-white">Status</label>

<select name="status" class="form-control">

<option value="pending" {{ $booking->status=='pending'?'selected':'' }}>
Pending
</option>

<option value="completed" {{ $booking->status=='completed'?'selected':'' }}>
Completed
</option>

<option value="cancelled" {{ $booking->status=='cancelled'?'selected':'' }}>
Cancelled
</option>

</select>

</div>



<div class="mb-3">
<label class="text-white">Remarks</label>

<textarea name="remarks" class="form-control">{{ $booking->remarks }}</textarea>

</div>


<button class="btn btn-success">
Update Booking
</button>


</form>

</div>

</div>

@endsection