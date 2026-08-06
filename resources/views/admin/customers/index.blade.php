@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <div class="d-flex justify-content-between mb-4">

            <h4 class="text-white">Customers</h4>

            <a href="{{ route('customers.create') }}" class="btn btn-primary">
                Add Customer
            </a>

        </div>

        <table class="table table-dark table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            @forelse($customers as $customer)

                <tr>

                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->gender }}</td>
                    <td>{{ $customer->address }}</td>

                    <td>

                        <a href="{{ route('customers.edit',$customer->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('customers.destroy',$customer->id) }}" method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="text-center">
                        No Customers Found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection