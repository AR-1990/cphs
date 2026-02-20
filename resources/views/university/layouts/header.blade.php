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
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('university/img/favicon-biopharma.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('university/img/favicon-biopharma.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('university/img/favicon-biopharma.png') }}">

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
    <script src="{{ asset('university/js/jquery-1.11.2.min.js') }}"></script>
</head>
<body>
    

    <div id="preloader">
        <div class="pulse"></div>
    </div><!-- Pulse Preloader -->

    @include('university.layouts.navbar')
    @yield('content')

    @include('university.layouts.footer')

</body>
</html>
