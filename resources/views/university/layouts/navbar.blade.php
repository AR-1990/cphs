
<!-- Header================================================== -->
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div id="logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('university/img/Final-Logo.png') }}" width="400" height="70"
                            alt="biopharma" data-retina="true"></a>
                </div>
            </div>
            <nav class="col-md-9 col-sm-9 col-xs-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu
                        mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{ asset('university/img/Final-Logo.png') }}" width="250" height="50" alt="biopharma"
                            data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                    <ul>
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
                    </ul>
                </div><!-- End main-menu -->
            </nav>
        </div>
    </div><!-- container -->
</header><!-- End Header -->