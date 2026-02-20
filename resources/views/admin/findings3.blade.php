@extends('admin.main')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Include Yajra Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <!-- Include Bootstrap JS (for modal functionality) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

        .custom_card_btn {
            width: 100%;
            text-align: center;
        }


        .custom_card_btn .btn {
            background: #ffffff;
            color: #000;
            width: 100%;
            border-radius: 20px;
            padding: 20px 20px;
            font-size: 24px;
            margin: 0;
            font-weight: 700;
            gap: 0px;
            transition: 0.3s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, .15);
        }

        .custom_card_btn .btn:hover {
            background: #d86744 !important;
        }

        .custom_card_btn .btn b {
            font-size: 36px;
            margin-top: -10px;
            padding: 0;
            color: #000;
        }

        .custom_card_btn .btn svg {
            color: #d86744;
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .custom_card_btn .btn:hover svg {
            color: #fff;
        }

        .custom_card_btn .btn:hover b {
            color: #fff;
        }

        .graph {
            padding: 20px;
        }

        .h1 {
            text-align: center;
        }

        .chartDivRow {
            display: flex;
            align-items: center;
            justify-content: start;
            flex-wrap: wrap;
            gap: 10px;
        }

        .chartDivOuter {
            height: 350px;
            border-radius: 5px;
            border: 1px solid rgba(0, 0, 0, .15);
            width: calc(50% - 10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .chartdiv {
            width: 100%;
            height: 100%;
        }

        #daterange {
            width: 200px;
            margin-left: auto;
            margin-bottom: 10px;
            margin-right: 10px;
        }

        .table tbody td button.counts {
            border: 1px solid #d86744;
            background: none;
            min-width: 25px;
            min-height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            color: #d86744;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 5px;
            font-weight: 700;
        }

        .table tbody td button.counts:hover {
            background: #d86744;
            color: #fff;
        }
        .card {
            padding: 20px;
        }
        #questions-table_filter label {
            text-align: start;
        }
        #questions-table_filter input {
            margin-left : 0;
        }
        .card td {
            font-weight: 700;
        }
    </style>

    <div class="pt-32pt">
        <div class="container page__container page-section">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="page-separator">
            <div class="page-separator__text">Findings</div>
        </div>

        <div class="card mb-0">
            <div class="table-responsive">
                <table class="table mb-0 thead-border-top-0 table-nowrap" id="questions-table">
                    <thead>
                        <tr>
                            <th>SR No.</th>
                            <th>Findings</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel">Data for Findings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>System Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $('#questions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('questions-data') }}",
                columns: [
                    {
                        data: 'entryId',
                        name: 'entryId'
                    },
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    
                    {
                        data: 'label',
                        name: 'label',
                        
                    },

                    {
                        data: 'count',
                        name: 'count',
                        render: function(data, type, row) {

                            return `<button class='counts btn btn-primary'  data-question='${row.question}' data-question_key='${row.question_key}' ,data-id='${row.id}'>${data}</button>`;
                        }
                    }
                ]
            });
            // Handle button click to show modal with findings
            $(document).on('click', '.counts', function() {
                var question = $(this).data('question');
                var question_key = $(this).data('question_key');
                console.log(question_key);
                


                $('#dataModal').modal('show');

                if ($.fn.DataTable.isDataTable('#datatable')) {
                    $('#datatable').DataTable().destroy();
                }

                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('getQuestionData') }}",
                        data: {
                            question: question,
                            question_key: question_key
                        }
                    },
                    columns: [
                        {
                            data: 'id',
                            name: 'id'
                        },

                        
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'lname',
                            name: 'lname'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        }
                    ]
                });


            });
        });
    </script>
@endsection
