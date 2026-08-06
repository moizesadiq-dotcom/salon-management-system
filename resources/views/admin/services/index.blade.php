@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <div class="d-flex justify-content-between mb-4">
            <h4 class="text-white">Services</h4>

            <a href="{{ route('services.create') }}" class="btn btn-primary">
                Add Service
            </a>
        </div>


        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <div class="table-responsive">

            <table class="table text-white">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Service Name</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>


                <tbody>

                @foreach($services as $service)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $service->service_name }}
                        </td>

                        <td>
                            Rs {{ $service->price }}
                        </td>

                        <td>
                            {{ $service->duration }} Minutes
                        </td>

                        <td>

                            @if($service->status == 1)
                                <span class="badge bg-success">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Inactive
                                </span>
                            @endif

                        </td>


                        <td>

                            <a href="{{ route('services.edit',$service->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>


                            <form action="{{ route('services.destroy',$service->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete Service?')">
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