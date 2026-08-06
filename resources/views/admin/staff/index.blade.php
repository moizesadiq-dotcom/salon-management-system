@extends('admin.admin')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-secondary rounded p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="text-white">
                Staff
            </h4>


            <!-- Add Staff Dropdown -->
            <div class="dropdown">

                <button class="btn btn-primary dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                    Add Staff

                </button>


                <ul class="dropdown-menu dropdown-menu-dark">

                    <!-- Stylist -->
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('staff.create', ['position' => 'Stylist']) }}">

                            ✂ Add Stylist

                        </a>
                    </li>


                    <!-- Receptionist -->
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('staff.create', ['position' => 'Receptionist']) }}">

                            👩‍💼 Add Receptionist

                        </a>
                    </li>

                </ul>

            </div>

        </div>


        <!-- Success Message -->
        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        <!-- Staff Table -->
        <table class="table table-dark table-hover">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>

            </thead>


            <tbody>

                @forelse($staff as $member)

                    <tr>

                        <td>
                            {{ $member->id }}
                        </td>

                        <td>
                            {{ $member->name }}
                        </td>

                        <td>
                            {{ $member->phone }}
                        </td>

                        <td>
                            {{ $member->email }}
                        </td>

                        <td>
                            {{ $member->position }}
                        </td>

                        <td>
                            Rs {{ number_format($member->salary, 2) }}
                        </td>

                        <td>

                            <!-- Edit -->
                            <a href="{{ route('staff.edit', $member->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>


                            <!-- Delete -->
                            <form action="{{ route('staff.destroy', $member->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center">

                            No Staff Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection