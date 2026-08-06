<!-- Navbar Start -->

<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">

    <!-- Mobile Logo -->
    <a href="#" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0">
            Salon
        </h2>
    </a>

    <!-- Sidebar Toggle -->
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <!-- Right Menu -->
    <div class="navbar-nav align-items-center ms-auto">

        <!-- Notification Bell -->
        <div class="nav-item dropdown me-3">

            <a href="#" class="nav-link dropdown-toggle position-relative"
               data-bs-toggle="dropdown">

                <i class="fa fa-bell fa-lg"></i>

                @if(isset($unreadNotifications) && $unreadNotifications > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $unreadNotifications }}
                    </span>
                @endif

            </a>

            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">

                @if(isset($notifications) && count($notifications))

                    @foreach($notifications as $notification)

                        <a href="#" class="dropdown-item">
                            <strong>{{ $notification->title }}</strong><br>
                            <small>{{ $notification->message }}</small>
                        </a>

                    @endforeach

                @else

                    <a href="#" class="dropdown-item text-center">
                        No Notifications
                    </a>

                @endif

            </div>

        </div>

        <!-- Admin -->
        <div class="nav-item dropdown">

            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

                <i class="fa fa-user me-2"></i>

                <span class="d-none d-lg-inline-flex">
                    Admin
                </span>

            </a>

            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">

                <a href="#" class="dropdown-item">
                    My Profile
                </a>

                <a href="#" class="dropdown-item">
                    Settings
                </a>

                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

</nav>

<!-- Navbar End -->