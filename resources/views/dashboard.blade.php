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
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-black text-white" style="height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="text-center">
                            <h5 class="card-title"><i class="bi bi-people"></i> Total Members</h5>
                            <h2><p class="card-text">{{ $totalMembers }}</p></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white" style="height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="text-center">
                            <h5 class="card-title"><i class="bi bi-gender-male"></i> Total Male</h5>
                            <h2><p class="card-text">{{ $totalMale }}</p></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-black text-white" style="height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="text-center">
                            <h5 class="card-title"><i class="bi bi-gender-female"></i> Total Female</h5>
                            <h2><p class="card-text">{{ $totalFemale }}</p></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="meetingChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="appointmentChart"></canvas>
        </div>
    </div>
    


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
                        // backgroundColor: "rgba(54, 162, 235, 0.5)",
                        backgroundColor: "#000000",
                        borderColor: "#DDA73C",
                        // borderColor: "rgba(54, 162, 235, 1)",
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

<script>
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
                        // backgroundColor: "rgba(54, 162, 235, 0.5)",
                        backgroundColor: "#000000",
                        borderColor: "#DDA73C",
                        // borderColor: "rgba(54, 162, 235, 1)",
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
