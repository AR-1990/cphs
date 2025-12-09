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
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.dashboard.index') }}">
                        <span
                            class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>
                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.students.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Students</span>
                    </a>
                </li> --}}
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.school.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Schools</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.form_entry.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Screening Data</span>
                    </a>
                </li>
                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.location.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Locations</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.form.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Enrollment Form</span>
                    </a>
                </li> --}}

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.form.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Enrollment Form</span>
                    </a>
                </li>
                
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.doctorperformance.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Doctor Performance</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.user.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Users</span>
                    </a>
                </li>
                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('IndexMedicalHistory') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Medical History</span>

                    </a>
                </li> --}}
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('LogActivity') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Log Activity</span>
                    </a>
                </li>
                {{-- <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('Calendar') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Calendar</span>
                    </a>
                </li> --}}
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('follow-up-list') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Follow Up</span>
                    </a>
                </li>
            </ul>

        </div>
        @else

        <div class="sidebar-heading">Menu</div>
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('admin.dashboard.index') }}">
                    <span
                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                    <span class="sidebar-menu-text">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('admin.form.index') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                    <span class="sidebar-menu-text">Enrollment Form</span>
                </a>
            </li>

            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" href="{{ route('user_form_data') }}">
                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                    <span class="sidebar-menu-text">Student Data</span>
                </a>
            </li>
        </ul>

    </div>


        @endif
    </div>
</div>
