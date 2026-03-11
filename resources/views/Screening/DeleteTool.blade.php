@extends('admin.main')
@section('content')
    <style>
        .delete-tool-card .form-control {
            max-width: 360px;
        }

        .delete-tool-meta td {
            padding: 0.35rem 0.75rem;
        }
    </style>

    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Screening Delete Tool</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Screening') }}">Screening</a></li>
                        <li class="breadcrumb-item active">Delete Tool</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid page__container page-section" style="max-width: 100% !important;">
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
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card delete-tool-card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('ScreeningDeleteTool') }}" class="form-inline">
                    <div class="form-group mr-2 mb-2">
                        <label class="mr-2" for="entry_id">Screening ID</label>
                        <input type="number" min="1" id="entry_id" name="entry_id" class="form-control"
                            value="{{ $searchedId ?? '' }}" placeholder="Enter ID" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Search</button>

                    <a href="{{ route('ScreeningDeleteTool') }}" class="btn btn-outline-secondary mb-2 ml-2">Reset</a>

                    <a class="btn btn-outline-secondary mb-2 ml-auto" data-toggle="collapse" href="#deletionLogs"
                        role="button" aria-expanded="false" aria-controls="deletionLogs">
                        View Deletion Logs
                    </a>
                </form>
            </div>
        </div>

        @if (!empty($searchedId))
            <div class="card mb-3">
                <div class="card-header bg-primary white d-flex align-items-center justify-content-between">
                    <div>Search Result</div>
                    @if (!empty($record))
                        <a href="{{ route('Details', ['id' => $record->id]) }}" class="btn btn-light btn-sm" target="_blank">
                            View Full Record
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if (empty($record))
                        <div class="text-danger">No record found for this ID.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered delete-tool-meta mb-0">
                                <tbody>
                                    <tr>
                                        <td style="width: 200px;"><strong>ID</strong></td>
                                        <td>{{ $record->id }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td>{{ trim(($record->name ?? '') . ' ' . ($record->lname ?? '')) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>School</strong></td>
                                        <td>{{ $record->school_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>GR No</strong></td>
                                        <td>{{ $record->grno ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Created At</strong></td>
                                        <td>{{ $record->created_at ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Created By</strong></td>
                                        <td>{{ $record->enterby_name ?? ($record->enterby ?? '-') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                Delete This Record
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="collapse" id="deletionLogs">
            <div class="card mb-0">
                <div class="card-header bg-primary white">Deletion Logs</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0 datatable" id="deletionLogsTable"
                            style="width:100%">
                            <thead>
                                <tr class="bg-primary white">
                                    <th>Screening ID</th>
                                    <th>Student</th>
                                    <th>School</th>
                                    <th>Deleted By</th>
                                    <th>Reason</th>
                                    <th>Deleted At</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Screening Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('ScreeningDeleteToolDelete') }}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="entry_id" value="{{ $record->id ?? ($searchedId ?? '') }}">
                            <div class="form-group">
                                <label for="delete_reason">Reason for deletion</label>
                                <textarea id="delete_reason" name="reason" class="form-control" rows="4" required
                                    placeholder="Write the reason..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Confirm Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var logsUrl = '{!! route('ScreeningDeleteToolLogs') !!}';
            var logsTable = null;

            function initLogsTable() {
                if (logsTable) {
                    return;
                }

                logsTable = $('#deletionLogsTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    paging: true,
                    ordering: true,
                    searching: true,
                    info: false,
                    lengthMenu: [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100]
                    ],
                    order: [
                        [5, 'desc']
                    ],
                    ajax: {
                        type: 'get',
                        url: logsUrl,
                        dataType: "json"
                    },
                    columns: [{
                            data: 'entry_id',
                            name: 'entry_id'
                        },
                        {
                            data: 'student_name',
                            name: 'student_name',
                            orderable: false
                        },
                        {
                            data: 'school_name',
                            name: 'school_name',
                            orderable: false
                        },
                        {
                            data: 'deleted_by_name',
                            name: 'deleted_by_name',
                            orderable: false
                        },
                        {
                            data: 'reason',
                            name: 'reason',
                            orderable: false
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        }
                    ]
                });
            }

            $('#deletionLogs').on('shown.bs.collapse', function() {
                initLogsTable();
                if (logsTable) {
                    logsTable.columns.adjust().responsive.recalc();
                }
            });
        });
    </script>
@endsection
