<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Salon Management')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('admin/img/favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template CSS -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: #191C24;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #191C24;
            position: fixed;
            left: 0;
            top: 0;
            transition: .3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.hide {
            left: -260px;
        }

        .content {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            transition: .3s ease;
        }

        .navbar-nav .nav-link {
            padding: 13px 20px;
            margin: 5px 10px;
            border-radius: 12px;
            color: #ffffff;
            transition: .3s;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: #0d6efd;
            color: #fff !important;
        }

        /* Dropdown display & layering fix */
        .dropdown-menu {
            z-index: 1050 !important;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
        }

        .dropdown-item {
            color: #fff !important;
        }

        .dropdown-item:hover {
            background-color: #0d6efd !important;
        }

        .card {
            border: none;
            border-radius: 16px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn {
            border-radius: 10px;
        }

        /* Select Options Dropdown Text & Background Fix */
        select.form-control, 
        select.form-select,
        select option {
            color: #000000 !important;
            background-color: #ffffff !important;
        }

        select:focus {
            color: #000000 !important;
            background-color: #ffffff !important;
        }

        @media(max-width:991px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.show {
                left: 0;
            }

            .content {
                width: 100%;
                margin-left: 0;
            }
        }

        @media(max-width:768px) {
            .card {
                margin-bottom: 15px;
            }

            .table th,
            .table td {
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- Sidebar Start -->
    <div class="sidebar bg-secondary">
        <nav class="navbar navbar-dark flex-column">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand py-4 text-center w-100">
                <h3 class="text-primary fw-bold">
                    <i class="fa fa-cut me-2"></i>Salon
                </h3>
            </a>

            <div class="navbar-nav w-100">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                </a>

                <a href="{{ route('services.index') }}"
                   class="nav-item nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                    <i class="fa fa-cut me-2"></i>Services
                </a>

                <a href="{{ route('customers.index') }}"
                   class="nav-item nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    <i class="fa fa-users me-2"></i>Customers
                </a>

                <a href="{{ route('staff.index') }}"
                   class="nav-item nav-link {{ request()->routeIs('staff.*') ? 'active' : '' }}">
                    <i class="fa fa-user-tie me-2"></i>Staff
                </a>

                <a href="{{ route('bookings.index') }}"
                   class="nav-item nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                    <i class="fa fa-calendar-check me-2"></i>Bookings
                </a>

                <a href="{{ route('payments.index') }}"
                   class="nav-item nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                    <i class="fa fa-money-bill-wave me-2"></i>Payments
                </a>

                <a href="{{ route('appointments.index') }}"
                   class="nav-item nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                    <i class="fa fa-calendar-alt me-2"></i>Appointments
                </a>

                <a href="{{ route('reports.index') }}"
                   class="nav-item nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="fa fa-chart-bar me-2"></i>Reports
                </a>

                <a href="{{ route('commission.index') }}"
                   class="nav-item nav-link {{ request()->routeIs('commission.*') ? 'active' : '' }}">
                    <i class="fa fa-money-bill me-2"></i>Commission
                </a>

                <hr class="dropdown-divider bg-dark">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       class="nav-item nav-link text-danger"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fa fa-sign-out-alt me-2"></i>Logout
                    </a>
                </form>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">

        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-2">
            <button class="btn btn-primary d-lg-none me-3" id="sidebarToggle">
                <i class="fa fa-bars"></i>
            </button>

            <div class="navbar-nav align-items-center ms-auto">

                @php
                    $unreadNotifications = \App\Models\Notification::where('is_read', 0)->latest()->get();
                    $unreadCount = $unreadNotifications->count();
                @endphp

                <!-- Dynamic Notification Dropdown Start -->
                <div class="nav-item dropdown" id="notificationDropdown">
                    <a href="#" class="nav-link dropdown-toggle position-relative" id="notificationBellBtn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell me-lg-2"></i>
                        <span class="d-none d-lg-inline-flex">Notifications</span>
                        
                        <!-- Notification Badge -->
                        <span class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle" 
                              id="notificationBadge" 
                              style="{{ $unreadCount == 0 ? 'display:none;' : '' }}">
                            {{ $unreadCount }}
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-3 rounded-bottom m-0 p-0" style="width: 300px;">
                        <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-0 text-white">Notifications</h6>
                            <span class="badge bg-primary" id="notificationHeaderCount">{{ $unreadCount }} Unread</span>
                        </div>
                        
                        <div id="notificationListItems" style="max-height: 250px; overflow-y: auto;">
                            @forelse($unreadNotifications as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item py-2 px-3 border-bottom text-white">
                                    <div class="fw-bold text-primary small">{{ $notification->title }}</div>
                                    <div class="text-white small">{{ $notification->message }}</div>
                                    <small class="text-muted" style="font-size: 0.7rem;">
                                        {{ $notification->created_at ? $notification->created_at->diffForHumans() : '' }}
                                    </small>
                                </a>
                            @empty
                                <div class="p-3 text-center text-muted small" id="noNotificationMsg">
                                    No New Notifications
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- Dynamic Notification Dropdown End -->

                <!-- Profile Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle me-lg-2"
                             src="{{ asset('admin/img/user.jpg') }}"
                             alt="User Profile"
                             style="width:40px;height:40px;object-fit:cover;">
                        <span class="d-none d-lg-inline-flex">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-3 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">My Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">Logout</button>
                        </form>
                    </div>
                </div>

            </div>
        </nav>
        <!-- Navbar End -->

        {{-- Dynamic Content Area --}}
        @yield('content')

        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; {{ date('Y') }}
                        <a href="#" class="text-primary text-decoration-none">
                            Salon Management System
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 text-center text-sm-end">
                        Developed By <span class="text-primary fw-bold">Abdul Moize</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

    </div>
    <!-- Content End -->

</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin/js/main.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Sidebar toggle functionality
    const sidebar = document.querySelector(".sidebar");
    const toggle = document.getElementById("sidebarToggle");

    if (toggle) {
        toggle.addEventListener("click", function (e) {
            e.stopPropagation();
            sidebar.classList.toggle("show");
        });
    }

    document.addEventListener("click", function (e) {
        if (window.innerWidth <= 991) {
            if (
                sidebar &&
                !sidebar.contains(e.target) &&
                toggle &&
                !toggle.contains(e.target)
            ) {
                sidebar.classList.remove("show");
            }
        }
    });

    // Notification Read AJAX Trigger
    const notificationBell = document.getElementById("notificationBellBtn");
    if (notificationBell) {
        notificationBell.addEventListener("click", function () {
            const badge = document.getElementById("notificationBadge");
            const countHeader = document.getElementById("notificationHeaderCount");

            if (badge && badge.style.display !== "none") {
                $.ajax({
                    url: "{{ route('notifications.markAsRead') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if(badge) badge.style.display = 'none';
                        if(countHeader) countHeader.innerText = '0 Unread';
                    },
                    error: function (xhr) {
                        console.error("Notification mark read error", xhr);
                    }
                });
            }
        });
    }
});
</script>

@stack('scripts')

</body>
</html>