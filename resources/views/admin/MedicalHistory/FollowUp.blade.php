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
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                           Medical History

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

            {{-- <a class="" href="{{ Route('CreateMedicalHistory') }}"><button class="btn btn-primary">Create</button></a> --}}
            {{-- <a class="" href="{{ Route('StudentBiodata') }}"><button class="btn btn-primary">Create</button></a> --}}
        </div>
        <div class="page-separator">
            <div class="page-separator__text"> Medical History</div>
        </div>
        <!-- Add date filter input fields -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="fromDate"> Medical History</label>
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
                            <th>S.no</th>
                            <th>GrNo</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>



                </table>
            </div>




        </div>

    </div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}



<script>
    $(document).ready(function() {

        var base_url = '{!! Route('FollowUpList') !!}';
        console.log("base_url " + base_url);

        var table = $('#datatable').DataTable({
            // ordering: false,
            // autoWidth: false,

            // responsive: true,
            // processing: true,
            // serverSide: true,
            // ajax: base_url,


            

            responsive: true,
            processing: true,
            serverSide: true,
            paging: true,
            ordering: false,
            searching: true,
            info: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-light"></i><span class="sr-only">Loading...</span>'
            },
            ajax: {
                type: 'get',
                url: base_url,
                dataType: "json",
                data: function(d) {
                    d.startDate = $("#DatatableFilter input[name='startDate']").val();
                 
                }
            },


            columns: [

                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'GRNo',
                    name: 'GRNo'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
               
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                },

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

    
</script>