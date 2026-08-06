@extends('admin.admin')

@section('content')
<div class="container-fluid pt-4 px-4">

    {{-- Header & Actions --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white fw-bold m-0">
            <i class="fa fa-calendar-alt text-danger me-2"></i>Appointment Management
        </h3>
        <a href="{{ route('appointments.create') }}" class="btn btn-danger px-4 py-2 rounded-3 shadow-sm fw-bold">
            <i class="fa fa-plus me-2"></i>Add Appointment
        </a>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-secondary rounded-3 p-3 mb-4 border border-dark">
        <div class="row g-3 align-items-center">
            <!-- Search Bar -->
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa fa-search"></i></span>
                    <input type="text" id="searchInput" class="form-control bg-dark border-secondary text-white" placeholder="Search Customer...">
                </div>
            </div>

            <!-- Customer Select Dropdown (Dynamic from Database) -->
            <div class="col-md-3">
                <select id="customerFilter" class="form-select bg-dark border-secondary text-white">
                    <option value="">All Customers</option>
                    @if(isset($customers))
                        @foreach($customers as $cust)
                            <option value="{{ $cust->name }}">{{ $cust->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Status Select Dropdown -->
            <div class="col-md-3">
                <select id="statusFilter" class="form-select bg-dark border-secondary text-white">
                    <option value="">All Status</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <!-- Reset Button -->
            <div class="col-md-2">
                <button type="button" id="resetBtn" class="btn btn-outline-secondary w-100">Reset</button>
            </div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="bg-secondary border-start border-4 border-info rounded-3 p-4 shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="btn-square bg-dark text-info rounded-circle me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa fa-clock fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Tomorrow's Schedule</h6>
                        <h5 class="text-white mb-0 fw-bold">
                            {{ isset($tomorrowAppointments) ? $tomorrowAppointments->count() : 0 }} Appointment(s) Tomorrow
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-secondary border-start border-4 border-danger rounded-3 p-4 shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="btn-square bg-dark text-danger rounded-circle me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa fa-calendar-check fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Upcoming Schedule</h6>
                        <h5 class="text-white mb-0 fw-bold">
                            {{ isset($upcomingAppointments) ? $upcomingAppointments->count() : 0 }} Upcoming Appointment(s)
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-secondary rounded-3 p-4 border border-dark">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0 text-nowrap" id="appointmentTable">
                <thead class="text-muted uppercase small border-bottom border-secondary">
                    <tr>
                        <th scope="col" class="py-3">#</th>
                        <th scope="col" class="py-3">Customer</th>
                        <th scope="col" class="py-3">Service</th>
                        <th scope="col" class="py-3">Stylist</th>
                        <th scope="col" class="py-3">Date</th>
                        <th scope="col" class="py-3">Time</th>
                        <th scope="col" class="py-3">Status</th>
                        <th scope="col" class="py-3">Countdown</th>
                        <th scope="col" class="py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="border-0">

                    @foreach($appointments as $index => $appointment)
                        <tr>
                            <td class="fw-bold">{{ $index + 1 }}</td>
                            <td>
                                <span class="text-white fw-semibold customer-name">
                                    {{ $appointment->customer->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="text-muted">{{ $appointment->service->name ?? '-' }}</td>
                            <td>
                                <span class="badge bg-dark text-light border border-secondary px-2 py-1">
                                    {{ $appointment->staff->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                            <td>
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill status-text">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary px-3 py-2 rounded-pill countdown-timer" 
                                      data-datetime="{{ $appointment->appointment_date }} {{ $appointment->appointment_time }}">
                                    Loading...
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-outline-info" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-outline-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                    
                                    {{-- Service Price Dynamic Button --}}
                                    <button type="button" class="btn btn-outline-success pay-btn" data-bs-toggle="modal" data-bs-target="#paymentModal" data-amount="{{ $appointment->service->price ?? 0 }}" title="Make Payment">
                                        <i class="fa fa-credit-card"></i>
                                    </button>

                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger rounded-0 rounded-end" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- Payment Modal --}}
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-secondary text-white border border-dark">
            <div class="modal-header border-bottom border-dark">
                <h5 class="modal-title fw-bold" id="paymentModalLabel"><i class="fa fa-credit-card text-success me-2"></i>Process Payment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    <div class="mb-3">
                        <label class="form-label text-muted">Booking Amount</label>
                        <input type="text" id="modalAmount" class="form-control bg-dark border-secondary text-white fw-bold" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Payment Method</label>
                        <select class="form-select bg-dark border-secondary text-white">
                            <option value="cash">Cash</option>
                            <option value="card">Credit / Debit Card</option>
                            <option value="online">Online Transfer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Notes</label>
                        <textarea class="form-control bg-dark border-secondary text-white" rows="2" placeholder="Optional payment remarks..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top border-dark">
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success px-4">Confirm Payment</button>
            </div>
        </div>
    </div>
</div>

{{-- Dynamic Countdown, Filter & Payment Modal Script --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    // 1. Live Countdown Timer Function
    function updateLiveCountdowns() {
        const timers = document.querySelectorAll('.countdown-timer');
        const now = new Date().getTime();

        timers.forEach(timer => {
            const rawDateTime = timer.getAttribute('data-datetime');
            if (!rawDateTime) return;

            const appointmentTime = new Date(rawDateTime.replace(' ', 'T')).getTime();
            const diff = appointmentTime - now;

            if (diff <= 0) {
                timer.textContent = "Expired";
                timer.className = "badge bg-secondary px-3 py-2 rounded-pill countdown-timer";
            } else {
                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                if (days > 0) {
                    timer.textContent = `${days}d ${hours}h ${minutes}m left`;
                    timer.className = "badge bg-primary px-3 py-2 rounded-pill countdown-timer";
                } else if (hours > 0) {
                    timer.textContent = `${hours}h ${minutes}m ${seconds}s left`;
                    timer.className = "badge bg-warning text-dark px-3 py-2 rounded-pill countdown-timer";
                } else {
                    timer.textContent = `${minutes}m ${seconds}s left`;
                    timer.className = "badge bg-danger px-3 py-2 rounded-pill countdown-timer";
                }
            }
        });
    }

    updateLiveCountdowns();
    setInterval(updateLiveCountdowns, 1000);

    // 2. Real-time Filter Function (Without Page Refresh)
    const searchInput = document.getElementById("searchInput");
    const customerFilter = document.getElementById("customerFilter");
    const statusFilter = document.getElementById("statusFilter");
    const resetBtn = document.getElementById("resetBtn");
    const tableRows = document.querySelectorAll("#appointmentTable tbody tr");

    function filterTable() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedCustomer = customerFilter.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value.toLowerCase().trim();

        tableRows.forEach(row => {
            const customerName = row.querySelector(".customer-name").textContent.toLowerCase();
            const status = row.querySelector(".status-text").textContent.toLowerCase();

            const matchesSearch = customerName.includes(query);
            const matchesCustomer = selectedCustomer === "" || customerName.includes(selectedCustomer);
            const matchesStatus = selectedStatus === "" || status.includes(selectedStatus);

            if (matchesSearch && matchesCustomer && matchesStatus) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    searchInput.addEventListener("keyup", filterTable);
    customerFilter.addEventListener("change", filterTable);
    statusFilter.addEventListener("change", filterTable);

    resetBtn.addEventListener("click", function () {
        searchInput.value = "";
        customerFilter.value = "";
        statusFilter.value = "";
        filterTable();
    });

    // 3. Dynamic Payment Amount Transfer to Modal
    const payButtons = document.querySelectorAll('.pay-btn');
    const modalAmountInput = document.getElementById('modalAmount');

    payButtons.forEach(button => {
        button.addEventListener('click', function () {
            const amount = this.getAttribute('data-amount');
            modalAmountInput.value = `$${amount}`;
        });
    });
});
</script>
@endsection