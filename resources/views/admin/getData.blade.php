@extends('admin.main')
@section('content')
<style>
    @media (min-width:992px) {
    .mdk-drawer-layout .container, .mdk-drawer-layout .container-fluid, .mdk-drawer-layout .container-lg, .mdk-drawer-layout .container-md, .mdk-drawer-layout .container-sm, .mdk-drawer-layout .container-xl {
        max-width: 1440px;
    }
}
.link{
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

.upload_csv form {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

@media (min-width:992px) {
    .mdk-drawer-layout .container, .mdk-drawer-layout .container-fluid, .mdk-drawer-layout .container-lg, .mdk-drawer-layout .container-md, .mdk-drawer-layout .container-sm, .mdk-drawer-layout .container-xl {
        max-width: 1600px!important;
    }
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
            <div class="upload_csv">

                {{-- <form action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="csv_file" accept=".csv">
                    <button type="submit" class="btn btn-primary ml-auto d-block">Upload CSV</button>
                </form> --}}
                <a class="" target="_blank" href="{{ route('export_data') }}"><button class="btn btn-primary ml-auto d-block">Excel</button></a>
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
                            <th>Gardian Name</th>
                            <th>Gender</th>
                            <th>School</th>
                            {{-- <th>City</th>
                            <th>Area</th> --}}
                            <th>Age</th>
                            <th>View By Doctor</th>
                            <th>View By Psychologist</th>
                            <th>View By Nutritionist</th>
                            {{-- <th>Phone</th> --}}
                            <th>Gr No.</th>
                            <th>MR No.</th>
                            {{-- <th>Entered By</th> --}}
                            <th>Duration</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php
                        $s_no = 1;
                        
                    @endphp
                    @if(!empty($form))
                    @foreach ($form as $item )
                    <tr>
                        <td>
                            {{$s_no}}
                            {{-- {{$item->id}} --}}
                        </td>
                        <td>
                           {{-- <a class="link" href="{{url('detail_page')}}/{{$item->id}}">{{$item->name}}</a> --}}
                           {{-- <a class="link" href="{{url('Medical_Detail')}}/{{$item->id}}">{{$item->name}}</a> --}}
                           <a class="link" href="{{route('GeneralInfo')}}/{{$item->id}}" >{{$item->name}}</a>

                        </td>

                        <td>
                            {{$item->lname}}
                        </td>
                        <td>
                            {{$item->gender}}
                        </td>
                        <td>
                            {{$item->school}} - {{$item->enterby}}
                        </td>
                        {{-- <td>
                            {{$item->city}}
                        </td>
                        <td>
                            {{$item->area}}
                        </td> --}}
                        <td>
                            {{$item->age}}
                        </td>
                        <td> 
                            @if ($item->doc_id != null || $item->doc_id !=0)
                            @foreach ($User as $Us)
                                @php
                                    echo ($Us->id == $item->doc_id) ? $Us->fullname : '';
                                @endphp 
                            @endforeach
                        @else
                            None
                        @endif                       
                        </td>
                        <td>
                            @if ($item->psychiatrist_id != null || $item->psychiatrist_id !=0)
                                @foreach ($User as $Us)
                                    @php
                                        echo ($Us->id == $item->psychiatrist_id) ? $Us->fullname : '';
                                    @endphp 
                                @endforeach
                            @else
                                None
                            @endif                                                                              
                        </td>
                        <td>
                            @if ($item->nutritionist_id != null || $item->nutritionist_id !=0)
                                @foreach ($User as $Us)
                                    @php
                                        echo ($Us->id == $item->nutritionist_id) ? $Us->fullname : '';
                                    @endphp 
                                @endforeach
                            @else
                                None
                            @endif                                                                              
                        </td>
                        {{-- <td>
                            {{$item->phone}}
                        </td>--}}
                        <td> 
                            {{$item->grno}}
                        </td>
                      
                        <td>
                            {{\Carbon\Carbon::parse($item->created_at)->year}}{{$item->id}}
                        </td>
                        {{-- <td>
                            {{$item->enterby}}
                        </td> --}}
                        <td>
                        {{str_replace(":"," Min ",$item->duration)}} Sec
                          
                        </td>
                        <td>
                           
                            {{ \Carbon\Carbon::parse($item->created_at)->addHours(5)->toDateTimeString() }}
                        </td>
                        <td>
                            @php
                                 $user = auth()->guard('admin')->user();
                            @endphp                          
                            @if ($item->id >=14 && $user->role == '1')                            
                                <a href="{{ url('/edit_student') }}/{{$item->id}}"><i class="fa fa-edit iic" ></i></a>
                            @elseif($item->id >= 14 && $user->role == '2' && $user->id == auth()->id())
                                <a href="{{ url('/edit_student') }}/{{$item->id}}"><i class="fa fa-edit iic" ></i></a>
                            @else
                                <i class="fa fa-ban iic" aria-hidden="true" ></i>
                            @endif
                        </td>

                    </tr>
                    @php
                        $s_no++;
                    @endphp
                    @endforeach

                    @endif
                </table>
            </div>




        </div>

    </div>

    <script>
         $(document).ready(function () {
            var table = $('#datatable').DataTable({
                "paging": true,
                "lengthMenu": [10, 25, 50, 75, 100],
                "searching": true,
                "info": true,
                "order": [] // This disables default ordering

            });

        // Add search input fields for each column
        $('#datatable thead tr').clone(true).appendTo('#datatable thead');
        $('#datatable thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control form-control-sm search-input" placeholder="Search ' + title + '" />');

            // Remove the default DataTables search behavior
            $('input', this).on('click', function (e) {
                e.stopPropagation(); // Prevent the search input from triggering sorting
            });

            $('input', this).on('input', function () {
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
        $('#clearDateFilter').on('click', function () {
            $('#fromDate').val('');
            $('#toDate').val('');
            table.column(12).search('').draw();
        });

        // Prevent sorting when clicking on the search inputs
        $('#datatable thead .search-input').on('click', function (e) {
            e.stopPropagation();
        });
    });
    </script>




@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

</script>