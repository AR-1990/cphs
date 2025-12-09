@extends('student.main')
@section('content')
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Results</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/student_dashboard') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Results

                        </li>

                    </ol>

                </div>
            </div>

        </div>
    </div>

    <!-- Page Content -->

    <div class="container page__container page-section">
        <div class="card stack">
            <div class="list-group list-group-flush">

                <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                    <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                        <a href="javascript:void(0)" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                            <img src="{{ asset('student/images/paths/mailchimp_200x168.png') }}" alt="Newsletter Design"
                                class="avatar-img rounded">
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title" href="javascript:void(0)">Lesson Name</a>
                            <div class="card-subtitle text-50">12 min ago</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center mr-16pt">
                        <span class="lead text-headings lh-1">5.8</span>
                        <small class="text-50 text-uppercase text-headings">Score</small>
                    </div>

                </div>

                <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                    <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                        <a href="javascript:void(0)" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                            <img src="{{ asset('student/images/paths/xd_200x168.png') }}" alt="Adobe XD" class="avatar-img rounded">
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title" href="javascript:void(0)">Lesson Name</a>
                            <div class="card-subtitle text-50">2 days ago</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center mr-16pt">
                        <span class="lead text-headings lh-1">10</span>
                        <small class="text-50 text-uppercase text-headings">Score</small>
                    </div>


                </div>

                <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                    <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                        <a href="javascript:void(0)" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                            <img src="{{ asset('student/images/paths/invision_200x168.png') }}" alt="inVision App"
                                class="avatar-img rounded">
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title" href="javascript:void(0)">Lesson Name</a>
                            <div class="card-subtitle text-50">3 days ago</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center mr-16pt">
                        <span class="lead text-headings lh-1">2.8</span>
                        <small class="text-50 text-uppercase text-headings">Score</small>
                    </div>

                </div>

                <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                    <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                        <a href="javascript:void(0)" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                            <img src="{{ asset('student/images/paths/craft_200x168.png') }}" alt="Craft by inVision"
                                class="avatar-img rounded">
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title" href="javascript:void(0)">Lesson Name</a>
                            <div class="card-subtitle text-50">3 days ago</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center mr-16pt">
                        <span class="lead text-headings lh-1">3.3</span>
                        <small class="text-50 text-uppercase text-headings">Score</small>
                    </div>


                </div>

            </div>
        </div>



    </div>

    <!-- // END Page Content -->
@endsection
