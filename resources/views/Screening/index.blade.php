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
            color: #59595c !important;
            font-weight: 700;
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

        .upload_csv {
            display: flex;
            gap: 20px;
            justify-content: end;
        }

        /* .upload_csv form {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        } */

        .date_flex {
            width: 600px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .date_flex .btn.btn-primary {
            min-width: 230px;
        }

        @media (min-width:992px) {

            .mdk-drawer-layout .container,
            .mdk-drawer-layout .container-fluid,
            .mdk-drawer-layout .container-lg,
            .mdk-drawer-layout .container-md,
            .mdk-drawer-layout .container-sm,
            .mdk-drawer-layout .container-xl {
                max-width: 1600px !important;
            }
        }

        /* Custom CSS for DataTable info text */
        .dataTables_info {
            color: black !important;
            /* Change the color to black */
        }


        .upload_csv {
            display: flex !important;
            justify-content: flex-end !important;
            /* Aligns buttons to the right */
            margin-bottom: 1rem !important;
            /* Adds space below the buttons */
        }

        .upload_csv .btn {
            margin-right: 0.5rem !important;
            /* Space between buttons */
        }

        .upload_csv .btn:last-child {
            margin-right: 0 !important;
            /* Removes margin from the last button */
        }

            /* Hide the filter input for Follow Up column */
       /*.btn:last-child th input[placeholder="Search Follow Up"] {
            display: none !important;
        }*/

    </style>
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            From Entry Data

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




    <div class="container-fluid page__container page__container page-section" style="max-width: 100% !important;">


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

        
        <div class="upload_csv d-flex justify-content-end align-items-center mb-3">
            
        @if (auth()->guard('admin')->user()->role == 1 || auth()->guard('admin')->user()->role == 2)
                <form id="exportForm" method="POST" action="{{ route('csv') }}" class="mb-0">
                    @csrf
                    <div class="date_flex">
                        <input type="date" id="start" name="start" class="form-control"/>
                        <input type="date" id="end" name="end" class="form-control"/>
                        <button type="submit" class="btn btn-primary mr-2">
                            Screened Outcome
                        </button>
                    </div>
                </form>
            @endif
<button type="button" id="dateSearchBtn" class="btn btn-primary mr-2">
                           Search
                         </button>
                {{-- <a class="" href="{{ Route('admin.form_entry.getformData1') }}?Follow_up_Date_flag=1">
                    <button class="btn btn-primary">Schedule Follow-up</button>
                </a> --}}

                {{-- <a class="" href="{{ Route('admin.form_entry.getformData1') }}?Follow_up_Date_flag=0">
                    <button class="btn btn-primary">Unscheduled Follow-up</button>
                </a> --}}

                <a class="" target="_blank" href="{{ Route('Screening') }}?Follow_up_Date_flag=0">
                    <button class="btn btn-primary">Unscheduled Follow-up</button>
                </a>
               

            <a class="btn btn-primary" href="{{ Route('CreateScreening') }}">
                Create
            </a>
        </div>

        <div class="page-separator">
            <div class="page-separator__text">From Entry Data</div>
        </div>
        <!-- Add date filter input fields -->
        {{-- <div class="row mb-3">
            <div class="col-md-3">
                <label for="fromDate">From Date:</label>
                <input type="date" id="fromDate" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="toDate">To Date:</label>
                <input type="date" id="toDate" class="form-control">
            </div>
            <div class="col-md-">
                <button class="btn btn-primary mt-4" id="applyDateFilter">Apply Filter</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary mt-4" id="clearDateFilter">Clear Filter</button>
            </div>
        </div> --}}

        <div class="card mb-0">

            <div class="table-responsive">
                <table class="table table-stripped table-bordered datatable" id="datatable" style="z-index:3;width:100%">
                    <thead style="color:black; width:100%!important">
                        <tr role="row" class="bg-primary white">
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Guardian Name</th>
                           
                            <th>School</th>
                          
                            <th>View By Doctor</th>
                       
                            <th>MR No.</th>
                            <th>Gr No.</th>
                            <th>Duration</th>
                 
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                </table>
            </div>




        </div>

    </div>

    <script>
        $(document).ready(function() {

            var Follow_up_Date_flag = new URLSearchParams(window.location.search).get('Follow_up_Date_flag');
            console.log("Follow_up_Date_flag " + Follow_up_Date_flag);

            

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    // url: "{{ route('admin.form_entry.getformData1List') }}",
                    url: "{{ route('ScreeningList') }}",
                    data: function(d) {
                        d.schoolId = $('#schoolId').val(); // Pass additional parameters if needed
                        d.fromDate = $('#start').val();
                        d.toDate = $('#end').val();
                        
                        if (Follow_up_Date_flag) {
                            d.Follow_up_Date_flag = Follow_up_Date_flag;
                        }

                    }
                },
                paging: true,
                lengthMenu: [10, 25, 50, 75, 100],
                searching: true,
                info: true,
                order: [], // This disables default ordering
                columns: [

                    {
                        data: null, // Not directly mapping to a data field
                        name: 'serial_number',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            // Calculate serial number based on the page and page length
                            return meta.settings._iDisplayStart + meta.row + 1;
                        }
                    },

                  
                    {
                        data: 'name',
                        name: 'form_entries.name'
                    },
                    {
                        data: 'lname',
                        name: 'form_entries.lname'
                    },


                  

                    {
                        data: 'school',
                        name: 'schools.school_name'
                    },


                   
                    {
                        data: 'doctor_name', // New column for doctor's name
                        name: 'docs.fullname'
                    },
                 

                    {
                       data: 'mrr',
                        name: 'mrr'
                    },
                    {
                        data: 'grno',
                        name: 'form_entries.grno'
                    },
                   
                 


                    {
                        data: 'duration',
                        name: 'form_entries.duration'
                    },
                    
                  

                    {
                        data: 'enterby',
                        name: 'users.fullname'
                    },
                    {
                        data: 'created_at',
                        name: 'form_entries.created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    } // Action column

                ],
                language: {
                    info: "Showing _START_ to _END_ of _TOTAL_ entries", // Customize the text here
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                }
            });;


            // Add search input fields for each column
            $('#datatable thead tr').clone(true).appendTo('#datatable thead');
            
         

            $('#datatable thead tr:eq(1) th').each(function(i) {
            var title = $(this).text().trim(); // Get the column header text and trim any whitespace

            // Check if this is the "Follow Up" column
            if (title === 'Follow Up') {
                console.log("Adding dropdown filter for: " + title);

                // Add a dropdown filter for Follow_up_Date_flag
                $(this).html(`
                    <select class="form-control form-control-sm search-input">
                        <option value="">All</option>
                        <option value="0">Un Schedule</option>
                        <option value="1">Schedule</option>
                        <option value="2">No</option>
                    </select>
                `);

                // Filter table when the dropdown value changes
                $('select', this).on('change', function() {

                    console.log('this.value ',this.value);

                    // table.column(i).search(this.value).draw(); // Apply filtering to the correct column


                    let value = this.value;
                    console.log("value ", value);

                    // If "N/A" is selected, pass null (empty string) for filtering
                    if (value === 'N/A') {
                        value = ''; // Use empty string to represent null values in filtering
                    }

                    console.log("value ", value);


                    // Apply filtering to the correct column (Follow Up column)
                    table.column(i).search(value).draw();

                    
                });
            } else {
                // Add input filters for other columns
                $(this).html(
                    '<input type="text" class="form-control form-control-sm search-input" placeholder="Search ' +
                        title +
                        '" />'
                );

                // Apply text-based filter
                $('input', this).on('input', function() {
                    table.column(i).search(this.value).draw(); // Apply filtering to the correct column
                });
            }
        });






            // Function to apply date filter
            function applyDateFilter() {
                var fromDate = $('#fromDate').val();
                var toDate = $('#toDate').val();

                // Update DataTable search with date range
                table.column(12).search(fromDate + ' to ' + toDate).draw();
            }

            // Date filter on Search button click
            $('#dateSearchBtn').on('click', function(){
                table.ajax.reload();
            });

            // Clear date filter on button click
            $('#clearDateFilter').on('click', function() {
                $('#fromDate').val('');
                $('#toDate').val('');
                table.column(12).search('').draw();
            });

            // Prevent sorting when clicking on the search inputs
            $('#datatable thead .search-input').on('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script></script>
