@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <h4 class="text-white mb-4">Edit Customer</h4>

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control"
                    value="{{ $customer->name }}">
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control"
                    value="{{ $customer->phone }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ $customer->email }}">
            </div>

            <div class="mb-3">
                <label>Gender</label>

                <select name="gender" class="form-control">

                    <option value="Male"
                        {{ $customer->gender == 'Male' ? 'selected' : '' }}>
                        Male
                    </option>

                    <option value="Female"
                        {{ $customer->gender == 'Female' ? 'selected' : '' }}>
                        Female
                    </option>

                </select>
            </div>

            <div class="mb-3">
                <label>Address</label>

                <textarea name="address" class="form-control" rows="3">{{ $customer->address }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning">
                Update Customer
            </button>

            <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@endsection