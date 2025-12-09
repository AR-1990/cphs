@php

    use App\Models\StudentBiodata;

    $UserID = auth()->guard('admin')->user()->id;
    $UserRole = auth()->guard('admin')->user()->role;

@endphp

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
    </style>
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Doctor Performance

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
        <div class="d_performance">

            <form action="{{ route('admin.doctorperformance.Filter_doc_performance') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="startDate" class="form-label">Start Date:</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>
                <div class="mb-3">
                    <label for="endDate" class="form-label">End Date:</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            {{-- <a class="" href="{{ url('/export_data') }}"><button class="btn btn-primary">Excel</button></a> --}}
        </div>
        <div class="page-separator">
            <div class="page-separator__text">Doctor Performance</div>
        </div>
        <!-- Add date filter input fields -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="fromDate">Doctor Performance:</label>
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
                            <th>Doctor Name</th>
                            <th>Designation</th>
                            <th>No of Forms</th>
                            <th>Medical History</th>
                            <th>Screening Forms Reviewed </th>
                            {{-- <th>Gender</th>
                            <th>School</th>
                            <th>City</th>
                            <th>Area</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Gr No.</th> --}}
                            {{-- <th>Enter By</th> --}}
                            {{-- <th>Duration</th> --}}
                            {{-- <th>Created At</th> --}}
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    @if (!empty($data))
                        @foreach ($data as $key => $item)

                            @php


                                $StudentBiodataCount = StudentBiodata::where('deleted', 0)
                                    ->where(function ($query) use ($item) {
                                        $query->where('created_by', $item->UserID)->orWhere('updated_by', $item->UserID);
                                    })
                                    ->count();

                            @endphp

                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $item->fullname }}
                                </td>
                                <td>
                                        @if(!empty($item->designation) && $item->designation == 1)

                                            Doctor
                                        @elseif(!empty($item->designation) && $item->designation == 2)

                                        Nutritionist
                                        
                                        @elseif(!empty($item->designation) && $item->designation == 3)

                                        Psychologist

                                        @else

                                        N/A

                                        @endif

                                </td>
                                <td>
                                    {{ $item->count }}
                                </td>
                               
                                <td>
                                    {{$StudentBiodataCount}}
                                </td>
                                <td>
                                    {{ $item->scan_count }}
                                </td>

                            </tr>
                        @endforeach
                    @endif


                </table>
            </div>




        </div>

    </div>

    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                "paging": true,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "searching": true,
                "info": true
            });

            // Add search input fields for each column
            $('#datatable thead tr').clone(true).appendTo('#datatable thead');
            $('#datatable thead tr:eq(1) th').each(function(i) {
                var title = $(this).text();
                $(this).html(
                    '<input type="text" class="form-control form-control-sm search-input" placeholder="Search ' +
                    title + '" />');

                // Remove the default DataTables search behavior
                $('input', this).on('click', function(e) {
                    e.stopPropagation(); // Prevent the search input from triggering sorting
                });

                $('input', this).on('input', function() {
                    table.column(i).search(this.value).draw();
                });
            });

            // Function to apply date filter
            function applyDateFilter() {
                var fromDate = $('#fromDate').val();
                var toDate = $('#toDate').val();

                // Update DataTable search with date range
                table.column(12).search(fromDate + ' to ' + toDate).draw();
            }

            // Date filter on button click
            $('#applyDateFilter').on('click', applyDateFilter);

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
