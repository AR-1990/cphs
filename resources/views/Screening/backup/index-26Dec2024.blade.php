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

        .link {
            color: white !important;
            border-bottom: 1px solid rgb(247, 190, 3);
        }

      

        #datatable_wrapper {
            padding: 10px;
        }

        div#datatable_info {
            color: #fff;
        }

        div#datatable_filter {
            display: flex;
            justify-content: end;
            margin-right: 20px;
        }

        .d_performance {
            display: flex;
            align-items: center;
            justify-content: end;
            gap: 20px;
            flex-wrap: wrap;
        }

        .d_performance form {
            display: flex;
            align-items: center;
            justify-content: end;
            gap: 20px;
            flex-wrap: wrap;
            margin: 0;
        }

        .swal2-modal {
            pointer-events: auto !important;
        }

        div:where(.swal2-icon) .swal2-icon-content {
            font-size: 1em !important;
        }

        .swal2-actions {
            gap: 10px
        }

        .dt-button.buttons-csv.buttons-html5 {
            display: none;
        }

        #datatable_length {
            float: left;
        }
     
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Screening

                        </li>

                    </ol>

                </div>
            </div>
            {{-- <div class="row" role="tablist">
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">  <i class="fas fa-user-plus"></i>Add School </button>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Page Content -->

    <div class="container page__container page__container page-section">

        @if (Session::has('error_message'))
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
                {{-- <strong>Error ! </strong> --}}
                {{ Session::get('error_message') }}.
                {{-- <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                                    data-bs-original-title="" title=""></button> --}}
            </div>
        @endif

        @if (Session::has('success_message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                {{-- <strong>Success ! </strong> --}}
                {{ Session::get('success_message') }}.
                {{-- <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                                    data-bs-original-title="" title=""></button> --}}
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

        <div class="d_performance">
            <button class="btn btn-primary" id="exportCSVBtn">Export CSV</button>
            {{-- <a class="" href="{{ Route('CreateMedicalHistory') }}"><button class="btn btn-primary">Create</button></a> --}}
            <a class="" href="{{ Route('BioData') }}"><button class="btn btn-primary">Create</button></a>
        </div>
        <div class="page-separator">
            <div class="page-separator__text"> Screening</div>
        </div>
        <!-- Add date filter input fields -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="fromDate"> Screening</label>
                {{-- <input type="date" id="fromDate" class="form-control"> --}}
            </div>
            <div class="col-md-3">
                {{-- <label for="toDate">To Date:</label>
                <input type="date" id="toDate" class="form-control"> --}}
            </div>
            <div class="col-md-">
                {{-- <button class="btn btn-primary mt-4" id="applyDateFilter">Apply Filter</button> --}}
            </div>
            <div class="col-md-2">
                {{-- <button class="btn btn-secondary mt-4" id="clearDateFilter">Clear Filter</button> --}}
            </div>
        </div>

        <div class="card mb-0">

            <div class="table-responsive">
                <table class="table table-stripped table-bordered datatable" id="datatable" style="z-index:3;width:100%">
                    <thead style="color:black; width:100%!important">
                        <tr role="row" class="bg-primary white">



                            {{-- Student Biodata --}}
                            <th>S.no</th>
                            <th>GR#</th>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Action</th>

                        </tr>
                    </thead>



                </table>
            </div>




        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}




    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {

            var base_url = '{!! Route('ListMedicalHistory') !!}';
            var schoolId = new URLSearchParams(window.location.search).get('schoolId');
            console.log("schoolId " + schoolId);
            var MedicalHistoryType = new URLSearchParams(window.location.search).get('MedicalHistoryType');
            console.log("MedicalHistoryType " + MedicalHistoryType);

            var table = $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: true,
                ordering: false,
                searching: true,
                info: false,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ], // Custom length menu options
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-light"></i><span class="sr-only">Loading...</span>'
                },
                ajax: {
                    type: 'POST',
                    url: base_url,
                    dataType: "json",
                    data: function(d) {
                        d.startDate = $("#DatatableFilter input[name='startDate']").val();
                        if (schoolId) {
                            d.schoolId = schoolId;
                        }
                        if (MedicalHistoryType) {
                            d.MedicalHistoryType = MedicalHistoryType;
                        }
                    }
                },


                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },

                    /* Student Biodata  */
                    {
                        data: 'GRNo',
                        name: 'GRNo'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'dob',
                        name: 'dob',
                        visible: false
                    },
                    
                    
                    // {
                    //     data: 'psychologist_history_assessment_sections',
                    //     name: 'psychologist_history_assessment_sections',
                    //     render: function(data, type, row) {

                    //         if (data != null) {

                    //             return data.Reason_for_Referral2;

                    //         } else {
                    //             return '';
                    //         }
                    //     },
                    //     visible: false
                    // },

                    {
                        data: 'action',
                        name: 'action',
                        searchable: false
                    },

                ],

                dom: "B<'clear'>lfrtip", // Add the 'l' to show the length menu
                buttons: [{
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        title: 'Screening',
                        exportOptions: {
                            columns: ':visible,  :hidden' // Export only visible columns
                        }

                        // exportOptions: {
                        //     columns: ':visible:not(:last-child)' // Export only visible columns except the last one
                        // }
                    }

                ]
            });



            /*Confirm Delete for All*/
            $(document).on("click", ".confirmDeleteIt", function() {

                var deleteId = $(this).attr('data-id');
                var URL = $(this).attr('data-url');

                console.log("URL " + URL);
                console.log("deleteId " + deleteId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        var base_url = URL;
                        console.log("base_url " + base_url);

                        $.ajax({
                            url: base_url,
                            type: "post",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                deleteId: deleteId
                            },
                            dataType: 'json',
                            success: function(resp) {

                                console.log("resp id " + resp.id);
                                console.log("resp " + resp);
                                console.log("resp length " + resp.length);
                                console.log("resp " + JSON.stringify(resp));
                                if (resp['status'] === true) {

                                    Swal.fire({
                                        position: 'center',
                                        // position: 'top-end',
                                        icon: 'success',
                                        title: resp['message'],
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(function() {

                                        table.clear().draw(false);


                                        // location.reload();

                                    });


                                } else {
                                    Swal.fire({
                                        position: 'center',
                                        // position: 'top-end',
                                        icon: 'error',
                                        title: resp['message'],
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(function() {

                                        location.reload();

                                    });
                                }

                                // table.clear().draw();
                                // table.clear().draw(false);


                            }
                        });

                    }
                })


            });


            /*******************DatatableFilter **************************/
            $("#DatatableFilter").validate({
                submitHandler: function(form) {
                    $("#DatatableFilter button[type='submit']").attr("disabled", true);
                    $("#DatatableFilter button[type='submit']").html(
                        "<i class='fa fa-refresh fa-spin'></i>&nbsp;Process");
                    table.clear().draw(false);
                    $("#DatatableFilter button[type='submit']").delay(3000).attr("disabled", false);
                    $("#DatatableFilter button[type='submit']").delay(3000).html("Apply");
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



            // var table = $('#datatable').DataTable({
            //     "paging": true,
            //     "lengthMenu": [5, 10, 25, 50, 75, 100],
            //     "searching": true,
            //     "info": true
            // });

            // // Add search input fields for each column
            // $('#datatable thead tr').clone(true).appendTo('#datatable thead');
            // $('#datatable thead tr:eq(1) th').each(function(i) {
            //     var title = $(this).text();
            //     $(this).html(
            //         '<input type="text" class="form-control form-control-sm search-input" placeholder="Search ' +
            //         title + '" />');

            //     // Remove the default DataTables search behavior
            //     $('input', this).on('click', function(e) {
            //         e.stopPropagation(); // Prevent the search input from triggering sorting
            //     });

            //     $('input', this).on('input', function() {
            //         table.column(i).search(this.value).draw();
            //     });
            // });

            // // Function to apply date filter
            // function applyDateFilter() {
            //     var fromDate = $('#fromDate').val();
            //     var toDate = $('#toDate').val();

            //     // Update DataTable search with date range
            //     table.column(12).search(fromDate + ' to ' + toDate).draw();
            // }

            // // Date filter on button click
            // $('#applyDateFilter').on('click', applyDateFilter);

            // // Clear date filter on button click
            // $('#clearDateFilter').on('click', function() {
            //     $('#fromDate').val('');
            //     $('#toDate').val('');
            //     table.column(12).search('').draw();
            // });

            // // Prevent sorting when clicking on the search inputs
            // $('#datatable thead .search-input').on('click', function(e) {
            //     e.stopPropagation();
            // });
        });

        document.getElementById("exportCSVBtn").addEventListener("click", function() {
            document.querySelector(".dt-button.buttons-csv.buttons-html5").click()
        });
    </script>


@endsection
