@extends('admin.main')
@section('content')
    <style>
        @media (min-width:992px) {

            .mdk-drawer-layout .container,
            .mdk-drawer-layout .container-fluid,
            .mdk-drawer-layout .container-lg,
            .mdk-drawer-layout .container-md,
            .mdk-drawer-layout .container-sm,
            .mdk-drawer-layout .container-xl {
                max-width: 1440px;
            }
        }



        #userDataTable_wrapper {
            padding: 10px;
        }

        #userDataTable_info {
            color: #fff;
        }

        div#userDataTable_filter {
            display: flex;
            justify-content: end;
            margin-right: 20px;
        }
    </style>
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Users

                        </li>

                    </ol>

                </div>
            </div>
            <div class="row" role="tablist">
                <div class="col-auto">
                    <!-- <a href="{{ url('/module') }}" class="btn btn-outline-secondary"><i class="fa fa-plus"></i> &nbsp; Add Student</a> -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal"> <i
                            class="fas fa-user-plus"></i> &nbsp; Add User </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->

    <div class="container page__container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Users</div>
        </div>

        @if (Session::has('error_message'))
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
                {{-- <strong>Error ! </strong> --}}
                {{ Session::get('error_message') }}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
        @endif

        @if (Session::has('success_message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                {{-- <strong>Success ! </strong> --}}
                {{ Session::get('success_message') }}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card mb-0">
            <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-employee-name"
                data-lists-values='["js-lists-values-employee-name", "js-lists-values-employer-name", "js-lists-values-projects", "js-lists-values-activity", "js-lists-values-earnings"]'>
                {{-- <div class="card-header">
                    <form class="form-inline">
                        <input type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0" id="inlineFormFilterBy"
                            placeholder="Search ...">
                    </form>
                </div> --}}
                <table class="table mb-0 thead-border-top-0 table-nowrap" id="userDataTable">

                    <thead>
                        <tr>
                            <th>
                                SR No.
                            </th>
                            <th>
                                Full Name
                            </th>

                            <th>
                                Email
                            </th>

                            {{-- <th>
                                Phone
                            </th> --}}

                            <th>
                                Address
                            </th>
                            <th>
                                School
                            </th>
                            <th>
                                Gender
                            </th>
                            <th>
                                User Role
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Designation
                            </th>
                            <th>
                                Created_at
                            </th>
                            <th>
                                Action
                            </th>

                        </tr>
                    </thead>


                    @if (!empty($user))
                        @foreach ($user as $key => $item)
                            <tr>
                                <td>
                                    {{-- {{ $item->id }} --}}
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $item->fullname }}
                                </td>
                                <td>
                                    {{ $item->email }}

                                </td>
                                {{-- <td>
                            {{$item->phone}}
                        </td> --}}
                                <td>
                                    {{ $item->address }}
                                </td>

                                <td>
                                    {{-- @foreach ($School as $sh)
                                        @if ($item->school_id == $sh->id)
                                            {{ $sh->school_name }}
                                        @else
                                        @endif
                                    @endforeach --}}
                                    @php
                                        // Decode JSON if school_id is a JSON string
                                        $schoolIds = is_string($item->school_id)
                                            ? json_decode($item->school_id, true)
                                            : $item->school_id;
                                        // Ensure $schoolIds is an array
                                        $schoolIds = is_array($schoolIds) ? $schoolIds : [$schoolIds];

                                        // Collect school names
                                        $schoolNames = [];
                                        foreach ($School as $sh) {
                                            if (in_array($sh->id, $schoolIds)) {
                                                $schoolNames[] = $sh->school_name;
                                            }
                                        }
                                    @endphp

                                    {{ implode(' | ', $schoolNames) }}


                                </td>
                                <td>
                                    {{ $item->gender }}
                                </td>
                                <td>
                                    @if ($item->role == '1')
                                        Admin
                                    @else
                                        Doctor
                                    @endif
                                    {{-- {{$item->role}} --}}
                                <td>
                                    @if ($item->status == '1')
                                        Active
                                    @else
                                        Deactive
                                    @endif

                                </td>

                                <td>
                                    {{-- @if ($item->designation == 0)
                                        Admin
                                    @else --}}

                                    @if ($item->designation == 1)
                                        Doctor
                                    @elseif ($item->designation == 2)
                                        Nutritionist
                                    @elseif ($item->designation == 3)
                                        Psychologist
                                    @elseif ($item->designation == 4)
                                        Founder and Director
                                    @elseif ($item->designation == 5)
                                        Co Founder And chief Ooperating Officer
                                    @elseif ($item->designation == 6)
                                        Chief Advisor And Business Support Manager
                                    @elseif ($item->designation == 7)
                                        Clinical Operations Lead
                                    @elseif ($item->designation == 8)
                                        Adminstrive Coordinator
                                    @elseif ($item->designation == 9)
                                        Clinical Psychologist
                                    @elseif ($item->designation == 10)
                                        Clinical Nutritionist
                                    @elseif ($item->designation == 11)
                                        School Health Physican (KIRAN FOUNDATION)
                                    @elseif ($item->designation == 12)
                                        School Health Physican (SAVE THE FUTURE)
                                    @elseif ($item->designation == 13)
                                        School Health Physican (THE SET SCHOOL)
                                    @elseif ($item->designation == 14)
                                        School Health Physican (LOCUM)
                                    @else
                                        N/A
                                    @endif

                                </td>
                                </td>

                                <td>
                                    {{ $item->created_at }}
                                </td>
                                <td>
                                    <a href="{{ route('edit_user_form', $item->id) }}"><i class="fa fa-edit iic"></i></a>
                                    {{-- <a href="{{url('user_status')}}/{{$item->id}}/{{$item->status}}"><i class="fa fa-close iic"></i></a>  --}}


                                    @if ($item->status == '1')
                                        <a href="{{ url('user_status') }}/{{ $item->id }}/{{ $item->status }}"> <i
                                                class="fa fa-close iic"></i></a>
                                    @else
                                        <a href="{{ url('user_status') }}/{{ $item->id }}/{{ $item->status }}"> <i
                                                class="fa fa-check iic"></i></a>
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>

            {{-- <div class="card-footer p-8pt">

                <ul class="pagination justify-content-start pagination-xsm m-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true" class="material-icons">chevron_left</span>
                            <span>Prev</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Page 1">
                            <span>1</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Page 2">
                            <span>2</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span>Next</span>
                            <span aria-hidden="true" class="material-icons">chevron_right</span>
                        </a>
                    </li>
                </ul>

            </div> --}}

        </div>

    </div>

    <!-- Add Student Modal  -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel"
        aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form id="adduser" method="post" action="{{Route('admin.user.index')}}" enctype="multipart/form-data" >  --}}
                <form id="CreateForm" method="post" action="{{ Route('admin.user.index') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="fname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    placeholder="e.g Dr. John" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        {{-- <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="School">School</label>
                                <select class="form-control" name="school" id="school">
                                    <option value="">Select</option>
                                    @foreach ($School as $sh)
                                        <option value="{{ $sh->id }}">{{ $sh->school_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="School">School</label>
                                <select class="form-control" name="school[]" id="school" multiple>
                                    <option value="select_all">Select All</option>
                                    @foreach ($School as $sh)
                                        <option value="{{ $sh->id }}">{{ $sh->school_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Age">Age</label>
                                <input type="number" class="form-control" id="age" name="age" name="age"
                                    min="0" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="gender">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">Select</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Doctor</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="text" class="form-control" id="password" name="password"
                                    name="password" required>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="cnic">CNIC#</label>
                                <input type="text" class="form-control" id="cnic" name="cnic">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="cnic">CNIC</label>
                                {{-- .pdf,.doc,.docx,.jpeg,.png,.gif --}}
                                <input type="file" class="form-control" id="cnic_file" name="cnic_file"
                                    accept=".pdf,.doc,.docx,image/*">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="pmdc">PMDC#</label>
                                <input type="text" class="form-control" id="pmdc" name="pmdc">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="pmdc_file">PMDC License</label>
                                <input type="file" class="form-control" id="pmdc_file" name="pmdc_file"
                                    accept=".pdf,.doc,.docx,image/*">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="cv">CV</label>
                                <input type="file" class="form-control" id="cv" name="cv"
                                    accept=".pdf,.doc,.docx,image/*">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="designation">Designation</label>
                            <select name="designation" id="designation" class="form-control" required>
                                <option value="">Select</option>
                                {{-- <option value="0" {{ old('designation') == 0 ? 'selected' : '' }}>Admin</option> --}}
                                <option value="1" {{ old('designation') == 1 ? 'selected' : '' }}>Doctor</option>
                                <option value="2" {{ old('designation') == 2 ? 'selected' : '' }}>Nutritionist
                                </option>
                                <option value="3" {{ old('designation') == 3 ? 'selected' : '' }}>Psychologist
                                </option>

                                <option value="4" {{ old('designation') == 4 ? 'selected' : '' }}>FOUNDER & DIRECTOR</option>
                                <option value="5" {{ old('designation') == 5 ? 'selected' : '' }}>CO FOUNDER & CHIEF OPERATING OFFICER</option>
                                <option value="6" {{ old('designation') == 6 ? 'selected' : '' }}>CHIEF ADVISOR & BUSINESS SUPPORT MANAGER</option>
                                <option value="7" {{ old('designation') == 7 ? 'selected' : '' }}>CLINICAL OPERATIONS LEAD</option>
                                <option value="8" {{ old('designation') == 8 ? 'selected' : '' }}>ADMINISTRATIVE COORDINATOR</option>
                                <option value="9" {{ old('designation') == 9 ? 'selected' : '' }}>CLINICAL PSYCHOLOGIST</option>
                                <option value="10" {{ old('designation') == 10 ? 'selected' : '' }}>CLINICAL NUTRITIONIST</option>
                                <option value="11" {{ old('designation') == 11? 'selected' : '' }}>SCHOOL HEALTH PHYSICIAN (KIRAN FOUNDATION)</option>
                                <option value="12" {{ old('designation') == 12? 'selected' : '' }}>SCHOOL HEALTH PHYSICIAN (SAVE THE FUTURE)</option>
                                <option value="13" {{ old('designation') == 13? 'selected' : '' }}>SCHOOL HEALTH PHYSICIAN (THE SET SCHOOL)</option>
                                <option value="14" {{ old('designation') == 14? 'selected' : '' }}>SCHOOL HEALTH PHYSICIAN (LOCUM) </option>
                                
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary" id="submitStudent" onclick="datapass();"> <i class="fas fa-check"></i>  &nbsp; Submit</button> --}}
                        <button type="submit" class="btn btn-primary" id="submitStudent">
                            <!-- <i class="fas fa-check"></i>
                                &nbsp;  -->
                            Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        datapass = () => {


            var fullname = document.getElementById("fullname").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var address = document.getElementById("address").value;
            var age = document.getElementById("age").value;
            var gender = document.getElementById("gender").value;
            var password = document.getElementById("password").value;
            var role = document.getElementById("role").value;
            var school = document.getElementById("school").value;
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "post",
                url: "{{ url('add_user') }}",
                data: {
                    _token: _token,
                    fullname: fullname,
                    phone: phone,
                    address: address,
                    email: email,
                    age: age,
                    gender: gender,
                    password: password,
                    school: school,
                    role: role

                },
                dataType: "json",
                beforeSend: function() {

                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Success!',
                        text: 'User created successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 1000, // Set the timer to 10 seconds (in milliseconds)
                        timerProgressBar: true, // Show a progress bar during the timer
                        showConfirmButton: false // Hide the "OK" button
                    }).then(() => {
                        location.reload(); // Reload the page when the timer expires
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });

            $('#addStudentModal').modal('hide');
        }
    </script>

    <script>
        $(document).ready(function() {
            var userDataTable = $('#userDataTable').DataTable({
                "pageLength": 10, // Set the default number of entries per page
                // ... Other DataTables configurations ...
                "order": [] // This specifies no default sorting

            });
        });

        function changeEntriesPerPage() {
            var entriesPerPage = document.getElementById("entriesPerPage").value;
            var userDataTable = $('#userDataTable').DataTable();

            // Set the number of entries per page
            userDataTable.page.len(entriesPerPage).draw();
        }
    </script>

    <!-- // END Page Content -->
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            /******************* CreateForm **************************/
            $("#CreateForm").validate({


                rules: {

                    email: {
                        required: true,
                        email: true,
                        remote: "{{ Route('userCheckEmail') }}"

                    }

                },
                messages: {

                    email: {
                        remote: "Email already exist"
                    }

                },

                submitHandler: function(form) {

                    $("#CreateForm button[type='submit']").attr("disabled", true);
                    $("#CreateForm button[type='submit']").html(
                        "<i class='fa fa-refresh fa-spin'></i>&nbsp;Process");

                    form.submit();

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }

            });
        });

        document.getElementById('school').addEventListener('change', function() {
            var select = this;
            var selectAllOption = select.options[0];

            if (selectAllOption.selected) {
                // If "Select All" is selected, select all options
                for (var i = 1; i < select.options.length; i++) {
                    select.options[i].selected = true;
                }
            } else {
                // If any other option is deselected, deselect "Select All"
                for (var i = 1; i < select.options.length; i++) {
                    if (!select.options[i].selected) {
                        selectAllOption.selected = false;
                        break;
                    }
                }
            }

            $('#school').select2();

            // Add "Select All" functionality
            $('#school').on('select2:select', function(e) {
                var selectedValue = e.params.data.id;
                var select = $(this);
                if (selectedValue === 'select_all') {
                    // Select all options
                    var allOptions = select.find('option[value!="select_all"]').map(function() {
                        return $(this).val();
                    }).get();
                    select.val(allOptions).trigger('change');
                }
            });

            $('#school').on('select2:unselect', function(e) {
                var unselectedValue = e.params.data.id;
                var select = $(this);
                if (unselectedValue === 'select_all') {
                    // Deselect all options
                    select.val(null).trigger('change');
                }
            });
        });
    </script>
@endsection
