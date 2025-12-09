@extends('admin.main')
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
                    <!-- <a href="{{ url('/module') }}" class="btn btn-outline-secondary"><i class="fa fa-plus"></i> &nbsp; Add Student</a> -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">  <i class="fas fa-user-plus"></i>Add School </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->

    <div class="container page__container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">School</div>
        </div>
        <div class="card mb-0">
            {{-- <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-employee-name"
                data-lists-values='["js-lists-values-employee-name", "js-lists-values-employer-name", "js-lists-values-projects", "js-lists-values-activity", "js-lists-values-earnings"]'>
                <div class="card-header">
                    <form class="form-inline">
                        <input type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0" id="inlineFormFilterBy"
                            placeholder="Search ...">
                    </form>
                </div>
                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
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
                                City
                            </th>

                            <th>
                                School Representative
                            </th>
                            <th>
                                Contact
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Entry Date
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list" id="staff">

                        <tr>

                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Rakhshinda
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">johar</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">karachi</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">shariq</td>
                            <td class="js-lists-values-earnings small">030033</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Dummy Name
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">123-123-1234</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">Boston</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">03 May, 2023</td>
                            <td class="js-lists-values-earnings small">Paid</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Dummy Name
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">123-123-1234</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">Boston</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">03 May, 2023</td>
                            <td class="js-lists-values-earnings small">Paid</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Dummy Name
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">123-123-1234</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">Boston</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">03 May, 2023</td>
                            <td class="js-lists-values-earnings small">Paid</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Dummy Name
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">123-123-1234</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">Boston</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">03 May, 2023</td>
                            <td class="js-lists-values-earnings small">Paid</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">dummy</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}

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
                            {{-- <input type="text" class="form-control" id="area" name="area" required> --}}
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
                    <button type="button" class="btn btn-danger" id="submitSchool"> <i class="fas fa-check"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>


    <!-- // END Page Content -->
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
                    // d.study_filter = $('#study_filter').val();
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
                // var recruiters = '<select name="recruiters" id="recruiters" class="select2 form-control"></select>';
                // var protocols = '<select name="protocols" id="protocols" class="select2 form-control"></select>';
                // var site = '<select name="site" id="site" class="select2 form-control"></select>';
                // var study = '<select name="study" id="study" class="select2 form-control"></select>';
                // var recruitment_status = '<select name="recruitment_status" id="recruitment_status" class="select2 form-control"></select>';
                // var lead_created = '<input class="form-control" type="date" id="date_filter">';
                var icon = '<div class="form-control-position primary"><i class="la la-search"></i></div>';
                this.api().columns().every(function(column_id) {
                    var column = this;
                    var header = column.header();

                    if ($(header).is('.serial_number')) {
                        $(td).appendTo($(search));
                    }
                    // else if($(header).is('.lead_created')) {
                    //     $(lead_created).appendTo($(search))
                    //         .on('change', function () {
                    //             column.search($(this).val(), true, false, true).draw();
                    //         }).wrap(td);
                    // }
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

        // $('#search').on('click', function() {
        //     table.draw(false);
        // });


    });
</script>
