@extends('admin.main')
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


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

        input,
        select {
            height: 50px !important;
            border-radius: 8px !important;
            border: 1px solid rgba(0, 0, 0, .15) !important;
            background-color: transparent !important;
        }
    </style>



    <div class="container">
        <h1 class="mb-4 mt-5">Medical History</h1>


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

        {{-- <p id="timer">Time: 0 seconds</p> --}}
        <form id="multiStepForm"
            @if (!empty($StudentBiodata)) action="{{ route('StudentBiodata') }}/{{ $StudentBiodata['id'] }}"  @else action="{{ route('StudentBiodata') }}" @endif
            method="POST">

            <!-- Step-one -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="step active mb-5" id="step1">
                <h3>Student Biodata</h3>
                <div class="form-row">



                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="GRNo">GR Number</label>
                            <input placeholder="GR Number" type="number" step="any" class="form-control" id="GRNo"
                                name="GRNo"
                                @if (!empty($StudentBiodata['GRNo'])) value="{{ $StudentBiodata['GRNo'] }}"
                            @else

                            @if (isset($_GET['grno']))

                            value="{{ $_GET['grno'] }}"

                            @else
                            value="{{ old('GRNo') }}" @endif
                                @endif

                            required>
                            <span class="error-message"></span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                @if (!empty($StudentBiodata['dob'])) value="{{ $StudentBiodata['dob'] }}"
                            @else
                            @if (isset($_GET['dob']))

                            value="{{ $_GET['dob'] }}"

                            @else
                            value="{{ old('dob') }}" @endif
                                @endif
                            >
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input placeholder="Name" type="text" class="form-control" id="name" name="name"
                                @if (!empty($StudentBiodata['name'])) value="{{ $StudentBiodata['name'] }}"
                            @else
                           
                            
                             @if (isset($_GET['name']))

                               value="{{ $_GET['name'] }}"

                               @else
                               value="{{ old('name') }}" @endif
                                @endif
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="class">Class</label>
                            <input placeholder="Class" type="number" step="any" class="form-control" id="class"
                                name="class"
                                @if (!empty($StudentBiodata['class'])) value="{{ $StudentBiodata['class'] }}"
                            @else
                            value="{{ old('class') }}" @endif
                                required>
                            <span class="error-message"></span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="B_Form_Number">B-Form Number</label>
                            <input placeholder="B Form Number" type="number" step="any" class="form-control"
                                id="B_Form_Number" name="B_Form_Number"
                                @if (!empty($StudentBiodata['B_Form_Number'])) value="{{ $StudentBiodata['B_Form_Number'] }}"
                                @else
                                value="{{ old('B_Form_Number') }}" @endif>
                            <span class="error-message"></span>
                        </div>
                    </div>



                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input placeholder="Age" type="number" step="any" class="form-control" id="age"
                                name="age"
                                @if (!empty($StudentBiodata['age'])) value="{{ $StudentBiodata['age'] }}"
                                @else
                               
                                
                                @if (isset($_GET['age']))

                               value="{{ $_GET['age'] }}"

                               @else
                               value="{{ old('age') }}" @endif
                                @endif
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender</label>




                            {{-- <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select</option>
                                <option value="male"
                                    {{ !empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'male' ? 'selected' : (old('gender') == 'male' ? 'selected' : '') }}>
                                    Male</option>
                                <option value="female"
                                    {{ !empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'female' ? 'selected' : (old('gender') == 'female' ? 'selected' : '') }}>
                                    Female</option>
                                <option value="other"
                                    {{ !empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'other' ? 'selected' : (old('gender') == 'other' ? 'selected' : '') }}>
                                    Other</option>
                            </select> --}}


                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select</option>

                                {{-- <option value="male"
                                    {{ !empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'male' ? 'selected' : (old('gender') == 'male' ? 'selected' : '') }}>
                                    Male</option>
                              
                                    <option value="female"
                                    {{ !empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'female' ? 'selected' : (old('gender') == 'female' ? 'selected' : '') }}>
                                    Female</option>
                               
                                    <option value="other"
                                    {{ !empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'other' ? 'selected' : (old('gender') == 'other' ? 'selected' : '') }}>
                                    Other
                                </option> --}}

                                <option value="male"
                                    {{ (isset($_GET['gender']) && $_GET['gender'] == 'male') || (!empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'male') || old('gender') == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>

                                <option value="female"
                                    {{ (isset($_GET['gender']) && $_GET['gender'] == 'female') || (!empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'female') || old('gender') == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>

                                <option value="other"
                                    {{ (isset($_GET['gender']) && $_GET['gender'] == 'other') || (!empty($StudentBiodata['gender']) && $StudentBiodata['gender'] == 'other') || old('gender') == 'other' ? 'selected' : '' }}>
                                    Other
                                </option>

                            </select>




                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="School_Name">School Name</label>


                            <select class="form-control" id="School_Name" name="School_Name" required>
                                <option value="">Select</option>

                                @if (!empty($school))
                                    @foreach ($school as $item)
                                        <option value="{{ $item->id }}"
                                            @if (!empty($StudentBiodata['School_Name']) && $StudentBiodata['School_Name'] == $item->id) selected 
                                            @elseif(isset($_GET['school']) && $_GET['school'] == $item->id)
                                            selected
                                            @elseif (old('School_Name') == $item->id) 
                                                selected @endif>
                                            {{ $item->school_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>


                            {{-- <select class="form-control" id="School_Name" name="School_Name" required>
                                <option value="">Select</option>

                            @if (!empty($school))
                                
                            @if (!empty($StudentBiodata['School_Name'])) value="{{ $StudentBiodata['School_Name'] }}"
                            @else
                            value="{{ old('School_Name') }}" @endif


                                @foreach ($school as $item)


                                <option value="{{ $item->id }}">{{ $item->school_name }}</option>
                            @endforeach

                            @endif
                        </select> --}}




                            {{-- <input placeholder="School Name" type="text" class="form-control" id="School_Name"
                                name="School_Name"
                                @if (!empty($StudentBiodata['School_Name'])) value="{{ $StudentBiodata['School_Name'] }}"
                                @else
                                value="{{ old('School_Name') }}" @endif
                                required> --}}



                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Contact_Number"> Contact Number</label>
                            <input placeholder="Contact Number" type="number" class="form-control" id="Contact_Number"
                                name="Contact_Number"
                                @if (!empty($StudentBiodata['Contact_Number'])) value="{{ $StudentBiodata['Contact_Number'] }}"
                                @else
                                value="{{ old('Contact_Number') }}" @endif
                                required>
                        </div>
                    </div>
                    {{-- Emergency contact field added --}}
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Emergency_Contact_Number">Emergency Contact Number</label>
                            <input placeholder="Emergency Contact Number" type="number" class="form-control"
                                id="Emergency_Contact_Number" name="Emergency_Contact_Number"
                                @if (!empty($StudentBiodata['Emergency_Contact_Number'])) value="{{ $StudentBiodata['Emergency_Contact_Number'] }}"
                                @elseif(isset($_GET['emergency_contact_number']))
                                value="{{ $_GET['emergency_contact_number'] }}"
                                @else
                                value="{{ old('Emergency_Contact_Number') }}" @endif
                                required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="type_of_encounter">Type Of Encounter</label>

                            <select class="form-control" id="type_of_encounter" name="type_of_encounter" required>
                                <option value="">Select</option>
                                <option value="Case identified through Screening"
                                    {{ !empty($StudentBiodata['type_of_encounter']) && $StudentBiodata['type_of_encounter'] == 'Case identified through Screening' ? 'selected' : (old('type_of_encounter') == 'Case identified through Screening' ? 'selected' : '') }}>
                                    Case identified through Screening</option>
                                <option value="New Case"
                                    {{ !empty($StudentBiodata['type_of_encounter']) && $StudentBiodata['type_of_encounter'] == 'New Case' ? 'selected' : (old('type_of_encounter') == 'New Case' ? 'selected' : '') }}>
                                    New Case</option>
                                <!-- <option value="Follow-up Case"
                                    {{ !empty($StudentBiodata['type_of_encounter']) && $StudentBiodata['type_of_encounter'] == 'Follow-up Case' ? 'selected' : (old('type_of_encounter') == 'Follow-up Case' ? 'selected' : '') }}>
                                    Follow-up Case</option> -->
                                    <option value="Student Identified Through Teachers Training Session"
                                    {{ !empty($StudentBiodata['type_of_encounter']) && $StudentBiodata['type_of_encounter'] == 'Student Identified Through Teachers Training Session' ? 'selected' : (old('type_of_encounter') == 'Student Identified Through Teachers Training Session' ? 'selected' : '') }}>
                                    Student Identified Through Teachers Training Session</option>
                            </select>

                        </div>
                    </div>
                
                    
                    <div class="form-group col-md-6">
                        <div class="form-group">

                            <label for="designation">Designation </label>
                            <select name="designation" id="designation" class="form-control">
                                <option value="">Select</option>

                                {{-- <option value="0" {{ old('designation',  $StudentBiodata) == 0 ? 'selected' : '' }}>Admin</option> --}}
                                <option value="1"
                                    {{ old('designation', $StudentBiodata) == 1 ? 'selected' : '' }}>Doctor</option>
                                <option value="2"
                                    {{ old('designation', $StudentBiodata) == 2 ? 'selected' : '' }}>Nutritionist
                                </option>
                                <option value="3"
                                    {{ old('designation', $StudentBiodata) == 3 ? 'selected' : '' }}>Psychologist
                                </option>
                                
                                {{-- <option value="4"
                                    {{ old('designation', $StudentBiodata) == 4 ? 'selected' : '' }}>Founder and
                                    Director</option>
                                <option value="5"
                                    {{ old('designation', $StudentBiodata) == 5 ? 'selected' : '' }}>Co Founder And
                                    chief Ooperating Officer </option>
                                <option value="6"
                                    {{ old('designation', $StudentBiodata) == 6 ? 'selected' : '' }}>Chief Advisor
                                    And Business Support Manager</option>
                                <option value="7"
                                    {{ old('designation', $StudentBiodata) == 7 ? 'selected' : '' }}>Clinical
                                    Operations Lead</option>
                                <option value="8"
                                    {{ old('designation', $StudentBiodata) == 8 ? 'selected' : '' }}>Adminstrive
                                    Coordinator</option>
                                <option value="9"
                                    {{ old('designation', $StudentBiodata) == 9 ? 'selected' : '' }}>Clinical
                                    Psychologist</option>
                                <option value="10"
                                    {{ old('designation', $StudentBiodata) == 10 ? 'selected' : '' }}>Clinical
                                    Nutritionist</option>
                                <option value="11"
                                    {{ old('designation', $StudentBiodata) == 11 ? 'selected' : '' }}>School Health
                                    Physican (KIRAN FOUNDATION)</option>
                                <option value="12"
                                    {{ old('designation', $StudentBiodata) == 12 ? 'selected' : '' }}>School Health
                                    Physican (SAVE THE FUTURE)</option>
                                <option value="13"
                                    {{ old('designation', $StudentBiodata) == 13 ? 'selected' : '' }}>School Health
                                    Physican (THE SET SCHOOL)</option>
                                <option value="14"
                                    {{ old('designation', $StudentBiodata) == 14 ? 'selected' : '' }}>School Health
                                    Physican (LOCUM)</option> --}}

                            </select>

                        </div>
                    </div>
                
                </div>





                <button type="submit" class="btn btn-primary ">Next</button>



            </div>



        </form>

    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            /* Gr no and dob triggered*/
            $(document).on("keyup blur", "#dob", function() {

                var GrNo = $("#GRNo").val();
                var dob = $("#dob").val();

                var base_url = '{!! Route('GetDetails') !!}';

                $.ajax({
                    url: base_url,
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        GrNo: GrNo,
                        dob: dob
                    },

                    dataType: 'json',

                    success: function(resp) {

                        /*console.log("resp id " + resp.id);
                        console.log("resp status " + resp['status']);
                        console.log("resp " + resp);
                        console.log("resp length " + resp.length);
                        console.log("resp " + JSON.stringify(resp));*/

                        if (resp['status'] === true) {


                            $("#name").val(resp['Data']['name']);
                            // $("#dob").val(resp['Data']['dob']).change();
                            $("#gender").val(resp['Data']['gender']);
                            $("#BloodGroup").val(resp['Data']['blood_group']);
                            $("#contact").val(resp['Data']['phone']);


                        } else {

                            $("#name").val('');
                            // $("#dob").val('').change();
                            $("#gender").val('');
                            $("#BloodGroup").val('');
                            $("#contact").val('');

                        }



                    }
                });

            });


            var currentDate = new Date().toISOString().split('T')[0];
            $('#dob').attr('max', currentDate);

            $('.prevStep').click(function() {
                var currentStep = $(this).closest('.step');
                var prevStep = currentStep.prev('.step');

                currentStep.removeClass('active');
                prevStep.addClass('active');
            });

            $('.form-group').on('blur change', '.error-border', function() {
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
                    function() {
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

            $("#height").on("keyup change", function(e) {
                var height = $('#height').val();
                if (height != '') {
                    $('#weight').removeAttr("disabled");
                } else {
                    $('#weight').attr("disabled", true);
                }

            });

            $("#weight, #height").on("keyup change", function(e) {
                var height = $('#height').val();
                var weight = $('#weight').val();
                var bmi = $('#bmi');
                if (height != '' && height > 0 && weight != '' && weight > 0) {
                    var result = (weight / height / height) * 10000;
                    $('#bmi').val(result.toFixed(2));
                    if (result <= 18.4 || result >= 24.10) {
                        $("#bmi").addClass("bg-danger");
                    } else {
                        $("#bmi").removeClass("bg-danger");
                    }
                }
            });

            $("#Question_No_6_Blood_Pressure_Diastolic, #Question_No_6_Blood_Pressure_Systolic").on("keyup change",
                function(e) {
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
                            console.log(age + '-' + systolic);
                            $("#Question_No_6_Blood_Pressure_Systolic").addClass("bg-danger");
                        } else {
                            $("#Question_No_6_Blood_Pressure_Systolic").removeClass("bg-danger");
                        }
                        if (diastolic <= 61 || diastolic >= 95) {
                            console.log(age + '-' + diastolic);
                            $("#Question_No_6_Blood_Pressure_Diastolic").addClass("bg-danger");
                        } else {
                            $("#Question_No_6_Blood_Pressure_Diastolic").removeClass("bg-danger");
                        }
                    }
                });
            $("#Question_No_7_Pulse").on("keyup change", function(e) {
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



            $('#any_neck_swelling').on('change', function() {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.any_neck_swelling_specify').removeClass('d-none');
                } else {
                    $('.any_neck_swelling_specify').addClass('d-none');
                }

            });

            $('#any_history_of_abdominal_pain').on('change', function() {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.any_history_of_abdominal_pain_specify').removeClass('d-none');
                } else {
                    $('.any_history_of_abdominal_pain_specify').addClass('d-none');
                }

            });
            $('#any_menstrual_abnormality').on('change', function() {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.any_menstrual_abnormality_specify').removeClass('d-none');
                } else {
                    $('.any_menstrual_abnormality_specify').addClass('d-none');
                }

            });

            $('#limitations_range_motion').on('change', function() {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.limitations_range_motion_specify').removeClass('d-none');
                } else {
                    $('.limitations_range_motion_specify').addClass('d-none');
                }

            });

            $('#lymph_node').on('change', function() {
                var result = $(this).val();
                if (result === 'abnormal') {
                    $('.lymph_node_specify').removeClass('d-none');
                } else {
                    $('.lymph_node_specify').addClass('d-none');
                }

            });

            $('#do_you_have_any_Allergies').on('change', function() {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.do_you_have_any_Allergies_specify').removeClass('d-none');
                } else {
                    $('.do_you_have_any_Allergies_specify').addClass('d-none');
                }

            });

            $('#menarche_age').on('change', function() {
                var result = $(this).val();
                if (result === 'none_of_the_above') {
                    $('.menarche_age_specify').removeClass('d-none');
                    $(".menstrual_abnormality option[value='']").attr('selected', 'selected');

                } else {
                    $('.menarche_age_specify').addClass('d-none');
                    $('.menstrual_abnormality_specify').addClass('d-none');

                }
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
            $('#followup_required').on('change', function() {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.reffered').removeClass('d-none');
                    $(".reffered option[value='']").attr('selected', 'selected');
                } else {
                    $('#referred_by').val('');
                    $('.reffered').addClass('d-none');
                }
            });

            $('#menstrual_abnormality').on('change', function() {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.menstrual_abnormality_specify').removeClass('d-none');
                } else {
                    $('.menstrual_abnormality_specify').addClass('d-none');
                }

            });

            $('#immunization_card').on('change', function() {
                var result = $(this).val();
                if (result === 'No') {
                    $('.immunization_card_specify').removeClass('d-none');
                } else {
                    $('.immunization_card_specify').addClass('d-none');
                }

            });

            $("#dob").on("change", function() {

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

            $('#submit').on('click', function(e) {

                if (!validate(e, true)) return;
                //    console.log(validate());
                var form = $('#multiStepForm');
                var formData = form.serializeArray();
                var secondsOnSubmit;


                var endTime = new Date();
                var timeDiff = endTime - startTime;
                secondsOnSubmit = Math.round(timeDiff / 1000);

                var formData = $('#multiStepForm').serializeArray();


                $.each(formData, function(index, field) {
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
                    beforeSend: function() {

                    },
                    success: function(response) {
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
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            var form = $('#multiStepForm');
            var startTime;
            var timerInterval;
            var secondsOnSubmit;

            form.one('focusin', function() {
                // Set the start time when any form field is focused
                startTime = new Date();

                // Start a timer interval to update the display every second
                timerInterval = setInterval(function() {
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
        const addictionContainer = document.getElementById('addictionContainer');

        // Add change event listener to the dropdown
        selectElement.addEventListener('change', function() {
            // If 'Yes' is selected, show the second form group; otherwise, hide it
            if (this.value === 'Yes') {
                addictionContainer.classList.remove('d-none');
            } else {
                addictionContainer.classList.add('d-none');
            }
        });

        const selectElement_addict = document.getElementById('addiction');
        // Select the container of the textarea
        const otherAddictionContainer = document.getElementById('otherAddictionContainer');

        // Add change event listener to the dropdown
        selectElement_addict.addEventListener('change', function() {
            // If 'other' is selected, show the textarea; otherwise, hide it
            if (this.value === 'other') {
                otherAddictionContainer.classList.remove('d-none');
            } else {
                otherAddictionContainer.classList.add('d-none');
            }
        });


        const food_allergies = document.getElementById('food_allergies');
        // Select the container of the textarea
        const food_allergiesContainer = document.getElementById('food_allergiesContainer');

        // Add change event listener to the dropdown
        food_allergies.addEventListener('change', function() {
            // If 'other' is selected, show the textarea; otherwise, hide it
            if (this.value === 'Yes') {
                food_allergiesContainer.classList.remove('d-none');
            } else {
                food_allergiesContainer.classList.add('d-none');
            }
        });
    </script>
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
