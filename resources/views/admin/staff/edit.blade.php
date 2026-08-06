@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <h4 class="text-white mb-4">Edit Staff</h4>

        <form action="{{ route('staff.update', $staff->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control"
                    value="{{ $staff->name }}">
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control"
                    value="{{ $staff->phone }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ $staff->email }}">
            </div>

            <div class="mb-3">
                <label>Position</label>
                <input type="text" name="position" class="form-control"
                    value="{{ $staff->position }}">
            </div>

            <div class="mb-3">
                <label>Salary</label>
                <input type="number" name="salary" class="form-control"
                    value="{{ $staff->salary }}">
            </div>

            <button type="submit" class="btn btn-warning">
                Update Staff
            </button>

            <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@endsection