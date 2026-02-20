{{-- <style>
    .fullImg{
        position: fixed;
        inset : 0;
        height: 100vh;
        width: 100%;
        opacity: 0;
        visibility: hidden;
        user-select: none;
        pointer-events: none;
    }
</style>
<img src="{{ asset('admin/images/temp-img/1.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/2.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/3.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/4.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/5.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/6.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/7.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/8.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/9.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/10.png') }}" class="img-fluid fullImg" alt="logo" />
<img src="{{ asset('admin/images/temp-img/11.png') }}" class="img-fluid fullImg" alt="logo" />
<video autoplay loop muted class='fullImg'>
    <source src="{{ asset('admin/images/temp-img/Phone5(T)_1.mp4') }}">
</video> --}}
<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-black-dodger-blue sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->

            <a href="{{ route('admin.dashboard.index') }}" class="sidebar-brand ">

                <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                    <span class="avatar-title rounded bg-primary"><img
                                src="{{ asset('admin/images/illustration/teacher/128/white.svg') }}" class="img-fluid"
                                alt="logo" /></span>

                </span>

                <span>Admin</span>
            </a>

            @php
            $user = auth()->guard('admin')->user();
            @endphp
            @if ($user && $user->role == '1')
            <div class="sidebar-heading">Menu</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('admin.dashboard.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dashboard</span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>

                

                
                
                
                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.students.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Students</span>
                    </a>
                </li> --}}
                <li class="sidebar-menu-item {{ request()->routeIs('admin.school.index') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('admin.school.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">location_city</span>
                        <span class="sidebar-menu-text">Schools</span>
                    </a>
                </li>
               

                <li class="sidebar-menu-item {{ request()->routeIs('Screening') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('Screening') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                        <span class="sidebar-menu-text"> Student's Profiles</span>
                    </a>
                </li>

                
                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.form_entry.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                        <span class="sidebar-menu-text">Screened Students</span>
                    </a>
                </li> --}}


                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.location.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">where_to_vote</span>
                        <span class="sidebar-menu-text">Locations</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.form.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment</span>
                        <span class="sidebar-menu-text">Screening Form</span>
                    </a>
                </li> --}}



                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.form.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment</span>
                        <span class="sidebar-menu-text">Screening Form</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.doctorperformance.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">equalizer</span>
                        <span class="sidebar-menu-text">Team Performance</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.doctorperformance.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">equalizer</span>
                        <span class="sidebar-menu-text">Team Performance</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('admin.doctorperformance.index') }}">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">badge</span>
                                <span class="sidebar-menu-text">Office Staff</span>
                            </a></li>
                        <li><a href="{{ Route('Psychologist') }}">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">psychology</span>
                                <span class="sidebar-menu-text">Psychologist</span>
                            </a></li>
                        <li><a href="{{ Route('Nutritionist') }}">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">nutrition</span>
                                <span class="sidebar-menu-text">Nutritionist</span>
                            </a></li>
                        <li><a href="{{ Route('Physician') }}">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">stress_management</span>
                                <span class="sidebar-menu-text">Physician</span>
                            </a></li>
                    </ul>
                </li> --}}



                    <li
                        class="sidebar-menu-item {{ request()->routeIs(['admin.doctorperformance.index', 'Psychologist', 'Nutritionist', 'Physician']) ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('admin.doctorperformance.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">equalizer</span>
                        <span class="sidebar-menu-text">Team Performance</span>
                    </a>
                    <ul class="sidebar-submenu" {!! request()->routeIs(['admin.doctorperformance.index', 'Psychologist', 'Nutritionist', 'Physician'])
                        ? 'style="display: block;"'
                        : '' !!}>
                        <li class="{{ request()->routeIs('admin.doctorperformance.index') ? 'active' : '' }}">
                            <a {!! request()->routeIs('admin.doctorperformance.index') ? '' : '' !!} href="{{ route('admin.doctorperformance.index') }}">
                                <!-- <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">badge</span>   -->
                                <!-- <span class="sidebar-menu-text"> -->
                                Office Staff
                                <!-- </span>         -->
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('Psychologist') ? 'active' : '' }}">
                            <a {!! request()->routeIs('Psychologist') ? '' : '' !!} href="{{ route('Psychologist') }}">
                                <!-- <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">psychology</span>         -->
                                <!-- <span class="sidebar-menu-text"> -->
                                Psychologist
                                <!-- </span> -->
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('Nutritionist') ? 'active' : '' }}">
                            <a {!! request()->routeIs('Nutritionist') ? '' : '' !!} href="{{ route('Nutritionist') }}">
                                <!-- <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">nutrition</span>      -->
                                <!-- <span class="sidebar-menu-text"> -->
                                Nutritionist
                                <!-- </span> -->
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('Physician') ? 'active' : '' }}">
                            <a {!! request()->routeIs('Physician') ? '' : '' !!} href="{{ route('Physician') }}">
                                <!-- <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">stress_management</span>         -->
                                <!-- <span class="sidebar-menu-text"> -->
                                Physician
                                <!-- </span>     -->
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="sidebar-menu-item {{ request()->routeIs('Nutritionist') ? 'active' : '' }}" data-route="{{ Route::currentRouteName() }}"
                    style="{{ Route::currentRouteName() == 'Nutritionist' ? 'display: block;' : '' }}">

                    <a class="sidebar-menu-button" href="{{ route('admin.user.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">group</span>
                        <span class="sidebar-menu-text">Users</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->routeIs('IndexMedicalHistory') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('IndexMedicalHistory') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_hospital</span>
                        <span class="sidebar-menu-text">Medical History</span>

                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->routeIs('ScreeningForm') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('ScreeningForm') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">description</span>
                        <span class="sidebar-menu-text">Screened Form</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->routeIs('LogActivity') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('LogActivity') }}">
                            <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left">notification_important</span>
                        <span class="sidebar-menu-text">Log Activity</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->routeIs('Calendar') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('Calendar') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">date_range</span>
                        <span class="sidebar-menu-text">Calendar</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->routeIs('new_calendar') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('new_calendar') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">date_range</span>
                        <span class="sidebar-menu-text">New Calendar</span>
                    </a>
                </li>
                {{--
                <li class="sidebar-menu-item {{ request()->routeIs('follow-up-list') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('follow-up-list') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">send</span>
                        <span class="sidebar-menu-text">Follow Up</span>
                    </a>
                </li>
                --}}
                <li class="sidebar-menu-item {{ request()->routeIs('followUpJoinList') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('followUpJoinList') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">send</span>
                        <span class="sidebar-menu-text">Follow Up</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->routeIs('admin.school.trainingsIndex') ? 'active' : '' }}">
    <a class="sidebar-menu-button" href="{{ route('admin.school.trainingsIndex') }}">
        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">send</span>
        <span class="sidebar-menu-text">Trainings</span>
    </a>
</li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_hospital</span>
                        <span class="sidebar-menu-text">Medical History Report</span>
                    </a>
                    <ul class="sidebar-submenu">
                       
                       
                       <li>
                            <a href="{{url('/case-identified')}}">
                                Case Identified
                            </a>
                        </li>
                        <!-- <li>
                            <a href="{{url('/PhysiciancaseIdentified')}}">
                                Physicians Case Identified
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/nutritionistassesmentfields')}}">
                               Nutritionist Case Identified
                            </a>
                        </li>
                         <li>
                            <a href="{{url('/psychologistassesmentfields')}}">
                               Psychologist Case Identified
                            </a>
                        </li> -->
                         <!-- <li>
                            <a href="{{url('/assesment-summary-report')}}">
                                Assestment
                            </a>
                        </li> -->
                    </ul>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">description</span>
                        <span class="sidebar-menu-text">Screened Form Report</span>
                    </a>
                    <ul class="sidebar-submenu">
                     <li>
                            <a href="{{url('/reportable-findings')}}">
                                Finding
                            </a>
                        </li>    
                    <li>
                            <a href="{{url('/followup-summary-report')}}">
                               Follow-up
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="sidebar-menu-item {{ request()->routeIs('export.data') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('export.data') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">delete_sweep</span>
                        <span class="sidebar-menu-text">Cache Clear</span>
                    </a>
                </li>


            </ul>

        </div>

        {{-- School --}}
        @elseif ($user && $user->role == 3)
        <div class="sidebar-heading">Menu</div>
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('admin.dashboard.schoolDashboard2') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                    <span class="sidebar-menu-text">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('findings') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                    <span class="sidebar-menu-text">Student</span>
                </a>
            </li>

            {{-- <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('findings') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">description</span>
                    <span class="sidebar-menu-text">Findings</span>
                </a>
            </li> --}}
            

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('export.data') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">delete_sweep</span>
                    <span class="sidebar-menu-text">Cache Clear</span>
                </a>
            </li>

        </ul>
        @else
        <div class="sidebar-heading">Menu</div>
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('admin.dashboard.index') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                    <span class="sidebar-menu-text">Dashboard</span>
                </a>
            </li>
            <!-- <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('CreateScreening') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                    <span class="sidebar-menu-text">Enrollment Form</span>
                </a>
            </li> -->

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('Screening')}}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                    <span class="sidebar-menu-text">Student Data</span>
                </a>
            </li>
                <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('ScreeningForm') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                    <span class="sidebar-menu-text">Screening Forms</span>
                </a>
            </li> 

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('IndexMedicalHistory') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                    <span class="sidebar-menu-text">Medical History</span>

                </a>
            </li>

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('export.data') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">delete_sweep</span>
                    <span class="sidebar-menu-text">Cache Clear</span>
                </a>
            </li>


        </ul>

    </div>
    @endif
</div>
</div>

<style>
    .sidebar-submenu {
        display: none;
        list-style: none;
        padding-left: 20px;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 10px;
        overflow: hidden;
        margin: 5px 20px !important;
    }


    .sidebar-menu-item:hover .sidebar-submenu {
        display: block;
    }


    .sidebar-menu-item li>a {
        display: flex;
        align-items: center;
        justify-content: left;
        color: white;
        text-decoration: none;
        padding: 10px;

    }

    .sidebar-submenu li a {
        display: block;
        padding: 10px;
        color: rgb(0 0 0 / 58%) !important;
        text-align: center;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        background-color: #fff;
    }


    .sidebar-submenu li a:hover {
        background-color: #d86744;
        color: white !important;
    }

    .sidebar-submenu li.active a {
        color: #d86744 !important;
    }

    .sidebar-submenu li.active a:hover {
        color: white !important;
    }
</style>
