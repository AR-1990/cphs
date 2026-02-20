@extends('admin.main')
@section('content')
    <style>
        @media (min-width: 992px) {

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

        .ic {
            color: #d86744 !important;
            /* font-weight: 500; */
            height: 20px;
            width: 20px;
            /* font-size: 15px; */

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

                            School

                        </li>

                    </ol>

                </div>
            </div>
            <div class="row" role="tablist">
                <div class="col-auto">
                    <!-- <a href="{{ url('/module') }}" class="btn btn-outline-secondary"><i class="fa fa-plus"></i> &nbsp; Add Student</a> -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal"><i
                            class="fas fa-user-plus"></i>Add School
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->

    <div class="container page__container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">School</div>
        </div>


        @if (Session::has('error_message'))
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
                {{ Session::get('error_message') }}.
               
            </div>
        @endif

        @if (Session::has('success_message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                {{ Session::get('success_message') }}.
             
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
                                School Name
                            </th>

                            <th>
                                Address
                            </th>

                            <th>
                                Area
                            </th>


                            <th>
                                School Representative
                            </th>
                            <th>
                                Email
                            </th>

                            <th>
                                Status
                            </th>
                            <th>
                                Created At
                            </th>
                            <th>
                                Action
                            </th>
                            {{-- <th>
                            Action
                        </th>      --}}
                        </tr>
                    </thead>


                    @foreach ($school as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                {{ $item->school_name }}
                            </td>
                            <td>
                                {{ $item->address }}

                            </td>
                            <td>
                                {{ $item->area }}
                            </td>


                            <td>
                                {{ $item->school_representative }}
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            {{-- <td>
                                @if ($item->status == '1')
                                    Active
                                @else
                                    Deactive
                                @endif

                            </td> --}}

                            <td>
                                @if ($item->status == '1')
                                    <!-- Active Status -->
                                    <span class="badge badge-success">Active</span>
                                @elseif ($item->status == '0')
                                    <!-- Inactive Status -->
                                    <span class="badge badge-danger">Inactive</span>
                                @else
                                    <!-- Pending Status -->
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>


                            <td>
                                {{ \Carbon\Carbon::parse($item->created_at)->addHours(5)->toDateTimeString() }}

                            </td>

                            
                            <td>
                                <a href="{{ url('edit_school_form') }}/{{ $item->id }}"><i
                                        class="fa fa-edit ic"></i></a>


                                @if ($item->status == '1')
                                    <a href="{{ url('school_status') }}/{{ $item->id }}/{{ $item->status }}"> <i
                                            class="fa fa-close ic"></i></a>
                                @else
                                    <a href="{{ url('school_status') }}/{{ $item->id }}/{{ $item->status }}"> <i
                                            class="fa fa-check ic"></i></a>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>

    <!-- Add Student Modal  -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add School</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="adduser">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="School Name">School Name</label>
                                <input type="text" class="form-control" id="school_name" name="school_name" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="email" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Area">Area</label>
                                <input type="text" class="form-control" id="area" name="area" required>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="School Representative">School Representative</label>
                                <input type="text" class="form-control" id="school_representative"
                                    name="school_representative" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        
                        <!-- Health Screening Conducted By -->
                        <div class="form-group col-md-12">
                            <h6 class="mt-2">HEALTH SCREENING CONDUCTED BY</h6>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="health_screening_conducted_by_name">Name</label>
                            <input type="text" class="form-control" id="health_screening_conducted_by_name" name="health_screening_conducted_by_name">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="health_screening_conducted_by_qualification">Qualification</label>
                            <input type="text" class="form-control" id="health_screening_conducted_by_qualification" name="health_screening_conducted_by_qualification" placeholder="e.g., MBBS, MRCP UK">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="health_screening_conducted_by_designation">Designation</label>
                            <input type="text" class="form-control" id="health_screening_conducted_by_designation" name="health_screening_conducted_by_designation">
                        </div>

                        <!-- Rechecked By -->
                        <div class="form-group col-md-12">
                            <h6 class="mt-3">RECHECKED BY</h6>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="rechecked_by_name">Name</label>
                            <input type="text" class="form-control" id="rechecked_by_name" name="rechecked_by_name">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="rechecked_by_qualification">Qualification</label>
                            <input type="text" class="form-control" id="rechecked_by_qualification" name="rechecked_by_qualification">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="rechecked_by_designation">Designation</label>
                            <input type="text" class="form-control" id="rechecked_by_designation" name="rechecked_by_designation">
                        </div>

                        <!-- Psychological Screening Reviewed By -->
                        <div class="form-group col-md-12">
                            <h6 class="mt-3">PSYCHOLOGICAL SCREENING REVIEWED BY</h6>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="psychological_screening_reviewed_by_name">Name</label>
                            <input type="text" class="form-control" id="psychological_screening_reviewed_by_name" name="psychological_screening_reviewed_by_name">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="psychological_screening_reviewed_by_qualification">Qualification</label>
                            <input type="text" class="form-control" id="psychological_screening_reviewed_by_qualification" name="psychological_screening_reviewed_by_qualification">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="psychological_screening_reviewed_by_designation">Designation</label>
                            <input type="text" class="form-control" id="psychological_screening_reviewed_by_designation" name="psychological_screening_reviewed_by_designation">
                        </div>

                        <!-- Nutritional Assessment Reviewed By -->
                        <div class="form-group col-md-12">
                            <h6 class="mt-3">NUTRITIONAL ASSESSMENT REVIEWED BY</h6>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nutritional_assessment_reviewed_by_name">Name</label>
                            <input type="text" class="form-control" id="nutritional_assessment_reviewed_by_name" name="nutritional_assessment_reviewed_by_name">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nutritional_assessment_reviewed_by_qualification">Qualification</label>
                            <input type="text" class="form-control" id="nutritional_assessment_reviewed_by_qualification" name="nutritional_assessment_reviewed_by_qualification">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nutritional_assessment_reviewed_by_designation">Designation</label>
                            <input type="text" class="form-control" id="nutritional_assessment_reviewed_by_designation" name="nutritional_assessment_reviewed_by_designation">
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="logo">School Logo (PNG/JPG)</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/png, image/jpeg">
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group position-relative">
                                <label for="Password">Password</label>
                                <input type="password" class="form-control" id="Password" name="Password" required>
                                <span class="toggle-password position-absolute">
                                    <i class="fas fa-eye "></i>
                                </span>
                            </div>
                        </div>



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitStudent" onclick="datapass();">

                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>






    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Handle form submission
        // $('#submitStudent').on('click', function() {
        //     datapass();
        // });


        datapass = () => {
            let _token = $('meta[name="csrf-token"]').attr('content');
            var formEl = document.getElementById('adduser');
            var formData = new FormData(formEl);
            formData.append('_token', _token);

            var HSCBQual = document.getElementById("health_screening_conducted_by_qualification").value;
            var HSCBDesig = document.getElementById("health_screening_conducted_by_designation").value;

            var RecheckedName = document.getElementById("rechecked_by_name").value;
            var RecheckedQual = document.getElementById("rechecked_by_qualification").value;
            var RecheckedDesig = document.getElementById("rechecked_by_designation").value;

            var PsychoName = document.getElementById("psychological_screening_reviewed_by_name").value;
            var PsychoQual = document.getElementById("psychological_screening_reviewed_by_qualification").value;
            var PsychoDesig = document.getElementById("psychological_screening_reviewed_by_designation").value;

            var NutriName = document.getElementById("nutritional_assessment_reviewed_by_name").value;
            var NutriQual = document.getElementById("nutritional_assessment_reviewed_by_qualification").value;
            var NutriDesig = document.getElementById("nutritional_assessment_reviewed_by_designation").value;

            $.ajax({
                type: "post",
                url: "{{ route('add_school') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            timer: 1000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += value + '<br>';
                    });

                    Swal.fire({
                        title: 'Error!',
                        html: errorMessages,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        timer: 1000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            $('#adduser')[0].reset();
                            location.reload();
                        }
                    });
                }
            });

            $('#addStudentModal').modal('hide');
        }
    </script>

    <script>
        $(document).ready(function() {
            var userDataTable = $('#userDataTable').DataTable({
                "pageLength": 10,    "ordering": false, // Set the default number of entries per page
                // ... Other DataTables configurations ...
            });
        });

        function changeEntriesPerPage() {
            var entriesPerPage = document.getElementById("entriesPerPage").value;
            var userDataTable = $('#userDataTable').DataTable();

            // Set the number of entries per page
            userDataTable.page.len(entriesPerPage).draw();
        }
    </script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .position-relative {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 55% !important;
            cursor: pointer;
            z-index: 10;
            color: black;
            /* Black color for the eye icon */
        }

        .toggle-password i {
            font-size: 20px;
            /* Adjust size if needed */
        }

        .eye-with-cross {
            position: relative;
            display: inline-block;
        }

        .eye-with-cross::before,
        .eye-with-cross::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 2px;
            /* Thickness of the line */
            background-color: black;
            /* Color of the line */
            transform: translate(-50%, -50%);
        }

        .eye-with-cross::before {
            transform: translate(-50%, -50%) rotate(45deg);
            /* Rotate line to form a cross */
            width: 100%;
            /* Adjust width if necessary */
        }

        .eye-with-cross::after {
            transform: translate(-50%, -50%) rotate(-45deg);
            /* Rotate line to form a cross */
            width: 100%;
            /* Adjust width if necessary */
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.toggle-password').on('click', function() {
                const passwordField = $('#Password');
                const eyeIcon = $(this).find('i');

                console.log(passwordField.html());
                console.log(eyeIcon.html());
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                    eyeIcon.removeClass('eye-with-cross');
                } else {
                    passwordField.attr('type', 'password');
                    eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                    eyeIcon.addClass('eye-with-cross');
                }
            });
        });
    </script>
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}


{{-- @extends('admin.main')
@section('content')
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            School

                        </li>

                    </ol>

                </div>
            </div>
            <div class="row" role="tablist">
                <div class="col-auto">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">  <i class="fas fa-user-plus"></i>Add School </button>
                </div>
            </div>
        </div>
    </div>


    <div class="container page__container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">School</div>
        </div>
        <div class="card mb-0">


            <div class="table-responsive">
                <table class="table table-stripped table-bordered datatable" id="datatable" style="z-index:3;width:100%">
                    <thead style="color:black; width:100%!important">
                        <tr role="row" class="bg-primary white">
                            <th>S.no</th>
                            <th>School Name</th>
                            <th>Address</th>
                            <th>Area</th>
                            <th>City</th>
                            <th>School Representative</th>
                            <th>Email </th>
                            <th>Entry Date </th>
                            <th>Status </th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                </table>
            </div>



        </div>

    </div>

    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add School</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                        <div class="form-group">
                            <label for="name">School Name</label>
                            <input type="text" class="form-control" id="school" name="school" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <select class="form-control form-select select2" id="city" name="city">
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">
                                            {{ $city->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="area">Area</label>
                            <select class="form-control form-select select2" id="area" name="area">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sr">School Representative</label>
                            <input type="text" class="form-control" id="sr" name="sr" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitSchool"> <i class="fas fa-check"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>



@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        var table = $('#datatable').DataTable({
            dom: '<"d-inline-block"l><"pull-right"B>tipr',
            buttons: [
                {
                    extend: 'excel',
                    title: 'School Details',
                    text: '<i class="la la-file-excel-o"></i> Excel',
                    className: 'btn btn-primary',
                }
            ],
            scrollX: true,
            autoWidth: false,
            lengthMenu: [[10, 50, 100, 500, 1000, -1], [10, 50, 100, 500, 1000, 'All']],
            pageLength: 10,
            pagingType: 'full_numbers',
            processing: true,
            serverSide: true,
            deferLoading: 1,
            ajax: {
                url: '{{ route('admin.school.list')}}',
                data: function (d) {

                },
            },
            rowId: 'id',
            order: [[1, 'desc']],
            columns: [
                {data: 'serial_number', orderable: false, searchable: false, name: 'serial_number', class: 'align-middle serial_number', targets: 0, render: function (data, type, row) {return '';}},
                {data: 'school_name', name: 'school_name', class: 'align-middle school_name'},
                {data: 'address', name: 'address', class: 'align-middle address'},
                {data: 'area', name: 'area', class: 'align-middle area'},
                {data: 'city', name: 'city', class: 'align-middle city'},
                {data: 'school_representative', name: 'school_representative', class: 'align-middle school_representative'},
                {data: 'email', name: 'email', class: 'text-center align-middle email'},
                {data: 'entry_date', name: 'entry_date', class: 'text-center align-middle entry_date'},
                {data: 'status', name: 'status', class: 'align-middle status'},
                {data: 'created_by', name: 'created_by', class: 'text-center align-middle created_by'},
                {data: 'updated_by', name: 'updated_by', class: 'text-center align-middle updated_by'},
                {data: 'created_at', name: 'created_at', class: 'text-center align-middle created_at'},
                {data: 'updated_at', name: 'updated_at', class: 'text-center align-middle updated_at'}
            ],
            rowCallback: function(row, data, index) {

                var info = table.page.info();
                $('td:eq(0)', row).html(index + 1 + info.page * info.length);
            },
            initComplete: function() {
                var search = $('<tr role="row" class="bg-primary search"></tr>').appendTo(this.api().table().header());
                var td = '<td style="padding:5px;"><fieldset class="form-group m-0 position-relative has-icon-right"></fieldset></td>';
                var input = '<input type="text" class="form-control form-control-sm input-sm primary">';
                var source_from = '<select name="source_from" id="source_from" class="select2 form-control"></select>';

                var icon = '<div class="form-control-position primary"><i class="la la-search"></i></div>';
                this.api().columns().every(function(column_id) {
                    var column = this;
                    var header = column.header();

                    if ($(header).is('.serial_number')) {
                        $(td).appendTo($(search));
                    }

                    else {
                        var current = $(input).appendTo($(search)).on('change', function() {
                            column.search($(this).val(), false, false, true).draw();
                        }).wrap(td).after(icon);

                        if (column.search()) {
                            current.val(column.search());
                        }
                    }
                });

                this.api().table().columns.adjust();
            }
        });

        table.draw(false);

        $("#city").on("change", function(e) {
            console.log($(this).val());
            $.ajax({
                type: "post",
                url: "{{ route('admin.getAreasByCity') }}",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    city_id : $(this).val(),
                },
                dataType: "json",
                beforeSend: function() {},
                success: function(response) {

                    console.log(response);
                }
            });

        })



    });
</script> --}}
