@extends('admin.admin')

@section('content')


<div class="container-fluid pt-4 px-4">


<div class="bg-secondary rounded p-4">


<h4 class="text-white mb-4">
Add Commission
</h4>


<form method="POST" action="{{route('commission.store')}}">

@csrf


<div class="mb-3">

<label class="text-white">
Select Staff
</label>

<select name="staff_id" class="form-control">

<option>Select Staff</option>

@foreach($staff as $s)

<option value="{{$s->id}}">
{{$s->name}}
</option>

@endforeach


</select>

</div>



<div class="mb-3">

<label class="text-white">
Total Sales
</label>

<input type="number"
name="total_sales"
class="form-control">

</div>



<div class="mb-3">

<label class="text-white">
Commission %
</label>

<input type="number"
name="commission_percent"
value="10"
class="form-control">

</div>



<button class="btn btn-primary">
Save
</button>


</form>


</div>


</div>


@endsection