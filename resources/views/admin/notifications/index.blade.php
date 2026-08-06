@extends('admin.admin')

@section('title', 'All Notifications')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                
                {{-- Header Section --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0 text-white">
                        <i class="fa fa-bell me-2 text-primary"></i>Notifications History
                        @if($unreadCount > 0)
                            <span class="badge bg-danger rounded-pill ms-2">{{ $unreadCount }} Unread</span>
                        @endif
                    </h4>

                    <div class="d-flex gap-2">
                        {{-- Mark All Read Button --}}
                        @if($unreadCount > 0)
                            <form action="{{ route('notifications.markAsRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-check-double me-1"></i> Mark All as Read
                                </button>
                            </form>
                        @endif

                        {{-- Clear All Read Button --}}
                        <form action="{{ route('notifications.clearAll') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to clear all read notifications?')">
                                <i class="fa fa-trash me-1"></i> Clear Read
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Success Alert Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Notifications Table --}}
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white">
                                <th scope="col" style="width: 60px;" class="text-center">Status</th>
                                <th scope="col" style="width: 200px;">Title</th>
                                <th scope="col">Message</th>
                                <th scope="col" style="width: 160px;">Time</th>
                                <th scope="col" class="text-center" style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notifications as $notification)
                                <tr class="{{ $notification->is_read ? 'text-muted' : 'fw-bold text-white bg-dark' }}">
                                    <td class="text-center">
                                        @if(!$notification->is_read)
                                            <span class="badge bg-danger p-1" title="Unread"><i class="fa fa-dot-circle"></i></span>
                                        @else
                                            <span class="badge bg-secondary p-1" title="Read"><i class="fa fa-check"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $notification->title }}</td>
                                    <td>{{ $notification->message }}</td>
                                    <td>{{ $notification->created_at ? $notification->created_at->diffForHumans() : '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1">
                                            {{-- View / Open Link Button --}}
                                            <a href="{{ route('notifications.read', $notification->id) }}" class="btn btn-sm btn-info text-white" title="View Booking / Details">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Notification" onclick="return confirm('Delete this notification?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fa fa-bell-slash fa-2x mb-2 d-block"></i>
                                        No Notifications Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="d-flex justify-content-end mt-3">
                    {{ $notifications->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection