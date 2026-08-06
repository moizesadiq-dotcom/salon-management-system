<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">

        <a href="{{ route('admin.dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">
                <i class="fa fa-cut me-2"></i>Salon
            </h3>
        </a>

        <div class="navbar-nav w-100">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <!-- Services -->
            <a href="{{ route('services.index') }}"
                class="nav-item nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                <i class="fa fa-cut me-2"></i>Services
            </a>

            <!-- Staff -->
            <a href="{{ route('staff.index') }}"
                class="nav-item nav-link {{ request()->routeIs('staff.*') ? 'active' : '' }}">
                <i class="fa fa-user-tie me-2"></i>Staff
            </a>

            <!-- Customers -->
            <a href="{{ route('customers.index') }}"
                class="nav-item nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                <i class="fa fa-users me-2"></i>Customers
            </a>

            <!-- Appointments -->
            <a href="{{ route('appointments.index') }}"
                class="nav-item nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                <i class="fa fa-calendar-check me-2"></i>Appointments
            </a>

            <!-- Bookings -->
            <a href="{{ route('bookings.index') }}"
                class="nav-item nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                <i class="fa fa-calendar-alt me-2"></i>Bookings
            </a>

            <!-- Payments -->
            <a href="{{ route('payments.index') }}"
                class="nav-item nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                <i class="fa fa-money-bill-wave me-2"></i>Payments
            </a>

            <!-- Commission -->
            <a href="{{ route('commission.index') }}"
                class="nav-item nav-link {{ request()->routeIs('commission.*') ? 'active' : '' }}">
                <i class="fa fa-percentage me-2"></i>Commission
            </a>

            <!-- Feedbacks -->
            <a href="{{ route('feedbacks.index') }}"
                class="nav-item nav-link {{ request()->routeIs('feedbacks.*') ? 'active' : '' }}">
                <i class="fa fa-comments me-2"></i>Feedbacks
            </a>

            <!-- Reports -->
            <a href="{{ route('reports.index') }}"
                class="nav-item nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="fa fa-chart-bar me-2"></i>Reports
            </a>

        </div>

    </nav>
</div>
<!-- Sidebar End -->