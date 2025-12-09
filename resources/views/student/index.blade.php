@extends('student.main')
@section('content')

    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/student_dashboard') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Dashboard

                        </li>

                    </ol>

                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto">
                    <a href="{{ url('/student_module') }}" class="btn btn-outline-secondary">My Module</a>
                </div>
            </div>

        </div>
    </div>


    <!-- Page Content -->

    <div class="container page__container">
        <div class="page-section">
            <div class="row mb-lg-8pt">
                <div class="col-lg-12">

                    <div class="page-separator">
                        <div class="page-separator__text">Progress</div>
                    </div>

                    <div class="card">
                        <div class="card-body p-24pt">
                            <div class="row">
                                <div class="col-6">
                                    <div class="chart" style="height: 262px;">
                                        <div
                                            class="text-center fullbleed d-flex align-items-center justify-content-center flex-column z-0">
                                            <h2 class="m-0">25%</h2>
                                            <strong>Completed</strong>
                                        </div>
                                        <canvas class="chart-canvas position-relative z-1" id="attendanceDoughnutChart"
                                            data-chart-legend="#attendanceDoughnutChartLegend"
                                            data-chart-line-background-color="#1C3866;#E55123" data-chart-dark-mode="true">
                                            <span style="font-size: 1rem;"
                                                class="text-muted"><strong>Progress</strong></span>
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="nav border-0">
                                        <div class="row no-gutters flex" role="tablist">
                                            <div class="col-auto">
                                                <div class="d-flex align-items-center">
                                                    <!-- <div class="h2 mb-0 mr-3">17</div> -->
                                                    <div class="flex">
                                                        <p class="card-title">Progress Status</p>
                                                        <p class="card-subtitle text-50">
                                                            <small>Last 30 days</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="attendanceDoughnutChartLegend"
                                        class="chart-legend chart-legend--vertical mt-24pt"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        
    </div>

    <!-- // END Page Content -->
@endsection
