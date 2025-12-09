@php
    use App\Models\School;
    
@endphp
@extends('admin.main')
@section('content')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.2/jquery.validate.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Include Tagify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.2/tagify.min.css">
    <!-- Include Tagify JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.2/tagify.min.js"></script>

    <style>
        body {
            margin: 30px;
            background-color: aliceblue;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        h1 {
            text-align: center;
        }
        .pdfLogo {
            display: none;
            width: 150px;
            margin-bottom: 25px;
        }
        #pdfLogo { 
            display: none;
            width: 150px;
            margin-bottom: 25px;
        }
        .height::after,
        .weight::after {
            margin-left: -75px;
            font-size: 14px;
            font-weight: bold;
            color: #1c3866;
        }

        .width-100 {
            width: 100%;
        }

        #comment {
            background-color: rgb(242, 240, 240);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .error-border {
            border: 2px solid #dc3545 !important;
        }

        .nav-tabs .nav-link.active {
            background-color: #1c3866 !important;
            color: #fff !important;
            border-color: transparent transparent #f5f7fa;
        }

        .nav-tabs li a {
            padding: 8px 26px !important;
        }

        .nav-tabs .nav-link {
            border: 1px solid #dfdfdf;
            background-color: #ededed;
        }

        /* #multiStepForm input[readonly], #multiStepForm select[readonly] {
                                        background-color: #fff !important;
                                        color: #000 !important;
                                        border: 1px solid #ccc !important;
                                        pointer-events: none !important;
                                        touch-action: none !important;
                                    } */

        .form-control[readonly] {
            background-color: transparent;
            border: none;
            padding-left: 0;
        }

        select {
            appearance: none;
            /* Remove default arrow in Firefox */
            -webkit-appearance: none;
            /* Remove default arrow in older versions of Chrome/Safari */
            -moz-appearance: none;
            /* Remove default arrow in newer versions of Firefox */
        }

        #content #multiStepForm input[readonly],
        #content .form-control {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        .tab-pane {
            page-break-before: always;
            /* Ensures each .section starts on a new page */
        }

        /* Optional: Adjust margins or other styles for better page layout */
        @page {
            size: A4;
            /* Set the page size */
            margin: 1cm;
            /* Adjust margins as needed */
        }

        .select2-container--default.select2-container--disabled .select2-selection--multiple {
            background: transparent;
            border: none !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__clear {
            display: none;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 0 !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: none;
            border: none;
            padding-left: 0px;
        }
        .bg_drop {
            position: fixed;
            inset: 0;
            background: #fff5;
            display: none;
            height: 100vh;
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
        }

        .bg_drop.active{
            display: flex;
        }
        .modal-backdrop {
            z-index: -1 !important;
        }

        .modal{
            height: 100vh
        }

        .modal-dialog {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        [dir] .modal-content .form-control {
            height: auto !important;
            padding: 10px;
        }

        tags.tagify.form-control tag {
            font-size: 14px;
        }
        .box_style{
            box-shadow: 0 0 20px #0002;
            padding: 2.5rem;
            border-radius: 1.5rem;
            margin-bottom: 2rem;
        }

        button#closeButton {
    font-size: 15px;
    font-weight: 700;
    display: flex;
    align-items: center;
    padding: 15px;
    background-color: #d86744;
    color: #fff;
    opacity: 1;
}

button#sendButton {
    background-color: #d86744 !important;
}

button#closeButton:hover,
button#sendButton:hover {
    background-color: #868e96 !important;
}
    </style>

    <div class="container">
        <div class="d-flex align-items-center justify-content-end my-4">
            <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#sendMailModal"
                    id="downloadPDF2">Send
                Mail
            </button>
            <button id="downloadPDF" class="btn btn-primary ">Download PDF</button>
            <button class="btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#followupModal"
                    id="followupbtn">followUp
            </button>
           {{-- <button id="generatePDF" onclick="generatePDF()" class="btn btn-primary ">Generate PDF Sample</button> --}}
            
        </div>
        <h1 class="my-2">Medical History</h1>

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
        
        <div id="content" class="container">
           
            <form id="multiStepForm"
                  @if (!empty($StudentBiodata)) action="{{ route('StudentBiodata') }}/{{ $StudentBiodata['id'] }}"
                  @else action="{{ route('StudentBiodata') }}" @endif
                  method="POST">

                <!-- Step-one -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="step active mb-5 box_style" id="step1">
                    
                    <h3>Student Biodata</h3>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="GRNo">GR Number</label>
                                <input placeholder="GR Number" type="number" step="any" class="form-control"
                                       id="GRNo" name="GRNo"
                                       @if (!empty($StudentBiodata['GRNo'])) value="{{ $StudentBiodata['GRNo'] }}"
                                       @else
                                       value="{{ old('GRNo') }}" @endif
                                       required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="dob">Date Of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                       @if (!empty($StudentBiodata['dob'])) value="{{ $StudentBiodata['dob'] }}"
                                       @else
                                       value="{{ old('dob') }}" @endif>
                            </div> 
                        </div>


                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input placeholder="Name" type="text" class="form-control" id="name" name="name"
                                       @if (!empty($StudentBiodata['name'])) value="{{ $StudentBiodata['name'] }}"
                                       @else
                                       value="{{ old('name') }}" @endif
                                       required>
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="class">Class</label>
                                <input placeholder="Class" type="number" class="form-control" id="class" name="class"
                                       @if (!empty($StudentBiodata['class'])) value="{{ $StudentBiodata['class'] }}"
                                       @else
                                       value="{{ old('class') }}" @endif
                                       required>
                                <span class="error-message"></span>
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="B_Form_Number">B-Form Number</label>
                                <input placeholder="B Form Number" type="number" class="form-control" id="B_Form_Number"
                                       name="B_Form_Number"
                                       @if (!empty($StudentBiodata['B_Form_Number'])) value="{{ $StudentBiodata['B_Form_Number'] }}"
                                       @else
                                       value="{{ old('B_Form_Number') }}" @endif
                                       required>
                                <span class="error-message"></span>
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input placeholder="Age" type="number" class="form-control" id="age" name="age"
                                       @if (!empty($StudentBiodata['age'])) value="{{ $StudentBiodata['age'] }}"
                                       @else
                                       value="{{ old('age') }}" @endif
                                       required>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="gender">Gender</label>


                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select</option>
                                    <option value="male"
                                        {{ !empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'male' ? 'selected' : (old('gender') == 'male' ? 'selected' : '') }}>
                                        Male
                                    </option>
                                    <option value="female"
                                        {{ !empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'female' ? 'selected' : (old('gender') == 'female' ? 'selected' : '') }}>
                                        Female
                                    </option>
                                    <option value="other"
                                        {{ !empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'other' ? 'selected' : (old('gender') == 'other' ? 'selected' : '') }}>
                                        Other
                                    </option>
                                </select>


                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="School_Name">School Name</label>

                                @php
                                    $Schools = School::get();
                                                                    
                                                                @endphp

                                @if (!empty($Schools))
                                @foreach ($Schools as $item)
                                        @if (!empty($StudentBiodata['School_Name']) && $StudentBiodata['School_Name'] == $item->id) 

                                        
                                        
                                        
                                        <input placeholder="School Name" type="text" class="form-control" id="School_Name"
                                                                    name="School_Name"
                                                                    value="{{ $item->school_name }}">

                                                                @php
                                                                    $SchoolEmail =  $item->email;
                                                                @endphp
                                        @endif
                                @endforeach
                                @endif


                                {{-- <input placeholder="School Name" type="text" class="form-control" id="School_Name"
                                       name="School_Name"
                                       @if (!empty($StudentBiodata['School_Name'])) value="{{ $StudentBiodata['School_Name'] }}"
                                       @else
                                       value="{{ old('School_Name') }}" @endif
                                       required> --}}


                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Emergency_Contact_Number"> Contact Number</label>
                                <input placeholder="Contact Number" type="number" class="form-control"
                                       id="Contact_Number" name="Contact_Number"
                                       @if (!empty($StudentBiodata['Contact_Number'])) value="{{ $StudentBiodata['Contact_Number'] }}"
                                       @else
                                       value="{{ old('Contact_Number') }}" @endif
                                       required>
                            </div>
                        </div>
                        {{-- Emergency contact field added --}}
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="Emergency_Contact_Number">Emergency Contact Number</label>
                                <input placeholder="Emergency Contact Number" type="number" class="form-control"
                                       id="Emergency_Contact_Number" name="Emergency_Contact_Number"
                                       @if (!empty($StudentBiodata['Emergency_Contact_Number'])) value="{{ $StudentBiodata['Emergency_Contact_Number'] }}"
                                       @else
                                       value="{{ old('Emergency_Contact_Number') }}" @endif
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="type_of_encounter">Type Of Encounter</label>

                                <select class="form-control" id="type_of_encounter" name="type_of_encounter" required>
                                    <option value="">Select</option>
                                    <option value="Case identified through Screening"
                                        {{ !empty($StudentBiodata['type_of_encounter']) && $StudentBiodata['type_of_encounter'] == 'Case identified through Screening' ? 'selected' : (old('type_of_encounter') == 'Case identified through Screening' ? 'selected' : '') }}>
                                        Case identified through Screening
                                    </option>
                                    <option value="New Case"
                                        {{ !empty($StudentBiodata['type_of_encounter']) && $StudentBiodata['type_of_encounter'] == 'New Case' ? 'selected' : (old('type_of_encounter') == 'New Case' ? 'selected' : '') }}>
                                        New Case
                                    </option>
                                    <option value="Follow-up Case"
                                        {{ !empty($StudentBiodata['type_of_encounter']) && $StudentBiodata['type_of_encounter'] == 'Follow-up Case' ? 'selected' : (old('type_of_encounter') == 'Follow-up Case' ? 'selected' : '') }}>
                                        Follow-up Case
                                    </option>
                                </select>

                            </div>
                        </div>
                    </div>

                    {{-- <button type="submit" class="btn btn-primary ">Next</button> --}}


                </div>


            </form>


            <div class="row">
                <div class="form-group col-md-12 my-3">
                    <ul class="nav nav-tabs justify-content-center mx-auto" id="myTab" role="tablist"
                        style="display: none;">
                        <li class="nav-item">
                            <a class="nav-link @if (!empty($SchoolHealthPhysician)) active @endif" id="home-tab"
                               data-toggle="tab" href="#home" role="tab" aria-controls="home"
                               aria-selected="true">School Health Physician</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  @if (!empty($NutritionistHistoryEvaluationSection)) active @endif"
                               id="profile-tab"
                               data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                               aria-selected="false">Nutritionist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (!empty($PsychologistHistoryAssessmentSection)) active @endif"
                               id="contact-tab"
                               data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                               aria-selected="false">Psychologist</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-5" id="myTabContent">

                        {{-- School Health Physician Tab --}}


                        <div class="tab-pane fade  @if (!empty($SchoolHealthPhysician)) active  show @endif py-4"
                             id="home" role="tabpanel" aria-labelledby="home-tab">

                            <form id="multiStepForm"
                                  action="{{ route('SchoolHealthPhysician') }}/{{ $StudentBiodataId }}}" method="POST">

                                @csrf
                                <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" class="img-fluid pdfLogo" alt=""/>
                                <h3 class="text-center my-2">School Health Physician</h3>
                                

                                {{-- <input type="text" name="StudentBiodataId" value="{{$StudentBiodataId}}" readonly > --}}
                                <div class="row box_style"> 
                                    <h4 class="mt-3">Medical History</h4>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Chief_Complaints1">Chief Complaints</label>
                                            <input placeholder="Chief Complaints" name="Chief_Complaints1" required
                                                   id="Chief_Complaints1" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Chief_Complaints1'])) value="{{ $SchoolHealthPhysician['Chief_Complaints1'] }}"
                                                   @else
                                                   value="{{ old('Chief_Complaints1') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="History_of_Presenting_Complaints1">History of Presenting
                                                Complaints</label>
                                            <input placeholder="History of Presenting Complaints" required
                                                   name="History_of_Presenting_Complaints1"
                                                   id="History_of_Presenting_Complaints1" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['History_of_Presenting_Complaints1'])) value="{{ $SchoolHealthPhysician['History_of_Presenting_Complaints1'] }}"
                                                   @else
                                                   value="{{ old('History_of_Presenting_Complaints1') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Review_of_Systems">Review of Systems</label>
                                            <input placeholder="Review of Systems" name="Review_of_Systems" required
                                                   id="Review_of_Systems" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Review_of_Systems'])) value="{{ $SchoolHealthPhysician['Review_of_Systems'] }}"
                                                   @else
                                                   value="{{ old('Review_of_Systems') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="General">General</label>
                                            <input placeholder="General" name="General" id="General" required
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['General'])) value="{{ $SchoolHealthPhysician['General'] }}"
                                                   @else
                                                   value="{{ old('General') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Eyes">Eyes</label>
                                            <input placeholder="Eyes" name="Eyes" id="Eyes" class="form-control"
                                                   required
                                                   @if (!empty($SchoolHealthPhysician['Eyes'])) value="{{ $SchoolHealthPhysician['Eyes'] }}"
                                                   @else
                                                   value="{{ old('Eyes') }}" @endif />


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Ears_Nose_and_Throat">Ears, Nose and Throat</label>
                                            <input placeholder="Ears, Nose and Throat" name="Ears_Nose_and_Throat"
                                                   required id="Ears_Nose_and_Throat" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Ears_Nose_and_Throat'])) value="{{ $SchoolHealthPhysician['Ears_Nose_and_Throat'] }}"
                                                   @else
                                                   value="{{ old('Ears_Nose_and_Throat') }}" @endif />


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Teeth">Teeth</label>
                                            <input placeholder="Teeth" name="Teeth" id="Teeth"
                                                   class="form-control" required
                                                   @if (!empty($SchoolHealthPhysician['Teeth'])) value="{{ $SchoolHealthPhysician['Teeth'] }}"
                                                   @else
                                                   value="{{ old('Teeth') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Cardiorespiratory">Cardiorespiratory</label>
                                            <input placeholder="Cardiorespiratory" name="Cardiorespiratory" required
                                                   id="Cardiorespiratory" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Cardiorespiratory'])) value="{{ $SchoolHealthPhysician['Cardiorespiratory'] }}"
                                                   @else
                                                   value="{{ old('Cardiorespiratory') }}" @endif />


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Gastrointestinal">Gastrointestinal</label>
                                            <input placeholder="Gastrointestinal" name="Gastrointestinal" required
                                                   id="Gastrointestinal" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Gastrointestinal'])) value="{{ $SchoolHealthPhysician['Gastrointestinal'] }}"
                                                   @else
                                                   value="{{ old('Gastrointestinal') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Genitourinary">Genitourinary</label>
                                            <input placeholder="Genitourinary" name="Genitourinary" id="Genitourinary"
                                                   required class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Genitourinary'])) value="{{ $SchoolHealthPhysician['Genitourinary'] }}"
                                                   @else
                                                   value="{{ old('Genitourinary') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Neuromuscular">Neuromuscular</label>
                                            <input placeholder="Neuromuscular" name="Neuromuscular" id="Neuromuscular"
                                                   required class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Neuromuscular'])) value="{{ $SchoolHealthPhysician['Neuromuscular'] }}"
                                                   @else
                                                   value="{{ old('Neuromuscular') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Endocrine">Endocrine</label>
                                            <input placeholder="Endocrine" name="Endocrine" id="Endocrine" required
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Endocrine'])) value="{{ $SchoolHealthPhysician['Endocrine'] }}"
                                                   @else
                                                   value="{{ old('Endocrine') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Hematologic">Hematologic</label>
                                            <input placeholder="Hematologic" name="Hematologic" id="Hematologic"
                                                   required
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Hematologic'])) value="{{ $SchoolHealthPhysician['Hematologic'] }}"
                                                   @else
                                                   value="{{ old('Hematologic') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Rheumatologic">Rheumatologic</label>
                                            <input placeholder="Rheumatologic" name="Rheumatologic" id="Rheumatologic"
                                                   required class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Rheumatologic'])) value="{{ $SchoolHealthPhysician['Rheumatologic'] }}"
                                                   @else
                                                   value="{{ old('Rheumatologic') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Skin">Skin</label>
                                            <input placeholder="Skin" name="Skin" id="Skin" required
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Skin'])) value="{{ $SchoolHealthPhysician['Skin'] }}"
                                                   @else
                                                   value="{{ old('Skin') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Investigations_Laboratory_Test_Reports1">Investigations /
                                                Laboratory
                                                Test Reports</label>
                                            <input placeholder="Investigations / Laboratory Test Reports" required
                                                   name="Investigations_Laboratory_Test_Reports1"
                                                   id="Investigations_Laboratory_Test_Reports1" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Investigations_Laboratory_Test_Reports1'])) value="{{ $SchoolHealthPhysician['Investigations_Laboratory_Test_Reports1'] }}"
                                                   @else
                                                   value="{{ old('Investigations_Laboratory_Test_Reports1') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Medication_History">Medication History</label>
                                            <input placeholder="Medication History" name="Medication_History" required
                                                   id="Medication_History" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Medication_History'])) value="{{ $SchoolHealthPhysician['Medication_History'] }}"
                                                   @else
                                                   value="{{ old('Medication_History') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Allergies">Allergies</label>
                                            <input placeholder="Allergies" name="Allergies" id="Allergies" required
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Allergies'])) value="{{ $SchoolHealthPhysician['Allergies'] }}"
                                                   @else
                                                   value="{{ old('Allergies') }}" @endif />


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Past_Medical_History">Past Medical History</label>
                                            <input placeholder="Past Medical History" name="Past_Medical_History"
                                                   required
                                                   id="Past_Medical_History" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Past_Medical_History'])) value="{{ $SchoolHealthPhysician['Past_Medical_History'] }}"
                                                   @else
                                                   value="{{ old('Past_Medical_History') }}" @endif />


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Past_Surgical_History">Past Surgical History</label>
                                            <input placeholder="Past Surgical History" name="Past_Surgical_History"
                                                   required id="Past_Surgical_History" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Past_Surgical_History'])) value="{{ $SchoolHealthPhysician['Past_Surgical_History'] }}"
                                                   @else
                                                   value="{{ old('Past_Surgical_History') }}" @endif />


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Birth_History">Birth History</label>
                                            <input placeholder="Birth History" name="Birth_History" id="Birth_History"
                                                   required class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Birth_History'])) value="{{ $SchoolHealthPhysician['Birth_History'] }}"
                                                   @else
                                                   value="{{ old('Birth_History') }}" @endif />


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Immunizatio_History">Immunization History</label>
                                            <input placeholder="Immunization History" name="Immunizatio_History"
                                                   required
                                                   id="Immunizatio_History" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Immunizatio_History'])) value="{{ $SchoolHealthPhysician['Immunizatio_History'] }}"
                                                   @else
                                                   value="{{ old('Immunizatio_History') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Growth_Development_Puberty_changes">Growth & Development /
                                                Puberty
                                                changes</label>
                                            <input placeholder="Growth & Development / Puberty changes" required
                                                   name="Growth_Development_Puberty_changes"
                                                   id="Growth_Development_Puberty_changes" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Growth_Development_Puberty_changes'])) value="{{ $SchoolHealthPhysician['Growth_Development_Puberty_changes'] }}"
                                                   @else
                                                   value="{{ old('Growth_Development_Puberty_changes') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Nutrition_History">Nutrition History</label>
                                            <input placeholder="Nutrition History" name="Nutrition_History" required
                                                   id="Nutrition_History" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Nutrition_History'])) value="{{ $SchoolHealthPhysician['Nutrition_History'] }}"
                                                   @else
                                                   value="{{ old('Nutrition_History') }}" @endif />


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Family_History1">Family History</label>
                                            <input placeholder="Family History" name="Family_History1"
                                                   id="Family_History1" required class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Family_History1'])) value="{{ $SchoolHealthPhysician['Family_History1'] }}"
                                                   @else
                                                   value="{{ old('Family_History1') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Personal_Social_History1">Personal & Social History</label>
                                            <input placeholder="Personal & Social History"
                                                   name="Personal_Social_History1"
                                                   required id="Personal_Social_History1" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Personal_Social_History1'])) value="{{ $SchoolHealthPhysician['Personal_Social_History1'] }}"
                                                   @else
                                                   value="{{ old('Personal_Social_History1') }}" @endif />
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" class="img-fluid pdfLogo" alt=""/>
                                
                                


                                <h4 class="text-center mt-3">PHYSICAL EXAMINATION</h4>
                                <div class="form-row box_style">
                                <div class="form-group col-md-12">
                                        <p class="font-weight-bolder">Vital Signs and Measurements</p>
                                        <div class="form-group">

                                            <label for="Blood_pressure">Blood Pressure (Systolic) <span
                                                    id="BloodPressureSystolic"></span></label>

                                            <input placeholder="Blood pressure" name="Blood_pressure"
                                                   id="Blood_pressure"
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Blood_pressure'])) value="{{ $SchoolHealthPhysician['Blood_pressure'] }}"
                                                   @else
                                                   value="{{ old('Blood_pressure') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="BloodPressureDiastolic">Blood Pressure (Diastolic) <span
                                                    id="BloodPressureDiastolicSpan"></span> </label>
                                            <input placeholder="Blood Pressure (Diastolic) "
                                                   name="BloodPressureDiastolic"
                                                   id="BloodPressureDiastolic" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['BloodPressureDiastolic'])) value="{{ $SchoolHealthPhysician['BloodPressureDiastolic'] }}"
                                                   @else
                                                   value="{{ old('BloodPressureDiastolic') }}" @endif
                                                   required/>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Temperature">Temperature
                                                <span id="temperature_check"></span>
                                            </label>
                                            <input placeholder="Temperature" name="Temperature" id="Temperature"
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Temperature'])) value="{{ $SchoolHealthPhysician['Temperature'] }}"
                                                   @else
                                                   value="{{ old('Temperature') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Pulse_rate">Pulse rate
                                                <span id="pulse_rate_check"></span>
                                            </label>
                                            <input placeholder="Pulse rate" name="Pulse_rate" id="Pulse_rate"
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Pulse_rate'])) value="{{ $SchoolHealthPhysician['Pulse_rate'] }}"
                                                   @else
                                                   value="{{ old('Pulse_rate') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Respiratory_Rate">Respiratory Rate
                                                <span id="check_respiratory_rate"></span>
                                            </label>
                                            <input placeholder="Respiratory Rate" name="Respiratory_Rate"
                                                   id="Respiratory_Rate" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Respiratory_Rate'])) value="{{ $SchoolHealthPhysician['Respiratory_Rate'] }}"
                                                   @else
                                                   value="{{ old('Respiratory_Rate') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Weight">Weight <span id="Weight1Response1"></span></label>
                                            <input placeholder="Weight" name="Weight" id="Weight" type="number"
                                                   step="any" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Weight'])) value="{{ $SchoolHealthPhysician['Weight'] }}"
                                                   @else
                                                   value="{{ old('Weight') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Height">Height <span id="height1Response1"></span> </label>
                                            <input placeholder="Height" name="Height" id="Height" type="number"
                                                   step="any" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Height'])) value="{{ $SchoolHealthPhysician['Height'] }}"
                                                   @else
                                                   value="{{ old('Height') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="BMI">BMI <span id="bmi_result_1">
                                                </span> </label>
                                            <input placeholder="BMI" name="BMI" id="BMI" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['BMI'])) value="{{ $SchoolHealthPhysician['BMI'] }}"
                                                   @else
                                                   value="{{ old('BMI') }}" @endif
                                                   required readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="General_Appearance">General Appearance</label>
                                            <input placeholder="General Appearance" name="General_Appearance"
                                                   id="General_Appearance" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['General_Appearance'])) value="{{ $SchoolHealthPhysician['General_Appearance'] }}"
                                                   @else
                                                   value="{{ old('General_Appearance') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Skin">Skin</label>
                                            <input placeholder="Skin" name="Skin" id="Skin" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Skin'])) value="{{ $SchoolHealthPhysician['Skin'] }}"
                                                   @else
                                                   value="{{ old('Skin') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Lymph Nodes">Lymph Nodes</label>
                                            <input placeholder="Lymph Nodes" name="Lymph_Nodes" id="Lymph_Nodes"
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Lymph_Nodes'])) value="{{ $SchoolHealthPhysician['Lymph_Nodes'] }}"
                                                   @else
                                                   value="{{ old('Lymph_Nodes') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Head">Head </label>
                                            <input placeholder="Head" name="Head" id="Head" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Head'])) value="{{ $SchoolHealthPhysician['Head'] }}"
                                                   @else
                                                   value="{{ old('Head') }}" @endif
                                                   required/>


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Eyes">Eyes</label>
                                            <input placeholder="Eyes" name="Eyes" id="Eyes" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Eyes'])) value="{{ $SchoolHealthPhysician['Eyes'] }}"
                                                   @else
                                                   value="{{ old('Eyes') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="ENT">ENT</label>
                                            <input placeholder="ENT" name="ENT" id="ENT" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['ENT'])) value="{{ $SchoolHealthPhysician['ENT'] }}"
                                                   @else
                                                   value="{{ old('ENT') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Chest">Chest</label>
                                            <input placeholder="Chest" name="Chest" id="Chest"
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Chest'])) value="{{ $SchoolHealthPhysician['Chest'] }}"
                                                   @else
                                                   value="{{ old('Chest') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Heart">Heart</label>
                                            <input placeholder="Heart" name="Heart" id="Heart"
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Heart'])) value="{{ $SchoolHealthPhysician['Heart'] }}"
                                                   @else
                                                   value="{{ old('Heart') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Abdomen">Abdomen</label>
                                            <input placeholder="Abdomen" name="Abdomen" id="Abdomen"
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Abdomen'])) value="{{ $SchoolHealthPhysician['Abdomen'] }}"
                                                   @else
                                                   value="{{ old('Abdomen') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Extremities">Extremities</label>
                                            <input placeholder="Extremities" name="Extremities" id="Extremities"
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Extremities'])) value="{{ $SchoolHealthPhysician['Extremities'] }}"
                                                   @else
                                                   value="{{ old('Extremities') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Neurologic_Examination">Neurologic Examination</label>
                                            <input placeholder="Neurologic Examination" name="Neurologic_Examination"
                                                   id="Neurologic_Examination" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Neurologic_Examination'])) value="{{ $SchoolHealthPhysician['Neurologic_Examination'] }}"
                                                   @else
                                                   value="{{ old('Neurologic_Examination') }}" @endif
                                                   required/>
                                        </div>
                                    </div>
                                </div>

                                <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" class="img-fluid pdfLogo" alt=""/>
                                
                                <h4 class="text-center mt-3">Diagnosis, Impression and Plan</h4>
                                <div class="form-row box_style">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Problem_List">Problem List</label>
                                            <input placeholder="Problem List" name="Problem_List" id="Problem_List"
                                                   required class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Problem_List'])) value="{{ $SchoolHealthPhysician['Problem_List'] }}"
                                                   @else
                                                   value="{{ old('Problem_List') }}" @endif />


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Impression">Impression</label>
                                            <input placeholder="Impression" name="Impression" id="Impression" required
                                                   class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Impression'])) value="{{ $SchoolHealthPhysician['Impression'] }}"
                                                   @else
                                                   value="{{ old('Impression') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Provisional_Diagnosis">Provisional Diagnosis </label>
                                            @php
                                                $provisionalArray = [];
                                                if (!empty($SchoolHealthPhysician['Provisional_Diagnosis'])) {
                                                    $provisionalArray = explode(
                                                        '|',
                                                        $SchoolHealthPhysician['Provisional_Diagnosis'] ?? '',
                                                    );

                                                    // echo "<PRE>";print_r($provisionalArray);exit;
                                                }
                                            @endphp

                                            <select id="Provisional_Diagnosis" name="Provisional_Diagnosis[]" required
                                                    class="form-control js-states select_multi py-3" multiple>


                                                @if (!empty($ICD10))
                                                    @foreach ($ICD10 as $ICD1)
                                                        @php

                                                            $ICD1_value = $ICD1['code'] . '-' . $ICD1['description'];

                                                        @endphp

                                                        <option value="{{ $ICD1_value }}"
                                                            {{ in_array($ICD1_value, $provisionalArray) ? 'selected' : '' }}>
                                                            {{ $ICD1_value }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="H10.9 Unspecified conjunctivitis"
                                                        {{ in_array('H10.9 Unspecified conjunctivitis', $provisionalArray) ? 'selected' : '' }}>
                                                        H10.9 Unspecified conjunctivitis
                                                    </option>
                                                    <option value="H10.32 Unspecified acute conjunctivitis, left eye"
                                                        {{ in_array('H10.32 Unspecified acute conjunctivitis, left eye', $provisionalArray) ? 'selected' : '' }}>
                                                        H10.32 Unspecified acute conjunctivitis, left eye
                                                    </option>
                                                    <option value="H52.11 Myopia, right eye"
                                                        {{ in_array('H52.11 Myopia, right eye', $provisionalArray) ? 'selected' : '' }}>
                                                        H52.11 Myopia, right eye
                                                    </option>
                                                    <option value="H52.12 Myopia, left eye"
                                                        {{ in_array('H52.12 Myopia, left eye', $provisionalArray) ? 'selected' : '' }}>
                                                        H52.12 Myopia, left eye
                                                    </option>
                                                    <option value="H52.13 Myopia, bilateral"
                                                        {{ in_array('H52.13 Myopia, bilateral', $provisionalArray) ? 'selected' : '' }}>
                                                        H52.13 Myopia, bilateral
                                                    </option>
                                                @endif


                                            </select>


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Investigations_Recommended">Investigations Recommended</label>

                                            <select id="Investigations_Recommended" name="Investigations_Recommended"
                                                    class="form-control" required>
                                                    <option value="">Select</option>
                                                    
                                                    <option value="Labs" @if (
                                                    !empty($SchoolHealthPhysician['Investigations_Recommended']) &&
                                                        $SchoolHealthPhysician['Investigations_Recommended'] == 'Labs') selected @endif>
                                                    Labs
                                                </option>
                                                <option value="Radiology"
                                                        @if (
                                                            !empty($SchoolHealthPhysician['Investigations_Recommended']) &&
                                                                $SchoolHealthPhysician['Investigations_Recommended'] == 'Radiology') selected @endif>
                                                    Radiology
                                                </option>
                                            </select>


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="General_Advice">General Advice & Management Plan</label>
                                            <input placeholder="General Advice & Management Plan" name="General_Advice"
                                                   id="General_Advice" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['General_Advice'])) value="{{ $SchoolHealthPhysician['General_Advice'] }}"
                                                   @else
                                                   value="{{ old('General_Advice') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="First_Aid_Given">First Aid Given</label>

                                            <select id="First_Aid_Given" name="First_Aid_Given" class="form-control"
                                                    required>
                                                    <option value="" @if (empty($SchoolHealthPhysician['First_Aid_Given'])) selected @endif>
                                                        Select</option>
                                                <option value="Yes"
                                                        @if (!empty($SchoolHealthPhysician['First_Aid_Given']) && $SchoolHealthPhysician['First_Aid_Given'] == 'Yes') selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (!empty($SchoolHealthPhysician['First_Aid_Given']) && $SchoolHealthPhysician['First_Aid_Given'] == 'No') selected @endif>
                                                    No
                                                </option>
                                            </select>


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Follow_up_Required">Follow-up Required</label>

                                            <select id="Follow_up_Required" class="form-control" onchange="followUp()"
                                                    name="Follow_up_Required" required>
                                                <option value=""
                                                        @if (empty($SchoolHealthPhysician['Follow_up_Required'])) selected @endif>
                                                    Select
                                                </option>
                                                <option value="Yes"
                                                        @if (!empty($SchoolHealthPhysician['Follow_up_Required']) && $SchoolHealthPhysician['Follow_up_Required'] == 'Yes') selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (!empty($SchoolHealthPhysician['Follow_up_Required']) && $SchoolHealthPhysician['Follow_up_Required'] == 'No') selected @endif>
                                                    No
                                                </option>
                                            </select>


                                        </div>
                                    </div>


                                </div>
                                <div class="form-row d-none box_style" id="follow_up_show">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Reason_for_Follow_up">Reason for Follow-up</label>
                                            <input placeholder="Reason for Follow-up" name="Reason_for_Follow_up"
                                                   id="Reason_for_Follow_up" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Reason_for_Follow_up'])) value="{{ $SchoolHealthPhysician['Reason_for_Follow_up'] }}"
                                                   @else
                                                   value="{{ old('Reason_for_Follow_up') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Follow_up_Date">Follow-up Date</label>
                                            <input type="date" placeholder="Reason for Follow-up"
                                                   name="Follow_up_Date" id="Follow_up_Date" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Follow_up_Date'])) value="{{ $SchoolHealthPhysician['Follow_up_Date'] }}"
                                                   @else
                                                   value="{{ old('Follow_up_Date') }}" @endif />
                                        </div>
                                    </div>
                                </div>

                                
                                <h3 class="text-center mt-3">Refferals</h3>
                                <div class="form-row box_style">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="internal_referrals">Internal Referrals</label>

                                            @php
                                                $internal_referralsArr = [];
                                                if (!empty($SchoolHealthPhysician['internal_referrals'])) {
                                                    $internal_referralsArr = explode(
                                                        '|',
                                                        $SchoolHealthPhysician['internal_referrals'] ?? '',
                                                    );

                                                    // echo "<PRE>";print_r($internal_referralsArr);exit;
                                                }
                                            @endphp

                                            <select id="internal_referrals" name="internal_referrals[]"
                                                    class="form-control js-states select_multi py-3" multiple required>
                                                <option value="Nutritionist"
                                                        @if (in_array('Nutritionist', $internal_referralsArr)) selected @endif>
                                                    Nutritionist
                                                </option>
                                                <option value="Psychologist"
                                                        @if (in_array('Psychologist', $internal_referralsArr)) selected @endif>
                                                    Psychologist
                                                </option>
                                                <option value="Add team lead"
                                                        @if (in_array('Psychologist', $internal_referralsArr)) selected @endif>
                                                    Psychologist
                                                </option>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="external_referrals">External Referrals</label>

                                            @php
                                                $external_referralsArr = [];
                                                if (!empty($SchoolHealthPhysician['external_referrals'])) {
                                                    $external_referralsArr = explode(
                                                        '|',
                                                        $SchoolHealthPhysician['external_referrals'] ?? '',
                                                    );
                                                }
                                            @endphp


                                            <select id="external_referrals" name="external_referrals[]"
                                                    class="form-control js-states select_multi py-3" multiple required
                                                    onchange="showReasonForReferral()">

                                                @if (!empty($ExternalReferralList))
                                                    @foreach ($ExternalReferralList as $ExternalReferralLis)
                                                        <option value="{{ $ExternalReferralLis['name'] }}"
                                                                @if (in_array($ExternalReferralLis['name'], $external_referralsArr)) selected @endif>
                                                            {{ $ExternalReferralLis['name'] }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="Allery and Immunology"
                                                            @if (in_array('Allery and Immunology', $external_referralsArr)) selected @endif>
                                                        Allery and
                                                        Immunology
                                                    </option>
                                                    <option value="Cardiology"
                                                            @if (in_array('Cardiology', $external_referralsArr)) selected @endif>
                                                        Cardiology
                                                    </option>
                                                    <option value="Clinical Psychology"
                                                            @if (in_array('Clinical Psychology', $external_referralsArr)) selected @endif>
                                                        Clinical
                                                        Psychology
                                                    </option>
                                                    <option value="Dentistry"
                                                            @if (in_array('Dentistry', $external_referralsArr)) selected @endif>
                                                        Dentistry
                                                    </option>
                                                    <option value="Dermatology"
                                                            @if (in_array('Dermatology', $external_referralsArr)) selected @endif>
                                                        Dermatology
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 d-none" id="reasonForReferralSection">
                                        <div class="form-group">
                                            <label for="Reason_for_Referral">Reason for Referral</label>
                                            <input placeholder="Reason for Referral" name="Reason_for_Referral"
                                                   id="Reason_for_Referral" class="form-control"
                                                   @if (!empty($SchoolHealthPhysician['Reason_for_Referral'])) value="{{ $SchoolHealthPhysician['Reason_for_Referral'] }}"
                                                   @else
                                                   value="{{ old('Reason_for_Referral') }}" @endif
                                                   required/>
                                        </div>
                                    </div>

                                </div>

                                {{-- <a href="{{ Route('StudentBiodata') }}/{{ $StudentBiodataId }}">
                                <button type="button" class="btn btn-primary prevStep">Previous</button>
                            </a>

                            <button type="submit" name="submit" class="btn btn-primary">Submit</button> --}}


                            </form>

                        </div>


                        <div
                            class="tab-pane fade @if (!empty($NutritionistHistoryEvaluationSection)) active show @endif"
                            id="profile"
                            role="tabpanel" aria-labelledby="profile-tab">

                            <form id="multiStepForm1"
                                  action="{{ route('NutritionistHistoryEvaluationSection') }}/{{ $StudentBiodataId }}}"
                                  method="POST">

                                @csrf

                                <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" class="img-fluid pdfLogo" alt=""/>
                                <h3 class="text-center mt-4">Nutritionist History & Evaluation Section</h3>
                                <div id="chartContainer" style="height: 370px; width: 100%;" class="my-4"></div>
                                
                                <div class="form-row box_style">
                                    <h4 class="mt-4">Anthropometric Measurements</h4>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="height">Height (cm) <span id="height1Response"></label>
                                            <input placeholder="Height (cm)" name="height" required id="height1"
                                                   class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['height'])) value="{{ $NutritionistHistoryEvaluationSection['height'] }}"
                                                   @else
                                                   value="{{ old('height') }}" @endif />
                                        </div>
                                    </div>
                                    <div>
                                        <input type="hidden" name="hidden_age" id="hidden_age"
                                               @if (!empty($monthsDifference)) value="{{ $monthsDifference }}" @endif
                                               readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Weight">Weight (kg) <span id="Weight1Response"> </span></label>
                                            <input placeholder="Weight (kg)" name="Weight" required id="Weight1"
                                                   class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Weight'])) value="{{ $NutritionistHistoryEvaluationSection['Weight'] }}"
                                                   @else
                                                   value="{{ old('Weight') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="BMI">BMI (auto-generated) <span id="bmi_result">
                                                </span> </label>
                                            <input placeholder="BMI (auto-generated)" name="BMI" required
                                                   id="BMI1" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['BMI'])) value="{{ $NutritionistHistoryEvaluationSection['BMI'] }}"
                                                   @else
                                                   value="{{ old('BMI') }}" @endif
                                                   readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="MUAC">MUAC</label>
                                            <input placeholder="MUAC" name="MUAC" required id="MUAC"
                                                   class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['MUAC'])) value="{{ $NutritionistHistoryEvaluationSection['MUAC'] }}"
                                                   @else
                                                   value="{{ old('MUAC') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Ideal_Body_Weight">Ideal Body Weight (IBW)</label>
                                            <input placeholder="Ideal Body Weight (IBW)" name="Ideal_Body_Weight"
                                                   required
                                                   id="Ideal_Body_Weight" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Ideal_Body_Weight'])) value="{{ $NutritionistHistoryEvaluationSection['Ideal_Body_Weight'] }}"
                                                   @else
                                                   value="{{ old('Ideal_Body_Weight') }}" @endif />
                                        </div>
                                    </div>


                                </div>

                                
                                <div class="form-row box_style">
                                    <h4 class="mt-4">Estimated Nutrition Requirements</h4>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Physical_Activity_Level">Physical Activity Level</label>
                                            <input readonly value="Physical Activity Levels"
                                                   placeholder="Physical Activity Level" name="Physical_Activity_Level"
                                                   required id="Physical_Activity_Level" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Physical_Activity_Level'])) value="{{ $NutritionistHistoryEvaluationSection['Physical_Activity_Level'] }}"
                                                   @else
                                                   value="{{ old('Physical_Activity_Level') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Estimated_Energy_Requirement">Estimated Energy
                                                Requirement</label>
                                            <input readonly value="Estimated Energy Requirement"
                                                   placeholder="Estimated Energy Requirement"
                                                   name="Estimated_Energy_Requirement" required
                                                   id="Estimated_Energy_Requirement" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Estimated_Energy_Requirement'])) value="{{ $NutritionistHistoryEvaluationSection['Estimated_Energy_Requirement'] }}"
                                                   @else
                                                   value="{{ old('Estimated_Energy_Requirement') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Daily_Protein_Requirement">Daily Protein Requirement</label>
                                            <input readonly value="Daily Protein Requirement"
                                                   placeholder="Daily Protein Requirement"
                                                   name="Daily_Protein_Requirement"
                                                   required id="Daily_Protein_Requirement" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Daily_Protein_Requirement'])) value="{{ $NutritionistHistoryEvaluationSection['Daily_Protein_Requirement'] }}"
                                                   @else
                                                   value="{{ old('Daily_Protein_Requirement') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Daily_Carbohydrate_Requirement">Daily Carbohydrate
                                                Requirement</label>
                                            <input readonly value="Daily Carbohydrate Requirement"
                                                   placeholder="Daily_Carbohydrate_Requirement"
                                                   name="Daily_Carbohydrate_Requirement" required
                                                   id="Daily_Carbohydrate_Requirement" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Daily_Carbohydrate_Requirement'])) value="{{ $NutritionistHistoryEvaluationSection['Daily_Carbohydrate_Requirement'] }}"
                                                   @else
                                                   value="{{ old('Daily_Carbohydrate_Requirement') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Daily_Fat_Requirement">Daily Fat Requirement</label>
                                            <input readonly value="Daily Fat Requirement"
                                                   placeholder="Daily_Fat_Requirement" name="Daily_Fat_Requirement"
                                                   required
                                                   id="Daily_Fat_Requirement" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Daily_Fat_Requirement'])) value="{{ $NutritionistHistoryEvaluationSection['Daily_Fat_Requirement'] }}"
                                                   @else
                                                   value="{{ old('Daily_Fat_Requirement') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Daily_Fluid_Requirement">Daily Fluid Requirement</label>
                                            <input readonly value="Daily Fluid Requirement"
                                                   placeholder="Daily Fluid Requirement" name="Daily_Fluid_Requirement"
                                                   required id="Daily_Fluid_Requirement" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Daily_Fluid_Requirement'])) value="{{ $NutritionistHistoryEvaluationSection['Daily_Fluid_Requirement'] }}"
                                                   @else
                                                   value="{{ old('Daily_Fluid_Requirement') }}" @endif />
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane">

                                    
                                    <div class="form-row box_style">
                                        <h4 class="mt-4">Dietary Evaluation</h4>
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="Chief_Complaints2">Chief Complaints</label>
                                                <input value="Chief Complaints" placeholder="Chief Complaints"
                                                       name="Chief_Complaints2" required id="Chief_Complaints2"
                                                       class="form-control"
                                                       @if (!empty($NutritionistHistoryEvaluationSection['Chief_Complaints2'])) value="{{ $NutritionistHistoryEvaluationSection['Chief_Complaints2'] }}"
                                                       @else
                                                       value="{{ old('Chief_Complaints2') }}" @endif />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="History_of_Presenting_Complains">History of Presenting
                                                    Complains</label>
                                                <input value="History of Presenting Complains"
                                                       placeholder="History of Presenting Complains"
                                                       name="History_of_Presenting_Complains" required
                                                       id="History_of_Presenting_Complains" class="form-control"
                                                       @if (!empty($NutritionistHistoryEvaluationSection['History_of_Presenting_Complains'])) value="{{ $NutritionistHistoryEvaluationSection['History_of_Presenting_Complains'] }}"
                                                       @else
                                                       value="{{ old('History_of_Presenting_Complains') }}" @endif />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="Past_Medical_History">Past Medical History</label>
                                                <input value="Past Medical History" placeholder="Past Medical History"
                                                       name="Past_Medical_History" required id="Past_Medical_History"
                                                       class="form-control"
                                                       @if (!empty($NutritionistHistoryEvaluationSection['Past_Medical_History'])) value="{{ $NutritionistHistoryEvaluationSection['Past_Medical_History'] }}"
                                                       @else
                                                       value="{{ old('Past_Medical_History') }}" @endif />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label
                                                    for="Medication_Supplements_Allergies_History">Medication/Supplements/Allergies
                                                    History</label>
                                                <input value="Medication/Supplements/Allergies History"
                                                       placeholder="Medication/Supplements/Allergies History"
                                                       name="Medication_Supplements_Allergies_History" required
                                                       id="Medication_Supplements_Allergies_History"
                                                       class="form-control"
                                                       @if (!empty($NutritionistHistoryEvaluationSection['Medication_Supplements_Allergies_History'])) value="{{ $NutritionistHistoryEvaluationSection['Medication_Supplements_Allergies_History'] }}"
                                                       @else
                                                       value="{{ old('Medication_Supplements_Allergies_History') }}" @endif />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="Family_History2">Family History</label>
                                                <input value="Family History" placeholder="Family History"
                                                       name="Family_History2" required id="Family_History2"
                                                       class="form-control"
                                                       @if (!empty($NutritionistHistoryEvaluationSection['Family_History2'])) value="{{ $NutritionistHistoryEvaluationSection['Family_History2'] }}"
                                                       @else
                                                       value="{{ old('Family_History2') }}" @endif />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="Personal_Social_History2">Personal & Social History</label>
                                                <input placeholder="Personal & Social History"
                                                       name="Personal_Social_History2" required
                                                       id="Personal_Social_History2"
                                                       class="form-control"
                                                       value="{{ !empty($NutritionistHistoryEvaluationSection['Personal_Social_History2']) ? $NutritionistHistoryEvaluationSection['Personal_Social_History2'] : old('Personal_Social_History2') }}"/>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="Food_Allergies_and_Intolerances">Food Allergies and
                                                    Intolerances</label>
                                                <input placeholder="Food Allergies and Intolerances"
                                                       name="Food_Allergies_and_Intolerances" required
                                                       id="Food_Allergies_and_Intolerances" class="form-control"
                                                       value="{{ !empty($NutritionistHistoryEvaluationSection['Food_Allergies_and_Intolerances']) ? $NutritionistHistoryEvaluationSection['Food_Allergies_and_Intolerances'] : old('Food_Allergies_and_Intolerances') }}"/>

                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="Appetite">Appetite</label>
                                                <input placeholder="Appetite" name="Appetite" required id="Appetite"
                                                       class="form-control"
                                                       value="{{ !empty($NutritionistHistoryEvaluationSection['Appetite']) ? $NutritionistHistoryEvaluationSection['Appetite'] : old('Appetite') }}"/>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="Recent_Weight_Changes_Weight_History">Recent Weight Changes
                                                    &
                                                    Weight History</label>
                                                <input placeholder="Recent Weight Changes & Weight History"
                                                       name="Recent_Weight_Changes_Weight_History" required
                                                       id="Recent_Weight_Changes_Weight_History" class="form-control"
                                                       value="{{ !empty($NutritionistHistoryEvaluationSection['Recent_Weight_Changes_Weight_History']) ? $NutritionistHistoryEvaluationSection['Recent_Weight_Changes_Weight_History'] : old('Recent_Weight_Changes_Weight_History') }}"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="form-row box_style">
                                    <h4 class="mt-4">24- hour Dietary Recall</h4>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Breakfast">Breakfast <span id="BreakfastAlert"></span></label>

                                            <select id="Breakfast" class="form-control" onchange="showBreakFast()"
                                                    name="Breakfast" required>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Breakfast']) &&
                                                                $NutritionistHistoryEvaluationSection['Breakfast'] == 'Yes') selected
                                                        @elseif(old('Breakfast') == 'Yes')
                                                        selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Breakfast']) &&
                                                                $NutritionistHistoryEvaluationSection['Breakfast'] == 'No') selected
                                                        @elseif(old('Breakfast') == 'No')
                                                        selected @endif>
                                                    No
                                                </option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 d-none" id="showBreakFastDetail">
                                        <div class="form-group">
                                            <label for="breakfast_detail">Detail</label>
                                            <input placeholder="Detail" name="breakfast_detail" id="breakfast_detail"
                                                   class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['breakfast_detail'])) value="{{ $NutritionistHistoryEvaluationSection['breakfast_detail'] }}"
                                                   @else
                                                   value="{{ old('breakfast_detail') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Mid_day_Snack">Mid-day Snack</label>
                                            <select id="Mid_day_Snack" name="Mid_day_Snack" class="form-control"
                                                    onchange="showMidDaySnack()" required>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Mid_day_Snack']) &&
                                                                $NutritionistHistoryEvaluationSection['Mid_day_Snack'] == 'Yes') selected
                                                        @elseif(old('Mid_day_Snack') == 'Yes')
                                                        selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Mid_day_Snack']) &&
                                                                $NutritionistHistoryEvaluationSection['Mid_day_Snack'] == 'No') selected
                                                        @elseif(old('Mid_day_Snack') == 'No')
                                                        selected @endif>
                                                    No
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 d-none" id="showMidDaySnackDetail">
                                        <div class="form-group">
                                            <label for="MidDaySnackDetail">Detail</label>
                                            <input placeholder="Detail" name="MidDaySnackDetail" id="MidDaySnackDetail"
                                                   class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['MidDaySnackDetail'])) value="{{ $NutritionistHistoryEvaluationSection['MidDaySnackDetail'] }}"
                                                   @else
                                                   value="{{ old('MidDaySnackDetail') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Lunch">Lunch <span id="LunchAlert"></span></label>
                                            <select id="Lunch" class="form-control" onchange="showLunchFunc()"
                                                    name="Lunch" required>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Lunch']) && $NutritionistHistoryEvaluationSection['Lunch'] == 'Yes') selected
                                                        @elseif(old('Lunch') == 'Yes')
                                                        selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Lunch']) && $NutritionistHistoryEvaluationSection['Lunch'] == 'No') selected
                                                        @elseif(old('Lunch') == 'No')
                                                        selected @endif>
                                                    No
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 d-none" id="showlunchdetail">
                                        <div class="form-group">
                                            <label for="lunchDetail">Detail</label>
                                            <input placeholder="Detail" name="lunchDetail" id="lunchDetail"
                                                   class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['lunchDetail'])) value="{{ $NutritionistHistoryEvaluationSection['lunchDetail'] }}"
                                                   @else
                                                   value="{{ old('lunchDetail') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Evening_Snack">Evening Snack</label>
                                            <select id="Evening_Snack" class="form-control" name="Evening_Snack"
                                                    onchange="showEveningSnackFunc()" required>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Evening_Snack']) &&
                                                                $NutritionistHistoryEvaluationSection['Evening_Snack'] == 'Yes') selected
                                                        @elseif(old('Evening_Snack') == 'Yes')
                                                        selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Evening_Snack']) &&
                                                                $NutritionistHistoryEvaluationSection['Evening_Snack'] == 'No') selected
                                                        @elseif(old('Evening_Snack') == 'No')
                                                        selected @endif>
                                                    No
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 d-none" id="showEveningSnackDetail">
                                        <div class="form-group">
                                            <label for="EveningSnackDetail">Detail</label>
                                            <input placeholder="Detail" name="EveningSnackDetail"
                                                   id="EveningSnackDetail"
                                                   class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['EveningSnackDetail'])) value="{{ $NutritionistHistoryEvaluationSection['EveningSnackDetail'] }}"
                                                   @else
                                                   value="{{ old('EveningSnackDetail') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Dinner">Dinner <span id="DinnerAlert"></span></label>
                                            <select id="Dinner" class="form-control" onchange="showDinnerFunc()"
                                                    name="Dinner" required>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Dinner']) && $NutritionistHistoryEvaluationSection['Dinner'] == 'Yes') selected
                                                        @elseif(old('Dinner') == 'Yes')
                                                        selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Dinner']) && $NutritionistHistoryEvaluationSection['Dinner'] == 'No') selected
                                                        @elseif(old('Dinner') == 'No')
                                                        selected @endif>
                                                    No
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 d-none" id="showDinner">
                                        <div class="form-group">
                                            <label for="Dinner">Detail</label>
                                            <input placeholder="Detail" name="DinnerDetails" id="DinnerDetails"
                                                   class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['DinnerDetails'])) value="{{ $NutritionistHistoryEvaluationSection['DinnerDetails'] }}"
                                                   @else
                                                   value="{{ old('DinnerDetails') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Bed_time_snack">Bed-time snack</label>
                                            <select id="Bed_time_snack" class="form-control" name="Bed_time_snack"
                                                    required>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Bed_time_snack']) &&
                                                                $NutritionistHistoryEvaluationSection['Bed_time_snack'] == 'Yes') selected
                                                        @elseif(old('Bed_time_snack') == 'Yes')
                                                        selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Bed_time_snack']) &&
                                                                $NutritionistHistoryEvaluationSection['Bed_time_snack'] == 'No') selected
                                                        @elseif(old('Bed_time_snack') == 'No')
                                                        selected @endif>
                                                    No
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Biochemical_Laboratory_test_Reports">Biochemical / Laboratory
                                                Test
                                                Reports</label>
                                            <input placeholder="Biochemical / Laboratory Test Reports"
                                                   name="Biochemical_Laboratory_test_Reports"
                                                   id="Biochemical_Laboratory_test_Reports" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Biochemical_Laboratory_test_Reports'])) value="{{ $NutritionistHistoryEvaluationSection['Biochemical_Laboratory_test_Reports'] }}"
                                                   @else
                                                   value="{{ old('Biochemical_Laboratory_test_Reports') }}" @endif />
                                        </div>
                                    </div>

                                </div>

                                
                                
                                <div class="form-row box_style">
                                    <h4 class="mt-4">Clinical Examination</h4>
                                    <h5 class="mt-4 text-center">Physical Appearance</h5>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Skin">Skin</label>
                                            <select id="Skin" class="form-control" name="Skin" required>
                                                <option value="">Select</option>
                                                <option value="Normal"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Skin']) && $NutritionistHistoryEvaluationSection['Skin'] == 'Normal') selected
                                                        @elseif(old('Skin') == 'Normal')
                                                        selected @endif>
                                                    Normal
                                                </option>
                                                <option value="Dry"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Skin']) && $NutritionistHistoryEvaluationSection['Skin'] == 'Dry') selected
                                                        @elseif(old('Skin') == 'Dry')
                                                        selected @endif>
                                                    Dry
                                                </option>
                                                <option value="Scaly"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Skin']) && $NutritionistHistoryEvaluationSection['Skin'] == 'Scaly') selected
                                                        @elseif(old('Skin') == 'Scaly')
                                                        selected @endif>
                                                    Scaly
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Eyes">Eyes</label>
                                            <select id="Eyes" name="Eyes" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="Normal"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Eyes']) && $NutritionistHistoryEvaluationSection['Eyes'] == 'Normal') selected
                                                        @elseif(old('Eyes') == 'Normal')
                                                        selected @endif>
                                                    Normal
                                                </option>
                                                <option value="Pale"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Eyes']) && $NutritionistHistoryEvaluationSection['Eyes'] == 'Pale') selected
                                                        @elseif(old('Eyes') == 'Pale')
                                                        selected @endif>
                                                    Pale
                                                </option>
                                                <option value="Redness"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Eyes']) && $NutritionistHistoryEvaluationSection['Eyes'] == 'Redness') selected
                                                        @elseif(old('Eyes') == 'Redness')
                                                        selected @endif>
                                                    Redness
                                                </option>
                                                <option value="Yellow"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Eyes']) && $NutritionistHistoryEvaluationSection['Eyes'] == 'Yellow') selected
                                                        @elseif(old('Eyes') == 'Yellow')
                                                        selected @endif>
                                                    Yellow
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Lips">Lips</label>
                                            <select id="Lips" name="Lips" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="Normal"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Lips']) && $NutritionistHistoryEvaluationSection['Lips'] == 'Normal') selected
                                                        @elseif(old('Lips') == 'Normal')
                                                        selected @endif>
                                                    Normal
                                                </option>
                                                <option value="Dry"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Lips']) && $NutritionistHistoryEvaluationSection['Lips'] == 'Dry') selected
                                                        @elseif(old('Lips') == 'Dry')
                                                        selected @endif>
                                                    Dry
                                                </option>
                                                <option value="Dark Colored"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Lips']) &&
                                                                $NutritionistHistoryEvaluationSection['Lips'] == 'Dark Colored') selected
                                                        @elseif(old('Lips') == 'Dark Colored')
                                                        selected @endif>
                                                    Dark Colored
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Nails">Nails</label>
                                            <select id="Nails" name="Nails" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="Normal"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Nails']) &&
                                                                $NutritionistHistoryEvaluationSection['Nails'] == 'Normal') selected
                                                        @elseif(old('Nails') == 'Normal')
                                                        selected @endif>
                                                    Normal
                                                </option>
                                                <option value="Brittle"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Nails']) &&
                                                                $NutritionistHistoryEvaluationSection['Nails'] == 'Brittle') selected
                                                        @elseif(old('Nails') == 'Brittle')
                                                        selected @endif>
                                                    Brittle
                                                </option>
                                                <option value="Translucent"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Nails']) &&
                                                                $NutritionistHistoryEvaluationSection['Nails'] == 'Translucent') selected
                                                        @elseif(old('Nails') == 'Translucent')
                                                        selected @endif>
                                                    Translucent
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Hair">Hair</label>
                                            <select id="Hair" name="Hair" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="Normal"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Hair']) && $NutritionistHistoryEvaluationSection['Hair'] == 'Normal') selected
                                                        @elseif(old('Hair') == 'Normal')
                                                        selected @endif>
                                                    Normal
                                                </option>
                                                <option value="Dry"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Hair']) && $NutritionistHistoryEvaluationSection['Hair'] == 'Dry') selected
                                                        @elseif(old('Hair') == 'Dry')
                                                        selected @endif>
                                                    Dry
                                                </option>
                                                <option value="Brittle"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Hair']) && $NutritionistHistoryEvaluationSection['Hair'] == 'Brittle') selected
                                                        @elseif(old('Hair') == 'Brittle')
                                                        selected @endif>
                                                    Brittle
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Scalp">Scalp</label>
                                            <select id="Scalp" name="Scalp" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="Normal"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Scalp']) &&
                                                                $NutritionistHistoryEvaluationSection['Scalp'] == 'Normal') selected
                                                        @elseif (old('Scalp') == 'Normal')
                                                        selected @endif>
                                                    Normal
                                                </option>
                                                <option value="Dry"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Scalp']) && $NutritionistHistoryEvaluationSection['Scalp'] == 'Dry') selected
                                                        @elseif (old('Scalp') == 'Dry')
                                                        selected @endif>
                                                    Dry
                                                </option>
                                                <option value="Scaly"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Scalp']) && $NutritionistHistoryEvaluationSection['Scalp'] == 'Scaly') selected
                                                        @elseif (old('Scalp') == 'Scaly')
                                                        selected @endif>
                                                    Scaly
                                                </option>
                                                <option value="Oily"
                                                        @if (!empty($NutritionistHistoryEvaluationSection['Scalp']) && $NutritionistHistoryEvaluationSection['Scalp'] == 'Oily') selected
                                                        @elseif (old('Scalp') == 'Oily')
                                                        selected @endif>
                                                    Oily
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                
                                <div class="form-row box_style">
                                    <h4 class="text-center mt-3">Diagnosis, Impression and Plan</h4>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Problem_List1">Problem List</label>
                                            <input placeholder="Problem List" name="Problem_List1" id="Problem_List1"
                                                   required class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Problem_List1'])) value="{{ $NutritionistHistoryEvaluationSection['Problem_List1'] }}"
                                                   @else
                                                   value="{{ old('Problem_List1') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Impression1">Impression</label>
                                            <input placeholder="Impression" name="Impression1" id="Impression1" required
                                                   class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Impression1'])) value="{{ $NutritionistHistoryEvaluationSection['Impression1'] }}"
                                                   @else
                                                   value="{{ old('Impression1') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Provisional_Diagnosis1">Provisional Diagnosis</label><br>
                                            @php
                                                $provisionalArray = [];
                                                if (
                                                    !empty(
                                                        $NutritionistHistoryEvaluationSection['Provisional_Diagnosis1']
                                                    )
                                                ) {
                                                    $provisionalArray = explode(
                                                        '|',
                                                        $NutritionistHistoryEvaluationSection['Provisional_Diagnosis1'],
                                                    );
                                                }
                                            @endphp
                                            <select id="Provisional_Diagnosis1" name="Provisional_Diagnosis1[]" required
                                                    class="form-control js-states select_multi py-3" multiple>

                                                @if (!empty($ICD10))
                                                    @foreach ($ICD10 as $ICD1)
                                                        @php

                                                            $ICD1_value = $ICD1['code'] . '-' . $ICD1['description'];

                                                        @endphp

                                                        <option value="{{ $ICD1_value }}"
                                                            {{ in_array($ICD1_value, $provisionalArray) ? 'selected' : '' }}>
                                                            {{ $ICD1_value }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="H10.9 Unspecified conjunctivitis"
                                                        {{ in_array('H10.9 Unspecified conjunctivitis', $provisionalArray) ? 'selected' : '' }}>
                                                        H10.9 Unspecified conjunctivitis
                                                    </option>
                                                    <option value="H10.32 Unspecified acute conjunctivitis, left eye"
                                                        {{ in_array('H10.32 Unspecified acute conjunctivitis, left eye', $provisionalArray) ? 'selected' : '' }}>
                                                        H10.32 Unspecified acute conjunctivitis, left eye
                                                    </option>
                                                    <option value="H52.11 Myopia, right eye"
                                                        {{ in_array('H52.11 Myopia, right eye', $provisionalArray) ? 'selected' : '' }}>
                                                        H52.11 Myopia, right eye
                                                    </option>
                                                    <option value="H52.12 Myopia, left eye"
                                                        {{ in_array('H52.12 Myopia, left eye', $provisionalArray) ? 'selected' : '' }}>
                                                        H52.12 Myopia, left eye
                                                    </option>
                                                    <option value="H52.13 Myopia, bilateral"
                                                        {{ in_array('H52.13 Myopia, bilateral', $provisionalArray) ? 'selected' : '' }}>
                                                        H52.13 Myopia, bilateral
                                                    </option>
                                                @endif

                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="General_Advice1">General Advice & Management Plan</label>
                                            <input placeholder="General Advice & Management Plan" name="General_Advice1"
                                                   id="General_Advice1" class="form-control" required
                                                   @if (!empty($NutritionistHistoryEvaluationSection['General_Advice1'])) value="{{ $NutritionistHistoryEvaluationSection['General_Advice1'] }}"
                                                   @else
                                                   value="{{ old('General_Advice1') }}" @endif />
                                        </div>
                                    </div>


                                </div>

                                
                                <div class="form-row box_style">
                                    <h4 class="mt-4 text-center">Diet Plan</h4>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="diet_breakfast">Breakfast</label>
                                            <input placeholder="Breakfast" name="diet_breakfast" id="diet_breakfast"
                                                   class="form-control" required
                                                   @if (!empty($NutritionistHistoryEvaluationSection['diet_breakfast'])) value="{{ $NutritionistHistoryEvaluationSection['diet_breakfast'] }}"
                                                   @else
                                                   value="{{ old('diet_breakfast') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="diet_snack">Snack</label>
                                            <input placeholder="Snack" name="diet_snack" id="diet_snack"
                                                   class="form-control" required
                                                   @if (!empty($NutritionistHistoryEvaluationSection['diet_snack'])) value="{{ $NutritionistHistoryEvaluationSection['diet_snack'] }}"
                                                   @else
                                                   value="{{ old('diet_snack') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="diet_lunch">Lunch</label>
                                            <input placeholder="Lunch" name="diet_lunch" id="diet_lunch"
                                                   class="form-control" required
                                                   @if (!empty($NutritionistHistoryEvaluationSection['diet_lunch'])) value="{{ $NutritionistHistoryEvaluationSection['diet_lunch'] }}"
                                                   @else
                                                   value="{{ old('diet_lunch') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="diet_dinner">Dinner</label>
                                            <input placeholder="Dinner" name="diet_dinner" id="diet_dinner"
                                                   class="form-control" required
                                                   @if (!empty($NutritionistHistoryEvaluationSection['diet_dinner'])) value="{{ $NutritionistHistoryEvaluationSection['diet_dinner'] }}"
                                                   @else
                                                   value="{{ old('diet_dinner') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="diet_bedtime">Bedtime</label>
                                            <input type="time" placeholder="Bedtime" name="diet_bedtime"
                                                   id="diet_bedtime" class="form-control" required
                                                   @if (!empty($NutritionistHistoryEvaluationSection['diet_bedtime'])) value="{{ $NutritionistHistoryEvaluationSection['diet_bedtime'] }}"
                                                   @else
                                                   value="{{ old('diet_bedtime') }}" @endif />
                                        </div>
                                    </div>
                                </div>

                                <hr>


                                <div class="form-row box_style">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Follow_up_Required1">Follow-up Required</label>
                                            <select id="Follow_up_Required1" name="Follow_up_Required1" 
                                                    class="form-control" onchange="followUp1()" required>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Follow_up_Required1']) &&
                                                                $NutritionistHistoryEvaluationSection['Follow_up_Required1'] == 'Yes') selected
                                                        @elseif(old('Follow_up_Required1') == 'Yes')
                                                        selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (
                                                            !empty($NutritionistHistoryEvaluationSection['Follow_up_Required1']) &&
                                                                $NutritionistHistoryEvaluationSection['Follow_up_Required1'] == 'No') selected
                                                        @elseif(old('Follow_up_Required1') == 'No')
                                                        selected @endif>
                                                    No
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row d-none box_style" id="follow_up_show1">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Reason_for_Follow_up1">Reason for Follow-up</label>
                                            <input placeholder="Reason for Follow-up" name="Reason_for_Follow_up1"
                                                   id="Reason_for_Follow_up1" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Reason_for_Follow_up1'])) value="{{ $NutritionistHistoryEvaluationSection['Reason_for_Follow_up1'] }}"
                                                   @else
                                                   value="{{ old('Reason_for_Follow_up1') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Follow_up_Date1">Follow-up Date</label>
                                            <input type="date" placeholder="Reason for Follow-up"
                                                   name="Follow_up_Date1" id="Follow_up_Date1" class="form-control"
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Follow_up_Date1'])) value="{{ $NutritionistHistoryEvaluationSection['Follow_up_Date1'] }}"
                                                   @else
                                                   value="{{ old('Follow_up_Date1') }}" @endif />
                                        </div>
                                    </div>
                                </div>

                                <h3>Refferals</h3>

                                <div class="form-row box_style">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="internal_referrals1">Internal Referrals</label>

                                            <select id="internal_referrals1" name="internal_referrals1[]" required
                                                    class="form-control js-states select_multi py-3" multiple>


                                                @php
                                                    $selectedValues = [];
                                                    if (
                                                        !empty(
                                                            $NutritionistHistoryEvaluationSection['internal_referrals1']
                                                        )
                                                    ) {
                                                        $selectedValues = explode(
                                                            '|',
                                                            $NutritionistHistoryEvaluationSection[
                                                                'internal_referrals1'
                                                            ] ?? '',
                                                        );
                                                    }
                                                @endphp


                                                <option value="Nutritionist"
                                                        @if (in_array('Nutritionist', $selectedValues)) selected @endif>
                                                    Nutritionist
                                                </option>
                                                <option value="Psychologist"
                                                        @if (in_array('Psychologist', $selectedValues)) selected @endif>
                                                    Psychologist
                                                </option>
                                                <option value="School Health Physician"
                                                        @if (in_array('School Health Physician', $selectedValues)) selected @endif>
                                                    School Health
                                                    Physician
                                                </option>
                                                <option value="Not Required"
                                                        @if (in_array('Not Required', $selectedValues)) selected @endif>
                                                    Not Required
                                                </option>
                                              
                                                
                                            </select>


                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="external_referrals1">External Referrals</label>
                                            <select id="external_referrals1" name="external_referrals1[]" required
                                                    class="form-control js-states select_multi py-3" multiple
                                                    onchange="showReasonForReferral1()">
                                                @php
                                                    $selectedValues = [];
                                                    if (
                                                        !empty(
                                                            $NutritionistHistoryEvaluationSection['external_referrals1']
                                                        )
                                                    ) {
                                                        $selectedValues = explode(
                                                            '|',
                                                            $NutritionistHistoryEvaluationSection[
                                                                'external_referrals1'
                                                            ] ?? '',
                                                        );
                                                    }
                                                @endphp



                                                @if (!empty($ExternalReferralList))
                                                    @foreach ($ExternalReferralList as $ExternalReferralLis)
                                                        <option value="{{ $ExternalReferralLis['name'] }}"
                                                                @if (in_array($ExternalReferralLis['name'], $selectedValues)) selected @endif>
                                                            {{ $ExternalReferralLis['name'] }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="Allery and Immunology"
                                                            @if (in_array('Allery and Immunology', $selectedValues)) selected @endif>
                                                        Allery and Immunology
                                                    </option>
                                                    <option value="Cardiology"
                                                            @if (in_array('Cardiology', $selectedValues)) selected @endif>
                                                        Cardiology
                                                    </option>
                                                    <option value="Clinical Psychology"
                                                            @if (in_array('Clinical Psychology', $selectedValues)) selected @endif>
                                                        Clinical Psychology
                                                    </option>
                                                    <option value="Dentistry"
                                                            @if (in_array('Dentistry', $selectedValues)) selected @endif>
                                                        Dentistry
                                                    </option>
                                                    <option value="Dermatology"
                                                            @if (in_array('Dermatology', $selectedValues)) selected @endif>
                                                        Dermatology
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 d-none" id="reasonForReferralSection1">
                                        <div class="form-group">
                                            <label for="Reason_for_Referral1">Reason for Referral</label>
                                            <input placeholder="Reason for Referral" name="Reason_for_Referral1"
                                                   id="Reason_for_Referral1" class="form-control" required
                                                   @if (!empty($NutritionistHistoryEvaluationSection['Reason_for_Referral1'])) value="{{ $NutritionistHistoryEvaluationSection['Reason_for_Referral1'] }}"
                                                   @else
                                                   value="{{ old('Reason_for_Referral1') }}" @endif />
                                        </div>
                                    </div>

                                </div>


                                {{-- <a href="{{ Route('StudentBiodata') }}">
                                <button type="button" class="btn btn-primary prevStep">Previous</button>
                            </a>

                            <button type="submit" name="submit" class="btn btn-primary">Submit</button> --}}


                            </form>

                        </div>


                        <div
                            class="tab-pane fade @if (!empty($PsychologistHistoryAssessmentSection)) active show @endif"
                            id="contact" role="tabpanel" aria-labelledby="contact-tab">

                            <form id="multiStepForm"
                                  action="{{ route('PsychologistHistoryAssessmentSection') }}/{{ $StudentBiodataId }}}"
                                  method="POST">
                                @csrf

                                <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" class="img-fluid pdfLogo" alt=""/>
                                <h3 class="text-center mt-4">Psychologist History & Assessment Section</h3>

                                <div class="form-row mt-5 box_style">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Identifying_Personal_Information">Identifying Personal
                                                Information</label>
                                            <input placeholder="Identifying Personal Information"
                                                   name="Identifying_Personal_Information"
                                                   id="Identifying_Personal_Information" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Identifying_Personal_Information'])) value="{{ $PsychologistHistoryAssessmentSection['Identifying_Personal_Information'] }}"
                                                   @else
                                                   value="{{ old('Identifying_Personal_Information') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Referral_Source">Referral Source</label>
                                            <input placeholder="Referral Source" name="Referral_Source"
                                                   id="Referral_Source" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Referral_Source'])) value="{{ $PsychologistHistoryAssessmentSection['Referral_Source'] }}"
                                                   @else
                                                   value="{{ old('Referral_Source') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Chief_Complaints3">Chief Complaints</label>
                                            <input placeholder="Chief Complaints" name="Chief_Complaints3"
                                                   id="Chief_Complaints3" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Chief_Complaints3'])) value="{{ $PsychologistHistoryAssessmentSection['Chief_Complaints3'] }}"
                                                   @else
                                                   value="{{ old('Chief_Complaints3') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="History_of_Presenting_Complaints2">History of Presenting
                                                Complaints</label>
                                            <input placeholder="History of Presenting Complaints"
                                                   name="History_of_Presenting_Complaints2"
                                                   id="History_of_Presenting_Complaints2" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['History_of_Presenting_Complaints2'])) value="{{ $PsychologistHistoryAssessmentSection['History_of_Presenting_Complaints2'] }}"
                                                   @else
                                                   value="{{ old('History_of_Presenting_Complaints2') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Investigations_Laboratory_Test_Reports2">Investigations /
                                                Laboratory Test Reports</label>
                                            <input placeholder="Investigations / Laboratory Test Reports"
                                                   name="Investigations_Laboratory_Test_Reports2"
                                                   id="Investigations_Laboratory_Test_Reports2" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Investigations_Laboratory_Test_Reports2'])) value="{{ $PsychologistHistoryAssessmentSection['Investigations_Laboratory_Test_Reports2'] }}"
                                                   @else
                                                   value="{{ old('Investigations_Laboratory_Test_Reports2') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Past_Medical_Psychiatric_History">Past Medical & Psychiatric
                                                History</label>
                                            <input placeholder="Past Medical & Psychiatric History"
                                                   name="Past_Medical_Psychiatric_History"
                                                   id="Past_Medical_Psychiatric_History" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Past_Medical_Psychiatric_History'])) value="{{ $PsychologistHistoryAssessmentSection['Past_Medical_Psychiatric_History'] }}"
                                                   @else
                                                   value="{{ old('Past_Medical_Psychiatric_History') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Medication_History_Allergies">Medication History &
                                                Allergies</label>
                                            <input placeholder="Medication History & Allergies"
                                                   name="Medication_History_Allergies" id="Medication_History_Allergies"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Medication_History_Allergies'])) value="{{ $PsychologistHistoryAssessmentSection['Medication_History_Allergies'] }}"
                                                   @else
                                                   value="{{ old('Past_Medical_Psychiatric_History') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Family_History3">Family History</label>
                                            <input placeholder="Family History" name="Family_History3"
                                                   id="Family_History3" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Medication_History_Allergies'])) value="{{ $PsychologistHistoryAssessmentSection['Medication_History_Allergies'] }}"
                                                   @else
                                                   value="{{ old('Past_Medical_Psychiatric_History') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Personal_Social_History3">Personal & Social History</label>
                                            <input placeholder="Personal & Social History"
                                                   name="Personal_Social_History3" id="Personal_Social_History3"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Personal_Social_History3'])) value="{{ $PsychologistHistoryAssessmentSection['Personal_Social_History3'] }}"
                                                   @else
                                                   value="{{ old('Personal_Social_History3') }}" @endif />
                                        </div>
                                    </div>
                                </div>

                                <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" class="img-fluid pdfLogo" alt=""/>

                                <h4 class="text-center mt-4">Mental Status Examination</h4>

                                <div class="form-row box_style">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Appearance_Behavior">Appearance & Behavior</label>
                                            <input placeholder="Appearance & Behavior" name="Appearance_Behavior"
                                                   id="Appearance_Behavior" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Appearance_Behavior'])) value="{{ $PsychologistHistoryAssessmentSection['Appearance_Behavior'] }}"
                                                   @else
                                                   value="{{ old('Appearance_Behavior') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Attitude_toward_the_examiner">Attitude toward the
                                                examiner</label>
                                            <input placeholder="Attitude toward the examiner"
                                                   name="Attitude_toward_the_examiner" id="Attitude_toward_the_examiner"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Attitude_toward_the_examiner'])) value="{{ $PsychologistHistoryAssessmentSection['Attitude_toward_the_examiner'] }}"
                                                   @else
                                                   value="{{ old('Attitude_toward_the_examiner') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Speech">Speech</label>
                                            <input placeholder="Speech" name="Speech" id="Speech"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Speech'])) value="{{ $PsychologistHistoryAssessmentSection['Speech'] }}"
                                                   @else
                                                   value="{{ old('Attitude_toward_the_examiner') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Mood">Mood</label>
                                            <input placeholder="Mood" name="Mood" id="Mood"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Mood'])) value="{{ $PsychologistHistoryAssessmentSection['Mood'] }}"
                                                   @else
                                                   value="{{ old('Mood') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Affect">Affect</label>
                                            @php
                                                $selectedValues = [];
                                                if (!empty($PsychologistHistoryAssessmentSection['Affect'])) {
                                                    $selectedValues = explode(
                                                        '|',
                                                        $PsychologistHistoryAssessmentSection['Affect'],
                                                    );
                                                }
                                            @endphp

                                            <select class="form-control" id="Affect" name="Affect">
                                                <option value="Expansive (Contagious)"
                                                        @if (in_array('Expansive (Contagious)', $selectedValues)) selected @endif>
                                                    Expansive (Contagious)
                                                </option>
                                                <option value="Euthymic (Normal)"
                                                        @if (in_array('Euthymic (Normal)', $selectedValues)) selected @endif>
                                                    Euthymic (Normal)
                                                </option>
                                                <option value="Constricted (Limited Variation)"
                                                        @if (in_array('Constricted (Limited Variation)', $selectedValues)) selected @endif>
                                                    Constricted (Limited Variation)
                                                </option>
                                                <option value="Blunted (Minimal Variation)"
                                                        @if (in_array('Blunted (Minimal Variation)', $selectedValues)) selected @endif>
                                                    Blunted (Minimal Variation)
                                                </option>
                                                <option value="Flat (No Variation)"
                                                        @if (in_array('Flat (No Variation)', $selectedValues)) selected @endif>
                                                    Flat (No Variation)
                                                </option>
                                                <option value="Inappropriate"
                                                        @if (in_array('Inappropriate', $selectedValues)) selected @endif>
                                                    Inappropriate
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Thought_process_content">Thought Process & Content</label>
                                            <input placeholder="Thought Process & Content"
                                                   name="Thought_process_content" id="Thought_process_content"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Thought_process_content'])) value="{{ $PsychologistHistoryAssessmentSection['Thought_process_content'] }}"
                                                   @else
                                                   value="{{ old('Thought_process_content') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Perceptions">Perceptions</label>
                                            <input placeholder="Perceptions" name="Perceptions" id="Perceptions"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Perceptions'])) value="{{ $PsychologistHistoryAssessmentSection['Perceptions'] }}"
                                                   @else
                                                   value="{{ old('Perceptions') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Delusions">Delusions</label>
                                            <input placeholder="Delusions" name="Delusions" id="Delusions"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Delusions'])) value="{{ $PsychologistHistoryAssessmentSection['Delusions'] }}"
                                                   @else
                                                   value="{{ old('Delusions') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Cognitive_Function">Cognitive Function</label>
                                            <input placeholder="Cognitive Function" name="Cognitive_Function"
                                                   id="Cognitive_Function" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Cognitive_Function'])) value="{{ $PsychologistHistoryAssessmentSection['Cognitive_Function'] }}"
                                                   @else
                                                   value="{{ old('Cognitive_Function') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Insight">Insight</label>
                                            <input placeholder="Insight" name="Insight" id="Insight"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Insight'])) value="{{ $PsychologistHistoryAssessmentSection['Insight'] }}"
                                                   @else
                                                   value="{{ old('Insight') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Judgement">Judgement</label>
                                            <input placeholder="Judgement" name="Judgement" id="Judgement"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Judgement'])) value="{{ $PsychologistHistoryAssessmentSection['Judgement'] }}"
                                                   @else
                                                   value="{{ old('Judgement') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Impulsivity">Impulsivity</label>
                                            <input placeholder="Impulsivity" name="Impulsivity" id="Impulsivity"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Impulsivity'])) value="{{ $PsychologistHistoryAssessmentSection['Impulsivity'] }}"
                                                   @else
                                                   value="{{ old('Impulsivity') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Reliability">Reliability</label>
                                            <input placeholder="Reliability" name="Reliability" id="Reliability"
                                                   class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Reliability'])) value="{{ $PsychologistHistoryAssessmentSection['Reliability'] }}"
                                                   @else
                                                   value="{{ old('Reliability') }}" @endif />
                                        </div>
                                    </div>
                                </div>

                                <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" class="img-fluid pdfLogo" alt=""/>
                                <h4 class="text-center mt-3">Diagnosis, Impression and Plan</h4>

                                <div class="form-row box_style">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Problem_List2">Problem List</label>
                                            <input placeholder="Problem List" name="Problem_List2" id="Problem_List2"
                                                   required class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Problem_List2'])) value="{{ $PsychologistHistoryAssessmentSection['Problem_List2'] }}"
                                                   @else
                                                   value="{{ old('Problem_List2') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Impression2">Impression</label>
                                            <input placeholder="Impression" name="Impression2" id="Impression2"
                                                   required class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Impression2'])) value="{{ $PsychologistHistoryAssessmentSection['Impression2'] }}"
                                                   @else
                                                   value="{{ old('Impression2') }}" @endif />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Provisional_Diagnosis2">Provisional Diagnosis</label><br>
                                            <select name="Provisional_Diagnosis2[]" id="Provisional_Diagnosis2" required
                                                    class="form-control js-states select_multi py-3" multiple>

                                                @php
                                                    $selectedDiagnosis = [];
                                                    if (
                                                        !empty(
                                                            $PsychologistHistoryAssessmentSection[
                                                                'Provisional_Diagnosis2'
                                                            ]
                                                        )
                                                    ) {
                                                        $selectedDiagnosis = explode(
                                                            '|',
                                                            $PsychologistHistoryAssessmentSection[
                                                                'Provisional_Diagnosis2'
                                                            ],
                                                        );
                                                    }
                                                @endphp


                                                @if (!empty($ICD10))
                                                    @foreach ($ICD10 as $ICD1)
                                                        @php

                                                            $ICD1_value = $ICD1['code'] . '-' . $ICD1['description'];

                                                        @endphp

                                                        <option value="{{ $ICD1_value }}"
                                                            {{ in_array($ICD1_value, $selectedDiagnosis) ? 'selected' : '' }}>
                                                            {{ $ICD1_value }}</option>
                                                    @endforeach
                                                @else
                                                    <option
                                                        value="H10.9 Unspecified conjunctivitis"{{ in_array('H10.9 Unspecified conjunctivitis', $selectedDiagnosis) ? ' selected' : '' }}>
                                                        H10.9 Unspecified conjunctivitis
                                                    </option>
                                                    <option
                                                        value="H10.32 Unspecified acute conjunctivitis, left eye"{{ in_array('H10.32 Unspecified acute conjunctivitis, left eye', $selectedDiagnosis) ? ' selected' : '' }}>
                                                        H10.32 Unspecified acute conjunctivitis, left eye
                                                    </option>
                                                    <option
                                                        value="H52.11 Myopia, right eye"{{ in_array('H52.11 Myopia, right eye', $selectedDiagnosis) ? ' selected' : '' }}>
                                                        H52.11 Myopia, right eye
                                                    </option>
                                                    <option
                                                        value="H52.12 Myopia, left eye"{{ in_array('H52.12 Myopia, left eye', $selectedDiagnosis) ? ' selected' : '' }}>
                                                        H52.12 Myopia, left eye
                                                    </option>
                                                    <option
                                                        value="H52.13 Myopia, bilateral"{{ in_array('H52.13 Myopia, bilateral', $selectedDiagnosis) ? ' selected' : '' }}>
                                                        H52.13 Myopia, bilateral
                                                    </option>
                                                @endif
                                            </select>


                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="General_Advice2">General Advice & Management Plan</label>
                                            <input placeholder="General Advice & Management Plan" name="General_Advice2"
                                                   id="General_Advice2" class="form-control" required
                                                   @if (!empty($PsychologistHistoryAssessmentSection['General_Advice2'])) value="{{ $PsychologistHistoryAssessmentSection['General_Advice2'] }}"
                                                   @else
                                                   value="{{ old('General_Advice2') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Follow_up_Required2">Follow-up Required</label>
                                            <select name="Follow_up_Required2" id="Follow_up_Required2"
                                                    class="form-control" onchange="followUp2()" required>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                        @if (
                                                            !empty($PsychologistHistoryAssessmentSection['Follow_up_Required2']) &&
                                                                $PsychologistHistoryAssessmentSection['Follow_up_Required2'] == 'Yes') selected
                                                        @elseif(old('Follow_up_Required2') == 'Yes')
                                                        selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                        @if (
                                                            !empty($PsychologistHistoryAssessmentSection['Follow_up_Required2']) &&
                                                                $PsychologistHistoryAssessmentSection['Follow_up_Required2'] == 'No') selected
                                                        @elseif(old('Follow_up_Required2') == 'No')
                                                        selected @endif>
                                                    No
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-row d-none" id="follow_up_show2">
                                            <div class="form-group col-md-12">
                                                <div class="form-group">
                                                    <label for="Reason_for_Follow_up2">Reason for Follow-up</label>
                                                    <input placeholder="Reason for Follow-up" name="Reason_for_Follow_up2"
                                                        id="Reason_for_Follow_up2" class="form-control"
                                                        @if (!empty($PsychologistHistoryAssessmentSection['Reason_for_Follow_up2'])) value="{{ $PsychologistHistoryAssessmentSection['Reason_for_Follow_up2'] }}"
                                                        @else
                                                        value="{{ old('Reason_for_Follow_up2') }}" @endif />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="form-group">
                                                    <label for="Follow_up_Date2">Follow-up Date</label>
                                                    <input type="date" placeholder="Reason for Follow-up"
                                                        name="Follow_up_Date2" id="Follow_up_Date2" class="form-control"
                                                        @if (!empty($PsychologistHistoryAssessmentSection['Follow_up_Date2'])) value="{{ $PsychologistHistoryAssessmentSection['Follow_up_Date2'] }}"
                                                        @else
                                                        value="{{ old('Follow_up_Date2') }}" @endif />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                             

                                

                                <h3>Refferals</h3>

                                <div class="form-row box_style">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="internal_referrals2">Internal Referrals</label>
                                            <select name="internal_referrals2[]" id="internal_referrals2"
                                                    class="form-control js-states select_multi py-3" multiple>
                                                @php
                                                    $selectedValues = [];
                                                    if (
                                                        !empty(
                                                            $PsychologistHistoryAssessmentSection['internal_referrals2']
                                                        )
                                                    ) {
                                                        $selectedValues = explode(
                                                            '|',
                                                            $PsychologistHistoryAssessmentSection[
                                                                'internal_referrals2'
                                                            ] ?? '',
                                                        );
                                                    }
                                                @endphp

                                                <option value="Nutritionist"
                                                        @if (in_array('Nutritionist', $selectedValues)) selected @endif>
                                                    Nutritionist
                                                </option>
                                                <option value="Psychologist"
                                                        @if (in_array('Psychologist', $selectedValues)) selected @endif>
                                                    Psychologist
                                                </option>
                                                <option value="School Health Physician"
                                                        @if (in_array('School Health Physician', $selectedValues)) selected @endif>
                                                    School Health
                                                    Physician
                                                </option>
                                                <option value="Not Required"
                                                        @if (in_array('Not Required', $selectedValues)) selected @endif>
                                                    Not Required
                                                </option>
                                                <option value="Teacher"
                                                @if (in_array('Teacher', $selectedValues)) selected @endif>Teacher
                                            </option>

                                            </select>


                                        </div>
                                    </div>
         
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="external_referrals2">External Referrals</label>
                                            <select name="external_referrals2[]" id="external_referrals2"
                                                    class="form-control js-states select_multi py-3" multiple
                                                    onchange="showReasonForReferral2()">
                                                @php
                                                    $selectedValues = !empty(
                                                        $PsychologistHistoryAssessmentSection['external_referrals2']
                                                    )
                                                        ? explode(
                                                            '|',
                                                            $PsychologistHistoryAssessmentSection[
                                                                'external_referrals2'
                                                            ],
                                                        )
                                                        : [];
                                                @endphp



                                                @if (!empty($ExternalReferralList))
                                                    @foreach ($ExternalReferralList as $ExternalReferralLis)
                                                        <option value="{{ $ExternalReferralLis['name'] }}"
                                                                @if (in_array($ExternalReferralLis['name'], $selectedValues)) selected @endif>
                                                            {{ $ExternalReferralLis['name'] }}</option>
                                                    @endforeach
                                                @else
                                                    <option
                                                        value="Allery and Immunology"{{ in_array('Allery and Immunology', $selectedValues) ? ' selected' : '' }}>
                                                        Allery and Immunology
                                                    </option>
                                                    <option
                                                        value="Cardiology"{{ in_array('Cardiology', $selectedValues) ? ' selected' : '' }}>
                                                        Cardiology
                                                    </option>
                                                    <option
                                                        value="Clinical Psychology"{{ in_array('Clinical Psychology', $selectedValues) ? ' selected' : '' }}>
                                                        Clinical Psychology
                                                    </option>
                                                    <option
                                                        value="Dentistry"{{ in_array('Dentistry', $selectedValues) ? ' selected' : '' }}>
                                                        Dentistry
                                                    </option>
                                                    <option
                                                        value="Dermatology"{{ in_array('Dermatology', $selectedValues) ? ' selected' : '' }}>
                                                        Dermatology
                                                    </option>
                                                @endif
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 d-none" id="reasonForReferralSection2">
                                        <div class="form-group">
                                            <label for="Reason_for_Referral2">Reason for Referral</label>
                                            <input placeholder="Reason for Referral" name="Reason_for_Referral2"
                                                   id="Reason_for_Referral2" class="form-control"
                                                   @if (!empty($PsychologistHistoryAssessmentSection['Reason_for_Referral2'])) value="{{ $PsychologistHistoryAssessmentSection['Reason_for_Referral2'] }}"
                                                   @else
                                                   value="{{ old('Reason_for_Referral2') }}" @endif />
                                        </div>
                                    </div>

                                </div>

                              
                                {{--
                            <a href="{{ Route('StudentBiodata') }}">
                                <button type="button" class="btn btn-primary prevStep">Previous</button>
                            </a>

                            <button type="submit" name="submit" class="btn btn-primary">Submit</button> --}}


                            </form>


                        </div>


                    </div>
                </div>
            </div>

        </div>
        @if (!empty($followUps))
                                @foreach ($followUps as $followUp)
                                <h3>Follow-Up {{ \Carbon\Carbon::parse($followUp->created_at)->format('Y-m-d') }}
                                </h3>
                                <div class="form-row box_style">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="internal_referrals2">ICD</label>
                                           <div>{{$followUp->icd}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="internal_referrals2">Reason</label>
                                           <div>{{$followUp->reason}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="internal_referrals2">Description</label>
                                           <div>{{$followUp->comment}}</div>
                                        </div>
                                    </div>

                                  
                                  

                                </div>
                                @endforeach
                                @endif
        {{-- <a href="{{Route('generate.pdf')}}/{{$StudentBiodata['id']}}"  class="btn btn-primary ">Print</a> --}}


    </div>
<div class="bg_drop">
    <div class="preloader-inner">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>
</div>
    <div class="modal fade" id="sendMailModal" tabindex="-1" aria-labelledby="sendMailModalLabel" data-keyboard="false" data-backdrop="static"

         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendMailModalLabel">Send Mail</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form id="sendMailForm" action="{{ route('SendEmail') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="to">To</label>
                            <input type="email" name="to" class="form-control" placeholder="To" value="{{$SchoolEmail}}" readonly required>
                            <!-- <input type="email" name="to" class="form-control" placeholder="To" value="abdurrehmanashraf.ghazitech@gmail.com" readonly required> -->
                            {{-- <input type="email" name="to" class="form-control" placeholder="To" required> --}}
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="cc">CC</label>
                                <input type="text" name="cc" class="form-control" placeholder="CC" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Subject"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Diagnose</label>
                                <input type="text" name="diagnose" class="form-control" placeholder="diagnose"
                                       required>
                            </div>
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control" cols="30" rows="10"
                                      placeholder="Message" required>Subject: Referral for Medical Evaluation 

Dear [School Point of Contact's Name],

I am writing to inform you that [Student's Name] visited the health room on [Date] and was assessed by 
[ DR NAME]. During the evaluation, the following symptoms were observed: [list symptoms, e.g., fever, headache, stomach pain, etc.].

Based on our initial assessment, it is possible that [Student's Name] may be suffering from [potential diagnosis, e.g., viral infection, allergic reaction, etc.]. However, a comprehensive medical evaluation by a qualified physician is necessary to confirm the diagnosis and provide appropriate treatment.

We kindly request that you facilitate [Student's Name]'s referral to a physician for further evaluation and management. Please ensure that the student's parents/guardians are informed and involved in this process.

If you require any additional information or clarification, please do not hesitate to contact me.

Thank you for your attention to this matter.

Best regards
</textarea>
                        </div>
                        <input type="hidden" id="pdfPath" name="pdfPath" value="">
                        <button type="submit" id="sendButton" class="btn btn-secondary">
                            <span class="spinner-border spinner-border-sm d-none" role="status"
                                  aria-hidden="true"></span>
                            Send
                        </button>


                        <button type="button" class="close btn bt-danger" data-dismiss="modal" aria-label="Close">
                            Close
                        </button>
                    </form>


                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="followupModal" tabindex="-1" aria-labelledby="followupModalLabel" data-keyboard="false" data-backdrop="static"

         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendMailModalLabel">Follow Up</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="followupForm" action="#" method="post">
                        @csrf
                      
                        <div class="form-group">
                                <label for="cc">ICD</label>
                                <select id="icd" class="form-control">
                                <option value="">Select</option>
                                @foreach ($ICD10 as $ICD1)
                                <option value="{{ $ICD1['code'] }} - {{ $ICD1['description'] }}">{{ $ICD1['code'] }} - {{ $ICD1['description'] }} </option>
                                @endforeach
                                </select>

                        </div>
                        <div class="form-group">
                            <label for="grNumber">Refrence Number</label>
                            <!-- <input type="email" name="to" class="form-control" placeholder="To" value="{{$SchoolEmail}}" readonly required> -->
                            <input type="text" name="ref" id="ref" class="form-control"  value="{{$referalId}}" readonly disabled required>
                          
                          
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <textarea name="reason" id="reason" class="form-control" cols="30" rows="2"
                                      placeholder="reason" required></textarea>

                            <label for="message">Message</label>
                            <textarea name="message" id="messageDescribtion" class="form-control" cols="30" rows="5"
                                      placeholder="Message" required></textarea>
                        </div>


                        <!-- <input type="hidden" id="pdfPath" name="pdfPath" value=""> -->
                        <button type="button" id="SaveFollowUp" class="btn btn-secondary">
                            <span class="spinner-border spinner-border-sm d-none" role="status"
                                  aria-hidden="true"></span>
                            Save
                        </button>

                        <button type="button" id="closeButton" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
                            Close
                        </button>


                        <!-- <button type="button" class="close btn bt-danger" data-dismiss="modal" aria-label="Close">
                            Close
                        </button> -->
                    </form>


                </div>

            </div>
        </div>
    </div>



    <img src="{{ asset('admin/images/bicphs_logo_new.png') }}" class="img-fluid pdfLogo" id="pdfLogo" alt=""/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    @php
    $dataPoints1 = [
            ["x" => 2, "y" => 1.6735],
            ["x" => 3, "y" => 1.619],
            ["x" => 4, "y" => 1.5673],
            ["x" => 5, "y" => 1.5182],
            
            
            ["x" => 38, "y" => 0.678],
            ["x" => 39, "y" => 0.6652],
            ["x" => 40, "y" => 0.6527],
            ["x" => 45, "y" => 0.5958],
            ["x" => 50, "y" => 0.5465],
            ["x" => 55, "y" => 0.5036],
            ["x" => 60, "y" => 0.466],
            ["x" => 65, "y" => 0.4329],
            ["x" => 70, "y" => 0.4035],
            ["x" => 75, "y" => 0.3774],
            ["x" => 80, "y" => 0.354]
        ];

        $dataPoints2 = [
            ["x" => 2, "y" => 0.9999],
            ["x" => 3, "y" => 1],
            ["x" => 4, "y" => 1],
          
            
        ];
    @endphp
    <script>
        window.onload = function () {
            var dataPoints1 = {!! json_encode($dataPoints1) !!};
            var dataPoints2 = {!! json_encode($dataPoints2) !!};
            var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title:{
                text: "Height-for-age GIRLS"
            },
            axisX:{
                title: "Age (completed months and years)"
            },
            axisY:{
                title: "Height (cm)",
                titleFontColor: "#4F81BC",
                lineColor: "#4F81BC",
                labelFontColor: "#4F81BC",
                tickColor: "#4F81BC"
            },
            axisY2:{
                title: "",
                titleFontColor: "#C0504E",
                lineColor: "#C0504E",
                labelFontColor: "#C0504E",
                tickColor: "#C0504E"
            },
            legend:{
                cursor: "pointer",
                dockInsidePlotArea: true,
                itemclick: toggleDataSeries
            },
            data: [{
                type: "line",
                name: "Dynamic Viscosity",
                markerSize: 0,
                toolTipContent: "Temperature: {x} °C <br>{name}: {y} mPa.s",
                showInLegend: true,
                dataPoints: dataPoints1
                
            },{
                type: "line",
                axisYType: "secondary",
                name: "Density",
                markerSize: 0,
                toolTipContent: "Temperature: {x} °C <br>{name}: {y} g/cm³",
                showInLegend: true,
                dataPoints:  dataPoints2
            }]
        });
        chart.render();
        
        function toggleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            }
            else{
                e.dataSeries.visible = true;
            }
            chart.render();
        }
        
        }
    </script>
    <script>
        $(document).ready(function () {

            // Initialize Tagify on the CC input field
            var ccInput = document.querySelector('input[name=cc]');
            var tagify = new Tagify(ccInput, {
                delimiters: ", ", // Set delimiters for multiple values
                pattern: /^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/ // Email pattern
            });
         
            

            // Custom validator for multiple emails
            $.validator.addMethod("multiemail", function (value, element) {
                var emails = tagify.value.map(tag => tag.value); // Get all email addresses from Tagify
                var valid = true;
                for (var i = 0, limit = emails.length; i < limit; i++) {
                    valid = valid && $.validator.methods.email.call(this, emails[i], element);
                }
                return valid;
            }, "Please enter valid email addresses");


            $("#sendMailForm").validate({
                rules: {
                    to: {
                        required: true,
                        email: true
                    },
                    cc: {
                        required: true,
                        // multiemail: true
                    },
                    subject: {
                        required: true
                    },
                    message: {
                        required: true
                    }
                },
                messages: {
                    to: {
                        required: "Please enter a recipient email address",
                        email: "Please enter a valid email address"
                    },
                    cc: {
                        required: "Please enter valid email addresses separated by commas"
                    },
                    subject: {
                        required: "Please enter a subject"
                    },
                    message: {
                        required: "Please enter a message"
                    }
                },
                submitHandler: function (form) {
                    var submitButton = $(form).find('button[type="submit"]');
                    // submitButton.prop('disabled', true);
                    submitButton.find('.spinner-border').removeClass('d-none');

                    var formData = new FormData(form);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        // url: '{{ route('SendEmail') }}',
                        url: $(form).attr('action'),
                        method: 'POST',
                        // data: $(form).serialize(),
                        data: formData,

                        // data: new FormData(form), // Ensure FormData includes all form fields and attachments
                        contentType: false,
                        processData: false,
                        dataType: 'json', // Expect JSON response from server

                        success: function (response) {
                            // alert('Email sent successfully!');

                            Swal.fire({
                                title: 'Success',
                                text: 'Email sent successfully!',
                                icon: 'success',
                                timer: 5000, // 5 seconds
                                showConfirmButton: false
                            });

                            submitButton.text('Send Mail');
                            submitButton.find('.spinner-border').addClass('d-none');

                            $('#sendMailModal').modal('hide');
                            $(form)[0].reset();

                            $("#downloadPDF2").text("Send Mail");

                        },
                        error: function (response) {

                            let errorMessage = 'An error occurred while sending the email.';

                            if (response.responseJSON && response.responseJSON.error) {
                                errorMessage = response.responseJSON.error;
                            }

                            Swal.fire({
                                title: 'Error',
                                text: errorMessage,
                                icon: 'error',
                                timer: 5000, // 5 seconds
                                showConfirmButton: false
                            });

                            submitButton.text('Send Mail');
                            submitButton.find('.spinner-border').addClass('d-none');


                            location.reload();

                            // alert('An error occurred while sending the email.');
                        },
                        complete: function () {
                            submitButton.prop('disabled', false);
                            submitButton.find('.spinner-border').addClass('d-none');
                        }
                    });
                }
            });

        });


         /* Send in Email Complete  data file PDF */
         document.getElementById('downloadPDF2').addEventListener('click', function () {
            $(".bg_drop").addClass("active")
            var button = this;
            button.disabled = true;
            button.textContent = 'Creating...';

            var element = document.getElementById('content');
            html2pdf().from(element).set({
                margin: 0.5,
                filename: 'Medical-History.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            }).toPdf().get('pdf').then(function (pdf) {
                var blob = pdf.output('blob');
                var formData = new FormData();
                formData.append('pdf', blob, 'Medical-History.pdf');
                console.log(formData);
                fetch('{{ route('generateAndSendPdf') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => response.json()).then(data => {
                    button.disabled = false;
                    // button.textContent = 'Download PDF';
                    if (data.file) {
                        document.getElementById('pdfPath').value = data.file;
                        // alert('PDF saved successfully.');
                        $('#sendMailModal').modal('show');
                        $("#downloadPDF2").text("Send Mail");
                        $(".bg_drop").removeClass("active")

                    } else {
                        alert('Error saving PDF.');
                        $(".bg_drop").removeClass("active")
                    }
                }).catch(error => {
                    button.disabled = false;
                    button.textContent = 'Download PDF';
                    alert('Error saving PDF.');
                    $(".bg_drop").removeClass("active")
                });
            });
        });

        // sample pdf generate code by danishraj
        function generatePDF() {
            const { jsPDF } = window.jspdf;
            const content = document.getElementById('content');
            const logo = document.getElementById('pdfLogo');

            html2canvas(content).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const logoData = logo.src; // Get the src of the logo image
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 210;
                const pageHeight = 297;
                const imgHeight = canvas.height * imgWidth / canvas.width;
                const logoWidth = 50; // Adjust the logo width
                const logoHeight = 20; // Adjust the logo height

                let heightLeft = imgHeight;
                let position = 30; // Initial position for the content, leaving space for the header

                const generatePage = (canvas, pdf, logoData, imgData, imgWidth, imgHeight, heightLeft, position) => {
                pdf.addImage(logoData, 'PNG', 10, 10, logoWidth, logoHeight);
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= (pageHeight - position);
                };

                generatePage(canvas, pdf, logoData, imgData, imgWidth, imgHeight, heightLeft, position);

                while (heightLeft >= 0) {
                position = heightLeft - imgHeight + 30;
                pdf.addPage();
                generatePage(canvas, pdf, logoData, imgData, imgWidth, imgHeight, heightLeft, position);
                }

                pdf.save('content.pdf');
            });
        }
       /* Download Complete  data file PDF */
        document.getElementById('downloadPDF').addEventListener('click', function () {
            var button = this;
            button.disabled = true;
            button.textContent = 'Printing...';
 
            var element = document.getElementById('content');
            html2pdf().from(element).set({
                margin: 0.5,
                filename: 'Medical-History.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            }).save().then(function () {
                button.disabled = false;
                button.textContent = 'Download PDF........';

            });
        });


        

      
   
   
        $(document).ready(function () {

            $('#content form :input').prop('disabled', true);
            /*temperature change trigger*/

            $("#Temperature").on("keyup change", function (e) {


                var Temperature = $("#Temperature");
                // console.log(Temperature.val());


                if (Temperature.val() >= 96.4 && Temperature.val() <= 100.4) {
                    // alert("Concerned");
                    $("#temperature_check").css('color', 'green');
                    $("#temperature_check").text('Normal');

                } else if (Temperature.val() > 100.4) {
                    $("#temperature_check").css('color', 'red');
                    $("#temperature_check").text('High');
                } else if (Temperature.val() < 96.4) {
                    $("#temperature_check").css('color', 'brown');
                    $("#temperature_check").text('Low');
                } else {

                    $('#temperature_check').text('');

                }


            });
            @if (!empty($SchoolHealthPhysician) && !empty($SchoolHealthPhysician['Temperature']))

            $("#Temperature").change();
            @endif
            /*Pulse rate cahnged*/
            $("#Pulse_rate").on("keyup change", function (e) {
                var PulseRate = $("#Pulse_rate");
                var ageMonths = $("#hidden_age").val();
                var ageYears = Math.round(ageMonths / 12);
                // console.log("age", ageYears);
                // console.log(Temperature.val());
                if (ageYears >= 1 && ageYears <= 3 && PulseRate.val() >= 80 && PulseRate.val() <= 120) {
                    // alert("Concerned");
                    $("#pulse_rate_check").css('color', 'green');
                    $("#pulse_rate_check").text('Normal');

                } else if (ageYears >= 3 && ageYears <= 12 && PulseRate.val() >= 75 && PulseRate.val() <=
                    115) {
                    $("#pulse_rate_check").css('color', 'green');
                    $("#pulse_rate_check").text('Normal');
                } else if (ageYears >= 13 && ageYears <= 18 && PulseRate.val() >= 60 && PulseRate.val() <=
                    100) {
                    $("#pulse_rate_check").css('color', 'green');
                    $("#pulse_rate_check").text('Normal');
                } else {

                    $("#pulse_rate_check").css('color', '');
                    $("#pulse_rate_check").text('');

                }


            });
            @if (!empty($SchoolHealthPhysician) && !empty($SchoolHealthPhysician['Pulse_rate']))
            $("#Pulse_rate").change();
            @endif



            /* Respiratoray Rate Changed*/
            $("#Respiratory_Rate").on("keyup change", function (e) {
                var respiratoryRate = $("#Respiratory_Rate").val();
                var ageMonths = $("#hidden_age").val();
                var ageYears = Math.round(ageMonths / 12);

                // console.log("age:", ageYears);
                // console.log("respiratoryRate:", respiratoryRate);


                if (ageYears >= 1 && ageYears <= 3 && respiratoryRate >= 24 && respiratoryRate <= 40) {

                    $("#check_respiratory_rate").css('color', 'green').text('Normal');
                    $("#RespiratoryRateResult").val('Normal');

                } else if (ageYears >= 4 && ageYears <= 5 && respiratoryRate >= 22 && respiratoryRate <=
                    34) {
                    $("#check_respiratory_rate").css('color', 'green').text('Normal');
                    $("#RespiratoryRateResult").val('Normal');

                } else if (ageYears >= 6 && ageYears <= 12 && respiratoryRate >= 18 && respiratoryRate <=
                    30) {
                    $("#check_respiratory_rate").css('color', 'green').text('Normal');
                    $("#RespiratoryRateResult").val('Normal');

                } else if (ageYears >= 13 && ageYears <= 18 && respiratoryRate >= 12 && respiratoryRate <=
                    16) {
                    $("#check_respiratory_rate").css('color', 'green').text('Normal');
                    $("#RespiratoryRateResult").val('Normal');

                } else {
                    $("#check_respiratory_rate").css('color', '').text(' ');
                    $("#RespiratoryRateResult").val('abnormal');

                }

            });

            @if (!empty($SchoolHealthPhysician) && !empty($SchoolHealthPhysician['Respiratory_Rate']))

            $("#Respiratory_Rate").change();
            @endif


            $("#Blood_pressure").on("keyup change", function (e) {


                var Blood_pressure = $("#Blood_pressure");


                if (Blood_pressure.val() >= 121) {
                    // alert("Concerned");

                    $("#BloodPressureSystolic").css('color', 'red');
                    $("#BloodPressureSystolic").text('High');

                } else if (Blood_pressure.val() <= 119) {
                    $("#BloodPressureSystolic").css('color', 'red');
                    $("#BloodPressureSystolic").text('Low');
                } else {
                    $("#BloodPressureSystolic").css('color', 'greed');
                    $("#BloodPressureSystolic").text('Normal');
                }


            });


            @if (!empty($SchoolHealthPhysician) && !empty($SchoolHealthPhysician['Blood_pressure']))

            $("#Blood_pressure").change();
            @endif




            $("#BloodPressureDiastolic").on("keyup change", function (e) {


                var BloodPressureDiastolic = $("#BloodPressureDiastolic");

                if (BloodPressureDiastolic.val() >= 81) {

                    $("#BloodPressureDiastolicSpan").css('color', 'red');
                    $("#BloodPressureDiastolicSpan").text('High');

                } else if (BloodPressureDiastolic.val() <= 79) {
                    $("#BloodPressureDiastolicSpan").css('color', 'red');
                    $("#BloodPressureDiastolicSpan").text('Low');
                } else {

                    $("#BloodPressureDiastolicSpan").css('color', 'greed');
                    $("#BloodPressureDiastolicSpan").text('Normal');

                }


            });


            @if (!empty($SchoolHealthPhysician) && !empty($SchoolHealthPhysician['BloodPressureDiastolic']))

            $("#BloodPressureDiastolic").change();
            @endif



            var currentDate = new Date().toISOString().split('T')[0];
            $('#dob').attr('max', currentDate);

            $('.prevStep').click(function () {
                var currentStep = $(this).closest('.step');
                var prevStep = currentStep.prev('.step');

                // Move to the previous step
                currentStep.removeClass('active');
                prevStep.addClass('active');
            });

            $('.form-group').on('blur change', '.error-border', function () {
                if ($(this).val()) {
                    $(this).removeClass('error-border').closest('.form-group').find('.error-text').remove();
                }
            })

            function validate(e, isLastStep = false) {
                $('.error-text').remove()
                let closestDiv = isLastStep ? '.last-step' : '.step';
                var currentStep = $(e.target).closest(closestDiv);
                var nextStep = currentStep.next('.step');
                var checkboxes = $('.form-group input[type="checkbox"]');
                var isValid = true;

                var fieldErrors = [];
                // Check if all required fields in the current step are filled
                currentStep.find('input[required], select[required], input[type="checkbox"]:checked').each(
                    function () {
                        if ($(this).val() == '' || $(this).val() == null) {
                            fieldErrors.push($(this).attr('id'))
                            isValid = false;
                            // return false; // Exit the loop if a required field is empty
                        }
                    });


                if (isValid && !isLastStep) {
                    currentStep.removeClass('active');
                    nextStep.addClass('active');
                } else {
                    for (fieldError of fieldErrors) {
                        $('#' + fieldError)
                            .addClass('error-border')
                            .closest('.form-group')
                            .append('<small class="text-danger error-text">This field is required</small>');
                    }
                }
                return isValid;
            }

            $('.nextStep').click(validate)
            // });

            // $("#height").on("keyup change", function(e) {
            //     var height = $('#height').val();
            //     if (height != '') {
            //         $('#weight').removeAttr("disabled");
            //     } else {
            //         $('#weight').attr("disabled", true);
            //     }

            // });

            $("#Weight, #Height").on("keyup change", function (e) {
                var height = $('#Height').val();
                var weight = $('#Weight').val();
                var bmi = $('#BMI');

                if (height != '' && height > 0 && weight != '' && weight > 0) {

                    var result = (weight / height / height) * 10000;
                    $('#BMI').val(result.toFixed(2));

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var hidden_age = $("#hidden_age").val();
                    var bmi = $("#BMI").val();

                    var dataToSend = {
                        bmi: bmi,
                        hidden_age: hidden_age,
                        gender: "{{ $StudentBiodata->gender }}",
                    };

                    $.ajax({
                        type: 'POST',
                        data: dataToSend,
                        url: '{{ route('BmiRange', ['StudentBiodataId' => $StudentBiodataId]) }}',
                        success: function (data) {
                            // console.log("data " + data);
                            if (data.status) {
                                var bmi_result = $('#bmi_result_1');
                                // console.log(data.result.P3);
                                if (bmi < data.result.P3) {
                                    bmi_result.css('color', 'red');
                                    bmi_result.text('Low BMI')
                                } else if (bmi >= data.result.P3 && bmi <= data.result.P5) {
                                    bmi_result.css('color', 'green');
                                    bmi_result.text('Normal BMI')
                                } else if (bmi > data.result.P5) {
                                    bmi_result.css('color', 'red');
                                    bmi_result.text('High BMI')
                                }

                                // bmi_result
                            }
                        }

                    });


                }


                /*  Weight1Response */

                if (weight > 0) {

                    weight = parseFloat(weight);

                    var Weight1ResponseUrl = '{!! Route('Weight1Response') !!}';
                    // console.log("Weight1ResponseUrl " + Weight1ResponseUrl);

                    $.ajax({
                        url: Weight1ResponseUrl,
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            hidden_age: $("#hidden_age").val(),
                            gender: "{{ $StudentBiodata->gender }}",
                        },

                        dataType: 'json',
                        beforeSend: function () {

                            // console.log("----------- beforeSend -------------");
                        },

                        success: function (resp) {

                            // console.log("----------- Response -------------");

                            // console.log("resp " + resp);
                            // console.log("resp " + JSON.stringify(resp));

                            if (resp['status'] === true) {

                                var result_3rd = resp['result']['3rd'];
                                // console.log("result_3rd " + result_3rd);


                                result_3rd = parseFloat(result_3rd);

                                if (!isNaN(weight) && !isNaN(result_3rd)) {

                                    if (weight >= result_3rd) {
                                        $('#Weight1Response1').css('color', 'green');
                                        $('#Weight1Response1').text('Normal ')
                                    } else if (weight < result_3rd) {
                                        $('#Weight1Response1').css('color', 'red');
                                        $('#Weight1Response1').text('Low ')
                                    } else {

                                        $('#Weight1Response1').html('');

                                    }

                                } else {
                                    $('#Weight1Response1').html('Invalid input');
                                }


                            } else {

                                $('#Weight1Response1').html('');

                            }


                        }
                    });


                } else {
                    $('#Weight1Response1').html('');

                }


                /*  height1Response */

                if (height > 0) {

                    height = parseFloat(height);

                    var height1ResponseUrl = '{!! Route('height1Response') !!}';
                    // console.log("height1ResponseUrl " + height1ResponseUrl);

                    $.ajax({
                        url: height1ResponseUrl,
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            hidden_age: $("#hidden_age").val(),
                            gender: "{{ $StudentBiodata->gender }}",
                        },

                        dataType: 'json',


                        success: function (resp) {

                            // console.log("----------- Response -------------");

                            // console.log("resp " + resp);
                            // console.log("resp " + JSON.stringify(resp));

                            if (resp['status'] === true) {

                                var result_3rd = resp['result']['3rd'];
                                // console.log("result_3rd " + result_3rd);

                                result_3rd = parseFloat(result_3rd);

                                if (!isNaN(height) && !isNaN(result_3rd)) {

                                    if (height >= result_3rd) {
                                        $('#height1Response1').css('color', 'green');
                                        $('#height1Response1').text('Normal ')
                                    } else if (height < result_3rd) {
                                        $('#height1Response1').css('color', 'red');
                                        $('#height1Response1').text('Low ')
                                    } else {

                                        $('#height1Response1').html('');

                                    }

                                } else {
                                    $('#height1Response1').html('Invalid input');
                                }


                            } else {

                                $('#height1Response1').html('');

                            }


                        }
                    });


                } else {
                    $('#height1Response1').html('');

                }


            });


            @if (
                !empty($SchoolHealthPhysician) &&
                    !empty($SchoolHealthPhysician['Height']) &&
                    !empty($SchoolHealthPhysician['Weight']))


            $("#Weight, #Height").change();
            @endif



            $("#Weight1, #height1").on("keyup change", function (e) {
                var height = $('#height1').val();
                var weight = $('#Weight1').val();
                // console.log("height" + height);

                var bmi = $('#BMI1');
                if (height != '' && height > 0 && weight != '' && weight > 0) {

                    var result = (weight / height / height) * 10000;
                    $('#BMI1').val(result.toFixed(2));

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var hidden_age = $("#hidden_age").val();
                    var bmi = $("#BMI1").val();

                    var dataToSend = {
                        bmi: bmi,
                        hidden_age: hidden_age,
                        gender: "{{ $StudentBiodata->gender }}",
                    };

                    $.ajax({
                        type: 'POST',
                        data: dataToSend,
                        url: '{{ route('BmiRange', ['StudentBiodataId' => $StudentBiodataId]) }}',
                        success: function (data) {
                            // console.log("data " + data);
                            if (data.status) {
                                var bmi_result = $('#bmi_result');
                                // console.log(data.result.P3);
                                if (bmi < data.result.P3) {
                                    bmi_result.css('color', 'red');
                                    bmi_result.text('Low BMI')
                                } else if (bmi >= data.result.P3 && bmi <= data.result.P5) {
                                    bmi_result.css('color', 'green');
                                    bmi_result.text('Normal BMI')
                                } else if (bmi > data.result.P5) {
                                    bmi_result.css('color', 'red');
                                    bmi_result.text('High BMI')
                                }

                                // bmi_result
                            }
                        }

                    });


                }


                /*  Weight1Response */

                if (weight > 0) {

                    weight = parseFloat(weight);

                    var Weight1ResponseUrl = '{!! Route('Weight1Response') !!}';
                    // console.log("Weight1ResponseUrl " + Weight1ResponseUrl);

                    $.ajax({
                        url: Weight1ResponseUrl,
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            hidden_age: $("#hidden_age").val(),
                            gender: "{{ $StudentBiodata->gender }}",
                        },

                        dataType: 'json',
                        beforeSend: function () {

                            // console.log("----------- beforeSend -------------");
                        },

                        success: function (resp) {

                            // console.log("----------- Response -------------");

                            // console.log("resp " + resp);
                            // console.log("resp " + JSON.stringify(resp));

                            if (resp['status'] === true) {

                                var result_3rd = resp['result']['3rd'];
                                // console.log("result_3rd " + result_3rd);


                                result_3rd = parseFloat(result_3rd);

                                if (!isNaN(weight) && !isNaN(result_3rd)) {

                                    if (weight >= result_3rd) {
                                        $('#Weight1Response').css('color', 'green');
                                        $('#Weight1Response').text('Normal ')
                                    } else if (weight < result_3rd) {
                                        $('#Weight1Response').css('color', 'red');
                                        $('#Weight1Response').text('Low ')
                                    } else {

                                        $('#Weight1Response').html('');

                                    }

                                } else {
                                    $('#Weight1Response').html('Invalid input');
                                }


                            } else {

                                $('#Weight1Response').html('');

                            }


                        }
                    });


                } else {
                    $('#Weight1Response').html('');

                }


                /*  height1Response */

                if (height > 0) {

                    height = parseFloat(height);

                    var height1ResponseUrl = '{!! Route('height1Response') !!}';
                    // console.log("height1ResponseUrl " + height1ResponseUrl);

                    $.ajax({
                        url: height1ResponseUrl,
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            hidden_age: $("#hidden_age").val(),
                            gender: "{{ $StudentBiodata->gender }}",
                        },

                        dataType: 'json',
                        // beforeSend: function() {

                        //     console.log("----------- beforeSend -------------");
                        // },

                        success: function (resp) {

                            // console.log("----------- Response -------------");

                            // console.log("resp " + resp);
                            // console.log("resp " + JSON.stringify(resp));

                            if (resp['status'] === true) {

                                var result_3rd = resp['result']['3rd'];
                                // console.log("result_3rd " + result_3rd);

                                result_3rd = parseFloat(result_3rd);

                                if (!isNaN(height) && !isNaN(result_3rd)) {

                                    if (height >= result_3rd) {
                                        $('#height1Response').css('color', 'green');
                                        $('#height1Response').text('Normal ')
                                    } else if (height < result_3rd) {
                                        $('#height1Response').css('color', 'red');
                                        $('#height1Response').text('Low ')
                                    } else {

                                        $('#height1Response').html('');

                                    }

                                } else {
                                    $('#height1Response').html('Invalid input');
                                }


                            } else {

                                $('#height1Response').html('');

                            }


                        }
                    });


                } else {
                    $('#height1Response').html('');

                }


            });


            @if (
                !empty($NutritionistHistoryEvaluationSection) &&
                    !empty($NutritionistHistoryEvaluationSection['height']) &&
                    !empty($NutritionistHistoryEvaluationSection['Weight']))


            $("#Weight1, #height1").change();
            @endif


            $("#Question_No_6_Blood_Pressure_Diastolic, #Question_No_6_Blood_Pressure_Systolic").on("keyup change",
                function (e) {
                    var diastolic = $('#Question_No_6_Blood_Pressure_Diastolic').val();
                    var systolic = $('#Question_No_6_Blood_Pressure_Systolic').val();
                    var age = $('#age').val();

                    if (age >= 3 && age <= 5) {
                        if (systolic <= 90 || systolic >= 121) {
                            $("#Question_No_6_Blood_Pressure_Systolic").addClass("bg-danger");
                        } else {
                            $("#Question_No_6_Blood_Pressure_Systolic").removeClass("bg-danger");
                        }
                        if (diastolic <= 45 || diastolic >= 81) {
                            $("#Question_No_6_Blood_Pressure_Diastolic").addClass("bg-danger");
                        } else {
                            $("#Question_No_6_Blood_Pressure_Diastolic").removeClass("bg-danger");
                        }
                    } else if (age >= 6 && age <= 12) {
                        if (systolic <= 95 || systolic >= 132) {
                            // console.log(age + '-' + systolic);
                            $("#Question_No_6_Blood_Pressure_Systolic").addClass("bg-danger");
                        } else {
                            $("#Question_No_6_Blood_Pressure_Systolic").removeClass("bg-danger");
                        }
                        if (diastolic <= 54 || diastolic >= 63) {
                            // console.log(age + '-' + diastolic);
                            $("#Question_No_6_Blood_Pressure_Diastolic").addClass("bg-danger");
                        } else {
                            $("#Question_No_6_Blood_Pressure_Diastolic").removeClass("bg-danger");
                        }
                    } else if (age >= 13 && age <= 17) {
                        if (systolic <= 107 || systolic >= 146) {
                            // console.log(age + '-' + systolic);
                            $("#Question_No_6_Blood_Pressure_Systolic").addClass("bg-danger");
                        } else {
                            $("#Question_No_6_Blood_Pressure_Systolic").removeClass("bg-danger");
                        }
                        if (diastolic <= 61 || diastolic >= 95) {
                            // console.log(age + '-' + diastolic);
                            $("#Question_No_6_Blood_Pressure_Diastolic").addClass("bg-danger");
                        } else {
                            $("#Question_No_6_Blood_Pressure_Diastolic").removeClass("bg-danger");
                        }
                    }
                });
            $("#Question_No_7_Pulse").on("keyup change", function (e) {
                var pulse = $('#Question_No_7_Pulse').val();
                var age = $('#age').val();

                if (age >= 3 && age <= 5) {
                    if (pulse <= 79 || pulse >= 121) {
                        $("#Question_No_7_Pulse").addClass("bg-danger");
                    } else {
                        $("#Question_No_7_Pulse").removeClass("bg-danger");
                    }
                } else if (age >= 6 && age <= 12) {
                    if (pulse <= 74 || pulse >= 119) {
                        $("#Question_No_7_Pulse").addClass("bg-danger");
                    } else {
                        $("#Question_No_7_Pulse").removeClass("bg-danger");
                    }
                } else if (age >= 13 && age <= 17) {
                    if (pulse <= 59 || pulse >= 101) {
                        $("#Question_No_7_Pulse").addClass("bg-danger");
                    } else {
                        $("#Question_No_7_Pulse").removeClass("bg-danger");
                    }
                }
            });


            $('#any_neck_swelling').on('change', function () {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.any_neck_swelling_specify').removeClass('d-none');
                } else {
                    $('.any_neck_swelling_specify').addClass('d-none');
                }

            });

            $('#any_history_of_abdominal_pain').on('change', function () {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.any_history_of_abdominal_pain_specify').removeClass('d-none');
                } else {
                    $('.any_history_of_abdominal_pain_specify').addClass('d-none');
                }

            });
            $('#any_menstrual_abnormality').on('change', function () {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.any_menstrual_abnormality_specify').removeClass('d-none');
                } else {
                    $('.any_menstrual_abnormality_specify').addClass('d-none');
                }

            });

            $('#limitations_range_motion').on('change', function () {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.limitations_range_motion_specify').removeClass('d-none');
                } else {
                    $('.limitations_range_motion_specify').addClass('d-none');
                }

            });

            $('#lymph_node').on('change', function () {
                var result = $(this).val();
                if (result === 'abnormal') {
                    $('.lymph_node_specify').removeClass('d-none');
                } else {
                    $('.lymph_node_specify').addClass('d-none');
                }

            });

            $('#do_you_have_any_Allergies').on('change', function () {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.do_you_have_any_Allergies_specify').removeClass('d-none');
                } else {
                    $('.do_you_have_any_Allergies_specify').addClass('d-none');
                }

            });

            $('#menarche_age').on('change', function () {
                var result = $(this).val();
                if (result === 'none_of_the_above') {
                    $('.menarche_age_specify').removeClass('d-none');
                    $(".menstrual_abnormality option[value='']").attr('selected', 'selected');

                } else {
                    $('.menarche_age_specify').addClass('d-none');
                    $('.menstrual_abnormality_specify').addClass('d-none');

                }
            });
           // Ensure jQuery is loaded

    
                        $('#SaveFollowUp').on('click', function(e) {
                            e.preventDefault();
                             var followup_url = '{!! Route('saveFollowup') !!}';
                            
                            let data = {
                                ref: $('#ref').val(),
                                IDC: $('#icd').val(),
                                reason: $('#reason').val(),
                                message: $('#messageDescribtion').val(),
                                
                                _token: '{{ csrf_token() }}' 
                            };
// console.log(data);
                            $.ajax({
                                url: followup_url, // Replace with your route
                                method: 'POST',
                                data: data,
                                success: function(response) {
                                    console.log(response);
                                    alert('Follow-up saved successfully!');
                                    location.reload();
                                },
                                error: function(xhr) {
                                    alert('Error occurred while saving.');
                                    console.log(xhr.responseText);
                                }
                            });

                        });


            // $('#followup_required').on('change', function() {
            //     var result = $(this).val();
            //     if (result === 'Yes') {
            //         $('.reffered').removeClass('d-none');
            //         $(".reffered option[value='']").attr('selected', 'selected');

            //     } else {
            //         $('.reffered').addClass('d-none');

            //     }
            // });
            $('#followup_required').on('change', function () {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.reffered').removeClass('d-none');
                    $(".reffered option[value='']").attr('selected', 'selected');
                } else {
                    $('#referred_by').val('');
                    $('.reffered').addClass('d-none');
                }
            });

            $('#menstrual_abnormality').on('change', function () {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.menstrual_abnormality_specify').removeClass('d-none');
                } else {
                    $('.menstrual_abnormality_specify').addClass('d-none');
                }

            });

            $('#immunization_card').on('change', function () {
                var result = $(this).val();
                if (result === 'No') {
                    $('.immunization_card_specify').removeClass('d-none');
                } else {
                    $('.immunization_card_specify').addClass('d-none');
                }

            });

            $("#dob").on("change", function () {

                var dob = $(this).val();
                if (dob) {
                    var today = new Date();
                    var birthDate = new Date(dob);
                    var age = today.getFullYear() - birthDate.getFullYear();
                    var monthDiff = today.getMonth() - birthDate.getMonth();
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    $("#age").val(age);
                } else {

                    $("#age").val("");
                }
            });

            $('#submit').on('click', function (e) {

                if (!validate(e, true)) return;
                //    console.log(validate());
                var form = $('#multiStepForm');
                var formData = form.serializeArray();
                var secondsOnSubmit;


                var endTime = new Date();
                var timeDiff = endTime - startTime;
                secondsOnSubmit = Math.round(timeDiff / 1000);

                var formData = $('#multiStepForm').serializeArray();


                $.each(formData, function (index, field) {
                    var fieldId = field['name'];
                    var fieldValue = field['value'];

                });
                let _token = $('meta[name="csrf-token"]').attr('content');
                formData.push({
                    name: 'duration',
                    value: secondsOnSubmit
                });
                $.ajax({
                    type: "post",
                    url: "{{ url('post_data') }}",
                    data: {
                        _token: _token,
                        formData: formData

                    },
                    dataType: "json",
                    beforeSend: function () {

                    },
                    success: function (response) {
                        // alert(response);
                        // console.log(response);
                        Swal.fire({
                            title: 'Success!',
                            text: 'Enrollment has been submitted successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            timer: 2000, // Set the timer to 2 seconds (in milliseconds)
                            timerProgressBar: true, // Show a progress bar during the timer
                            showConfirmButton: false // Hide the "OK" button
                        }).then(() => {
                            window.location.href = "{{ route('admin.form.index') }}"
                        });

                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });

            var form = $('#multiStepForm');
            var startTime;
            var timerInterval;
            var secondsOnSubmit;

            form.one('focusin', function () {
                // Set the start time when any form field is focused
                startTime = new Date();

                // Start a timer interval to update the display every second
                timerInterval = setInterval(function () {
                    var currentTime = new Date();
                    var timeDiff = currentTime - startTime;
                    var seconds = Math.round(timeDiff / 1000);
                    $('#timer').text('Time: ' + seconds + ' seconds');
                }, 1000);
            });
        });

        // Select the dropdown element
        const selectElement = document.getElementById(
            'Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to');

        // Select the container of the second form group
        // const addictionContainer = document.getElementById('addictionContainer');

        // // Add change event listener to the dropdown
        // selectElement.addEventListener('change', function() {
        //     // If 'Yes' is selected, show the second form group; otherwise, hide it
        //     if (this.value === 'Yes') {
        //         addictionContainer.classList.remove('d-none');
        //     } else {
        //         addictionContainer.classList.add('d-none');
        //     }
        // });

        // const selectElement_addict = document.getElementById('addiction');
        // // Select the container of the textarea
        // const otherAddictionContainer = document.getElementById('otherAddictionContainer');

        // // Add change event listener to the dropdown
        // selectElement_addict.addEventListener('change', function() {
        //     // If 'other' is selected, show the textarea; otherwise, hide it
        //     if (this.value === 'other') {
        //         otherAddictionContainer.classList.remove('d-none');
        //     } else {
        //         otherAddictionContainer.classList.add('d-none');
        //     }
        // });


        // const food_allergies = document.getElementById('food_allergies');
        // // Select the container of the textarea
        // const food_allergiesContainer = document.getElementById('food_allergiesContainer');

        // // Add change event listener to the dropdown
        // food_allergies.addEventListener('change', function() {
        //     // If 'other' is selected, show the textarea; otherwise, hide it
        //     if (this.value === 'Yes') {
        //         food_allergiesContainer.classList.remove('d-none');
        //     } else {
        //         food_allergiesContainer.classList.add('d-none');
        //     }
        // });


        function showBreakFast() {
            let Breakfast = document.getElementById("Breakfast");
            let selectedValue = Breakfast.value;
            if (selectedValue === "Yes") {
                let showBreakFastDetail = document.getElementById('showBreakFastDetail');
                showBreakFastDetail.classList.remove('d-none');
                $("#breakfast_detail").attr("required", true)

                $("#BreakfastAlert").css('color', '');
                $("#BreakfastAlert").text('');


            } else {
                let showBreakFastDetail = document.getElementById('showBreakFastDetail');
                showBreakFastDetail.classList.add('d-none');
                $("#breakfast_detail").attr("required", false)

                $("#BreakfastAlert").css('color', 'red');
                $("#BreakfastAlert").text('Alert');
            }
        }


        @if (!empty($NutritionistHistoryEvaluationSection['Breakfast']))

        showBreakFast()
        @endif



        function showMidDaySnack() {
            let Mid_day_Snack = document.getElementById("Mid_day_Snack");
            let selectedValue = Mid_day_Snack.value;
            if (selectedValue === "Yes") {
                let showMidDaySnackDetail = document.getElementById('showMidDaySnackDetail');
                showMidDaySnackDetail.classList.remove('d-none');
                $("#MidDaySnackDetail").attr("required", true)
            } else {
                let showMidDaySnackDetail = document.getElementById('showMidDaySnackDetail');
                showMidDaySnackDetail.classList.add('d-none');
                $("#MidDaySnackDetail").attr("required", false)
            }
        }

        function showLunchFunc() {
            let Lunch = document.getElementById("Lunch");
            let selectedValue = Lunch.value;
            if (selectedValue === "Yes") {
                let showlunchdetail = document.getElementById('showlunchdetail');
                showlunchdetail.classList.remove('d-none');
                $("#lunchDetail").attr("required", true)

                $("#LunchAlert").css('color', '');
                $("#LunchAlert").text('');


            } else {
                let showlunchdetail = document.getElementById('showlunchdetail');
                showlunchdetail.classList.add('d-none');
                $("#lunchDetail").attr("required", false)

                $("#LunchAlert").css('color', 'red');
                $("#LunchAlert").text('Alert');
            }
        }


        @if (!empty($NutritionistHistoryEvaluationSection['Lunch']))

        showLunchFunc()
        @endif


        function showEveningSnackFunc() {
            let Evening_Snack = document.getElementById("Evening_Snack");
            let selectedValue = Evening_Snack.value;
            if (selectedValue === "Yes") {
                let showEveningSnackDetail = document.getElementById('showEveningSnackDetail');
                showEveningSnackDetail.classList.remove('d-none');
                $("#EveningSnackDetail").attr("required", true)
            } else {
                let showEveningSnackDetail = document.getElementById('showEveningSnackDetail');
                showEveningSnackDetail.classList.add('d-none');
                $("#EveningSnackDetail").attr("required", false)
            }
        }

        function showDinnerFunc() {
            let Dinner = document.getElementById("Dinner");
            let selectedValue = Dinner.value;
            if (selectedValue === "Yes") {
                let showDinner = document.getElementById('showDinner');
                showDinner.classList.remove('d-none');
                $("#Dinner").attr("required", true)

                $("#DinnerAlert").css('color', '');
                $("#DinnerAlert").text('');


            } else {
                let showDinner = document.getElementById('showDinner');
                showDinner.classList.add('d-none');
                $("#Dinner").attr("required", false)

                $("#DinnerAlert").css('color', 'red');
                $("#DinnerAlert").text('Alert');


            }
        }

        @if (!empty($NutritionistHistoryEvaluationSection['Dinner']))

        showDinnerFunc()
        @endif



        function followUp() {
            var follow_up_Required = document.getElementById("Follow_up_Required");
            var selectedValue = follow_up_Required.value;
            if (selectedValue === "Yes") {
                var follow_up_show = document.getElementById('follow_up_show');
                follow_up_show.classList.remove('d-none');


                $("#Reason_for_Follow_up").attr('required', true);
                $("#Follow_up_Date").attr('required', true);

            } else {
                var follow_up_show = document.getElementById('follow_up_show');
                follow_up_show.classList.add('d-none');


                $("#Reason_for_Follow_up").attr('required', false);
                $("#Follow_up_Date").attr('required', false);

            }
        }


        @if (!empty($SchoolHealthPhysician['Follow_up_Required']) && $SchoolHealthPhysician['Follow_up_Required'] == 'Yes')

        followUp()
        @endif

        @if (!empty($SchoolHealthPhysician['Follow_up_Required']) && $SchoolHealthPhysician['Follow_up_Required'] == 'No')

        $("#Reason_for_Follow_up").val("");
        $("#Follow_up_Date").val("");
        @endif


        function showReasonForReferral() {
            var selectElement = document.getElementById("external_referrals");
            var selectedOptions = selectElement.selectedOptions;
            var reasonForReferralSection = document.getElementById("reasonForReferralSection");

            if (selectedOptions.length > 0) {
                reasonForReferralSection.classList.remove('d-none');
            } else {
                reasonForReferralSection.classList.add('d-none');
            }
        }


        @if (!empty($SchoolHealthPhysician['Reason_for_Referral']))

        var reasonForReferralSection = document.getElementById("reasonForReferralSection");

        reasonForReferralSection.classList.remove('d-none');
        @endif









        // for tab 2

        function followUp1() {
            let follow_up_Required1 = document.getElementById("Follow_up_Required1");
            let selectedValue = follow_up_Required1.value;
            if (selectedValue === "Yes") {
                let follow_up_show1 = document.getElementById('follow_up_show1');
                follow_up_show1.classList.remove('d-none');

                $("#Reason_for_Follow_up1").attr('required', true);
                $("#Follow_up_Date1").attr('required', true);

            } else {
                let follow_up_show1 = document.getElementById('follow_up_show1');
                follow_up_show1.classList.add('d-none');

                $("#Reason_for_Follow_up1").attr('required', false);
                $("#Follow_up_Date1").attr('required', false);
            }
        }

        @if (
            !empty($NutritionistHistoryEvaluationSection['Follow_up_Required1']) &&
                $NutritionistHistoryEvaluationSection['Follow_up_Required1'] == 'Yes')

        followUp1()
        @endif
        function showReasonForReferral1() {
            let selectElement = document.getElementById("external_referrals1");
            let selectedOptions = selectElement.selectedOptions;
            let reasonForReferralSection1 = document.getElementById("reasonForReferralSection1");

            if (selectedOptions.length > 0) {
                reasonForReferralSection1.classList.remove('d-none');
            } else {
                reasonForReferralSection1.classList.add('d-none');
            }
        }




        @if (!empty($NutritionistHistoryEvaluationSection['Reason_for_Referral1']))

        var reasonForReferralSection1 = document.getElementById("reasonForReferralSection1");

        reasonForReferralSection1.classList.remove('d-none');
        @endif



        // for tab 3

        function followUp2() {
            let follow_up_Required2 = document.getElementById("Follow_up_Required2");
            let selectedValue = follow_up_Required2.value;
            if (selectedValue === "Yes") {
                let follow_up_show2 = document.getElementById('follow_up_show2');
                follow_up_show2.classList.remove('d-none');
                $("#Follow_up_Date2").attr("required", true)
                $("#Reason_for_Follow_up2").attr("required", true)
            } else {
                let follow_up_show2 = document.getElementById('follow_up_show2');
                follow_up_show2.classList.add('d-none');
                $("#Follow_up_Date2").attr("required", false);
                $("#Reason_for_Follow_up2").attr("required", false)

            }
        }


        @if (
            !empty($PsychologistHistoryAssessmentSection['Follow_up_Required2']) &&
                $PsychologistHistoryAssessmentSection['Follow_up_Required2'] == 'Yes')

        followUp2()
        @endif


        function showReasonForReferral2() {
            let selectElement = document.getElementById("external_referrals2");
            let selectedOptions = selectElement.selectedOptions;
            let reasonForReferralSection2 = document.getElementById("reasonForReferralSection2");

            if (selectedOptions.length > 0) {

                reasonForReferralSection2.classList.remove('d-none');
                $("#Reason_for_Referral2").attr("required", true)


            } else {
                reasonForReferralSection2.classList.add('d-none');
                $("#Reason_for_Referral2").attr("required", false)

            }
        }


        @if (
            !empty($PsychologistHistoryAssessmentSection) &&
                !empty($PsychologistHistoryAssessmentSection['Reason_for_Referral2']))

        var reasonForReferralSection2 = document.getElementById("reasonForReferralSection2");

        reasonForReferralSection2.classList.remove('d-none');
        @endif


        $("#Provisional_Diagnosis").select2({
            placeholder: "Select Provisional Diagnosis",
            allowClear: true
        });
        $("#internal_referrals").select2({
            placeholder: "Select Internal Referrals",
            allowClear: true
        });
        $("#external_referrals").select2({
            placeholder: "Select Internal Referrals",
            allowClear: true
        });

        // for tab 2

        $("#Provisional_Diagnosis1").select2({
            placeholder: "Select Provisional Diagnosis",
            allowClear: true
        });
        $("#internal_referrals1").select2({
            placeholder: "Select Internal Referrals",
            allowClear: true
        });
        $("#external_referrals1").select2({
            placeholder: "Select Internal Referrals",
            allowClear: true
        });

        // for tab 3

        $("#Provisional_Diagnosis2").select2({
            placeholder: "Select Provisional Diagnosis",
            allowClear: true
        });
        $("#internal_referrals2").select2({
            placeholder: "Select Internal Referrals",
            allowClear: true
        });
        $("#external_referrals2").select2({
            placeholder: "Select Internal Referrals",
            allowClear: true
        });
        // $("#Clinical_Examination").select2({
        //     placeholder: "Select Physical Appearance",
        //     allowClear: true
        // });
    </script>
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
