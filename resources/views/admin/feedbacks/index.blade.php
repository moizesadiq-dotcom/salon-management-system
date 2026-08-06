@extends('layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-dark text-success border-success" role="alert">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white fw-bold m-0">
            <i class="fa fa-comments text-primary me-2"></i>Customer Feedbacks
        </h3>
    </div>

    <div class="bg-secondary rounded-3 p-4 border border-dark">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0 text-nowrap">
                <thead class="text-muted uppercase small border-bottom border-secondary">
                    <tr>
                        <th scope="col" class="py-3">#ID</th>
                        <th scope="col" class="py-3">Customer Name</th>
                        <th scope="col" class="py-3">Rating</th>
                        <th scope="col" class="py-3">Comments</th>
                        <th scope="col" class="py-3">Submitted At</th>
                        <th scope="col" class="py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="border-0">
                    @forelse($feedbacks as $feedback)
                    <tr>
                        <td class="fw-bold">{{ $feedback->id }}</td>
                        <td class="text-white fw-semibold">{{ $feedback->name ?? 'Guest Customer' }}</td>
                        <td>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= ($feedback->rating ?? 5))
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td class="text-white-50" style="max-width: 300px; white-space: normal;">
                            {{ $feedback->comment ?? 'No comment provided.' }}
                        </td>
                        <td>{{ $feedback->created_at ? $feedback->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.feedbacks.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger px-3 rounded-2 fw-bold">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fa fa-comment-slash fa-2x mb-2 d-block"></i>
                            No Customer Feedbacks Found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection