@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <h4 class="text-white mb-4">
            Add Service
        </h4>


        <form action="{{ route('services.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="text-white">Service Name</label>
                <input type="text"
                       name="service_name"
                       class="form-control"
                       placeholder="Enter service name"
                       required>
            </div>


            <div class="mb-3">
                <label class="text-white">Price</label>
                <input type="number"
                       name="price"
                       class="form-control"
                       placeholder="Enter price"
                       required>
            </div>


            <div class="mb-3">
                <label class="text-white">Duration (Minutes)</label>
                <input type="number"
                       name="duration"
                       class="form-control"
                       placeholder="Example: 30"
                       required>
            </div>


            <div class="mb-3">
                <label class="text-white">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="4"
                          placeholder="Enter description"></textarea>
            </div>


            <div class="mb-3">
                <label class="text-white">Status</label>

                <select name="status" class="form-control">

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
                        Inactive
                    </option>

                </select>
            </div>


            <button type="submit" class="btn btn-primary">
                Save Service
            </button>


            <a href="{{ route('services.index') }}"
               class="btn btn-light">
                Back
            </a>


        </form>


    </div>

</div>

@endsection