@extends('university.main')
@section('content')
    <div class="sub_header bg_1">
        <div id="intro_txt">
            <h1><strong>Course Name</strong></h1>
            <p>This is Dummy Text This is Dummy Text</p>
        </div>
    </div> <!--End sub_header -->

    <div class="container_gray_bg">

        <div class="container margin_60">
            <div class="row">

                <div class="col-md-9">
                    <div class="box_style_1">
                        <div class="indent_title_in">
                            <i class="pe-7s-news-paper"></i>
                            <h3>Summary</h3>
                            <p>This is Dummy Text This is Dummy Text</p>
                        </div>
                        <div class="wrapper_indent">
                            <p>
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                            </p>
                            <p>
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                            </p>
                            <p class="add_bottom_30">
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><img src="{{ asset('university/img/course_1_1_thumb.jpg') }}" alt="" class="img-responsive"></p>
                                    <h4>Main targets</h4>
                                    <p>
                                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><img src="{{ asset('university/img/course_1_2_thumb.jpg') }}" alt="" class="img-responsive"></p>
                                    <h4>Future applications</h4>
                                    <p>
                                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr class="styled_2">
                        <div class="indent_title_in">
                            <i class="pe-7s-display1"></i>
                            <h3>Lessons</h3>
                            <p>This is Dummy Text</p>
                        </div>
                        <div class="wrapper_indent">
                            <p>
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list_style_1">
                                        <li>Lesson Name</li>
                                        <li>Lesson Name</li>
                                        <li>Lesson Name</li>
                                        <li>Lesson Name</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list_style_1">
                                        <li>Lesson Name</li>
                                        <li>Lesson Name</li>
                                        <li>Lesson Name</li>
                                        <li>Lesson Name</li>
                                    </ul>
                                </div>
                            </div>
                        </div>




                        <hr class="styled_2">

                        <div class="indent_title_in">
                            <i class="pe-7s-clock"></i>
                            <h3>Time table</h3>
                            <p>This is Dummy Text</p>
                        </div>
                        <div class="wrapper_indent">
                            <p>
                                This is Dummy Text This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text
                                This is Dummy Text This is Dummy Text
                            </p>

                            <table class="table table-striped cart-list add_bottom_30">
                                <thead>
                                    <tr>
                                        <th>
                                            Day
                                        </th>
                                        <th>
                                            Lessons
                                        </th>
                                        <th>
                                            Workshops
                                        </th>
                                        <th>
                                            Group session
                                        </th>
                                        <th>
                                            Exams
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Monday
                                        </td>
                                        <td>
                                            09.00am - 11.00am
                                        </td>
                                        <td>
                                            11.00am - 12.00am
                                        </td>
                                        <td>
                                            02.00pm - 04.00pm
                                        </td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Tuesday
                                        </td>
                                        <td>
                                            09.00am - 11.00am
                                        </td>
                                        <td>
                                            11.00am - 12.00am
                                        </td>
                                        <td>
                                            02.00pm - 04.00pm
                                        </td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Wednesday
                                        </td>
                                        <td>
                                            09.00am - 11.00am
                                        </td>
                                        <td>
                                            11.00am - 12.00am
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            02.00pm - 04.00pm
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Thursday
                                        </td>
                                        <td>
                                            09.00am - 11.00am
                                        </td>
                                        <td>
                                            11.00am - 12.00am
                                        </td>
                                        <td>
                                            02.00pm - 04.00pm
                                        </td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Friday
                                        </td>
                                        <td>
                                            09.00am - 11.00am
                                        </td>
                                        <td>
                                            11.00am - 12.00am
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            02.00pm - 04.00pm
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <hr class="styled_2">
                        <div class="indent_title_in">
                            <i class="pe-7s-credit"></i>
                            <h3>Pricing</h3>
                            <p>This is Dummy Text</p>
                        </div>
                        <div class="wrapper_indent">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="pricingTable">
                                            <div class="pricing_heading">
                                                <h3 class="title">Pricing Plan</h3>
                                                <span class="value">
                                                    $10,000
                                                    <span class="month">per course</span>
                                                </span>
                                            </div>
                                            <div class="content">
                                                <ul>
                                                    <li>This is Dummy Text</li>
                                                    <li>This is Dummy Text</li>
                                                    <li>This is Dummy Text</li>
                                                    <li>This is Dummy Text</li>
                                                    <li>This is Dummy Text</li>
                                                </ul>
                                                <div class="link">
                                                    <a href="signup.html">sign up</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <aside class="col-md-3">

                    <h4><strong>How to apply</strong></h4>
                    <p>
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text
                    </p>
                    <hr class="styled">
                    <div class="box_side">
                        <h5>Phone</h5>
                        <i class="icon-phone"></i>
                        <p>
                            <a href="tel://(281) 944-3610">(281) 944-3610</a><br>
                            <small>Monday to Friday 9.00am - 5.00pm</small>
                        </p>
                    </div>
                    <hr class="styled">
                    <div class="box_side">
                        <h5>Apply Online</h5>
                        <i class="icon_desktop"></i>
                        <p>
                            This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        </p>
                        <p>
                            <a href="{{ url('/get_enrolled') }}" class="button small">Apply online</a>
                        </p>
                    </div>
                </aside>
            </div><!--End row -->
        </div><!--End container -->
    </div><!--End container_gray_bg -->

    <div class="container margin_60">
        <div class="main_title">
            <h2>Frequently questions</h2>
            <p>This is Dummy Text This is Dummy Text</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Text?</h4>
                    <p>
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Text ?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Text ?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text </p>
                </div>
            </div>
        </div><!--End row -->
        <div class="row">
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Text ?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Text ?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Text ?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text </p>
                </div>
            </div>
        </div><!--End row -->
    </div><!--End container -->

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
    </div>
    <!-- End newsletter_container -->

@endsection