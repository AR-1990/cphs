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

        .dt-button.buttons-csv.buttons-html5 {
            display: none;
        }

        #datatable_length {
            float: left;
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
            <button class="btn btn-primary" id="exportCSVBtn">Export CSV</button>
            {{-- <a class="" href="{{ Route('CreateMedicalHistory') }}"><button class="btn btn-primary">Create</button></a> --}}
            <a class="" href="{{ Route('StudentBiodata') }}"><button class="btn btn-primary">Create</button></a>
        </div>
       

            {{-- <a class="" href="{{ Route('IndexMedicalHistory') }}?Follow_up_Date_flag=1">
                <button class="btn btn-primary">Schedule Follow-up
                </button>
            </a> --}}

            
            <a class="" href="{{ Route('IndexMedicalHistory') }}?Follow_up_Date_flag=0">
                <button class="btn btn-primary">Unscheduled Follow-up</button>
            </a>

            
        
        <div class="page-separator">
            <div class="page-separator__text"> Medical History</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="startMH">From Date</label>
                <input type="date" id="startMH" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="endMH">To Date</label>
                <input type="date" id="endMH" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary" id="dateSearchMH">Search</button>
            </div>
        </div>

        <div class="card mb-0">

            <div class="table-responsive">
                <table class="table table-stripped table-bordered datatable" id="datatable" style="z-index:3;width:100%">
                    <thead style="color:black; width:100%!important">
                        <tr role="row" class="bg-primary white">



                            {{-- Student Biodata --}}
                            <th>S.no</th>
                            <th>GrNo</th>
                            <th>Name</th>
                            <th>dob</th>
                            <th>class</th>
                            <th>B-Form Number</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>School Name</th>
                            <th>Date</th>
                            <th>Contact Number</th>
                            <th>Emergency Contact Number</th>
                            <th>Type Of Encounter</th>

                            {{-- School Health Physician --}}

                            <th>Chief Complaints</th>
                            <th>History of Presenting Complaints</th>
                            <th>Review of Systems</th>
                            <th>General</th>
                            <th>Eyes</th>
                            <th>Ears Nose And Throat</th>
                            <th>Teeth</th>
                            <th>Cardiorespiratory</th>
                            <th>Gastrointestinal</th>
                            <th>Genitourinary</th>
                            <th>Neuromuscular</th>
                            <th>Endocrine</th>
                            <th>Hematologic</th>
                            <th>Rheumatologic</th>
                            <th>Skin</th>
                            <th>Investigations Laboratory Test Reports</th>
                            <th>Medication History</th>
                            <th>Allergies</th>
                            <th>Past Medical History</th>
                            <th>Past Surgical History</th>
                            <th>Birth History</th>
                            <th>Immunization History</th>
                            <th>Growth Development Puberty Changes</th>
                            <th>Nutrition History</th>
                            <th>Family History</th>

                            <th>Personal Social History</th>
                            <th>Blood Pressure</th>
                            <th>Blood Pressure Result</th>
                            <th>Blood Pressure Diastolic</th>
                            <th>Blood Pressure Diastolic Result</th>
                            <th>Temperature</th>
                            <th>Temperature Result</th>
                            <th>Pulse Rate</th>
                            <th>Pulse Result</th>
                            <th>Respiratory Rate</th>
                            <th>Respiratory Rate Result</th>
                            <th>Weight</th>
                            <th>Weight Result</th>
                            <th>Height</th>
                            <th>Height Result</th>
                            <th>BMI</th>
                            <th>BMI Result</th>
                            <th>General Appearance</th>
                            <th>Skin</th>
                            <th>Lymph Nodes</th>
                            <th>Head</th>
                            <th>Eyes</th>
                            <th>ENT</th>
                            <th>Chest</th>
                            <th>Heart</th>
                            <th>Abdomen</th>
                            <th>Extremities</th>
                            <th>Neurologic Examination</th>
                            <th>Problem List</th>
                            <th>Impression</th>
                            <th>Provisional Diagnosis</th>
                            <th>Investigations Recommended</th>
                            <th>General Advice</th>
                            <th>First Aid Given</th>
                            <th>Follow Up Required</th>
                            <th>Reason For Follow Up</th>
                            <th>Follow Up Date</th>
                            <th>Internal Referrals</th>
                            <th>External Referrals</th>
                            <th>Reason For Referral</th>



                            {{-- Nutritionist History & Evaluation Section --}}
                            <th>Height</th>
                            <th>Height Result</th>
                            <th>Weight</th>
                            <th>Weight Result</th>
                            <th>BMI</th>


                            <th>MUAC</th>
                            <th>Ideal Body Weight</th>
                            <th>Physical Activity Level</th>
                            <th>Estimated Energy Requirement</th>
                            <th>Daily Protein Requirement</th>
                            <th>Daily Carbohydrate Requirement</th>
                            <th>Daily Fat Requirement</th>
                            <th>Daily Fluid Requirement</th>
                            <th>Chief Complaints</th>
                            <th>History of Presenting Complains</th>
                            <th>Past Medical History</th>
                            <th>Medication Supplements Allergies History</th>
                            <th>Family History</th>
                            <th>Personal Social History</th>
                            <th>Food Allergies and Intolerances</th>
                            <th>Appetite</th>
                            <th>Recent Weight Changes Weight History</th>
                            <th>Breakfast</th>
                            <th>Breakfast Detail</th>
                            <th>Mid day Snack</th>
                            <th>Mid Day Snack Detail</th>
                            <th>Lunch</th>
                            <th>Lunch Detail</th>
                            <th>Evening Snack</th>
                            <th>Evening Snack Detail</th>
                            <th>Dinner</th>
                            <th>Dinner Details</th>
                            <th>Bed Time Snack</th>
                            <th>Biochemical Laboratory Test Reports</th>
                            <th>Skin</th>
                            <th>Eyes</th>
                            <th>Lips</th>
                            <th>Nails</th>
                            <th>Hair</th>
                            <th>Scalp</th>
                            <th>Problem List</th>
                            <th>Impression</th>
                            <th>Provisional Diagnosis</th>
                            <th>General Advice</th>
                            <th>Diet Breakfast</th>
                            <th>Diet Snack</th>
                            <th>Diet Lunch</th>
                            <th>Diet Dinner</th>
                            <th>Diet Bedtime</th>
                            <th>Follow Up Required</th>
                            <th>Reason For Follow Up</th>
                            <th>Follow Up Date</th>
                            <th>Internal Referrals</th>
                            <th>External Referrals</th>
                            <th>Reason For Referrals</th>


                            {{-- Psychologist History & Assessment Section --}}

                            <th>Identifying Personal Information</th>
                            <th>Referral Source</th>
                            <th>Chief Complaints</th>
                            <th>History Of Presenting Complaints</th>
                            <th>Investigations Laboratory Test Reports</th>
                            <th>Past Medical Psychiatric History</th>
                            <th>Medication History Allergies</th>
                            <th>Family History</th>
                            <th>Personal Social History</th>
                            <th>Appearance Behavior</th>
                            <th>Attitude Toward The Examiner</th>
                            <th>Speech</th>
                            <th>Mood</th>
                            <th>Affect</th>
                            <th>Thought Process Content</th>
                            <th>Perceptions</th>
                            <th>Delusions</th>
                            <th>Cognitive Function</th>
                            <th>Insight</th>
                            <th>Judgement</th>
                            <th>Impulsivity</th>
                            <th>Reliability</th>
                            <th>Problem List</th>
                            <th>Impression</th>
                            <th>Provisional Diagnosis</th>
                            <th>General Advice</th>
                            <th>Follow Up Required</th>
                            <th>Reason for Follow Up</th>
                            <th>Follow Up Date</th>
                            <th>Internal Referrals</th>
                            <th>External Referrals</th>
                            <th>Reason for Referral</th>


                            <th>Follow Up </th>
                            <th>Enter by </th>
                            <th>Action</th>

                        </tr>
                    </thead>



                </table>
            </div>




        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}




    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {

            var base_url = '{!! Route('ListMedicalHistory') !!}';
            var schoolId = new URLSearchParams(window.location.search).get('schoolId');
            console.log("schoolId " + schoolId);
            var MedicalHistoryType = new URLSearchParams(window.location.search).get('MedicalHistoryType');
            console.log("MedicalHistoryType " + MedicalHistoryType);
           
            var Blood_pressure_result = new URLSearchParams(window.location.search).get('Blood_pressure_result');
            console.log("Blood_pressure_result " + Blood_pressure_result);
           
            var BloodPressureDiastolicResult = new URLSearchParams(window.location.search).get('BloodPressureDiastolicResult');
            console.log("BloodPressureDiastolicResult " + BloodPressureDiastolicResult);
           
            var TemperatureResult = new URLSearchParams(window.location.search).get('TemperatureResult');
            console.log("TemperatureResult " + TemperatureResult);


            
            var PulseResult = new URLSearchParams(window.location.search).get('PulseResult');
            console.log("PulseResult " + PulseResult);



            
            var RespiratoryRateResult = new URLSearchParams(window.location.search).get('RespiratoryRateResult');
            console.log("RespiratoryRateResult " + RespiratoryRateResult);


            
            var WeightResult = new URLSearchParams(window.location.search).get('WeightResult');
            console.log("WeightResult " + WeightResult);


            
            var HeightResult = new URLSearchParams(window.location.search).get('HeightResult');
            console.log("HeightResult " + HeightResult);



            
            var BMIResult = new URLSearchParams(window.location.search).get('BMIResult');
            console.log("BMIResult " + BMIResult);


            
            var Follow_up_Date_flag = new URLSearchParams(window.location.search).get('Follow_up_Date_flag');
            console.log("Follow_up_Date_flag " + Follow_up_Date_flag);



            var table = $('#datatable').DataTable({
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
                ], // Custom length menu options
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-light"></i><span class="sr-only">Loading...</span>'
                },
                ajax: {
                    type: 'POST',
                    url: base_url,
                    dataType: "json",
                    data: function(d) {
                        d.fromDate = $('#startMH').val();
                        d.toDate = $('#endMH').val();
                        if (schoolId) {
                            d.schoolId = schoolId;
                        }
                        if (MedicalHistoryType) {
                            d.MedicalHistoryType = MedicalHistoryType;
                        }
                        
                        if (Blood_pressure_result) {
                            d.Blood_pressure_result = Blood_pressure_result;
                        }

                        
                        if (BloodPressureDiastolicResult) {
                            d.BloodPressureDiastolicResult = BloodPressureDiastolicResult;
                        }
                        
                        if (TemperatureResult) {
                            d.TemperatureResult = TemperatureResult;
                        }

                        if (PulseResult) {
                            d.PulseResult = PulseResult;
                        }

                        if (RespiratoryRateResult) {
                            d.RespiratoryRateResult = RespiratoryRateResult;
                        }

                        if (WeightResult) {
                            d.WeightResult = WeightResult;
                        }

                        if (HeightResult) {
                            d.HeightResult = HeightResult;
                        }

                        if (BMIResult) {
                            d.BMIResult = BMIResult;
                        }
                        if (Follow_up_Date_flag) {
                            d.Follow_up_Date_flag = Follow_up_Date_flag;
                        }


                    }
                },


                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },

                    /* Student Biodata  */
                    {
                        data: 'GRNo',
                        name: 'GRNo'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'dob',
                        name: 'dob',
                        visible: false
                    },

                    {
                        data: 'class',
                        name: 'class',
                        visible: false
                    },

                    {
                        data: 'B_Form_Number',
                        name: 'B_Form_Number',
                        visible: false
                    },

                    {
                        data: 'age',
                        name: 'age',
                        visible: false
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        visible: false
                    },

                    {
                        data: 'School_Name',
                        name: 'School_Name',
                        visible: true
                    },
                  
                   

                    { data: 'created_at', name: 'created_at' },

                    
                    /*{
                        data: 'created_at',
                        name: 'Schoocreated_atl_Name',
                        visible: true,
                        render: function(data, type, row) {
                            if (data) {
                                // Create a new Date object from the data
                                const date = new Date(data);
                                // Format the date as DD/MM/YYYY
                                const formattedDate = ("0" + date.getDate()).slice(-2) + "/" +
                                    ("0" + (date.getMonth() + 1)).slice(-2) + "/" +
                                    date.getFullYear();
                                return formattedDate;
                            }
                            return '';
                        }
                    },*/


                    {
                        data: 'Contact_Number',
                        name: 'Contact_Number',
                        visible: false
                    },
                    {
                        data: 'Emergency_Contact_Number',
                        name: 'Emergency_Contact_Number',
                        visible: false
                    },
                    {
                        data: 'type_of_encounter',
                        name: 'type_of_encounter',
                        visible: false
                    },

                    /* School Health Physician  */


                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Chief_Complaints1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.History_of_Presenting_Complaints1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Review_of_Systems;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.General;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Eyes;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Ears_Nose_and_Throat;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Teeth;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Cardiorespiratory;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Gastrointestinal;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Genitourinary;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Neuromuscular;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Endocrine;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Hematologic;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Rheumatologic;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Skin;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Investigations_Laboratory_Test_Reports1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },


                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Medication_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Allergies;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Past_Medical_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Past_Surgical_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Birth_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Immunizatio_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Growth_Development_Puberty_changes;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Nutrition_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Family_History1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Personal_Social_History1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Blood_pressure;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Blood_pressure_result;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.BloodPressureDiastolic;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.BloodPressureDiastolicResult;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Temperature;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.TemperatureResult;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Pulse_rate;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.PulseResult;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Respiratory_Rate;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.RespiratoryRateResult;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Weight;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.WeightResult;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Height;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.HeightResult;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.BMI;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.BMIResult;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.General_Appearance;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },



                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Skin;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Lymph_Nodes;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Head;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Eyes;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.ENT;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Chest;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Heart;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Abdomen;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Extremities;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Neurologic_Examination;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Problem_List;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Impression;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Provisional_Diagnosis;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Investigations_Recommended;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.General_Advice;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.First_Aid_Given;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Follow_up_Required;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Reason_for_Follow_up;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Follow_up_Date;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.internal_referrals;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.external_referrals;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'school_health_physicians',
                        name: 'school_health_physicians',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Reason_for_Referral;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },


                    //                     /*Nutritionist History & Evaluation Section*/

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.height;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.HeightResult1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Weight;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.WeightResult1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.BMI;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    // {
                    //     data: 'nutritionist_history_evaluation_sections',
                    //     name: 'nutritionist_history_evaluation_sections',
                    //     render: function(data, type, row) {

                    //         if (data != null) {

                    //             return data.BMIResult1;

                    //         } else {
                    //             return '';
                    //         }
                    //     },
                    //     visible: false
                    // },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.MUAC;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Ideal_Body_Weight;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Physical_Activity_Level;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },


                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Estimated_Energy_Requirement;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Daily_Protein_Requirement;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Daily_Carbohydrate_Requirement;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Daily_Fat_Requirement;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Daily_Fluid_Requirement;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Chief_Complaints2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.History_of_Presenting_Complains;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Past_Medical_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Medication_Supplements_Allergies_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Family_History2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Personal_Social_History2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Food_Allergies_and_Intolerances;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Appetite;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Recent_Weight_Changes_Weight_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Breakfast;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.breakfast_detail;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Mid_day_Snack;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.MidDaySnackDetail;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Lunch;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.lunchDetail;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Evening_Snack;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.EveningSnackDetail;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Dinner;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.DinnerDetails;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Bed_time_snack;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Biochemical_Laboratory_test_Reports;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Skin;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Eyes;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Lips;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Nails;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Hair;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Scalp;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Problem_List1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Impression1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Provisional_Diagnosis1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.General_Advice1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.diet_breakfast;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.diet_snack;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.diet_lunch;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.diet_dinner;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.diet_bedtime;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Follow_up_Required1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Reason_for_Follow_up1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Follow_up_Date1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {

                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.internal_referrals1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.external_referrals1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'nutritionist_history_evaluation_sections',
                        name: 'nutritionist_history_evaluation_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Reason_for_Referral1;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    // /*Psychologist History & Assessment Section */

                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Identifying_Personal_Information;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Referral_Source;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Chief_Complaints3;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.History_of_Presenting_Complaints2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Investigations_Laboratory_Test_Reports2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Past_Medical_Psychiatric_History;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Medication_History_Allergies;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Family_History3;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Personal_Social_History3;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Appearance_Behavior;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Attitude_toward_the_examiner;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Speech;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Mood;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Affect;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Thought_process_content;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Perceptions;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Delusions;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Cognitive_Function;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Insight;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Judgement;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Impulsivity;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Reliability;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Problem_List2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Impression2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Provisional_Diagnosis2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.General_Advice2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Follow_up_Required2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Reason_for_Follow_up2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Follow_up_Date2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.internal_referrals2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.external_referrals2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },
                    {
                        data: 'psychologist_history_assessment_sections',
                        name: 'psychologist_history_assessment_sections',
                        render: function(data, type, row) {

                            if (data != null) {

                                return data.Reason_for_Referral2;

                            } else {
                                return '';
                            }
                        },
                        visible: false
                    },

                    {
                        data: 'Follow_up_Date_flag',
                        name: 'Follow_up_Date_flag',
                        visible: true
                    },
                    

                    {
                        data: 'fullname',
                        name: 'fullname',
                        searchable: false
                    },


                    {
                        data: 'action',
                        name: 'action',
                        searchable: false
                    },

                ],

                dom: "B<'clear'>lfrtip", // Add the 'l' to show the length menu
                buttons: [{
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        title: 'Medical History',
                        exportOptions: {
                            columns: ':visible,  :hidden' // Export only visible columns
                        }

                        // exportOptions: {
                        //     columns: ':visible:not(:last-child)' // Export only visible columns except the last one
                        // }
                    }

                ]
            });

            $('#dateSearchMH').on('click', function(){
                table.ajax.reload();
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

        document.getElementById("exportCSVBtn").addEventListener("click", function() {
            document.querySelector(".dt-button.buttons-csv.buttons-html5").click()
        });
    </script>


@endsection
