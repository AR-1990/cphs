@extends('student.main')
@section('content')
    <!-- Page Content -->
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">My Quizzez</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/student_dashboard') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            My Quizzez

                        </li>

                    </ol>

                </div>
            </div>


        </div>
    </div>

    <div class="container page__container">
        <div class="page-section">

            <div class="page-separator">
                <div class="page-separator__text">Quizzes</div>
            </div>

            <div class="row card-group-row">

                <div class="col-lg-3 card-group-row__col">

                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                        data-toggle="popover" data-trigger="click">

                        <a href="{{ url('/student_quiz_show') }}" class="card-img-top js-image" data-position="" data-height="140">
                            <img src="{{ asset('student/images/paths/angular_430x168.png') }}" alt="course">
                            <span class="overlay__content">
                                <span class="overlay__action d-flex flex-column text-center">
                                    <i class="material-icons icon-32pt">play_circle_outline</i>
                                    <span class="card-title text-white">Resume</span>
                                </span>
                            </span>
                        </a>

                        <span
                            class="corner-ribbon corner-ribbon--default-right-top corner-ribbon--shadow bg-accent text-white">NEW</span>

                        <div class="card-body flex">
                            <div class="d-flex">
                                <div class="flex">
                                    <a class="card-title" href="{{ url('/student_quiz_show') }}">Quiz 1</a>
                                    <small class="text-50 font-weight-bold mb-4pt">Quiz Name</small>
                                </div>

                            </div>
                            <div class="d-flex">
                                <div class="rating flex">
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                </div>
                                <!-- <small class="text-50">6 hours</small> -->
                            </div>
                        </div>
                        <!-- <div class="card-footer">
                                        <div class="row justify-content-between">
                                            <div class="col-auto d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <span
                                                    class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                        </div>
                                    </div> -->
                    </div>

                </div>

                <div class="col-lg-3 card-group-row__col">

                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                        data-toggle="popover" data-trigger="click">

                        <a href="{{ url('/student_quiz_show') }}" class="card-img-top js-image" data-position="" data-height="140">
                            <img src="{{ asset('student/images/paths/swift_430x168.png') }}" alt="course">
                            <span class="overlay__content">
                                <span class="overlay__action d-flex flex-column text-center">
                                    <i class="material-icons icon-32pt">play_circle_outline</i>
                                    <span class="card-title text-white">Resume</span>
                                </span>
                            </span>
                        </a>

                        <div class="card-body flex">
                            <div class="d-flex">
                                <div class="flex">
                                    <a class="card-title" href="{{ url('/student_quiz_show') }}">Quiz 2</a>
                                    <small class="text-50 font-weight-bold mb-4pt">Quiz Name</small>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="rating flex">
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                </div>
                                <!-- <small class="text-50">6 hours</small> -->
                            </div>
                        </div>
                        <!-- <div class="card-footer">
                                        <div class="row justify-content-between">
                                            <div class="col-auto d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <span
                                                    class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                        </div>
                                    </div> -->
                    </div>

                </div>

                <div class="col-lg-3 card-group-row__col">

                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                        data-toggle="popover" data-trigger="click">

                        <a href="{{ url('/student_quiz_show') }}" class="card-img-top js-image" data-position="" data-height="140">
                            <img src="{{ asset('student/images/paths/wordpress_430x168.png') }}" alt="course">
                            <span class="overlay__content">
                                <span class="overlay__action d-flex flex-column text-center">
                                    <i class="material-icons icon-32pt">play_circle_outline</i>
                                    <span class="card-title text-white">Resume</span>
                                </span>
                            </span>
                        </a>

                        <div class="card-body flex">
                            <div class="d-flex">
                                <div class="flex">
                                    <a class="card-title" href="{{ url('/student_quiz_show') }}">Quiz 3</a>
                                    <small class="text-50 font-weight-bold mb-4pt">Quiz Name</small>
                                </div>

                            </div>
                            <div class="d-flex">
                                <div class="rating flex">
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                </div>
                                <!-- <small class="text-50">6 hours</small> -->
                            </div>
                        </div>
                        <!-- <div class="card-footer">
                                        <div class="row justify-content-between">
                                            <div class="col-auto d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <span
                                                    class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                        </div>
                                    </div> -->
                    </div>


                </div>

                <div class="col-lg-3 card-group-row__col">

                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                        data-toggle="popover" data-trigger="click">

                        <a href="{{ url('/student_quiz_show') }}" class="card-img-top js-image" data-position="left" data-height="140">
                            <img src="{{ asset('student/images/paths/react_430x168.png') }}" alt="course">
                            <span class="overlay__content">
                                <span class="overlay__action d-flex flex-column text-center">
                                    <i class="material-icons icon-32pt">play_circle_outline</i>
                                    <span class="card-title text-white">Resume</span>
                                </span>
                            </span>
                        </a>

                        <div class="card-body flex">
                            <div class="d-flex">
                                <div class="flex">
                                    <a class="card-title" href="{{ url('/student_quiz_show') }}">Quiz 4</a>
                                    <small class="text-50 font-weight-bold mb-4pt">Quiz Name</small>
                                </div>

                            </div>
                            <div class="d-flex">
                                <div class="rating flex">
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                </div>
                                <!-- <small class="text-50">6 hours</small> -->
                            </div>
                        </div>
                        <!-- <div class="card-footer">
                                        <div class="row justify-content-between">
                                            <div class="col-auto d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <span
                                                    class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                            </div>
                                        </div>
                                    </div> -->
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- // END Page Content -->
@endsection
