@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <h4 class="text-white mb-4">
            Add {{ $position }}
        </h4>

        <form action="{{ route('staff.store') }}" method="POST">

            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label text-white">
                    {{ $position }} Name
                </label>

                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Enter {{ strtolower($position) }} name"
                       required>
            </div>


            <!-- Phone -->
            <div class="mb-3">
                <label class="form-label text-white">
                    Phone
                </label>

                <input type="text"
                       name="phone"
                       class="form-control"
                       placeholder="Enter phone number"
                       required>
            </div>


            <!-- Email -->
            <div class="mb-3">
                <label class="form-label text-white">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter email address">
            </div>


            <!-- Position -->
            <div class="mb-3">
                <label class="form-label text-white">
                    Position
                </label>

                <input type="text"
                       name="position"
                       class="form-control"
                       value="{{ $position }}"
                       readonly>
            </div>


            <!-- Salary -->
            <div class="mb-3">
                <label class="form-label text-white">
                    Salary
                </label>

                <input type="number"
                       name="salary"
                       class="form-control"
                       placeholder="Enter salary"
                       required>
            </div>


            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">
                Save {{ $position }}
            </button>

            <a href="{{ route('staff.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@endsection