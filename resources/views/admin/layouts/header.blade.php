@php
    use App\Models\MedicalNotifications;
    use App\Models\StudentBiodata;

    $MedicalNotificationsCount = 0;
    /*$userIDNotification = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? Auth::guard(config('constants.ADMIN_GUARD'))->user()->id : Auth::guard(config('constants.STUDENT_GUARD'))->user()->id;*/

    if (auth()->guard('admin')->check()) {
        $UserIDNotification = auth()->guard('admin')->user()->id;
        $UserRoleNotification = auth()->guard('admin')->user()->role;
        $UserDesignationNotification = auth()->guard('admin')->user()->designation;

        /*$MedicalNotifications = MedicalNotifications::where('read_status', 1);*/
        $MedicalNotifications = MedicalNotifications::where('deleted', 0)->orderBy('id', 'desc');

        $MedicalNotificationsCount = MedicalNotifications::where('read_status', 1)
            ->where('deleted', 0)
            ->orderBy('id', 'desc');

        /* admin role */
        if ($UserRoleNotification == 1) {
            $MedicalNotifications = $MedicalNotifications->where('created_by', '!=', null);
            $MedicalNotificationsCount = $MedicalNotificationsCount->where('created_by', '!=', null);
        } else {
            $MedicalNotifications = $MedicalNotifications->where('created_by', $UserIDNotification);
            $MedicalNotificationsCount = $MedicalNotificationsCount->where('created_by', $UserIDNotification);
        }

        $MedicalNotificationsCount = $MedicalNotificationsCount->count();
        $MedicalNotifications = $MedicalNotifications->limit(800)->get()->toArray();


    }

@endphp


<!DOCTYPE html>
<html lang="en" dir="ltr" class="dark-mode">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biopharma Child Preventive Health Services</title>
    <!-- Fav icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/images/favicon-biopharma.png') }}">
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Preloader -->
    <link type="text/css" href="{{ asset('admin/vendor/spinkit.css') }}" rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('admin/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('admin/css/material-icons.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{ asset('admin/css/fontawesome.css') }}" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="{{ asset('admin/css/preloader.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ asset('admin/css/app.css') }}" rel="stylesheet">

    <!-- Dark Mode CSS -->
    <link type="text/css" href="{{ asset('admin/css/dark.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Sweet Alert  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css">

    <!-- jQuery -->
    <script src="{{ asset('admin/vendor/jquery.min.js') }}"></script>

    {{-- select2 css --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .noti-dropdown-float-container {
            position: absolute;
            right: 0;
            top: 50px;
            background: #FFFFFF;
            border: 1px solid #ddd;
            border-radius: 6px;
            filter: drop-shadow(4px 4px 20px rgba(0, 0, 0, 0.25));
            width: 450px;
            z-index: 2000 !important;
            display: none;
            min-height: 100px;
            overflow-y: auto;
            max-height: 250px;
        }

        .noti-dropdown-field {
            cursor: pointer;
            position: relative;
            margin-right: 20px;
        }

        #drop {
            transition: all 0.3s ease;
            /* Apply transition in CSS */
        }

        .noti-dropdown-list {
            list-style-type: none;
            padding: 0;
            margin: 0 !important;
        }

        .noti-dropdown-list a {
            border-radius: 0px;
            text-decoration: none;
            color: #000;
        }

        .noti-dropdown-list a p {
            transition: .3s;
        }

        .noti-dropdown-list a p.unread {
            background: #ddd;
            color: #d86744;
            border-bottom: 1px solid #fff;
            font-weight: 500;
        }

        .noti-dropdown-list a:hover p {
            background: #d86744;
            color: #fff;
            transition: .3s;
        }

        .noti-dropdown-float-container {
            border: 1px solid #DDDDDD;
            border-radius: 6px;
            color: #3B3C3E;
        }

        .noti-dropdown-float-container {
            overflow: scroll;
            overflow-x: hidden;
        }

        .noti-dropdown-float-container::-webkit-scrollbar-track {
            /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); */
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        .noti-dropdown-float-container::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        .noti-dropdown-float-container::-webkit-scrollbar-thumb {
            border-radius: 0;
            /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3); */
            background-color: rgba(0, 0, 0, .15);
        }

        .noti-dropdown-float-container::-webkit-scrollbar-thumb:hover {
            background-color: #d86744;
        }

        .custom_badge {
            background-color: #EF3A26;
            height: 20px;
            width: 20px;
            border-radius: 30px !important;
            left: 15px;
            top: -10px !important;
            padding: 0px !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .NotificationViewLinkClick a {
            background: #faf5f2;
            display: block;
            padding: 8px 10px;
            color: #d86744;
            border: none;
            font-size: 16px;
            letter-spacing: 0.1em;
            font-weight: 500;
            transition: .3s;
        }

        .NotificationViewLinkClick a:hover {
            background: #d86744;
            color: #fff;
            transition: .3s;
        }
    </style>
</head>

<body class="layout-app ">

    - <div class="preloader">
        <div class="preloader-inner">
            <img src="{{ asset('admin/images/bicphs_logo_new.png') }}">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>

    </div>

    <!-- Drawer Layout -->

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            <!-- Header -->
            <!-- Navbar -->

            <div class="navbar navbar-expand py-2 pr-0 navbar-dark border-bottom-2" id="default-navbar" data-primary>

                <!-- Navbar Toggler -->

                <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0" type="button"
                    data-toggle="sidebar">
                    <span class="material-icons">short_text</span>
                </button>

                <!-- // END Navbar Toggler -->

                <!-- Navbar Brand -->

                <a href="index.html" class="navbar-brand mr-16pt d-lg-none">

                    <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

                        <span class="avatar-title rounded bg-primary"><img
                                src="{{ asset('admin/images/illustration/teacher/128/white.svg') }}" alt="logo"
                                class="img-fluid" /></span>

                    </span>

                    <span class="d-none d-lg-block">Biopharma Child Preventive Health Services</span>
                </a>

                <!-- // END Navbar Brand -->

                <span class="d-none d-md-flex align-items-center mr-16pt logo-center">


                    <small class="flex d-flex flex-column">
                        <a href="{{ route('admin.dashboard.index') }}">
                            <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" class="logo-university">
                        </a>
                    </small>

                </span>

                <div class="flex"></div>


                <div class="nav navbar-nav flex-nowrap d-flex mr-16pt align-items-center">

                    <!-- Notifications dropdown -->
                    <!-- <div class="nav-item ml-16pt dropdown dropdown-notifications dropdown-xs-down-full"
                        data-toggle="tooltip" data-title="Notifications" data-placement="bottom" data-boundary="window">
                        <button class="nav-link btn-flush dropdown-toggle" type="button" data-toggle="dropdown"
                            data-caret="false">
                            <i class="material-icons">notifications_none</i>
                            <span class="badge badge-notifications badge-accent">2</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div data-perfect-scrollbar class="position-relative">
                                <div class="dropdown-header"><strong>System notifications</strong></div>
                                <div class="list-group list-group-flush mb-0">

                                    <a href="javascript:void(0);" class="list-group-item list-group-item-action unread">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">3 minutes ago</small>

                                            <span class="ml-auto unread-indicator bg-accent"></span>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle bg-light">
                                                    <i
                                                        class="material-icons font-size-16pt text-accent">account_circle</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">

                                                <span class="text-black-70">This is Dummy Text</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="javascript:void(0);" class="list-group-item list-group-item-action">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">5 hours ago</small>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle bg-light">
                                                    <i class="material-icons font-size-16pt text-primary">group_add</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">
                                                <strong class="text-black-100">Dummy Name</strong>
                                                <span class="text-black-70">This is Dummy Text</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="javascript:void(0);" class="list-group-item list-group-item-action">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">1 day ago</small>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle bg-light">
                                                    <i class="material-icons font-size-16pt text-warning">storage</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">

                                                <span class="text-black-70">This is Dummy Text </span>
                                            </span>
                                        </span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- // END Notifications dropdown -->
                    <div class="noti-dropdown-field position-relative">
                        <span class="position-absolute top-0 start-100 translate-middle badge text-light custom_badge">
                            {{ $MedicalNotificationsCount }}

                            <span class="visually-hidden"></span>
                        </span>
                        <i class="fa-solid fa-bell h4 mb-0 cursor-pointer" onclick="dropdownNoti()"></i>



                        <div class="noti-dropdown-float-container" id="drop"
                            style="display: none; transition: all 1s ease;">
                            <ul class="noti-dropdown-list" id="NotificationViewLinkClickUL">

                                <li class="notFound">

                                    @if (empty($MedicalNotifications))
                                        <h4 class="text-center">No new notifications.</h4>
                                    @else
                                        @if (!empty($MedicalNotifications))
                                            @foreach ($MedicalNotifications as $MedicalNotification)
                                                @php

                                                    $NotificationText = 'Check your Medical History';
                                                    $StudentBiodataNotifications = StudentBiodata::find(
                                                        $MedicalNotification['redirect_link'],
                                                    );

                                                    if (!empty($StudentBiodataNotifications)) {
                                                        $NotificationText =
                                                            'Check  <b>GR: ' .
                                                            $StudentBiodataNotifications->GRNo .
                                                            '</b>, <b>' .
                                                            $StudentBiodataNotifications->name .
                                                            '</b>,  Medical History';
                                                    }

                                                @endphp
                                                {{-- Medical History Notifications --}}
                                                @if ($MedicalNotification['notification_type'] == 0)
                                                    {{-- School role = 3 --}}
                                                    @if ($UserRoleNotification == 3)
                                                        <a class="bg-secondary MedicalNotificationClick"
                                                            data-id="{{ $MedicalNotification['id'] }}"
                                                            data-href="#">

                                                            <p
                                                                class=" @if ($MedicalNotification['read_status'] == 1) unread @endif m-0 px-3 py-2">
                                                                {!! $NotificationText !!}
                                                            </p>
                                                        </a>
                                                    @else
                                                        <a class="bg-secondary MedicalNotificationClick"
                                                            data-id="{{ $MedicalNotification['id'] }}"
                                                            data-href="{{ Route('SchoolHealthPhysician') }}/{{ $MedicalNotification['redirect_link'] }}">

                                                            <p
                                                                class=" @if ($MedicalNotification['read_status'] == 1) unread @endif m-0 px-3 py-2">
                                                                {!! $NotificationText !!}
                                                            </p>
                                                        </a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif

                                    @endif


                                </li>
                                <li class="noti-dropdown-list-item NotificationViewLinkClick text-center">
                                    <a href="{{ route('ShowMedicalNotificationView') }}"
                                        class="noti-dropdown-list-link text-center" data-bs-original-title=""
                                        title="">See
                                        All</a>
                                </li>
                            </ul>


                        </div>



                    </div>

                    <div class="pname" style="width: max-content;">
                        <h5 class="mb-0  ">
                            @if (auth()->guard('admin')->check())
                                {{ Auth::guard('admin')->user()->fullname }}
                            @endif
                        </h5>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex align-items-center dropdown-toggle"
                            data-toggle="dropdown" data-caret="false">

                            <span class="avatar avatar-sm mr-8pt2">

                                <span class="avatar-title rounded-circle bg-primary"><i
                                        class="material-icons">account_box</i></span>

                            </span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header"><strong>Account</strong></div>

                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                data-user-session-id="{{ auth()->guard('admin')->user()->id }}">Logout</a>
                        </div>
                    </div>
                </div>

                <!-- // END Navbar Menu -->

            </div>


            <!-- // END Header -->
            @yield('content')
        </div>
        <!-- // END Navbar -->
        @include('admin.layouts.navbar')

    </div>
    @include('admin.layouts.footer')
</body>

<script>
    function dropdownNoti() {
        var drop = document.getElementById('drop');
        // Toggle the 'd-none' class
        drop.classList.toggle('d-block');
        console.log("work");
        event.stopPropagation();
    }
    document.addEventListener('click', function(event) {
        var drop = document.getElementById('drop');
        // Check if the click event occurred outside the dropdown
        if (!event.target.closest('.noti-dropdown-field')) {
            drop.classList.remove('d-block'); // Hide the dropdown
        }
    });

    $(document).on("click", ".MedicalNotificationClick", function() {

        var id = $(this).data('id');
        console.log("id " + id);

        var href = $(this).data('href');
        console.log("href " + href);


        var base_url = '{!! Route('MedicalNotificationClick') !!}';
        console.log("base_url " + base_url);

        $.ajax({
            url: base_url,
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },

            dataType: 'json',
            beforeSend: function() {

                console.log("----------- beforeSend -------------");

            },

            success: function(resp) {

                console.log("resp " + JSON.stringify(resp));

                if (resp.status === 'success') {
                    window.location.href = href;
                } else {
                    console.log("Error: " + resp.message);
                }


            }
        });


    });
</script>

{{-- </html> --}}
