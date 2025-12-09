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

    .table tbody td button.counts {
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

    .table tbody td button.counts:hover {
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div class="pt-32pt">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Dashboard</h2>
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">
                        Reportable Findings Report
                    </li>
                </ol>
            </div>
        </div>
        <form class="fromtosearch" method="GET" action="{{ route('reportable-findings') }}">
            <label for="start_date">
                <span class="d-block">From</span>
                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}">
            </label>
            <label for="end_date">
                <span class="d-block">To</span>
                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}">
            </label>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>

<!-- Page Content -->

<div class="container-fluid page__container page__container page-section" style="max-width: 100% !important;">
    <div class="page-separator">
        <div class="page-separator__text">Reportable Findings Report</div>
    </div>
    <div class="card mb-0">
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable table-nowrap findingreportTable" id="findingreport-table" style="z-index:3;width:100%">
                <thead style="color:black;">
                    <tr class="bg-primary white">
                        <th>SR No.</th>
                        <th>School Name</th>
                        <th>Total Students</th>
                        <th>Total Screened Students</th>
                        <th>Total Findings</th>
                        <th>Posture/Gait</th>
                        <th>Jaundice</th>
                        <th>Clubbing</th>
                        <th>Skin</th>
                        <th>Nails</th>
                        <th>Lice/Nits</th>
                        <th>Hair and Scalp</th>
                        <th>Scalp</th>
                        <th>Ocular Alignment</th>
                        <th>Visual Acuity (Right)</th>
                        <th>Visual Acuity (Left)</th>
                        <th>Nystagmus</th>
                        <th>Ear Examination</th>
                        <th>External Nasal Examination</th>
                        <th>Assess Gingiva</th>
                        <th>Examine Tonsils</th>
                        <th>Neck Swelling</th>
                        <th>Visible Chest Deformity</th>
                        <th>Cardiac Auscultation</th>
                        <th>Limitations in Joint Motion</th>
                        <th>Side-to-Side Curvature</th>
                        <th>Foot or Toe Abnormalities</th>
                        <th>Allergies</th>
                        <th>BMI</th>
                        <th>Anemia</th>
                        <th>Color Vision</th>
                        <th>Dental Caries</th>
                        <th>Breath</th>
                        <th>Discuss Hygiene</th>
                        <th>Uniform</th>
                        <th>Hair Problem</th>
                        <th>Ear Shape</th>
                        <th>Rinne Weber</th>
                        <th>Patency Test</th>
                        <th>Speech Development</th>
                        <th>Lung Auscultation</th>
                        <th>Distension, Scars, or Masses</th>
                        <th>Spinal Curvature</th>
                        <th>Vaccination</th>
                        <th>Discomfort During Urination</th>
                        <th>Menstrual Abnormality</th>
                      <!--   <th>Restless or overactive?</th>
                        <th>Excitable, Impulsive?</th>
                        <th>Disturbs other children?</th>
                        <th>Fails to finish things started</th>
                        <th>Inattentive, easily distracted?</th>
                        <th>Cries often and easily?</th>
                        <th>Is your spelling poor?</th>
                        <th>do you often make mistakes?</th>
                        <th>difficulty in telling left from right?</th>
                        <th>mix up bus numbers?</th> -->
                        <th>Life Style</th>
                        <th>Addiction</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $index => $school)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $school->school_name }}</td>
                        <td>{{ $school->total_students ?? 0 }}</td>
                        <td>{{ $screenedBySchool[$school->id] ?? 0 }}</td>
                        <td><b>{{ $schoolTotals[$school->school_name] ?? 0 }}</b></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="NormalPosture">{{ $school->NormalPostureCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="jaundice">{{ $school->jaundiceCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="clubing">{{ $school->clubingCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="skin">{{ $school->skinCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="nail">{{ $school->nailCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="lice">{{ $school->liceCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="hair">{{ $school->hairCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="Scalp">{{ $school->ScalpCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="ocular">{{ $school->ocularCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="VisualAcuityRight">{{ $school->VisualAcuityRightCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="VisualAcuityLeft">{{ $school->VisualAcuityLeftCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="Nystagmus">{{ $school->NystagmusCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="EarExamination">{{ $school->EarExaminationCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="ExaminationNasal">{{ $school->ExaminationNasalCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="asses">{{ $school->assesCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="ExamineTonsile">{{ $school->ExamineTonsileCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="NeckSweling">{{ $school->NeckSwelingCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="ChestDeformaty">{{ $school->ChestDeformatyCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="CardiacAuscultation">{{ $school->CardiacAuscultationCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="jointMotion">{{ $school->jointMotionCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="side_to_side_curvature">{{ $school->side_to_side_curvatureCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="footOrToe">{{ $school->footOrToeCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="Allergies">{{ $school->AllergiesCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="bmiresult">{{ $school->bmiCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="anemia">{{ $school->anemiaCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="ColorVision">{{ $school->ColorVisionCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="caries">{{ $school->cariesCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="Breath">{{ $school->BreathCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="DiscussHygiene">{{ $school->DiscussHygieneCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="Uniform">{{ $school->UniformCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="HairProblem">{{ $school->HairProblemCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="EarShape">{{ $school->EarShapeCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="RinnerWeber">{{ $school->RinnerWeberCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="potensyTest">{{ $school->potensyTestCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="SpeechDev">{{ $school->SpeechDevCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="LungAuscultation">{{ $school->LungAuscultationCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="ScarsMasses">{{ $school->ScarsMassesCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="SpinalCurvature">{{ $school->SpinalCurvatureCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="Epi">{{ $school->EpiCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="DiscomfortDuringUrination">{{ $school->DiscomfortDuringUrinationCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="MenstrualAbnormality">{{ $school->MenstrualAbnormalityCount }}</button></td>
                      
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="lifestyle">{{ $school->lifestyleCount }}</button></td>
                        <td> <button class="counts btn btn-primary" data-school="{{ $school->id }}" data-finding="addiction">{{ $school->addictionCount }}</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $results->links() }}
        </div>
    </div>
    <!-- Modal Structure -->
    <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel">Data for Findings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datatable-loader" style="display:none;text-align:center;margin-bottom:10px;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading results...
                    </div>
                    <table id="datatable" class="table table-bordered table-striped">
                         <thead>
                            <tr>
                                <th>System Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Reportable</th>
                                <th>Result By</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-success" id="exportCsvBtn">Export CSV</button>
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
<script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

<script>
    $(document).ready(function() {
        $('#findingreport-table').DataTable({
            searching: false,
            fixedColumns: {
                leftColumns: 3 // pehle 2 columns freeze
            }
        });

        

        $(document).on('click', '#exportCsvBtn', function() {
            let csv = [];
            let rows = document.querySelectorAll("#datatable tr");

            for (let i = 0; i < rows.length; i++) {
                let row = [], cols = rows[i].querySelectorAll("td, th");
                for (let j = 0; j < cols.length; j++)
                    row.push('"' + cols[j].innerText.replace(/"/g, '""') + '"');
                csv.push(row.join(","));
            }

            // Download CSV
            let csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
            let downloadLink = document.createElement("a");
            downloadLink.download = "findings_data.csv";
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
        });

        $(document).on('click', '.counts', function() {
            var schoolId = $(this).data('school');
            var finding = $(this).data('finding');
            // Show loader
            $('#datatable-loader').show();
            $('#dataModal').modal('show');
            // Clear previous data
            $('#datatable tbody').empty();
            //var studentFindingBaseUrl = "{{ url('student-finding') }}/";
            var studentFindingBaseUrl = "https://cphs.biopharmainfo.net/Medical_Detail/";
            $.ajax({
                url: "{{ route('getReportableFindingsBySchool')}}",
                type: 'POST',
                data: {
                    school_id: schoolId,
                    finding: finding,
                    _token: '{{ csrf_token() }}',
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val()
                },
                success: function(response) {
                    $('#datatable-loader').hide();
                    if(response.data && response.data.length > 0) {
                        response.data.forEach(function(row) {
                            $('#datatable tbody').append('<tr><td>' + row.id + '</td><td><a href="' + studentFindingBaseUrl + row.id + '" class="student-link" target="_blank">' + row.name + '</a></td><td>' + row.lname + '</td><td>' + row.phone + '</td><td>' + row.result + '</td><td>' + (row.result_by ?? '') + '</td></tr>');
                        });
                    } else {
                        $('#datatable tbody').append('<tr><td colspan="5">No data found</td></tr>');
                    }
                },
                error: function() {
                    $('#datatable-loader').hide();
                    $('#datatable tbody').append('<tr><td colspan="5">Error loading data</td></tr>');
                }
            });
        });
    });
</script>


@endsection
