@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">


@if(session('success'))

<div class="alert alert-success">
{{session('success')}}
</div>

@endif


<div class="bg-secondary rounded p-4">


<div class="d-flex justify-content-between mb-4">

<h4 class="text-white">
Staff Commission
</h4>


<a href="{{route('commission.create')}}" 
class="btn btn-primary">

+ Add Commission

</a>


</div>


<div class="table-responsive">

<table class="table table-dark">

<thead>

<tr>

<th>Staff</th>
<th>Total Sales</th>
<th>Commission %</th>
<th>Amount</th>
<th>Action</th>

</tr>

</thead>


<tbody>


@foreach($commissions as $commission)

<tr>


<td>
{{$commission->staff->name}}
</td>


<td>
Rs {{$commission->total_sales}}
</td>


<td>
{{$commission->commission_percent}}%
</td>


<td>
Rs {{$commission->commission_amount}}
</td>


<td>


<form action="{{route('commission.destroy',$commission->id)}}" method="POST">

@csrf
@method('DELETE')


<button class="btn btn-danger btn-sm">
Delete
</button>


</form>


</td>


</tr>


@endforeach


</tbody>

</table>

</div>


</div>


</div>


@endsection