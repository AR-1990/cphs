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
            max-width: 1600px !important;
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

    .table tbody td .counts {
        width: fit-content;
        border: 1px solid #d86744;
        background: none;
        min-width: 34px;
        min-height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: #d86744;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 5px;
        padding: 0;
    }

    .table tbody td .counts:hover {
        background: #d86744;
        color: #fff;
    }

    #findingreport-table_wrapper {
        padding: 10px;
    }

    div#datatable_info {
        color: #fff;
    }

    div.dataTables_filter {
        display: flex;
        justify-content: end;
        margin-right: 20px;
    }

    .btn-view {
        background-color: #ff5722;
        color: white;
        border: none;
        padding: 4px 10px;
        border-radius: 5px !important;
    }

    .fromtosearch {
        display: flex;
        align-items: flex-end;
        gap: 1rem;
    }

    .fromtosearch label {
        margin: 0;
    }

    .fromtosearch button {
        padding: .375rem 2rem !important;
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
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">
                    Nutrition Case Identified Report
                    </li>
                </ol>
                <div class="btn-group">
                    <form></form>
                </div>
            </div>
        </div>
        <form class="fromtosearch">
            <label for="from">
                <span class="d-block">From</span>
                <input type="date" name="from" id="from" class="form-control form-control-sm">
            </label>
            <label for="to">
                <span class="d-block">To</span>
                <input type="date" name="to" id="to" class="form-control form-control-sm">
            </label>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>

<!-- Page Content -->

<div class="container-fluid page__container page__container page-section" style="max-width: 100% !important;">
    <div class="page-separator">
        <div class="page-separator__text">Case Identified Report</div>
    </div>
    <div class="card mb-0">
        <div id="case-identified-info" class="mb-3"></div>
        <div class="table-responsive">
            <div id="default-table-section">
                <h5>All Time Data</h5>
                <table class="table table-striped table-bordered table-nowrap" id="default-caseIdentified-table">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>SR No.</th>
                            <th>School Name</th>
                            <th>Screening</th>
                            <th>Follow-up Case</th>
                            <th>New Case</th>
                            <th>Teacher Trainings</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div id="filtered-table-section" style="display:none;">
                <h5>Date Range Data</h5>
                <table class="table table-striped table-bordered table-nowrap" id="filtered-caseIdentified-table">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>SR No.</th>
                            <th>School Name</th>
                            <th>Screening</th>
                            <th>Follow-up Case</th>
                            <th>New Case</th>
                            <th>Teacher Trainings</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Structure -->
    <div class="modal fade" id="caseDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Case Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="caseDetailsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Type of Encounter</th>
                                <th>Gender</th>
                                <th>Age</th>
                            </tr>
                        </thead>
                        <tbody id="caseDetailsTableBody">
                            <!-- dynamic rows -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="exportExcelBtn" class="btn btn-success">Export to Excel</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function renderTableData(data, tableId) {
    var tbody = '';
    if (data && data.length > 0) {
        $.each(data, function(i, row) {
            tbody += '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + row.school_name + '</td>' +
                '<td>' + (row.ScreeningCount > 0 ? '<button onclick="getCaseDetails(\'' + (row.ScreeningIds || '') + '\', \'Screening\')" class="counts btn btn-primary">' + row.ScreeningCount + '</button>' : '<button class="counts btn btn-secondary">0</button>') + '</td>' +
                '<td>' + (row.FollowUpCaseCount > 0 ? '<button onclick="getCaseDetails(\'' + (row.FollowUpCaseIds || '') + '\', \'FollowUpCase\')" class="counts btn btn-primary">' + row.FollowUpCaseCount + '</button>' : '<button class="counts btn btn-secondary">0</button>') + '</td>' +
                '<td>' + (row.NewCaseCount > 0 ? '<button onclick="getCaseDetails(\'' + (row.NewCaseIds || '') + '\', \'NewCase\')" class="counts btn btn-primary">' + row.NewCaseCount + '</button>' : '<button class="counts btn btn-secondary">0</button>') + '</td>' +
                '<td>' + (row.TrainingSessionCount > 0 ? '<button onclick="getCaseDetails(\'' + (row.TrainingSessionIds || '') + '\', \'TrainingSession\')" class="counts btn btn-primary">' + row.TrainingSessionCount + '</button>' : '<button class="counts btn btn-secondary">0</button>') + '</td>' +
                '</tr>';
        });
    } else {
        tbody = '<tr><td colspan="6" class="text-center">No records found</td></tr>';
    }
    $('#' + tableId + ' tbody').html(tbody);
}

function fetchCaseIdentifiedData(from, to) {
    var params = {};
    if (from && to) {
        params.from = from;
        params.to = to;
    }
    $.ajax({
        url: '{{ route('nutritionistIdentifiedgetdata') }}',
        data: params,
        success: function(response) {
            if (from && to && response.filtered) {
                // Show only filtered table
                $('#filtered-table-section').show();
                $('#default-table-section').hide();
                renderTableData(response.filtered, 'filtered-caseIdentified-table');
                $('#case-identified-info').html('<span class="badge badge-info">Showing data for selected date range.</span>');
            } else {
                // Show only default table
                $('#filtered-table-section').hide();
                $('#default-table-section').show();
                renderTableData(response.default, 'default-caseIdentified-table');
                $('#case-identified-info').html('');
            }
        }
    });
}

$(document).ready(function () {
    // Initial load (all-time)
    fetchCaseIdentifiedData();

    // Date range form submit
    $('.fromtosearch').on('submit', function(e) {
        e.preventDefault();
        var from = $('#from').val();
        var to = $('#to').val();
        fetchCaseIdentifiedData(from, to);
    });
});

function getCaseDetails(ids, type) {
    $.ajax({
        url: '{{ route('get.case.details') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            ids: ids,
            type: type
        },
        success: function(response) {
            var tableBody = '';
            if(response.length > 0){
                $.each(response, function(index, caseData) {
                    tableBody += '<tr>'+ '<td>'+caseData.name+'</td>'+ '<td>'+caseData.type_of_encounter+'</td>'+ '<td>'+caseData.gender+'</td>'+ '<td>'+caseData.age+'</td>'+ '</tr>';
                });
            } else {
                tableBody = '<tr><td colspan="4" class="text-center">No records found</td></tr>';
            }
            $('#caseDetailsTableBody').html(tableBody);
            var myModal = new bootstrap.Modal(document.getElementById('caseDetailsModal'));
            myModal.show();
        },
        error: function() {
            alert('Kuch masla aagaya bhai!');
        }
    });
}

// Export Excel Button Click
$('#exportExcelBtn').click(function(){
    var wb = XLSX.utils.table_to_book(document.getElementById('caseDetailsTable'), {sheet:"Cases"});
    XLSX.writeFile(wb, 'case-details.xlsx');
});
</script>

@endsection
