<!DOCTYPE html>
{{-- <html> --}}

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="college, campus, university, courses, school, educational">
    <meta name="description" content="Biopharma Institute Of Clinical Research">
    <meta name="author" content="Ansonika">
    <title>Biopharma Institute Of Clinical Research</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('university/img/favicon-biopharma.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('university/img/favicon-biopharma.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ asset('university/img/favicon-biopharma.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{ asset('university/img/favicon-biopharma.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{ asset('university/img/favicon-biopharma.png') }}">

    <!-- BASE CSS -->
    <link href="{{ asset('university/css/main_font/main_font.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/animate.min.css') }}" rel="stylesheet">

    <link href="{{ asset('university/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/elegant_font/elegant_font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/icon_font/pe-icon-7-stroke.min.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/fontello/css/fontello.min.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/edu_fonts/edu_fonts.min.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/magnific-popup.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('university/css/custom.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('university/layerslider/css/layerslider.css') }}" rel="stylesheet">
    <link href="{{ asset('university/css/tabs.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="{{ asset('university/js/jquery-1.11.2.min.js') }}"></script>
    <style>
        body, html {
            height: 100%;
        }
    </style>
</head>

<body>


    <div id="preloader">
        <div class="pulse"></div>
    </div><!-- Pulse Preloader -->

    <!-- Header================================================== -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div id="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('admin/images/bicphs_logo_new.png') }}"
                                alt="biopharma" data-retina="true"></a>
                    </div>
                </div>
                <nav class="col-md-9 col-sm-9 col-xs-9">
                    <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu
                            mobile</span></a>
                    <div class="main-menu">
                        <div id="header_menu">
                            <img src="{{ asset('admin/images/bicphs_logo_new.png') }}"  
                                alt="biopharma" data-retina="true">
                        </div>
                        <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                        {{-- <ul>
                        <li>
                            <a href="{{ url('/') }}">Home </a>
                        </li>
                        <li>
                            <a href="{{ url('/course') }}">Course Details</a>
                        </li>
                        <li>
                            <a href="{{ url('/about') }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ url('/plan_visit') }}">Plan A Visit</a>
                        </li>
                        <li>
                            <a href="{{ url('/alumni') }}">Our Alumni</a>
                        </li>
                        <li>
                            <a href="{{ url('/login') }}">Login</a>
                        </li>
                        <li>
                            <a href="{{ url('/get_enrolled') }}" id="" class="btn btn-primary">Get Enrolled</a>
                        </li>
                        <!-- <li><a href="#search" id="search_bt" class="btn btn-primary">Get Enrolled</a></li> -->
                    </ul> --}}
                    </div><!-- End main-menu -->
                </nav>
            </div>
        </div><!-- container -->
    </header><!-- End Header -->

    <div class="login-container">
        <img class="wave" src="{{ asset('university/img/wave.png') }}">
        <div class="login-inner-container">
        <div class="img-login">
            <img src="{{ asset('university/img/14553.png') }}">
        </div>
        <div class="login-content">
            <form class="login-form" action="{{ route('submitForm', $role) }}" method="POST">
                @csrf()
                <input type="hidden" value={{ $role }} name="role" />
                <img src="{{ asset('university/img/avatar.png') }}">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>User Email</h5>
                        <input type="text" class="input" name="email">
                    </div>
                </div>
                <small
                    class="text-danger">{{ is_array($errors) && !empty($errors['email']) ? $errors['email'][0] : '' }}</small>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password">
                    </div>
                </div>
                <small
                    class="text-danger">{{ is_array($errors) && !empty($errors['password']) ? $errors['password'][0] : '' }}</small>
                {{-- <a href="#" class="forget-pass">Forgot Password?</a> --}}
                <input type="submit" class="btn-login" value="Login">
                <div class="signup-link">
                    {{-- <p>Don't have account ? <a href="{{ url('/signup') }}">Signup</a></p> --}}
                </div>
            </form>

        </div>
        </div>
        

    </div>

            
    <script>
        const inputs = document.querySelectorAll(".input");


        function addcl() {
            let parent = this.parentNode.parentNode;
            parent.classList.add("focus");
        }

        function remcl() {
            let parent = this.parentNode.parentNode;
            if (this.value == "") {
                parent.classList.remove("focus");
            }
        }


        inputs.forEach(input => {
            input.addEventListener("focus", addcl);
            input.addEventListener("blur", remcl);
        });
    </script>
    {{-- <footer>
        <div class="container">
            <div class="row ">
                <div class="col-md-4 col-sm-4">
                    <p id="logo_footer">
                        <img src="{{ asset('university/img/Final-Logo.png') }}" width="100%" height="auto"
                            alt="biopharma" data-retina="true">
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
    </footer> --}}
    {{-- <div id="copy">
        <div class="container">
            © Biopharma Institute Of Clinical Research 2023 - All rights reserved.
        </div>
    </div> --}}
    <!-- End copy -->


    <!-- Common scripts -->

    <script src="{{ asset('university/js/common_scripts_min.js') }}"></script>
    <script src="{{ asset('university/js/functions.js') }}"></script>
    <script src="{{ asset('university/assets/validate.js') }}"></script>

    <!-- Specific scripts -->
    <script src="{{ asset('university/layerslider/js/greensock.js') }}"></script>
    <script src="{{ asset('university/layerslider/js/layerslider.transitions.js') }}"></script>
    <script src="{{ asset('university/layerslider/js/layerslider.kreaturamedia.jquery.js') }}"></script>

</body>

</html>
