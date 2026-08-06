@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <h4 class="text-white mb-4">
            Edit Service
        </h4>


        <form action="{{ route('services.update',$service->id) }}" method="POST">

            @csrf
            @method('PUT')


            <div class="mb-3">
                <label class="text-white">
                    Service Name
                </label>

                <input type="text"
                       name="service_name"
                       class="form-control"
                       value="{{ $service->service_name }}"
                       required>
            </div>


            <div class="mb-3">
                <label class="text-white">
                    Price
                </label>

                <input type="number"
                       name="price"
                       class="form-control"
                       value="{{ $service->price }}"
                       required>
            </div>


            <div class="mb-3">
                <label class="text-white">
                    Duration (Minutes)
                </label>

                <input type="number"
                       name="duration"
                       class="form-control"
                       value="{{ $service->duration }}"
                       required>
            </div>


            <div class="mb-3">
                <label class="text-white">
                    Description
                </label>

                <textarea name="description"
                          class="form-control"
                          rows="4">{{ $service->description }}</textarea>
            </div>


            <div class="mb-3">

                <label class="text-white">
                    Status
                </label>

                <select name="status" class="form-control">

                    <option value="1"
                    {{ $service->status == 1 ? 'selected' : '' }}>
                        Active
                    </option>


                    <option value="0"
                    {{ $service->status == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>


            <button type="submit" class="btn btn-success">
                Update Service
            </button>


            <a href="{{ route('services.index') }}"
               class="btn btn-light">
                Back
            </a>


        </form>


    </div>

</div>

@endsection