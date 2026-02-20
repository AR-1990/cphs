<footer>
    <div class="container">
        <div class="row ">
            <div class="col-md-4 col-sm-4">
                <p id="logo_footer">
                    <img src="{{ asset('university/img/Final-Logo.png') }}" width="100%" height="auto" alt="biopharma"
                        data-retina="true">
                </p>
            </div>
            <div class="col-md-3 col-sm-3">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="{{ url('/about') }}">About us</a></li>
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/signup') }}">Register</a></li>
                    <li><a href="#">Terms and condition</a></li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-2">
                <h4>Academic</h4>
                <ul>
                    <!-- <li><a href="#">Plans of study</a></li> -->
                    <li><a href="{{ url('/course') }}">Course Details</a></li>
                    <li><a href="{{ url('/get_enrolled') }}">Admissions</a></li>
                    <!-- <li><a href="#">Staff</a></li> -->
                    <li><a href="{{ url('alumni') }}">Our Alumni</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h4>Contact</h4>
                <ul>
                    <li><a href="{{ url('contact') }}">Contacts Us</a></li>
                    <li><a href="{{ url('plan_visit') }}">Plan a visit</a></li>
                </ul>
                <ul id="contacts_footer">
                    <li>Info line - <a href="tel:(281) 944-3610">(281) 944-3610</a></li>
                    <li>Email - <a href="mailto:info@biopharmauniversity.com">info@biopharmauniversity.com</a></li>
                </ul>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer><!-- End footer -->
<div id="copy">
    <div class="container">
        © Biopharma Institute Of Clinical Research 2023 - All rights reserved.
    </div>
</div>
<!-- End copy -->


<!-- Common scripts -->

<script src="{{ asset('university/js/common_scripts_min.js') }}"></script>
<script src="{{ asset('university/js/functions.js') }}"></script>
<script src="{{ asset('university/assets/validate.js') }}"></script>

<!-- Specific scripts -->
<script src="{{ asset('university/layerslider/js/greensock.js') }}"></script>
<script src="{{ asset('university/layerslider/js/layerslider.transitions.js') }}"></script>
<script src="{{ asset('university/layerslider/js/layerslider.kreaturamedia.jquery.js') }}"></script>