@extends('layouts.admin')

<style>
    .bg-gold {
        background-color: #000000;
        transition: background-color 0.3s ease;
    }

    .bg-black {
        background-color: #DDA73C;
        transition: background-color 0.3s ease;
    }

    .bg-green {
        background-color: #03ab46;
        transition: background-color 0.3s ease;
    }
</style>

<style>
    .nav-icon {
        width: 60px;
        height: 60px;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')

@can('dash_board_venue_info')
    <div class="container">
        <div class="row">
            <div class="text-left mt-4">
                <h3>Welcome back, {{{ Auth::user()->firstname }}}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card bg-warning text-white" style="height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="text-center">
                            <h5 class="card-title"><i class="bi bi-people"></i> Total Members</h5>
                            <h2><p class="card-text">{{ $totalMembers }}</p></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white" style="height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="text-center">
                            <h5 class="card-title"><i class="bi bi-gender-male"></i> Total Adults</h5>
                            <h2><p class="card-text">{{ $totalAdults }}</p></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white" style="height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="text-center">
                            <h5 class="card-title"><i class="bi bi-gender-female"></i> Total Children</h5>
                            <h2><p class="card-text">{{ $totalChildren }}</p></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <canvas id="meetingChart"></canvas>
        </div>

        <div class="col-md-6">
            <canvas id="appointmentChart"></canvas>
        </div>
    </div>
@endcan
    
@can('dash_board_member_info')
<div class="row mt-0">
    <div class="text-left mt-5">
        <h4 style="border-bottom: 2px solid rgb(65, 53, 1); width: 100%;">Church Management System</h4>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <a href="{{ url('admin/members/create') }}" class="card-link">
            <div class="card bg-warning text-white" style="height: 150px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="text-center">
                        <svg class="nav-icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-contact"></use>
                        </svg>
                        <h6 class="card-title"><i class="bi bi-people"></i> My Biodata</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ url('admin/qualifications/create') }}" class="card-link">
            <div class="card bg-danger text-white" style="height: 150px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="text-center">
                        <svg class="nav-icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-briefcase"></use>
                        </svg>
                        <h6 class="card-title"><i class="bi bi-people"></i> Qualification</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ url('admin/spouse-details/create') }}" class="card-link">
            <div class="card bg-info text-white" style="height: 150px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="text-center">
                        <svg class="nav-icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-contact"></use>
                        </svg>
                        <h6 class="card-title"><i class="bi bi-people"></i>Spouse Details</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="row mt-3">
      <div class="col-md-4">
        <a href="{{ url('admin/interests/create') }}" class="card-link">
            <div class="card bg-danger text-white" style="height: 150px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="text-center">
                        <svg class="nav-icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use>
                        </svg>
                        <h6 class="card-title"><i class="bi bi-people"></i> Interests</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ url('admin/children') }}" class="card-link">
            <div class="card bg-info text-white" style="height: 150px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="text-center">
                        <svg class="nav-icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-child"></use>
                        </svg>
                        <h6 class="card-title"><i class="bi bi-people"></i>Child/Children</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ url('admin/employment-details/create') }}" class="card-link">
            <div class="card bg-warning text-white" style="height: 150px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="text-center">
                        <svg class="nav-icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-folder"></use>
                        </svg>
                        <h6 class="card-title"><i class="bi bi-people"></i> Employment Details</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4 mt-3">
        <a href="{{ url('admin/mountain-of-influences/create') }}" class="card-link">
            <div class="card bg-info text-white" style="height: 150px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="text-center">
                        <svg class="nav-icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                        </svg>
                        <h6 class="card-title"><i class="bi bi-people"></i> Mountain of Influence</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>
    {{-- <div class="col-md-4 mt-3">
        <a href="{{ url('admin/settings') }}" class="card-link">
            <div class="card bg-success text-white" style="height: 150px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="text-center">
                        <svg class="nav-icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                        </svg>
                        <h6 class="card-title"><i class="bi bi-people"></i> Settings</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div> --}}
@endcan
        
@can('dash_board_recent_member')
<div class="row mt-0">
    <div class="text-left mt-5">
        <h4 style="border-bottom: 2px solid rgb(65, 53, 1); width: 100%;">HOD Administrative Roles</h4>
    </div>
</div>

    <div class="row mt-2">
        <div class="col-md-4">
            <a href="{{ url('admin/join-departments') }}" class="card-link">
                <div class="card bg-warning text-white" style="height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="text-center">
                            <svg class="nav-icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-contact"></use>
                            </svg>
                            <h6 class="card-title"><i class="bi bi-people"></i> Members</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ url('admin/meetings') }}" class="card-link">
                <div class="card bg-danger text-white" style="height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="text-center">
                            <svg class="nav-icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg>
                            <h6 class="card-title"><i class="bi bi-people"></i>Meetings</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endcan



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById("meetingChart").getContext("2d");
            new Chart(ctx, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [
                        {
                            label: "Meeting Participation",
                            data: [20, 40, 30, 50, 35, 60],
                            backgroundColor: "#000000",
                            borderColor: "#DDA73C",
                            borderWidth: 3
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById("appointmentChart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [
                        {
                            label: "Appointment Booking",
                            data: [20, 40, 30, 50, 35, 60],
                            backgroundColor: "#000000",
                            borderColor: "#DDA73C",
                            borderWidth: 3
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
