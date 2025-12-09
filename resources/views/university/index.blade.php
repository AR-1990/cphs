@extends('university.main')
@section('content')
    <div id="full-slider-wrapper">
        <div id="layerslider" style="width:100%;height:650px;">
            <!-- first slide -->
            <div class="ls-slide" data-ls="slidedelay: 5000; transition2d:5;">
                <img src="{{ asset('university/img/slides/01.jpg') }}" class="ls-bg" alt="Slide background">
                <h3 class="ls-l slide_typo" style="top: 45%; left: 50%;"
                    data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;">
                    <strong>Heading 1</strong>
                </h3>
                
                <p class="ls-l" style="top:62%; left:50%;"
                    data-ls="durationin:2000;delayin:1300;easingin:easeOutElastic;">
                    <a href="{{ url('/plan_visit') }}" class="button_intro">Plan A Visit</a> 
                        <a href="{{ url('/about') }}" class="button_intro outline">About us</a>
                </p>
            </div>

            <!-- second slide -->
            <div class="ls-slide" data-ls="slidedelay: 5000; transition2d:5;">
                <img src="{{ asset('university/img/slides/02.jpg') }}" class="ls-bg" alt="Slide background">
                <h3 class="ls-l slide_typo" style="top: 45%; left: 50%;"
                    data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;">
                    <strong>Heading 2</strong>
                </h3>
                
                <p class="ls-l" style="top:65%; left:50%;"
                    data-ls="durationin:2000;delayin:1300;easingin:easeOutElastic;">
                    <a href="{{ url('/plan_visit') }}" class="button_intro">Plan A Visit</a>
                    <a href="{{ url('/about') }}" class="button_intro outline">About us</a>
                </p>
            </div>

            <!-- third slide -->
            <div class="ls-slide" data-ls="slidedelay:5000; transition2d:5;">
                <img src="{{ asset('university/img/slides/03.jpg') }}" class="ls-bg" alt="Slide background">
                <h3 class="ls-l slide_typo" style="top: 45%; left: 50%;"
                    data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;">
                    <strong>Heading 3</strong>
                </h3>
                
                <p class="ls-l" style="top:65%; left:50%;"
                    data-ls="durationin:2000;delayin:1300;easingin:easeOutElastic;">
                    <a href="{{ url('/plan_visit') }}" class="button_intro">Plan A Visit</a>
                        <a href="{{ url('/about') }}" class="button_intro outline">About us</a>
                </p>
            </div>

            <!-- fourth slide -->
            <div class="ls-slide" data-ls="slidedelay: 5000; transition2d:5;">
                <img src="{{ asset('university/img/slides/04.jpg') }}" class="ls-bg" alt="Slide background">
                <h3 class="ls-l slide_typo" style="top: 45%; left: 50%;"
                    data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;">
                    <strong>Heading 4</strong>
                </h3>
                
                <p class="ls-l" style="top:65%; left:50%;"
                    data-ls="durationin:2000;delayin:1300;easingin:easeOutElastic;">
                    <a href="{{ url('/plan_visit') }}" class="button_intro">Plan A Visit</a> 
                    <a href="{{ url('/about') }}" class="button_intro outline">About us</a>
                </p>
            </div>
            <!-- fourth slide -->
            <div class="ls-slide" data-ls="slidedelay: 5000; transition2d:5;">
                <img src="{{ asset('university/img/slides/05.jpg') }}" class="ls-bg" alt="Slide background">
                <h3 class="ls-l slide_typo" style="top: 45%; left: 50%;"
                    data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;">
                    <strong>Heading 5</strong>
                </h3>
                
                <p class="ls-l" style="top:65%; left:50%;"
                    data-ls="durationin:2000;delayin:1300;easingin:easeOutElastic;">
                    <a href="{{ url('/plan_visit') }}" class="button_intro">Plan A Visit</a> 
                    <a href="{{ url('/about') }}" class="button_intro outline">About us</a>
                </p>
            </div>

        </div>
    </div>
    <!-- End layerslider -->

    <div class="container_gray_bg" id="home_feat_1">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="home_feat_1_box">
                        <a href="{{ url('/plan_visit') }}">
                            <img src="{{ asset('university/img/home_feat_1_1.jpg.png') }}" class="img-responsive" alt="">
                            <div class="short_info">
                                <h3>Plan a visit</h3><i class="arrow_carrot-right_alt2"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="home_feat_1_box">
                        <a href="{{ url('/get_enrolled') }}">
                            <img src="{{ asset('university/img/home_feat_1_2.jpg.png') }}" class="img-responsive" alt="">
                            <div class="short_info">
                                <h3>Get Enrolled</h3><i class="arrow_carrot-right_alt2"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="home_feat_1_box">
                        <a href="{{ url('/course') }}">
                            <img src="{{ asset('university/img/home_feat_1_3.jpg.png') }}" class="img-responsive" alt="">
                            <div class="short_info">
                                <h3>Course Details</h3><i class="arrow_carrot-right_alt2"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </div>
    <!-- End container_gray_bg -->

    <div class="container margin_60">
        <div class="main_title">
            <h2>Biopharma Institute Of Clinical Research Core Feautures</h2>
            <p>This is Dummy Text This is Dummy Text </p>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="box_feat_home">
                    <i class=" iconcustom-certificate"></i>
                    <h3>Quality Certifications</h3>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="box_feat_home">
                    <i class=" iconcustom-innovation"></i>
                    <h3>Learning Best Practice</h3>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text</p>
                </div>
            </div>
        </div>
        <!-- End row -->
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="box_feat_home">
                    <i class=" iconcustom-education_online"></i>
                    <h3>Online Resources</h3>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="box_feat_home">
                    <i class=" iconcustom-know_how"></i>
                    <h3>Study Plan Tutors</h3>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text</p>
                </div>
            </div>
        </div>
        <!-- End row -->
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="box_feat_home">
                    <i class=" iconcustom-science"></i>
                    <h3>Advanced Practice</h3>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="box_feat_home">
                    <i class=" iconcustom-test"></i>
                    <h3>Research</h3>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text</p>
                </div>
            </div>
        </div>
        <!-- End row -->
        <hr class="more_margin">

        <div class="row add_bottom_60">
            <div class="main_title">
                <h2>Biopharma Institute Of Clinical Research Focus On </h2>
                <p>This is Dummy Text This is Dummy Text </p>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <div id="graph">
                    <img src="{{ asset('university/img/graphic.jpg') }}" class="wow zoomIn" data-wow-delay="0.1s" alt="">
                    <div class="features step_1 wow flipInX" data-wow-delay="1s">
                        <h4><strong>01.</strong> Heading 1</h4>
                        <p>This is Dummy Text This is Dummy Text </p>
                    </div>
                    <div class="features step_2 wow flipInX" data-wow-delay="1.5s">
                        <h4><strong>02.</strong> Heading 2</h4>
                        <p>This is Dummy Text This is Dummy Text </p>
                    </div>
                    <div class="features step_3 wow flipInX" data-wow-delay="2s">
                        <h4><strong>03.</strong> Heading 3</h4>
                        <p>This is Dummy Text This is Dummy Text </p>
                    </div>
                    <div class="features step_4 wow flipInX" data-wow-delay="2.5s">
                        <h4><strong>04.</strong> Heading 4</h4>
                        <p>This is Dummy Text This is Dummy Text </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
        
    </div>
    <!-- End container -->

    <div class="bg_content testimonials">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                    <!-- Bottom Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#quote-carousel" data-slide-to="1"></li>
                        <li data-target="#quote-carousel" data-slide-to="2"></li>
                    </ol><!-- Carousel Slides / Quotes -->
                    <div class="carousel-inner">
                        <!-- Quote 1 -->
                        <div class="item active">
                            <blockquote>
                                <p>
                                    This is Dummy Text This is Dummy Text
                                </p>
                            </blockquote>
                            <small><img class="img-circle" src="{{ asset('university/img/testimonial_1.jpg') }}" alt="">Stefany</small>
                        </div>
                        <!-- Quote 2 -->
                        <div class="item">
                            <blockquote>
                                <p>
                                    This is Dummy Text This is Dummy Text
                                </p>
                            </blockquote>
                            <small><img class="img-circle" src="{{ asset('university/img/testimonial_2.jpg') }}" alt="">Karla</small>
                        </div>
                        <!-- Quote 3 -->
                        <div class="item">
                            <blockquote>
                                <p>
                                    This is Dummy Text This is Dummy Text
                                </p>
                            </blockquote>
                            <small><img class="img-circle" src="{{ asset('university/img/testimonial_1.jpg') }}" alt="">Maira</small>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End bg_content -->

    <div class="container margin_60">
        <div class="main_title">
            <h2>Latest From Biopharma Institute Of Clinical Research</h2>
            <p>This is Dummy Text This is Dummy Text </p>
        </div>

        <div class="">

            <section id="section-3">
                <div class="row list_news_tabs">
                    <div class="col-md-4 col-sm-4">
                        <p><a href="#0"><img src="{{ asset('university/img/event_1_thumb.jpg') }}" alt="" class="img-responsive"></a>
                        </p>
                        <span class="date_published">15 March 2023</span>
                        <h3><a href="#0">Next students meeting</a></h3>
                        <p>This is Dummy Text This is Dummy Text </p>
                        <a href="#0" class="button small">Read more</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <p><a href="#0"><img src="{{ asset('university/img/event_2_thumb.jpg') }}" alt="" class="img-responsive"></a>
                        </p>
                        <span class="date_published">15 March 2023</span>
                        <h3><a href="#0">10 October Open day</a></h3>
                        <p>This is Dummy Text This is Dummy Text </p>
                        <a href="#0" class="button small">Read more</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <p><a href="#0"><img src="{{ asset('university/img/event_3_thumb.jpg') }}" alt="" class="img-responsive"></a>
                        </p>
                        <span class="date_published">15 March 2023</span>
                        <h3><a href="#0">Study workshop</a></h3>
                        <p>This is Dummy Text This is Dummy Text </p>
                        <a href="#0" class="button small">Read more</a>
                    </div>
                </div>
                <!--End row -->
            </section>

        </div><!-- /content -->

    </div>



    <div class="bg_content magnific">
        <div>
            <h3>Visit Your Nearest Research Center</h3>
            <p>
                This is Dummy Text This is Dummy Text
            </p>
            <a href="plan-visit.html" class="button_intro">Plan A Visit</a>
            <a href="https://vimeo.com/20370747" class="video_pop"><i class="arrow_triangle-right_alt2"></i></a>
        </div>
    </div><!-- End bg_content -->

    <div class="container_gray_bg" id="newsletter_container">
        <div class="container margin_60">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h3>Subscribe to our Newsletter for latest news.</h3>
                    <div id="message-newsletter"></div>
                    <form method="post" action="assets/newsletter.php" name="newsletter" id="newsletter"
                        class="form-inline">
                        <input name="email_newsletter" id="email_newsletter" type="email" value=""
                            placeholder="Your Email" class="form-control">
                        <button id="submit-newsletter" class="button"> Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End newsletter_container -->


    <script type="text/javascript">
        $(document).ready(function() {
            'use strict';
            $('#layerslider').layerSlider({
                autoStart: true,
                responsive: true,
                responsiveUnder: 1280,
                layersContainer: 1170,
                skinsPath: 'university/layerslider/skins/'
                // Please make sure that you didn't forget to add a comma to the line endings
                // except the last line!
            });
        });
    </script>
    {{-- <script src="{{ asset('university/js/tabs.js') }}"></script> --}}
    {{-- <script>
        new CBPFWTabs(document.getElementById('tabs'));
    </script> --}}
@endsection
