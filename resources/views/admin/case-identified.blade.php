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
    .swal2-container.swal2-backdrop-show:not(.in){
        pointer-events: auto;
    }
    div:where(.swal2-icon) .swal2-icon-content{
        font-size: 1.5em!important;
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
                        Case Identified Report
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
            <table class="table table-striped table-bordered table-nowrap" id="caseIdentified-table">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>SR No.</th>
                        <th>School Name</th>
                        <th>Physician</th>
                        <th>Nutritionist</th>
                        <th>Psychologist</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <!-- Modal Structure -->
    <div class="modal fade" id="caseModal" tabindex="-1" role="dialog" aria-labelledby="caseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="caseModalLabel">Case Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="case-modal-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="exportCsvBtn">Export to CSV</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
$(document).ready(function() {
    // Fetch and render main table
    function fetchCaseIdentifiedData() {
        var from = $('#from').val();
        var to = $('#to').val();
        $.ajax({
            url: "{{ route('caseIdentifiedData') }}",
            type: 'GET',
            data: {
                from: from,
                to: to
            },
            success: function(response) {
                var tbody = '';
                response.data.forEach(function(row, idx) {
                    // Calculate total for each type by summing only allowed categories
                    function allowedTotal(type) {
                        if (!row[type] || !row[type].categories) return 0;
                        let allowed = ['Case identified through Screening', 'Student Identified Through Teachers Training Session', 'New Case'];
                        let sum = 0;
                        allowed.forEach(function(cat) {
                            if (row[type].categories[cat]) {
                                sum += row[type].categories[cat].count;
                            }
                        });
                        return sum;
                    }
                    tbody += '<tr>' +
                        '<td>' + (idx + 1) + '</td>' +
                        '<td>' + row.school_name + '</td>' +
                        '<td><button class="counts btn btn-primary case-count-btn" data-school="' + row.school_id + '" data-type="physician">' + allowedTotal('physician') + '</button></td>' +
                        '<td><button class="counts btn btn-primary case-count-btn" data-school="' + row.school_id + '" data-type="nutritionist">' + allowedTotal('nutritionist') + '</button></td>' +
                        '<td><button class="counts btn btn-primary case-count-btn" data-school="' + row.school_id + '" data-type="psychologist">' + allowedTotal('psychologist') + '</button></td>' +
                        '</tr>';
                });
                $('#caseIdentified-table tbody').html(tbody);
            }
        });
    }
    // Handle search form submit
    $('.fromtosearch').on('submit', function(e) {
        e.preventDefault();
        fetchCaseIdentifiedData();
    });
    fetchCaseIdentifiedData();

    // Modal logic
    $(document).on('click', '.case-count-btn', function() {
        var schoolId = $(this).data('school');
        var type = $(this).data('type');
        var from = $('#from').val();
        var to = $('#to').val();
        $.ajax({
            url: "{{ route('caseIdentifiedData') }}",
            type: 'GET',
            data: {
                from: from,
                to: to
            },
            success: function(response) {
                var school = response.data.find(function(r) { return r.school_id == schoolId; });
                if (!school || !school[type]) {
                    
                    $('#case-modal-content').html('<div class="alert alert-info">No data found.</div>');
                    $('#caseModal').modal('show');
                    return;
                }
                var html = '<h5>' + school.school_name + ' - ' + type.charAt(0).toUpperCase() + type.slice(1) + ' Cases</h5>';
                var categories = school[type].categories;
                var catIdx = 0;
                Object.keys(categories).forEach(function(cat) {
                    var catData = categories[cat];
                    var collapseId = 'catCollapse' + catIdx;
                    html += '<div class="card mb-2">';
                    html += '<div class="card-header"'
                        + '><a data-toggle="collapse" href="#' + collapseId + '" role="button" aria-expanded="false" aria-controls="' + collapseId + '"><b>' + cat + ' (' + catData.count + ')</b></a>'
                        + '</div>';
                    html += '<div class="collapse" id="' + collapseId + '">';
                    // Gather all students from all subcategories
                    var allStudents = [];
                    if (catData.subcategories && Array.isArray(catData.subcategories.students)) {
                        allStudents = catData.subcategories.students;
                    }
                    
                    // Remove debug log and ensure table always renders if data exists
                    if (allStudents && allStudents.length > 0) {
                        // html += '<pre>' + JSON.stringify(allStudents, null, 2) + '</pre>';
                        html += '<table class="table table-bordered mt-2"><thead><tr><th>School Name</th><th>ID</th><th>Name</th><th>Phone</th></tr></thead><tbody>';
                        allStudents.forEach(function(stu) {
                            html += '<tr><td>' + (school.school_name || '') + '</td><td>' + (stu.id || '') + '</td><td>' + (stu.name || '') + '</td><td>' + (stu.phone || '') + '</td></tr>';
                        });
                        html += '</tbody></table>';
                    } else {
                        
                        html += '<div class="text-muted mt-2">No students in this category.</div>';
                    }
                    html += '</div></div>';
                    catIdx++;
                });
                $('#case-modal-content').html(html);
                $('#caseModal').modal('show');
            }
        });
    });

    // Export to CSV for visible tables in modal
    $(document).on('click', '#exportCsvBtn', function() {
        let csv = [];
        // Get the school name from the modal title
        let schoolName = $('#case-modal-content h5').first().text();
        // Only export tables that are visible (expanded)
        $('#case-modal-content .collapse.show table').each(function() {
            // Add school name before each table
            csv.push('"' + schoolName + '"');
            let rows = $(this).find('tr');
            rows.each(function() {
                let row = [];
                $(this).find('th,td').each(function() {
                    row.push('"' + $(this).text().replace(/"/g, '""') + '"');
                });
                csv.push(row.join(","));
            });
            // Add a blank line between tables if multiple
            csv.push("");
        });
        if(csv.length === 0) {
            Swal.fire({
                title: 'No data to export',
                icon: 'info',
                confirmButtonText: 'OK',
                allowOutsideClick: false
            }).then(function(result){
                // Try jQuery hide
                $('#caseModal').modal('hide');
                // Fallback: forcibly remove modal classes and backdrop if still visible
                setTimeout(function() {
                    var $modal = $('#caseModal');
                    if ($modal.hasClass('show')) {
                        $modal.removeClass('show').attr('aria-hidden', 'true').css('display', 'none');
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                    }
                }, 500);
            });
            return;
        }
        let csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
        let downloadLink = document.createElement("a");
        downloadLink.download = "case-details.csv";
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
    });

    $('#caseModal').on('hidden.bs.modal', function () {
        $('body').focus();
    });
});
</script>

@endsection
