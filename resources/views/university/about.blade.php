@extends('university.main')
@section('content')

    <div class="sub_header bg_2">
        <div id="intro_txt">
            <h1> <strong>Excellence</strong> In Teaching</h1>
            <p>Biopharma Institute Of Clinical Research</p>
        </div>
    </div> <!--End sub_header -->
    <div class="container margin_60">
        <div class="main_title">
            <h2>Some words about Biopharma Institute Of Clinical Research</h2>
            <p>
                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
            </p>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h3>Founded in 1998</h3>
                <p>
                    This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This
                    is Dummy Text
                    This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This
                    is Dummy Text
                    This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This
                    is Dummy Text
                    This is Dummy Text This is Dummy Text.
                </p>
                <p>
                    This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This
                    is Dummy Text
                    This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This
                    is Dummy Text
                    This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This
                    is Dummy Text
                    This is Dummy Text This is Dummy Text.
                </p>

                <h3>Founders and Directors</h3>
                <p>
                    This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This
                    is Dummy Text
                    This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This
                    is Dummy Text
                    This is Dummy Text This is Dummy Text.
                </p>
               
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="box_style_4">
                    <h4>Mission</h4>
                    <p>
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text
                        This is Dummy Text This is Dummy Text .
                    </p>
                    <ul class="list_order">
                        <li><span>1</span>This is Dummy Text This is Dummy Text</li>
                        <li><span>2</span>This is Dummy Text This is Dummy Text</li>
                        <li><span>3</span>This is Dummy Text This is Dummy Text</li>
                        <li><span>4</span>This is Dummy Text This is Dummy Text</li>
                        <li><span>5</span>This is Dummy Text This is Dummy Text</li>
                    </ul>
                </div>
            </div>
        </div><!--End row -->
       
    </div><!--End container -->
    <div class="container_gray_bg">
        <div class="container margin_60">
            <div class="main_title">
                <h2>Why Choose Biopharma Institute Of Clinical Research</h2>
                <p>This is Dummy Text This is Dummy Text This is Dummy Text</p>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <a class="box_feat" href="#">
                        <i class="pe-7s-diamond"></i>
                        <h3>Qualified teachers</h3>
                        <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy
                            Text This is Dummy Text.</p>
                    </a>
                </div>
                <div class="col-md-4 col-sm-4">
                    <a class="box_feat" href="#">
                        <i class="pe-7s-display2"></i>
                        <h3>Equiped class rooms</h3>
                        <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy
                            Text This is Dummy Text.</p>
                    </a>
                </div>
                <div class="col-md-4 col-sm-4">
                    <a class="box_feat" href="#">
                        <i class="pe-7s-science"></i>
                        <h3>Advanced teaching</h3>
                        <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy
                            Text This is Dummy Text.</p>
                    </a>
                </div>
            </div><!--End row-->
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <a class="box_feat" href="#">
                        <i class="pe-7s-rocket"></i>
                        <h3>Adavanced study plans</h3>
                        <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy
                            Text This is Dummy Text. </p>
                    </a>
                </div>
                <div class="col-md-4 col-sm-4">
                    <a class="box_feat" href="#">
                        <i class="pe-7s-target"></i>
                        <h3>Focus on target</h3>
                        <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy
                            Text This is Dummy Text.</p>
                    </a>
                </div>
                <div class="col-md-4 col-sm-4">
                    <a class="box_feat" href="#">
                        <i class="pe-7s-graph1"></i>
                        <h3>focus on success</h3>
                        <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy
                            Text This is Dummy Text. </p>
                    </a>
                </div>
            </div><!--End row-->
            <br>
            <div class="text-center"><a href="{{ url('/get_enrolled') }}" class="button_intro">Get Enrolled</a></div>

        </div><!--End container -->
    </div><!--End bg_gray_container -->

    <div class=" container_gray_bg" id="newsletter_container">
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

 @endsection