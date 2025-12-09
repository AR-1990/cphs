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
    /* -----------------------------
       STATIC DATA FOR ALL CHARTS
    ------------------------------*/

    const studentLabels = @json($studentLabels ?? []);
    const studentTotals = @json($studentTotals ?? []);
    const studentScreened = @json($studentScreened ?? []);
    const studentMonthlyBreakdown = @json($studentMonthlyBreakdown ?? []);
    const presentingTotals = @json($presentingTotals ?? []);

    const collabSchoolLabels = @json($collabSchoolLabels ?? []);
    const daysSinceSchool = @json($daysSinceSchool ?? []);


    /* -----------------------------
       BAR CHART
    ------------------------------*/
    new Chart(document.getElementById("studentChart"), {
        type: 'bar',
        data: {
            labels: studentLabels,
            datasets: [{
                    label: 'Total Students',
                    backgroundColor: "lightblue",
                    borderColor: "blue",
                    borderWidth: 1,
                    data: studentTotals
                },
                {
                    label: 'Screened Students',
                    backgroundColor: "lightgreen",
                    borderColor: "green",
                    borderWidth: 1,
                    data: studentScreened
                },
                {
                    label: 'Presenting Complains',
                    backgroundColor: "pink",
                    borderColor: "red",
                    borderWidth: 1,
                    data: presentingTotals
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
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    /* -----------------------------
       PIE CHART
    ------------------------------*/

    new Chart(document.getElementById("daysSinceSchoolChart"), {
        type: 'pie',
        data: {
            labels: collabSchoolLabels,
            datasets: [{
                label: "Days",
                backgroundColor: ["lightblue", "lightgreen", "pink"],
                borderColor: ["blue", "green", "red"],
                borderWidth: 1,
                data: daysSinceSchool
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


    /* -----------------------------
       LINE CHART
    ------------------------------*/

    const emailMonthsLabels = @json($emailMonthsLabels ?? []);
    const lineSchoolData = @json($emailSeries ?? []);

    new Chart(document.getElementById("emailChart"), {
        type: 'line',
        data: {
            labels: emailMonthsLabels,
            datasets: lineSchoolData
        },

        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
                ,
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
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection