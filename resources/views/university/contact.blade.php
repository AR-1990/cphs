@extends('university.main')
@section('content')

    <div class="container_gray_bg">


        <div class="container add_top_150">
            <div class="row">
                <div class="col-md-9">
                    <div class="box_style_1">
                        <div class="indent_title_in">
                            <i class="pe-7s-mail-open-file"></i>
                            <h3>Contact us</h3>
                            <p>
                                This is Dummy Text.
                            </p>
                        </div>
                        <div class="wrapper_indent">
                            <div id="message-contact"></div>
                            <form method="post" action="assets/contact.php" id="contactform">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>First name</label>
                                            <input type="text" class="form-control styled" id="name_contact"
                                                name="name_contact" placeholder="First name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Last name</label>
                                            <input type="text" class="form-control styled" id="lastname_contact"
                                                name="lastname_contact" placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" id="email_contact" name="email_contact"
                                                class="form-control styled" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input type="text" id="phone_contact" name="phone_contact"
                                                class="form-control styled" placeholder="Phone number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Your message</label>
                                            <textarea rows="5" id="message_contact" name="message_contact"
                                                class="form-control styled" style="height:100px;"
                                                placeholder="Your message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" value="Submit" class="button add_bottom_30"
                                            id="submit-contact" />
                                    </div>
                                </div>
                            </form>
                        </div><!-- End wrapper_indent -->

                        
                    </div><!-- End box style 1-->
                </div><!-- End col-md-9 -->

                <aside class="col-md-3">
                    <h3>Contacts info</h3>
                    <hr class="styled">
                    <h4>Address</h4>
                    <p>
                        19255 PARK ROW #205 <br>
                        HOUSTON, TX 77084
                    </p>
                    <h4>Contact Number</h4>
                    <p>
                        (281) 944-3610
                    </p>
                    <h4>Email Address</h4>
                    <p>
                        <a href="mailto:info@biopharmauniversity.com">info@biopharmauniversity.com</a>
                    </p>
                </aside>

            </div><!--End row -->
        </div><!--End container -->
    </div><!--End container_gray_bg -->

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
    <div id="in-google-map">
        <iframe class="map"
            src="https://www.google.com/maps?q=19255+Park+Row+205,+Houston,+TX+77084&hl=en&z=16&t=m&output=embed"
            height="590" width="100%"></iframe>
    </div><!-- end map-->

    <!-- GOOGLE map -->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js??key=&callback=initMap"></script>
    <script type="text/javascript" src="{{ asset('university/js/mapmarker.jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('university/js/mapmarker_func.jquery.js') }}"></script>

    <!-- Date and time pickers -->
    <script src="{{ asset('university/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('university/js/bootstrap-timepicker.js') }}"></script>
    <script>
        
        $('input.date-pick').datepicker();
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: true
        })
    </script>
@endsection