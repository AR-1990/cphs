@extends('university.main')
@section('content')

    <div class="sub_header bg_3">
        <div id="intro_txt">
            <h1><strong>This is Dummy Heading</strong></h1>
            <p>This is Dummy Text This is Dummy Text</p>
        </div>
    </div> <!--End sub_header -->


    <div class="container_gray_bg">
        <div class="container margin_60">
            <div class="main_title">
                <h2>Biopharma Alumni</h2>
                <p>This is Dummy Text This is Dummy Text</p>
            </div>
            <div class="row staff">
                <div class="col-md-4">
                    <div class="box_style_1">
                        <p><img src="{{ asset('university/img/teacher_1_small.jpg') }}" alt="" width="200" height="200" class="img-circle styled"></p>
                        <h4>Christy</h4>
                        <p>
                            This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text
                        </p>
                        
                        <hr>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box_style_1">
                        <p><img src="{{ asset('university/img/Lucy Jones.jpg') }}" alt="" width="200" height="200" class="img-circle styled"></p>
                        <h4>Lucy Jones</h4>
                        <p> This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text</p>
                      
                        <hr>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box_style_1">
                        <p><img src="{{ asset('university/img/lubaina.jpg') }}" alt="" width="200" height="200" class="img-circle styled"></p>
                        <h4>Lubaina Saherwala</h4>
                        <p> This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text</p>
                        
                        <hr>
                    </div>
                </div>
            </div><!--End row -->
            <div class="row staff">
                <div class="col-md-4">
                    <div class="box_style_1">
                        <p><img src="{{ asset('university/img/teacher_1_small.jpg') }}" alt="" width="200" height="200" class="img-circle styled"></p>
                        <h4>Alyana</h4>
                        <p>This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text</p>
                       
                        <hr>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box_style_1">
                        <p><img src="{{ asset('university/img/teacher_2_small.jpg') }}" alt="" width="200" height="200" class="img-circle styled"></p>
                        <h4>Lidia Mezgebe</h4>
                        <p> This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text
                            This is Dummy Text This is Dummy Text This is Dummy Text</p>
                      
                        <hr>
                    </div>
                </div>
            </div><!--End row -->
        </div><!--End container -->
    </div><!--End bg_gray_container -->



    <div class=" container_gray_line" id="newsletter_container">
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