@extends('admin.main')
@section('content')

<style>
    .chartSec {
        padding: 2rem 0;
    }

    .chartSec .container-fluid {
        max-width: 100%;
    }

    .secHeading {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .secHeading span {
        width: 100%;
        height: 2px;
        background: #d86744;
    }

    .secHeading h2 {
        white-space: nowrap;
        font-size: 2rem;
        text-transform: capitalize;
    }

    .chartSec canvas.fit {
        height: 400px !important;
        width: 400px !important;
        margin: auto;
    }

    .chartSec .row {
        gap: 2rem 0;
    }
</style>


<div id="loading-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 9999; display: flex; justify-content: center; align-items: center; flex-direction: column;">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="sr-only">Loading...</span>
    </div>
    <h4 class="mt-3 text-primary">Loading Dashboard Data...</h4>
</div>

<section class="chartSec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-0">Dashboard</h2>
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">
                        Dashboard 3
                    </li>
                </ol>
            </div>
            <div class="col-md-6">
                <div class="secHeading">
                    <span></span>
                    <h2>Students</h2>
                    <span></span>
                </div>
                <canvas id="studentChart"></canvas>
            </div>
            <div class="col-md-6">
                <div class="secHeading">
                    <span></span>
                    <h2>Days Since School Collaboration</h2>
                    <span></span>
                </div>
                <canvas class="fit" id="daysSinceSchoolChart"></canvas>
            </div>
            <div class="col-md-6">
                <div class="secHeading">
                    <span></span>
                    <h2>Emails Sent</h2>
                    <span></span>
                </div>
                <canvas id="emailChart"></canvas>
            </div>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let studentChart, daysSinceSchoolChart, emailChart;

    document.addEventListener("DOMContentLoaded", function() {
        initCharts();
        fetchDashboardStats();
    });

    function initCharts() {
        // Student Chart
        const ctxStudent = document.getElementById("studentChart");
        studentChart = new Chart(ctxStudent, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                        label: 'Total Students',
                        backgroundColor: "lightblue",
                        borderColor: "blue",
                        borderWidth: 1,
                        data: []
                    },
                    {
                        label: 'Screened Students',
                        backgroundColor: "lightgreen",
                        borderColor: "green",
                        borderWidth: 1,
                        data: []
                    },
                    {
                        label: 'Reportables',
                        backgroundColor: "pink",
                        borderColor: "red",
                        borderWidth: 1,
                        data: []
                    }
                ]
            },
            options: {
                indexAxis: "x",
                plugins: {
                    legend: { display: true },
                    tooltip: {
                        callbacks: {
                            title: function(items) {
                                const school = (items && items.length) ? (items[0].label || '') : '';
                                return school;
                            },
                            label: function(context) {
                                const value = context.formattedValue || context.parsed;
                                return `${value}`;
                            }
                        }
                    }
                },
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Days Chart
        const ctxDays = document.getElementById("daysSinceSchoolChart");
        daysSinceSchoolChart = new Chart(ctxDays, {
            type: 'pie',
            data: {
                labels: [],
                datasets: [{
                    label: "Days",
                    backgroundColor: ["lightblue", "lightgreen", "pink"],
                    borderColor: ["blue", "green", "red"],
                    borderWidth: 1,
                    data: []
                }]
            },
            options: {
                plugins: {
                    legend: { display: true },
                    tooltip: {
                        callbacks: {
                            title: function(items) {
                                return (items && items.length) ? (items[0].label || '') : '';
                            },
                            label: function(context) {
                                const value = context.formattedValue || context.parsed;
                                return `${value} days`;
                            }
                        }
                    }
                },
                responsive: true
            }
        });

        // Email Chart
        const ctxEmail = document.getElementById("emailChart");
        emailChart = new Chart(ctxEmail, {
            type: 'line',
            data: {
                labels: [],
                datasets: []
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const school = context.dataset.label || '';
                                const value = context.parsed || 0;
                                return `${school}: ${value} emails`;
                            }
                        }
                    }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    function fetchDashboardStats() {
        fetch("{{ route('admin.dashboard.stats') }}")
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Update Student Chart
                studentChart.data.labels = data.studentLabels;
                studentChart.data.datasets[0].data = data.studentTotals;
                studentChart.data.datasets[1].data = data.studentScreened;
                studentChart.data.datasets[2].data = data.presentingTotals;
                studentChart.update();

                // Update Days Chart
                daysSinceSchoolChart.data.labels = data.collabSchoolLabels;
                daysSinceSchoolChart.data.datasets[0].data = data.daysSinceSchool;
                // If the background colors need to depend on the number of items, we might need to generate them dynamically,
                // but for now keeping the static 3 colors as in original code.
                daysSinceSchoolChart.update();

                // Update Email Chart
                emailChart.data.labels = data.emailMonthsLabels;
                emailChart.data.datasets = data.emailSeries;
                emailChart.update();

                // Hide spinner
                document.getElementById("loading-overlay").style.display = 'none';
            })
            .catch(error => {
                console.error('Error fetching dashboard stats:', error);
                document.getElementById("loading-overlay").innerHTML = '<h4 class="text-danger">Error loading data. Please refresh.</h4>';
            });
    }
</script>


@endsection