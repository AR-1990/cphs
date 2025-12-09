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
                    <h2 class="mb-0"> Trainings</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Trainings

                        </li>

                    </ol>

                </div>
            </div>
            <div class="row" role="tablist">
                <div class="col-auto">
                    <!-- <a href="{{ url('/module') }}" class="btn btn-outline-secondary"><i class="fa fa-plus"></i> &nbsp; Add Student</a> -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal"><i
                            class="fas fa-user-plus"></i>Add Training
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->

    <div class="container page__container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Training</div>
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
                                SYSTEM #.
                            </th>
                            <th>
                                Topic
                            </th>

                            <th>
                                location
                            </th>

                            <th>
                            Attendees Count
                            </th>
                            <th>
                            Taken By
                            </th>

                            <th>
                                Description
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Action
                            </th>
                            {{-- <th>
                            Action
                        </th>      --}}
                        </tr>
                    </thead>


                    @foreach ($training as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                {{ $item->title }}
                            </td>
                            <td>
                                {{ $item->location }}

                            </td>
                            <td>
                                {{ $item->audiance_count }}
                            </td>


                            <td>
                                {{ $item->taken_by }}
                            </td>
                            <td>
                                {{ $item->descriptions }}
                            </td>
                            

                           


                            <td>
                            {{ \Carbon\Carbon::parse($item->created_at)->toFormattedDateString() }}


                            </td>

                            
                            <td>
                            <a href="javascript:void(0);" class="edit-btn" data-id="{{ $item->id }}"
                                data-topic="{{ $item->title }}"
                                data-taken_by="{{ $item->taken_by }}"
                                data-location="{{ $item->location }}"
                                data-audiance_count="{{ $item->audiance_count }}"
                                data-description="{{ $item->descriptions }}"
                                data-date="{{ \Carbon\Carbon::parse($item->created_at)->toDateString() }}">
                                    <i class="fa fa-edit ic"></i>
                                </a>


                             
                                   
                              

                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit Form -->
                <form id="editForm">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="form-group">
                        <label for="edit_topic">Topic</label>
                        <input type="text" class="form-control" id="edit_topic" name="topic" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_taken_by">Taken By</label>
                        <!-- <input type="text" class="form-control" id="edit_taken_by" name="taken_by" required> -->
                        <select class="form-control" id="edit_taken_by" name="taken_by" >
                        <option value="">Select</option>
            @foreach($user as $item)
            <option value="{{$item->fullname}}">{{$item->fullname}}</option>
            @endforeach
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_audiance_count">Attendees Count</label>
                        <input type="number" class="form-control" id="edit_audiance_count" name="audiance_count" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_location">Location</label>
                        <input type="text" class="form-control" id="edit_location" name="location" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_date">Date</label>
                        <input type="date" class="form-control" id="edit_date" name="date" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <!-- <textarea class="form-control" id="edit_description" name="description" rows="4" required></textarea> -->
                        <select name="description" id="edit_description" class="form-control" required>
                            <option value="">Select</option>
                            <option value="pre primary students session">pre primary students session</option>
                            <option value="primary students sessions">primary students sessions</option>
                            <option value="secondary students session">secondary students session</option>
                            <option value="pre-primary teachers training session">pre-primary teachers training session</option>
                            <option value="primary teachers training session">primary teachers training session</option>
                            <option value="secondary teachers training session">secondary teachers training session</option>
                            <option value="all teachers training session">all teachers training session</option>
                            <option value="parental session">parental session</option>
                        </select>
    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Add Student Modal  -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Trainings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <!-- Your form -->
<form id="adduser">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group col-md-12">
        <label for="topic">Topic</label>
        <input type="text" class="form-control" id="topic" name="topic" required>
    </div>

    <div class="form-group col-md-12">
        <label for="taken_by">Taken By</label>
        <select class="form-control form-select" name="taken_by" id="taken_by" required>
            <option value="">Select</option>
            @foreach($user as $item)
            <option value="{{$item->fullname}}">{{$item->fullname}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-12">
        <label for="attendees_count">Attendees Count</label>
        <input type="number" class="form-control" id="attendees_count" name="attendees_count" required>
    </div>

    <div class="form-group col-md-12">
        <label for="locations">Location</label>
        <input type="text" class="form-control" id="locations" name="locations" required>
    </div>

    <div class="form-group col-md-12">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>

    <div class="form-group col-md-12">
        <label for="description">Description</label>
        <!-- <textarea class="form-control" rows="8" name="description" id="description" required></textarea> -->
         <select name="description" id="description" class="form-control" required>
            <option value="">Select</option>
            <option value="pre primary students session">pre primary students session</option>
            <option value="primary students sessions">primary students sessions</option>
            <option value="secondary students session">secondary students session</option>
            <option value="pre-primary teachers training session">pre-primary teachers training session</option>
            <option value="primary teachers training session">primary teachers training session</option>
            <option value="secondary teachers training session">secondary teachers training session</option>
            <option value="all teachers training session">all teachers training session</option>
            <option value="parental session">parental session</option>
         </select>
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

        $(document).on('click', '.edit-btn', function() {
    var id = $(this).data('id');
    var topic = $(this).data('topic');
    var taken_by = $(this).data('taken_by');
    var location = $(this).data('location');
    var audiance_count = $(this).data('audiance_count');
    var description = $(this).data('description');
    var date = $(this).data('date');

    // Set the values in the modal form
    $('#edit_id').val(id);
    $('#edit_topic').val(topic);
    $('#edit_taken_by').val(taken_by);
    $('#edit_location').val(location);
    $('#edit_audiance_count').val(audiance_count);
    $('#edit_description option').each(function() {
        if ($(this).val().trim() === description.trim()) {
            $(this).prop('selected', true);
        }
    });
    $('#edit_date').val(date);

    // Show the modal
    $('#editModal').modal('show');
});
$('#editForm').on('submit', function(e) {
    e.preventDefault();
    var formData = $(this).serialize(); // Serialize the form data
    // alert(formData);

    $.ajax({
        type: "POST",
        url: "{{ route('update_training') }}", // Your update route here
        data: formData,
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
                    // Hide modal and reload data if necessary
                    $('#editModal').modal('hide');
                    location.reload(); // Or update the table row dynamically if preferred
                });
            }
        },
        error: function(xhr) {
            var errors = xhr.responseJSON.errors;
            var errorMessages = '';
            $.each(errors, function(key, value) {
                errorMessages += value + '<br>';
            });

            Swal.fire({
                title: 'Error!',
                html: errorMessages,
                icon: 'error',
                confirmButtonText: 'OK',
            });
        }
    });
});

        datapass = () => {
    var topic = document.getElementById("topic").value;
    var taken_by = document.getElementById("taken_by").value;
    var attendees_count = document.getElementById("attendees_count").value;
    var date = document.getElementById("date").value;
    var description = document.getElementById("description").value;
    var locations = document.getElementById("locations").value;
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: "POST",
        url: "{{ route('add_Training') }}",
        data: {
            _token: _token,
            topic: topic,
            taken_by: taken_by,
            locations: locations,
            attendees_count: attendees_count,
            date: date,
            description: description,
        },
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
                    $('#addStudentModal').modal('hide'); // Close modal after success
                    location.reload(); // Reload the page when the timer expires
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
                    $('#adduser')[0].reset(); // Reset the form
                    $('#addStudentModal').modal('hide'); // Hide modal on error
                }
            });
        }
    });
};

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
