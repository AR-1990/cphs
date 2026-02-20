@extends('university.main')
@section('content')
    <div class="sub_header bg_1">
        <div id="intro_txt">
            <h1>Online <strong>Apply</strong> Course</h1>
            <p>This is Dummy Text, This is Dummy Text </p>
        </div>
    </div>
    <!--End sub_header -->

    <div class="container_gray_bg">

        <div class="container margin_60">
            <div class="row">

                <div class="col-md-9">
                    <div class="box_style_1">
                        <form action="apply_online.php" id="apply_online" method="POST">
                            <div class="indent_title_in">
                                <i class="pe-7s-user"></i>
                                <h3>Personal details</h3>
                                <p>This is Dummy Text This is Dummy Text.</p>
                            </div>
                            <div class="wrapper_indent">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name</label>
                                            <input type="text" class="form-control styled required" id="name_apply"
                                                name="name_apply" placeholder="First name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last name</label>
                                            <input type="text" class="form-control styled required" id="lastname_apply"
                                                name="lastname_apply" placeholder="Last name">
                                        </div>
                                    </div>
                                </div><!-- End row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control styled required" id="email_apply"
                                                name="email_apply" placeholder="youremail@domain.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input type="text" class="form-control styled required" id="phone_apply"
                                                name="phone_apply" placeholder="XXX XXX XXXX">
                                        </div>
                                    </div>
                                </div><!-- End row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of birth</label>
                                            <input type="text" class="form-control styled required" id="birth_apply"
                                                name="birth_apply" placeholder="dd/mm/year">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label><br>
                                            <div class="radio_inline">
                                                <input type="radio" name="gender_apply" id="gender_apply_male"
                                                    class="required" value="Male"><label
                                                    style="margin-right:20px;">Male</label>
                                                <input type="radio" name="gender_apply" id="gender_apply_female"
                                                    class="required" value="Female"><label>Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End row -->
                            </div>
                            <hr class="styled_2">
                            <div class="indent_title_in">
                                <i class="pe-7s-map-marker"></i>
                                <h3>Address</h3>
                                <p>This is Dummy Text This is Dummy Text.</p>
                            </div>
                            <div class="wrapper_indent">


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address line</label>
                                            <input type="text" class="form-control styled required" id="address_apply"
                                                name="address_apply" placeholder="Your full address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control styled required" id="town_apply"
                                                name="town_apply" placeholder="Town">
                                        </div>
                                    </div>
                                </div><!-- End row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Country</label>
                                        <div class="styled-select">
                                            <select class="form-control required" name="country_apply" id="country_apply">
                                                <option value="" selected>Select your country</option>
                                                <option value="USA">USA</option>
                                                <option value="Europe">Europe</option>
                                                <option value="Asia">Asia</option>
                                                <option value="North America">North America</option>
                                                <option value="South America">South America</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control styled required"
                                                id="postal_code_apply" name="postal_code_apply" placeholder="001238">
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <hr class="styled_2">

                            <div class="wrapper_indent">
                                <div class="form-group">
                                    <input type="checkbox" name="policy_terms" id="policy_terms" class="required"
                                        value="Yes"><label>I accept <a href="#0">terms and conditions</a> and
                                        general
                                        policy.</label>
                                </div>
                                <p><button type="submit" class="button">Submit</button></p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">

                    <h4><strong>How to apply</strong></h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text</p>

                    <div class="box_side">
                        <h5>Phone</h5> <i class="icon-phone"></i>
                        <p>(281) 944-3610<br><small>Monday to Friday 9.00am - 5.00pm</small></p>
                    </div>
                    <hr class="styled">
                    <div class="box_side">
                        <h4>Plan a visit</h4> <i class="icon_pencil-edit"></i>
                        <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text.</p>
                        <a href="{{ url('/plan_visit') }}" class="button small">Plan a visit</a>
                    </div>

                </div>
            </div>
            <!--End row -->
        </div>
        <!--End container -->
    </div>
    <!--End container_gray_bg -->

    <div class="container margin_60">
        <div class="main_title">
            <h2>Frequently Asked Questions</h2>
            <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text.</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Question?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Question?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Question?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text.</p>
                </div>
            </div>
        </div>
        <!--End row -->
        <div class="row">
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Question?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Question?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box_style_2">
                    <h4>This is Dummy Question?</h4>
                    <p>This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text This is Dummy Text
                        This is Dummy Text This is Dummy Text.</p>
                </div>
            </div>
        </div>
        <!--End row -->
    </div>
    <!--End container -->

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

    <!-- Specific scripts -->
    <script src="{{ asset('university/js/icheck.js') }}"></script>
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue'
        });
    </script>
    <script src="{{ asset('university/js/jquery.validate.js') }}"></script>
    <script>
        $("#apply_online").validate();
    </script>
@endsection
