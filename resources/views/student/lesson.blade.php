@extends('student.main')
@section('content')
    <div class="pb-lg-64pt py-32pt">
        <div class="container page__container">
            <div class="js-player embed-responsive embed-responsive-16by9 mb-32pt">
                <div class="player embed-responsive-item">
                    <div class="player__content">
                        <div class="player__image" style="--player-image: url({{ url('student/images/illustration/player.svg') }})">
                        </div>

                        <a href="#" class="player__play bg-primary">
                            <span class="material-icons">play_arrow</span>
                        </a>
                    </div>
                    <div class="player__embed d-none">
                        <iframe class="embed-responsive-item"
                            src="https://player.vimeo.com/video/97243285?title=0&amp;byline=0&amp;portrait=0"
                            allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap align-items-end mb-16pt">
                <h1 class="flex m-0">Lesson Name</h1>
                <p class="h1 font-weight-light m-0">50:13</p>
            </div>

            <p class="hero__lead measure-hero-lead mb-24pt">
                This is Dummy Text This is Dummy Text This is Dummy Text
                This is Dummy Text This is Dummy Text This is Dummy Text
                This is Dummy Text This is Dummy Text This is Dummy Text
            </p>
        </div>
    </div>
@endsection
