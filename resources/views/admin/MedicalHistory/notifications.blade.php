@extends('admin.main')
@section('content')
    <style>
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

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

        table .unread .btn {
            background: #fff;
            border: 1px solid #fff;
            color: #59595c;
        }
        table .unread {
            background: #ddd;
        }
        table .unread td { 
            color: #000;
        }

    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Notifications</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Medical Notifications</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container page__container page__container page-section">
        <div class="card mb-0">
            <div class="table-responsive">
                <table class="table table-stripped table-bordered datatable" id="datatable" style="z-index:3;width:100%">
                    <thead style="color:black; width:100%!important">
                        <tr role="row" class="bg-primary white">
                            <th>ID</th>
                            <th>Notification</th>
                            {{-- <th>Redirect Link</th>
                            <th>Notification Type</th>
                            <th>Read Status</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Updated By</th> --}}
                            <th>Action</th>
                            <th>row_class</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                // processing: false,
                // serverSide: true,

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
                ],  
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-light"></i><span class="sr-only">Loading...</span>'
                },
                ajax: {
                    url: "{{ route('getMedicalNotifications') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'NotificationText',
                        name: 'NotificationText'
                    },
                    /*{ data: 'redirect_link', name: 'redirect_link' },
                    { data: 'notification_type', name: 'notification_type' },
                    { data: 'read_status', name: 'read_status' },
                    { data: 'status', name: 'status' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'updated_by', name: 'updated_by' },*/
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'row_class',
                        name: 'row_class',
                        visible: false
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    if (data.row_class) {
                        $(row).addClass(data.row_class);
                    }
                }
            });
        });

        $(document).on("click", ".MedicalNotificationClick", function(e) {
            e.preventDefault(); // Prevent default action

            var id = $(this).data('id');
            var href = $(this).data('href');
            var base_url = "{{ route('MedicalNotificationClick') }}";

            $.ajax({
                url: base_url,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status === 'success') {
                        // Update button color to indicate read status
                        $(this).removeClass('btn-primary').addClass('btn-secondary');
                        window.location.href = href;
                    } else {
                        console.error("Error:", resp.message);
                    }
                }.bind(this), // Ensure `this` refers to the button element
                error: function(xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
        });
    </script>
@endsection
