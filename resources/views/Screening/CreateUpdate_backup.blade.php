@php
    use Illuminate\Support\Facades\DB;

@endphp
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
            background-color: transparent;
            padding: 30px;
            border-radius: 10px;
            /* box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); */
            border: 1px solid rgba(0, 0, 0, .15);
            width: 100%;
        }

        input,
        select {
            height: 50px !important;
            border-radius: 8px !important;
            border: 1px solid rgba(0, 0, 0, .15) !important;
            background-color: transparent;
        }

        .error-border {
            border: 2px solid #dc3545 !important;
        }
    </style>



    <div class="container">
        <h1 class="mb-4 mt-5">Child Health Checkup Survey</h1>
        
        <form id="multiStepForm">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            {{-- <label for="updateID">updateID</label> --}}
            <input type="hidden" readonly name="updateID"
                value="{{ isset($_GET['updateID']) ? $_GET['updateID'] : (isset($details['id']) ? $details['id'] : 0) }}">



            {{-- <label for="screeningFormId">screeningFormId</label> --}}
            <input type="hidden" readonly name="screeningFormId"
                value="{{ isset($_GET['screeningFormId']) ? $_GET['screeningFormId'] : (isset($details['screeningFormId']) ? $details['screeningFormId'] : 0) }}">



            <!-- Step One - Bio Data -->

            <div class="step active mb-5" id="step1">
                <h3>Bio Data</h3>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Name">Name</label>

                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ isset($_GET['name']) ? $_GET['name'] : (isset($details['name']) ? $details['name'] : old('name')) }}"
                                required>

                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="GName">Guardian Name</label>

                            <input type="text" class="form-control" id="guardianname" name="guardianname"
                                value="{{ isset($_GET['guardianname']) ? $_GET['guardianname'] : (isset($details['guardianname']) ? $details['guardianname'] : old('guardianname')) }}"
                                required>




                            <span class="error-message"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                                <label for="contact">Emergency Contact Number</label>

                                <input type="text" class="form-control" id="Emergency_Contact_Number"
                                    name="Emergency_Contact_Number"
                                    value="{{ isset($_GET['emergency_contact_number']) ? $_GET['emergency_contact_number'] : (old('Emergency_Contact_Number') ?: (isset($details['emergency_contact_number']) ? $details['emergency_contact_number'] : '')) }}"
                                    required>
                        </div>


                    </div>




                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="class">Class</label>

                            <select class="form-control" id="class" name="class" required>
                                <option value="">Select</option>
                                <option value="0"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '0') || (isset($details['class']) && $details['class'] == '0') || old('class') == '0' ? 'selected' : '' }}>
                                    Play group</option>
                                <option value="00"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '00') || (isset($details['class']) && $details['class'] == '00') || old('class') == '00' ? 'selected' : '' }}>
                                    KG-1</option>
                                <option value="000"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '000') || (isset($details['class']) && $details['class'] == '000') || old('class') == '000' ? 'selected' : '' }}>
                                    KG-2</option>
                                <option value="1"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '1') || (isset($details['class']) && $details['class'] == '1') || old('class') == '1' ? 'selected' : '' }}>
                                    1</option>
                                <option value="2"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '2') || (isset($details['class']) && $details['class'] == '2') || old('class') == '2' ? 'selected' : '' }}>
                                    2</option>
                                <option value="3"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '3') || (isset($details['class']) && $details['class'] == '3') || old('class') == '3' ? 'selected' : '' }}>
                                    3</option>
                                <option value="4"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '4') || (isset($details['class']) && $details['class'] == '4') || old('class') == '4' ? 'selected' : '' }}>
                                    4</option>
                                <option value="5"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '5') || (isset($details['class']) && $details['class'] == '5') || old('class') == '5' ? 'selected' : '' }}>
                                    5</option>
                                <option value="6"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '6') || (isset($details['class']) && $details['class'] == '6') || old('class') == '6' ? 'selected' : '' }}>
                                    6</option>
                                <option value="7"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '7') || (isset($details['class']) && $details['class'] == '7') || old('class') == '7' ? 'selected' : '' }}>
                                    7</option>
                                <option value="8"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '8') || (isset($details['class']) && $details['class'] == '8') || old('class') == '8' ? 'selected' : '' }}>
                                    8</option>
                                <option value="9"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '9') || (isset($details['class']) && $details['class'] == '9') || old('class') == '9' ? 'selected' : '' }}>
                                    9</option>
                                <option value="10"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '10') || (isset($details['class']) && $details['class'] == '10') || old('class') == '10' ? 'selected' : '' }}>
                                    10</option>
                                <option value="11"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '11') || (isset($details['class']) && $details['class'] == '11') || old('class') == '11' ? 'selected' : '' }}>
                                    11</option>
                                <option value="12"
                                    {{ (isset($_GET['class']) && $_GET['class'] == '12') || (isset($details['class']) && $details['class'] == '12') || old('class') == '12' ? 'selected' : '' }}>
                                    12</option>
                            </select>


                            <span class="error-message"></span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">


                        <div class="form-group">
                            <label for="dob">School</label>

                            <select class="form-control" id="school" name="school" required>
                                <option value="">Select</option>
                                @if (!empty($school))
                                    @foreach ($school as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($_GET['school']) && $_GET['school'] == $item->id) || (isset($details['school']) && $details['school'] == $item->id) || old('school') == $item->id ? 'selected' : '' }}>
                                            {{ $item->school_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>


                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="gender">City</label>

                            <select class="form-control" id="city" name="city" required>
                                <option value="">Select</option>
                                @if (!empty($city))
                                    @foreach ($city as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($_GET['city']) && $_GET['city'] == $item->id) || (isset($details['city']) && $details['city'] == $item->id) || old('city') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>



                        </div>
                    </div>
                    <div class="form-group col-md-6">

                        <div class="form-group">
                            <label for="age">Area</label>

                            <select class="form-control" id="area" name="area" required>
                                <option value="">Select</option>
                                @if (!empty($area))
                                    @foreach ($area as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($_GET['area']) && $_GET['area'] == $item->id) || (isset($details['area']) && $details['area'] == $item->id) || old('area') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>


                        </div>
                    </div>
                    <div class="form-group col-md-6">

                    
                        <div class="form-group">
                                <label for="dob">Date Of Birth</label>

                                <input type="date" class="form-control" id="dob" name="dob"
                                    value="{{ isset($_GET['dob']) ? $_GET['dob'] : (old('dob') ?: (isset($details['dob']) ? $details['dob'] : '')) }}"
                                    required>
                        </div>
                    

                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="age">Age (Year:Month)</label>

                            <input type="text" class="form-control" id="age" name="age" readonly required>

                            {{-- <input type="number" class="form-control" id="age" name="age" readonly required
                                value="{{ isset($_GET['age']) ? $_GET['age'] : (old('age') ?: (isset($details['age']) ? $details['age'] : '')) }}"> --}}


                        </div>
                    </div>
                    <div class="form-group col-md-6">

                    
                    
                        <div class="form-group">
                            <label for="gender">Gender</label>


                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select</option>

                                <option value="male"
                                    {{ (isset($_GET['gender']) && $_GET['gender'] == 'male') || (isset($details['gender']) && $details['gender'] == 'male') || old('gender') == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>

                                <option value="female"
                                    {{ (isset($_GET['gender']) && $_GET['gender'] == 'female') || (isset($details['gender']) && $details['gender'] == 'female') || old('gender') == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>

                                <option value="other"
                                    {{ (isset($_GET['gender']) && $_GET['gender'] == 'other') || (isset($details['gender']) && $details['gender'] == 'other') || old('gender') == 'other' ? 'selected' : '' }}>
                                    Other
                                </option>
                            </select>


                        </div>
                    
                    
                    
                    
                    
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="contact">GR Number ( only numeric value )</label>

                            <input type="number" class="form-control" id="Gr_Number" name="Gr_Number"
                                value="{{ isset($_GET['gr_number']) ? $_GET['gr_number'] : (old('Gr_Number') ?: (isset($details['gr_number']) ? $details['gr_number'] : '')) }}"
                                required>


                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Medical_condition">Any Known Medical Condition</label>

                            <input type="text" class="form-control" id="Any_Known_Medical_Condition"
                                name="Any_Known_Medical_Condition"
                                value="{{ isset($_GET['any_known_medical_condition']) ? $_GET['any_known_medical_condition'] : (old('Any_Known_Medical_Condition') ?: (isset($details['any_known_medical_condition']) ? $details['any_known_medical_condition'] : '')) }}"
                                required>


                        </div>
                    </div>



                    <div class="form-group col-md-6">
                        <label for="address">Address</label>

                        <input type="text" class="form-control" id="address" name="Address"
                            value="{{ isset($_GET['address']) ? $_GET['address'] : (isset($details['address']) ? $details['address'] : old('Address')) }}"
                            required>


                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label for="contact">Blood Group</label>




                            <?php
                            // Use the blood group from $_GET or $details (if available) or default to an empty string
                            $selectedBloodGroup = isset($_GET['blood_group']) ? $_GET['blood_group'] : (isset($details['blood_group']) ? $details['blood_group'] : '');
                            ?>

                            <select class="form-control" id="blood_group" name="Blood_group" required>
                                <option value="">Select</option>
                                <option value="A+" {{ $selectedBloodGroup == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ $selectedBloodGroup == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ $selectedBloodGroup == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ $selectedBloodGroup == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="O+" {{ $selectedBloodGroup == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ $selectedBloodGroup == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="AB+" {{ $selectedBloodGroup == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ $selectedBloodGroup == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="Unknown" {{ $selectedBloodGroup == 'Unknown' ? 'selected' : '' }}>Unknown
                                </option>
                            </select>



                        </div>
                    </div>
                    <div class="form-roup col-md-12">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label>

                            <textarea class="form-control" name="bio_data_comment" placeholder="Comment here" cols="50">{{ isset($_GET['bio_data_comment']) ? $_GET['bio_data_comment'] : (isset($details['bio_data_comment']) ? $details['bio_data_comment'] : old('bio_data_comment')) }}</textarea>


                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>

            <!-- Step Two - Vitals/BMI -->
            <div class="step" id="step2">
                <h3>Vitals/BMI</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group height">
                            <div class="group-form">
                                <label for="height" class="width-100">Height (cm):</label>
                                <input type="number" class="form-control" id="height" name="Question_No_1_Height"
                                    placeholder="Enter height in cm (e.g., 170)"
                                    value="{{ isset($_GET['Question_No_1_Height']) ? $_GET['Question_No_1_Height'] : (old('Question_No_1_Height') ?: (isset($details['Question_No_1_Height']) ? $details['Question_No_1_Height'] : '')) }}"
                                    required>

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">

                        <div class="form-group weight">
                            <div class="group-form">
                                <label for="weight" class="width-100">Question No.2: Weight (kg):</label>
                                <input type="number" class="form-control" id="weight" name="Question_No_2_Weight"
                                    placeholder="Weight in kg (e.g., 65)"
                                    value="{{ isset($_GET['Question_No_2_Weight']) ? $_GET['Question_No_2_Weight'] : (old('Question_No_2_Weight') ?: (isset($details['Question_No_2_Weight']) ? $details['Question_No_2_Weight'] : '')) }}"
                                    required>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="bmi">Question No.3: BMI (Red field means abnomality )</label>
                            <span id="bmishow"></span>

                            <!-- BMI Field (auto-calculated) -->
                            <input type="number" class="form-control" id="bmi" name="Question_No_3_BMI"
                                placeholder="Auto calculate"
                                value="{{ isset($_GET['Question_No_3_BMI']) ? $_GET['Question_No_3_BMI'] : (old('Question_No_3_BMI') ?: (isset($details['Question_No_3_BMI']) ? $details['Question_No_3_BMI'] : '')) }}"
                                readonly required>




                        </div>
                        <input type="hidden" class="form-control" id="bmiresult" name="bmiresult"
                            value="{{ isset($_GET['bmiresult']) ? $_GET['bmiresult'] : (old('bmiresult') ?: (isset($details['bmiresult']) ? $details['bmiresult'] : '')) }}">


                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="temp">Question No.4: Body Temperature</label>
                            <div class="row">
                                <div class="form-group col-md-8 pr-2">

                                    <input type="number" class="form-control" id="Question_No_4_Body_Temperature"
                                        name="Question_No_4_Body_Temperature"
                                        value="{{ isset($_GET['Question_No_4_Body_Temperature']) ? $_GET['Question_No_4_Body_Temperature'] : (old('Question_No_4_Body_Temperature') ?: (isset($details['Question_No_4_Body_Temperature']) ? $details['Question_No_4_Body_Temperature'] : '')) }}"
                                        required>



                                </div>
                                <div class="form-group col-md-4 pl-0">
                                    {{-- <select class="form-control" id="bodytempunit" name="Bodytempunit" required>
                                        <option value="">Select Unit</option>
                                        <option value="f">f (fahrenheit)</option>
                                        
                                    </select> --}}
                                    <input type="hidden" id="bodytempunit" name="Bodytempunit" value="f" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="blood">Question No.5: Blood Pressure (Systolic) (Red field means abnomality
                                )</label> <span id="Blood_Pressure_Systolic"></span>


                            <input type="number" class="form-control" id="Question_No_5_Blood_Pressure_Systolic"
                                name="Question_No_5_Blood_Pressure_Systolic" placeholder="Enter Systolic BP (e.g., 120)"
                                value="{{ isset($_GET['Question_No_5_Blood_Pressure_Systolic']) ? $_GET['Question_No_5_Blood_Pressure_Systolic'] : (old('Question_No_5_Blood_Pressure_Systolic') ?: (isset($details['Question_No_5_Blood_Pressure_Systolic']) ? $details['Question_No_5_Blood_Pressure_Systolic'] : '')) }}"
                                required>



                        </div>

                        <input type="text" class="form-control" id="systolicresult" name="systolicresult" readonly
                            value="{{ isset($_GET['systolicresult']) ? $_GET['systolicresult'] : (old('systolicresult') ?: (isset($details['systolicresult']) ? $details['systolicresult'] : '')) }}">


                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="blood">Question No.6: Blood Pressure (Diastolic) (Red field means abnomality
                                ) </label> <span id="Blood_Pressure_Diastolic"></span>

                            <input type="number" class="form-control" id="Question_No_6_Blood_Pressure_Diastolic"
                                name="Question_No_6_Blood_Pressure_Diastolic"
                                value="{{ isset($_GET['Question_No_6_Blood_Pressure_Diastolic']) ? $_GET['Question_No_6_Blood_Pressure_Diastolic'] : (old('Question_No_6_Blood_Pressure_Diastolic') ?: (isset($details['Question_No_6_Blood_Pressure_Diastolic']) ? $details['Question_No_6_Blood_Pressure_Diastolic'] : '')) }}"
                                required>


                        </div>

                        <input type="text" class="form-control" id="diastolicresult" name="diastolicresult"
                            value="{{ isset($_GET['diastolicresult']) ? $_GET['diastolicresult'] : (old('diastolicresult') ?: (isset($details['diastolicresult']) ? $details['diastolicresult'] : '')) }}"
                            readonly>


                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="pulse">Question No.7: Pulse (Red field means abnomality )</label>

                            <input type="text" class="form-control" id="Question_No_7_Pulse"
                                name="Question_No_7_Pulse"
                                value="{{ isset($_GET['Question_No_7_Pulse']) ? $_GET['Question_No_7_Pulse'] : (old('Question_No_7_Pulse') ?: (isset($details['Question_No_7_Pulse']) ? $details['Question_No_7_Pulse'] : '')) }}"
                                required>


                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label>

                            <textarea name="vitals_bmi_comment" placeholder="Comment here" cols="50">{{ isset($_GET['vitals_bmi_comment']) ? $_GET['vitals_bmi_comment'] : (old('vitals_bmi_comment') ?: (isset($details['vitals_bmi_comment']) ? $details['vitals_bmi_comment'] : '')) }}</textarea>


                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Three - General Apperance-->
            <div class="step" id="step3">
                <h3>General Apperance</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="field2">Question No.8: Normal Posture/Gait</label>

                            <select class="form-control" id="Question_No_8_Normal_Posture_Gait"
                                name="Question_No_8_Normal_Posture_Gait" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ (isset($_GET['Question_No_8_Normal_Posture_Gait']) && $_GET['Question_No_8_Normal_Posture_Gait'] == 'Yes') || old('Question_No_8_Normal_Posture_Gait') == 'Yes' || (isset($details['Question_No_8_Normal_Posture_Gait']) && $details['Question_No_8_Normal_Posture_Gait'] == 'Yes') ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ (isset($_GET['Question_No_8_Normal_Posture_Gait']) && $_GET['Question_No_8_Normal_Posture_Gait'] == 'No') || old('Question_No_8_Normal_Posture_Gait') == 'No' || (isset($details['Question_No_8_Normal_Posture_Gait']) && $details['Question_No_8_Normal_Posture_Gait'] == 'No') ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>


                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Mentalstatus">Question No.9: Mental Status</label>

                            <select class="form-control" id="Question_No_9_Mental_Status"
                                name="Question_No_9_Mental_Status" required>
                                <option value="">Select</option>
                                <option value="Alert"
                                    {{ (isset($_GET['Question_No_9_Mental_Status']) && $_GET['Question_No_9_Mental_Status'] == 'Alert') || old('Question_No_9_Mental_Status') == 'Alert' || (isset($details['Question_No_9_Mental_Status']) && $details['Question_No_9_Mental_Status'] == 'Alert') ? 'selected' : '' }}>
                                    Alert
                                </option>
                                <option value="Lethargic"
                                    {{ (isset($_GET['Question_No_9_Mental_Status']) && $_GET['Question_No_9_Mental_Status'] == 'Lethargic') || old('Question_No_9_Mental_Status') == 'Lethargic' || (isset($details['Question_No_9_Mental_Status']) && $details['Question_No_9_Mental_Status'] == 'Lethargic') ? 'selected' : '' }}>
                                    Lethargic
                                </option>
                            </select>

                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="jaundice">Question No.10: Look For jaundice</label>

                            <select class="form-control" id="Question_No_10_Look_For_jaundice"
                                name="Question_No_10_Look_For_jaundice" required>
                                <option value="">Select</option>
                                <option value="yes"
                                    {{ (isset($_GET['Question_No_10_Look_For_jaundice']) && $_GET['Question_No_10_Look_For_jaundice'] == 'yes') || old('Question_No_10_Look_For_jaundice') == 'yes' || (isset($details['Question_No_10_Look_For_jaundice']) && $details['Question_No_10_Look_For_jaundice'] == 'yes') ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="no"
                                    {{ (isset($_GET['Question_No_10_Look_For_jaundice']) && $_GET['Question_No_10_Look_For_jaundice'] == 'no') || old('Question_No_10_Look_For_jaundice') == 'no' || (isset($details['Question_No_10_Look_For_jaundice']) && $details['Question_No_10_Look_For_jaundice'] == 'no') ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>


                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="anemia">Question No.11: Look For anemia</label>

                            <select class="form-control" id="Question_No_11_Look_For_anemia" name="Question_No_11_Look_For_anemia" required>
    <option value="">Select</option>
    <option value="Yes"
        {{ !empty($details['Question_No_11_Look_For_anemia']) && 
           ($details['Question_No_11_Look_For_anemia'] == 'Yes' || $details['Question_No_11_Look_For_anemia'] == 'yes') 
           ? 'selected' : '' }}>
        Yes
    </option>
    <option value="No"
        {{ !empty($details['Question_No_11_Look_For_anemia']) && 
           ($details['Question_No_11_Look_For_anemia'] == 'No' || $details['Question_No_11_Look_For_anemia'] == 'no') 
           ? 'selected' : '' }}>
        No
    </option>
</select>





                        </div>
                    </div>



                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="clubbing">Question No.12: Look For Clubbing</label>

                            <select class="form-control" id="Question_No_12_Look_For_Clubbing"
                                name="Question_No_12_Look_For_Clubbing" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ (isset($_GET['Question_No_12_Look_For_Clubbing']) && $_GET['Question_No_12_Look_For_Clubbing'] == 'Yes') || old('Question_No_12_Look_For_Clubbing') == 'Yes' || (isset($details['Question_No_12_Look_For_Clubbing']) && $details['Question_No_12_Look_For_Clubbing'] == 'Yes') ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ (isset($_GET['Question_No_12_Look_For_Clubbing']) && $_GET['Question_No_12_Look_For_Clubbing'] == 'No') || old('Question_No_12_Look_For_Clubbing') == 'No' || (isset($details['Question_No_12_Look_For_Clubbing']) && $details['Question_No_12_Look_For_Clubbing'] == 'No') ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>



                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="cyanosis">Question No.13: Look for Cyanosis</label>

                            <select class="form-control" id="Question_No_13_Look_for_Cyanosis"
                                name="Question_No_13_Look_for_Cyanosis" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ (isset($_GET['Question_No_13_Look_for_Cyanosis']) && $_GET['Question_No_13_Look_for_Cyanosis'] == 'Yes') || old('Question_No_13_Look_for_Cyanosis') == 'Yes' || (isset($details['Question_No_13_Look_for_Cyanosis']) && $details['Question_No_13_Look_for_Cyanosis'] == 'Yes') ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ (isset($_GET['Question_No_13_Look_for_Cyanosis']) && $_GET['Question_No_13_Look_for_Cyanosis'] == 'No') || old('Question_No_13_Look_for_Cyanosis') == 'No' || (isset($details['Question_No_13_Look_for_Cyanosis']) && $details['Question_No_13_Look_for_Cyanosis'] == 'No') ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>



                        </div>
                    </div>



                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="skin">Question No.14: Skin</label>

                            <select class="form-control" id="Question_No_14_Skin" name="Question_No_14_Skin" required>
                                <option value="">Select</option>
                                <option value="Rash"
                                    {{ (isset($_GET['Question_No_14_Skin']) && $_GET['Question_No_14_Skin'] == 'Rash') || old('Question_No_14_Skin') == 'Rash' || (isset($details['Question_No_14_Skin']) && $details['Question_No_14_Skin'] == 'Rash') ? 'selected' : '' }}>
                                    Rash
                                </option>
                                <option value="Allergy"
                                    {{ (isset($_GET['Question_No_14_Skin']) && $_GET['Question_No_14_Skin'] == 'Allergy') || old('Question_No_14_Skin') == 'Allergy' || (isset($details['Question_No_14_Skin']) && $details['Question_No_14_Skin'] == 'Allergy') ? 'selected' : '' }}>
                                    Allergy
                                </option>
                                <option value="Lesion"
                                    {{ (isset($_GET['Question_No_14_Skin']) && $_GET['Question_No_14_Skin'] == 'Lesion') || old('Question_No_14_Skin') == 'Lesion' || (isset($details['Question_No_14_Skin']) && $details['Question_No_14_Skin'] == 'Lesion') ? 'selected' : '' }}>
                                    Lesion
                                </option>
                                <option value="Bruises"
                                    {{ (isset($_GET['Question_No_14_Skin']) && $_GET['Question_No_14_Skin'] == 'Bruises') || old('Question_No_14_Skin') == 'Bruises' || (isset($details['Question_No_14_Skin']) && $details['Question_No_14_Skin'] == 'Bruises') ? 'selected' : '' }}>
                                    Bruises
                                </option>
                                <option value="Normal"
                                    {{ (isset($_GET['Question_No_14_Skin']) && $_GET['Question_No_14_Skin'] == 'Normal') || old('Question_No_14_Skin') == 'Normal' || (isset($details['Question_No_14_Skin']) && $details['Question_No_14_Skin'] == 'Normal') ? 'selected' : '' }}>
                                    Normal
                                </option>
                            </select>



                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="breath">Question No.15: Breath</label>

                            <select class="form-control" id="Question_No_15_Breath" name="Question_No_15_Breath"
                                required>
                                <option value="">Select</option>
                                <option value="Bad Breath"
                                    {{ (isset($_GET['Question_No_15_Breath']) && $_GET['Question_No_15_Breath'] == 'Bad Breath') || old('Question_No_15_Breath') == 'Bad Breath' || (isset($details['Question_No_15_Breath']) && $details['Question_No_15_Breath'] == 'Bad Breath') ? 'selected' : '' }}>
                                    Bad Breath
                                </option>
                                <option value="Normal"
                                    {{ (isset($_GET['Question_No_15_Breath']) && $_GET['Question_No_15_Breath'] == 'Normal') || old('Question_No_15_Breath') == 'Normal' || (isset($details['Question_No_15_Breath']) && $details['Question_No_15_Breath'] == 'Normal') ? 'selected' : '' }}>
                                    Normal
                                </option>
                            </select>


                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label>

                            <textarea name="general_apperance_comment" placeholder="Comment here" cols="50">{{ isset($_GET['general_apperance_comment']) ? $_GET['general_apperance_comment'] : (old('general_apperance_comment') ?: (isset($details['general_apperance_comment']) ? $details['general_apperance_comment'] : '')) }}</textarea>


                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Four - Inspect Hygiene-->
            <div class="step" id="step4">
                <h3>Inspect Hygiene</h3>
                <div class="form-row">

                    <!-- Question 16: Nails -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_16_Nails">Question No.16: Nails</label>
                        <select class="form-control" id="Question_No_16_Nails" name="Question_No_16_Nails" required>
                            <option value="">Select</option>
                            <option value="Clean"
                                {{ (isset($_GET['Question_No_16_Nails']) && $_GET['Question_No_16_Nails'] == 'Clean') || old('Question_No_16_Nails') == 'Clean' || (isset($details['Question_No_16_Nails']) && $details['Question_No_16_Nails'] == 'Clean') ? 'selected' : '' }}>
                                Clean
                            </option>
                            <option value="Dirty"
                                {{ (isset($_GET['Question_No_16_Nails']) && $_GET['Question_No_16_Nails'] == 'Dirty') || old('Question_No_16_Nails') == 'Dirty' || (isset($details['Question_No_16_Nails']) && $details['Question_No_16_Nails'] == 'Dirty') ? 'selected' : '' }}>
                                Dirty
                            </option>
                        </select>
                    </div>

                    <!-- Question 17: Uniform or shoes -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_17_Uniform_or_shoes">Question No.17: Uniform or shoes</label>
                        <select class="form-control" id="Question_No_17_Uniform_or_shoes"
                            name="Question_No_17_Uniform_or_shoes" required>
                            <option value="">Select</option>
                            <option value="Tidy"
                                {{ (isset($_GET['Question_No_17_Uniform_or_shoes']) && $_GET['Question_No_17_Uniform_or_shoes'] == 'Tidy') || old('Question_No_17_Uniform_or_shoes') == 'Tidy' || (isset($details['Question_No_17_Uniform_or_shoes']) && $details['Question_No_17_Uniform_or_shoes'] == 'Tidy') ? 'selected' : '' }}>
                                Tidy
                            </option>
                            <option value="Untidy"
                                {{ (isset($_GET['Question_No_17_Uniform_or_shoes']) && $_GET['Question_No_17_Uniform_or_shoes'] == 'Untidy') || old('Question_No_17_Uniform_or_shoes') == 'Untidy' || (isset($details['Question_No_17_Uniform_or_shoes']) && $details['Question_No_17_Uniform_or_shoes'] == 'Untidy') ? 'selected' : '' }}>
                                Untidy
                            </option>
                        </select>
                    </div>

                </div>

                <div class="form-row">

                    <!-- Question 18: Lice/nits -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_18_Lice_nits">Question No.18: Lice/nits</label>
                        <select class="form-control" id="Question_No_18_Lice_nits" name="Question_No_18_Lice_nits"
                            required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_18_Lice_nits']) && $_GET['Question_No_18_Lice_nits'] == 'Yes') || old('Question_No_18_Lice_nits') == 'Yes' || (isset($details['Question_No_18_Lice_nits']) && $details['Question_No_18_Lice_nits'] == 'Yes') ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_18_Lice_nits']) && $_GET['Question_No_18_Lice_nits'] == 'No') || old('Question_No_18_Lice_nits') == 'No' || (isset($details['Question_No_18_Lice_nits']) && $details['Question_No_18_Lice_nits'] == 'No') ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Question 19: Discuss hygiene routines -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_19_Discuss_hygiene_routines_and_practices">Question No.19: Discuss hygiene
                            routines and practices</label>
                        <select class="form-control" id="Question_No_19_Discuss_hygiene_routines_and_practices"
                            name="Question_No_19_Discuss_hygiene_routines_and_practices" required>
                            <option value="">Select</option>
                            <option value="well-aware"
                                {{ (isset($_GET['Question_No_19_Discuss_hygiene_routines_and_practices']) && $_GET['Question_No_19_Discuss_hygiene_routines_and_practices'] == 'well-aware') || old('Question_No_19_Discuss_hygiene_routines_and_practices') == 'well-aware' || (isset($details['Question_No_19_Discuss_hygiene_routines_and_practices']) && $details['Question_No_19_Discuss_hygiene_routines_and_practices'] == 'well-aware') ? 'selected' : '' }}>
                                Well-aware
                            </option>
                            <option value="not-aware"
                                {{ (isset($_GET['Question_No_19_Discuss_hygiene_routines_and_practices']) && $_GET['Question_No_19_Discuss_hygiene_routines_and_practices'] == 'not-aware') || old('Question_No_19_Discuss_hygiene_routines_and_practices') == 'not-aware' || (isset($details['Question_No_19_Discuss_hygiene_routines_and_practices']) && $details['Question_No_19_Discuss_hygiene_routines_and_practices'] == 'not-aware') ? 'selected' : '' }}>
                                Not aware
                            </option>
                            <option value="has-been-counseled"
                                {{ (isset($_GET['Question_No_19_Discuss_hygiene_routines_and_practices']) && $_GET['Question_No_19_Discuss_hygiene_routines_and_practices'] == 'has-been-counseled') || old('Question_No_19_Discuss_hygiene_routines_and_practices') == 'has-been-counseled' || (isset($details['Question_No_19_Discuss_hygiene_routines_and_practices']) && $details['Question_No_19_Discuss_hygiene_routines_and_practices'] == 'has-been-counseled') ? 'selected' : '' }}>
                                Has been counseled
                            </option>
                        </select>
                    </div>


                    <!-- Comment -->
                    <div class="form-group col-md-6">
                        <label for="inspect_hygiene_comment">Comment/Findings</label>
                        <textarea name="inspect_hygiene_comment" id="inspect_hygiene_comment" placeholder="Comment here" cols="50">{{ isset($_GET['inspect_hygiene_comment']) ? $_GET['inspect_hygiene_comment'] : (old('inspect_hygiene_comment') ?: (isset($details['inspect_hygiene_comment']) ? $details['inspect_hygiene_comment'] : '')) }}</textarea>
                    </div>



                </div>

                <!-- Navigation buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Five - Head and Neck Examination -->
            <div class="step" id="step5">
                <h3>Head and Neck Examination</h3>
                <div class="form-row">

                    <!-- Question 20: Hair and Scalp -->
                    <div class="form-group col-md-6">
                        <label for="Hair_and_Scalp">Question No.20: Hair and Scalp</label>
                        <select class="form-control" id="Question_No_20_Hair_and_Scalp"
                            name="Question_No_20_Hair_and_Scalp" required>
                            <option value="">Select</option>
                            <option value="Straight"
                                {{ (isset($_GET['Question_No_20_Hair_and_Scalp']) && $_GET['Question_No_20_Hair_and_Scalp'] == 'Straight') || old('Question_No_20_Hair_and_Scalp') == 'Straight' || (isset($details['Question_No_20_Hair_and_Scalp']) && $details['Question_No_20_Hair_and_Scalp'] == 'Straight') ? 'selected' : '' }}>
                                Straight
                            </option>
                            <option value="Wavy"
                                {{ (isset($_GET['Question_No_20_Hair_and_Scalp']) && $_GET['Question_No_20_Hair_and_Scalp'] == 'Wavy') || old('Question_No_20_Hair_and_Scalp') == 'Wavy' || (isset($details['Question_No_20_Hair_and_Scalp']) && $details['Question_No_20_Hair_and_Scalp'] == 'Wavy') ? 'selected' : '' }}>
                                Wavy
                            </option>
                            <option value="Curly"
                                {{ (isset($_GET['Question_No_20_Hair_and_Scalp']) && $_GET['Question_No_20_Hair_and_Scalp'] == 'Curly') || old('Question_No_20_Hair_and_Scalp') == 'Curly' || (isset($details['Question_No_20_Hair_and_Scalp']) && $details['Question_No_20_Hair_and_Scalp'] == 'Curly') ? 'selected' : '' }}>
                                Curly
                            </option>
                            <option value="Color-faded"
                                {{ (isset($_GET['Question_No_20_Hair_and_Scalp']) && $_GET['Question_No_20_Hair_and_Scalp'] == 'Color-faded') || old('Question_No_20_Hair_and_Scalp') == 'Color-faded' || (isset($details['Question_No_20_Hair_and_Scalp']) && $details['Question_No_20_Hair_and_Scalp'] == 'Color-faded') ? 'selected' : '' }}>
                                Color faded
                            </option>
                        </select>
                    </div>

                    <!-- Question 21: Any Hair Problem -->
                    <div class="form-group col-md-6">
                        <label for="Any_Hair_Problem">Question No.21: Any Hair Problem</label>
                        <select class="form-control" id="Question_No_21_Any_Hair_Problem"
                            name="Question_No_21_Any_Hair_Problem" required>
                            <option value="">Select</option>
                            <option value="Kinky"
                                {{ (isset($_GET['Question_No_21_Any_Hair_Problem']) && $_GET['Question_No_21_Any_Hair_Problem'] == 'Kinky') || old('Question_No_21_Any_Hair_Problem') == 'Kinky' || (isset($details['Question_No_21_Any_Hair_Problem']) && $details['Question_No_21_Any_Hair_Problem'] == 'Kinky') ? 'selected' : '' }}>
                                Kinky
                            </option>
                            <option value="Brittle"
                                {{ (isset($_GET['Question_No_21_Any_Hair_Problem']) && $_GET['Question_No_21_Any_Hair_Problem'] == 'Brittle') || old('Question_No_21_Any_Hair_Problem') == 'Brittle' || (isset($details['Question_No_21_Any_Hair_Problem']) && $details['Question_No_21_Any_Hair_Problem'] == 'Brittle') ? 'selected' : '' }}>
                                Brittle
                            </option>
                            <option value="Dry"
                                {{ (isset($_GET['Question_No_21_Any_Hair_Problem']) && $_GET['Question_No_21_Any_Hair_Problem'] == 'Dry') || old('Question_No_21_Any_Hair_Problem') == 'Dry' || (isset($details['Question_No_21_Any_Hair_Problem']) && $details['Question_No_21_Any_Hair_Problem'] == 'Dry') ? 'selected' : '' }}>
                                Dry
                            </option>
                            <option value="Normal"
                                {{ (isset($_GET['Question_No_21_Any_Hair_Problem']) && $_GET['Question_No_21_Any_Hair_Problem'] == 'Normal') || old('Question_No_21_Any_Hair_Problem') == 'Normal' || (isset($details['Question_No_21_Any_Hair_Problem']) && $details['Question_No_21_Any_Hair_Problem'] == 'Normal') ? 'selected' : '' }}>
                                Normal
                            </option>
                        </select>
                    </div>

                </div>

                <div class="form-row">

                    <!-- Question 22: Scalp -->
                    <div class="form-group col-md-6">
                        <label for="Scalp">Question No.22: Scalp</label>
                        <select class="form-control" id="Question_No_22_Scalp" name="Question_No_22_Scalp" required>
                            <option value="">Select</option>
                            <option value="Scaly"
                                {{ (isset($_GET['Question_No_22_Scalp']) && $_GET['Question_No_22_Scalp'] == 'Scaly') || old('Question_No_22_Scalp') == 'Scaly' || (isset($details['Question_No_22_Scalp']) && $details['Question_No_22_Scalp'] == 'Scaly') ? 'selected' : '' }}>
                                Scaly
                            </option>
                            <option value="Dry"
                                {{ (isset($_GET['Question_No_22_Scalp']) && $_GET['Question_No_22_Scalp'] == 'Dry') || old('Question_No_22_Scalp') == 'Dry' || (isset($details['Question_No_22_Scalp']) && $details['Question_No_22_Scalp'] == 'Dry') ? 'selected' : '' }}>
                                Dry
                            </option>
                            <option value="Moist"
                                {{ (isset($_GET['Question_No_22_Scalp']) && $_GET['Question_No_22_Scalp'] == 'Moist') || old('Question_No_22_Scalp') == 'Moist' || (isset($details['Question_No_22_Scalp']) && $details['Question_No_22_Scalp'] == 'Moist') ? 'selected' : '' }}>
                                Moist
                            </option>
                            <option value="Normal"
                                {{ (isset($_GET['Question_No_22_Scalp']) && $_GET['Question_No_22_Scalp'] == 'Normal') || old('Question_No_22_Scalp') == 'Normal' || (isset($details['Question_No_22_Scalp']) && $details['Question_No_22_Scalp'] == 'Normal') ? 'selected' : '' }}>
                                Normal
                            </option>
                        </select>
                    </div>

                    <!-- Question 23: Hair Distribution -->
                    <div class="form-group col-md-6">
                        <label for="Hair_Distribution">Question No.23: Hair Distribution</label>
                        <select class="form-control" id="Question_No_23_Hair_Distribution"
                            name="Question_No_23_Hair_Distribution" required>
                            <option value="">Select</option>
                            <option value="Even"
                                {{ (isset($_GET['Question_No_23_Hair_Distribution']) && $_GET['Question_No_23_Hair_Distribution'] == 'Even') || old('Question_No_23_Hair_Distribution') == 'Even' || (isset($details['Question_No_23_Hair_Distribution']) && $details['Question_No_23_Hair_Distribution'] == 'Even') ? 'selected' : '' }}>
                                Even
                            </option>
                            <option value="Patchy"
                                {{ (isset($_GET['Question_No_23_Hair_Distribution']) && $_GET['Question_No_23_Hair_Distribution'] == 'Patchy') || old('Question_No_23_Hair_Distribution') == 'Patchy' || (isset($details['Question_No_23_Hair_Distribution']) && $details['Question_No_23_Hair_Distribution'] == 'Patchy') ? 'selected' : '' }}>
                                Patchy
                            </option>
                            <option value="Receding"
                                {{ (isset($_GET['Question_No_23_Hair_Distribution']) && $_GET['Question_No_23_Hair_Distribution'] == 'Receding') || old('Question_No_23_Hair_Distribution') == 'Receding' || (isset($details['Question_No_23_Hair_Distribution']) && $details['Question_No_23_Hair_Distribution'] == 'Receding') ? 'selected' : '' }}>
                                Receding
                            </option>
                            <option value="Receding_Hair_Line"
                                {{ (isset($_GET['Question_No_23_Hair_Distribution']) && $_GET['Question_No_23_Hair_Distribution'] == 'Receding_Hair_Line') || old('Question_No_23_Hair_Distribution') == 'Receding_Hair_Line' || (isset($details['Question_No_23_Hair_Distribution']) && $details['Question_No_23_Hair_Distribution'] == 'Receding_Hair_Line') ? 'selected' : '' }}>
                                Receding Hair Line
                            </option>
                        </select>
                    </div>

                    <!-- Comment -->
                    <div class="form-group col-md-6">
                        <label for="head_and_neck_examination_comment">Comment/Findings</label>
                        <textarea name="head_and_neck_examination_comment" id="head_and_neck_examination_comment" placeholder="Comment here"
                            cols="50">{{ old('head_and_neck_examination_comment') ?: (isset($details['head_and_neck_examination_comment']) ? $details['head_and_neck_examination_comment'] : '') }}</textarea>
                    </div>

                </div>

                <!-- Navigation buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Six -->
            <div class="step" id="step6">
                <h3>Eye Examination</h3>
                <div class="form-row">

                    <!-- Question 24: Visual acuity using Snellen’s chart -->
                    <div class="form-group col-md-6">
                        <label for="Visual_acuity_using_Snellens_chart">Question No.24: Visual acuity using Snellen’s
                            chart</label>
                        <input type="text" class="form-control" id="Question_No_24_Visual_acuity_using_Snellens_chart"
                            name="Question_No_24_Visual_acuity_using_Snellens_chart"
                            value="{{ isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) ? $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] : (old('Question_No_24_Visual_acuity_using_Snellens_chart') ?: (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) ? $details['Question_No_24_Visual_acuity_using_Snellens_chart'] : '')) }}"
                            required>
                    </div>

                    <!-- Question 25: Normal ocular alignment -->
                    <div class="form-group col-md-6">
                        <label for="Normal_ocular_alignment">Question No.25: Normal ocular alignment</label>
                        <select class="form-control" id="Question_No_25_Normal_ocular_alignment"
                            name="Question_No_25_Normal_ocular_alignment" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_25_Normal_ocular_alignment']) && $_GET['Question_No_25_Normal_ocular_alignment'] == 'Yes') || old('Question_No_25_Normal_ocular_alignment') == 'Yes' || (isset($details['Question_No_25_Normal_ocular_alignment']) && $details['Question_No_25_Normal_ocular_alignment'] == 'Yes') ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_25_Normal_ocular_alignment']) && $_GET['Question_No_25_Normal_ocular_alignment'] == 'No') || old('Question_No_25_Normal_ocular_alignment') == 'No' || (isset($details['Question_No_25_Normal_ocular_alignment']) && $details['Question_No_25_Normal_ocular_alignment'] == 'No') ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Question 26: Normal eye inspection -->
                    <div class="form-group col-md-6">
                        <label for="Normal_eye_inspection">Question No.26: Normal eye inspection</label>
                        <select class="form-control" id="Question_No_26_Normal_eye_inspection"
                            name="Question_No_26_Normal_eye_inspection" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_26_Normal_eye_inspection']) && $_GET['Question_No_26_Normal_eye_inspection'] == 'Yes') || old('Question_No_26_Normal_eye_inspection') == 'Yes' || (isset($details['Question_No_26_Normal_eye_inspection']) && $details['Question_No_26_Normal_eye_inspection'] == 'Yes') ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_26_Normal_eye_inspection']) && $_GET['Question_No_26_Normal_eye_inspection'] == 'No') || old('Question_No_26_Normal_eye_inspection') == 'No' || (isset($details['Question_No_26_Normal_eye_inspection']) && $details['Question_No_26_Normal_eye_inspection'] == 'No') ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Question 27: Normal color vision -->
                    <div class="form-group col-md-6">
                        <label for="Normal_color_vision">Question No.27: Normal color vision</label>
                        <select class="form-control" id="Question_No_27_Normal_Color_vision"
                            name="Question_No_27_Normal_Color_vision" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_27_Normal_Color_vision']) && $_GET['Question_No_27_Normal_Color_vision'] == 'Yes') || old('Question_No_27_Normal_Color_vision') == 'Yes' || (isset($details['Question_No_27_Normal_Color_vision']) && $details['Question_No_27_Normal_Color_vision'] == 'Yes') ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_27_Normal_Color_vision']) && $_GET['Question_No_27_Normal_Color_vision'] == 'No') || old('Question_No_27_Normal_Color_vision') == 'No' || (isset($details['Question_No_27_Normal_Color_vision']) && $details['Question_No_27_Normal_Color_vision'] == 'No') ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Question 28: Nystagmus -->
                    <div class="form-group col-md-6">
                        <label for="Nystagmus">Question No.28: Nystagmus</label>
                        <select class="form-control" id="Question_No_28_Nystagmus" name="Question_No_28_Nystagmus"
                            required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_28_Nystagmus']) && $_GET['Question_No_28_Nystagmus'] == 'Yes') || old('Question_No_28_Nystagmus') == 'Yes' || (isset($details['Question_No_28_Nystagmus']) && $details['Question_No_28_Nystagmus'] == 'Yes') ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_28_Nystagmus']) && $_GET['Question_No_28_Nystagmus'] == 'No') || old('Question_No_28_Nystagmus') == 'No' || (isset($details['Question_No_28_Nystagmus']) && $details['Question_No_28_Nystagmus'] == 'No') ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Comment -->
                    <div class="form-group col-md-6">
                        <label for="eye_comment">Comment/Findings</label>
                        <textarea class="form-control" id="eye_comment" name="eye_comment" placeholder="Comment here" cols="50">{{ isset($_GET['eye_comment']) ? $_GET['eye_comment'] : (old('eye_comment') ?: (isset($details['eye_comment']) ? $details['eye_comment'] : '')) }}</textarea>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>

            <!-- Step Seven -->
            <div class="step" id="step7">
                <h3>Ears:</h3>
                <div class="form-row">

                    <!-- Question 29: Normal ears shape and position -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_29_Normal_ears_shape_and_position">Question No.29: Normal ears shape and
                            position</label>
                        <select class="form-control" id="Question_No_29_Normal_ears_shape_and_position"
                            name="Question_No_29_Normal_ears_shape_and_position" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_29_Normal_ears_shape_and_position']) && $_GET['Question_No_29_Normal_ears_shape_and_position'] == 'Yes') || old('Question_No_29_Normal_ears_shape_and_position') == 'Yes' || (isset($details['Question_No_29_Normal_ears_shape_and_position']) && $details['Question_No_29_Normal_ears_shape_and_position'] == 'Yes') ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_29_Normal_ears_shape_and_position']) && $_GET['Question_No_29_Normal_ears_shape_and_position'] == 'No') || old('Question_No_29_Normal_ears_shape_and_position') == 'No' || (isset($details['Question_No_29_Normal_ears_shape_and_position']) && $details['Question_No_29_Normal_ears_shape_and_position'] == 'No') ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Question 30: Ear examination -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_30_Ear_examination">Question No.30: Ear examination</label>
                        <select class="form-control" id="Question_No_30_Ear_examination"
                            name="Question_No_30_Ear_examination" required>
                            <option value="">Select</option>
                            <option value="Ear wax"
                                {{ (isset($_GET['Question_No_30_Ear_examination']) && $_GET['Question_No_30_Ear_examination'] == 'Ear wax') || old('Question_No_30_Ear_examination') == 'Ear wax' || (isset($details['Question_No_30_Ear_examination']) && $details['Question_No_30_Ear_examination'] == 'Ear wax') ? 'selected' : '' }}>
                                Ear wax</option>
                            <option value="Canal infection"
                                {{ (isset($_GET['Question_No_30_Ear_examination']) && $_GET['Question_No_30_Ear_examination'] == 'Canal infection') || old('Question_No_30_Ear_examination') == 'Canal infection' || (isset($details['Question_No_30_Ear_examination']) && $details['Question_No_30_Ear_examination'] == 'Canal infection') ? 'selected' : '' }}>
                                Canal infection</option>
                            <option value="None"
                                {{ (isset($_GET['Question_No_30_Ear_examination']) && $_GET['Question_No_30_Ear_examination'] == 'None') || old('Question_No_30_Ear_examination') == 'None' || (isset($details['Question_No_30_Ear_examination']) && $details['Question_No_30_Ear_examination'] == 'None') ? 'selected' : '' }}>
                                None</option>
                        </select>
                    </div>

                    <!-- Question 31: Conclusion of hearing test with Rinner and Weber -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber">Question No.31:
                            Conclusion of hearing test with Rinner and Weber</label>
                        <select class="form-control" id="Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber"
                            name="Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber" required>
                            <option value="">Select</option>
                            <option value="Normal"
                                {{ (isset($_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'Normal') || old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber') == 'Normal' || (isset($details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'Normal') ? 'selected' : '' }}>
                                Normal</option>
                            <option value="right_ear_conductive_hearing_loss"
                                {{ (isset($_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'right_ear_conductive_hearing_loss') || old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber') == 'right_ear_conductive_hearing_loss' || (isset($details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'right_ear_conductive_hearing_loss') ? 'selected' : '' }}>
                                right ear conductive hearing loss</option>
                            <option value="left_ear_conductive_hearing_loss"
                                {{ (isset($_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'left_ear_conductive_hearing_loss') || old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber') == 'left_ear_conductive_hearing_loss' || (isset($details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'left_ear_conductive_hearing_loss') ? 'selected' : '' }}>
                                left ear conductive hearing loss</option>
                            <option value="right_ear_sensorineural_hearing_loss"
                                {{ (isset($_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'right_ear_sensorineural_hearing_loss') || old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber') == 'right_ear_sensorineural_hearing_loss' || (isset($details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'right_ear_sensorineural_hearing_loss') ? 'selected' : '' }}>
                                right sensorineural hearing loss</option>
                            <option value="left_ear_sensorineural_hearing_loss"
                                {{ (isset($_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $_GET['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'left_ear_sensorineural_hearing_loss') || old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber') == 'left_ear_sensorineural_hearing_loss' || (isset($details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber']) && $details['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] == 'left_ear_sensorineural_hearing_loss') ? 'selected' : '' }}>
                                left sensorineural hearing loss</option>
                        </select>
                    </div>
                </div>

                <!-- Comment -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ears_comment">Comment/Findings</label>
                        <textarea class="form-control" name="ears_comment" id="ears_comment" placeholder="Comment here" cols="50">{{ isset($_GET['ears_comment']) ? $_GET['ears_comment'] : (old('ears_comment') ?: (isset($details['ears_comment']) ? $details['ears_comment'] : '')) }}</textarea>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Eight -->
            <div class="step" id="step8">
                <h3>Nose</h3>
                <div class="form-row">

                    <!-- Question 32: External nasal examination -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_32_External_nasal_examinaton">Question No.32: External nasal
                            examination</label>
                        <select class="form-control" id="Question_No_32_External_nasal_examinaton"
                            name="Question_No_32_External_nasal_examinaton" required>
                            <option value="">Select</option>
                            <option value="Deformities"
                                {{ (isset($_GET['Question_No_32_External_nasal_examinaton']) && $_GET['Question_No_32_External_nasal_examinaton'] == 'Deformities') || old('Question_No_32_External_nasal_examinaton') == 'Deformities' || (isset($details['Question_No_32_External_nasal_examinaton']) && $details['Question_No_32_External_nasal_examinaton'] == 'Deformities') ? 'selected' : '' }}>
                                Deformities</option>
                            <option value="Swelling"
                                {{ (isset($_GET['Question_No_32_External_nasal_examinaton']) && $_GET['Question_No_32_External_nasal_examinaton'] == 'Swelling') || old('Question_No_32_External_nasal_examinaton') == 'Swelling' || (isset($details['Question_No_32_External_nasal_examinaton']) && $details['Question_No_32_External_nasal_examinaton'] == 'Swelling') ? 'selected' : '' }}>
                                Swelling</option>
                            <option value="Redness"
                                {{ (isset($_GET['Question_No_32_External_nasal_examinaton']) && $_GET['Question_No_32_External_nasal_examinaton'] == 'Redness') || old('Question_No_32_External_nasal_examinaton') == 'Redness' || (isset($details['Question_No_32_External_nasal_examinaton']) && $details['Question_No_32_External_nasal_examinaton'] == 'Redness') ? 'selected' : '' }}>
                                Redness</option>
                            <option value="Lesions"
                                {{ (isset($_GET['Question_No_32_External_nasal_examinaton']) && $_GET['Question_No_32_External_nasal_examinaton'] == 'Lesions') || old('Question_No_32_External_nasal_examinaton') == 'Lesions' || (isset($details['Question_No_32_External_nasal_examinaton']) && $details['Question_No_32_External_nasal_examinaton'] == 'Lesions') ? 'selected' : '' }}>
                                Lesions</option>
                            <option value="Nasal Discharge"
                                {{ (isset($_GET['Question_No_32_External_nasal_examinaton']) && $_GET['Question_No_32_External_nasal_examinaton'] == 'Nasal Discharge') || old('Question_No_32_External_nasal_examinaton') == 'Nasal Discharge' || (isset($details['Question_No_32_External_nasal_examinaton']) && $details['Question_No_32_External_nasal_examinaton'] == 'Nasal Discharge') ? 'selected' : '' }}>
                                Nasal Discharge</option>
                            <option value="Crusting"
                                {{ (isset($_GET['Question_No_32_External_nasal_examinaton']) && $_GET['Question_No_32_External_nasal_examinaton'] == 'Crusting') || old('Question_No_32_External_nasal_examinaton') == 'Crusting' || (isset($details['Question_No_32_External_nasal_examinaton']) && $details['Question_No_32_External_nasal_examinaton'] == 'Crusting') ? 'selected' : '' }}>
                                Crusting</option>
                            <option value="Normal"
                                {{ (isset($_GET['Question_No_32_External_nasal_examinaton']) && $_GET['Question_No_32_External_nasal_examinaton'] == 'Normal') || old('Question_No_32_External_nasal_examinaton') == 'Normal' || (isset($details['Question_No_32_External_nasal_examinaton']) && $details['Question_No_32_External_nasal_examinaton'] == 'Normal') ? 'selected' : '' }}>
                                Normal</option>
                        </select>
                    </div>


                    <!-- Question 33: Perform a nasal patency test -->
                    <div class="form-group col-md-12">
                        <label for="Question_No_33_perform_a_nasal_patency_test">Question No.33: Perform a nasal patency
                            test
                            <small>[Gently closing one nostril at a time to assess the patient's ability to breathe through
                                each nostril]</small>
                        </label>
                        <select class="form-control" id="Question_No_33_perform_a_nasal_patency_test"
                            name="Question_No_33_perform_a_nasal_patency_test" required>
                            <option value="">Select</option>
                            <option value="Obstruction"
                                {{ (isset($_GET['Question_No_33_perform_a_nasal_patency_test']) && $_GET['Question_No_33_perform_a_nasal_patency_test'] == 'Obstruction') || old('Question_No_33_perform_a_nasal_patency_test') == 'Obstruction' || (isset($details['Question_No_33_perform_a_nasal_patency_test']) && $details['Question_No_33_perform_a_nasal_patency_test'] == 'Obstruction') ? 'selected' : '' }}>
                                Obstruction
                            </option>
                            <option value="DNS"
                                {{ (isset($_GET['Question_No_33_perform_a_nasal_patency_test_test']) && $_GET['Question_No_33_perform_a_nasal_patency_test_test'] == 'DNS') || old('Question_No_33_perform_a_nasal_patency_test_test') == 'DNS' || (isset($details['Question_No_33_perform_a_nasal_patency_test']) && $details['Question_No_33_perform_a_nasal_patency_test'] == 'DNS') ? 'selected' : '' }}>
                                DNS
                            </option>
                            <option value="Normal"
                                {{ (isset($_GET['Question_No_33_perform_a_nasal_patency_test_test']) && $_GET['Question_No_33_perform_a_nasal_patency_test_test'] == 'Normal') || old('Question_No_33_perform_a_nasal_patency_test_test') == 'Normal' || (isset($details['Question_No_33_perform_a_nasal_patency_test']) && $details['Question_No_33_perform_a_nasal_patency_test'] == 'Normal') ? 'selected' : '' }}>
                                Normal
                            </option>
                        </select>
                    </div>


                    <!-- Comment -->
                    <div class="form-group col-md-6">
                        <label for="nose_comment">Comment/Findings</label>
                        <textarea class="form-control" name="nose_comment" id="nose_comment" placeholder="Comment here" cols="50">{{ isset($_GET['nose_comment']) ? $_GET['nose_comment'] : (old('nose_comment') ?: (isset($details['nose_comment']) ? $details['nose_comment'] : '')) }}</textarea>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>

            <!-- Step Nine -->

            <div class="step" id="step9">
                <h3>Oral</h3>
                <div class="form-row">
                    <!-- Question No.34: Assess gingiva -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_34_Assess_gingiva">Question No.34: Assess gingiva</label>
                        <select class="form-control" id="Question_No_34_Assess_gingiva"
                            name="Question_No_34_Assess_gingiva" required>
                            <option value="">Select</option>
                            <option value="Infection"
                                {{ (isset($_GET['Question_No_34_Assess_gingiva']) && $_GET['Question_No_34_Assess_gingiva'] == 'Infection') || old('Question_No_34_Assess_gingiva') == 'Infection' || (isset($details['Question_No_34_Assess_gingiva']) && $details['Question_No_34_Assess_gingiva'] == 'Infection') ? 'selected' : '' }}>
                                Infection
                            </option>
                            <option value="Bleed"
                                {{ (isset($_GET['Question_No_34_Assess_gingiva']) && $_GET['Question_No_34_Assess_gingiva'] == 'Bleed') || old('Question_No_34_Assess_gingiva') == 'Bleed' || (isset($details['Question_No_34_Assess_gingiva']) && $details['Question_No_34_Assess_gingiva'] == 'Bleed') ? 'selected' : '' }}>
                                Bleed
                            </option>
                            <option value="Normal"
                                {{ (isset($_GET['Question_No_34_Assess_gingiva']) && $_GET['Question_No_34_Assess_gingiva'] == 'Normal') || old('Question_No_34_Assess_gingiva') == 'Normal' || (isset($details['Question_No_34_Assess_gingiva']) && $details['Question_No_34_Assess_gingiva'] == 'Normal') ? 'selected' : '' }}>
                                Normal
                            </option>
                        </select>
                    </div>

                    <!-- Question No.35: Are there dental caries -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_35_Are_there_dental_caries">Question No.35: Are there dental caries</label>
                        <select class="form-control" id="Question_No_35_Are_there_dental_caries"
                            name="Question_No_35_Are_there_dental_caries" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_35_Are_there_dental_caries']) && $_GET['Question_No_35_Are_there_dental_caries'] == 'Yes') || old('Question_No_35_Are_there_dental_caries') == 'Yes' || (isset($details['Question_No_35_Are_there_dental_caries']) && $details['Question_No_35_Are_there_dental_caries'] == 'Yes') ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_35_Are_there_dental_caries']) && $_GET['Question_No_35_Are_there_dental_caries'] == 'No') || old('Question_No_35_Are_there_dental_caries') == 'No' || (isset($details['Question_No_35_Are_there_dental_caries']) && $details['Question_No_35_Are_there_dental_caries'] == 'No') ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Comments/Findings -->
                    <div class="form-group col-md-6">
                        <label for="oral_comment">Comment/Findings</label>
                        <textarea class="form-control" name="oral_comment" placeholder="Comment here" id="oral_comment" cols="50">{{ isset($_GET['oral_comment']) ? $_GET['oral_comment'] : old('oral_comment') ?? ($details['oral_comment'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!--  Step Ten -->
            <div class="step" id="step10">
                <h3>Throat</h3>
                <div class="form-row">
                    <!-- Question No.36: Examine tonsils -->
                    <div class="form-group col-md-6">
                        <label for="Examine tonsils">Question No.36: Examine tonsils</label>
                        <select class="form-control" id="Question_No_36_Examine_tonsils"
                            name="Question_No_36_Examine_tonsils" required>
                            <option value="">Select</option>
                            <option value="Normal"
                                {{ (isset($_GET['Question_No_36_Examine_tonsils']) && $_GET['Question_No_36_Examine_tonsils'] == 'Normal') || old('Question_No_36_Examine_tonsils') == 'Normal' || (isset($details['Question_No_36_Examine_tonsils']) && $details['Question_No_36_Examine_tonsils'] == 'Normal') ? 'selected' : '' }}>
                                Normal
                            </option>
                            <option value="Tonsillitis"
                                {{ (isset($_GET['Question_No_36_Examine_tonsils']) && $_GET['Question_No_36_Examine_tonsils'] == 'Tonsillitis') || old('Question_No_36_Examine_tonsils') == 'Tonsillitis' || (isset($details['Question_No_36_Examine_tonsils']) && $details['Question_No_36_Examine_tonsils'] == 'Tonsillitis') ? 'selected' : '' }}>
                                Tonsillitis
                            </option>
                            <option value="Tonsillectomy done"
                                {{ (isset($_GET['Question_No_36_Examine_tonsils']) && $_GET['Question_No_36_Examine_tonsils'] == 'Tonsillectomy done') || old('Question_No_36_Examine_tonsils') == 'Tonsillectomy done' || (isset($details['Question_No_36_Examine_tonsils']) && $details['Question_No_36_Examine_tonsils'] == 'Tonsillectomy done') ? 'selected' : '' }}>
                                Tonsillectomy done
                            </option>
                        </select>
                    </div>

                    <!-- Question No.37: Normal Speech development -->
                    <div class="form-group col-md-6">
                        <label for="normal_speech_development">Question No.37: Normal Speech development</label>
                        <select class="form-control" id="Question_No_37_Normal_Speech_development"
                            name="Question_No_37_Normal_Speech_development" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_37_Normal_Speech_development']) && $_GET['Question_No_37_Normal_Speech_development'] == 'Yes') || old('Question_No_37_Normal_Speech_development') == 'Yes' || (isset($details['Question_No_37_Normal_Speech_development']) && $details['Question_No_37_Normal_Speech_development'] == 'Yes') ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_37_Normal_Speech_development']) && $_GET['Question_No_37_Normal_Speech_development'] == 'No') || old('Question_No_37_Normal_Speech_development') == 'No' || (isset($details['Question_No_37_Normal_Speech_development']) && $details['Question_No_37_Normal_Speech_development'] == 'No') ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Question No.38: Any Neck swelling -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_38_Any_Neck_swelling">Question No.38: Any Neck swelling</label>
                        <select class="form-control" id="Question_No_38_Any_Neck_swelling"
                            name="Question_No_38_Any_Neck_swelling" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_38_Any_Neck_swelling']) && $_GET['Question_No_38_Any_Neck_swelling'] == 'Yes') || old('Question_No_38_Any_Neck_swelling') == 'Yes' || (isset($details['Question_No_38_Any_Neck_swelling']) && $details['Question_No_38_Any_Neck_swelling'] == 'Yes') ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_38_Any_Neck_swelling']) && $_GET['Question_No_38_Any_Neck_swelling'] == 'No') || old('Question_No_38_Any_Neck_swelling') == 'No' || (isset($details['Question_No_38_Any_Neck_swelling']) && $details['Question_No_38_Any_Neck_swelling'] == 'No') ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Specify Any Neck swelling -->
                    <div class="form-group col-md-6 Specify_Any_Neck_swelling d-none">
                        <label for="Specify_Any_Neck_swelling">Specify Any Neck swelling</label>
                        <input type="text" name="Specify_Any_Neck_swelling" class="form-control"
                            id="Specify_Any_Neck_swelling" placeholder="Please specify neck swelling"
                            value="{{ isset($_GET['Specify_Any_Neck_swelling']) ? $_GET['Specify_Any_Neck_swelling'] : (isset($details['Specify_Any_Neck_swelling']) ? $details['Specify_Any_Neck_swelling'] : old('Specify_Any_Neck_swelling')) }}">
                        <br>
                    </div>

                    <!-- Question No.39: Examine lymph node -->
                    <div class="form-group col-md-6">
                        <label for="Examine Question_No_39_Examine_lymph_node">Question No.39: Examine lymph node</label>
                        <select class="form-control" id="Question_No_39_Examine_lymph_node"
                            name="Question_No_39_Examine_lymph_node" required>
                            <option value="">Select</option>
                            <option value="normal"
                                {{ (isset($_GET['Question_No_39_Examine_lymph_node']) && $_GET['Question_No_39_Examine_lymph_node'] == 'normal') || old('Question_No_39_Examine_lymph_node') == 'normal' || (isset($details['Question_No_39_Examine_lymph_node']) && $details['Question_No_39_Examine_lymph_node'] == 'normal') ? 'selected' : '' }}>
                                normal
                            </option>
                            <option value="abnormal"
                                {{ (isset($_GET['Question_No_39_Examine_lymph_node']) && $_GET['Question_No_39_Examine_lymph_node'] == 'abnormal') || old('Question_No_39_Examine_lymph_node') == 'abnormal' || (isset($details['Question_No_39_Examine_lymph_node']) && $details['Question_No_39_Examine_lymph_node'] == 'abnormal') ? 'selected' : '' }}>
                                abnormal
                            </option>
                        </select>
                    </div>

                    <!-- Specify lymph node -->
                    <div class="form-group col-md-6 Specify_lymph_node d-none">
                        <label for="Specify_lymph_node">Specify lymph node</label>
                        <input type="text" name="Specify_lymph_node" class="form-control" id="Specify_lymph_node"
                            placeholder="Please specify lymph node"
                            value="{{ isset($_GET['Specify_lymph_node']) ? $_GET['Specify_lymph_node'] : (isset($details['Specify_lymph_node']) ? $details['Specify_lymph_node'] : old('Specify_lymph_node')) }}">
                        <br>
                    </div>




                    <!-- Comment/Findings -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="throat_comment">Comment/Findings</label>
                            <textarea name="throat_comment" id="throat_comment" placeholder="Comment here" cols="50">{{ isset($_GET['throat_comment']) ? $_GET['throat_comment'] : (isset($details['throat_comment']) ? $details['throat_comment'] : old('throat_comment')) }}</textarea>
                        </div>
                    </div>



                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Eleven -->
            <div class="step" id="step11">
                <h3>Chest</h3>
                <div class="form-row">
                    <!-- Question No.40 Any visible chest deformity -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="any_visible_chest_deformity">Question No.40: Any visible chest
                                deformity</label><br>
                            <select class="form-control" id="Question_No_40_Any_visible_chest_deformity"
                                name="Question_No_40_Any_visible_chest_deformity" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ (isset($_GET['Question_No_40_Any_visible_chest_deformity']) && $_GET['Question_No_40_Any_visible_chest_deformity'] == 'Yes') || old('Question_No_40_Any_visible_chest_deformity') == 'Yes' || (isset($details['Question_No_40_Any_visible_chest_deformity']) && $details['Question_No_40_Any_visible_chest_deformity'] == 'Yes') ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ (isset($_GET['Question_No_40_Any_visible_chest_deformity']) && $_GET['Question_No_40_Any_visible_chest_deformity'] == 'No') || old('Question_No_40_Any_visible_chest_deformity') == 'No' || (isset($details['Question_No_40_Any_visible_chest_deformity']) && $details['Question_No_40_Any_visible_chest_deformity'] == 'No') ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question No.41 Lung Auscultation -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="lung_auscultation">Question No.41: Lung Auscultation</label><br>
                            <select class="form-control" id="Question_No_41_Lung_Auscultation"
                                name="Question_No_41_Lung_Auscultation" required>
                                <option value="">Select</option>
                                <option value="Ronchi"
                                    {{ (isset($_GET['Question_No_41_Lung_Auscultation']) && $_GET['Question_No_41_Lung_Auscultation'] == 'Ronchi') || old('Question_No_41_Lung_Auscultation') == 'Ronchi' || (isset($details['Question_No_41_Lung_Auscultation']) && $details['Question_No_41_Lung_Auscultation'] == 'Ronchi') ? 'selected' : '' }}>
                                    Ronchi
                                </option>
                                <option value="Wheezing"
                                    {{ (isset($_GET['Question_No_41_Lung_Auscultation']) && $_GET['Question_No_41_Lung_Auscultation'] == 'Wheezing') || old('Question_No_41_Lung_Auscultation') == 'Wheezing' || (isset($details['Question_No_41_Lung_Auscultation']) && $details['Question_No_41_Lung_Auscultation'] == 'Wheezing') ? 'selected' : '' }}>
                                    Wheezing
                                </option>
                                <option value="Crackles"
                                    {{ (isset($_GET['Question_No_41_Lung_Auscultation']) && $_GET['Question_No_41_Lung_Auscultation'] == 'Crackles') || old('Question_No_41_Lung_Auscultation') == 'Crackles' || (isset($details['Question_No_41_Lung_Auscultation']) && $details['Question_No_41_Lung_Auscultation'] == 'Crackles') ? 'selected' : '' }}>
                                    Crackles
                                </option>
                                <option value="Vesicular_Breathing"
                                    {{ (isset($_GET['Question_No_41_Lung_Auscultation']) && $_GET['Question_No_41_Lung_Auscultation'] == 'Vesicular_Breathing') || old('Question_No_41_Lung_Auscultation') == 'Vesicular_Breathing' || (isset($details['Question_No_41_Lung_Auscultation']) && $details['Question_No_41_Lung_Auscultation'] == 'Vesicular_Breathing') ? 'selected' : '' }}>
                                    Vesicular Breathing
                                </option>
                                <option value="Vesicular Diminished Breath Sound(specify)"
                                    {{ (isset($_GET['Question_No_41_Lung_Auscultation']) && $_GET['Question_No_41_Lung_Auscultation'] == 'Vesicular Diminished Breath Sound(specify)') || old('Question_No_41_Lung_Auscultation') == 'Vesicular Diminished Breath Sound(specify)' || (isset($details['Question_No_41_Lung_Auscultation']) && $details['Question_No_41_Lung_Auscultation'] == 'Vesicular Diminished Breath Sound(specify)') ? 'selected' : '' }}>
                                    Vesicular Diminished Breath Sound (specify)
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question No.42: Cardiac Auscultation -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Cardiac_Auscultation">Question No.42: Cardiac Auscultation</label><br>
                            <select class="form-control" id="Question_No_42_Cardiac_Auscultation"
                                name="Question_No_42_Cardiac_Auscultation" required>
                                <option value="">Select</option>
                                <option value="Normal S1/S2"
                                    {{ (isset($_GET['Question_No_42_Cardiac_Auscultation']) && $_GET['Question_No_42_Cardiac_Auscultation'] == 'Normal S1/S2') || old('Question_No_42_Cardiac_Auscultation') == 'Normal S1/S2' || (isset($details['Question_No_42_Cardiac_Auscultation']) && $details['Question_No_42_Cardiac_Auscultation'] == 'Normal S1/S2') ? 'selected' : '' }}>
                                    Normal S1/S2
                                </option>
                                <option value="Murmur"
                                    {{ (isset($_GET['Question_No_42_Cardiac_Auscultation']) && $_GET['Question_No_42_Cardiac_Auscultation'] == 'Murmur') || old('Question_No_42_Cardiac_Auscultation') == 'Murmur' || (isset($details['Question_No_42_Cardiac_Auscultation']) && $details['Question_No_42_Cardiac_Auscultation'] == 'Murmur') ? 'selected' : '' }}>
                                    Murmur
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Comment/Findings -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="chest_comment">Comment/Findings</label><br>
                        <textarea name="chest_comment" id="chest_comment" placeholder="Comment here" cols="50">{{ isset($_GET['chest_comment']) ? $_GET['chest_comment'] : (isset($details['chest_comment']) ? $details['chest_comment'] : old('chest_comment')) }}</textarea>
                    </div>
                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Twelve -->
            <div class="step" id="step12">
                <h3>Abdomen</h3>
                <div class="form-group">
                    <div class="form-row">
                        <!-- Question No.43 -->
                        <div class="form-group col-md-6">
                            <label
                                for="Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen">
                                Question No.43: Did you observe any distension, scars, or masses on the child's abdomen?
                            </label><br>
                            <select class="form-control"
                                id="Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen"
                                name="Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen"
                                required>
                                <option value="">Select</option>
                                <option value="Distention"
                                    {{ (isset($_GET['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen']) && $_GET['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'] == 'Distention') || old('Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen') == 'Distention' || (isset($details['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen']) && $details['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'] == 'Distention') ? 'selected' : '' }}>
                                    Distention
                                </option>
                                <option value="Scar"
                                    {{ (isset($_GET['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen']) && $_GET['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'] == 'Scar') || old('Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen') == 'Scar' || (isset($details['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen']) && $details['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'] == 'Scar') ? 'selected' : '' }}>
                                    Scar
                                </option>
                                <option value="Mass"
                                    {{ (isset($_GET['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen']) && $_GET['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'] == 'Mass') || old('Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen') == 'Mass' || (isset($details['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen']) && $details['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'] == 'Mass') ? 'selected' : '' }}>
                                    Mass
                                </option>
                                <option value="Normal"
                                    {{ (isset($_GET['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen']) && $_GET['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'] == 'Normal') || old('Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen') == 'Normal' || (isset($details['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen']) && $details['Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'] == 'Normal') ? 'selected' : '' }}>
                                    Normal
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Question No.44 -->
                        <div class="form-group col-md-6">
                            <label for="Question_No_44_Any_history_of_abdominal_Pain">
                                Question No.44: Any history of abdominal Pain
                            </label><br>
                            <select class="form-control" id="Question_No_44_Any_history_of_abdominal_Pain"
                                name="Question_No_44_Any_history_of_abdominal_Pain" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ (isset($_GET['Question_No_44_Any_history_of_abdominal_Pain']) && $_GET['Question_No_44_Any_history_of_abdominal_Pain'] == 'Yes') || old('Question_No_44_Any_history_of_abdominal_Pain') == 'Yes' || (isset($details['Question_No_44_Any_history_of_abdominal_Pain']) && $details['Question_No_44_Any_history_of_abdominal_Pain'] == 'Yes') ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ (isset($_GET['Question_No_44_Any_history_of_abdominal_Pain']) && $_GET['Question_No_44_Any_history_of_abdominal_Pain'] == 'No') || old('Question_No_44_Any_history_of_abdominal_Pain') == 'No' || (isset($details['Question_No_44_Any_history_of_abdominal_Pain']) && $details['Question_No_44_Any_history_of_abdominal_Pain'] == 'No') ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>
                        </div>

                        <!-- Specify Abdominal Pain -->
                        <div class="form-group col-md-6 any_history_of_abdominal_pain_specify d-none">
                            <div class="form-group">
                                <label for="any_history_of_abdominal_pain_specify">Specify Abdominal Pain</label><br>
                                <input type="text" name="any_history_of_abdominal_pain_specify" class="form-control"
                                    id="any_history_of_abdominal_pain_specify"
                                    placeholder="Please specify any history of abdominal Pain"
                                    value="{{ isset($_GET['any_history_of_abdominal_pain_specify']) ? $_GET['any_history_of_abdominal_pain_specify'] : (isset($details['any_history_of_abdominal_pain_specify']) ? $details['any_history_of_abdominal_pain_specify'] : old('any_history_of_abdominal_pain_specify')) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Comment/Findings -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="abdomen_comment">Comment/Findings</label><br>
                            <textarea name="abdomen_comment" id="abdomen_comment" placeholder="Comment here" cols="50">{{ isset($_GET['abdomen_comment']) ? $_GET['abdomen_comment'] : (isset($details['abdomen_comment']) ? $details['abdomen_comment'] : old('abdomen_comment')) }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>

            <!-- Step Thirteen - Musculoskeletal -->
            <div class="step" id="step13">
                <h3>Musculoskeletal</h3>
                <div class="form-row">

                    <!-- Question 45: Limitations in joint motion -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label
                                for="Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination">Question
                                No.45: Did you observe any limitations in the
                                child's range of joint motion during your examination?*</label>
                            <select class="form-control"
                                id="Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"
                                name="Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"
                                required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ (isset($_GET['Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination']) && $_GET['Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination'] == 'Yes') || old('Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination') == 'Yes' || (isset($details['Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination']) && $details['Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination'] == 'Yes') ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ (isset($_GET['Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination']) && $_GET['Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination'] == 'No') || old('Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination') == 'No' || (isset($details['Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination']) && $details['Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination'] == 'No') ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Specify limitations in joint motion -->
                    <div class="form-group col-md-6">
                        <div
                            class="form-group Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination d-none">
                            <label
                                for="Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination">Specify
                                limitations in the child's range of joint
                                motion during your examination?*</label>
                            <input type="text"
                                name="Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"
                                class="form-control"
                                id="Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"
                                value="{{ isset($_GET['Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination']) ? $_GET['Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination'] : (isset($details['Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination']) ? $details['Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination'] : old('Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination')) }}"
                                placeholder="Please specify limitations in the child's range of joint motion during your examination?*" />
                        </div>
                    </div>

                    <!-- Question 46: Spinal curvature assessment -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_46_Spinal_curvature_assessment_tick_positive_finding">Question No.46:
                                Spinal curvature assessment (tick
                                positive finding)</label>
                            <select class="form-control"
                                id="Question_No_46_Spinal_curvature_assessment_tick_positive_finding"
                                name="Question_No_46_Spinal_curvature_assessment_tick_positive_finding" required>
                                <option value="">Select</option>
                                <option value="Uneven shoulders"
                                    {{ (isset($_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Uneven shoulders') || old('Question_No_46_Spinal_curvature_assessment_tick_positive_finding') == 'Uneven shoulders' || (isset($details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Uneven shoulders') ? 'selected' : '' }}>
                                    Uneven Shoulders
                                </option>
                                <option value="Shoulder Blade"
                                    {{ (isset($_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Shoulder Blade') || old('Question_No_46_Spinal_curvature_assessment_tick_positive_finding') == 'Shoulder Blade' || (isset($details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Shoulder Blade') ? 'selected' : '' }}>
                                    Shoulder Blade
                                </option>
                                <option value="Uneven waist"
                                    {{ (isset($_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Uneven waist') || old('Question_No_46_Spinal_curvature_assessment_tick_positive_finding') == 'Uneven waist' || (isset($details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Uneven waist') ? 'selected' : '' }}>
                                    Uneven Waist
                                </option>
                                <option value="Hips"
                                    {{ (isset($_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Hips') || old('Question_No_46_Spinal_curvature_assessment_tick_positive_finding') == 'Hips' || (isset($details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Hips') ? 'selected' : '' }}>
                                    Hips
                                </option>
                                <option value="Normal"
                                    {{ (isset($_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $_GET['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Normal') || old('Question_No_46_Spinal_curvature_assessment_tick_positive_finding') == 'Normal' || (isset($details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding']) && $details['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'] == 'Normal') ? 'selected' : '' }}>
                                    Normal
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 47: Side-to-side curvature -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_47_side_to_side_curvature_in_the_spine_resembling">Question No.47:
                                Side-to-side curvature in the spine
                                resembling</label>
                            <select class="form-control"
                                id="Question_No_47_side_to_side_curvature_in_the_spine_resembling"
                                name="Question_No_47_side_to_side_curvature_in_the_spine_resembling" required>
                                <option value="">Select</option>
                                <option value="S_Shape"
                                    {{ (isset($_GET['Question_No_47_side_to_side_curvature_in_the_spine_resembling']) && $_GET['Question_No_47_side_to_side_curvature_in_the_spine_resembling'] == 'S_Shape') || old('Question_No_47_side_to_side_curvature_in_the_spine_resembling') == 'S_Shape' || (isset($details['Question_No_47_side_to_side_curvature_in_the_spine_resembling']) && $details['Question_No_47_side_to_side_curvature_in_the_spine_resembling'] == 'S_Shape') ? 'selected' : '' }}>
                                    S Shape
                                </option>
                                <option value="C_Shape"
                                    {{ (isset($_GET['Question_No_47_side_to_side_curvature_in_the_spine_resembling']) && $_GET['Question_No_47_side_to_side_curvature_in_the_spine_resembling'] == 'C_Shape') || old('Question_No_47_side_to_side_curvature_in_the_spine_resembling') == 'C_Shape' || (isset($details['Question_No_47_side_to_side_curvature_in_the_spine_resembling']) && $details['Question_No_47_side_to_side_curvature_in_the_spine_resembling'] == 'C_Shape') ? 'selected' : '' }}>
                                    C Shape
                                </option>
                                <option value="Normal"
                                    {{ (isset($_GET['Question_No_47_side_to_side_curvature_in_the_spine_resembling']) && $_GET['Question_No_47_side_to_side_curvature_in_the_spine_resembling'] == 'Normal') || old('Question_No_47_side_to_side_curvature_in_the_spine_resembling') == 'Normal' || (isset($details['Question_No_47_side_to_side_curvature_in_the_spine_resembling']) && $details['Question_No_47_side_to_side_curvature_in_the_spine_resembling'] == 'Normal') ? 'selected' : '' }}>
                                    Normal
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 48: Adams forward bend test -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_48_Adams_forward_bend_test">Question No.48: Adams forward bend
                                test</label>
                            <select class="form-control" id="Question_No_48_Adams_forward_bend_test"
                                name="Question_No_48_Adams_forward_bend_test" required>
                                <option value="">Select</option>
                                <option value="Positive"
                                    {{ (isset($_GET['Question_No_48_Adams_forward_bend_test']) && $_GET['Question_No_48_Adams_forward_bend_test'] == 'Positive') || old('Question_No_48_Adams_forward_bend_test') == 'Positive' || (isset($details['Question_No_48_Adams_forward_bend_test']) && $details['Question_No_48_Adams_forward_bend_test'] == 'Positive') ? 'selected' : '' }}>
                                    Positive
                                </option>
                                <option value="Negative"
                                    {{ (isset($_GET['Question_No_48_Adams_forward_bend_test']) && $_GET['Question_No_48_Adams_forward_bend_test'] == 'Negative') || old('Question_No_48_Adams_forward_bend_test') == 'Negative' || (isset($details['Question_No_48_Adams_forward_bend_test']) && $details['Question_No_48_Adams_forward_bend_test'] == 'Negative') ? 'selected' : '' }}>
                                    Negative
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 49: Foot or toe abnormalities -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_49_Any_foot_or_toe_abnormalities">Question No.49: Any foot or toe
                                abnormalities</label>
                            <select class="form-control" id="Question_No_49_Any_foot_or_toe_abnormalities"
                                name="Question_No_49_Any_foot_or_toe_abnormalities" required>
                                <option value="">Select</option>
                                <option value="Normal"
                                    {{ (isset($_GET['Question_No_49_Any_foot_or_toe_abnormalities']) && $_GET['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Normal') || old('Question_No_49_Any_foot_or_toe_abnormalities') == 'Normal' || (isset($details['Question_No_49_Any_foot_or_toe_abnormalities']) && $details['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Normal') ? 'selected' : '' }}>
                                    Normal
                                </option>
                                <option value="Flat Feet"
                                    {{ (isset($_GET['Question_No_49_Any_foot_or_toe_abnormalities']) && $_GET['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Flat Feet') || old('Question_No_49_Any_foot_or_toe_abnormalities') == 'Flat Feet' || (isset($details['Question_No_49_Any_foot_or_toe_abnormalities']) && $details['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Flat Feet') ? 'selected' : '' }}>
                                    Flat Feet
                                </option>
                                <option value="Varus"
                                    {{ (isset($_GET['Question_No_49_Any_foot_or_toe_abnormalities']) && $_GET['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Varus') || old('Question_No_49_Any_foot_or_toe_abnormalities') == 'Varus' || (isset($details['Question_No_49_Any_foot_or_toe_abnormalities']) && $details['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Varus') ? 'selected' : '' }}>
                                    Varus
                                </option>
                                <option value="Valgus"
                                    {{ (isset($_GET['Question_No_49_Any_foot_or_toe_abnormalities']) && $_GET['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Valgus') || old('Question_No_49_Any_foot_or_toe_abnormalities') == 'Valgus' || (isset($details['Question_No_49_Any_foot_or_toe_abnormalities']) && $details['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Valgus') ? 'selected' : '' }}>
                                    Valgus
                                </option>
                                <option value="High Arch"
                                    {{ (isset($_GET['Question_No_49_Any_foot_or_toe_abnormalities']) && $_GET['Question_No_49_Any_foot_or_toe_abnormalities'] == 'High Arch') || old('Question_No_49_Any_foot_or_toe_abnormalities') == 'High Arch' || (isset($details['Question_No_49_Any_foot_or_toe_abnormalities']) && $details['Question_No_49_Any_foot_or_toe_abnormalities'] == 'High Arch') ? 'selected' : '' }}>
                                    High Arch
                                </option>
                                <option value="Hammer Toe"
                                    {{ (isset($_GET['Question_No_49_Any_foot_or_toe_abnormalities']) && $_GET['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Hammer Toe') || old('Question_No_49_Any_foot_or_toe_abnormalities') == 'Hammer Toe' || (isset($details['Question_No_49_Any_foot_or_toe_abnormalities']) && $details['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Hammer Toe') ? 'selected' : '' }}>
                                    Hammer Toe
                                </option>
                                <option value="Bunion"
                                    {{ (isset($_GET['Question_No_49_Any_foot_or_toe_abnormalities']) && $_GET['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Bunion') || old('Question_No_49_Any_foot_or_toe_abnormalities') == 'Bunion' || (isset($details['Question_No_49_Any_foot_or_toe_abnormalities']) && $details['Question_No_49_Any_foot_or_toe_abnormalities'] == 'Bunion') ? 'selected' : '' }}>
                                    Bunion
                                </option>
                            </select>
                        </div>
                    </div>


                    <!-- Comment/Findings -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="musculoskeletal_comment">Comment/Findings</label>
                            <textarea name="musculoskeletal_comment" id="musculoskeletal_comment" placeholder="Comment here" cols="50">{{ isset($_GET['musculoskeletal_comment']) ? $_GET['musculoskeletal_comment'] : (isset($details['musculoskeletal_comment']) ? $details['musculoskeletal_comment'] : old('musculoskeletal_comment')) }}</textarea>
                        </div>
                    </div>



                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>

            </div>


            <!-- Step Fourteen - Vaccination -->
            <div class="step" id="step14">
                <h3>Vaccination</h3>
                <div class="form-row">
                    <!-- Question 50: EPI Immunization Card -->

                    <div class="form-group col-md-6">
                        <label for="Question_No_50_Have_EPI_immunization_card">Question No.50: Have EPI immunization
                            card? </label>
                        <select class="form-control" id="Question_No_50_Have_EPI_immunization_card"
                            name="Question_No_50_Have_EPI_immunization_card" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ (isset($_GET['Question_No_50_Have_EPI_immunization_card']) && $_GET['Question_No_50_Have_EPI_immunization_card'] == 'Yes') || old('Question_No_50_Have_EPI_immunization_card') == 'Yes' || (isset($details['Question_No_50_Have_EPI_immunization_card']) && $details['Question_No_50_Have_EPI_immunization_card'] == 'Yes') ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ (isset($_GET['Question_No_50_Have_EPI_immunization_card']) && $_GET['Question_No_50_Have_EPI_immunization_card'] == 'No') || old('Question_No_50_Have_EPI_immunization_card') == 'No' || (isset($details['Question_No_50_Have_EPI_immunization_card']) && $details['Question_No_50_Have_EPI_immunization_card'] == 'No') ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Reason of not being vaccinated -->
                    <div class="form-group col-md-6 Reason_of_not_being_vaccinated d-none">
                        <label for="Reason_of_not_being_vaccinated">Reason of not being vaccinated</label>
                        <input type="text" name="Reason_of_not_being_vaccinated" id="Reason_of_not_being_vaccinated"
                            value="{{ isset($details['Reason_of_not_being_vaccinated']) ? $details['Reason_of_not_being_vaccinated'] : old('Reason_of_not_being_vaccinated') }}"
                            class="form-control">
                    </div>

                </div>
                <div class="form-row">


                    <!-- Vaccinations Completed -->
                    <div class="form-group col-md-6">
                        <div class="form-group">

                            <label for="vaccinations_completed">Question No.50: Mark all the vaccinations that are
                                completed</label><br>
                            <input type="checkbox" value="BCG_1_dose" id="BCG_1_dose" name="BCG_1_dose"
                                {{ isset($details['BCG_1_dose']) && $details['BCG_1_dose'] == 'BCG_1_dose' ? 'checked' : '' }}>
                            <label for="BCG_1_dose">BCG 1 Dose</label><br>

                            <input type="checkbox" value="OPV_4_dose" id="OPV_4_dose" name="OPV_4_dose"
                                {{ isset($details['OPV_4_dose']) && $details['OPV_4_dose'] == 'OPV_4_dose' ? 'checked' : '' }}>
                            <label for="OPV_4_dose">OPV 4 Dose</label><br>

                            <input type="checkbox" value="Pentavalent_vaccine_DTP" id="Pentavalent_vaccine_DTP"
                                name="Pentavalent_vaccine_DTP"
                                {{ isset($details['Pentavalent_vaccine_DTP']) && $details['Pentavalent_vaccine_DTP'] == 'Pentavalent_vaccine_DTP' ? 'checked' : '' }}>
                            <label for="Pentavalent_vaccine_DTP">Pentavalent Vaccine (DTP+Hep B+Hib) 3 Doses</label><br>

                            <input type="checkbox" value="rota" id="rota" name="rota"
                                {{ isset($details['rota']) && $details['rota'] == 'rota' ? 'checked' : '' }}>
                            <label for="rota">Rota 2 Doses</label><br>

                            <input type="checkbox" value="measles" id="measles" name="measles"
                                {{ isset($details['measles']) && $details['measles'] == 'measles' ? 'checked' : '' }}>
                            <label for="measles">Measles 2 Doses</label><br>

                            <input type="checkbox" value="never_had_any_vaccination" id="never_had_any_vaccination"
                                name="never_had_any_vaccination"
                                {{ isset($details['never_had_any_vaccination']) && $details['never_had_any_vaccination'] == 'never_had_any_vaccination' ? 'checked' : '' }}>
                            <label for="never_had_any_vaccination">Never Had Any Vaccination</label>
                        </div>
                    </div>

                </div>
                <div class="form-row">

                    <!-- Comment/Findings -->
                    <div class="form-group col-md-6">
                        <label for="vaccination_comment">Comment/Findings</label>
                        <textarea name="vaccination_comment" id="vaccination_comment" placeholder="Comment here" cols="50">{{ isset($_GET['vaccination_comment']) ? $_GET['vaccination_comment'] : (isset($details['vaccination_comment']) ? $details['vaccination_comment'] : old('vaccination_comment')) }}</textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Fifteen - Miscellaneous -->

            <div class="step" id="step15">
                <h3>Miscellaneous</h3>
                <div class="form-row">
                    <!-- Question 55 -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_55_Do_you_have_any_Allergies">Question No.55: Do you have any
                            Allergies</label>
                        <select class="form-control" id="Question_No_55_Do_you_have_any_Allergies"
                            name="Question_No_55_Do_you_have_any_Allergies" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ isset($details['Question_No_55_Do_you_have_any_Allergies']) && $details['Question_No_55_Do_you_have_any_Allergies'] == 'Yes' ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ isset($details['Question_No_55_Do_you_have_any_Allergies']) && $details['Question_No_55_Do_you_have_any_Allergies'] == 'No' ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Specify Allergies -->
                    <div class="form-group col-md-6  Do_you_have_any_allergies_specify">
                        <label for="Do_you_have_any_allergies_specify">Specify Allergies</label>
                        <input type="text" name="Do_you_have_any_allergies_specify" class="form-control"
                            id="Do_you_have_any_allergies_specify"
                            value="{{ isset($details['Do_you_have_any_allergies_specify']) ? $details['Do_you_have_any_allergies_specify'] : '' }}">
                    </div>

                    <!-- Question 56 -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_56_Girls_above_8_years_old_ask">Question No.56: Girls above 8 years old,
                            ask age of Menarche</label>
                        <input type="text" name="Question_No_56_Girls_above_8_years_old_ask" class="form-control"
                            id="Question_No_56_Girls_above_8_years_old_ask" placeholder="Write Age"
                            value="{{ isset($details['Question_No_56_Girls_above_8_years_old_ask']) ? $details['Question_No_56_Girls_above_8_years_old_ask'] : '' }}">
                    </div>

                    <!-- Question 57 -->
                    <div class="form-group col-md-6">
                        <label
                            for="Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination">
                            Question No.57: Inquire about urinary frequency, urgency, and any pain or discomfort during
                            urination.
                        </label>
                        <select class="form-control"
                            id="Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination"
                            name="Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination"
                            required>
                            <option value="">Select</option>
                            <option value="No urinary issues reported"
                                {{ isset($details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination']) && $details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination'] == 'No urinary issues reported' ? 'selected' : '' }}>
                                No urinary issues reported
                            </option>
                            <option value="Urinary frequency"
                                {{ isset($details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination']) && $details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination'] == 'Urinary frequency' ? 'selected' : '' }}>
                                Urinary frequency
                            </option>
                            <option value="Urinary urgency"
                                {{ isset($details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination']) && $details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination'] == 'Urinary urgency' ? 'selected' : '' }}>
                                Urinary urgency
                            </option>
                            <option value="Pain or discomfort during urination"
                                {{ isset($details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination']) && $details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination'] == 'Pain or discomfort during urination' ? 'selected' : '' }}>
                                Pain or discomfort during urination
                            </option>
                            <option value="Nocturnal enuresis"
                                {{ isset($details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination']) && $details['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination'] == 'Nocturnal enuresis' ? 'selected' : '' }}>
                                Nocturnal enuresis
                            </option>
                        </select>
                    </div>

                    <!-- Question 58 -->
                    <div class="form-group col-md-6">
                        <label for="QuestionNo_58_Any_menstrual_abnormality">Question No.58: Any menstrual
                            abnormality</label>
                        <select class="form-control" id="QuestionNo_58_Any_menstrual_abnormality"
                            name="QuestionNo_58_Any_menstrual_abnormality" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ isset($details['QuestionNo_58_Any_menstrual_abnormality']) && $details['QuestionNo_58_Any_menstrual_abnormality'] == 'Yes' ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ isset($details['QuestionNo_58_Any_menstrual_abnormality']) && $details['QuestionNo_58_Any_menstrual_abnormality'] == 'No' ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Specify Menstrual Abnormality -->
                    <div class="form-group col-md-6 Any_menstrual_abnormality_specify">
                        <label for="Any_menstrual_abnormality_specify">Specify Menstrual Abnormality</label>
                        <input type="text" name="Any_menstrual_abnormality_specify" class="form-control"
                            id="Any_menstrual_abnormality_specify"
                            value="{{ isset($details['Any_menstrual_abnormality_specify']) ? $details['Any_menstrual_abnormality_specify'] : '' }}">
                    </div>

                    <!-- Comment -->
                    <div class="form-group col-md-6">
                        <label for="miscellaneous_comment">Comment/Findings</label>
                        <textarea name="miscellaneous_comment" id="miscellaneous_comment" class="form-control" required>
                            {{ isset($details['miscellaneous_comment']) ? $details['miscellaneous_comment'] : '' }}
                        </textarea>
                    </div>
                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Sixteen - Psychological -->
            <div class="step mb-5" id="step16">
                <h3>Psychological</h3>


                <div class="form-row">
                    <!-- Question 59: Thought Patterns -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Thought Patterns">
                                Question No.59: <b>Thought Patterns:</b> How often do you experience negative or intrusive
                                thoughts?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts"
                                name="Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts" required>
                                <option value="">Select</option>
                                <option value="Rarely"
                                    {{ isset($_GET['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'])
                                        ? ($_GET['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] == 'Rarely'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'])
                                            ? ($details['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] == 'Rarely'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts') == 'Rarely'
                                                ? 'selected'
                                                : '')) }}>
                                    Rarely
                                </option>
                                <option value="Occasionally"
                                    {{ isset($_GET['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'])
                                        ? ($_GET['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] == 'Occasionally'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'])
                                            ? ($details['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] == 'Occasionally'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts') == 'Occasionally'
                                                ? 'selected'
                                                : '')) }}>
                                    Occasionally
                                </option>
                                <option value="Frequently"
                                    {{ isset($_GET['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'])
                                        ? ($_GET['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] == 'Frequently'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'])
                                            ? ($details['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] == 'Frequently'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts') == 'Frequently'
                                                ? 'selected'
                                                : '')) }}>
                                    Frequently
                                </option>
                                <option value="Almost always"
                                    {{ isset($_GET['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'])
                                        ? ($_GET['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] == 'Almost always'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'])
                                            ? ($details['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] == 'Almost always'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts') == 'Almost always'
                                                ? 'selected'
                                                : '')) }}>
                                    Almost always
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 60: Self-Esteem -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Self-Esteem">
                                Question No.60: <b>Self-Esteem:</b> How would you rate your overall self-esteem and
                                self-confidence?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence"
                                name="Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence"
                                required>
                                <option value="">Select</option>
                                <option value="Very high"
                                    {{ isset($_GET['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'])
                                        ? ($_GET['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'] == 'Very high'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'])
                                            ? ($details['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'] == 'Very high'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence') == 'Very high'
                                                ? 'selected'
                                                : '')) }}>
                                    Very high
                                </option>
                                <option value="Moderately high"
                                    {{ isset($_GET['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'])
                                        ? ($_GET['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'] == 'Moderately high'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'])
                                            ? ($details['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'] ==
                                            'Moderately high'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence') == 'Moderately high'
                                                ? 'selected'
                                                : '')) }}>
                                    Moderately high
                                </option>
                                <option value="Moderately low"
                                    {{ isset($_GET['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'])
                                        ? ($_GET['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'] == 'Moderately low'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'])
                                            ? ($details['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'] ==
                                            'Moderately low'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence') == 'Moderately low'
                                                ? 'selected'
                                                : '')) }}>
                                    Moderately low
                                </option>
                                <option value="Very low"
                                    {{ isset($_GET['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'])
                                        ? ($_GET['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'] == 'Very low'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'])
                                            ? ($details['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'] == 'Very low'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence') == 'Very low'
                                                ? 'selected'
                                                : '')) }}>
                                    Very low
                                </option>
                            </select>
                        </div>
                    </div>
                </div>




                <div class="form-row">
                    <!-- Question 61: Energy Levels -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Energy Levels">
                                Question No.61: <b>Energy Levels:</b> How would you describe your energy levels throughout a
                                typical day?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day"
                                name="Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day"
                                required>
                                <option value="">Select</option>
                                <option value="High and consistent"
                                    {{ isset($_GET['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'])
                                        ? ($_GET['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'] ==
                                        'High and consistent'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'])
                                            ? ($details['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'] ==
                                            'High and consistent'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day') ==
                                            'High and consistent'
                                                ? 'selected'
                                                : '')) }}>
                                    High and consistent
                                </option>
                                <option value="Moderate and stable"
                                    {{ isset($_GET['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'])
                                        ? ($_GET['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'] ==
                                        'Moderate and stable'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'])
                                            ? ($details['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'] ==
                                            'Moderate and stable'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day') ==
                                            'Moderate and stable'
                                                ? 'selected'
                                                : '')) }}>
                                    Moderate and stable
                                </option>
                                <option value="Fluctuating"
                                    {{ isset($_GET['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'])
                                        ? ($_GET['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'] == 'Fluctuating'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'])
                                            ? ($details['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'] ==
                                            'Fluctuating'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day') == 'Fluctuating'
                                                ? 'selected'
                                                : '')) }}>
                                    Fluctuating
                                </option>
                                <option value="Low and inconsistent"
                                    {{ isset($_GET['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'])
                                        ? ($_GET['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'] ==
                                        'Low and inconsistent'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'])
                                            ? ($details['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'] ==
                                            'Low and inconsistent'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day') ==
                                            'Low and inconsistent'
                                                ? 'selected'
                                                : '')) }}>
                                    Low and inconsistent
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 62: Coping Strategies -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Coping Strategies">
                                Question No.62: <b>Coping Strategies:</b> When faced with challenges, what are your typical
                                coping mechanisms?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms"
                                name="Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms"
                                required>
                                <option value="">Select</option>
                                <option value="Healthy coping strategies"
                                    {{ isset($_GET['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'])
                                        ? ($_GET['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'] ==
                                        'Healthy coping strategies'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'])
                                            ? ($details['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'] ==
                                            'Healthy coping strategies'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms') ==
                                            'Healthy coping strategies'
                                                ? 'selected'
                                                : '')) }}>
                                    Healthy coping strategies
                                </option>
                                <option value="Neutral coping strategies"
                                    {{ isset($_GET['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'])
                                        ? ($_GET['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'] ==
                                        'Neutral coping strategies'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'])
                                            ? ($details['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'] ==
                                            'Neutral coping strategies'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms') ==
                                            'Neutral coping strategies'
                                                ? 'selected'
                                                : '')) }}>
                                    Neutral coping strategies
                                </option>
                                <option value="Unhealthy coping strategies"
                                    {{ isset($_GET['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'])
                                        ? ($_GET['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'] ==
                                        'Unhealthy coping strategies'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'])
                                            ? ($details['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'] ==
                                            'Unhealthy coping strategies'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms') ==
                                            'Unhealthy coping strategies'
                                                ? 'selected'
                                                : '')) }}>
                                    Unhealthy coping strategies
                                </option>
                                <option value="No clear coping strategies"
                                    {{ isset($_GET['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'])
                                        ? ($_GET['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'] ==
                                        'No clear coping strategies'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'])
                                            ? ($details['Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms'] ==
                                            'No clear coping strategies'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms') ==
                                            'No clear coping strategies'
                                                ? 'selected'
                                                : '')) }}>
                                    No clear coping strategies
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Question 63: Sleep Quality -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Sleep Quality">
                                Question No.63: <b>Sleep Quality:</b> How would you rate the quality of your sleep on
                                average?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average"
                                name="Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average" required>
                                <option value="">Select</option>
                                <option value="Excellent"
                                    {{ isset($_GET['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'])
                                        ? ($_GET['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'] == 'Excellent'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'])
                                            ? ($details['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'] == 'Excellent'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average') == 'Excellent'
                                                ? 'selected'
                                                : '')) }}>
                                    Excellent
                                </option>
                                <option value="Good"
                                    {{ isset($_GET['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'])
                                        ? ($_GET['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'] == 'Good'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'])
                                            ? ($details['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'] == 'Good'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average') == 'Good'
                                                ? 'selected'
                                                : '')) }}>
                                    Good
                                </option>
                                <option value="Fair"
                                    {{ isset($_GET['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'])
                                        ? ($_GET['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'] == 'Fair'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'])
                                            ? ($details['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'] == 'Fair'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average') == 'Fair'
                                                ? 'selected'
                                                : '')) }}>
                                    Fair
                                </option>
                                <option value="Poor"
                                    {{ isset($_GET['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'])
                                        ? ($_GET['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'] == 'Poor'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'])
                                            ? ($details['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'] == 'Poor'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average') == 'Poor'
                                                ? 'selected'
                                                : '')) }}>
                                    Poor
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 64: Stress Levels -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Stress Levels">
                                Question No.64: <b>Stress Levels:</b> How often have you felt overwhelmed or stressed in the
                                last few weeks?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks"
                                name="Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks"
                                required>
                                <option value="">Select</option>
                                <option value="Rarely"
                                    {{ isset($_GET['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'])
                                        ? ($_GET['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'] == 'Rarely'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'])
                                            ? ($details['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'] == 'Rarely'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks') == 'Rarely'
                                                ? 'selected'
                                                : '')) }}>
                                    Rarely
                                </option>
                                <option value="Occasionally"
                                    {{ isset($_GET['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'])
                                        ? ($_GET['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'] == 'Occasionally'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'])
                                            ? ($details['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'] ==
                                            'Occasionally'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks') == 'Occasionally'
                                                ? 'selected'
                                                : '')) }}>
                                    Occasionally
                                </option>
                                <option value="Frequently"
                                    {{ isset($_GET['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'])
                                        ? ($_GET['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'] == 'Frequently'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'])
                                            ? ($details['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'] ==
                                            'Frequently'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks') == 'Frequently'
                                                ? 'selected'
                                                : '')) }}>
                                    Frequently
                                </option>
                                <option value="Almost always"
                                    {{ isset($_GET['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'])
                                        ? ($_GET['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'] == 'Almost always'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'])
                                            ? ($details['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'] ==
                                            'Almost always'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks') ==
                                            'Almost always'
                                                ? 'selected'
                                                : '')) }}>
                                    Almost always
                                </option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="form-row">
                    <!-- Question 65: Mood Assessment -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Mood Assessment">
                                Question No.65: <b>Mood Assessment:</b> How would you describe your overall mood during the
                                day?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_65_How_would_you_describe_your_overall_mood_during_the_day"
                                name="Question_No_65_How_would_you_describe_your_overall_mood_during_the_day" required>
                                <option value="">Select</option>
                                <option value="Very positive"
                                    {{ isset($_GET['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'])
                                        ? ($_GET['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'] == 'Very positive'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'])
                                            ? ($details['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'] == 'Very positive'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_65_How_would_you_describe_your_overall_mood_during_the_day') == 'Very positive'
                                                ? 'selected'
                                                : '')) }}>
                                    Very positive
                                </option>
                                <option value="Mostly positive"
                                    {{ isset($_GET['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'])
                                        ? ($_GET['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'] == 'Mostly positive'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'])
                                            ? ($details['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'] == 'Mostly positive'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_65_How_would_you_describe_your_overall_mood_during_the_day') == 'Mostly positive'
                                                ? 'selected'
                                                : '')) }}>
                                    Mostly positive
                                </option>
                                <option value="Mixed"
                                    {{ isset($_GET['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'])
                                        ? ($_GET['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'] == 'Mixed'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'])
                                            ? ($details['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'] == 'Mixed'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_65_How_would_you_describe_your_overall_mood_during_the_day') == 'Mixed'
                                                ? 'selected'
                                                : '')) }}>
                                    Mixed
                                </option>
                                <option value="Mostly negative"
                                    {{ isset($_GET['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'])
                                        ? ($_GET['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'] == 'Mostly negative'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'])
                                            ? ($details['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'] == 'Mostly negative'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_65_How_would_you_describe_your_overall_mood_during_the_day') == 'Mostly negative'
                                                ? 'selected'
                                                : '')) }}>
                                    Mostly negative
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 66: Family Relationships -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Family Relationships">
                                Question No.66: <b>Family Relationships:</b> How would you describe the quality of your
                                relationships with family members?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members"
                                name="Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members"
                                required>
                                <option value="">Select</option>
                                <option value="Very positive"
                                    {{ isset($_GET['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'])
                                        ? ($_GET['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'] ==
                                        'Very positive'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'])
                                            ? ($details['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'] ==
                                            'Very positive'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members') ==
                                            'Very positive'
                                                ? 'selected'
                                                : '')) }}>
                                    Very positive
                                </option>
                                <option value="Mostly positive"
                                    {{ isset($_GET['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'])
                                        ? ($_GET['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'] ==
                                        'Mostly positive'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'])
                                            ? ($details['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'] ==
                                            'Mostly positive'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members') ==
                                            'Mostly positive'
                                                ? 'selected'
                                                : '')) }}>
                                    Mostly positive
                                </option>
                                <option value="Mixed"
                                    {{ isset($_GET['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'])
                                        ? ($_GET['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'] == 'Mixed'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'])
                                            ? ($details['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'] ==
                                            'Mixed'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members') == 'Mixed'
                                                ? 'selected'
                                                : '')) }}>
                                    Mixed
                                </option>
                                <option value="Mostly negative"
                                    {{ isset($_GET['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'])
                                        ? ($_GET['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'] ==
                                        'Mostly negative'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'])
                                            ? ($details['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'] ==
                                            'Mostly negative'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members') ==
                                            'Mostly negative'
                                                ? 'selected'
                                                : '')) }}>
                                    Mostly negative
                                </option>
                            </select>
                        </div>
                    </div>
                </div>





                <div class="form-row">
                    <!-- Question 67: Problem-Solving Skills -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Problem-Solving Skills">
                                Question No.67: <b>Problem-Solving Skills:</b> How well do you handle challenges and solve
                                problems?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_67_How_well_do_you_handle_challenges_and_solve_problems"
                                name="Question_No_67_How_well_do_you_handle_challenges_and_solve_problems" required>

                                <option value="">Select</option>
                                <option value="Very well"
                                    {{ isset($_GET['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'])
                                        ? ($_GET['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'] == 'Very well'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'])
                                            ? ($details['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'] == 'Very well'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_67_How_well_do_you_handle_challenges_and_solve_problems') == 'Very well'
                                                ? 'selected'
                                                : '')) }}>
                                    Very well
                                </option>
                                <option value="Moderately well"
                                    {{ isset($_GET['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'])
                                        ? ($_GET['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'] == 'Moderately well'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'])
                                            ? ($details['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'] == 'Moderately well'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_67_How_well_do_you_handle_challenges_and_solve_problems') == 'Moderately well'
                                                ? 'selected'
                                                : '')) }}>
                                    Moderately well
                                </option>
                                <option value="Somewhat poorly"
                                    {{ isset($_GET['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'])
                                        ? ($_GET['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'] == 'Somewhat poorly'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'])
                                            ? ($details['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'] == 'Somewhat poorly'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_67_How_well_do_you_handle_challenges_and_solve_problems') == 'Somewhat poorly'
                                                ? 'selected'
                                                : '')) }}>
                                    Somewhat poorly
                                </option>
                                <option value="Very poorly"
                                    {{ isset($_GET['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'])
                                        ? ($_GET['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'] == 'Very poorly'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'])
                                            ? ($details['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'] == 'Very poorly'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_67_How_well_do_you_handle_challenges_and_solve_problems') == 'Very poorly'
                                                ? 'selected'
                                                : '')) }}>
                                    Very poorly
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 68: Sleep Patterns -->
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Sleep Patterns">
                                Question No.68: <b>Sleep Patterns:</b> How many hours of sleep do you typically get on a
                                school night?
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night"
                                name="Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night"
                                required>
                                <option value="">Select</option>
                                <option value="9 or more hours"
                                    {{ isset($_GET['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'])
                                        ? ($_GET['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'] == '9 or more hours'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'])
                                            ? ($details['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'] ==
                                            '9 or more hours'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night') == '9 or more hours'
                                                ? 'selected'
                                                : '')) }}>
                                    9 or more hours
                                </option>
                                <option value="7-8 hours"
                                    {{ isset($_GET['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'])
                                        ? ($_GET['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'] == '7-8 hours'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'])
                                            ? ($details['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'] == '7-8 hours'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night') == '7-8 hours'
                                                ? 'selected'
                                                : '')) }}>
                                    7-8 hours
                                </option>
                                <option value="6 hours or less"
                                    {{ isset($_GET['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'])
                                        ? ($_GET['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'] == '6 hours or less'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'])
                                            ? ($details['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'] ==
                                            '6 hours or less'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night') == '6 hours or less'
                                                ? 'selected'
                                                : '')) }}>
                                    6 hours or less
                                </option>
                                <option value="Variable, inconsistent"
                                    {{ isset($_GET['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'])
                                        ? ($_GET['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'] ==
                                        'Variable, inconsistent'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'])
                                            ? ($details['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'] ==
                                            'Variable, inconsistent'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night') ==
                                            'Variable, inconsistent'
                                                ? 'selected'
                                                : '')) }}>
                                    Variable, inconsistent
                                </option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <!-- Question 69: Follow-Up Required -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="followup_required">Question No.69: <b>Follow-Up Required:</b></label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="followup_required"
                                name="followup_required" required ">
                                                                <option value="">Select</option>
                                                                <option value="Yes"
                                                                    {{ isset($_GET['followup_required'])
                                                                        ? ($_GET['followup_required'] == 'Yes'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['followup_required'])
                                                                            ? ($details['followup_required'] == 'Yes'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('followup_required') == 'Yes'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Yes
                                                                </option>
                                                                <option value="No"
                                                                    {{ isset($_GET['followup_required'])
                                                                        ? ($_GET['followup_required'] == 'No'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['followup_required'])
                                                                            ? ($details['followup_required'] == 'No'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('followup_required') == 'No'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    No
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Question 70: Referred By -->
                                                    <div class="form-group col-md-6">
                                                        <div
                                                            class="form-group reffered {{ (isset($_GET['followup_required']) && $_GET['followup_required'] == 'Yes') ||
                                                            (isset($details['followup_required']) && $details['followup_required'] == 'Yes') ||
                                                            old('followup_required') == 'Yes'
                                                                ? ''
                                                                : 'd-none' }}">
                                                            <label for="referred_by">Question No.70: <b>Referred By:</b></label><br>
                                                            <select class="form-control PsychologicalSelectedAttribute" id="referred_by" name="referred_by">
                                                                        <option value="">Select</option>
                                                                        <option value="Teacher"
                                                                            {{ !empty($details['referred_by']) && 
                                                                            ($details['referred_by'] == 'Teacher') 
                                                                            ? 'selected' : '' }}>
                                                                            Teacher
                                                                        </option>
                                                                        <option value="School Doctor"
                                                                            {{ !empty($details['referred_by']) && 
                                                                            ($details['referred_by'] == 'School Doctor') 
                                                                            ? 'selected' : '' }}>
                                                                            School Doctor
                                                                        </option>
                                                                        <option value="Both"
                                                                            {{ !empty($details['referred_by']) && 
                                                                            ($details['referred_by'] == 'Both') 
                                                                            ? 'selected' : '' }}>
                                                                            Both
                                                                        </option>
                                                                        <option value="None"
                                                                            {{ !empty($details['referred_by']) && 
                                                                            ($details['referred_by'] == 'None') 
                                                                            ? 'selected' : '' }}>
                                                                            None
                                                                        </option>
                                                                    </select>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-row">
                                                    <!-- Observation: Restless or Overactive -->
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group observation">
                                                            <label for="observation1">
                                                                <b>Question:</b> Restless or overactive?
                                                                <span>(Tell me about his/her focus level. See if the child is shifting by asking a question
                                                                    related to his/her name or which subject he/she likes.)</span>
                                                            </label><br>
                                                            <select class="form-control PsychologicalSelectedAttribute" id="observation1"
                                                                name="observation1">
                                                                <option value="">Select</option>
                                                                <option value="1"
                                                                    {{ isset($_GET['observation1'])
                                                                        ? ($_GET['observation1'] == '1'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation1'])
                                                                            ? ($details['observation1'] == '1'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation1') == '1'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Not At All
                                                                </option>
                                                                <option value="2"
                                                                    {{ isset($_GET['observation1'])
                                                                        ? ($_GET['observation1'] == '2'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation1'])
                                                                            ? ($details['observation1'] == '2'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation1') == '2'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Just a Little
                                                                </option>
                                                                <option value="3"
                                                                    {{ isset($_GET['observation1'])
                                                                        ? ($_GET['observation1'] == '3'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation1'])
                                                                            ? ($details['observation1'] == '3'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation1') == '3'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Pretty Much
                                                                </option>
                                                                <option value="4"
                                                                    {{ isset($_GET['observation1'])
                                                                        ? ($_GET['observation1'] == '4'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation1'])
                                                                            ? ($details['observation1'] == '4'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation1') == '4'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Very Much
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <!-- Excitable, Impulsive -->
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group observation">
                                                            <label for="observation2">
                                                                <b>Question:</b> Excitable, Impulsive?
                                                                <span>(Ask about aggression level, how often the child engages in fights during
                                                                    class.)</span>
                                                            </label><br>
                                                            <select class="form-control PsychologicalSelectedAttribute" id="observation2"
                                                                name="observation2">
                                                                <option value="">Select</option>
                                                                <option value="1"
                                                                    {{ isset($_GET['observation2'])
                                                                        ? ($_GET['observation2'] == '1'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation2'])
                                                                            ? ($details['observation2'] == '1'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation2') == '1'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Not At All
                                                                </option>
                                                                <option value="2"
                                                                    {{ isset($_GET['observation2'])
                                                                        ? ($_GET['observation2'] == '2'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation2'])
                                                                            ? ($details['observation2'] == '2'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation2') == '2'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Just a Little
                                                                </option>
                                                                <option value="3"
                                                                    {{ isset($_GET['observation2'])
                                                                        ? ($_GET['observation2'] == '3'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation2'])
                                                                            ? ($details['observation2'] == '3'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation2') == '3'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Pretty Much
                                                                </option>
                                                                <option value="4"
                                                                    {{ isset($_GET['observation2'])
                                                                        ? ($_GET['observation2'] == '4'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation2'])
                                                                            ? ($details['observation2'] == '4'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation2') == '4'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Very Much
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Disturbs Other Children -->
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group observation">
                                                            <label for="observation3">
                                                                <b>Question:</b> Disturbs other children?
                                                                <span>(Pin or irritate others, disturbing the whole class.)</span>
                                                            </label><br>
                                                            <select class="form-control PsychologicalSelectedAttribute" id="observation3"
                                                                name="observation3">
                                                                <option value="">Select</option>
                                                                <option value="1"
                                                                    {{ isset($_GET['observation3'])
                                                                        ? ($_GET['observation3'] == '1'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation3'])
                                                                            ? ($details['observation3'] == '1'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation3') == '1'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Not At All
                                                                </option>
                                                                <option value="2"
                                                                    {{ isset($_GET['observation3'])
                                                                        ? ($_GET['observation3'] == '2'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation3'])
                                                                            ? ($details['observation3'] == '2'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation3') == '2'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Just a Little
                                                                </option>
                                                                <option value="3"
                                                                    {{ isset($_GET['observation3'])
                                                                        ? ($_GET['observation3'] == '3'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation3'])
                                                                            ? ($details['observation3'] == '3'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation3') == '3'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Pretty Much
                                                                </option>
                                                                <option value="4"
                                                                    {{ isset($_GET['observation3'])
                                                                        ? ($_GET['observation3'] == '4'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation3'])
                                                                            ? ($details['observation3'] == '4'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation3') == '4'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Very Much
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <!-- Fails to finish things started - short attention span -->
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group observation">
                                                            <label for="observation4">
                                                                <b>Question:</b> Fails to finish things started - short attention span?
                                                                <span>(Couldn’t complete the task at all.)</span>
                                                            </label><br>
                                                            <select class="form-control PsychologicalSelectedAttribute" id="observation4"
                                                                name="observation4">
                                                                <option value="">Select</option>
                                                                <option value="1"
                                                                    {{ isset($_GET['observation4'])
                                                                        ? ($_GET['observation4'] == '1'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation4'])
                                                                            ? ($details['observation4'] == '1'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation4') == '1'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Not At All
                                                                </option>
                                                                <option value="2"
                                                                    {{ isset($_GET['observation4'])
                                                                        ? ($_GET['observation4'] == '2'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation4'])
                                                                            ? ($details['observation4'] == '2'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation4') == '2'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Just a Little
                                                                </option>
                                                                <option value="3"
                                                                    {{ isset($_GET['observation4'])
                                                                        ? ($_GET['observation4'] == '3'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation4'])
                                                                            ? ($details['observation4'] == '3'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation4') == '3'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Pretty Much
                                                                </option>
                                                                <option value="4"
                                                                    {{ isset($_GET['observation4'])
                                                                        ? ($_GET['observation4'] == '4'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation4'])
                                                                            ? ($details['observation4'] == '4'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation4') == '4'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Very Much
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Inattentive, easily distracted -->
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group observation">
                                                            <label for="observation5">
                                                                <b>Question:</b> Inattentive, easily distracted?
                                                                <span>(Difficulty following instructions, ask any question and see if the child can follow
                                                                    it.)</span>
                                                            </label><br>
                                                            <select class="form-control PsychologicalSelectedAttribute" id="observation5"
                                                                name="observation5">
                                                                <option value="">Select</option>
                                                                <option value="1"
                                                                    {{ isset($_GET['observation5'])
                                                                        ? ($_GET['observation5'] == '1'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation5'])
                                                                            ? ($details['observation5'] == '1'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation5') == '1'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Not At All
                                                                </option>
                                                                <option value="2"
                                                                    {{ isset($_GET['observation5'])
                                                                        ? ($_GET['observation5'] == '2'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation5'])
                                                                            ? ($details['observation5'] == '2'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation5') == '2'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Just a Little
                                                                </option>
                                                                <option value="3"
                                                                    {{ isset($_GET['observation5'])
                                                                        ? ($_GET['observation5'] == '3'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation5'])
                                                                            ? ($details['observation5'] == '3'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation5') == '3'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Pretty Much
                                                                </option>
                                                                <option value="4"
                                                                    {{ isset($_GET['observation5'])
                                                                        ? ($_GET['observation5'] == '4'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation5'])
                                                                            ? ($details['observation5'] == '4'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation5') == '4'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Very Much
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>




                                                <div class="row">
                                                    <!-- Cries often and easily -->
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group observation">
                                                            <label for="observation6">
                                                                <b>Question:</b> Cries often and easily?
                                                                <span>(How often the child cries during class)</span>
                                                            </label><br>
                                                            <select class="form-control PsychologicalSelectedAttribute" id="observation6"
                                                                name="observation6">
                                                                <option value="">Select</option>
                                                                <option value="1"
                                                                    {{ isset($_GET['observation6'])
                                                                        ? ($_GET['observation6'] == '1'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation6'])
                                                                            ? ($details['observation6'] == '1'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation6') == '1'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Not At All
                                                                </option>
                                                                <option value="2"
                                                                    {{ isset($_GET['observation6'])
                                                                        ? ($_GET['observation6'] == '2'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation6'])
                                                                            ? ($details['observation6'] == '2'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation6') == '2'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Just a Little
                                                                </option>
                                                                <option value="3"
                                                                    {{ isset($_GET['observation6'])
                                                                        ? ($_GET['observation6'] == '3'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation6'])
                                                                            ? ($details['observation6'] == '3'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation6') == '3'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Pretty Much
                                                                </option>
                                                                <option value="4"
                                                                    {{ isset($_GET['observation6'])
                                                                        ? ($_GET['observation6'] == '4'
                                                                            ? 'selected'
                                                                            : '')
                                                                        : (isset($details['observation6'])
                                                                            ? ($details['observation6'] == '4'
                                                                                ? 'selected'
                                                                                : '')
                                                                            : (old('observation6') == '4'
                                                                                ? 'selected'
                                                                                : '')) }}>
                                                                    Very Much
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Is your spelling poor? -->
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group observation">
                                                            <label for="observation7">
                                                                <b>Question:</b> Is your spelling poor?
                                                                <span>(Ask about 2 spellings like " cook," "him," "her,"
                                and see if there are errors.)</span>
                                </label><br>
                                <select class="form-control PsychologicalSelectedAttribute" id="observation7"
                                    name="observation7">
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($_GET['observation7'])
                                            ? ($_GET['observation7'] == '1'
                                                ? 'selected'
                                                : '')
                                            : (isset($details['observation7'])
                                                ? ($details['observation7'] == '1'
                                                    ? 'selected'
                                                    : '')
                                                : (old('observation7') == '1'
                                                    ? 'selected'
                                                    : '')) }}>
                                        Not At All
                                    </option>
                                    <option value="2"
                                        {{ isset($_GET['observation7'])
                                            ? ($_GET['observation7'] == '2'
                                                ? 'selected'
                                                : '')
                                            : (isset($details['observation7'])
                                                ? ($details['observation7'] == '2'
                                                    ? 'selected'
                                                    : '')
                                                : (old('observation7') == '2'
                                                    ? 'selected'
                                                    : '')) }}>
                                        Just a Little
                                    </option>
                                    <option value="3"
                                        {{ isset($_GET['observation7'])
                                            ? ($_GET['observation7'] == '3'
                                                ? 'selected'
                                                : '')
                                            : (isset($details['observation7'])
                                                ? ($details['observation7'] == '3'
                                                    ? 'selected'
                                                    : '')
                                                : (old('observation7') == '3'
                                                    ? 'selected'
                                                    : '')) }}>
                                        Pretty Much
                                    </option>
                                    <option value="4"
                                        {{ isset($_GET['observation7'])
                                            ? ($_GET['observation7'] == '4'
                                                ? 'selected'
                                                : '')
                                            : (isset($details['observation7'])
                                                ? ($details['observation7'] == '4'
                                                    ? 'selected'
                                                    : '')
                                                : (old('observation7') == '4'
                                                    ? 'selected'
                                                    : '')) }}>
                                        Very Much
                                    </option>
                                </select>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <!-- Question: When writing down the date, do you often make mistakes? -->
                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="observation8">
                                <b>Question:</b> When writing down the date, do you often make mistakes?
                                <span>(Ask about the date and see if the child is making a mistake)</span>
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation8"
                                name="observation8">
                                <option value="">Select</option>
                                <option value="1"
                                    {{ isset($_GET['observation8'])
                                        ? ($_GET['observation8'] == '1'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['observation8'])
                                            ? ($details['observation8'] == '1'
                                                ? 'selected'
                                                : '')
                                            : (old('observation8') == '1'
                                                ? 'selected'
                                                : '')) }}>
                                    Not At All
                                </option>
                                <option value="2"
                                    {{ isset($_GET['observation8'])
                                        ? ($_GET['observation8'] == '2'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['observation8'])
                                            ? ($details['observation8'] == '2'
                                                ? 'selected'
                                                : '')
                                            : (old('observation8') == '2'
                                                ? 'selected'
                                                : '')) }}>
                                    Just a Little
                                </option>
                                <option value="3"
                                    {{ isset($_GET['observation8'])
                                        ? ($_GET['observation8'] == '3'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['observation8'])
                                            ? ($details['observation8'] == '3'
                                                ? 'selected'
                                                : '')
                                            : (old('observation8') == '3'
                                                ? 'selected'
                                                : '')) }}>
                                    Pretty Much
                                </option>
                                <option value="4"
                                    {{ isset($_GET['observation8'])
                                        ? ($_GET['observation8'] == '4'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['observation8'])
                                            ? ($details['observation8'] == '4'
                                                ? 'selected'
                                                : '')
                                            : (old('observation8') == '4'
                                                ? 'selected'
                                                : '')) }}>
                                    Very Much
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question: Do you find difficulty in telling left from right? -->
                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="observation9">
                                <b>Question:</b> Do you find difficulty in telling left from right?
                                <span>(Generally ask about left and right to see the difficulty the child is having)</span>
                            </label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation9"
                                name="observation9">
                                <option value="">Select</option>
                                <option value="1"
                                    {{ isset($_GET['observation9'])
                                        ? ($_GET['observation9'] == '1'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['observation9'])
                                            ? ($details['observation9'] == '1'
                                                ? 'selected'
                                                : '')
                                            : (old('observation9') == '1'
                                                ? 'selected'
                                                : '')) }}>
                                    Not At All
                                </option>
                                <option value="2"
                                    {{ isset($_GET['observation9'])
                                        ? ($_GET['observation9'] == '2'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['observation9'])
                                            ? ($details['observation9'] == '2'
                                                ? 'selected'
                                                : '')
                                            : (old('observation9') == '2'
                                                ? 'selected'
                                                : '')) }}>
                                    Just a Little
                                </option>
                                <option value="3"
                                    {{ isset($_GET['observation9'])
                                        ? ($_GET['observation9'] == '3'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['observation9'])
                                            ? ($details['observation9'] == '3'
                                                ? 'selected'
                                                : '')
                                            : (old('observation9') == '3'
                                                ? 'selected'
                                                : '')) }}>
                                    Pretty Much
                                </option>
                                <option value="4"
                                    {{ isset($_GET['observation9'])
                                        ? ($_GET['observation9'] == '4'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['observation9'])
                                            ? ($details['observation9'] == '4'
                                                ? 'selected'
                                                : '')
                                            : (old('observation9') == '4'
                                                ? 'selected'
                                                : '')) }}>
                                    Very Much
                                </option>
                            </select>
                        </div>
                    </div>
                </div>





                <div class="form-group col-md-6">
                    <div class="form-group observation">
                        <label for="observation10">
                            <b>Question:</b> Do you mix up bus numbers like 35 and 53?
                            <span>(Ask any 2 numbers like 35 and 53 and see if the child is making a mistake or not)</span>
                        </label><br>
                        <select class="form-control PsychologicalSelectedAttribute" id="observation10"
                            name="observation10">
                            <option value="">Select</option>
                            <option value="1"
                                {{ isset($_GET['observation10'])
                                    ? ($_GET['observation10'] == '1'
                                        ? 'selected'
                                        : '')
                                    : (isset($details['observation10'])
                                        ? ($details['observation10'] == '1'
                                            ? 'selected'
                                            : '')
                                        : (old('observation10') == '1'
                                            ? 'selected'
                                            : '')) }}>
                                Not At All
                            </option>
                            <option value="2"
                                {{ isset($_GET['observation10'])
                                    ? ($_GET['observation10'] == '2'
                                        ? 'selected'
                                        : '')
                                    : (isset($details['observation10'])
                                        ? ($details['observation10'] == '2'
                                            ? 'selected'
                                            : '')
                                        : (old('observation10') == '2'
                                            ? 'selected'
                                            : '')) }}>
                                Just a Little
                            </option>
                            <option value="3"
                                {{ isset($_GET['observation10'])
                                    ? ($_GET['observation10'] == '3'
                                        ? 'selected'
                                        : '')
                                    : (isset($details['observation10'])
                                        ? ($details['observation10'] == '3'
                                            ? 'selected'
                                            : '')
                                        : (old('observation10') == '3'
                                            ? 'selected'
                                            : '')) }}>
                                Pretty Much
                            </option>
                            <option value="4"
                                {{ isset($_GET['observation10'])
                                    ? ($_GET['observation10'] == '4'
                                        ? 'selected'
                                        : '')
                                    : (isset($details['observation10'])
                                        ? ($details['observation10'] == '4'
                                            ? 'selected'
                                            : '')
                                        : (old('observation10') == '4'
                                            ? 'selected'
                                            : '')) }}>
                                Very Much
                            </option>
                        </select>
                    </div>
                </div>


                <div class="form-group col-md-12">
                    <div class="form-group">
                        <label for="comment">Comment/Findings</label><br>
                        <textarea name="psychological_comment" placeholder="Comment here" cols="50" rows="5" required>
                            {{ isset($_GET['psychological_comment']) ? $_GET['psychological_comment'] : (isset($details['psychological_comment']) ? $details['psychological_comment'] : old('psychological_comment')) }}
                        </textarea>
                    </div>
                </div>



                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>



            <!-- Step Seventeen - Nutritionist -->

            <div class="step last-step mb-5" id="step17">
                <h3>Nutritionist</h3>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_60_How_would_you_describe_your_lifestyle">Question No.60: How would
                                you describe your lifestyle?</label><br>
                            <select class="form-control" id="Question_No_60_How_would_you_describe_your_lifestyle"
                                name="Question_No_60_How_would_you_describe_your_lifestyle" required>
                                <option value="">Select</option>
                                <option value="Sedentary"
                                    {{ isset($_GET['Question_No_60_How_would_you_describe_your_lifestyle'])
                                        ? ($_GET['Question_No_60_How_would_you_describe_your_lifestyle'] == 'Sedentary'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_60_How_would_you_describe_your_lifestyle'])
                                            ? ($details['Question_No_60_How_would_you_describe_your_lifestyle'] == 'Sedentary'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_60_How_would_you_describe_your_lifestyle') == 'Sedentary'
                                                ? 'selected'
                                                : '')) }}>
                                    Sedentary
                                </option>
                                <option value="Moderately"
                                    {{ isset($_GET['Question_No_60_How_would_you_describe_your_lifestyle'])
                                        ? ($_GET['Question_No_60_How_would_you_describe_your_lifestyle'] == 'Moderately'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_60_How_would_you_describe_your_lifestyle'])
                                            ? ($details['Question_No_60_How_would_you_describe_your_lifestyle'] == 'Moderately'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_60_How_would_you_describe_your_lifestyle') == 'Moderately'
                                                ? 'selected'
                                                : '')) }}>
                                    Moderately
                                </option>
                                <option value="Active"
                                    {{ isset($_GET['Question_No_60_How_would_you_describe_your_lifestyle'])
                                        ? ($_GET['Question_No_60_How_would_you_describe_your_lifestyle'] == 'Active'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_60_How_would_you_describe_your_lifestyle'])
                                            ? ($details['Question_No_60_How_would_you_describe_your_lifestyle'] == 'Active'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_60_How_would_you_describe_your_lifestyle') == 'Active'
                                                ? 'selected'
                                                : '')) }}>
                                    Active
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 bmi61">
                        <div class="form-group">
                            <label for="bmi61">Question No.61: BMI</label><br>
                            <input type="text" name="bmi61" class="form-control" id="bmi61"
                                placeholder="BMI" readonly
                                value="{{ isset($_GET['bmi61']) ? $_GET['bmi61'] : (isset($details['bmi61']) ? $details['bmi61'] : old('bmi61')) }}">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6 muac" id="muac-container">
                        <div class="form-group">
                            <label for="muac">Question No.62: MUAC</label><br>
                            <input type="text" name="muac" class="form-control" id="muac"
                                placeholder="MUAC"
                                value="{{ isset($_GET['muac']) ? $_GET['muac'] : (isset($details['muac']) ? $details['muac'] : old('muac')) }}">
                        </div>
                    </div>
                    <div class="form-group col-md-6 Daily_Protien_requirement">
                        <div class="form-group">
                            <label for="Daily_Protien_requirement">Question No.63: Daily Protein Requirement )
                            </label><br>
                            <input type="text" name="Daily_Protien_requirement" class="form-control"
                                id="Daily_Protien_requirement" placeholder="Daily Protein Requirement"
                                value="{{ isset($_GET['Daily_Protien_requirement']) ? $_GET['Daily_Protien_requirement'] : (isset($details['Daily_Protien_requirement']) ? $details['Daily_Protien_requirement'] : old('Daily_Protien_requirement')) }}">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <!-- Daily Energy Requirement -->
                    <div class="form-group col-md-6 Daily_energy_requirement">
                        <div class="form-group">
                            <label for="Daily_energy_requirement">Question No.64: Daily Energy <br>
                                Requirement</label><br>

                            <!-- Input Field -->
                            <input type="text" name="Daily_energy_requirement" class="form-control"
                                id="Daily_energy_requirement" placeholder="Daily Energy requirement"
                                value="{{ isset($_GET['Daily_energy_requirement']) ? $_GET['Daily_energy_requirement'] : (isset($details['Daily_energy_requirement']) ? $details['Daily_energy_requirement'] : old('Daily_energy_requirement')) }}">

                            <!-- Hidden Select for Energy Chart -->
                            <select class="form-control" id="Daily_energy_requirement1" style="display: block;">
                                @php
                                    $energychart = DB::table('energyChart')->get();
                                    if (!$energychart->isEmpty()) {
                                        foreach ($energychart as $value) {
                                            $energychartID = htmlspecialchars($value->id, ENT_QUOTES, 'UTF-8');
                                            $sedentary = htmlspecialchars($value->Sedentarylal, ENT_QUOTES, 'UTF-8');
                                            $Moderate = htmlspecialchars($value->active, ENT_QUOTES, 'UTF-8');
                                            $activela = htmlspecialchars($value->Activela, ENT_QUOTES, 'UTF-8');
                                            $AGE = htmlspecialchars($value->AGE, ENT_QUOTES, 'UTF-8');
                                            $Gander = htmlspecialchars($value->Gander, ENT_QUOTES, 'UTF-8');

                                            echo "<option value='{$energychartID}' id='{$energychartID}' age='{$AGE}' gender='{$Gander}' sedentary='{$sedentary}' Moderate='{$Moderate}' activela='{$activela}'> {$activela} {$Gander} {$AGE}</option>";
                                        }
                                    }
                                @endphp
                            </select>
                        </div>
                    </div>

                    <!-- Water/Liquids Consumption -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day">
                                Question No.65: How many glasses of water/liquids do you consume in a day?
                            </label><br>
                            <select class="form-control"
                                id="Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day"
                                name="Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day" required>
                                <option value="">Select</option>
                                <option value="6-8"
                                    {{ isset($_GET['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'])
                                        ? ($_GET['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] == '6-8'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'])
                                            ? ($details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] == '6-8'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day') == '6-8'
                                                ? 'selected'
                                                : '')) }}>
                                    6-8
                                </option>
                                <option value="4-6"
                                    {{ isset($_GET['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'])
                                        ? ($_GET['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] == '4-6'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'])
                                            ? ($details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] == '4-6'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day') == '4-6'
                                                ? 'selected'
                                                : '')) }}>
                                    4-6
                                </option>
                                <option value="< 4"
                                    {{ isset($_GET['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'])
                                        ? ($_GET['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] == '< 4'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'])
                                            ? ($details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] == '< 4'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day') == '< 4'
                                                ? 'selected'
                                                : '')) }}>
                                    &lt; 4
                                </option>
                            </select>
                        </div>
                    </div>
                </div>





                <div class="form-row">


                    <!-- Question 66: Substance Abuse History -->
                    {{-- <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No66_Substance_Abuse">Question No.66: Does the child have any history of
                                substance abuse or addiction?</label><br>
                            <select class="form-control" id="Question_No66_Substance_Abuse"
                                name="Question_No66_Substance_Abuse" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ isset($_GET['Question_No66_Substance_Abuse'])
                                        ? ($_GET['Question_No66_Substance_Abuse'] == 'Yes'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No66_Substance_Abuse'])
                                            ? ($details['Question_No66_Substance_Abuse'] == 'Yes'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No66_Substance_Abuse') == 'Yes'
                                                ? 'selected'
                                                : '')) }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ isset($_GET['Question_No66_Substance_Abuse'])
                                        ? ($_GET['Question_No66_Substance_Abuse'] == 'No'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No66_Substance_Abuse'])
                                            ? ($details['Question_No66_Substance_Abuse'] == 'No'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No66_Substance_Abuse') == 'No'
                                                ? 'selected'
                                                : '')) }}>
                                    No
                                </option>
                            </select>
                        </div>
                    </div> --}}


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label
                                for="Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to">
                                Question No.66: Does the child have any history of substances abuse or addiction to
                            </label><br>
                            <select class="form-control"
                                id="Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to"
                                name="Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to"
                                required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ isset($_GET['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'])
                                        ? ($_GET['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] == 'Yes'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'])
                                            ? ($details['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] == 'Yes'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to') == 'Yes'
                                                ? 'selected'
                                                : '')) }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ isset($_GET['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'])
                                        ? ($_GET['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] == 'No'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'])
                                            ? ($details['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] == 'No'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to') == 'No'
                                                ? 'selected'
                                                : '')) }}>
                                    No
                                </option>
                            </select>
                        </div>
                    </div>




                    <!-- Specify Addiction -->
                    <div class="form-group col-md-6 d-none" id="addictionContainer">
                        <div class="form-group">
                            <label for="addiction">Please Specify</label><br>
                            <select class="form-control mt-4" id="addiction" name="addiction">
                                <option value="">Select</option>
                                @foreach (['Smoking', 'Alcohol', 'Pan / Gutka / Chalia consumption', 'Substance / Drugs abuse', 'Other'] as $option)
                                    <option value="{{ $option }}"
                                        {{ isset($_GET['addiction'])
                                            ? ($_GET['addiction'] == $option
                                                ? 'selected'
                                                : '')
                                            : (isset($details['addiction'])
                                                ? ($details['addiction'] == $option
                                                    ? 'selected'
                                                    : '')
                                                : (old('addiction') == $option
                                                    ? 'selected'
                                                    : '')) }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Other Addiction Description -->
                    <div class="form-group col-md-6 d-none" id="otherAddictionContainer">
                        <div class="form-group">
                            <label for="other_addiction">Please Describe</label><br>
                            <textarea class="form-control" name="other_addiction" id="other_addiction" rows="3">
            {{ isset($_GET['other_addiction'])
                ? $_GET['other_addiction']
                : (isset($details['other_addiction'])
                    ? $details['other_addiction']
                    : old('other_addiction')) }}
        </textarea>
                        </div>
                    </div>



                    <!-- Question 67: Food Allergies -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="food_allergies">Question No.67: Does the child suffer from any food intolerances
                                or allergies?</label><br>
                            <select class="form-control" id="food_allergies" name="food_allergies" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ isset($_GET['food_allergies'])
                                        ? ($_GET['food_allergies'] == 'Yes'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['food_allergies'])
                                            ? ($details['food_allergies'] == 'Yes'
                                                ? 'selected'
                                                : '')
                                            : (old('food_allergies') == 'Yes'
                                                ? 'selected'
                                                : '')) }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ isset($_GET['food_allergies'])
                                        ? ($_GET['food_allergies'] == 'No'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['food_allergies'])
                                            ? ($details['food_allergies'] == 'No'
                                                ? 'selected'
                                                : '')
                                            : (old('food_allergies') == 'No'
                                                ? 'selected'
                                                : '')) }}>
                                    No
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Specify Food Allergies -->
                    <div class="form-group col-md-6 d-none" id="food_allergiesContainer">
                        <div class="form-group">
                            <label for="other_food_allergies">Specify the foods</label><br>
                            <select name="other_food_allergies" id="other_food_allergies" class="form-control">
                                <option value="">Select</option>
                                @foreach (['Milk', 'Eggs', 'Peanuts', 'Tree nuts (e.g., almonds, walnuts, cashews)', 'Fish', 'Soy', 'Wheat', 'Others'] as $food)
                                    <option value="{{ $food }}"
                                        {{ isset($_GET['other_food_allergies'])
                                            ? ($_GET['other_food_allergies'] == $food
                                                ? 'selected'
                                                : '')
                                            : (isset($details['other_food_allergies'])
                                                ? ($details['other_food_allergies'] == $food
                                                    ? 'selected'
                                                    : '')
                                                : (old('other_food_allergies') == $food
                                                    ? 'selected'
                                                    : '')) }}>
                                        {{ $food }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <!-- Question 69: Meals Per Day -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="meals">Question No.69: How many meals (breakfast, lunch, dinner) do you consume
                                in a day?</label><br>
                            <select class="form-control" id="meals" name="meals" required>
                                <option value="">Select</option>
                                <option value="1"
                                    {{ isset($_GET['meals'])
                                        ? ($_GET['meals'] == '1'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['meals'])
                                            ? ($details['meals'] == '1'
                                                ? 'selected'
                                                : '')
                                            : (old('meals') == '1'
                                                ? 'selected'
                                                : '')) }}>
                                    1
                                </option>
                                <option value="2-3"
                                    {{ isset($_GET['meals'])
                                        ? ($_GET['meals'] == '2-3'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['meals'])
                                            ? ($details['meals'] == '2-3'
                                                ? 'selected'
                                                : '')
                                            : (old('meals') == '2-3'
                                                ? 'selected'
                                                : '')) }}>
                                    2-3
                                </option>
                                <option value=">3"
                                    {{ isset($_GET['meals'])
                                        ? ($_GET['meals'] == '>3'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['meals'])
                                            ? ($details['meals'] == '>3'
                                                ? 'selected'
                                                : '')
                                            : (old('meals') == '>3'
                                                ? 'selected'
                                                : '')) }}>
                                    >3
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 70: Packed Food Consumption -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="food_items">Question No.70: How many packed items (chips, biscuits, sodas) do you
                                consume daily?</label><br>
                            <select class="form-control" id="food_items" name="food_items" required>
                                <option value="">Select</option>
                                <option value="0-1"
                                    {{ isset($_GET['food_items'])
                                        ? ($_GET['food_items'] == '0-1'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['food_items'])
                                            ? ($details['food_items'] == '0-1'
                                                ? 'selected'
                                                : '')
                                            : (old('food_items') == '0-1'
                                                ? 'selected'
                                                : '')) }}>
                                    0-1
                                </option>
                                <option value="1-2"
                                    {{ isset($_GET['food_items'])
                                        ? ($_GET['food_items'] == '1-2'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['food_items'])
                                            ? ($details['food_items'] == '1-2'
                                                ? 'selected'
                                                : '')
                                            : (old('food_items') == '1-2'
                                                ? 'selected'
                                                : '')) }}>
                                    1-2
                                </option>
                                <option value="3 or more"
                                    {{ isset($_GET['food_items'])
                                        ? ($_GET['food_items'] == '3 or more'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['food_items'])
                                            ? ($details['food_items'] == '3 or more'
                                                ? 'selected'
                                                : '')
                                            : (old('food_items') == '3 or more'
                                                ? 'selected'
                                                : '')) }}>
                                    3 or more
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Question 71: Fast Food Consumption -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="fast_food">Question No.71: How frequently do you consume fast food (dine-out) in a
                                week?</label><br>
                            <select class="form-control" id="fast_food" name="fast_food" required>
                                <option value="">Select</option>
                                <option value="< 1"
                                    {{ isset($_GET['fast_food'])
                                        ? ($_GET['fast_food'] == '< 1'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['fast_food'])
                                            ? ($details['fast_food'] == '< 1'
                                                ? 'selected'
                                                : '')
                                            : (old('fast_food') == '< 1'
                                                ? 'selected'
                                                : '')) }}>
                                    < 1 </option>
                                <option value="1-2"
                                    {{ isset($_GET['fast_food'])
                                        ? ($_GET['fast_food'] == '1-2'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['fast_food'])
                                            ? ($details['fast_food'] == '1-2'
                                                ? 'selected'
                                                : '')
                                            : (old('fast_food') == '1-2'
                                                ? 'selected'
                                                : '')) }}>
                                    1-2
                                </option>
                                <option value="3 or more"
                                    {{ isset($_GET['fast_food'])
                                        ? ($_GET['fast_food'] == '3 or more'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['fast_food'])
                                            ? ($details['fast_food'] == '3 or more'
                                                ? 'selected'
                                                : '')
                                            : (old('fast_food') == '3 or more'
                                                ? 'selected'
                                                : '')) }}>
                                    3 or more
                                </option>
                            </select>
                        </div>
                    </div>




                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Follow_up_Required">Follow-up Required</label>
                            <select id="Follow_up_Required" name="Follow_up_Required" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ isset($_GET['Follow_up_Required'])
                                        ? ($_GET['Follow_up_Required'] == 'Yes'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Follow_up_Required'])
                                            ? ($details['Follow_up_Required'] == 'Yes'
                                                ? 'selected'
                                                : '')
                                            : (old('Follow_up_Required') == 'Yes'
                                                ? 'selected'
                                                : '')) }}>
                                    Yes
                                </option>
                                <option value="No"
                                    {{ isset($_GET['Follow_up_Required'])
                                        ? ($_GET['Follow_up_Required'] == 'No'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Follow_up_Required'])
                                            ? ($details['Follow_up_Required'] == 'No'
                                                ? 'selected'
                                                : '')
                                            : (old('Follow_up_Required') == 'No'
                                                ? 'selected'
                                                : '')) }}>
                                    No
                                </option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-row d-none refer_to_form_row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="refer_to">Refer To</label>
                            <select id="refer_to" name="refer_to" class="form-control" multiple required>
                                <option value="1"
                                    {{ isset($_GET['refer_to']) && in_array('1', $_GET['refer_to'])
                                        ? 'selected'
                                        : (isset($details['refer_to']) && in_array('1', $details['refer_to'])
                                            ? 'selected'
                                            : (old('refer_to') && in_array('1', old('refer_to'))
                                                ? 'selected'
                                                : '')) }}>
                                    Psychologist
                                </option>
                                <option value="2"
                                    {{ isset($_GET['refer_to']) && in_array('2', $_GET['refer_to'])
                                        ? 'selected'
                                        : (isset($details['refer_to']) && in_array('2', $details['refer_to'])
                                            ? 'selected'
                                            : (old('refer_to') && in_array('2', old('refer_to'))
                                                ? 'selected'
                                                : '')) }}>
                                    Nutritionist
                                </option>
                                <option value="4"
                                    {{ isset($_GET['refer_to']) && in_array('4', $_GET['refer_to'])
                                        ? 'selected'
                                        : (isset($details['refer_to']) && in_array('4', $details['refer_to'])
                                            ? 'selected'
                                            : (old('refer_to') && in_array('4', old('refer_to'))
                                                ? 'selected'
                                                : '')) }}>
                                    External Specialists
                                </option>
                                <option value="5"
                                    {{ isset($_GET['refer_to']) && in_array('5', $_GET['refer_to'])
                                        ? 'selected'
                                        : (isset($details['refer_to']) && in_array('5', $details['refer_to'])
                                            ? 'selected'
                                            : (old('refer_to') && in_array('5', old('refer_to'))
                                                ? 'selected'
                                                : '')) }}>
                                    General Physician (school health physician)
                                </option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="form-row d-none" id="follow_up_show">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Reason_for_Follow_up">Reason for Follow-up</label>
                            <input placeholder="Reason for Follow-up" name="Reason_for_Follow_up"
                                id="Reason_for_Follow_up" class="form-control"
                                value="{{ isset($_GET['Reason_for_Follow_up']) ? $_GET['Reason_for_Follow_up'] : (isset($details['Reason_for_Follow_up']) ? $details['Reason_for_Follow_up'] : old('Reason_for_Follow_up')) }}" />
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Follow_up_Date">Follow-up Date</label>
                            <input type="date" placeholder="Follow-up Date" name="Follow_up_Date"
                                id="Follow_up_Date" class="form-control"
                                value="{{ isset($_GET['Follow_up_Date']) ? $_GET['Follow_up_Date'] : (isset($details['Follow_up_Date']) ? $details['Follow_up_Date'] : old('Follow_up_Date')) }}" />
                        </div>
                    </div>
                </div>


                <div class="form-row align-items-center my-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="read_oly_age">Age (Year:Month)</label>
                            
                            {{-- <input type="text" name="read_oly_age" id="read_oly_age" class="form-control"
                                readonly
                                value="{{ isset($_GET['read_oly_age']) ? $_GET['read_oly_age'] : (isset($details['read_oly_age']) ? $details['read_oly_age'] : old('read_oly_age')) }}"> --}}

                                <input type="text" class="form-control" id="read_oly_age" name="read_oly_age" readonly required
                                value="{{ isset($_GET['age']) ? $_GET['age'] : (old('age') ?: (isset($details['age']) ? $details['age'] : '')) }}">



                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="read_oly_gender">Gender</label>
                            <input type="text" name="read_oly_gender" id="read_oly_gender" class="form-control"
                                readonly
                                value="{{ isset($_GET['read_oly_gender']) ? $_GET['read_oly_gender'] : (isset($details['read_oly_gender']) ? $details['read_oly_gender'] : old('read_oly_gender')) }}">
                        </div>
                    </div>
                </div>
                <div class="form-row align-items-center my-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="read_oly_weight">Weight</label>
                            <input type="text" name="read_oly_weight" id="read_oly_weight" class="form-control"
                                readonly
                                value="{{ isset($_GET['read_oly_weight']) ? $_GET['read_oly_weight'] : (isset($details['read_oly_weight']) ? $details['read_oly_weight'] : old('read_oly_weight')) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="read_oly_height">Height</label>
                            <input type="text" name="read_oly_height" id="read_oly_height" class="form-control"
                                readonly
                                value="{{ isset($_GET['read_oly_height']) ? $_GET['read_oly_height'] : (isset($details['read_oly_height']) ? $details['read_oly_height'] : old('read_oly_height')) }}">
                        </div>
                    </div>
                </div>



                {{-- ---------------------- For Wasting criteria  -------------------------- --}}


                <div class="form-row align-items-center my-4 d-none" id="birth_5_wasting_girls">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wasting_birth_to_5_girl">For Wasting criteria from Birth to 5 years Girls</label>
                            <p>Severe Wasting (WHZ < -3): </p>
                                    <p>Moderate Wasting (WHZ between -3 and -2): </p>
                                    <p>Normal (WHZ between -2 and +2): </p>
                                    <p>Overweight (WHZ > +2): </p>
                                    <select name="wasting_birth_to_5_girl" id="wasting_birth_to_5_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectWasting">
                                        <option value="">Select</option>
                                        <option value="Severe Wasting (WHZ < -3)"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Severe Wasting (WHZ < -3)' ? 'selected' : '' }}>
                                            Severe Wasting (WHZ < -3)</option>
                                        <option value="Moderate Wasting (WHZ between -3 and -2)"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Moderate Wasting (WHZ between -3 and -2)' ? 'selected' : '' }}>
                                            Moderate Wasting (WHZ between -3 and -2)</option>
                                        <option value="Normal (WHZ between -2 and +2)"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Normal (WHZ between -2 and +2)' ? 'selected' : '' }}>
                                            Normal (WHZ between -2 and +2)</option>
                                        <option value="Overweight (WHZ > +2)"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Overweight (WHZ > +2)' ? 'selected' : '' }}>
                                            Overweight (WHZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/born-5-whz-girls.png') }}"
                            class="img-fluid">
                    </div> -->
                </div>

                <div class="form-row align-items-center my-4 d-none" id="birth_5_wasting_boys">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wasting_birth_to_5_boy">For Wasting criteria from Birth to 5 years Boys</label>
                            <p>Severe Wasting (WHZ < -3): </p>
                                    <p>Moderate Wasting (WHZ between -3 and -2): </p>
                                    <p>Normal (WHZ between -2 and +2): </p>
                                    <p>Overweight (WHZ > +2): </p>
                                    <select name="wasting_birth_to_5_boy" id="wasting_birth_to_5_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectWasting">
                                        <option value="">Select</option>
                                        <option value="Severe Wasting (WHZ < -3)"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Severe Wasting (WHZ < -3)' ? 'selected' : '' }}>
                                            Severe Wasting (WHZ < -3)</option>
                                        <option value="Moderate Wasting (WHZ between -3 and -2)"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Moderate Wasting (WHZ between -3 and -2)' ? 'selected' : '' }}>
                                            Moderate Wasting (WHZ between -3 and -2)</option>
                                        <option value="Normal (WHZ between -2 and +2)"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Normal (WHZ between -2 and +2)' ? 'selected' : '' }}>
                                            Normal (WHZ between -2 and +2)</option>
                                        <option value="Overweight (WHZ > +2)"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Overweight (WHZ > +2)' ? 'selected' : '' }}>
                                            Overweight (WHZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/born-5-whz-boys.png') }}" class="img-fluid">
                    </div> -->
                </div>

                <div class="form-row align-items-center my-4 d-none" id="5_19_wasting_girls">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wasting_5_to_19_girl">For children and adolescents(Girls) Wasting (Criteria
                                5-19)</label>
                            <!-- <p>Severe Thinness: BMI-for-age Z-score < -3</p>
                                    <p>Moderate Thinness: BMI-for-age Z-score between -3 and -2</p>
                                    <p>Normal Weight: BMI-for-age Z-score between -2 and +1</p>
                                    <p>Overweight: BMI-for-age Z-score > +1</p>
                                    <p>Obesity: BMI-for-age Z-score > +2</p> -->
                                    <select name="wasting_5_to_19_girl" id="wasting_5_to_19_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectWasting">
                                        <option value="">Select</option>
                                        <option value="Severe Thinness"
                                            {{ isset($details['wasting_5_to_19_girl']) && $details['wasting_5_to_19_girl'] == 'Severe Thinness' ? 'selected' : '' }}>
                                            Severe Thinness</option>
                                        <option value="Moderate Thinness"
                                            {{ isset($details['wasting_5_to_19_girl']) && $details['wasting_5_to_19_girl'] == 'Moderate Thinness' ? 'selected' : '' }}>
                                            Moderate Thinness</option>
                                        <option value="Mild Thinness"
                                            {{ isset($details['wasting_5_to_19_girl']) && $details['wasting_5_to_19_girl'] == 'Mild Thinness' ? 'selected' : '' }}>
                                            Mild Thinness</option>
                                        <option value="Normal Weight"
                                            {{ isset($details['wasting_5_to_19_girl']) && $details['wasting_5_to_19_girl'] == 'Normal Weight' ? 'selected' : '' }}>
                                            Normal Weight</option>
                                            <option value="Mild Overweight"
                                            {{ isset($details['wasting_5_to_19_girl']) && $details['wasting_5_to_19_girl'] == 'Mild Overweight' ? 'selected' : '' }}>
                                            Mild Overweight</option>
                                        <option value="Overweight"
                                            {{ isset($details['wasting_5_to_19_girl']) && $details['wasting_5_to_19_girl'] == 'Overweight' ? 'selected' : '' }}>
                                            Overweight</option>
                                        <option value="Obesity"
                                            {{ isset($details['wasting_5_to_19_girl']) && $details['wasting_5_to_19_girl'] == 'Obesity' ? 'selected' : '' }}>
                                            Obesity</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/5-19_bmi_girls.png') }}" class="img-fluid">
                    </div> -->
                </div>

                <div class="form-row align-items-center my-4 d-none" id="5_19_wasting_boys">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wasting_5_to_19_boy">For children and adolescents(Boys) Wasting (Criteria
                                5-19)</label>
                            <!-- <p>Severe Thinness: BMI-for-age Z-score < -3</p>
                                    <p>Moderate Thinness: BMI-for-age Z-score between -3 and -2</p>
                                    <p>Normal Weight: BMI-for-age Z-score between -2 and +1</p>
                                    <p>Overweight: BMI-for-age Z-score > +1</p>
                                    <p>Obesity: BMI-for-age Z-score > +2</p> -->
                                    <select name="wasting_5_to_19_boy" id="wasting_5_to_19_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectWasting">
                                        <option value="">Select</option>
                                        <option value="Severe Thinness"
                                            {{ isset($details['wasting_5_to_19_boy']) && $details['wasting_5_to_19_boy'] == 'Severe Thinness' ? 'selected' : '' }}>
                                            Severe Thinness</option>
                                        <option value="Moderate Thinness"
                                            {{ isset($details['wasting_5_to_19_boy']) && $details['wasting_5_to_19_boy'] == 'Moderate Thinness' ? 'selected' : '' }}>
                                            Moderate Thinness</option>
                                            <option value="Mild Thinness"
                                            {{ isset($details['wasting_5_to_19_boy']) && $details['wasting_5_to_19_boy'] == 'Mild Thinness' ? 'selected' : '' }}>
                                            Mild Thinness</option>
                                        <option value="Normal Weight"
                                            {{ isset($details['wasting_5_to_19_boy']) && $details['wasting_5_to_19_boy'] == 'Normal Weight' ? 'selected' : '' }}>
                                            Normal Weight</option>
                                        <option value="Mild Overweight"
                                            {{ isset($details['wasting_5_to_19_boy']) && $details['wasting_5_to_19_boy'] == 'Mild Overweight' ? 'selected' : '' }}>
                                            Mild Overweight</option>
                                        <option value="Overweight"
                                            {{ isset($details['wasting_5_to_19_boy']) && $details['wasting_5_to_19_boy'] == 'Overweight' ? 'selected' : '' }}>
                                            Overweight</option>
                                        <option value="Obesity"
                                            {{ isset($details['wasting_5_to_19_boy']) && $details['wasting_5_to_19_boy'] == 'Obesity' ? 'selected' : '' }}>
                                            Obesity</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/5-19_bmi_boys.png') }}" class="img-fluid">
                    </div> -->
                </div>



                {{-- -------------------------------- STUNTING CRITERIA ------------------------------------ --}}

                <div class="form-row align-items-center my-4 d-none" id="birth_2_stunting_girls">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_birth_to_2_girl">STUNTING CRITERIA: FOR BIRTH TO 2 YEARS Girls</label>
                            <!-- <p>Severe Stunting (LAZ < -3): </p>
                                    <p>Stunting (LAZ between -3 and -2): </p>
                                    <p>Normal (LAZ between -2 and +2): </p>
                                    <p>Tall (LAZ > +2): </p> -->
                                    <select name="stunting_birth_to_2_girl" id="stunting_birth_to_2_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting (LAZ < -3)"
                                            {{ isset($details['stunting_birth_to_2_girl']) && $details['stunting_birth_to_2_girl'] == 'Severe Stunting (LAZ < -3)' ? 'selected' : '' }}>
                                            Severe Stunting (LAZ < -3)</option>
                                        <option value="Stunting (LAZ between -3 and -2)"
                                            {{ isset($details['stunting_birth_to_2_girl']) && $details['stunting_birth_to_2_girl'] == 'Stunting (LAZ between -3 and -2)' ? 'selected' : '' }}>
                                            Stunting (LAZ between -3 and -2)</option>
                                        <option value="Normal (LAZ between -2 and +2)"
                                            {{ isset($details['stunting_birth_to_2_girl']) && $details['stunting_birth_to_2_girl'] == 'Normal (LAZ between -2 and +2)' ? 'selected' : '' }}>
                                            Normal (LAZ between -2 and +2)</option>
                                        <option value="Tall (LAZ > +2)"
                                            {{ isset($details['stunting_birth_to_2_girl']) && $details['stunting_birth_to_2_girl'] == 'Tall (LAZ > +2)' ? 'selected' : '' }}>
                                            Tall (LAZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/birth-2_stun_girls.png') }}">
                    </div> -->
                </div>

                <div class="form-row align-items-center my-4 d-none" id="birth_2_stunting_boys">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_birth_to_2_boy">STUNTING CRITERIA: FOR BIRTH TO 2 YEARS Boys</label>
                            <!-- <p>Severe Stunting (LAZ < -3): </p>
                                    <p>Stunting (LAZ between -3 and -2): </p>
                                    <p>Normal (LAZ between -2 and +2): </p>
                                    <p>Tall (LAZ > +2): </p> -->
                                    <select name="stunting_birth_to_2_boy" id="stunting_birth_to_2_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting (LAZ < -3)"
                                            {{ isset($details['stunting_birth_to_2_boy']) && $details['stunting_birth_to_2_boy'] == 'Severe Stunting (LAZ < -3)' ? 'selected' : '' }}>
                                            Severe Stunting (LAZ < -3)</option>
                                        <option value="Stunting (LAZ between -3 and -2)"
                                            {{ isset($details['stunting_birth_to_2_boy']) && $details['stunting_birth_to_2_boy'] == 'Stunting (LAZ between -3 and -2)' ? 'selected' : '' }}>
                                            Stunting (LAZ between -3 and -2)</option>
                                        <option value="Normal (LAZ between -2 and +2)"
                                            {{ isset($details['stunting_birth_to_2_boy']) && $details['stunting_birth_to_2_boy'] == 'Normal (LAZ between -2 and +2)' ? 'selected' : '' }}>
                                            Normal (LAZ between -2 and +2)</option>
                                        <option value="Tall (LAZ > +2)"
                                            {{ isset($details['stunting_birth_to_2_boy']) && $details['stunting_birth_to_2_boy'] == 'Tall (LAZ > +2)' ? 'selected' : '' }}>
                                            Tall (LAZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/birth-2_stun_boys.png') }}">
                    </div> -->
                </div>

                <div class="form-row align-items-center my-4 d-none" id="2_5_stunting_girls">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_2_5_girl">STUNTING CRITERIA: FOR 2 TO 5 YEARS Girls</label>
                            <!-- <p>Severe Stunting (LAZ/HAZ < -3): </p>
                                    <p>Stunting (LAZ/HAZ between -3 and -2): </p>
                                    <p>Normal (LAZ/HAZ between -2 and +2): </p>
                                    <p>Tall (LAZ/HAZ > +2): </p> -->
                                    <select name="stunting_2_5_girl" id="stunting_2_5_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting (LAZ/HAZ < -3)"
                                            {{ isset($details['stunting_2_5_girl']) && $details['stunting_2_5_girl'] == 'Severe Stunting (LAZ/HAZ < -3)' ? 'selected' : '' }}>
                                            Severe Stunting (LAZ/HAZ < -3)</option>
                                        <option value="Stunting (LAZ/HAZ between -3 and -2)"
                                            {{ isset($details['stunting_2_5_girl']) && $details['stunting_2_5_girl'] == 'Stunting (LAZ/HAZ between -3 and -2)' ? 'selected' : '' }}>
                                            Stunting (LAZ/HAZ between -3 and -2)</option>
                                        <option value="Normal (LAZ/HAZ between -2 and +2)"
                                            {{ isset($details['stunting_2_5_girl']) && $details['stunting_2_5_girl'] == 'Normal (LAZ/HAZ between -2 and +2)' ? 'selected' : '' }}>
                                            Normal (LAZ/HAZ between -2 and +2)</option>
                                        <option value="Tall (LAZ/HAZ > +2)"
                                            {{ isset($details['stunting_2_5_girl']) && $details['stunting_2_5_girl'] == 'Tall (LAZ/HAZ > +2)' ? 'selected' : '' }}>
                                            Tall (LAZ/HAZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/2-5_stun_boys.png') }}">
                    </div> -->
                </div>

                <div class="form-row align-items-center my-4 d-none" id="2_5_stunting_boys">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_2_5_boy">STUNTING CRITERIA: FOR 2 TO 5 YEARS Boys</label>
                            <!-- <p>Severe Stunting (LAZ/HAZ < -3): </p>
                                    <p>Stunting (LAZ/HAZ between -3 and -2): </p>
                                    <p>Normal (LAZ/HAZ between -2 and +2): </p>
                                    <p>Tall (LAZ/HAZ > +2): </p> -->
                                    <select name="stunting_2_5_boy" id="stunting_2_5_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting (LAZ/HAZ < -3)"
                                            {{ isset($details['stunting_2_5_boy']) && $details['stunting_2_5_boy'] == 'Severe Stunting (LAZ/HAZ < -3)' ? 'selected' : '' }}>
                                            Severe Stunting (LAZ/HAZ < -3)</option>
                                        <option value="Stunting (LAZ/HAZ between -3 and -2)"
                                            {{ isset($details['stunting_2_5_boy']) && $details['stunting_2_5_boy'] == 'Stunting (LAZ/HAZ between -3 and -2)' ? 'selected' : '' }}>
                                            Stunting (LAZ/HAZ between -3 and -2)</option>
                                        <option value="Normal (LAZ/HAZ between -2 and +2)"
                                            {{ isset($details['stunting_2_5_boy']) && $details['stunting_2_5_boy'] == 'Normal (LAZ/HAZ between -2 and +2)' ? 'selected' : '' }}>
                                            Normal (LAZ/HAZ between -2 and +2)</option>
                                        <option value="Tall (LAZ/HAZ > +2)"
                                            {{ isset($details['stunting_2_5_boy']) && $details['stunting_2_5_boy'] == 'Tall (LAZ/HAZ > +2)' ? 'selected' : '' }}>
                                            Tall (LAZ/HAZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/2-5_stun_girls.png') }}">
                    </div> -->
                </div>

                <div class="form-row align-items-center my-4 d-none" id="5_19_stunting_girls">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_5_19_girl">STUNTING CRITERIA: FOR 5 TO 19 YEARS Girls</label>
                            <!-- <p> Severe Stunting: Height-for-age Z-score (HAZ) < -3 </p>
                                    <p> Stunting: Height-for-age Z-score (HAZ) between -3 and -2 </p>
                                    <p>Normal: Height-for-age Z-score (HAZ) between -2 and +2 </p>
                                    <p>Tall: Height-for-age Z-score (HAZ) > +2 </p> -->
                                    <select name="stunting_5_19_girl" id="stunting_5_19_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting"
                                            {{ isset($details['stunting_5_19_girl']) && $details['stunting_5_19_girl'] == 'Severe Stunting' ? 'selected' : '' }}>
                                            Severe Stunting</option>
                                        <option value="Stunting"
                                            {{ isset($details['stunting_5_19_girl']) && $details['stunting_5_19_girl'] == 'Stunting' ? 'selected' : '' }}>
                                            Stunting</option>
                                        <option value="Normal"
                                            {{ isset($details['stunting_5_19_girl']) && $details['stunting_5_19_girl'] == 'Normal' ? 'selected' : '' }}>
                                            Normal</option>
                                        <option value="Tall"
                                            {{ isset($details['stunting_5_19_girl']) && $details['stunting_5_19_girl'] == 'Tall' ? 'selected' : '' }}>
                                            Tall</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/5-19_stun_girls.png') }}">
                    </div> -->
                </div>

                <div class="form-row align-items-center my-4 d-none" id="5_19_stunting_boys">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_5_19_boy">STUNTING CRITERIA: FOR 5 TO 19 YEARS Boys</label>
                            <!-- <p> Severe Stunting: Height-for-age Z-score (HAZ) < -3 </p>
                                    <p> Stunting: Height-for-age Z-score (HAZ) between -3 and -2 </p>
                                    <p>Normal: Height-for-age Z-score (HAZ) between -2 and +2 </p>
                                    <p>Tall: Height-for-age Z-score (HAZ) > +2 </p> -->
                                    <select name="stunting_5_19_boy" id="stunting_5_19_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting"
                                            {{ isset($details['stunting_5_19_boy']) && $details['stunting_5_19_boy'] == 'Severe Stunting' ? 'selected' : '' }}>
                                            Severe Stunting</option>
                                        <option value="Stunting"
                                            {{ isset($details['stunting_5_19_boy']) && $details['stunting_5_19_boy'] == 'Stunting' ? 'selected' : '' }}>
                                            Stunting</option>
                                        <option value="Normal"
                                            {{ isset($details['stunting_5_19_boy']) && $details['stunting_5_19_boy'] == 'Normal' ? 'selected' : '' }}>
                                            Normal</option>
                                        <option value="Tall"
                                            {{ isset($details['stunting_5_19_boy']) && $details['stunting_5_19_boy'] == 'Tall' ? 'selected' : '' }}>
                                            Tall</option>
                                    </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/5-19_stun_boys.png') }}">
                    </div> -->
                </div>


                <div class="form-group col-md-6">
                    <label for="NutritionistComment">Nutrition Comment</label><br>
                    <textarea class="form-control w-100" name="NutritionistComment" id="NutritionistComment" rows="5"
                        required>
                        <?php echo isset($details['NutritionistComment']) ? htmlspecialchars($details['NutritionistComment']) : ''; ?>
                    </textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="DietaryAdviceComment">Dietary Advice Comment</label><br>
                    <textarea class="form-control w-100" name="DietaryAdviceComment" id="DietaryAdviceComment" rows="5"
                        required>
                        <?php echo isset($details['DietaryAdviceComment']) ? htmlspecialchars($details['DietaryAdviceComment']) : ''; ?>
                    </textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="DietaryAdviceComment">Doctor Comment</label><br>
                    <textarea class="form-control w-100" name="doctor_comment" id="doctor_comment" rows="5"
                        required>
                        <?php echo isset($details['doctor_comment']) ? htmlspecialchars($details['doctor_comment']) : ''; ?>
                    </textarea>
                </div>


                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Submit</button>

            </div>


        </form>

    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {




            /***************** Step One - Bio Data ****************/


            /* Class */
            $("#class").on("keyup change", function() {
                var value = parseFloat($(this).val());

                // if (value >= 1 && value <= 5) 
                if (value <= 2)

                {
                    console.log("ONE ", value);
                    // var classValue = $(this).val();  // Get the current value of the input
                    // console.log('classValueif'); 
                    $(".observation").show();
                    $(".Psychological").hide();

                    // Add 'required' attribute to fields in .observation
                    $(".observation").find("input, select,textarea").each(function() {
                        $(this).prop('required', true);
                    });

                    // Remove 'required' attribute from fields in .Psychological
                    $(".Psychological").find("input, select,textarea").each(function() {
                        $(this).prop('required', false).val('');
                    });


                } else {



                    //                 var classValue = $(this).val();  // Get the current value of the input
                    // console.log('classValueelse'); 

                    $(".observation").hide();
                    $(".Psychological").show();

                    // Remove 'required' attribute from fields in .observation
                    $(".observation").find("input, select,textarea").each(function() {
                        $(this).prop('required', false).val('');
                    });

                    // Add 'required' attribute to fields in .Psychological
                    $(".Psychological").find("input, select,textarea").each(function() {
                        $(this).prop('required', true);
                    });
                }

                $("[name='psychological_comment']").val('');

            }).trigger('change');


            /* Date Of Birth */


            var currentDate = new Date().toISOString().split('T')[0];
            $('#dob').attr('max', currentDate);


            $("#dob").on("change", function() {

                var dob = $(this).val();

                if (dob) {
                    var today = new Date();
                    var birthDate = new Date(dob);
                    var years = today.getFullYear() - birthDate.getFullYear();
                    var months = today.getMonth() - birthDate.getMonth();
                    var actualage = today.getFullYear() - birthDate.getFullYear();
                    var monthDiff = today.getMonth() - birthDate.getMonth();
                    var totalMonths = (actualage * 12) + monthDiff;
                    if (today.getDate() < birthDate.getDate()) {
                        months--;
                    }

                    if (months < 0) {
                        years--;
                        months += 12;
                    }

                    $("#age").val(years+ "." + months);
                    console.log(years + " Years " + months + " Months");
                    // var today = new Date();
                    // var birthDate = new Date(dob);
                    
                   
                    var gender = $("#gender").val();

                    

                    if (today.getDate() < birthDate.getDate()) {
                        totalMonths--;
                    }

                    // $("#age").val(age);
                    var read_oly_age = (years + "." + months );
                    console.log("read_oly_age ", read_oly_age);
                    $("#read_oly_age").val(read_oly_age)
                    console.log(totalMonths);
                    // console.log("age ", age);
                    if (totalMonths >= 7 && totalMonths <= 12) {
                        $("#Daily_Protien_requirement").val("1.0").attr('readonly', true);
                    } else if (actualage >= 1 && actualage <= 3) {
                        $("#Daily_Protien_requirement").val("0.87").attr('readonly', true);
                    } else if (actualage >= 4 && actualage <= 8) {
                        $("#Daily_Protien_requirement").val("0.76").attr('readonly', true);
                    } else if (actualage >= 9 && actualage <= 13) {
                        $("#Daily_Protien_requirement").val("0.76").attr('readonly', true);
                    } else if (actualage >= 14 && actualage <= 18 && $("#gender").val() == "male") {
                        $("#Daily_Protien_requirement").val("0.73").attr('readonly', true);
                    } else if (actualage >= 14 && actualage <= 18 && $("#gender").val() == "female") {
                        $("#Daily_Protien_requirement").val("0.71").attr('readonly', true);
                    } else {
                        $("#Daily_Protien_requirement").val("").attr('readonly', false);

                    }

                    // console.log(" Daily_Protien_requirement  ", $("#Daily_Protien_requirement").val());

                } else {

                    $("#age").val("");
                    $("#Daily_Protien_requirement").val("").attr('readonly', false);

                    // console.log(" Daily_Protien_requirement  ", $("#Daily_Protien_requirement").val());

                }



                /* Check if age is less than 5 */
                if (parseFloat(actualage) < 5) {


                    /* Show the field and ensure the required attribute is present */
                    $('#muac').closest('.form-group').show();
                    $('#muac').attr('required', true);
                    $('#muac').val('');
                    $('#muac-container').show();


                } else {

                    /* Hide the field and remove the required attribute */
                    $('#muac').closest('.form-group').hide();
                    $('#muac').removeAttr('required');
                    $('#muac').val('');
                    $('#muac-container').hide();


                }


            }).trigger('change');




            /* Gender */
            $("#gender").on("keyup change", function() {

                $('#birth_5_wasting_girls, #birth_5_wasting_boys, #5_19_wasting_girls, #5_19_wasting_boys, #birth_2_stunting_girls, #birth_2_stunting_boys, #2_5_stunting_girls, #2_5_stunting_boys, #5_19_stunting_girls, #5_19_stunting_boys')
                    .addClass('d-none');
                    
                var gender = $('#gender').val();
                var dob = $('#dob').val();

                console.log("dob ", dob);
                console.log("gender ", gender);

                // Calculate age from dob
                var today = new Date();
                var birthDate = new Date(dob);
                var age = today.getFullYear() - birthDate.getFullYear();
                var monthDiff = today.getMonth() - birthDate.getMonth();

                // Adjust age if the birth month hasn't occurred yet in the current year
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                // Set calculated age to the readonly input
                var read_oly_age = $('#age').val();
                console.log("read_oly_age ", read_oly_age);
                console.log("age ", age);
                $('#read_oly_age').val(read_oly_age);
                $('#read_oly_gender').val(gender);


                /* wasting */

                /* birth_5_wasting_boys - DONE */
                /* birth_5_wasting_girls - DONE */
                /* birth_5_wasting_ - DONE */


                /* 5_19_wasting_ - DONE */
                /* 5_19_wasting_girls - DONE */
                /* 5_19_wasting_boys - DONE */

                /* birth_2_stunting_ */
                /* birth_2_stunting_boys - DONE */
                /* birth_2_stunting_girls - DONE */

                /* 2_5_stunting_
                 /* 2_5_stunting_girls - DONE */
                /*  2_5_stunting_boys - DONE */

                if (gender == 'female' && read_oly_age <= 5) {
                    $('#birth_5_wasting_girls').removeClass('d-none');
                } else if (gender == 'male' && read_oly_age <= 5) {
                    $('#birth_5_wasting_boys').removeClass('d-none');
                } else if (gender == 'female' && read_oly_age > 5 && read_oly_age <= 19) {
                    $('#5_19_wasting_girls').removeClass('d-none');
                    console.log("HERE");
                } else if (gender == 'male' && read_oly_age > 5 && read_oly_age <= 19) {
                    $('#5_19_wasting_boys').removeClass('d-none');

                } else {}

                /* stunting */
                if (gender == 'female' && read_oly_age <= 2) {
                    $('#birth_2_stunting_girls').removeClass('d-none');
                } else if (gender == 'male' && read_oly_age <= 2) {
                    $('#birth_2_stunting_boys').removeClass('d-none');
                } else if (gender == 'female' && read_oly_age > 2 && read_oly_age <= 5) {
                    $('#2_5_stunting_girls').removeClass('d-none');
                } else if (gender == 'male' && read_oly_age > 2 && read_oly_age <= 5) {
                    $('#2_5_stunting_boys').removeClass('d-none');
                } else if (gender == 'female' && read_oly_age > 5 && read_oly_age <= 19) {
                    $('#5_19_stunting_girls').removeClass('d-none');
                } else if (gender == 'male' && read_oly_age > 5 && read_oly_age <= 19) {
                    $('#5_19_stunting_boys').removeClass('d-none');
                }





            }).trigger('change');


            const dataOptionsAttributes1 = {

                /* wasting*/

                wasting_birth_to_5_girl: {

                    "Severe Wasting (WHZ < -3)": {
                        nutritionalDiagnosis: "Severe malnutrition related to inadequate energy intake as evidenced by a weight-for-height z-score (WHZ) less than -3, indicating severe wasting.",
                        dietaryAdvice: "Prioritize high-calorie, nutrient-dense foods and consider supplementation to support weight gain and recovery."
                    },
                    "Moderate Wasting (WHZ between -3 and -2)": {
                        nutritionalDiagnosis: "Moderate malnutrition related to insufficient nutrient intake and/or increased nutritional needs as evidenced by a WHZ between -3 and -2, indicating moderate wasting.",
                        dietaryAdvice: "Incorporate balanced, calorie-rich meals and snacks with protein to improve nutritional status and growth."
                    },
                    "Normal (WHZ between -2 and +2)": {
                        nutritionalDiagnosis: "Adequate nutritional status with balanced intake and growth as evidenced by a WHZ between -2 and +2.",
                        dietaryAdvice: "Maintain a balanced diet that includes a variety of fruits, vegetables, whole grains, and protein sources."
                    },
                    "Overweight (WHZ > +2)": {
                        nutritionalDiagnosis: "Overweight related to excessive energy intake or reduced physical activity as evidenced by a WHZ greater than +2.",
                        dietaryAdvice: "Focus on nutrient-dense foods with controlled portion sizes and increase physical activity to support healthy weight management."
                    }


                },
                wasting_birth_to_5_boy: {

                    "Severe Wasting (WHZ < -3)": {
                        nutritionalDiagnosis: "Severe malnutrition related to inadequate energy intake as evidenced by a weight-for-height z-score (WHZ) less than -3, indicating severe wasting.",
                        dietaryAdvice: "Prioritize high-calorie, nutrient-dense foods and consider supplementation to support weight gain and recovery."
                    },
                    "Moderate Wasting (WHZ between -3 and -2)": {
                        nutritionalDiagnosis: "Moderate malnutrition related to insufficient nutrient intake and/or increased nutritional needs as evidenced by a WHZ between -3 and -2, indicating moderate wasting.",
                        dietaryAdvice: "Incorporate balanced, calorie-rich meals and snacks with protein to improve nutritional status and growth."
                    },
                    "Normal (WHZ between -2 and +2)": {
                        nutritionalDiagnosis: "Adequate nutritional status with balanced intake and growth as evidenced by a WHZ between -2 and +2.",
                        dietaryAdvice: "Maintain a balanced diet that includes a variety of fruits, vegetables, whole grains, and protein sources."
                    },
                    "Overweight (WHZ > +2)": {
                        nutritionalDiagnosis: "Overweight related to excessive energy intake or reduced physical activity as evidenced by a WHZ greater than +2.",
                        dietaryAdvice: "Focus on nutrient-dense foods with controlled portion sizes and increase physical activity to support healthy weight management."
                    }
                },

                wasting_5_to_19_girl: {
                    'Severe Thinness': {
                        nutritionalDiagnosis: "The child is severely underweight, the z score indicates severe wasting which needs to be addressed immediately. It can also indicate any underlying medical condition causing this severe malnutrition. Ensure regular follow-ups with the health care provider",
                        dietaryAdvice: "Increase calorie-dense foods: whole milk, nuts, seeds, cheese, peanut butter. - Include protein-rich foods like eggs, chicken, fish, and lentils. - Fortify meals with healthy fats. Use full fat dairy products - Provide frequent small meals with snacks in between. Consult a pediatric dietitian for a tailored plan",

                    },
                    'Mild Thinness': {
                        nutritionalDiagnosis: "The child is approaching underweight. Regular monitoring and preventive nutritional measures are advised.",
                        dietaryAdvice: "Incorporate balanced meals with complex carbohydrates like whole grains, oats rice and whole grain pasta. - Add moderate amounts of healthy fats and proteins which includes all meats beans and lentils. - Introduce fortified cereals and dairy products. - Encourage healthy snacking between meals, like yogurt or fruit",

                    },
                    'Mild Overweight': {
                        nutritionalDiagnosis: "The child is approaching overweight. Promote healthy eating habits and active play to prevent further weight gain.",
                        dietaryAdvice: "Replace sugary beverages with water or milk.- Limit processed and high-fat snacks; choose fresh fruits and whole foods.- Reduce portion sizes without skipping meals.- Encourage regular physical activity, such as outdoor play or sports.",

                    },
                    'Moderate Thinness': {
                        nutritionalDiagnosis: "The child is underweight and at risk of health issues. The Z score indicates moderate wasting. Nutritional support and monitoring every 6 months are recommended.",
                        dietaryAdvice: "Add nutrient-dense foods like whole grains, dairy, and lean proteins.- Increase intake of fruits and vegetables.- Focus on healthy fats and oils for cooking.- Encourage consistent meal patterns with 3 main meals and 2 snacks.",

                    },
                    'Normal Weight': {
                        nutritionalDiagnosis: "The child has a healthy weight for age and height. Encourage balanced nutrition and regular physical activity to maintain health.",
                        dietaryAdvice: "Maintain a balanced diet with all food groups: carbohydrates, proteins, fats, fruits, and vegetables.- Limit sugary snacks and processed foods.- Encourage regular hydration with water.- Promote at least 60 minutes of daily physical activity.",

                    },
                    'Overweight': {
                        nutritionalDiagnosis: "The child is overweight, increasing the risk of obesity-related health issues. Monitoring of calorie consumption and physical activity is needed  Early intervention with dietary and activity changes is needed.",
                        dietaryAdvice: "- Focus on portion control and regular meal timings.- Prioritize high-fiber foods like whole grains, fruits, and vegetables.- Avoid fried and sugary foods; use baking or steaming methods.- Introduce fun physical activities to reduce sedentary habits.",

                    },
                    'Obesity': {
                        nutritionalDiagnosis: "The child has significant excess weight, posing a high risk of severe health problems. Comprehensive intervention is required, potentially involving healthcare professionals.",
                        dietaryAdvice: "Consult a pediatric dietitian for a tailored plan. - Gradually reduce calorie intake while ensuring nutrient density. - Eliminate sugary drinks and high-fat junk foods.- Increase daily physical activity, aiming for structured sports or fitness routines.- Involve the family in adopting healthier eating and lifestyle habits.",

                    }
                },
                wasting_5_to_19_boy: {
                    'Severe Thinness': {
                        nutritionalDiagnosis: "The child is severely underweight, the z score indicates severe wasting which needs to be addressed immediately. It can also indicate any underlying medical condition causing this severe malnutrition. Ensure regular follow-ups with the health care provider",
                        dietaryAdvice: "Increase calorie-dense foods: whole milk, nuts, seeds, cheese, peanut butter. - Include protein-rich foods like eggs, chicken, fish, and lentils. - Fortify meals with healthy fats. Use full fat dairy products - Provide frequent small meals with snacks in between. Consult a pediatric dietitian for a tailored plan",

                    },
                    'Mild Thinness': {
                        nutritionalDiagnosis: "The child is approaching underweight. Regular monitoring and preventive nutritional measures are advised.",
                        dietaryAdvice: "Incorporate balanced meals with complex carbohydrates like whole grains, oats rice and whole grain pasta. - Add moderate amounts of healthy fats and proteins which includes all meats beans and lentils. - Introduce fortified cereals and dairy products. - Encourage healthy snacking between meals, like yogurt or fruit",

                    },
                    'Mild Overweight': {
                        nutritionalDiagnosis: "The child is approaching overweight. Promote healthy eating habits and active play to prevent further weight gain.",
                        dietaryAdvice: "Replace sugary beverages with water or milk.- Limit processed and high-fat snacks; choose fresh fruits and whole foods.- Reduce portion sizes without skipping meals.- Encourage regular physical activity, such as outdoor play or sports.",

                    },
                    'Moderate Thinness': {
                        nutritionalDiagnosis: "The child is underweight and at risk of health issues. The Z score indicates moderate wasting. Nutritional support and monitoring every 6 months are recommended.",
                        dietaryAdvice: "Add nutrient-dense foods like whole grains, dairy, and lean proteins.- Increase intake of fruits and vegetables.- Focus on healthy fats and oils for cooking.- Encourage consistent meal patterns with 3 main meals and 2 snacks.",

                    },
                    'Normal Weight': {
                        nutritionalDiagnosis: "The child has a healthy weight for age and height. Encourage balanced nutrition and regular physical activity to maintain health.",
                        dietaryAdvice: "Maintain a balanced diet with all food groups: carbohydrates, proteins, fats, fruits, and vegetables.- Limit sugary snacks and processed foods.- Encourage regular hydration with water.- Promote at least 60 minutes of daily physical activity.",

                    },
                    'Overweight': {
                        nutritionalDiagnosis: "The child is overweight, increasing the risk of obesity-related health issues. Monitoring of calorie consumption and physical activity is needed  Early intervention with dietary and activity changes is needed.",
                        dietaryAdvice: "- Focus on portion control and regular meal timings.- Prioritize high-fiber foods like whole grains, fruits, and vegetables.- Avoid fried and sugary foods; use baking or steaming methods.- Introduce fun physical activities to reduce sedentary habits.",

                    },
                    'Obesity': {
                        nutritionalDiagnosis: "The child has significant excess weight, posing a high risk of severe health problems. Comprehensive intervention is required, potentially involving healthcare professionals.",
                        dietaryAdvice: "Consult a pediatric dietitian for a tailored plan. - Gradually reduce calorie intake while ensuring nutrient density. - Eliminate sugary drinks and high-fat junk foods.- Increase daily physical activity, aiming for structured sports or fitness routines.- Involve the family in adopting healthier eating and lifestyle habits.",

                    }
                },


                /* stunting */

                stunting_5_19_girl: {

                    'Severe Stunting': {
                        nutritionalDiagnosis: "Severe stunting related to prolonged inadequate nutrient intake and possible health complications as evidenced by height-for-age Z-score below -3.",
                        dietaryAdvice: "Prioritize calorie-dense, nutrient-rich foods like lean proteins, whole grains, dairy, and regular healthy snacks to support catch-up growth."
                    },
                    'Stunting': {
                        nutritionalDiagnosis: "Stunting related to insufficient nutrient variety and caloric intake as evidenced by height-for-age Z-score between -3 and -2.",
                        dietaryAdvice: "Incorporate protein-rich foods (e.g., meat, beans) and micronutrients (e.g., iron, calcium) to encourage healthy growth."
                    },
                    'Normal Growth': {
                        nutritionalDiagnosis: "Normal growth supported by adequate nutrition as evidenced by height-for-age Z-score between -2 and +2.",
                        dietaryAdvice: "Maintain a balanced diet with a variety of fruits, vegetables, whole grains, lean proteins, and dairy to support overall health."
                    },
                    'Tall': {
                        nutritionalDiagnosis: "Above-average height likely due to genetic factors and sufficient nutrient intake, as evidenced by height-for-age Z-score greater than +2.",
                        dietaryAdvice: "Continue with a balanced diet, adjusting portions to support growth and daily activity levels."
                    }

                },

                stunting_5_19_boy: {

                    'Severe Stunting': {
                        nutritionalDiagnosis: "Severe stunting related to prolonged inadequate nutrient intake and possible health complications as evidenced by height-for-age Z-score below -3.",
                        dietaryAdvice: "Prioritize calorie-dense, nutrient-rich foods like lean proteins, whole grains, dairy, and regular healthy snacks to support catch-up growth."
                    },
                    'Stunting': {
                        nutritionalDiagnosis: "Stunting related to insufficient nutrient variety and caloric intake as evidenced by height-for-age Z-score between -3 and -2.",
                        dietaryAdvice: "Incorporate protein-rich foods (e.g., meat, beans) and micronutrients (e.g., iron, calcium) to encourage healthy growth."
                    },
                    'Normal Growth': {
                        nutritionalDiagnosis: "Normal growth supported by adequate nutrition as evidenced by height-for-age Z-score between -2 and +2.",
                        dietaryAdvice: "Maintain a balanced diet with a variety of fruits, vegetables, whole grains, lean proteins, and dairy to support overall health."
                    },
                    'Tall': {
                        nutritionalDiagnosis: "Above-average height likely due to genetic factors and sufficient nutrient intake, as evidenced by height-for-age Z-score greater than +2.",
                        dietaryAdvice: "Continue with a balanced diet, adjusting portions to support growth and daily activity levels."
                    }

                },


                stunting_2_5_girl: {

                    "Severe Stunting (LAZ/HAZ < -3)": {
                        nutritionalDiagnosis: "Severe stunting related to chronic malnutrition and possible recurrent infections, as evidenced by height-for-age Z-score below -3.",
                        dietaryAdvice: "Emphasize nutrient-dense, high-protein foods like eggs, dairy, meats, fortified cereals, and calorie-dense snacks to support growth recovery."
                    },
                    "Stunting (LAZ/HAZ between -3 and -2)": {
                        nutritionalDiagnosis: "Stunting related to suboptimal dietary intake and lack of dietary diversity, as evidenced by height-for-age Z-score between -3 and -2.",
                        dietaryAdvice: "Increase protein and iron-rich foods, such as beans, lean meats, leafy greens, and fortified cereals, to boost growth and development."
                    },
                    "Normal (LAZ/HAZ between -2 and +2)": {
                        nutritionalDiagnosis: "Normal growth supported by adequate nutrient intake, as evidenced by height-for-age Z-score between -2 and +2.",
                        dietaryAdvice: "Maintain a balanced diet with a variety of fruits, vegetables, whole grains, lean proteins, and dairy to sustain healthy growth."
                    },
                    "Tall (LAZ/HAZ > +2)": {
                        nutritionalDiagnosis: "Above-average height potentially related to genetic factors and adequate nutrition, as evidenced by height-for-age Z-score greater than +2.",
                        dietaryAdvice: "Ensure continued balanced nutrition with appropriate portions to support proportionate growth and energy needs."
                    }

                },

                stunting_2_5_boy: {

                    "Severe Stunting (LAZ/HAZ < -3)": {
                        nutritionalDiagnosis: "Severe stunting related to chronic malnutrition and possible recurrent infections, as evidenced by height-for-age Z-score below -3.",
                        dietaryAdvice: "Emphasize nutrient-dense, high-protein foods like eggs, dairy, meats, fortified cereals, and calorie-dense snacks to support growth recovery."
                    },
                    "Stunting (LAZ/HAZ between -3 and -2)": {
                        nutritionalDiagnosis: "Stunting related to suboptimal dietary intake and lack of dietary diversity, as evidenced by height-for-age Z-score between -3 and -2.",
                        dietaryAdvice: "Increase protein and iron-rich foods, such as beans, lean meats, leafy greens, and fortified cereals, to boost growth and development."
                    },
                    "Normal (LAZ/HAZ between -2 and +2)": {
                        nutritionalDiagnosis: "Normal growth supported by adequate nutrient intake, as evidenced by height-for-age Z-score between -2 and +2.",
                        dietaryAdvice: "Maintain a balanced diet with a variety of fruits, vegetables, whole grains, lean proteins, and dairy to sustain healthy growth."
                    },
                    "Tall (LAZ/HAZ > +2)": {
                        nutritionalDiagnosis: "Above-average height potentially related to genetic factors and adequate nutrition, as evidenced by height-for-age Z-score greater than +2.",
                        dietaryAdvice: "Ensure continued balanced nutrition with appropriate portions to support proportionate growth and energy needs."
                    }

                },


                stunting_birth_to_2_girl: {

                    "Severe Stunting (LAZ < -3)": {
                        nutritionalDiagnosis: "Severe stunting related to chronic inadequate nutrient intake and frequent infections, as evidenced by length-for-age Z-score below -3.",
                        dietaryAdvice: "Prioritize high-calorie, nutrient-dense foods, including fortified cereals, protein-rich sources, and essential fats, and consult with a pediatric nutritionist."
                    },
                    "Stunting (LAZ between -3 and -2)": {
                        nutritionalDiagnosis: "Stunting related to inadequate dietary diversity and insufficient caloric intake, as evidenced by length-for-age Z-score between -3 and -2.",
                        dietaryAdvice: "Incorporate iron- and protein-rich foods, including meats, legumes, and leafy greens, to support growth and immunity."
                    },
                    "Normal (LAZ between -2 and +2)": {
                        nutritionalDiagnosis: "Normal growth supported by balanced nutrient intake as evidenced by length-for-age Z-score between -2 and +2.",
                        dietaryAdvice: "Maintain a balanced diet that includes a variety of fruits, vegetables, grains, and proteins to support continued healthy growth."
                    },
                    "Tall (LAZ > +2)": {
                        nutritionalDiagnosis: "Height above average likely supported by adequate nutrient intake and genetics, as evidenced by length-for-age Z-score greater than +2.",
                        dietaryAdvice: "Continue with a well-balanced diet, ensuring nutrients are proportionate to height and activity levels to maintain balanced growth."
                    }

                },



                stunting_birth_to_2_boy: {

                    "Severe Stunting (LAZ < -3)": {
                        nutritionalDiagnosis: "Severe stunting related to chronic inadequate nutrient intake and frequent infections, as evidenced by length-for-age Z-score below -3.",
                        dietaryAdvice: "Prioritize high-calorie, nutrient-dense foods, including fortified cereals, protein-rich sources, and essential fats, and consult with a pediatric nutritionist."
                    },
                    "Stunting (LAZ between -3 and -2)": {
                        nutritionalDiagnosis: "Stunting related to inadequate dietary diversity and insufficient caloric intake, as evidenced by length-for-age Z-score between -3 and -2.",
                        dietaryAdvice: "Incorporate iron- and protein-rich foods, including meats, legumes, and leafy greens, to support growth and immunity."
                    },
                    "Normal (LAZ between -2 and +2)": {
                        nutritionalDiagnosis: "Normal growth supported by balanced nutrient intake as evidenced by length-for-age Z-score between -2 and +2.",
                        dietaryAdvice: "Maintain a balanced diet that includes a variety of fruits, vegetables, grains, and proteins to support continued healthy growth."
                    },
                    "Tall (LAZ > +2)": {
                        nutritionalDiagnosis: "Height above average likely supported by adequate nutrient intake and genetics, as evidenced by length-for-age Z-score greater than +2.",
                        dietaryAdvice: "Continue with a well-balanced diet, ensuring nutrients are proportionate to height and activity levels to maintain balanced growth."
                    }

                },



            };

            // Function to set data attributes for option elements
            function setDataValueForOptions1() {
                $('.NutritionistOptionsAttribute').each(function() {
                    const selectId = $(this).attr('id');

                    if (dataOptionsAttributes1[selectId]) {
                        $(this).find('option').each(function() {
                            const optionValue = $(this).val();

                            if (dataOptionsAttributes1[selectId][optionValue]) {
                                const data = dataOptionsAttributes1[selectId][optionValue];

                                // Set the attributes
                                $(this).attr('data-nutritional-diagnosis', data
                                    .nutritionalDiagnosis);
                                $(this).attr('data-dietary-advice', data.dietaryAdvice);


                            }
                        });
                    }
                });
            }

            setDataValueForOptions1();


    // Trigger when Question_No_60_How_would_you_describe_your_lifestyle changes
    $('#Question_No_60_How_would_you_describe_your_lifestyle,#Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day').on('change', function() {
        updateComments();
        setDataValueForOptions1();
    });




            // Mapping object for select box options and their data-value attributes
            const dataOptionsAttributes = {
                observation1: {
                    1: "Child’s overall behavior is normal",
                    2: "Child’s is a bit unfocused.",
                    3: "He is pretty much restless and active",
                    4: "He is very much overactive and restless."
                },
                observation2: {
                    1: "The child has no aggressive symptoms",
                    2: "The child has a very mild level of impulses",
                    3: "The child is pretty much impulsive",
                    4: "The child’s aggression level is extremely high"
                    
                },
                observation3: {
                    1: "the child has a good conduct overall",
                    2: "The child disturbs others a bit",
                    3: "He disturbs the class quite a lot",
                    4: "He disturbs the class significantly."
                },
                observation4: {
                    1: "The child attention span is appropriate",
                    2: "A little bit of Attention span issues",
                    3: "A lot of problems with attention span",
                    4: "Significant issues regarding short attention span"
                },
                observation5: {
                    1: "He is an attentive child",
                    2: "The child is distracted a bit",
                    3: "The child is easily distracted and inattentive",
                    4: "The child is extensively distracted"
                },
                observation6: {
                    1: "No crying spells",
                    2: "occasional crying in the class",
                    3: "The child cries a lot in the class",
                    4: "The child cries extensively"
                },
                observation7: {
                    1: "No spelling errors",
                    2: "few spelling mistakes",
                    3: "The child spelling is very poor",
                    4: "Severe spelling errors"
                },
                observation8: {
                    1: "no writing errors",
                    2: "Mild mistakes in writing dates",
                    3: "The child is finding difficulty writing the dates",
                    4: "The child is making severe mistakes in writing dates"
                },
                observation9: {
                    1: "No issues are highlighted from telling left to right",
                    2: "Mild issues when telling left from right",
                    3: "The child is finding great difficulty telling left to right",
                    4: "The child is finding significant trouble telling left to right"
                },
                observation10: {
                    1: "Bus numbers are addressed appropriately",
                    2: "Mild issue telling bus numbers",
                    3: "Child is finding huge difficulty differentiating bus numbers",
                    4: "Significant issues finding differences in bus numbers"
                },


                Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts: {
                    "Rarely": "healthy thoughts pattern",
                    "Occasionally": "sometime experience unpleasant thoughts",
                    "Frequently": "frequently having a repetitive thoughts cycles",
                    "Almost always": "she/he usually has an intensive cycle of having negative thoughts"
                },


                Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence: {
                    "Very high": "healthy self-worth",
                    "Moderately high": "high self-esteem",
                    "Moderately low": "mild level of self-esteem issues",
                    "Very low": "very low self-concept/self-worth"
                },

                Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day: {
                    "High and consistent": "Energy levels are high",
                    "Moderate and stable": "Normal energy levels",
                    "Fluctuating": "Energy levels are varying",
                    "Low and inconsistent": "Low energy level"
                },



                Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms: {
                    "Healthy coping strategies": "Dealing with challenges in a healthy manner",
                    "Neutral coping strategies": "Balanced coping mechanism",
                    "Unhealthy coping strategies": "Facing challenges in dealing with stressful situations",
                    "No clear coping strategies": "Very poor coping skills"
                },


                Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average: {
                    "Excellent": "Sleep quality is very good",
                    "Good": "Sleep quality is healthy",
                    "Fair": "Average amount of sleep",
                    "Poor": "Difficulty in sleeping"
                },

                Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks: {
                    "Rarely": "Managing stress in a healthy way",
                    "Occasionally": "Sometimes feel stressful",
                    "Frequently": "Always feel stress",
                    "Almost always": "Feeling stressful every time"
                },

                Question_No_65_How_would_you_describe_your_overall_mood_during_the_day: {
                    "Very positive": "Mood levels are positive",
                    "Mostly positive": "Mood levels are normal",
                    "Mixed": "Fluctuating mood cycle",
                    "Mostly negative": "Low mood"
                }


                ,
                Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members: {
                    "Very positive": "Very cordial relation with family members",
                    "Mostly positive": "Pleasant relationship with family",
                    "Mixed": "Neutral relation with them",
                    "Mostly negative": "Not good relation with family"
                },

                Question_No_67_How_well_does_you_handle_challenges_and_solve_problems: {
                    "Very well": "Very good problem solving skills",
                    "Moderately well": "Managing challenges in a healthy way",
                    "Somewhat poorly": "Not good problem solving skills",
                    "Very poorly": "Unhealthy skills"
                },

                Question_No_68_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night: {
                    "9 or more hours": "Very good sleep",
                    "7-8 hours": "Quality of sleep is decent",
                    "6 hours or less": "Sleep is moderate",
                    "Variable, inconsistent": "Sleep patterns varies"
                },

                followup_required: {
                    "Yes": "Yes.",
                    "No": "No."
                },
                referred_by: {
                    "Teacher": "The referral was made by the teacher.",
                    "School Doctor": "The referral was made by the school doctor.",
                    "Both": "The referral was made by both the teacher and the school doctor.",
                    "None": "There was no referral."
                }

            };



            function updateBackgroundColor(selector, selectValue, category) {
                var backgroundColor = '';
                var textColor = 'white';

                switch (category) {
                    case 'stunting':
                        switch (selectValue) {
                            case 'Severe Stunting (LAZ/HAZ < -3)':
                            case 'Severe Stunting (LAZ < -3)':
                            case 'Severe Stunting':
                                backgroundColor = 'red';
                                break;
                            case 'Stunting (LAZ/HAZ between -3 and -2)':
                            case 'Stunting (LAZ between -3 and -2)':
                            case 'Stunting':
                                backgroundColor = 'orange';
                                break;
                            case 'Normal (LAZ/HAZ between -2 and +2)':
                            case 'Normal (LAZ between -2 and +2)':
                            case 'Normal':
                                backgroundColor = 'green';
                                break;
                            case 'Tall (LAZ/HAZ > +2)':
                            case 'Tall (LAZ > +2)':
                            case 'Tall':
                                backgroundColor = 'blue';
                                break;
                            default:
                                backgroundColor = '';
                        }
                        break;

                    case 'wasting':
                        switch (selectValue) {
                            case 'Severe Wasting (WHZ < -3)':
                            case 'Severe Thinness':
                                backgroundColor = 'red';
                                break;
                            case 'Moderate Wasting (WHZ between -3 and -2)':
                            case 'Moderate Thinness':
                                backgroundColor = 'orange';
                                break;
                            case 'Normal (WHZ between -2 and +2)':
                            case 'Normal Weight':
                                backgroundColor = 'green';
                                break;
                            case 'Overweight (WHZ > +2)':
                            case 'Overweight':
                                backgroundColor = 'yellow';
                                textColor = 'black';
                                break;
                            case 'Obesity':
                                backgroundColor = 'red';
                                break;
                            default:
                                backgroundColor = '';
                        }
                        break;
                }

                if (backgroundColor) {
                    $(selector).attr('style', 'background-color: ' + backgroundColor + ' !important; color: ' +
                        textColor + ' !important;');
                } else {
                    $(selector).attr('style', '');
                }
            }

            // Event listeners for dropdowns
            var dropdownMappings = [{
                    id: '#stunting_5_19_girl',
                    category: 'stunting'
                },
                {
                    id: '#stunting_5_19_boy',
                    category: 'stunting'
                },
                {
                    id: '#stunting_2_5_girl',
                    category: 'stunting'
                },
                {
                    id: '#stunting_2_5_boy',
                    category: 'stunting'
                },
                {
                    id: '#stunting_birth_to_2_girl',
                    category: 'stunting'
                },
                {
                    id: '#stunting_birth_to_2_boy',
                    category: 'stunting'
                },
                {
                    id: '#wasting_5_to_19_boy',
                    category: 'wasting'
                },
                {
                    id: '#wasting_5_to_19_girl',
                    category: 'wasting'
                },
                {
                    id: '#wasting_birth_to_5_girl',
                    category: 'wasting'
                },
                {
                    id: '#wasting_birth_to_5_boy',
                    category: 'wasting'
                }
            ];

            // Loop through the mappings and attach event listeners
            dropdownMappings.forEach(function(mapping) {
                $(mapping.id).on('change', function() {
                    var selectedValue = $(this).val();
                    updateBackgroundColor(mapping.id, selectedValue, mapping.category);
                });
            });



            function updateComments() {
                // Get selected options for NutritionistSelect (Wasting)
                console.log("update listner");
                // const wastingSelectedOptions = $('.NutritionistSelectWasting').find(':selected');
                const wastingSelectedOptions = $('.NutritionistSelectWasting').find('option:selected').filter(function() {
        const val = $(this).val();
        return val && val.toLowerCase() !== 'select';
    });
    console.log("wastingSelectedOptions:", wastingSelectedOptions.get());
                const wastingDiagnosis = wastingSelectedOptions.map(function() {
                    return $(this).attr('data-nutritional-diagnosis');
                }).get().join(' ');

                const wastingDietaryAdvice = wastingSelectedOptions.map(function() {
                    return $(this).attr('data-dietary-advice');
                }).get().join('\n');

                // Get selected options for NutritionistSelectStunting
                // const stuntingSelectedOptions = $('.NutritionistSelectStunting').find(':selected');
                const stuntingSelectedOptions = $('.NutritionistSelectStunting').find('option:selected').filter(function() {
                    const val = $(this).val();
                return val && val.trim().toLowerCase() !== 'select';});
                    console.log("Stunting Selected Values:", stuntingSelectedOptions.get());
                const stuntingDiagnosis = stuntingSelectedOptions.map(function() {
                    return $(this).attr('data-nutritional-diagnosis');
                }).get().join(' ');

                const stuntingDietaryAdvice = stuntingSelectedOptions.map(function() {
                    return $(this).attr('data-dietary-advice');
                }).get().join('\n');



                // Combine values for #NutritionistComment
                const nutritionalDiagnosis = [wastingDiagnosis, stuntingDiagnosis]
                    .filter(Boolean) // Remove empty values
                    .join(' '); // Separator can be customized



                // Combine values for #DietaryAdviceComment
                const combinedDietaryAdvice = [wastingDietaryAdvice, stuntingDietaryAdvice]
                    .filter(Boolean)
                    .join('\n'); // Separator can be customized

                // Update the respective textareas
                $('#NutritionistComment').val(nutritionalDiagnosis);
                $('#DietaryAdviceComment').val(combinedDietaryAdvice);


                // const wastingSelectedOptionsValue = wastingSelectedOptions.attr('');
                // console.log("wastingSelectedOptionsValue ", wastingSelectedOptionsValue);

                const dob = $('#dob').val();
                 console.log("dob ", dob);


                if ($("#read_oly_age").val() <= 5 ) {
                   
                    // Parse the DOB into a Date object
                    const dobDate = new Date(dob);
                    const today = new Date();

                    // Validate if dobDate is a valid date
                    if (isNaN(dobDate)) {
                        console.error("Invalid date format for DOB.");
                        return;
                    }

                    // Calculate the number of months
                    const yearsDifference = today.getFullYear() - dobDate.getFullYear();
                    const monthsDifference = today.getMonth() - dobDate.getMonth();
                    const totalMonths = (yearsDifference * 12) + monthsDifference;

                    // console.log("------------------------------");
                     console.log("Total Months: ", totalMonths);
                    // console.log("bmi : ", $('#bmi').val());
                    // console.log("gender : ", $('#gender').val());


                    var base_url = '{!! Route('WastingCalculation') !!}';
                    // console.log("base_url " + base_url);



                    $.ajax({
                        url: base_url,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            gender: $("#gender").val(),
                            height: parseFloat($("#height").val()),
                        },
                        success: function(response) {
                            // Handle success response
                            console.log('Success:', response);
                            // console.log('Response status:', response.status);
                            // console.log('Response z_index:', response.z_index);

                            if (response ) {

                                const weight = parseFloat($("#weight").val());

                                const SD3neg = parseFloat(response.data.SD3neg);
                                const SD2neg = parseFloat(response.data.SD2neg);
                                const SD1neg = parseFloat(response.data.SD1neg);
                                const SD0 = parseFloat(response.data.SD0);
                                const SD1 = parseFloat(response.data.SD1);
                                const SD2 = parseFloat(response.data.SD2);
                                const SD3 = parseFloat(response.data.SD3);

                                
                                

                                const dropdownId = $("#gender").val() === 'female' ? "#wasting_birth_to_5_girl" : "#wasting_birth_to_5_boy";

                                // console.log("weight ", weight);
                                // console.log("negative3SD ", negative3SD);
                                // console.log("dropdownId ", dropdownId);
                                // console.log("$(dropdownId).val() ", $(dropdownId).val());
                                if (weight <= SD3neg) {
                                    console.log("Severe Wasting (WHZ < -3)");
                                    $(dropdownId).val('Severe Wasting (WHZ < -3)');
                                } else if (weight > SD3neg && weight < SD2neg) {
                                    // console.log("Moderate Wasting (WHZ between -3 and -2)");
                                    $(dropdownId).val('Moderate Wasting (WHZ between -3 and -2)');
                                } else if (weight > SD2neg && weight < SD2) {
                                    // console.log("Normal (WHZ between -2 and +2)");
                                    $(dropdownId).val('Normal (WHZ between -2 and +2)');
                                    $(dropdownId).attr('style', 'background-color: green !important; color: white !important;');
                                } else if (weight > SD2 && weight < SD3) {
                                    // console.log("Overweight (WHZ > +2)");
                                    $(dropdownId).val('Overweight (WHZ > +2)');
                                    $(dropdownId).attr('style', 'background-color: yellow !important; color: black !important;');
                                } 
                                else {
                                    // console.log("Unknown Classification");
                                    $(dropdownId).val('');
                                }




                            } else {
                                console.error("Invalid response data");
                            }






                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.log('Error:', error);
                        }

                    });



                } 
              
                
               else  if (dob && $("#read_oly_age").val() >= 5 && $("#read_oly_age").val() <= 19) 
               {
                   
                    // Parse the DOB into a Date object
                    const dobDate = new Date(dob);
                    const today = new Date();

                    // Validate if dobDate is a valid date
                    if (isNaN(dobDate)) {
                        console.error("Invalid date format for DOB.");
                        return;
                    }

                    // Calculate the number of months
                    const yearsDifference = today.getFullYear() - dobDate.getFullYear();
                    const monthsDifference = today.getMonth() - dobDate.getMonth();
                    const totalMonths = (yearsDifference * 12) + monthsDifference;

                    console.log("------------------bmi61---------------------------------- ");
                    console.log("yearsDifference: ", yearsDifference);
                    console.log("monthsDifference: ", monthsDifference);
                    console.log("Total Months: ", totalMonths);
                    console.log("today.getMonth(): ", today.getMonth());
                    console.log("dobDate.getMonth(): ", dobDate.getMonth());


                    var base_url = '{!! Route('WastingBMICalculation') !!}';



                    $.ajax({
                        url: base_url,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            gender: $("#gender").val(),
                            totalMonths: totalMonths,
                            height: parseFloat($("#height").val()),
                        },
                        success: function(response) {
                            // Handle success response
                            console.log('Success:', response);
                            // console.log('Response status:', response.status);
                            // console.log('Response z_index:', response.z_index);

                            if (response.status ) {

                                const bmi61 = parseFloat($("#bmi61").val());

                                const Neg3SD = parseFloat(response.data.Neg3SD);
                                const Neg2SD = parseFloat(response.data.Neg2SD);
                                const Neg1SD = parseFloat(response.data.Neg1SD);
                                const Median = parseFloat(response.data.Median);
                                const Pos1SD = parseFloat(response.data.Pos1SD);
                                const Pos2SD = parseFloat(response.data.Pos2SD);
                                const Pos3SD = parseFloat(response.data.Pos3SD);



                                const dropdownId = $("#gender").val() === 'female' ? "#wasting_5_to_19_girl" : "#wasting_5_to_19_boy";

                    console.log("------------------bmi61---------------------------------- ");
                                
                                console.log("bmi61 " , bmi61);
                                console.log("Neg3SD " , Neg3SD);
                                console.log("Neg2SD " , Neg2SD);
                                console.log("Neg1SD " , Neg1SD);
                                console.log("Median " , Median);
                                console.log("Pos1SD " , Pos1SD);
                                console.log("Pos2SD " , Pos2SD);
                                console.log("Pos3SD " , Pos3SD);

                               // console.log("Neg2SD-.1" , Neg2SD , Neg2SD - .1);

                                // if (bmi61 <= Neg3SD) {
                                    if (bmi61 <= parseFloat(Neg2SD - .1)) {
                                    $(dropdownId).val('Severe Thinness');
                                    $(dropdownId).attr('style', 'background-color: red !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'red', 'color': 'white'});

                                    

                                // } else if (bmi61 > Neg3SD && bmi61 < Neg2SD) {
                                } else if (bmi61 > parseFloat(Neg2SD - .1) && bmi61 < parseFloat(Neg1SD - .1)) {
                                    console.log(parseFloat(Pos2SD + .1));
                                    $(dropdownId).val('Moderate Thinness');
                                    $(dropdownId).attr('style', 'background-color: orange !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'orange', 'color': 'white'});
                                    
                                // } else if (bmi61 > Neg2SD && bmi61 < Pos1SD) {
                                } else if (bmi61 >= parseFloat(Neg1SD - .1)  && bmi61 <= Median ) {
                                  console.log('Mild Thinness');
                                    $(dropdownId).val('Mild Thinness');
                                    $(dropdownId).attr('style', 'background-color: yellow !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'yellow', 'color': 'white'});

                                // } else if (bmi61 > Pos1SD) {
                                }  else if (bmi61 == Median ) {
                                  
                                    $(dropdownId).val('Normal Weight');
                                    $(dropdownId).attr('style', 'background-color: green !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'green', 'color': 'white'});

                                // } else if (bmi61 > Pos1SD) {
                                  }  else if (bmi61 > Median && bmi61 < Pos1SD ) {
                                  
                                  $(dropdownId).val('Mild Overweight');
                                  $(dropdownId).attr('style', 'background-color: yellow !important; color: white !important;');
                                  $('#bmi61').css({'background-color': 'yellow', 'color': 'white'});

                              // } else if (bmi61 > Pos1SD) {
                              }else if (bmi61 > parseFloat(Pos1SD) && bmi61 <= parseFloat(Pos2SD + .1)) {
                                    console.log(parseFloat(Pos2SD + .1));
                                    $(dropdownId).val('Overweight');
                                    $(dropdownId).attr('style', 'background-color: orange !important; color: black !important;');
                                    $('#bmi61').css({'background-color': 'orange', 'color': 'black'});
                                } 
                                // else if (bmi61 > Pos2SD) {
                                else if (bmi61 > parseFloat(Pos2SD + .1)) {
                                        console.log(parseFloat(Pos2SD + .1));
                                    $(dropdownId).val('Obesity');
                                    $(dropdownId).attr('style', 'background-color: red !important; color: black !important;');
                                        $('#bmi61').css({'background-color': 'red', 'color': 'black'});
                                        }else {
                                    console.log("Unknown Classification");
                                    $(dropdownId).val('');
                                }


                            } else {
                                console.error("Invalid response data");
                            }






                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.log('Error:', error);
                        }

                    });



                } 
              
                
                else {
                    console.log("Please enter a valid date of birth.");
                }
              
              
               /* if (dob && $("#read_oly_age").val() >= 5 && $("#read_oly_age").val() <= 19) {
                    // Parse the DOB into a Date object
                    const dobDate = new Date(dob);
                    const today = new Date();

                    // Validate if dobDate is a valid date
                    if (isNaN(dobDate)) {
                        console.error("Invalid date format for DOB.");
                        return;
                    }

                    // Calculate the number of months
                    const yearsDifference = today.getFullYear() - dobDate.getFullYear();
                    const monthsDifference = today.getMonth() - dobDate.getMonth();
                    const totalMonths = (yearsDifference * 12) + monthsDifference;

                    // console.log("------------------------------");
                    // console.log("Total Months: ", totalMonths);
                    // console.log("bmi : ", $('#bmi').val());
                    // console.log("gender : ", $('#gender').val());


                    var base_url = '{!! Route('WHZCalculationBmi') !!}';
                    // console.log("base_url " + base_url);

                    $.ajax({
                        url: base_url,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            gender: $("#gender").val(),
                            totalMonths: totalMonths,
                            bmi: $('#bmi').val(),
                        },
                        success: function(response) {
                            // Handle success response
                            // console.log('Success:', response);
                            // console.log('Response status:', response.status);
                            // console.log('Response z_index:', response.z_index);

                            if (response && response.z_index) {

                                const zIndex = parseFloat(response.z_index);
                                const negative3SD = parseFloat(response.data.Negative3SD);
                                const negative2SD = parseFloat(response.data.Negative2SD);
                                const positive1SD = parseFloat(response.data.positive1SD);
                                const positive2SD = parseFloat(response.data.positive2SD);

                                const dropdownId = $("#gender").val() === 'female' ?
                                    "#wasting_5_to_19_girl" : "#wasting_5_to_19_boy";

                                // console.log("zIndex ", zIndex);
                                // console.log("negative3SD ", negative3SD);
                                // console.log("dropdownId ", dropdownId);
                                // console.log("$(dropdownId).val() ", $(dropdownId).val());

                                if (zIndex <= negative3SD) {
                                    console.log("Severe Thinness");
                                    $(dropdownId).val('Severe Thinness');
                                } else if (zIndex > negative3SD && zIndex < negative2SD) {
                                    // console.log("Moderate Thinness");
                                    $(dropdownId).val('Moderate Thinness');
                                } else if (zIndex > negative2SD && zIndex < positive1SD) {
                                    // console.log("Normal Weight");
                                    $(dropdownId).val('Normal Weight');
                                } else if (zIndex > positive1SD && zIndex < positive2SD) {
                                    // console.log("Overweight");
                                    $(dropdownId).val('Overweight');
                                } else if (zIndex > positive2SD) {
                                    // console.log("Obesity");
                                    $(dropdownId).val('Obesity');
                                } else {
                                    // console.log("Unknown Classification");
                                    $(dropdownId).val('');
                                }





                            } else {
                                console.error("Invalid response data");
                            }






                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.log('Error:', error);
                        }

                    });



                } else {
                    console.log("Please enter a valid date of birth.");
                }*/

                /* STUNTING CRITERIA */
                if ( $("#read_oly_age").val() <= 19) {
                    // Parse the DOB into a Date object
                    const dobDate = new Date(dob);
                    const today = new Date();

                    // Validate if dobDate is a valid date
                    if (isNaN(dobDate)) {
                        console.error("Invalid date format for DOB.");
                        return;
                    }

                    // Calculate the number of months
                    const yearsDifference = today.getFullYear() - dobDate.getFullYear();
                    const monthsDifference = today.getMonth() - dobDate.getMonth();
                    const totalMonths = (yearsDifference * 12) + monthsDifference;
                    // const totalMonths = (yearsDifference * 12);


                    /*console.log("---------------------------------------------------- ");
                    console.log("dobDate.getDate()  " + dobDate.getDate());
                    console.log("today.getDate()  " + today.getDate());
                    console.log("dobDate.getFullYear()  " + dobDate.getFullYear());
                    console.log("dobDate.getMonth()  " + dobDate.getMonth());
                    console.log("today.getFullYear()  " + today.getFullYear());
                    console.log("today.getMonth()  " + today.getMonth());
                    console.log("dob " + dob);
                    console.log("today " + today);
                    console.log("dobDate " + dobDate);
                    console.log("age " + age);
                    console.log("monthsDifference " + monthsDifference);*/
                    console.log("totalMonths " + totalMonths);

                    


                    var base_url = '{!! Route('StuntingCriteria5') !!}';

                    $.ajax({
                        url: base_url,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            gender: $("#gender").val(),
                            totalMonths: totalMonths
                        },
                        success: function(response) {
                            // Handle success response
                            // console.log('Success:', response);
                            // console.log('Response status:', response.status);

                            if (response) {

                                const SD = parseFloat(response.data.SD);
                                const SD3neg = parseFloat(response.data.SD3neg);
                                const SD2neg = parseFloat(response.data.SD2neg);
                                const SD1neg = parseFloat(response.data.SD1neg);
                                const SD0 = parseFloat(response.data.SD0);
                                const SD1 = parseFloat(response.data.SD1);
                                const SD2 = parseFloat(response.data.SD2);
                                const SD3 = parseFloat(response.data.SD3);

                                

                                const Question_No_1_Height = parseFloat($("#height").val());

                                console.log("-------------StuntingCriteria5-----------------------");
                                console.log('Question_No_1_Height:', Question_No_1_Height);
                                console.log("SD ", SD);
                                console.log("SD3neg ", SD3neg);
                                console.log("SD2neg ", SD2neg);
                                console.log("SD1neg ", SD1neg);
                                console.log("SD0 ", SD0);
                                console.log("SD1 ", SD1);
                                console.log("SD2 ", SD2);
                                console.log("SD3 ", SD3);



                                if($("#read_oly_age").val() >= 5 && $("#read_oly_age").val() <= 19)
                                {
                                    const dropdownId = $("#gender").val() === 'female' ? "#stunting_5_19_girl" : "#stunting_5_19_boy";

                                    if (Question_No_1_Height <= SD3neg) {
                                        console.log("SD3neg ");
                                        $(dropdownId).val('Severe Stunting');
                                     $(dropdownId).attr('style', 'background-color: red !important; color: white !important;');
                                       
                                    }
                                    else if (Question_No_1_Height > SD3neg && Question_No_1_Height <= SD2neg) {
                                        console.log("Stunting ");
                                        $(dropdownId).val('Stunting');
                                    $(dropdownId).attr('style', 'background-color: yellow !important; color: black !important;');

                                    }
                                    else if (Question_No_1_Height > SD2neg && Question_No_1_Height <= SD2) {
                                        console.log("Normal");
                                        $(dropdownId).val('Normal');
                                    $(dropdownId).attr('style', 'background-color: green !important; color: white !important;');

                                    }
                                    else if (Question_No_1_Height >= SD2) {
                                        console.log("Tall");
                                        $(dropdownId).val('Tall');
                                        $(dropdownId).attr('style', 'background-color: blue !important; color: white !important;');

                                    }
                                    else {
                                        console.log("Unknown Classification");
                                        $(dropdownId).val('');
                                    }

                                
                                }
                                else
                                {
                                    const dropdownId = $("#gender").val() === 'female' ? "#stunting_2_5_girl" : "#stunting_2_5_boy";

                                    if (Question_No_1_Height <= SD3neg) {
                                    console.log("Severe Stunting (LAZ/HAZ < -3)");
                                    $(dropdownId).val('Severe Stunting (LAZ/HAZ < -3)');
                                    $(dropdownId).attr('style', 'background-color: red !important; color: white !important;');
                                    }
                                    else if (Question_No_1_Height > SD3neg && Question_No_1_Height <= SD2neg) {
                                        console.log("Stunting (LAZ/HAZ between -3 and -2))");
                                        $(dropdownId).val('Stunting (LAZ/HAZ between -3 and -2');
                                        $(dropdownId).attr('style', 'background-color: yellow !important; color: black !important;');
                                    }
                                    else if (Question_No_1_Height > SD2neg && Question_No_1_Height <= SD2) {
                                        console.log("Normal (LAZ/HAZ between -2 and +2)");
                                        $(dropdownId).val('Normal (LAZ/HAZ between -2 and +2)');
                                        $(dropdownId).attr('style', 'background-color: green !important; color: white !important;');
                                    }
                                    else if ( Question_No_1_Height > SD2) {
                                        console.log("Tall (LAZ/HAZ > +2))");
                                        $(dropdownId).val('Tall (LAZ/HAZ > +2)');
                                        $(dropdownId).attr('style', 'background-color: blue !important; color: white !important;');
                                    }
                                    else {
                                        console.log("Unknown Classification");
                                        $(dropdownId).val('');
                                    }

                                    
                                }

                                
                               


                            } else {
                                console.error("Invalid response data");
                            }

                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.log('Error:', error);
                        }

                    });



                } else {
                    console.log("Please enter a valid date of birth.");
                }



            }

            // Attach change events
            $('.NutritionistSelectWasting, .NutritionistSelectStunting').change(function() {

                updateComments();

            }).trigger('change');


            /*************  Step Two - Vitals/BMI *****************/

            /* height */
            $("#height").on("keyup change", function(e) {

                var height = $('#height').val();
                $('#read_oly_height').val(height);
                if (height != '') {
                    $('#weight').removeAttr("disabled");
                } else {
                    $('#weight').attr("disabled", true);
                }

                var dob = $("#dob").val();


                var today = new Date();
                var birthDate = new Date(
                    dob
                ); // Assuming 'dob' is a variable containing the birthdate string in the format like "YYYY-MM-DD"
                var age = today.getFullYear() - birthDate.getFullYear();
                var monthDiff = today.getMonth() - birthDate.getMonth();
                var totalMonths = age * 12 + monthDiff;

                // if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {

                //     age--;
                // }

                /*
                console.log("birthDate.getDate()  " + birthDate.getDate());
                console.log("today.getDate()  " + today.getDate());
                console.log("birthDate.getFullYear()  " + birthDate.getFullYear());
                console.log("birthDate.getMonth()  " + birthDate.getMonth());
                console.log("today.getFullYear()  " + today.getFullYear());
                console.log("today.getMonth()  " + today.getMonth());
                console.log("dob " + dob);
                console.log("today " + today);
                console.log("birthDate " + birthDate);
                console.log("age " + age);
                console.log("monthDiff " + monthDiff);
                console.log("totalMonths " + totalMonths);
                console.log("---------------------------------------------------- ");
                */

                var this1 = $(this);


                /*
                var base_url = '{!! Route('HeightForAge') !!}';



                $.ajax({
                    url: base_url,
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        age_month: totalMonths,
                        height: height
                    },

                    dataType: 'json',



                    success: function(resp) {


                        if (resp['status'] === true) {

                            $('.errorSmall').remove()
                            if ($('.successsSmall').length == 0) {
                                $('#height')
                                    // .addClass('error-border')
                                    .closest('.form-group')
                                    .append(
                                        '<small class="successsSmall text-success error-text">' +
                                        resp['message'] + '</small>');

                            }


                            this1.css("background-color", "");
                            this1.css("color", "");



                        } else {
                            $('.successsSmall').remove()
                            if ($('.errorSmall').length == 0) {
                                $('#height')
                                    // .addClass('error-border')
                                    .closest('.form-group')
                                    .append(
                                        '<small class="errorSmall text-danger error-text">' +
                                        resp['message'] + '</small>');

                            }

                            this1.css("background-color", "#f94848");
                            this1.css("color", "white");
                        }



                    }
                });

                */

            });

            /* height, weight */

            $("#weight, #height").on("keyup change", function(e) {

                var height = $('#height').val();
                var weight = $('#weight').val();
                var bmi = $('#bmi');
                if (height != '' && height > 0 && weight != '' && weight > 0) {
                    var result = (weight / height / height) * 10000;

                    $('#bmi').val(result.toFixed(2));
                    $('#bmi61').val(result.toFixed(2));


                    if (result <= 18.4 || result >= 24.10) {

                        $("#bmi").addClass("bg-danger");

                        $("#bmi").css('color', 'white', 'important');

                        $("#bmishow").val("High")
                        $("#bmiresult").val('High')
                        // $("#bmi61").addClass("bg-danger");
                        // $("#bmi61").css('color', 'white', 'important');


                    } else {
                        $("#bmi").removeClass("bg-danger");
                        $("#bmi").css('color', 'black', 'important');

                        $("#bmishow").val("Noraml")
                        $("#bmiresult").val('Noraml')
                        // $("#bmi61").removeClass("bg-danger");
                        // $("#bmi61").css('color', 'black', 'important');


                    }
                }
            }).trigger('change');


            /* weight*/
            $("#weight").on("keyup change", function(e) {

                $("#dob").change();

                var weight = parseFloat($("#weight").val());
                $('#read_oly_weight').val(weight);
                var dailyEnergyRequirement = parseFloat($("#Daily_Protien_requirement").val());
                console.log("weight " + weight);

                if (weight > 0) {

                    var dailyProteinRequirement = dailyEnergyRequirement * weight;

                    // Format to at least 3 decimal places
                    var formattedDailyProteinRequirement = dailyProteinRequirement.toFixed(3);


                    console.log("dailyProteinRequirement " + formattedDailyProteinRequirement);

                    $("#Daily_Protien_requirement").val(formattedDailyProteinRequirement).attr('readonly',
                        true);
                }

            }).trigger("change");


            /* Question_No_5_Blood_Pressure_Systolic */
            $("#Question_No_5_Blood_Pressure_Systolic").on("keyup change", function(e) {
                var systolic = parseInt($('#Question_No_5_Blood_Pressure_Systolic').val());
                var age = parseInt($('#age').val());
                /*console.log("Age", age);*/


                $("#Blood_Pressure_Systolic").text("").removeClass("text-success");

                if (age > 1 && age < 12) {
                    if (systolic < 90) {
                        $("#Blood_Pressure_Systolic").text("Normal BP").addClass("text-success");
                        $("#systolicresult").val("Normal BP")
                    } else if (systolic >= 90 && systolic < 95) {
                        $("#Blood_Pressure_Systolic").text("Elevated BP").addClass("text-success");
                        $("#systolicresult").val("Elevated BP")

                    } else if (systolic >= 130 && systolic < 139) {
                        $("#Blood_Pressure_Systolic").text("Stage 1 HTN ").addClass("text-success");
                        $("#systolicresult").val("Stage 1 HTN")

                    } else if (systolic > 140) {
                        $("#Blood_Pressure_Systolic").text("Stage 2 HTN ").addClass("text-success");
                        $("#systolicresult").val("Stage 2 HTN")

                    }
                } else if (age >= 13) {
                    if (systolic < 120) {
                        $("#Blood_Pressure_Systolic").text("Normal BP").addClass("text-success");
                        $("#systolicresult").val("Normal BP")

                    } else if (systolic >= 120 && systolic < 129) {
                        $("#Blood_Pressure_Systolic").text("Elevated BP").addClass("text-success");
                        $("#systolicresult").val("Elevated BP")

                    } else if (systolic >= 130 && systolic < 139) {
                        $("#Blood_Pressure_Systolic").text("Stage 1 HTN").addClass("text-success");
                        $("#systolicresult").val("Stage 1 HTN")

                    } else if (systolic > 90) {
                        $("#Blood_Pressure_Systolic").text("Stage 3 HTN ").addClass("text-success");
                        $("#systolicresult").val("Stage 1 HTN")

                    }
                }
            }).trigger('change');


            /* Question_No_6_Blood_Pressure_Diastolic */

            $("#Question_No_6_Blood_Pressure_Diastolic").on("keyup change", function(e) {
                var diastolic = parseInt($('#Question_No_6_Blood_Pressure_Diastolic').val());
                var age = parseInt($('#age').val());
                /*console.log("Age", age);*/


                $("#Blood_Pressure_Diastolic").text("").removeClass("text-success");

                if (age > 1 && age < 12) {
                    if (diastolic < 90) {
                        $("#Blood_Pressure_Diastolic").text("Normal BP").addClass("text-success");
                        $("#diastolicresult").val("Normal BP")

                    } else if (diastolic >= 90 && diastolic < 95) {
                        $("#Blood_Pressure_Diastolic").text("Elevated BP").addClass("text-success");
                        $("#diastolicresult").val("Elevated BP")

                    } else if (diastolic >= 80 && diastolic < 89) {
                        $("#Blood_Pressure_Diastolic").text("Stage 1 HTN ").addClass("text-success");
                        $("#diastolicresult").val("Stage 1 HTN")

                    } else if (diastolic >= 140) {
                        $("#Blood_Pressure_Diastolic").text("Stage 2 HTN ").addClass("text-success");
                        $("#diastolicresult").val("Stage 2 HTN")

                    }
                } else if (age >= 13) {
                    if (diastolic < 80) {
                        $("#Blood_Pressure_Diastolic").text("Elevated BP").addClass("text-success");
                        $("#diastolicresult").val("Elevated BP")

                    } else if (diastolic >= 80 && diastolic < 89) {
                        $("#Blood_Pressure_Diastolic").text("Stage 1 HTN").addClass("text-success");
                        $("#diastolicresult").val("Stage 1 HTN")

                    } else if (diastolic > 90) {
                        $("#Blood_Pressure_Diastolic").text("Stage 2 HTN ").addClass("text-success");
                        $("#diastolicresult").val("Stage 2 HTN")

                    }
                }
            }).trigger('change');

            /* Question_No_7_Pulse */

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
                } else {
                    $("#Question_No_7_Pulse").removeClass("bg-danger");

                }
            }).trigger('change');




            /***************** Step Three - General Apperance ****************/

            /* Question_No_8_Normal_Posture_Gait */
            $("#Question_No_8_Normal_Posture_Gait").on("keyup change", function() {
                var pocture = $(this).val();
                if (pocture == 'No') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');

            /* Question_No_9_Mental_Status */
            $("#Question_No_9_Mental_Status").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Lethargic') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');

            /* Question_No_10_Look_For_jaundice */
            $("#Question_No_10_Look_For_jaundice").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');


            /* Question_No_11_Look_For_anemia */
            $("#Question_No_11_Look_For_anemia").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            });

            /* Question_No_12_Look_For_Clubbing */
            $("#Question_No_12_Look_For_Clubbing").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('color', 'white', 'important');
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');


            /* Question_No_13_Look_for_Cyanosis */
            $("#Question_No_13_Look_for_Cyanosis").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('color', 'white', 'important');
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');


            /* Question_No_14_Skin */
            $("#Question_No_14_Skin").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Rash' || Formvalue == 'Allergy' || Formvalue == 'Lesion' || Formvalue ==
                    'Bruises') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');


            /* Question_No_15_Breath */
            $("#Question_No_15_Breath").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Bad Breath') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');



            /*************** Step Four -  Inspect Hygiene ******************************/


            /* Question_No_16_Nails */
            $("#Question_No_16_Nails").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Dirty') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');

            /*Question_No_17_Uniform_or_shoes*/
            $("#Question_No_17_Uniform_or_shoes").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Untidy') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');


            /* Question_No_18_Lice_nits*/
            $("#Question_No_18_Lice_nits").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');


            /*Question_No_19_Discuss_hygiene_routines_and_practices*/
            $("#Question_No_19_Discuss_hygiene_routines_and_practices").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'not-aware') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');


            /********************** Step Five - Head and Neck Examination **********************/


            $("#Question_No_20_Hair_and_Scalp").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Color-faded') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            });


            $("#Question_No_21_Any_Hair_Problem").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Kinky' || Formvalue == 'Brittle' || Formvalue == 'Dry') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            });


            $("#Question_No_22_Sclap").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Scaly' || Formvalue == 'Dry' || Formvalue == 'Moist') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            });


            $("#Question_No_23_Hair_distribution").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Patchy' || Formvalue == 'Receding' || Formvalue == 'Receding_Hair_Line') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            });


            /********************** Step Six - Eye Examination **********************/


            $("#Question_No_25_Normal_ocular_alignment").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');


            $("#Question_No_26_Normal_eye_inspection").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');

            $("#Question_No_27_Normal_Color_vision").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');

            $("#Question_No_28_Nystagmus").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');


            /************** Step Seven - Ears ***************/


            $("#Question_No_29_Normal_ears_shape_and_position").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');

            $("#Question_No_30_Ear_examination").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Ear wax' || Formvalue == 'Canal infection') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');

            $("#Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'right_ear_conductive_hearing_loss' || Formvalue ==
                    'left_ear_conductive_hearing_loss' || Formvalue ==
                    'right_ear_sensorineural_hearing_loss' || Formvalue ==
                    'left_ear_sensorineural_hearing_loss') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');

            /************** Step Eight - Nose ***************/


            $("#Question_No_32_External_nasal_examinaton").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Normal' || Formvalue == 'normal' || Formvalue == '') {

                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                } else {


                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                }

            }).trigger('change');

            $("#Question_No_33_perform_a_nasal_patency_test")
                .on("keyup change", function() {
                    var Formvalue = $(this).val();

                    if (Formvalue == 'Normal' || Formvalue == 'normal' || Formvalue == '') {

                        this.style.setProperty('background-color', 'white', 'important');
                        this.style.setProperty('color', 'black', 'important');

                    } else {


                        this.style.setProperty('background-color', 'red', 'important');
                        this.style.setProperty('color', 'white', 'important');

                    }


                }).trigger('change');



            /************** Step Nine -  Oral******************/

            $("#Question_No_34_Assess_gingiva").on("keyup change", function() {
                var Formvalue = $(this).val();

                if (Formvalue == 'Normal' || Formvalue == 'normal' || Formvalue == '') {

                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                } else {


                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                }


            }).trigger('change');
            $("#Question_No_35_Are_there_dental_caries").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');



            /******* Step Ten - Throat- *******/


            $("#Question_No_36_Examine_tonsils").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Tonsillitis') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');



            $("#Question_No_37_Normal_Speech_development").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            /* Question No.38: Any Neck swelling */

            $("#Question_No_38_Any_Neck_swelling").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                    $(".Specify_Any_Neck_swelling").removeClass('d-none');

                } else {

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                    $(".Specify_Any_Neck_swelling").addClass('d-none');
                    $("#Specify_Any_Neck_swelling").val("");


                }

            }).trigger('change');


            /* Question No.39: Examine lymph node */
            $("#Question_No_39_Examine_lymph_node").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'abnormal') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');


                    $(".Specify_lymph_node").removeClass('d-none');


                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                    $(".Specify_lymph_node").addClass('d-none');
                    $("#Specify_lymph_node").val("");
                }

            }).trigger('change');



            /*******  Step Eleven - Chest  *******/


            $("#Question_No_40_Any_visible_chest_deformity").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#Question_No_41_Lung_Auscultation").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Ronchi' || Formvalue == 'Vesicular_Breathing' || Formvalue == '') {

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                } else {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');
                }

            }).trigger('change');


            $("#Question_No_42_Cardiac_Auscultation").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Murmur') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');



            /*********** Step Twelve - Abdomen **************/

            $("#Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen").on(
                "keyup change",
                function() {
                    var Formvalue = $(this).val();
                    if (Formvalue == 'Normal' || Formvalue == 'normal' || Formvalue == '') {

                        this.style.setProperty('color', 'black', 'important');
                        this.style.setProperty('background-color', 'white', 'important');

                    } else {

                        this.style.setProperty('background-color', 'red', 'important');
                        this.style.setProperty('color', 'white', 'important');

                    }

                }).trigger('change');

            $("#Question_No_44_Any_history_of_abdominal_Pain").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                    $(".any_history_of_abdominal_pain_specify").removeClass('d-none');
                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                    $(".any_history_of_abdominal_pain_specify").addClass('d-none');
                    $("#any_history_of_abdominal_pain_specify").val("");

                }

            }).trigger('change');



            /******* Step Thirteen - Musculoskeletal ********/
            $("#Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination")
                .on("keyup change", function() {
                    var Formvalue = $(this).val();
                    if (Formvalue == 'Yes' || Formvalue == 'yes') {
                        this.style.setProperty('background-color', 'red', 'important');
                        this.style.setProperty('color', 'white', 'important');

                        $('.Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination')
                            .removeClass('d-none');



                    } else {
                        this.style.setProperty('color', 'black', 'important');
                        this.style.setProperty('background-color', 'white', 'important');

                        $('.Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination')
                            .addClass('d-none');
                        $("#Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination")
                            .val("");



                    }

                }).trigger('change');


            $("#Question_No_46_Spinal_curvature_assessment_tick_positive_finding").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Normal' || Formvalue == 'normal' || Formvalue == '') {

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                } else {


                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');
                }

            }).trigger('change');


            $("#Question_No_47_side_to_side_curvature_in_the_spine_resembling").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Normal' || Formvalue == 'normal' || Formvalue == '') {

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                } else {


                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');
                }

            }).trigger('change');




            $("#Question_No_48_Adams_forward_bend_test").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Positive' || Formvalue == 'positive') {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');



            $("#Question_No_49_Any_foot_or_toe_abnormalities").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Normal' || Formvalue == 'normal' || Formvalue == '') {

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                } else {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                }

            }).trigger('change');


            /******* Step Fourteen - Vaccination ********/


            $('#Question_No_50_Have_EPI_immunization_card').on('keyup change', function() {

                var result = $(this).val();


                if (result === 'Yes') {

                    $('.Reason_of_not_being_vaccinated').addClass('d-none');
                    $('#Reason_of_not_being_vaccinated').val('');

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                } else if (result === 'No') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                    $('.Reason_of_not_being_vaccinated').removeClass('d-none');
                } else {


                    $('.Reason_of_not_being_vaccinated').addClass('d-none');
                    $('#Reason_of_not_being_vaccinated').val('');

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                }



            }).trigger('change');


            /*******  Step Fifteen - Miscellaneous  ********/



            $("#Question_No_55_Do_you_have_any_Allergies").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                    $(".Do_you_have_any_allergies_specify").removeClass('d-none');


                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                    $(".Do_you_have_any_allergies_specify").addClass('d-none');
                    $("#Do_you_have_any_allergies_specify").val('');

                }

            }).trigger('change');


            $('#Question_No_56_Girls_above_8_years_old_ask').on('change', function() {
                var result = $(this).val();
                if (result === 'none_of_the_above') {
                    $('.menarche_age_specify').removeClass('d-none');
                    $(".menstrual_abnormality option[value='']").attr('selected', 'selected');

                } else {
                    $('.menarche_age_specify').addClass('d-none');
                    $('.menstrual_abnormality_specify').addClass('d-none');

                }
            }).trigger('change');


            $("#Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination")
                .on("keyup change", function() {
                    var Formvalue = $(this).val();

                    if (Formvalue == 'No urinary issues reported' || Formvalue == '') {

                        this.style.setProperty('color', 'black', 'important');
                        this.style.setProperty('background-color', 'white', 'important');

                    } else {


                        this.style.setProperty('background-color', 'red', 'important');
                        this.style.setProperty('color', 'white', 'important');
                    }

                }).trigger('change');



            $("#QuestionNo_58_Any_menstrual_abnormality").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                    $('.Any_menstrual_abnormality_specify').removeClass('d-none');



                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                    $('.Any_menstrual_abnormality_specify').addClass('d-none');

                    $("#Any_menstrual_abnormality_specify").val("");

                }

            }).trigger('change');



            /*********** Step Sixteen - Psychological ***************/


            // Function to set data-value attributes for option elements
            function setDataValueForOptions() {

                $('.PsychologicalSelectedAttribute').each(function() {
                    // Get the ID of the current select box
                    const selectId = $(this).attr('id');

                    // Check if the ID exists in the mapping object
                    if (dataOptionsAttributes[selectId]) {
                        // Loop through each option and add data-value
                        $(this).find('option').each(function() {
                            const optionValue = $(this).val();
                            if (dataOptionsAttributes[selectId][optionValue]) {
                                // Set the data-value attribute
                                $(this).attr('data-value', dataOptionsAttributes[selectId][
                                    optionValue
                                ]);
                            }
                        });
                    }



                });


            }

            // Initialize the data-value attributes on document ready
            setDataValueForOptions();



            $('.PsychologicalSelectedAttribute').change(function() {

                let selectedValues = [];
                // Iterate over each select box with the class PsychologicalSelectedAttribute
                $('.PsychologicalSelectedAttribute').each(function() {
                    // Get the selected value
                    let value = $(this).find(':selected').attr('data-value');
                    // Only append if a value is selected
                    if (value) {
                        selectedValues.push(value);
                    }
                });

                // console.log("selectedValues.join(',')", selectedValues.join(','));


                $("[name='psychological_comment']").val(selectedValues.join(','));


            }).trigger('change');


            $("#observation1").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#observation2").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#observation3").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#observation4").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#observation5").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#observation6").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#observation7").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#observation8").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#observation9").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            $("#observation10").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger('change');






            /*************** Step Seventeen - Nutritionist *************/

            /* Function to capitalize the first letter of a string */
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            /* Question_No_60_How_would_you_describe_your_lifestyle */
            $('#Question_No_60_How_would_you_describe_your_lifestyle').change(
                function() {


                    var age = $("#age").val();


                    var gender = $("#gender").val();



                    var gender = capitalizeFirstLetter(gender);




                    var selectedValue = $(this).val();



                    var Question_No_60_How_would_you_describe_your_lifestyle = document.getElementById(
                        "Question_No_60_How_would_you_describe_your_lifestyle");

                    if (selectedValue === 'Sedentary') {


                        Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty(
                            'background-color', 'red', 'important');
                        Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty('color', 'white',
                            'important');



                        // Filter the options based on the specified attributes
                        var matchingOption = $('#Daily_energy_requirement1 option').filter(function() {
                            return Math.round(parseFloat($(this).attr('age'))) === Math.round(age) &&
                                $(this).attr('gender') === gender;
                        });

                        /*console.log('matchingOption.length', matchingOption.length);*/

                        // Check if any matching option was found and log the value of the moderate attribute
                        if (matchingOption.length) {
                            var sedentary = matchingOption.attr('sedentary');

                            /*console.log('sedentary:', sedentary);*/

                            var energychartID = matchingOption.attr('id');
                            /*console.log('energychartID:', energychartID);*/
                            $("#Daily_energy_requirement1").val(energychartID).attr('readonly', true);

                            $("#Daily_energy_requirement").val(sedentary).attr('readonly', true);

                        } else {

                            $("#Daily_energy_requirement").val('').attr('readonly', false);

                        }



                    } else if (selectedValue === 'Moderately') {


                        Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty(
                            'background-color', 'yellow', 'important');
                        Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty('color', 'black',
                            'important');


                        // Filter the options based on the specified attributes
                        var matchingOption = $('#Daily_energy_requirement1 option').filter(function() {
                            return Math.round(parseFloat($(this).attr('age'))) === Math.round(age) &&
                                $(this).attr('gender') === gender;
                        });

                        /*console.log('matchingOption.length', matchingOption.length);*/

                        // Check if any matching option was found and log the value of the moderate attribute
                        if (matchingOption.length) {
                            var moderate = matchingOption.attr('moderate');
                            /* console.log('moderate:', moderate);*/

                            $("#Daily_energy_requirement").val(moderate).attr('readonly', true);

                            var energychartID = matchingOption.attr('id');
                            /*console.log('energychartID:', energychartID);*/
                            $("#Daily_energy_requirement1").val(energychartID).attr('readonly', true);


                        } else {

                            $("#Daily_energy_requirement").val('').attr('readonly', false);

                        }




                    } else if (selectedValue === 'Active') {


                        Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty(
                            'background-color', 'green', 'important');
                        Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty('color', 'white',
                            'important');


                        // Filter the options based on the specified attributes
                        var matchingOption = $('#Daily_energy_requirement1 option').filter(function() {
                            return Math.round(parseFloat($(this).attr('age'))) === Math.round(age) &&
                                $(this).attr('gender') === gender;
                        });

                        /*console.log('matchingOption.length', matchingOption.length);*/


                        // Check if any matching option was found and log the value of the moderate attribute
                        if (matchingOption.length) {
                            var activela = matchingOption.attr('activela');
                            /* console.log('activela', activela);*/

                            $("#Daily_energy_requirement").val(activela).attr('readonly', true);

                            var energychartID = matchingOption.attr('id');
                            /*console.log('energychartID:', energychartID);*/
                            $("#Daily_energy_requirement1").val(energychartID).attr('readonly', true);


                        } else {

                            $("#Daily_energy_requirement").val('').attr('readonly', false);

                        }



                    } else {

                        Question_No_60_How_would_you_describe_your_lifestyle.style.removeProperty(
                            'background-color');
                        Question_No_60_How_would_you_describe_your_lifestyle.style.removeProperty('color');
                        $("#Daily_energy_requirement").val('').attr('readonly', false);


                    }
                }).trigger("change");


            /* Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day*/
            $('#Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day').change(function() {
                var selectedValue = $(this).val();



                if (selectedValue === '< 4') {

                    // this.style.removeProperty('background-color');
                    // this.style.removeProperty('color');

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else if (selectedValue === '6-8') {

                    this.style.setProperty('background-color', 'green', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else if (selectedValue === '4-6') {

                    this.style.setProperty('background-color', 'yellow', 'important');
                    this.style.setProperty('color', 'black', 'important');

                } else {

                    // this.style.setProperty('background-color', 'red', 'important');
                    // this.style.setProperty('color', 'white', 'important');

                    this.style.removeProperty('background-color');
                    this.style.removeProperty('color');
                }
            }).trigger("change");


            /* Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to */

            $('#Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to').change(
                function() {


                    var selectedValue = $(this).val();

                    var addiction = document.getElementById("addiction");
                    const otherAddictionContainer = document.getElementById('otherAddictionContainer');

                    if (selectedValue === 'Yes') {


                        addiction.style.setProperty('background-color', 'red', 'important');
                        addiction.style.setProperty('color', 'white', 'important');
                        addictionContainer.classList.remove('d-none');

                        otherAddictionContainer.classList.remove('d-none');
                        $("#addiction").attr("required", true);

                    } else {

                        addiction.style.removeProperty('background-color');
                        addiction.style.removeProperty('color');
                        otherAddictionContainer.classList.add('d-none');
                        addictionContainer.classList.add('d-none');
                        $("#addiction").attr("required", false);



                    }
                }).trigger("change");


            /* food_allergies */
            $('#food_allergies').change(function() {


                var selectedValue = $(this).val();

                var other_food_allergies = document.getElementById("other_food_allergies");

                if (selectedValue === 'Yes') {


                    other_food_allergies.style.setProperty('background-color', 'red', 'important');
                    other_food_allergies.style.setProperty('color', 'white', 'important');

                } else {

                    other_food_allergies.style.removeProperty('background-color');
                    other_food_allergies.style.removeProperty('color');

                }
            }).trigger("change");


            /* meals*/
            $('#meals').change(function() {
                var selectedValue = $(this).val();

                if (selectedValue === "1") {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {

                    this.style.removeProperty('background-color');
                    this.style.removeProperty('color');
                }
            }).trigger("change");


            $('#Follow_up_Required').on('change', function() {
                var selectedValue = $(this).val();

                if (selectedValue === "Yes") {

                    $('#follow_up_show').removeClass('d-none');
                    $("#Reason_for_Follow_up").attr('required', true);
                    $("#Follow_up_Date").attr('required', false);

                    $('.refer_to_form_row').removeClass('d-none');
                    $("#refer_to").attr('required', true);


                } else {


                    $('.refer_to_form_row').addClass('d-none');
                    $("#refer_to").attr('required', false);
                    $("#refer_to").val('');


                    $('#follow_up_show').addClass('d-none');
                    $("#Reason_for_Follow_up").attr('required', false);
                    $("#Follow_up_Date").attr('required', false);
                    $("#Reason_for_Follow_up").val('');
                    $("#Follow_up_Date").val('');

                }
            }).trigger("change");




            /* lifestyle */

            $('#lifestyle').change(function() {


                var selectedValue = $(this).val();

                var lifestyle = document.getElementById("lifestyle");

                if (selectedValue === 'Sedentary') {


                    lifestyle.style.setProperty('background-color', 'red', 'important');
                    lifestyle.style.setProperty('color', 'white', 'important');

                } else {

                    lifestyle.style.removeProperty('background-color');
                    lifestyle.style.removeProperty('color');

                }
            }).trigger("change");


            /* food_items*/
            $('#food_items').change(function() {
                var selectedValue = $(this).val();


                if (selectedValue === "0-1") {

                    this.style.setProperty('background-color', 'green', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else if (selectedValue === "1-2") {

                    this.style.setProperty('background-color', 'yellow', 'important');
                    this.style.setProperty('color', 'black', 'important');

                } else if (selectedValue === "3 or more") {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {

                    this.style.removeProperty('background-color');
                    this.style.removeProperty('color');
                }
            }).trigger("change");


            /* fast_food*/
            $('#fast_food').change(function() {
                var selectedValue = $(this).val();


                if (selectedValue === "0-1") {

                    this.style.setProperty('background-color', 'green', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else if (selectedValue === "< 1") {

                    this.style.setProperty('background-color', 'green', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else if (selectedValue === "1-2") {

                    this.style.setProperty('background-color', 'yellow', 'important');
                    this.style.setProperty('color', 'black', 'important');

                } else if (selectedValue === "3 or more") {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {

                    this.style.removeProperty('background-color');
                    this.style.removeProperty('color');
                }
            }).trigger("change");


            function updateEventColor(referToValue) {
                var color;
                var textColor = 'black';

                switch (referToValue) {
                    case '1': // Psychologist
                        color = 'blue';
                        textColor = 'white';
                        break;
                    case '2': // Nutritionist
                        color = 'green';
                        textColor = 'white';
                        break;
                    case '3': // Physician
                        color = 'red';
                        textColor = 'white';
                        break;
                    default:
                        color = 'white'; // Default background color
                        textColor = 'black'; // Default text color
                        break;
                }



                $('#refer_to').attr('style',
                    `background-color: ${color} !important; color: ${textColor} !important;`);

            }

            // Set the initial color based on the current selected value
            var initialReferToValue = $('#refer_to').val();
            // updateEventColor(initialReferToValue);

            // Update the color whenever the dropdown value changes
            // $('#refer_to').on('change', function() {
            //     var selectedValue = $(this).val();
            //     updateEventColor(selectedValue);
            // });


            $("#refer_to").select2({
                placeholder: "Refer To",
                allowClear: true
            });



            $('#followup_required').on('change', function() {
                var result = $(this).val();
                if (result === 'Yes') {
                    $('.reffered').removeClass('d-none');
                    $(".reffered option[value='']").attr('selected', 'selected');
                    $('#referred_by').prop('required', true);

                } else {
                    $('#referred_by').val('');
                    $('.reffered').addClass('d-none');
                    $('#referred_by').prop('required', false);

                }
            }).trigger("change");



            $('.prevStep').click(function() {
                var currentStep = $(this).closest('.step');
                var prevStep = currentStep.prev('.step');

                // Move to the previous step
                currentStep.removeClass('active');
                prevStep.addClass('active');
            });

            $('.form-group').on('blur change', '.error-border', function() {
                if ($(this).val()) {
                    $(this).removeClass('error-border').closest('.form-group').find('.error-text').remove();
                }
            })












            /****** Next Step ******/
            $('.nextStep').on('click', function(e) {



                const currentStep = $('.step.active'); // Get the current active step

                const currentStepNumber = $('.step').index(currentStep) +
                    1; // Get the 1-based index of the active step
                console.log("Current Step Number:", currentStepNumber);

                // const currentStepFields = $('.step.active :input[required]');
                const currentStepFields = currentStep.find(
                    ':input[required]'); // Get required inputs in the current step

                let isValid = true;
                currentStepFields.each(function() {
                    // Clear previous errors
                    $(this)
                        .removeClass('error-border')
                        .closest('.form-group')
                        .find('.error-text')
                        .remove();

                    if (!this.checkValidity()) {

                        e.preventDefault(); // Prevent form submission

                        // Focus on the first invalid field
                        $(this).focus();

                        // Add error styling and message
                        $(this)
                            .addClass('error-border') // Add a red border to indicate the error
                            .closest(
                                '.form-group') // Target the parent form group for better layout
                            .append(
                                '<small class="text-danger error-text">This field is required</small>'
                            );

                        isValid = false; // Mark the form as invalid
                        return false; // Stop further validation on the first invalid field
                    }
                });

                if (!isValid) {

                    console.log("HERE 2");
                    return false;
                }



                // Proceed with submission if valid
                // $('#multiStepForm').submit();

                var submitBtn = $(this);
                $(this).text('Processing...').attr('disabled', false);

                var form = $('#multiStepForm');

                var formData = $('#multiStepForm').serializeArray();
                console.log("formData " + formData);

                const activeStepData = currentStep.find(':input').serializeArray();
                console.log("Active Step Data:", activeStepData);

                let _token = $('meta[name="csrf-token"]').attr('content');


                $.ajax({
                    type: "post",
                    url: "{{ route('CreateScreening') }}",
                    data: {
                        _token: _token,
                        currentStepNumber: currentStepNumber,
                        formData: activeStepData,
                        updateID: $("input[name='updateID']").val(),
                        screeningFormId: $("input[name='screeningFormId']").val()


                    },
                    dataType: "json",
                    beforeSend: function() {

                    },
                    success: function(response) {
                        // alert(response);
                        console.log(response);
                        console.log(response.status);
                        console.log(response.storedRecordId);

                        if (response.status) {

                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                timer: 1000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then(() => {

                                let redirectUrl;
                                // var userRole = "{!! auth()->guard('admin')->user()->role !!}";
                                var userRole = parseInt("{!! auth()->guard('admin')->user()->role !!}");
                                if (userRole == 1) {
                                    redirectUrl = "{{ route('Screening') }}";
                                } else if (userRole == 2) {
                                    redirectUrl = "{{ route('user_form_data') }}";
                                } else {
                                    redirectUrl =
                                        "{{ route('Screening') }}";
                                }


                                /*  Step Seventeen - Nutritionist */
                                if (currentStepNumber === 17 && $(
                                        "input[name='screeningFormId']").val() == 0) {

                                    redirectUrl = "{{ route('Screening') }}";

                                    window.location.href = redirectUrl;
                                } else if (currentStepNumber === 17 && $(
                                        "input[name='screeningFormId']").val() > 0) {

                                    redirectUrl = "{{ route('Details') }}/" + $(
                                        "input[name='screeningFormId']").val();

                                    window.location.href = redirectUrl;
                                }

                                $("input[name='updateID']").val(response
                                    .storedRecordId);

                                // window.location.href = redirectUrl;

                                console.log("redirectUrl " + redirectUrl);

                                currentStep.removeClass('active').addClass('completed');
                                currentStep.next('.step').addClass('active');

                                submitBtn.text('Next').attr('disabled', false);


                            });

                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                timer: 5000, // Set the timer to 5 seconds
                                timerProgressBar: true, // Show a progress bar during the timer
                                showConfirmButton: false // Hide the "OK" button
                            });



                            if (currentStepNumber < 17) {


                                submitBtn.text('Next').attr('disabled', false);


                            } else {

                                submitBtn.text('Submit').attr('disabled', false);

                            }


                        }

                    },
                    error: function(err) {
                        console.log(err);

                        Swal.fire({
                            title: 'Error!',
                            text: 'An unexpected error occurred. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            timer: 5000, // Auto-close after 5 seconds
                            timerProgressBar: true, // Show a progress bar during the timer
                            showConfirmButton: true // Keep the "OK" button visible
                        });

                        submitBtn.text('Submit').attr('disabled', false);

                    }
                });


            });






        });
    </script>
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
