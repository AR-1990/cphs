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
        .screener .title {
            font-size: 1.75rem;
            font-weight: 500;
            color: #070707;
        }

        .screener .subTitle {
            font-size: 1.5rem;
            font-weight: 500;
            color: #070707;
        }

        .screener p {
            font-size: 1rem;
            font-weight: 400;
            color: #000;
        }

        .screener-fields {
            gap: 1.5rem 0;
        }

        .screener-field label {
            font-size: 1rem;
            font-weight: 500;
            color: #000;
            margin-bottom: 0.5rem;
        }

        .screener-field select {
            width: 100%;
            padding: 0.5rem 0.75rem;
            background-color: #e9ecef;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: .25rem;
            box-shadow: inset 0 1px 1px rgba(39, 44, 51, .075);
        }
        
        .text-area textarea {
            width: 100%;
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
                                    {{ (isset($_GET['class']) && $_GET['class'] === '0') || (isset($details['class']) && $details['class'] === '0') || old('class') === '0' ? 'selected' : '' }}>
                                    Play group</option>
                                     <option value="0000"
                                    {{ (isset($_GET['class']) && $_GET['class'] === '0000') || (isset($details['class']) && $details['class'] === '0000') || old('class') === '0000' ? 'selected' : '' }}>
                                   Nursery</option>
                                <option value="00"
                                    {{ (isset($_GET['class']) && $_GET['class'] === '00') || (isset($details['class']) && $details['class'] === '00') || old('class') === '00' ? 'selected' : '' }}>
                                    KG-1</option>
                                <option value="000"
                                    {{ (isset($_GET['class']) && $_GET['class'] === '000') || (isset($details['class']) && $details['class'] === '000') || old('class') === '000' ? 'selected' : '' }}>
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
                            <label for="dob">Section</label>

                          <input type="text" class="form-control" id="class_section"
                                name="class_section"
                                value="{{ isset($_GET['class_section']) ? $_GET['class_section'] : (old('class_section') ?: (isset($details['class_section']) ? $details['class_section'] : '')) }}"
                                required>


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
                       <div class="form-group col-md-6 muac" id="muac-container">
                        <div class="form-group">
                            <label for="muac">Question No.62: MUAC</label><br>
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- <label for="muac">Right Eye</label> --}}
                                    <select name="muac" class="form-control muac-dropdown" id="muac_right_eye" onchange="updateMuacColor(this)">
                                        <option value="">Select MUAC</option>
                                        <option value="6-7" {{ isset($_GET['muac']) ? ($_GET['muac'] == '6-7' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '6-7' ? 'selected' : '') : (old('muac') == '6-7' ? 'selected' : '')) }}>6-7 cm</option>
                                        <option value="7.1-8" {{ isset($_GET['muac']) ? ($_GET['muac'] == '7.1-8' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '7.1-8' ? 'selected' : '') : (old('muac') == '7.1-8' ? 'selected' : '')) }}>7.1-8 cm</option>
                                        <option value="8.1-9" {{ isset($_GET['muac']) ? ($_GET['muac'] == '8.1-9' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '8.1-9' ? 'selected' : '') : (old('muac') == '8.1-9' ? 'selected' : '')) }}>8.1-9 cm</option>
                                        <option value="9.1-10" {{ isset($_GET['muac']) ? ($_GET['muac'] == '9.1-10' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '9.1-10' ? 'selected' : '') : (old('muac') == '9.1-10' ? 'selected' : '')) }}>9.1-10 cm</option>
                                        <option value="10.1-11" {{ isset($_GET['muac']) ? ($_GET['muac'] == '10.1-11' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '10.1-11' ? 'selected' : '') : (old('muac') == '10.1-11' ? 'selected' : '')) }}>10.1-11 cm</option>
                                        <option value="11.1-12" {{ isset($_GET['muac']) ? ($_GET['muac'] == '11.1-12' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '11.1-12' ? 'selected' : '') : (old('muac') == '11.1-12' ? 'selected' : '')) }}>11.1-12 cm</option>
                                        <option value="12.1-12.5" {{ isset($_GET['muac']) ? ($_GET['muac'] == '12.1-12.5' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '12.1-12.5' ? 'selected' : '') : (old('muac') == '12.1-12.5' ? 'selected' : '')) }}>12.1-12.5 cm</option>
                                        <option value="12.6-13" {{ isset($_GET['muac']) ? ($_GET['muac'] == '12.6-13' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '12.6-13' ? 'selected' : '') : (old('muac') == '12.6-13' ? 'selected' : '')) }}>12.6-13 cm</option>
                                        <option value="13.1-14" {{ isset($_GET['muac']) ? ($_GET['muac'] == '13.1-14' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '13.1-14' ? 'selected' : '') : (old('muac') == '13.1-14' ? 'selected' : '')) }}>13.1-14 cm</option>
                                        <option value="14.1-15" {{ isset($_GET['muac']) ? ($_GET['muac'] == '14.1-15' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '14.1-15' ? 'selected' : '') : (old('muac') == '14.1-15' ? 'selected' : '')) }}>14.1-15 cm</option>
                                        <option value="15.1-16" {{ isset($_GET['muac']) ? ($_GET['muac'] == '15.1-16' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '15.1-16' ? 'selected' : '') : (old('muac') == '15.1-16' ? 'selected' : '')) }}>15.1-16 cm</option>
                                        <option value="16.1-17" {{ isset($_GET['muac']) ? ($_GET['muac'] == '16.1-17' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '16.1-17' ? 'selected' : '') : (old('muac') == '16.1-17' ? 'selected' : '')) }}>16.1-17 cm</option>
                                        <option value="17.1-18" {{ isset($_GET['muac']) ? ($_GET['muac'] == '17.1-18' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '17.1-18' ? 'selected' : '') : (old('muac') == '17.1-18' ? 'selected' : '')) }}>17.1-18 cm</option>
                                        <option value="18.1-19" {{ isset($_GET['muac']) ? ($_GET['muac'] == '18.1-19' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '18.1-19' ? 'selected' : '') : (old('muac') == '18.1-19' ? 'selected' : '')) }}>18.1-19 cm</option>
                                        <option value="19.1-20" {{ isset($_GET['muac']) ? ($_GET['muac'] == '19.1-20' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '19.1-20' ? 'selected' : '') : (old('muac') == '19.1-20' ? 'selected' : '')) }}>19.1-20 cm</option>
                                        <option value="20.1-21" {{ isset($_GET['muac']) ? ($_GET['muac'] == '20.1-21' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '20.1-21' ? 'selected' : '') : (old('muac') == '20.1-21' ? 'selected' : '')) }}>20.1-21 cm</option>
                                        <option value="21.1-22" {{ isset($_GET['muac']) ? ($_GET['muac'] == '21.1-22' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '21.1-22' ? 'selected' : '') : (old('muac') == '21.1-22' ? 'selected' : '')) }}>21.1-22 cm</option>
                                        <option value="22.1-23" {{ isset($_GET['muac']) ? ($_GET['muac'] == '22.1-23' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '22.1-23' ? 'selected' : '') : (old('muac') == '22.1-23' ? 'selected' : '')) }}>22.1-23 cm</option>
                                        <option value="23.1-24" {{ isset($_GET['muac']) ? ($_GET['muac'] == '23.1-24' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '23.1-24' ? 'selected' : '') : (old('muac') == '23.1-24' ? 'selected' : '')) }}>23.1-24 cm</option>
                                        <option value="24.1-25" {{ isset($_GET['muac']) ? ($_GET['muac'] == '24.1-25' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '24.1-25' ? 'selected' : '') : (old('muac') == '24.1-25' ? 'selected' : '')) }}>24.1-25 cm</option>
                                        <option value="25.1-26" {{ isset($_GET['muac']) ? ($_GET['muac'] == '25.1-26' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == '25.1-26' ? 'selected' : '') : (old('muac') == '25.1-26' ? 'selected' : '')) }}>25.1-26 cm</option>
                                        <option value="N/A" {{ isset($_GET['muac']) ? ($_GET['muac'] == 'N/A' ? 'selected' : '') : (isset($details['muac']) ? ($details['muac'] == 'N/A' ? 'selected' : '') : (old('muac') == 'N/A' ? 'selected' : '')) }}>N/A</option>
                                    </select>
                                </div>
                                
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
                                name="Question_No_8_Normal_Posture_Gait">
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
                                name="Question_No_9_Mental_Status">
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
                                name="Question_No_10_Look_For_jaundice">
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

                            <select class="form-control" id="Question_No_11_Look_For_anemia" name="Question_No_11_Look_For_anemia">
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



                    <div class="form-group col-md-6 ">
                        <div class="form-group">
                            <label for="clubbing">Question No.12: Look For Clubbing</label>

                            <select class="form-control" id="Question_No_12_Look_For_Clubbing"
                                name="Question_No_12_Look_For_Clubbing">
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
                                name="Question_No_13_Look_for_Cyanosis">
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



                    <div class="form-group col-md-6 ">
                        <div class="form-group">
                            <label for="skin">Question No.14: Skin</label>

                            <select class="form-control" id="Question_No_14_Skin" name="Question_No_14_Skin">
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
                                >
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
                    <div class="form-group col-md-6 ">
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
                        <label for="Visual_acuity_using_Snellens_chart">Question No.24: Visual acuity using Snellen's
                            chart - Right Eye</label>
                        <select class="form-control" id="Question_No_24_Visual_acuity_using_Snellens_chart"
                            name="Question_No_24_Visual_acuity_using_Snellens_chart" required>
                            <option value="">Select</option>
                            <option value="20/10 (6/3) - Exceptional vision"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/10 (6/3) - Exceptional vision') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/10 (6/3) - Exceptional vision' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/10 (6/3) - Exceptional vision') ? 'selected' : '' }}>
                                20/10 (6/3) - Exceptional vision</option>
                            <option value="20/20 (6/6) - Normal visual acuity"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/20 (6/6) - Normal visual acuity') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/20 (6/6) - Normal visual acuity' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/20 (6/6) - Normal visual acuity') ? 'selected' : '' }}>
                                20/20 (6/6) - Normal visual acuity</option>
                            <option value="20/25 (6/7.5) - Slightly reduced"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/25 (6/7.5) - Slightly reduced') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/25 (6/7.5) - Slightly reduced' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/25 (6/7.5) - Slightly reduced') ? 'selected' : '' }}>
                                20/25 (6/7.5) - Slightly reduced</option>
                            <option value="20/30 (6/9) - Below average"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/30 (6/9) - Below average') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/30 (6/9) - Below average' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/30 (6/9) - Below average') ? 'selected' : '' }}>
                                20/30 (6/9) - Below average</option>
                            <option value="20/40 (6/12) - Minimum requirement for driving"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/40 (6/12) - Minimum requirement for driving') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/40 (6/12) - Minimum requirement for driving' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/40 (6/12) - Minimum requirement for driving') ? 'selected' : '' }}>
                                20/40 (6/12) - Minimum requirement for driving</option>
                            <option value="20/50 (6/15) - Mild vision impairment"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/50 (6/15) - Mild vision impairment') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/50 (6/15) - Mild vision impairment' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/50 (6/15) - Mild vision impairment') ? 'selected' : '' }}>
                                20/50 (6/15) - Mild vision impairment</option>
                            <option value="20/60 (6/18) - Blurred vision"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/60 (6/18) - Blurred vision') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/60 (6/18) - Blurred vision' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/60 (6/18) - Blurred vision') ? 'selected' : '' }}>
                                20/60 (6/18) - Blurred vision</option>
                            <option value="20/80 (6/24) - Moderate vision impairment"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/80 (6/24) - Moderate vision impairment') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/80 (6/24) - Moderate vision impairment' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/80 (6/24) - Moderate vision impairment') ? 'selected' : '' }}>
                                20/80 (6/24) - Moderate vision impairment</option>
                            <option value="20/100 (6/30) - Moderate to severe impairment"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/100 (6/30) - Moderate to severe impairment') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/100 (6/30) - Moderate to severe impairment' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/100 (6/30) - Moderate to severe impairment') ? 'selected' : '' }}>
                                20/100 (6/30) - Moderate to severe impairment</option>
                            <option value="20/125 (6/38) - Vision severely compromised"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/125 (6/38) - Vision severely compromised') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/125 (6/38) - Vision severely compromised' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/125 (6/38) - Vision severely compromised') ? 'selected' : '' }}>
                                20/125 (6/38) - Vision severely compromised</option>
                            <option value="20/160 (6/48) - Very poor distance vision"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/160 (6/48) - Very poor distance vision') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/160 (6/48) - Very poor distance vision' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/160 (6/48) - Very poor distance vision') ? 'selected' : '' }}>
                                20/160 (6/48) - Very poor distance vision</option>
                            <option value="20/200 (6/60) - Legally blind"
                                {{ (isset($_GET['Question_No_24_Visual_acuity_using_Snellens_chart']) && $_GET['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/200 (6/60) - Legally blind') || old('Question_No_24_Visual_acuity_using_Snellens_chart') == '20/200 (6/60) - Legally blind' || (isset($details['Question_No_24_Visual_acuity_using_Snellens_chart']) && $details['Question_No_24_Visual_acuity_using_Snellens_chart'] == '20/200 (6/60) - Legally blind') ? 'selected' : '' }}>
                                20/200 (6/60) - Legally blind</option>
                        </select>
                    </div>

                    <!-- Question 24B: Visual acuity using Snellen's chart - Left Eye -->
                    <div class="form-group col-md-6">
                        <label for="Visual_acuity_using_Snellens_chart_left_eye">Question No.24B: Visual acuity using Snellen's
                            chart - Left Eye</label>
                        <select class="form-control" id="Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye"
                            name="Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye" required>
                            <option value="">Select</option>
                            <option value="20/10 (6/3) - Exceptional vision"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/10 (6/3) - Exceptional vision') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/10 (6/3) - Exceptional vision' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/10 (6/3) - Exceptional vision') ? 'selected' : '' }}>
                                20/10 (6/3) - Exceptional vision</option>
                            <option value="20/20 (6/6) - Normal visual acuity"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/20 (6/6) - Normal visual acuity') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/20 (6/6) - Normal visual acuity' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/20 (6/6) - Normal visual acuity') ? 'selected' : '' }}>
                                20/20 (6/6) - Normal visual acuity</option>
                            <option value="20/25 (6/7.5) - Slightly reduced"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/25 (6/7.5) - Slightly reduced') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/25 (6/7.5) - Slightly reduced' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/25 (6/7.5) - Slightly reduced') ? 'selected' : '' }}>
                                20/25 (6/7.5) - Slightly reduced</option>
                            <option value="20/30 (6/9) - Below average"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/30 (6/9) - Below average') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/30 (6/9) - Below average' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/30 (6/9) - Below average') ? 'selected' : '' }}>
                                20/30 (6/9) - Below average</option>
                            <option value="20/40 (6/12) - Minimum requirement for driving"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/40 (6/12) - Minimum requirement for driving') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/40 (6/12) - Minimum requirement for driving' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/40 (6/12) - Minimum requirement for driving') ? 'selected' : '' }}>
                                20/40 (6/12) - Minimum requirement for driving</option>
                            <option value="20/50 (6/15) - Mild vision impairment"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/50 (6/15) - Mild vision impairment') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/50 (6/15) - Mild vision impairment' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/50 (6/15) - Mild vision impairment') ? 'selected' : '' }}>
                                20/50 (6/15) - Mild vision impairment</option>
                            <option value="20/60 (6/18) - Blurred vision"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/60 (6/18) - Blurred vision') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/60 (6/18) - Blurred vision' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/60 (6/18) - Blurred vision') ? 'selected' : '' }}>
                                20/60 (6/18) - Blurred vision</option>
                            <option value="20/80 (6/24) - Moderate vision impairment"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/80 (6/24) - Moderate vision impairment') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/80 (6/24) - Moderate vision impairment' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/80 (6/24) - Moderate vision impairment') ? 'selected' : '' }}>
                                20/80 (6/24) - Moderate vision impairment</option>
                            <option value="20/100 (6/30) - Moderate to severe impairment"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/100 (6/30) - Moderate to severe impairment') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/100 (6/30) - Moderate to severe impairment' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/100 (6/30) - Moderate to severe impairment') ? 'selected' : '' }}>
                                20/100 (6/30) - Moderate to severe impairment</option>
                            <option value="20/125 (6/38) - Vision severely compromised"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/125 (6/38) - Vision severely compromised') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/125 (6/38) - Vision severely compromised' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/125 (6/38) - Vision severely compromised') ? 'selected' : '' }}>
                                20/125 (6/38) - Vision severely compromised</option>
                            <option value="20/160 (6/48) - Very poor distance vision"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/160 (6/48) - Very poor distance vision') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/160 (6/48) - Very poor distance vision' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/160 (6/48) - Very poor distance vision') ? 'selected' : '' }}>
                                20/160 (6/48) - Very poor distance vision</option>
                            <option value="20/200 (6/60) - Legally blind"
                                {{ (isset($_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $_GET['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/200 (6/60) - Legally blind') || old('Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye') == '20/200 (6/60) - Legally blind' || (isset($details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']) && $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] == '20/200 (6/60) - Legally blind') ? 'selected' : '' }}>
                                20/200 (6/60) - Legally blind</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
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
                        <label for="Normal_color_vision ">Question No.27: Normal color vision</label>
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
                            Conclusion of hearing test with Rinne and Weber</label>
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
                                <option value="Rhonchi"
                                    {{ (isset($_GET['Question_No_41_Lung_Auscultation']) && $_GET['Question_No_41_Lung_Auscultation'] == 'Rhonchi') || old('Question_No_41_Lung_Auscultation') == 'Rhonchi' || (isset($details['Question_No_41_Lung_Auscultation']) && $details['Question_No_41_Lung_Auscultation'] == 'Rhonchi') ? 'selected' : '' }}>
                                    Rhonchi
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

                    <div class="form-group col-md-6 ">
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
                            <option value="Never Had Any Vaccination"
                                {{ (isset($_GET['Question_No_50_Have_EPI_immunization_card']) && $_GET['Question_No_50_Have_EPI_immunization_card'] == 'Never Had Any Vaccination') || old('Question_No_50_Have_EPI_immunization_card') == 'Never Had Any Vaccination' || (isset($details['Question_No_50_Have_EPI_immunization_card']) && $details['Question_No_50_Have_EPI_immunization_card'] == 'Never Had Any Vaccination') ? 'selected' : '' }}>
                               Never Had Any Vaccination
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
                    <div class="form-group col-md-6 d-none for18">
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
                            >
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
                    <div class="form-group col-md-6 d-none for18">
                        <label for="QuestionNo_58_Any_menstrual_abnormality">Question No.58: Any menstrual
                            abnormality</label>
                        <select class="form-control" id="QuestionNo_58_Any_menstrual_abnormality"
                            name="QuestionNo_58_Any_menstrual_abnormality" >
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


            <!-- Step Sixteen - Lead Exposure -->
            <div class="step" id="step16">
                <h3>Lead Exposure</h3>
                <div class="form-row">
                    <!-- Question 48 -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_48_Frequently_put_things_in_mouth">Question No. 48: Do you Frequently put things in his/her mouth such as toys, jewelery , or keys?</label>
                        <select class="form-control" id="Question_No_48_Frequently_put_things_in_mouth"
                            name="Question_No_48_Frequently_put_things_in_mouth" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ isset($details['Question_No_48_Frequently_put_things_in_mouth']) && $details['Question_No_48_Frequently_put_things_in_mouth'] == 'Yes' ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ isset($details['Question_No_48_Frequently_put_things_in_mouth']) && $details['Question_No_48_Frequently_put_things_in_mouth'] == 'No' ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Question 49 -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_49_Child_eat_non_food_items_pica">Question No.49: Does your child eat non-food items(pica)?</label>
                        <select class="form-control" id="Question_No_49_Child_eat_non_food_items_pica"
                            name="Question_No_49_Child_eat_non_food_items_pica" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ isset($details['Question_No_49_Child_eat_non_food_items_pica']) && $details['Question_No_49_Child_eat_non_food_items_pica'] == 'Yes' ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ isset($details['Question_No_49_Child_eat_non_food_items_pica']) && $details['Question_No_49_Child_eat_non_food_items_pica'] == 'No' ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Question 50 -->
                    <div class="form-group col-md-12">
                        <label for="Question_No_50_Contact_adult_job_lead_exposure">Question No. 50: Do you frequently come in contact with an adult whose job involves exposure to lead?</label>
                        <select class="form-control" id="Question_No_50_Contact_adult_job_lead_exposure"
                            name="Question_No_50_Contact_adult_job_lead_exposure" required>
                            <option value="">Select</option>
                            <option value="Electronic Repair"
                                {{ isset($details['Question_No_50_Contact_adult_job_lead_exposure']) && $details['Question_No_50_Contact_adult_job_lead_exposure'] == 'Electronic Repair' ? 'selected' : '' }}>
                                Electronic Repair
                            </option>
                            <option value="Jewelry or pottery making"
                                {{ isset($details['Question_No_50_Contact_adult_job_lead_exposure']) && $details['Question_No_50_Contact_adult_job_lead_exposure'] == 'Jewelry or pottery making' ? 'selected' : '' }}>
                                Jewelry or pottery making
                            </option>
                            <option value="Construction"
                                {{ isset($details['Question_No_50_Contact_adult_job_lead_exposure']) && $details['Question_No_50_Contact_adult_job_lead_exposure'] == 'Construction' ? 'selected' : '' }}>
                                Construction
                            </option>
                            <option value="Auto Repair"
                                {{ isset($details['Question_No_50_Contact_adult_job_lead_exposure']) && $details['Question_No_50_Contact_adult_job_lead_exposure'] == 'Auto Repair' ? 'selected' : '' }}>
                                Auto Repair
                            </option>
                            <option value="Welding"
                                {{ isset($details['Question_No_50_Contact_adult_job_lead_exposure']) && $details['Question_No_50_Contact_adult_job_lead_exposure'] == 'Welding' ? 'selected' : '' }}>
                                Welding
                            </option>
                            <option value="House painting"
                                {{ isset($details['Question_No_50_Contact_adult_job_lead_exposure']) && $details['Question_No_50_Contact_adult_job_lead_exposure'] == 'House painting' ? 'selected' : '' }}>
                                House painting
                            </option>
                            <option value="Plumbing"
                                {{ isset($details['Question_No_50_Contact_adult_job_lead_exposure']) && $details['Question_No_50_Contact_adult_job_lead_exposure'] == 'Plumbing' ? 'selected' : '' }}>
                                Plumbing
                            </option>
                            <option value="Renovation"
                                {{ isset($details['Question_No_50_Contact_adult_job_lead_exposure']) && $details['Question_No_50_Contact_adult_job_lead_exposure'] == 'Renovation' ? 'selected' : '' }}>
                                Renovation
                            </option>
                             <option value="None of above"
                                {{ isset($details['Question_No_50_Contact_adult_job_lead_exposure']) && $details['Question_No_50_Contact_adult_job_lead_exposure'] == 'None of above' ? 'selected' : '' }}>
                                None of above
                            </option>
                        </select>
                    </div>

                    <!-- Question 51 -->
                    <div class="form-group col-md-12">
                        <label for="Question_No_51_Contact_adult_hobby_lead_exposure">Question No. 51: Do you frequently come in contact with an adult whose hobby involves exposure to lead?</label>
                        <select class="form-control" id="Question_No_51_Contact_adult_hobby_lead_exposure"
                            name="Question_No_51_Contact_adult_hobby_lead_exposure" required>
                            <option value="">Select</option>
                            <option value="Making Stained Glass"
                                {{ isset($details['Question_No_51_Contact_adult_hobby_lead_exposure']) && $details['Question_No_51_Contact_adult_hobby_lead_exposure'] == 'Making Stained Glass' ? 'selected' : '' }}>
                                Making Stained Glass
                            </option>
                            <option value="Pottery"
                                {{ isset($details['Question_No_51_Contact_adult_hobby_lead_exposure']) && $details['Question_No_51_Contact_adult_hobby_lead_exposure'] == 'Pottery' ? 'selected' : '' }}>
                                Pottery
                            </option>
                            <option value="Firearm making"
                                {{ isset($details['Question_No_51_Contact_adult_hobby_lead_exposure']) && $details['Question_No_51_Contact_adult_hobby_lead_exposure'] == 'Firearm making' ? 'selected' : '' }}>
                                Firearm making
                            </option>
                            <option value="Collecting lead"
                                {{ isset($details['Question_No_51_Contact_adult_hobby_lead_exposure']) && $details['Question_No_51_Contact_adult_hobby_lead_exposure'] == 'Collecting lead' ? 'selected' : '' }}>
                                Collecting lead
                            </option>
                            <option value="None of the above"
                                {{ isset($details['Question_No_51_Contact_adult_hobby_lead_exposure']) && $details['Question_No_51_Contact_adult_hobby_lead_exposure'] == 'None of the above' ? 'selected' : '' }}>
                                None of the above
                            </option>
                        </select>
                    </div>
 <div class="form-group col-md-12">
                        <label for="expouser_result">Lead Exposure Result</label>
                        <div>
                            <input type="text" class="form-control" id="expouser_result" name="expouser_result"  value="{{ isset($details['expouser_result']) ? $details['expouser_result'] : '' }}" readonly>
                        </div>
                    </div>
                    <!-- Comment -->
                    <div class="form-group col-md-12">
                        <label for="lead_exposure_comment">Comment/Findings</label>
                        <textarea name="lead_exposure_comment" id="lead_exposure_comment" class="form-control" placeholder="Comment here" cols="50">{{ isset($_GET['lead_exposure_comment']) ? $_GET['lead_exposure_comment'] : (isset($details['lead_exposure_comment']) ? $details['lead_exposure_comment'] : old('lead_exposure_comment')) }}</textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Seventeen - Psychological -->
            <div class="step mb-5" id="step17">
                <div class="screener " id="pre_primary">
                    <h3 class="title">PRE-PRIMARY PSYCHOLOGICAL SCREENER</h3>

                    <div >
                        <h4 class="subTitle mt-3">DEVELOPMENTAL SCREENING</h4>
                        <div id="playgound_developmenr" class="d-none">
                            <ul>
                                <li><strong>Age:</strong> 12–24.9 Months</li>
                                <li><strong>Grade:</strong> Play Group</li>
                            </ul>
                            <p>
                                <strong class="d-block">Instructions:</strong>
                                Read each statement carefully and select the answer that best describes your child’s behavior
                                during the <strong>last 30 days.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                           <strong> Cognitive:  </strong>  Does your child try to solve problems, like figuring out how to get a toy from a
                                            box?
                                        </label>
                                        <select name="QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box" class="playground-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'Yes') || old('QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box') == 'Yes' || (isset($details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'Sometimes') || old('QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box') == 'Sometimes' || (isset($details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'No') || old('QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box') == 'No' || (isset($details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong> Cognitive:  </strong>  Does your child imitate household tasks (e.g., sweeping, talking on phone)?
                                           
                                        </label>
                                        <select name="QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone" class="playground-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'Yes') || old('QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone') == 'Yes' || (isset($details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                             <option value="Sometimes" {{ (isset($_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'Sometimes') || old('QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone') == 'Sometimes' || (isset($details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'No') || old('QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone') == 'No' || (isset($details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'No') ? 'selected' : '' }}>No</option>  
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Hidden score fields for calculation only -->
                                <input type="hidden" name="play_ground_Cognitive" id="play_ground_Cognitive">
                                <input type="hidden" name="play_ground_Motor" id="play_ground_Motor">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>   Can your child walk without help?
                                        </label>
                                        <select name="QuestionNo_61_Can_your_child_walk_without_help" class="playground-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_61_Can_your_child_walk_without_help']) && $_GET['QuestionNo_61_Can_your_child_walk_without_help'] == 'Yes') || old('QuestionNo_61_Can_your_child_walk_without_help') == 'Yes' || (isset($details['QuestionNo_61_Can_your_child_walk_without_help']) && $details['QuestionNo_61_Can_your_child_walk_without_help'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_61_Can_your_child_walk_without_help']) && $_GET['QuestionNo_61_Can_your_child_walk_without_help'] == 'Sometimes') || old('QuestionNo_61_Can_your_child_walk_without_help') == 'Sometimes' || (isset($details['QuestionNo_61_Can_your_child_walk_without_help']) && $details['QuestionNo_61_Can_your_child_walk_without_help'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                              <option value="No" {{ (isset($_GET['QuestionNo_61_Can_your_child_walk_without_help']) && $_GET['QuestionNo_61_Can_your_child_walk_without_help'] == 'No') || old('QuestionNo_61_Can_your_child_walk_without_help') == 'No' || (isset($details['QuestionNo_61_Can_your_child_walk_without_help']) && $details['QuestionNo_61_Can_your_child_walk_without_help'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>   Can your child stack two or more blocks? 
                                        </label>
                                        <select name="QuestionNo_62_Can_your_child_stack_two_or_more_blocks" class="playground-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'Yes') || old('QuestionNo_62_Can_your_child_stack_two_or_more_blocks') == 'Yes' || (isset($details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'Sometimes') || old('QuestionNo_62_Can_your_child_stack_two_or_more_blocks') == 'Sometimes' || (isset($details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'No') || old('QuestionNo_62_Can_your_child_stack_two_or_more_blocks') == 'No' || (isset($details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <strong>Language:</strong>   <label>Does your child point to objects when named?</label>
                                        <select name="QuestionNo_63_Does_your_child_point_to_objects_when_named" class="playground-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'Yes') || old('QuestionNo_63_Does_your_child_point_to_objects_when_named') == 'Yes' || (isset($details['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $details['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'Sometimes') || old('QuestionNo_63_Does_your_child_point_to_objects_when_named') == 'Sometimes' || (isset($details['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $details['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'No') || old('QuestionNo_63_Does_your_child_point_to_objects_when_named') == 'No' || (isset($details['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $details['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Language:</strong>    Can your child say at least 5–10 words?
                                        </label>
                                        <select name="QuestionNo_64_Can_your_child_say_at_least_5_10_words" class="playground-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'Yes') || old('QuestionNo_64_Can_your_child_say_at_least_5_10_words') == 'Yes' || (isset($details['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $details['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'Sometimes') || old('QuestionNo_64_Can_your_child_say_at_least_5_10_words') == 'Sometimes' || (isset($details['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $details['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'No') || old('QuestionNo_64_Can_your_child_say_at_least_5_10_words') == 'No' || (isset($details['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $details['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Hidden Language & Social-Emotional score fields -->
                                <input type="hidden" name="play_ground_Language" id="play_ground_Language">
                                <input type="hidden" name="play_ground_SocialEmotional" id="play_ground_SocialEmotional">
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>      Does your child show affection to familiar people?
                                        </label>
                                        <select name="QuestionNo_65_Does_your_child_show_affection_to_familiar_people" class="playground-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'Yes') || old('QuestionNo_65_Does_your_child_show_affection_to_familiar_people') == 'Yes' || (isset($details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'Sometimes') || old('QuestionNo_65_Does_your_child_show_affection_to_familiar_people') == 'Sometimes' || (isset($details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'No') || old('QuestionNo_65_Does_your_child_show_affection_to_familiar_people') == 'No' || (isset($details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>     Does your child get upset when separated from you? 
                                        </label>
                                        <select name="QuestionNo_66_Does_your_child_get_upset_when_separated_from_you" class="playground-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'Yes') || old('QuestionNo_66_Does_your_child_get_upset_when_separated_from_you') == 'Yes' || (isset($details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'Sometimes') || old('QuestionNo_66_Does_your_child_get_upset_when_separated_from_you') == 'Sometimes' || (isset($details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'No') || old('QuestionNo_66_Does_your_child_get_upset_when_separated_from_you') == 'No' || (isset($details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>  Can your child feed themselves with fingers or a spoon?
                                        </label>
                                        <select name="QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon" class="playground-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'Yes') || old('QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon') == 'Yes' || (isset($details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'Sometimes') || old('QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon') == 'Sometimes' || (isset($details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'No') || old('QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon') == 'No' || (isset($details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>    Does your child try to brush teeth or wash hands with help?
                                        </label>
                                        <select name="QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help" class="playground-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'Yes') || old('QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help') == 'Yes' || (isset($details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'Sometimes') || old('QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help') == 'Sometimes' || (isset($details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'No') || old('QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help') == 'No' || (isset($details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                             
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_Cognitive_Result" id="play_ground_Cognitive_Result" value="{{ $details['play_ground_Cognitive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_cognitive_total_score" id="playground_cognitive_total_score" value="{{ $details['playground_cognitive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_Motor_Result" id="play_ground_Motor_Result" value="{{ $details['play_ground_Motor_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_motor_total_score" id="playground_motor_total_score" value="{{ $details['playground_motor_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_Language_Result" id="play_ground_Language_Result" value="{{ $details['play_ground_Language_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_language_total_score" id="playground_language_total_score" value="{{ $details['playground_language_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_SocialEmotional_Result" id="play_ground_SocialEmotional_Result" value="{{ $details['play_ground_SocialEmotional_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_social_emotional_total_score" id="playground_social_emotional_total_score" value="{{ $details['playground_social_emotional_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_Adaptive_Result" id="play_ground_Adaptive_Result" value="{{ $details['play_ground_Adaptive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_adaptive_total_score" id="playground_adaptive_total_score" value="{{ $details['playground_adaptive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Playground Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_total_score" id="playground_total_score" value="{{ $details['playground_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div id="nursary_developmenr" class="d-none">
                            <ul>
                                <li><strong>Age:</strong> 25–36.9 Months</li>
                                <li><strong>Grade:</strong> Nursery</li>
                            </ul>
                            <p>
                                <strong class="d-block">Instructions:</strong>
                                Read each statement carefully and select the answer that best describes your child’s behavior
                                during the <strong>last 30 days.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                          <strong>Cognitive: </strong>  Can your child complete a simple puzzle (e.g., 3–4 pieces)?
                                        </label>
                                        <select name="QuestionNo_69_Can_your_child_complete_a_simple_puzzle" class="nursery-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'Yes') || old('QuestionNo_69_Can_your_child_complete_a_simple_puzzle') == 'Yes' || (isset($details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'Sometimes') || old('QuestionNo_69_Can_your_child_complete_a_simple_puzzle') == 'Sometimes' || (isset($details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'No') || old('QuestionNo_69_Can_your_child_complete_a_simple_puzzle') == 'No' || (isset($details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'No') ? 'selected' : '' }}>No</option>                                         
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Cognitive: </strong>  Does your child match similar objects (e.g., shoes, animals)?
                                           
                                        </label>
                                        <select name="QuestionNo_70_Does_your_child_match_similar_objects" class="nursery-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_70_Does_your_child_match_similar_objects']) && $_GET['QuestionNo_70_Does_your_child_match_similar_objects'] == 'Yes') || old('QuestionNo_70_Does_your_child_match_similar_objects') == 'Yes' || (isset($details['QuestionNo_70_Does_your_child_match_similar_objects']) && $details['QuestionNo_70_Does_your_child_match_similar_objects'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_70_Does_your_child_match_similar_objects']) && $_GET['QuestionNo_70_Does_your_child_match_similar_objects'] == 'Sometimes') || old('QuestionNo_70_Does_your_child_match_similar_objects') == 'Sometimes' || (isset($details['QuestionNo_70_Does_your_child_match_similar_objects']) && $details['QuestionNo_70_Does_your_child_match_similar_objects'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_70_Does_your_child_match_similar_objects']) && $_GET['QuestionNo_70_Does_your_child_match_similar_objects'] == 'No') || old('QuestionNo_70_Does_your_child_match_similar_objects') == 'No' || (isset($details['QuestionNo_70_Does_your_child_match_similar_objects']) && $details['QuestionNo_70_Does_your_child_match_similar_objects'] == 'No') ? 'selected' : '' }}>No</option>                                            
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Hidden Cognitive and Motor score fields -->
                                <input type="hidden" name="nursery_Cognitive" id="nursery_Cognitive">
                                <input type="hidden" name="nursery_Motor" id="nursery_Motor">
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>   Can your child jump with both feet?
                                        </label>
                                        <select name="QuestionNo_71_Can_your_child_jump_with_both_feet" class="nursery-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $_GET['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'Yes') || old('QuestionNo_71_Can_your_child_jump_with_both_feet') == 'Yes' || (isset($details['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $details['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $_GET['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'Sometimes') || old('QuestionNo_71_Can_your_child_jump_with_both_feet') == 'Sometimes' || (isset($details['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $details['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $_GET['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'No') || old('QuestionNo_71_Can_your_child_jump_with_both_feet') == 'No' || (isset($details['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $details['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>     Can your child draw a line or circle? 
                                        </label>
                                        <select name="QuestionNo_72_Can_your_child_draw_a_line_or_circle" class="nursery-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'Yes') || old('QuestionNo_72_Can_your_child_draw_a_line_or_circle') == 'Yes' || (isset($details['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $details['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'Sometimes') || old('QuestionNo_72_Can_your_child_draw_a_line_or_circle') == 'Sometimes' || (isset($details['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $details['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'No') || old('QuestionNo_72_Can_your_child_draw_a_line_or_circle') == 'No' || (isset($details['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $details['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <strong>Language:</strong>   <label>Can your child form 2- to 3-word phrases (e.g., “want juice”)?</label>
                                        <select name="QuestionNo_73_Can_your_child_form_2_to_3_word_phrases" class="nursery-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'Yes') || old('QuestionNo_73_Can_your_child_form_2_to_3_word_phrases') == 'Yes' || (isset($details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'Sometimes') || old('QuestionNo_73_Can_your_child_form_2_to_3_word_phrases') == 'Sometimes' || (isset($details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'No') || old('QuestionNo_73_Can_your_child_form_2_to_3_word_phrases') == 'No' || (isset($details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Language:</strong>   Does your child ask simple questions like “What’s that?”
                                            
                                        </label>
                                        <select name="QuestionNo_74_Does_your_child_ask_simple_questions" class="nursery-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_74_Does_your_child_ask_simple_questions']) && $_GET['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'Yes') || old('QuestionNo_74_Does_your_child_ask_simple_questions') == 'Yes' || (isset($details['QuestionNo_74_Does_your_child_ask_simple_questions']) && $details['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_74_Does_your_child_ask_simple_questions']) && $_GET['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'Sometimes') || old('QuestionNo_74_Does_your_child_ask_simple_questions') == 'Sometimes' || (isset($details['QuestionNo_74_Does_your_child_ask_simple_questions']) && $details['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_74_Does_your_child_ask_simple_questions']) && $_GET['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'No') || old('QuestionNo_74_Does_your_child_ask_simple_questions') == 'No' || (isset($details['QuestionNo_74_Does_your_child_ask_simple_questions']) && $details['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                               
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>     Does your child play pretend (e.g., feeding a doll)?
                                        </label>
                                        <select name="QuestionNo_75_Does_your_child_play_pretend" class="nursery-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_75_Does_your_child_play_pretend']) && $_GET['QuestionNo_75_Does_your_child_play_pretend'] == 'Yes') || old('QuestionNo_75_Does_your_child_play_pretend') == 'Yes' || (isset($details['QuestionNo_75_Does_your_child_play_pretend']) && $details['QuestionNo_75_Does_your_child_play_pretend'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_75_Does_your_child_play_pretend']) && $_GET['QuestionNo_75_Does_your_child_play_pretend'] == 'Sometimes') || old('QuestionNo_75_Does_your_child_play_pretend') == 'Sometimes' || (isset($details['QuestionNo_75_Does_your_child_play_pretend']) && $details['QuestionNo_75_Does_your_child_play_pretend'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_75_Does_your_child_play_pretend']) && $_GET['QuestionNo_75_Does_your_child_play_pretend'] == 'No') || old('QuestionNo_75_Does_your_child_play_pretend') == 'No' || (isset($details['QuestionNo_75_Does_your_child_play_pretend']) && $details['QuestionNo_75_Does_your_child_play_pretend'] == 'No') ? 'selected' : '' }}>No</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>     Does your child show awareness of other people’s feelings?
                                           
                                        </label>
                                        <select name="QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings" class="nursery-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'Yes') || old('QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings') == 'Yes' || (isset($details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'Sometimes') || old('QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings') == 'Sometimes' || (isset($details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'No') || old('QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings') == 'No' || (isset($details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>     Can your child take off some clothes without help?
                                        </label>
                                        <select name="QuestionNo_77_Can_your_child_take_off_some_clothes_without_help" class="nursery-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'Yes') || old('QuestionNo_77_Can_your_child_take_off_some_clothes_without_help') == 'Yes' || (isset($details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'Sometimes') || old('QuestionNo_77_Can_your_child_take_off_some_clothes_without_help') == 'Sometimes' || (isset($details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'No') || old('QuestionNo_77_Can_your_child_take_off_some_clothes_without_help') == 'No' || (isset($details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>     Is your child starting to show interest in potty training?
                                        </label>
                                        <select name="QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training" class="nursery-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'Yes') || old('QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training') == 'Yes' || (isset($details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'Sometimes') || old('QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training') == 'Sometimes' || (isset($details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'No') || old('QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training') == 'No' || (isset($details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Hidden Adaptive score field -->
                                <input type="hidden" name="nursery_Adaptive" id="nursery_Adaptive">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_Cognitive_Result" id="nursery_Cognitive_Result" value="{{ $details['nursery_Cognitive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_cognitive_total_score" id="nursery_cognitive_total_score" value="{{ $details['nursery_cognitive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_Motor_Result" id="nursery_Motor_Result" value="{{ $details['nursery_Motor_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_motor_total_score" id="nursery_motor_total_score" value="{{ $details['nursery_motor_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_Language_Result" id="nursery_Language_Result" value="{{ $details['nursery_Language_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_language_total_score" id="nursery_language_total_score" value="{{ $details['nursery_language_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_SocialEmotional_Result" id="nursery_SocialEmotional_Result" value="{{ $details['nursery_SocialEmotional_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_social_emotional_total_score" id="nursery_social_emotional_total_score" value="{{ $details['nursery_social_emotional_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_Adaptive_Result" id="nursery_Adaptive_Result" value="{{ $details['nursery_Adaptive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_adaptive_total_score" id="nursery_adaptive_total_score" value="{{ $details['nursery_adaptive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                               
                            </div>

                        </div>
                        <div id="kindergarten_developmenr" class="d-none">
                            <ul>
                                <li><strong>Age:</strong> 37 – 60 Months</li>
                                <li><strong>Grade:</strong> Kindergarten 1 & 2</li>
                            </ul>
                            <p>
                                <strong class="d-block">Instructions:</strong>
                                Read each statement carefully and select the answer that best describes your child’s behavior
                                during the <strong>last 30 days.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Cognitive:</strong> Can your child count to 5 or recognize some colors?
                                        </label>
                                        <select name="QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors" class="kindergarten-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'Yes') || old('QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors') == 'Yes' || (isset($details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'Sometimes') || old('QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors') == 'Sometimes' || (isset($details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'No') || old('QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors') == 'No' || (isset($details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'No') ? 'selected' : '' }}>No</option>                                       
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Cognitive:</strong>    Can your child follow two-step directions (e.g., “Get your shoes and put them by the
                                            door”)? 
                                        </label>
                                        <select name="QuestionNo_80_Can_your_child_follow_two_step_directions" class="kindergarten-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $_GET['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'Yes') || old('QuestionNo_80_Can_your_child_follow_two_step_directions') == 'Yes' || (isset($details['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $details['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $_GET['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'Sometimes') || old('QuestionNo_80_Can_your_child_follow_two_step_directions') == 'Sometimes' || (isset($details['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $details['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $_GET['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'No') || old('QuestionNo_80_Can_your_child_follow_two_step_directions') == 'No' || (isset($details['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $details['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'No') ? 'selected' : '' }}>No</option>                                       
                                        </select>
                                    </div>
                                </div>
                                
                             
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong> Can your child hop on one foot or catch a large ball?
                                        </label>
                                        <select name="QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball" class="kindergarten-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'Yes') || old('QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball') == 'Yes' || (isset($details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'Sometimes') || old('QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball') == 'Sometimes' || (isset($details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'No') || old('QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball') == 'No' || (isset($details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'No') ? 'selected' : '' }}>No</option>                                       
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>    Can your child use scissors to cut paper? 
                                        </label>
                                        <select name="QuestionNo_82_Can_your_child_use_scissors_to_cut_paper" class="kindergarten-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'Yes') || old('QuestionNo_82_Can_your_child_use_scissors_to_cut_paper') == 'Yes' || (isset($details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'Sometimes') || old('QuestionNo_82_Can_your_child_use_scissors_to_cut_paper') == 'Sometimes' || (isset($details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'No') || old('QuestionNo_82_Can_your_child_use_scissors_to_cut_paper') == 'No' || (isset($details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <strong>Language:</strong>     <label>Can your child tell a short story or describe an object?</label>
                                        <select name="QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object" class="kindergarten-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'Yes') || old('QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object') == 'Yes' || (isset($details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'Sometimes') || old('QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object') == 'Sometimes' || (isset($details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'No') || old('QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object') == 'No' || (isset($details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Language:</strong>   Are you able to understand what your child is saying most of the time?
                                        
                                        </label>
                                        <select name="QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time" class="kindergarten-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'Yes') || old('QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time') == 'Yes' || (isset($details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'Sometimes') || old('QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time') == 'Sometimes' || (isset($details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'No') || old('QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time') == 'No' || (isset($details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                              
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>    Does your child play cooperatively with other children?
                                        </label>
                                        <select name="QuestionNo_85_Does_your_child_play_cooperatively_with_other_children" class="kindergarten-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'Yes') || old('QuestionNo_85_Does_your_child_play_cooperatively_with_other_children') == 'Yes' || (isset($details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'Sometimes') || old('QuestionNo_85_Does_your_child_play_cooperatively_with_other_children') == 'Sometimes' || (isset($details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'No') || old('QuestionNo_85_Does_your_child_play_cooperatively_with_other_children') == 'No' || (isset($details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>   Does your child express emotions appropriately (e.g., anger, frustration)?
                                           
                                        </label>
                                        <select name="QuestionNo_86_Does_your_child_express_emotions_appropriately" class="kindergarten-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'Yes') || old('QuestionNo_86_Does_your_child_express_emotions_appropriately') == 'Yes' || (isset($details['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $details['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'Sometimes') || old('QuestionNo_86_Does_your_child_express_emotions_appropriately') == 'Sometimes' || (isset($details['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $details['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'No') || old('QuestionNo_86_Does_your_child_express_emotions_appropriately') == 'No' || (isset($details['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $details['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>  Can your child dress and undress without help?
                                        </label>
                                        <select name="QuestionNo_87_Can_your_child_dress_and_undress_without_help" class="kindergarten-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'Yes') || old('QuestionNo_87_Can_your_child_dress_and_undress_without_help') == 'Yes' || (isset($details['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $details['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'Sometimes') || old('QuestionNo_87_Can_your_child_dress_and_undress_without_help') == 'Sometimes' || (isset($details['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $details['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'No') || old('QuestionNo_87_Can_your_child_dress_and_undress_without_help') == 'No' || (isset($details['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $details['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>   Can your child use the toilet independently?
                                        </label>
                                        <select name="QuestionNo_88_Can_your_child_use_the_toilet_independently" class="kindergarten-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'Yes') || old('QuestionNo_88_Can_your_child_use_the_toilet_independently') == 'Yes' || (isset($details['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $details['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'Sometimes') || old('QuestionNo_88_Can_your_child_use_the_toilet_independently') == 'Sometimes' || (isset($details['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $details['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'No') || old('QuestionNo_88_Can_your_child_use_the_toilet_independently') == 'No' || (isset($details['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $details['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                             
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_Cognitive_Result" id="kindergarten_Cognitive_Result" value="{{ $details['kindergarten_Cognitive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_cognitive_total_score" id="kindergarten_cognitive_total_score" value="{{ $details['kindergarten_cognitive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_Motor_Result" id="kindergarten_Motor_Result" value="{{ $details['kindergarten_Motor_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_motor_total_score" id="kindergarten_motor_total_score" value="{{ $details['kindergarten_motor_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_Language_Result" id="kindergarten_Language_Result" value="{{ $details['kindergarten_Language_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_language_total_score" id="kindergarten_language_total_score" value="{{ $details['kindergarten_language_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_SocialEmotional_Result" id="kindergarten_SocialEmotional_Result" value="{{ $details['kindergarten_SocialEmotional_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_social_emotional_total_score" id="kindergarten_social_emotional_total_score" value="{{ $details['kindergarten_social_emotional_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_Adaptive_Result" id="kindergarten_Adaptive_Result" value="{{ $details['kindergarten_Adaptive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_adaptive_total_score" id="kindergarten_adaptive_total_score" value="{{ $details['kindergarten_adaptive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="playground_kindergarten_social_emotional" class="d-none">
                        <h4 class="subTitle mt-3">SOCIAL EMOTIONAL BEHAVIORAL SCREENING</h4>
                        <div>
                            <ul>
                                <li><strong>Age:</strong> 24 – 60 Months</li>
                                <li><strong>Grade:</strong> Play Group – KG 2</li>
                            </ul>
                            <p>
                                <strong class="d-block">Instructions:</strong>
                                Read each statement carefully and select the answer that best describes your child’s behavior
                                during the <strong>last 30 days.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Complains of aches or pains (e.g., stomach, head) without clear cause
                                        </label>
                                        <select name="aches_pains" class="aches_pains">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['aches_pains']) ? ($_GET['aches_pains'] == 'Never' ? 'selected' : '') : (isset($details['aches_pains']) ? ($details['aches_pains'] == 'Never' ? 'selected' : '') : (old('aches_pains') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['aches_pains']) ? ($_GET['aches_pains'] == 'Sometimes' ? 'selected' : '') : (isset($details['aches_pains']) ? ($details['aches_pains'] == 'Sometimes' ? 'selected' : '') : (old('aches_pains') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['aches_pains']) ? ($_GET['aches_pains'] == 'Often' ? 'selected' : '') : (isset($details['aches_pains']) ? ($details['aches_pains'] == 'Often' ? 'selected' : '') : (old('aches_pains') == 'No' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Seems sad, unhappy, or cries easily</label>
                                        <select name="sad_unhappy" class="sad_unhappy">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['sad_unhappy']) ? ($_GET['sad_unhappy'] == 'Never' ? 'selected' : '') : (isset($details['sad_unhappy']) ? ($details['sad_unhappy'] == 'Never' ? 'selected' : '') : (old('sad_unhappy') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['sad_unhappy']) ? ($_GET['sad_unhappy'] == 'Sometimes' ? 'selected' : '') : (isset($details['sad_unhappy']) ? ($details['sad_unhappy'] == 'Sometimes' ? 'selected' : '') : (old('sad_unhappy') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['sad_unhappy']) ? ($_GET['sad_unhappy'] == 'Often' ? 'selected' : '') : (isset($details['sad_unhappy']) ? ($details['sad_unhappy'] == 'Often' ? 'selected' : '') : (old('sad_unhappy') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Seems irritable or angry more than usual</label>
                                        <select name="irritable_angry" class="irritable_angry">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['irritable_angry']) ? ($_GET['irritable_angry'] == 'Never' ? 'selected' : '') : (isset($details['irritable_angry']) ? ($details['irritable_angry'] == 'Never' ? 'selected' : '') : (old('irritable_angry') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['irritable_angry']) ? ($_GET['irritable_angry'] == 'Sometimes' ? 'selected' : '') : (isset($details['irritable_angry']) ? ($details['irritable_angry'] == 'Sometimes' ? 'selected' : '') : (old('irritable_angry') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['irritable_angry']) ? ($_GET['irritable_angry'] == 'Often' ? 'selected' : '') : (isset($details['irritable_angry']) ? ($details['irritable_angry'] == 'Often' ? 'selected' : '') : (old('irritable_angry') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Has trouble sitting still or staying in one place</label>
                                        <select name="trouble_sitting" class="trouble_sitting">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['trouble_sitting']) ? ($_GET['trouble_sitting'] == 'Never' ? 'selected' : '') : (isset($details['trouble_sitting']) ? ($details['trouble_sitting'] == 'Never' ? 'selected' : '') : (old('trouble_sitting') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['trouble_sitting']) ? ($_GET['trouble_sitting'] == 'Sometimes' ? 'selected' : '') : (isset($details['trouble_sitting']) ? ($details['trouble_sitting'] == 'Sometimes' ? 'selected' : '') : (old('trouble_sitting') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['trouble_sitting']) ? ($_GET['trouble_sitting'] == 'Often' ? 'selected' : '') : (isset($details['trouble_sitting']) ? ($details['trouble_sitting'] == 'Often' ? 'selected' : '') : (old('trouble_sitting') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Is easily distracted or has trouble focusing on tasks or play</label>
                                        <select name="easily_distracted" class="easily_distracted">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['easily_distracted']) ? ($_GET['easily_distracted'] == 'Never' ? 'selected' : '') : (isset($details['easily_distracted']) ? ($details['easily_distracted'] == 'Never' ? 'selected' : '') : (old('easily_distracted') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['easily_distracted']) ? ($_GET['easily_distracted'] == 'Sometimes' ? 'selected' : '') : (isset($details['easily_distracted']) ? ($details['easily_distracted'] == 'Sometimes' ? 'selected' : '') : (old('easily_distracted') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['easily_distracted']) ? ($_GET['easily_distracted'] == 'Often' ? 'selected' : '') : (isset($details['easily_distracted']) ? ($details['easily_distracted'] == 'Often' ? 'selected' : '') : (old('easily_distracted') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Doesn’t listen when spoken to directly</label>
                                        <select name="doesnt_listen" class="doesnt_listen">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['doesnt_listen']) ? ($_GET['doesnt_listen'] == 'Never' ? 'selected' : '') : (isset($details['doesnt_listen']) ? ($details['doesnt_listen'] == 'Never' ? 'selected' : '') : (old('doesnt_listen') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['doesnt_listen']) ? ($_GET['doesnt_listen'] == 'Sometimes' ? 'selected' : '') : (isset($details['doesnt_listen']) ? ($details['doesnt_listen'] == 'Sometimes' ? 'selected' : '') : (old('doesnt_listen') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['doesnt_listen']) ? ($_GET['doesnt_listen'] == 'Often' ? 'selected' : '') : (isset($details['doesnt_listen']) ? ($details['doesnt_listen'] == 'Often' ? 'selected' : '') : (old('doesnt_listen') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Fidgets with hands or feet or squirms in seat</label>
                                        <select name="fidgets" class="fidgets">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['fidgets']) ? ($_GET['fidgets'] == 'Never' ? 'selected' : '') : (isset($details['fidgets']) ? ($details['fidgets'] == 'Never' ? 'selected' : '') : (old('fidgets') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['fidgets']) ? ($_GET['fidgets'] == 'Sometimes' ? 'selected' : '') : (isset($details['fidgets']) ? ($details['fidgets'] == 'Sometimes' ? 'selected' : '') : (old('fidgets') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['fidgets']) ? ($_GET['fidgets'] == 'Often' ? 'selected' : '') : (isset($details['fidgets']) ? ($details['fidgets'] == 'Often' ? 'selected' : '') : (old('fidgets') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Acts as if “driven by a motor” or always “on the go”</label>
                                        <select name="driven_motor" class="driven_motor">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['driven_motor']) ? ($_GET['driven_motor'] == 'Never' ? 'selected' : '') : (isset($details['driven_motor']) ? ($details['driven_motor'] == 'Never' ? 'selected' : '') : (old('driven_motor') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['driven_motor']) ? ($_GET['driven_motor'] == 'Sometimes' ? 'selected' : '') : (isset($details['driven_motor']) ? ($details['driven_motor'] == 'Sometimes' ? 'selected' : '') : (old('driven_motor') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['driven_motor']) ? ($_GET['driven_motor'] == 'Often' ? 'selected' : '') : (isset($details['driven_motor']) ? ($details['driven_motor'] == 'Often' ? 'selected' : '') : (old('driven_motor') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Argues or talks back when told to do something</label>
                                        <select name="argues_talks_back" class="argues_talks_back">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['argues_talks_back']) ? ($_GET['argues_talks_back'] == 'Never' ? 'selected' : '') : (isset($details['argues_talks_back']) ? ($details['argues_talks_back'] == 'Never' ? 'selected' : '') : (old('argues_talks_back') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['argues_talks_back']) ? ($_GET['argues_talks_back'] == 'Sometimes' ? 'selected' : '') : (isset($details['argues_talks_back']) ? ($details['argues_talks_back'] == 'Sometimes' ? 'selected' : '') : (old('argues_talks_back') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['argues_talks_back']) ? ($_GET['argues_talks_back'] == 'Often' ? 'selected' : '') : (isset($details['argues_talks_back']) ? ($details['argues_talks_back'] == 'Often' ? 'selected' : '') : (old('argues_talks_back') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Has difficulty waiting for their turn</label>
                                        <select name="difficulty_waiting" class="difficulty_waiting">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['difficulty_waiting']) ? ($_GET['difficulty_waiting'] == 'Never' ? 'selected' : '') : (isset($details['difficulty_waiting']) ? ($details['difficulty_waiting'] == 'Never' ? 'selected' : '') : (old('difficulty_waiting') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['difficulty_waiting']) ? ($_GET['difficulty_waiting'] == 'Sometimes' ? 'selected' : '') : (isset($details['difficulty_waiting']) ? ($details['difficulty_waiting'] == 'Sometimes' ? 'selected' : '') : (old('difficulty_waiting') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['difficulty_waiting']) ? ($_GET['difficulty_waiting'] == 'Often' ? 'selected' : '') : (isset($details['difficulty_waiting']) ? ($details['difficulty_waiting'] == 'Often' ? 'selected' : '') : (old('difficulty_waiting') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Blames others for their mistakes</label>
                                        <select name="blames_others" class="blames_others">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['blames_others']) ? ($_GET['blames_others'] == 'Never' ? 'selected' : '') : (isset($details['blames_others']) ? ($details['blames_others'] == 'Never' ? 'selected' : '') : (old('blames_others') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['blames_others']) ? ($_GET['blames_others'] == 'Sometimes' ? 'selected' : '') : (isset($details['blames_others']) ? ($details['blames_others'] == 'Sometimes' ? 'selected' : '') : (old('blames_others') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['blames_others']) ? ($_GET['blames_others'] == 'Often' ? 'selected' : '') : (isset($details['blames_others']) ? ($details['blames_others'] == 'Often' ? 'selected' : '') : (old('blames_others') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Hits, kicks, or bites others when upset</label>
                                        <select name="hits_kicks_bites" class="hits_kicks_bites">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['hits_kicks_bites']) ? ($_GET['hits_kicks_bites'] == 'Never' ? 'selected' : '') : (isset($details['hits_kicks_bites']) ? ($details['hits_kicks_bites'] == 'Never' ? 'selected' : '') : (old('hits_kicks_bites') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['hits_kicks_bites']) ? ($_GET['hits_kicks_bites'] == 'Sometimes' ? 'selected' : '') : (isset($details['hits_kicks_bites']) ? ($details['hits_kicks_bites'] == 'Sometimes' ? 'selected' : '') : (old('hits_kicks_bites') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['hits_kicks_bites']) ? ($_GET['hits_kicks_bites'] == 'Often' ? 'selected' : '') : (isset($details['hits_kicks_bites']) ? ($details['hits_kicks_bites'] == 'Often' ? 'selected' : '') : (old('hits_kicks_bites') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Seems anxious or worries a lot</label>
                                        <select name="anxious_worries" class="anxious_worries">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['anxious_worries']) ? ($_GET['anxious_worries'] == 'Never' ? 'selected' : '') : (isset($details['anxious_worries']) ? ($details['anxious_worries'] == 'Never' ? 'selected' : '') : (old('anxious_worries') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['anxious_worries']) ? ($_GET['anxious_worries'] == 'Sometimes' ? 'selected' : '') : (isset($details['anxious_worries']) ? ($details['anxious_worries'] == 'Sometimes' ? 'selected' : '') : (old('anxious_worries') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['anxious_worries']) ? ($_GET['anxious_worries'] == 'Often' ? 'selected' : '') : (isset($details['anxious_worries']) ? ($details['anxious_worries'] == 'Often' ? 'selected' : '') : (old('anxious_worries') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Is afraid to try new things or explore surroundings</label>
                                        <select name="afraid_new_things" class="afraid_new_things">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['afraid_new_things']) ? ($_GET['afraid_new_things'] == 'Never' ? 'selected' : '') : (isset($details['afraid_new_things']) ? ($details['afraid_new_things'] == 'Never' ? 'selected' : '') : (old('afraid_new_things') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['afraid_new_things']) ? ($_GET['afraid_new_things'] == 'Sometimes' ? 'selected' : '') : (isset($details['afraid_new_things']) ? ($details['afraid_new_things'] == 'Sometimes' ? 'selected' : '') : (old('afraid_new_things') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['afraid_new_things']) ? ($_GET['afraid_new_things'] == 'Often' ? 'selected' : '') : (isset($details['afraid_new_things']) ? ($details['afraid_new_things'] == 'Often' ? 'selected' : '') : (old('afraid_new_things') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Refuses to separate from parents or caregivers (e.g., at school/daycare)</label>
                                        <select name="refuses_separate" class="refuses_separate">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['refuses_separate']) ? ($_GET['refuses_separate'] == 'Never' ? 'selected' : '') : (isset($details['refuses_separate']) ? ($details['refuses_separate'] == 'Never' ? 'selected' : '') : (old('refuses_separate') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['refuses_separate']) ? ($_GET['refuses_separate'] == 'Sometimes' ? 'selected' : '') : (isset($details['refuses_separate']) ? ($details['refuses_separate'] == 'Sometimes' ? 'selected' : '') : (old('refuses_separate') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['refuses_separate']) ? ($_GET['refuses_separate'] == 'Often' ? 'selected' : '') : (isset($details['refuses_separate']) ? ($details['refuses_separate'] == 'Often' ? 'selected' : '') : (old('refuses_separate') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Has nightmares or trouble sleeping</label>
                                        <select name="nightmares_sleeping" class="nightmares_sleeping">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['nightmares_sleeping']) ? ($_GET['nightmares_sleeping'] == 'Never' ? 'selected' : '') : (isset($details['nightmares_sleeping']) ? ($details['nightmares_sleeping'] == 'Never' ? 'selected' : '') : (old('nightmares_sleeping') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['nightmares_sleeping']) ? ($_GET['nightmares_sleeping'] == 'Sometimes' ? 'selected' : '') : (isset($details['nightmares_sleeping']) ? ($details['nightmares_sleeping'] == 'Sometimes' ? 'selected' : '') : (old('nightmares_sleeping') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['nightmares_sleeping']) ? ($_GET['nightmares_sleeping'] == 'Often' ? 'selected' : '') : (isset($details['nightmares_sleeping']) ? ($details['nightmares_sleeping'] == 'Often' ? 'selected' : '') : (old('nightmares_sleeping') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Loses temper easily or has frequent tantrums</label>
                                        <select name="loses_temper" class="loses_temper">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['loses_temper']) ? ($_GET['loses_temper'] == 'Never' ? 'selected' : '') : (isset($details['loses_temper']) ? ($details['loses_temper'] == 'Never' ? 'selected' : '') : (old('loses_temper') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['loses_temper']) ? ($_GET['loses_temper'] == 'Sometimes' ? 'selected' : '') : (isset($details['loses_temper']) ? ($details['loses_temper'] == 'Sometimes' ? 'selected' : '') : (old('loses_temper') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['loses_temper']) ? ($_GET['loses_temper'] == 'Often' ? 'selected' : '') : (isset($details['loses_temper']) ? ($details['loses_temper'] == 'Often' ? 'selected' : '') : (old('loses_temper') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Internalizing Score</label>
                                     <input type="text" name="social_emotional_result" class="form-control" value="{{ $details['social_emotional_result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Attention Score</label>
                                     <input type="text" name="social_emotional_Attention_result" class="form-control" value="{{ $details['social_emotional_Attention_result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Externalizing Total Score:</strong></label>
                                        <input type="text" class="form-control" name="externalizing_socialtotal_emotional_score" id="externalizing_socialtotal_emotional_score" value="{{ $details['externalizing_social_emotional_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Externalizing Score </label>
                                     <input type="text" name="externalizing_social_emotional_score" class="form-control" value="{{ $details['externalizing_social_emotional_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Attention Total Score:</strong></label>
                                        <input type="text" class="form-control" name="social_emotional_attention_total_score" id="social_emotional_attention_total_score" value="{{ $details['social_emotional_attention_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Internalizing Total Score:</strong></label>
                                        <input type="text" class="form-control" name="social_emotional_total_score" id="social_emotional_total_score" value="{{ $details['social_emotional_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group text-area">
                                        <label for="social_emotional-test"><b>Social Emotional:</b></label><br>
                                        <textarea name="social_emotional-test" id="social_emotional-test" placeholder="Comments" cols="50" rows="5" readonly>{{ isset($_GET['social_emotional-test']) ? $_GET['social_emotional-test'] : (isset($details['social_emotional-test']) ? $details['social_emotional-test'] : old('social_emotional-test')) }}</textarea>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Social and Emotional Behavior  </label>
                                     <textarea name="social_emotional_behavior" id="social_emotional_behavior" cols="30" rows="10">{{ isset($_GET['social_emotional_behavior']) ? $_GET['social_emotional_behavior'] : (isset($details['social_emotional_behavior']) ? $details['social_emotional_behavior'] : old('social_emotional_behavior')) }}</textarea>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div id="playground_kindergarten_autism_spectrum" class="d-none">
                        <h4 class="subTitle mt-3">AUTISM SPECTRUM DISORDER SCREENING</h4>
                        <div>
                            <ul>
                                <li><strong>Age:</strong> 24 – 60 Months</li>
                                <li><strong>Grade:</strong> Play Group – KG 2</li>
                            </ul>
                            <p>
                                Please answer the following questions about your child’s typical behavior over the <strong>past
                                    3 months.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child make eye contact when talking or playing?
                                        </label>
                                        <select name="eye_contact" class="eye_contact">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['eye_contact']) ? ($_GET['eye_contact'] == 'Never' ? 'selected' : '') : (isset($details['eye_contact']) ? ($details['eye_contact'] == 'Never' ? 'selected' : '') : (old('eye_contact') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['eye_contact']) ? ($_GET['eye_contact'] == 'Sometimes' ? 'selected' : '') : (isset($details['eye_contact']) ? ($details['eye_contact'] == 'Sometimes' ? 'selected' : '') : (old('eye_contact') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['eye_contact']) ? ($_GET['eye_contact'] == 'Often' ? 'selected' : '') : (isset($details['eye_contact']) ? ($details['eye_contact'] == 'Often' ? 'selected' : '') : (old('eye_contact') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child show feelings like happiness, sadness, or anger in ways you
                                            understand?
                                        </label>
                                        <select name="show_feelings" class="show_feelings">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['show_feelings']) ? ($_GET['show_feelings'] == 'Never' ? 'selected' : '') : (isset($details['show_feelings']) ? ($details['show_feelings'] == 'Never' ? 'selected' : '') : (old('show_feelings') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['show_feelings']) ? ($_GET['show_feelings'] == 'Sometimes' ? 'selected' : '') : (isset($details['show_feelings']) ? ($details['show_feelings'] == 'Sometimes' ? 'selected' : '') : (old('show_feelings') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['show_feelings']) ? ($_GET['show_feelings'] == 'Often' ? 'selected' : '') : (isset($details['show_feelings']) ? ($details['show_feelings'] == 'Often' ? 'selected' : '') : (old('show_feelings') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child use gestures like pointing, waving, or nodding to communicate?
                                        </label>
                                        <select name="use_gestures" class="use_gestures">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['use_gestures']) ? ($_GET['use_gestures'] == 'Never' ? 'selected' : '') : (isset($details['use_gestures']) ? ($details['use_gestures'] == 'Never' ? 'selected' : '') : (old('use_gestures') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['use_gestures']) ? ($_GET['use_gestures'] == 'Sometimes' ? 'selected' : '') : (isset($details['use_gestures']) ? ($details['use_gestures'] == 'Sometimes' ? 'selected' : '') : (old('use_gestures') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['use_gestures']) ? ($_GET['use_gestures'] == 'Often' ? 'selected' : '') : (isset($details['use_gestures']) ? ($details['use_gestures'] == 'Often' ? 'selected' : '') : (old('use_gestures') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <!-- How does your child react to changes in routine or new situations? -->
                                              Does your child gets upset to changes in routine or new situations?
                                        </label>
                                        <select name="react_to_changes" class="react_to_changes">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['react_to_changes']) ? ($_GET['react_to_changes'] == 'Never' ? 'selected' : '') : (isset($details['react_to_changes']) ? ($details['react_to_changes'] == 'Never' ? 'selected' : '') : (old('react_to_changes') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['react_to_changes']) ? ($_GET['react_to_changes'] == 'Sometimes' ? 'selected' : '') : (isset($details['react_to_changes']) ? ($details['react_to_changes'] == 'Sometimes' ? 'selected' : '') : (old('react_to_changes') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['react_to_changes']) ? ($_GET['react_to_changes'] == 'Often' ? 'selected' : '') : (isset($details['react_to_changes']) ? ($details['react_to_changes'] == 'Often' ? 'selected' : '') : (old('react_to_changes') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Does your child respond when someone calls their name or speaks to them?</label>
                                        <select name="respond_to_name" class="respond_to_name">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['respond_to_name']) ? ($_GET['respond_to_name'] == 'Never' ? 'selected' : '') : (isset($details['respond_to_name']) ? ($details['respond_to_name'] == 'Never' ? 'selected' : '') : (old('respond_to_name') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['respond_to_name']) ? ($_GET['respond_to_name'] == 'Sometimes' ? 'selected' : '') : (isset($details['respond_to_name']) ? ($details['respond_to_name'] == 'Sometimes' ? 'selected' : '') : (old('respond_to_name') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['respond_to_name']) ? ($_GET['respond_to_name'] == 'Often' ? 'selected' : '') : (isset($details['respond_to_name']) ? ($details['respond_to_name'] == 'Often' ? 'selected' : '') : (old('respond_to_name') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child use words or sentences to express needs or feelings?
                                        </label>
                                        <select name="use_words" class="use_words">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['use_words']) ? ($_GET['use_words'] == 'Never' ? 'selected' : '') : (isset($details['use_words']) ? ($details['use_words'] == 'Never' ? 'selected' : '') : (old('use_words') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['use_words']) ? ($_GET['use_words'] == 'Sometimes' ? 'selected' : '') : (isset($details['use_words']) ? ($details['use_words'] == 'Sometimes' ? 'selected' : '') : (old('use_words') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['use_words']) ? ($_GET['use_words'] == 'Often' ? 'selected' : '') : (isset($details['use_words']) ? ($details['use_words'] == 'Often' ? 'selected' : '') : (old('use_words') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child use facial expressions (smiling, frowning) to communicate?
                                        </label>
                                        <select name="use_facial_expressions" class="use_facial_expressions">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['use_facial_expressions']) ? ($_GET['use_facial_expressions'] == 'Never' ? 'selected' : '') : (isset($details['use_facial_expressions']) ? ($details['use_facial_expressions'] == 'Never' ? 'selected' : '') : (old('use_facial_expressions') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['use_facial_expressions']) ? ($_GET['use_facial_expressions'] == 'Sometimes' ? 'selected' : '') : (isset($details['use_facial_expressions']) ? ($details['use_facial_expressions'] == 'Sometimes' ? 'selected' : '') : (old('use_facial_expressions') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['use_facial_expressions']) ? ($_GET['use_facial_expressions'] == 'Often' ? 'selected' : '') : (isset($details['use_facial_expressions']) ? ($details['use_facial_expressions'] == 'Often' ? 'selected' : '') : (old('use_facial_expressions') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <!-- Is your child’s activity level appropriate (not too high or low) compared to other
                                            children? -->
                                             Does your child seem more restless or less active than other children?
                                        </label>
                                        <select name="appropriate_activity_level" class="appropriate_activity_level">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['appropriate_activity_level']) ? ($_GET['appropriate_activity_level'] == 'Never' ? 'selected' : '') : (isset($details['appropriate_activity_level']) ? ($details['appropriate_activity_level'] == 'Never' ? 'selected' : '') : (old('appropriate_activity_level') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['appropriate_activity_level']) ? ($_GET['appropriate_activity_level'] == 'Sometimes' ? 'selected' : '') : (isset($details['appropriate_activity_level']) ? ($details['appropriate_activity_level'] == 'Sometimes' ? 'selected' : '') : (old('appropriate_activity_level') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['appropriate_activity_level']) ? ($_GET['appropriate_activity_level'] == 'Often' ? 'selected' : '') : (isset($details['appropriate_activity_level']) ? ($details['appropriate_activity_level'] == 'Often' ? 'selected' : '') : (old('appropriate_activity_level') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Can your child follow simple directions (e.g., “Bring me the toy”)?
                                        </label>
                                        <select name="follow_directions" class="follow_directions">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['follow_directions']) ? ($_GET['follow_directions'] == 'Never' ? 'selected' : '') : (isset($details['follow_directions']) ? ($details['follow_directions'] == 'Never' ? 'selected' : '') : (old('follow_directions') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['follow_directions']) ? ($_GET['follow_directions'] == 'Sometimes' ? 'selected' : '') : (isset($details['follow_directions']) ? ($details['follow_directions'] == 'Sometimes' ? 'selected' : '') : (old('follow_directions') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['follow_directions']) ? ($_GET['follow_directions'] == 'Often' ? 'selected' : '') : (isset($details['follow_directions']) ? ($details['follow_directions'] == 'Often' ? 'selected' : '') : (old('follow_directions') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child play with other children or engage in group activities?
                                        </label>
                                        <select name="play_with_others" class="play_with_others">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['play_with_others']) ? ($_GET['play_with_others'] == 'Never' ? 'selected' : '') : (isset($details['play_with_others']) ? ($details['play_with_others'] == 'Never' ? 'selected' : '') : (old('play_with_others') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['play_with_others']) ? ($_GET['play_with_others'] == 'Sometimes' ? 'selected' : '') : (isset($details['play_with_others']) ? ($details['play_with_others'] == 'Sometimes' ? 'selected' : '') : (old('play_with_others') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['play_with_others']) ? ($_GET['play_with_others'] == 'Often' ? 'selected' : '') : (isset($details['play_with_others']) ? ($details['play_with_others'] == 'Often' ? 'selected' : '') : (old('play_with_others') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Autism Spectrum Score</label>
                                        <input type="text" name="autism_spectrum_result" class="form-control" value="{{ $details['autism_spectrum_result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Autism Spectrum Total Score:</strong></label>
                                        <input type="text" class="form-control" name="autism_spectrum_total_score" id="autism_spectrum_total_score" value="{{ $details['autism_spectrum_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="screener-field text-area">
                                        <label>AUTISM SPECTRUM  </label>
                                     <textarea name="autism_spectrum_Comment" id="autism_spectrum_Comment" cols="30" rows="12">{{ isset($_GET['autism_spectrum_Comment']) ? $_GET['autism_spectrum_Comment'] : (isset($details['autism_spectrum_Comment']) ? $details['autism_spectrum_Comment'] : old('autism_spectrum_Comment')) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="screener" id="primary_secondary" class="d-none">
                    <h3 class="title">PRIMARY/SECONDARY PSYCHOLOGICAL SCREENER</h3>
                    <div id="primary_secondary_inner">
                        <ul>
                            <li><strong>Age:</strong> 6-16 years</li>
                            <li><strong>Grade:</strong> 1-10</li>
                        </ul>
                        <p>
                            <strong class="d-block">Instructions:</strong>
                            Ask the child: "In the past few weeks, how often have these things been true for you?"
                            <br>
                            Ask each question in a child-friendly, age-appropriate way. Mark the response as reported by the
                            child.
                        </p>
                        <div class="row screener-fields">
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You feel sad, unhappy, or like crying.
                                    </label>
                                    <select name="feel_sad" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['feel_sad']) ? ($_GET['feel_sad'] == 'Never' ? 'selected' : '') : (isset($details['feel_sad']) ? ($details['feel_sad'] == 'Never' ? 'selected' : '') : (old('feel_sad') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['feel_sad']) ? ($_GET['feel_sad'] == 'Sometimes' ? 'selected' : '') : (isset($details['feel_sad']) ? ($details['feel_sad'] == 'Sometimes' ? 'selected' : '') : (old('feel_sad') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['feel_sad']) ? ($_GET['feel_sad'] == 'Often' ? 'selected' : '') : (isset($details['feel_sad']) ? ($details['feel_sad'] == 'Often' ? 'selected' : '') : (old('feel_sad') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You are easily distracted or have trouble concentrating.
                                    </label>
                                    <select name="easily_distracted_primary" class="attention-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['easily_distracted_primary']) ? ($_GET['easily_distracted_primary'] == 'Never' ? 'selected' : '') : (isset($details['easily_distracted_primary']) ? ($details['easily_distracted_primary'] == 'Never' ? 'selected' : '') : (old('easily_distracted_primary') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['easily_distracted_primary']) ? ($_GET['easily_distracted_primary'] == 'Sometimes' ? 'selected' : '') : (isset($details['easily_distracted_primary']) ? ($details['easily_distracted_primary'] == 'Sometimes' ? 'selected' : '') : (old('easily_distracted_primary') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['easily_distracted_primary']) ? ($_GET['easily_distracted_primary'] == 'Often' ? 'selected' : '') : (isset($details['easily_distracted_primary']) ? ($details['easily_distracted_primary'] == 'Often' ? 'selected' : '') : (old('easily_distracted_primary') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You feel nervous, worried, or afraid a lot.
                                    </label>
                                    <select name="feel_nervous" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['feel_nervous']) ? ($_GET['feel_nervous'] == 'Never' ? 'selected' : '') : (isset($details['feel_nervous']) ? ($details['feel_nervous'] == 'Never' ? 'selected' : '') : (old('feel_nervous') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['feel_nervous']) ? ($_GET['feel_nervous'] == 'Sometimes' ? 'selected' : '') : (isset($details['feel_nervous']) ? ($details['feel_nervous'] == 'Sometimes' ? 'selected' : '') : (old('feel_nervous') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['feel_nervous']) ? ($_GET['feel_nervous'] == 'Often' ? 'selected' : '') : (isset($details['feel_nervous']) ? ($details['feel_nervous'] == 'Often' ? 'selected' : '') : (old('feel_nervous') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You have trouble sleeping or feel tired most of the time.
                                    </label>
                                    <select name="trouble_sleeping" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['trouble_sleeping']) ? ($_GET['trouble_sleeping'] == 'Never' ? 'selected' : '') : (isset($details['trouble_sleeping']) ? ($details['trouble_sleeping'] == 'Never' ? 'selected' : '') : (old('trouble_sleeping') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['trouble_sleeping']) ? ($_GET['trouble_sleeping'] == 'Sometimes' ? 'selected' : '') : (isset($details['trouble_sleeping']) ? ($details['trouble_sleeping'] == 'Sometimes' ? 'selected' : '') : (old('trouble_sleeping') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['trouble_sleeping']) ? ($_GET['trouble_sleeping'] == 'Often' ? 'selected' : '') : (isset($details['trouble_sleeping']) ? ($details['trouble_sleeping'] == 'Often' ? 'selected' : '') : (old('trouble_sleeping') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>You feel lonely or like being alone more than usual.</label>
                                    <select name="feel_lonely" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['feel_lonely']) ? ($_GET['feel_lonely'] == 'Never' ? 'selected' : '') : (isset($details['feel_lonely']) ? ($details['feel_lonely'] == 'Never' ? 'selected' : '') : (old('feel_lonely') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['feel_lonely']) ? ($_GET['feel_lonely'] == 'Sometimes' ? 'selected' : '') : (isset($details['feel_lonely']) ? ($details['feel_lonely'] == 'Sometimes' ? 'selected' : '') : (old('feel_lonely') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['feel_lonely']) ? ($_GET['feel_lonely'] == 'Often' ? 'selected' : '') : (isset($details['feel_lonely']) ? ($details['feel_lonely'] == 'Often' ? 'selected' : '') : (old('feel_lonely') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You often argue or talk back when told to do something.
                                    </label>
                                    <select name="argue_talk_back" class="behavioral-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['argue_talk_back']) ? ($_GET['argue_talk_back'] == 'Never' ? 'selected' : '') : (isset($details['argue_talk_back']) ? ($details['argue_talk_back'] == 'Never' ? 'selected' : '') : (old('argue_talk_back') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['argue_talk_back']) ? ($_GET['argue_talk_back'] == 'Sometimes' ? 'selected' : '') : (isset($details['argue_talk_back']) ? ($details['argue_talk_back'] == 'Sometimes' ? 'selected' : '') : (old('argue_talk_back') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['argue_talk_back']) ? ($_GET['argue_talk_back'] == 'Often' ? 'selected' : '') : (isset($details['argue_talk_back']) ? ($details['argue_talk_back'] == 'Often' ? 'selected' : '') : (old('argue_talk_back') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You take things that do not belong to you or refuse to share.
                                    </label>
                                    <select name="take_things_refuse_share" class="behavioral-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['take_things_refuse_share']) ? ($_GET['take_things_refuse_share'] == 'Never' ? 'selected' : '') : (isset($details['take_things_refuse_share']) ? ($details['take_things_refuse_share'] == 'Never' ? 'selected' : '') : (old('take_things_refuse_share') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['take_things_refuse_share']) ? ($_GET['take_things_refuse_share'] == 'Sometimes' ? 'selected' : '') : (isset($details['take_things_refuse_share']) ? ($details['take_things_refuse_share'] == 'Sometimes' ? 'selected' : '') : (old('take_things_refuse_share') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['take_things_refuse_share']) ? ($_GET['take_things_refuse_share'] == 'Often' ? 'selected' : '') : (isset($details['take_things_refuse_share']) ? ($details['take_things_refuse_share'] == 'Often' ? 'selected' : '') : (old('take_things_refuse_share') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You fight with other children or get angry quickly.
                                    </label>
                                    <select name="fight_angry_quickly" class="behavioral-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['fight_angry_quickly']) ? ($_GET['fight_angry_quickly'] == 'Never' ? 'selected' : '') : (isset($details['fight_angry_quickly']) ? ($details['fight_angry_quickly'] == 'Never' ? 'selected' : '') : (old('fight_angry_quickly') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['fight_angry_quickly']) ? ($_GET['fight_angry_quickly'] == 'Sometimes' ? 'selected' : '') : (isset($details['fight_angry_quickly']) ? ($details['fight_angry_quickly'] == 'Sometimes' ? 'selected' : '') : (old('fight_angry_quickly') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['fight_angry_quickly']) ? ($_GET['fight_angry_quickly'] == 'Often' ? 'selected' : '') : (isset($details['fight_angry_quickly']) ? ($details['fight_angry_quickly'] == 'Often' ? 'selected' : '') : (old('fight_angry_quickly') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You don’t enjoy things you used to enjoy.
                                    </label>
                                    <select name="dont_enjoy_things" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['dont_enjoy_things']) ? ($_GET['dont_enjoy_things'] == 'Never' ? 'selected' : '') : (isset($details['dont_enjoy_things']) ? ($details['dont_enjoy_things'] == 'Never' ? 'selected' : '') : (old('dont_enjoy_things') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['dont_enjoy_things']) ? ($_GET['dont_enjoy_things'] == 'Sometimes' ? 'selected' : '') : (isset($details['dont_enjoy_things']) ? ($details['dont_enjoy_things'] == 'Sometimes' ? 'selected' : '') : (old('dont_enjoy_things') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['dont_enjoy_things']) ? ($_GET['dont_enjoy_things'] == 'Often' ? 'selected' : '') : (isset($details['dont_enjoy_things']) ? ($details['dont_enjoy_things'] == 'Often' ? 'selected' : '') : (old('dont_enjoy_things') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You are clingy or need to be with adults all the time.
                                    </label>
                                    <select name="clingy_need_adults" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['clingy_need_adults']) ? ($_GET['clingy_need_adults'] == 'Never' ? 'selected' : '') : (isset($details['clingy_need_adults']) ? ($details['clingy_need_adults'] == 'Never' ? 'selected' : '') : (old('clingy_need_adults') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['clingy_need_adults']) ? ($_GET['clingy_need_adults'] == 'Sometimes' ? 'selected' : '') : (isset($details['clingy_need_adults']) ? ($details['clingy_need_adults'] == 'Sometimes' ? 'selected' : '') : (old('clingy_need_adults') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['clingy_need_adults']) ? ($_GET['clingy_need_adults'] == 'Often' ? 'selected' : '') : (isset($details['clingy_need_adults']) ? ($details['clingy_need_adults'] == 'Often' ? 'selected' : '') : (old('clingy_need_adults') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You have trouble sitting still or feel “on the go” a lot.
                                    </label>
                                    <select name="trouble_sitting_still" class="attention-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['trouble_sitting_still']) ? ($_GET['trouble_sitting_still'] == 'Never' ? 'selected' : '') : (isset($details['trouble_sitting_still']) ? ($details['trouble_sitting_still'] == 'Never' ? 'selected' : '') : (old('trouble_sitting_still') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['trouble_sitting_still']) ? ($_GET['trouble_sitting_still'] == 'Sometimes' ? 'selected' : '') : (isset($details['trouble_sitting_still']) ? ($details['trouble_sitting_still'] == 'Sometimes' ? 'selected' : '') : (old('trouble_sitting_still') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['trouble_sitting_still']) ? ($_GET['trouble_sitting_still'] == 'Often' ? 'selected' : '') : (isset($details['trouble_sitting_still']) ? ($details['trouble_sitting_still'] == 'Often' ? 'selected' : '') : (old('trouble_sitting_still') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You don’t listen to rules or directions.
                                    </label>
                                    <select name="dont_listen_rules" class="behavioral-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['dont_listen_rules']) ? ($_GET['dont_listen_rules'] == 'Never' ? 'selected' : '') : (isset($details['dont_listen_rules']) ? ($details['dont_listen_rules'] == 'Never' ? 'selected' : '') : (old('dont_listen_rules') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['dont_listen_rules']) ? ($_GET['dont_listen_rules'] == 'Sometimes' ? 'selected' : '') : (isset($details['dont_listen_rules']) ? ($details['dont_listen_rules'] == 'Sometimes' ? 'selected' : '') : (old('dont_listen_rules') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['dont_listen_rules']) ? ($_GET['dont_listen_rules'] == 'Often' ? 'selected' : '') : (isset($details['dont_listen_rules']) ? ($details['dont_listen_rules'] == 'Often' ? 'selected' : '') : (old('dont_listen_rules') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>Internalizing Result</label>
                                    <input type="text" name="emotional_behavior_result" class="form-control" value="{{ $details['emotional_behavior_result'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label><strong>Internalizing Total Score:</strong></label>
                                    <input type="text" class="form-control" name="psychological_internalization_total_score" id="psychological_internalization_total_score" value="{{ $details['psychological_internalization_total_score'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>Externalizing Result</label>
                                    <input type="text" name="behavioral_issues_result" class="form-control" value="{{ $details['behavioral_issues_result'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label><strong>Externalizing Total Score:</strong></label>
                                    <input type="text" class="form-control" name="psychological_externalization_total_score" id="psychological_externalization_total_score" value="{{ $details['psychological_externalization_total_score'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>Attention  Result</label>
                                    <input type="text" name="attention_issues_result" class="form-control" value="{{ $details['attention_issues_result'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label><strong>Attention Total Score:</strong></label>
                                    <input type="text" class="form-control" name="psychological_attention_total_score" id="psychological_attention_total_score" value="{{ $details['psychological_attention_total_score'] ?? '' }}" readonly>
                                </div>
                            </div>
                            
                        </div>
                                <!-- <div class="form-row"> -->
                                    <div class="form-group col-md-12">
                                        <div class="form-group text-area">
                                            <label for="psychological_comment"><b>Psychological Assessment Comments:</b></label><br>
                                            <textarea name="psychological_comment" id="psychological_comment" placeholder="Comments will be auto-generated based on assessment scores" cols="50" rows="5" readonly>{{ isset($_GET['psychological_comment']) ? $_GET['psychological_comment'] : (isset($details['psychological_comment']) ? $details['psychological_comment'] : old('psychological_comment')) }}</textarea>
                                        </div>
                                    </div>
                                <!-- </div> -->
                    </div>
                </div>
               


                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>



            <!-- Step Seventeen - Nutritionist -->

            <div class="step last-step mb-5" id="step18">
                <h3>Nutritionist</h3>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_60_How_would_you_describe_your_lifestyle">Question No.60: How would
                                you describe your lifestyle?</label><br>
                            <select class="form-control" id="Question_No_60_How_would_you_describe_your_lifestyle"
                                name="Question_No_60_How_would_you_describe_your_lifestyle" >
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
                                <option value="Moderately Active"
                                    {{ isset($_GET['Question_No_60_How_would_you_describe_your_lifestyle'])
                                        ? ($_GET['Question_No_60_How_would_you_describe_your_lifestyle'] == 'Moderately Active'
                                            ? 'selected'
                                            : '')
                                        : (isset($details['Question_No_60_How_would_you_describe_your_lifestyle'])
                                            ? ($details['Question_No_60_How_would_you_describe_your_lifestyle'] == 'Moderately Active'
                                                ? 'selected'
                                                : '')
                                            : (old('Question_No_60_How_would_you_describe_your_lifestyle') == 'Moderately Active'
                                                ? 'selected'
                                                : '')) }}>
                                    Moderately Active
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
                                >
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
                            <select class="form-control" id="food_allergies" name="food_allergies" >
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
                            <select class="form-control" id="meals" name="meals" >
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
                            <select class="form-control" id="food_items" name="food_items" >
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
                    <div class="form-group col-12">
                        <div class="form-group">
                            <label for="fast_food">Question No.71: How frequently do you consume fast food (dine-out) in a
                                week?</label><br>
                            <select class="form-control" id="fast_food" name="fast_food" >
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
                    <div class="form-group col-12">
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
                @php
                $rawReferTo = $details['refer_to'] ?? old('refer_to') ?? [];
                if (!is_array($rawReferTo)) {
                        $decoded = json_decode($rawReferTo, true);
                        if (is_array($decoded)) {
                            $referTo = $decoded;
                        } elseif (!is_null($rawReferTo)) {
                            $referTo = [$rawReferTo]; // Convert single string to array
                        } else {
                            $referTo = [];
                        }
                    } else {
                        $referTo = $rawReferTo;
                    }
               
                @endphp
                <div class="form-row d-none refer_to_form_row">
                    <div class="form-group col-12">
                        <div class="form-group">
                            <label for="refer_to">Refer To</label>
                            <select id="refer_to" name="refer_to[]" class="form-control" multiple required>
                            <option value="1" {{ in_array('1', $referTo) ? 'selected' : '' }}>Psychologist</option>
                            <option value="2" {{ in_array('2', $referTo) ? 'selected' : '' }}>Nutritionist</option>
                            <option value="4" {{ in_array('4', $referTo) ? 'selected' : '' }}>External Specialists</option>
                            <option value="5" {{ in_array('5', $referTo) ? 'selected' : '' }}>General Physician</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-row d-none" id="follow_up_show">
                    <div class="form-group col-12">
                        <div class="form-group">
                            <label for="Reason_for_Follow_up">Reason for Follow-up</label>
                            <input placeholder="Reason for Follow-up" name="Reason_for_Follow_up"
                                id="Reason_for_Follow_up" class="form-control"
                                value="{{ isset($_GET['Reason_for_Follow_up']) ? $_GET['Reason_for_Follow_up'] : (isset($details['Reason_for_Follow_up']) ? $details['Reason_for_Follow_up'] : old('Reason_for_Follow_up')) }}" />
                        </div>
                    </div>
                        <div class="form-group col-md-6 d-none" id="followupnutitiondate">
                            <div class="form-group">
                                <label for="Follow_up_Date">Follow-up Date Nutrition</label>
                                <input type="date" placeholder="Follow-up Date" name="Follow_up_Date"
                                    id="Follow_up_Date" class="form-control"
                                    value="{{ isset($_GET['Follow_up_Date']) ? $_GET['Follow_up_Date'] : (isset($details['Follow_up_Date']) ? $details['Follow_up_Date'] : old('Follow_up_Date')) }}" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 d-none" id="followupphysiciandate">
                            <div class="form-group">
                                <label for="Follow_up_Date">Follow-up Date Psychologist </label>
                                <input type="date" placeholder="Follow-up Date" name="Physician_Follow_up_Date"
                                    id="Physician_Follow_up_Date" class="form-control"
                                    value="{{ isset($_GET['Physician_Follow_up_Date']) ? $_GET['Physician_Follow_up_Date'] : (isset($details['Physician_Follow_up_Date']) ? $details['Physician_Follow_up_Date'] : old('Physician_Follow_up_Date')) }}" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 d-none" id="followupexternalspecialistdate">
                            <div class="form-group">
                                <label for="Follow_up_Date">Follow-up Date External Specialist </label>
                                <input type="date" placeholder="Follow-up Date" name="externalspecialist_Follow_up_Date"
                                    id="externalspecialist_Follow_up_Date" class="form-control"
                                    value="{{ isset($_GET['externalspecialist_Follow_up_Date']) ? $_GET['externalspecialist_Follow_up_Date'] : (isset($details['externalspecialist_Follow_up_Date']) ? $details['externalspecialist_Follow_up_Date'] : old('externalspecialist_Follow_up_Date')) }}" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 d-none" id="followupgeneralphysiciandate">
                            <div class="form-group">
                                <label for="Follow_up_Date">Follow-up Date General Physician </label>
                                <input type="date" placeholder="Follow-up Date" name="generalphysician_Follow_up_Date"
                                    id="generalphysician_Follow_up_Date" class="form-control"
                                    value="{{ isset($_GET['generalphysician_Follow_up_Date']) ? $_GET['generalphysician_Follow_up_Date'] : (isset($details['generalphysician_Follow_up_Date']) ? $details['generalphysician_Follow_up_Date'] : old('generalphysician_Follow_up_Date')) }}" />
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
                            <!-- <p>Severe Wasting (WHZ < -3): </p>
                                    <p>Moderate Wasting (WHZ between -3 and -2): </p>
                                    <p>Normal (WHZ between -2 and +2): </p>
                                    <p>Overweight (WHZ > +2): </p> -->
                                    <select name="wasting_birth_to_5_girl" id="wasting_birth_to_5_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectWasting">
                                        <option value="">Select</option>
                                       <!--  <option value="Severe Wasting (WHZ < -3)"
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
                                            Overweight (WHZ > +2)</option> -->
                                            <option value="Severe Thinness"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Severe Thinness' ? 'selected' : '' }}>
                                            Severe Thinness</option>
                                        <option value="Moderate Thinness"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Moderate Thinness' ? 'selected' : '' }}>
                                            Moderate Thinness</option>
                                            <option value="Mild Thinness"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Mild Thinness' ? 'selected' : '' }}>
                                            Mild Thinness</option>
                                        <option value="Normal Weight"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Normal Weight' ? 'selected' : '' }}>
                                            Normal Weight</option>
                                        <option value="Mild Overweight"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Mild Overweight' ? 'selected' : '' }}>
                                            Mild Overweight</option>
                                        <option value="Overweight"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Overweight' ? 'selected' : '' }}>
                                            Overweight</option>
                                        <option value="Obesity"
                                            {{ isset($details['wasting_birth_to_5_girl']) && $details['wasting_birth_to_5_girl'] == 'Obesity' ? 'selected' : '' }}>
                                            Obesity</option>
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
                                    <!-- <p>Moderate Wasting (WHZ between -3 and -2): </p>
                                    <p>Normal (WHZ between -2 and +2): </p>
                                    <p>Overweight (WHZ > +2): </p> -->
                                    <select name="wasting_birth_to_5_boy" id="wasting_birth_to_5_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectWasting">
                                        <option value="">Select</option>
                                        <option value="Severe Thinness"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Severe Thinness' ? 'selected' : '' }}>
                                            Severe Thinness</option>
                                        <option value="Moderate Thinness"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Moderate Thinness' ? 'selected' : '' }}>
                                            Moderate Thinness</option>
                                            <option value="Mild Thinness"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Mild Thinness' ? 'selected' : '' }}>
                                            Mild Thinness</option>
                                        <option value="Normal Weight"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Normal Weight' ? 'selected' : '' }}>
                                            Normal Weight</option>
                                        <option value="Mild Overweight"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Mild Overweight' ? 'selected' : '' }}>
                                            Mild Overweight</option>
                                        <option value="Overweight"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Overweight' ? 'selected' : '' }}>
                                            Overweight</option>
                                        <option value="Obesity"
                                            {{ isset($details['wasting_birth_to_5_boy']) && $details['wasting_birth_to_5_boy'] == 'Obesity' ? 'selected' : '' }}>
                                            Obesity</option>
                                        <!-- <option value="Severe Wasting (WHZ < -3)"
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
                                            Overweight (WHZ > +2)</option> -->
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

                <div class="form-row">
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
                    <div class="form-group col-12">
                        <label for="DietaryAdviceComment">Doctor Comment</label><br>
                        <textarea class="form-control w-100" name="doctor_comment" id="doctor_comment" rows="5"
                            required>
                            <?php echo isset($details['doctor_comment']) ? htmlspecialchars($details['doctor_comment']) : ''; ?>
                        </textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Submit</button>

            </div>


        </form>

    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
          let previousSelectedValues = [];

function updateFields() {
    const currentSelectedValues = $('#refer_to').val() || [];

    // Step 1: Find deselected values and hide corresponding fields
    const deselected = previousSelectedValues.filter(val => !currentSelectedValues.includes(val));
    deselected.forEach(function (val) {
        switch (val) {
            case "1":
                $('#followupphysiciandate').addClass('d-none');
                break;
            case "2":
                $('#followupnutitiondate').addClass('d-none');
                break;
            case "4":
                $('#followupexternalspecialistdate').addClass('d-none');
                break;
            case "5":
                $('#followupgeneralphysiciandate').addClass('d-none');
                break;
        }
    });

    // Step 2: Show fields for newly selected values
    currentSelectedValues.forEach(function (val) {
        switch (val) {
            case "1":
                $('#followupphysiciandate').removeClass('d-none');
                break;
            case "2":
                $('#followupnutitiondate').removeClass('d-none');
                break;
            case "4":
                $('#followupexternalspecialistdate').removeClass('d-none');
                break;
            case "5":
                $('#followupgeneralphysiciandate').removeClass('d-none');
                break;
        }
    });

    // Step 3: Update previous selection
    previousSelectedValues = [...currentSelectedValues];
}  
        $(document).ready(function() {

            updateFields();

                // Trigger the same function on change event
                $('#refer_to').on('change', function () {
                    updateFields();
                });


            /***************** Step One - Bio Data ****************/


            var $q31 = $("#Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber");
            var q31FullOptionsHtml = $q31.html();
            var $q31Label = $('label[for="Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber"]');
            function updateQ31OptionsByClass(val) {
                var numValue = parseFloat(val);
                if (!isNaN(numValue) && numValue <= 1) {
                    // Primary/Secondary classes: only show Normal and Needs assessment
                    $q31Label.text('Question No.31: Conclusion of Whisper testing ( pre primary)');
                    $q31.empty();
                    $q31.append('<option value="">Select</option>');
                    $q31.append('<option value="Normal">Normal</option>');
                    $q31.append('<option value="Needs assessment">Needs assessment</option>');
                    // Reset selection if previous value no longer exists
                    $q31.val('');
                } else {
                    // Nursery/Kindergarten classes: restore full option list
                     $q31Label.text('Question No.31: Conclusion of hearing test with Rinne and Weber');
                    $q31.html(q31FullOptionsHtml);
                }
            }

            /* Class */
            $("#class").on("keyup change", function() {

                var value = $(this).val();
                console.log("Original value:", value);
                updateQ31OptionsByClass(value);
                // First hide all sections
                $('#nursary_developmenr,#playground_kindergarten_social_emotional,#playground_kindergarten_autism_spectrum,#playgound_developmenr,#kindergarten_developmenr,#primary_secondary,#step16,#muac-container').addClass('d-none');
                
                switch(value) {
                  case "0000":
                    $('#nursary_developmenr,#playground_kindergarten_social_emotional,#playground_kindergarten_autism_spectrum,#step16,#muac-container').removeClass('d-none');
                    break;
                  case "0":
                    $('#playgound_developmenr,#playground_kindergarten_social_emotional,#playground_kindergarten_autism_spectrum,#step16,#muac-container').removeClass('d-none');
                    break;
                  case "00":
                    $('#kindergarten_developmenr,#playground_kindergarten_social_emotional,#playground_kindergarten_autism_spectrum,#step16,#muac-container').removeClass('d-none');
                    break;
                  case "000":
                    $('#kindergarten_developmenr,#playground_kindergarten_social_emotional,#playground_kindergarten_autism_spectrum,#step16,#muac-container').removeClass('d-none');
                    break;
                  default:
                    // Check if it's a number >= 1
                    var numValue = parseFloat(value);
                    if(!isNaN(numValue) && numValue >= 1) {
                        // $('#step16').removeClass('d-none');
                      $('#primary_secondary').removeClass('d-none');
                    //  $('#step16').addClass('d-none');
                    }
                    break;
                }
                
                // Adjust Q31 options based on class value
                updateQ31OptionsByClass(value);
               
                
                // After showing/hiding steps, ensure we're on a visible step
                var currentActiveStep = $('.step.active');
                if (currentActiveStep.hasClass('d-none')) {
                    // If current active step is now hidden, move to first visible step
                    currentActiveStep.removeClass('active');
                    $('.step:not(.d-none)').first().addClass('active');
                    console.log('Moved to first visible step due to class change');
                }

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
// Handle for18 class visibility based on gender and age (96 months = 8 years)
// var totalMonths = Math.floor(read_oly_age * 12);
if (gender == 'female' && totalMonths >= 96) {
    $('.for18').removeClass('d-none');
} else {
    $('.for18').addClass('d-none');
}
    

    if (today.getDate() < birthDate.getDate()) {
        totalMonths--;
    }

    // $("#age").val(age);
    var read_oly_age = (years + "." + months );
    console.log("read_oly_age ", read_oly_age);
    $("#read_oly_age").val(read_oly_age)
    console.log(totalMonths);
   
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
// if (parseFloat(actualage) < 5) {


//     /* Show the field and ensure the required attribute is present */
//     $('#muac').closest('.form-group').show();
//     $('#muac').attr('required', true);
//     $('#muac').val('');
//     $('#muac-container').show();


// } else {

//     /* Hide the field and remove the required attribute */
//     $('#muac').closest('.form-group').hide();
//     $('#muac').removeAttr('required');
//     $('#muac').val('');
//     $('#muac-container').hide();


// }


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
    'Severe Thinness': {
        nutritionalDiagnosis: "The child is severely malnourished, the z score indicates severe wasting which needs to be addressed immediately. It can also indicate any underlying medical condition causing this severe malnutrition. Ensure regular follow-ups with the health care provider",
        dietaryAdvice: "Consult a pediatrician and pediatric dietitian to get a tailored plan according to the energy requirements. Prioritize high-calorie, nutrient-dense foods including high protein options like eggs, meat, dairy and lentils and consider supplementation to support weight gain and recovery",

    },
    'Mild Thinness': {
        nutritionalDiagnosis: "The child is approaching underweight. Regular monitoring and preventive nutritional measures are advised.",
        dietaryAdvice: "Incorporate balanced meals with complex carbohydrates like whole grains, oats rice and whole grain pasta. - Add moderate amounts of healthy fats and proteins which includes all meats beans and lentils. - Introduce fortified cereals and dairy products to prevent micronutrient deficiency. - Encourage healthy snacking between meals, like yogurt or fruit",

    },
    'Mild Overweight': {
        nutritionalDiagnosis: "The child is approaching overweight. Promote healthy eating habits and active play to prevent further weight gain.",
        dietaryAdvice: "Replace sugary beverages with water or milk.- Limit processed and high-fat snacks; choose fresh fruits and whole foods.- Reduce portion sizes without skipping meals.- Encourage regular physical activity, such as outdoor play or sports.",

    },
    'Moderate Thinness': {
        nutritionalDiagnosis: "The child is underweight and at risk of health issues. The Z score indicates moderate wasting. Nutritional support and monitoring every 6 months are recommended.",
        dietaryAdvice: "Add nutrient-dense foods like whole grains, dairy, and proteins. - Increase intake of fruits and vegetables. - Focus on healthy fats and oils for cooking. - Ensure 5-6 small frequent meals throughout the day most of which contain protein sources such as meat, eggs, beans or lentils",

    },
    'Normal Weight': {
        nutritionalDiagnosis: "The child has a healthy weight for age and height. Encourage balanced nutrition and regular physical activity to maintain health.",
        dietaryAdvice: "Maintain a balanced diet with all food groups: carbohydrates, proteins, fats, fruits, and vegetables. - Limit sugary snacks and processed foods.- Encourage regular hydration with water.- Promote at least 40-60 minutes of daily physical activity.",

    },
    'Overweight': {
        nutritionalDiagnosis: "The child is overweight, increasing the risk of obesity-related health issues. Monitoring of calorie consumption and physical activity is needed  Early intervention with dietary and activity changes is needed",
        dietaryAdvice: "- Focus on portion control and regular meal timings.- Prioritize high-fiber foods like whole grains, fruits, and vegetables.- Avoid fried and sugary foods; use baking or steaming methods.- Introduce fun physical activities to reduce sedentary habits.",

    },
    'Obesity': {
        nutritionalDiagnosis: "The child has significant excess weight, posing a high risk of severe health problems. Comprehensive intervention is required, potentially involving healthcare professionals.",
        dietaryAdvice: "Consult a pediatric dietitian for a tailored plan. - Gradually reduce calorie intake while ensuring nutrient density. - Eliminate sugary drinks and high-fat junk foods.- Increase daily physical activity, aiming for structured sports or fitness routines.- Involve the family in adopting healthier eating and lifestyle habits.",

    }
    // "Severe Wasting (WHZ < -3)": {
    //     nutritionalDiagnosis: "Severe malnutrition related to inadequate energy intake as evidenced by a weight-for-height z-score (WHZ) less than -3, indicating severe wasting.",
    //     dietaryAdvice: "Prioritize high-calorie, nutrient-dense foods and consider supplementation to support weight gain and recovery."
    // },
    // "Moderate Wasting (WHZ between -3 and -2)": {
    //     nutritionalDiagnosis: "Moderate malnutrition related to insufficient nutrient intake and/or increased nutritional needs as evidenced by a WHZ between -3 and -2, indicating moderate wasting.",
    //     dietaryAdvice: "Incorporate balanced, calorie-rich meals and snacks with protein to improve nutritional status and growth."
    // },
    // "Normal (WHZ between -2 and +2)": {
    //     nutritionalDiagnosis: "Adequate nutritional status with balanced intake and growth as evidenced by a WHZ between -2 and +2.",
    //     dietaryAdvice: "Maintain a balanced diet that includes a variety of fruits, vegetables, whole grains, and protein sources."
    // },
    // "Overweight (WHZ > +2)": {
    //     nutritionalDiagnosis: "Overweight related to excessive energy intake or reduced physical activity as evidenced by a WHZ greater than +2.",
    //     dietaryAdvice: "Focus on nutrient-dense foods with controlled portion sizes and increase physical activity to support healthy weight management."
    // }


},
wasting_birth_to_5_boy: {
    'Severe Thinness': {
        nutritionalDiagnosis: "The child is severely malnourished, the z score indicates severe wasting which needs to be addressed immediately. It can also indicate any underlying medical condition causing this severe malnutrition. Ensure regular follow-ups with the health care provider",
        dietaryAdvice: "Consult a pediatrician and pediatric dietitian to get a tailored plan according to the energy requirements. Prioritize high-calorie, nutrient-dense foods including high protein options like eggs, meat, dairy and lentils and consider supplementation to support weight gain and recovery",

    },
    'Mild Thinness': {
        nutritionalDiagnosis: "The child is approaching underweight. Regular monitoring and preventive nutritional measures are advised.",
        dietaryAdvice: "Incorporate balanced meals with complex carbohydrates like whole grains, oats rice and whole grain pasta. - Add moderate amounts of healthy fats and proteins which includes all meats beans and lentils. - Introduce fortified cereals and dairy products to prevent micronutrient deficiency. - Encourage healthy snacking between meals, like yogurt or fruit",

    },
    'Mild Overweight': {
        nutritionalDiagnosis: "The child is approaching overweight. Promote healthy eating habits and active play to prevent further weight gain.",
        dietaryAdvice: "Replace sugary beverages with water or milk.- Limit processed and high-fat snacks; choose fresh fruits and whole foods.- Reduce portion sizes without skipping meals.- Encourage regular physical activity, such as outdoor play or sports.",

    },
    'Moderate Thinness': {
        nutritionalDiagnosis: "The child is underweight and at risk of health issues. The Z score indicates moderate wasting. Nutritional support and monitoring every 6 months are recommended.",
        dietaryAdvice: "Add nutrient-dense foods like whole grains, dairy, and proteins. - Increase intake of fruits and vegetables. - Focus on healthy fats and oils for cooking. - Ensure 5-6 small frequent meals throughout the day most of which contain protein sources such as meat, eggs, beans or lentils",

    },
    'Normal Weight': {
        nutritionalDiagnosis: "The child has a healthy weight for age and height. Encourage balanced nutrition and regular physical activity to maintain health.",
        dietaryAdvice: "Maintain a balanced diet with all food groups: carbohydrates, proteins, fats, fruits, and vegetables. - Limit sugary snacks and processed foods.- Encourage regular hydration with water.- Promote at least 40-60 minutes of daily physical activity.",

    },
    'Overweight': {
        nutritionalDiagnosis: "The child is overweight, increasing the risk of obesity-related health issues. Monitoring of calorie consumption and physical activity is needed  Early intervention with dietary and activity changes is needed",
        dietaryAdvice: "- Focus on portion control and regular meal timings.- Prioritize high-fiber foods like whole grains, fruits, and vegetables.- Avoid fried and sugary foods; use baking or steaming methods.- Introduce fun physical activities to reduce sedentary habits.",

    },
    'Obesity': {
        nutritionalDiagnosis: "The child has significant excess weight, posing a high risk of severe health problems. Comprehensive intervention is required, potentially involving healthcare professionals.",
        dietaryAdvice: "Consult a pediatric dietitian for a tailored plan. - Gradually reduce calorie intake while ensuring nutrient density. - Eliminate sugary drinks and high-fat junk foods.- Increase daily physical activity, aiming for structured sports or fitness routines.- Involve the family in adopting healthier eating and lifestyle habits.",

    }

//     "Severe Wasting (WHZ < -3)": {
//         nutritionalDiagnosis: "Severe malnutrition related to inadequate energy intake as evidenced by a weight-for-height z-score (WHZ) less than -3, indicating severe wasting.",
//         dietaryAdvice: "Prioritize high-calorie, nutrient-dense foods and consider supplementation to support weight gain and recovery."
//     },
//     "Moderate Wasting (WHZ between -3 and -2)": {
//         nutritionalDiagnosis: "Moderate malnutrition related to insufficient nutrient intake and/or increased nutritional needs as evidenced by a WHZ between -3 and -2, indicating moderate wasting.",
//         dietaryAdvice: "Incorporate balanced, calorie-rich meals and snacks with protein to improve nutritional status and growth."
//     },
//     "Normal (WHZ between -2 and +2)": {
//         nutritionalDiagnosis: "Adequate nutritional status with balanced intake and growth as evidenced by a WHZ between -2 and +2.",
//         dietaryAdvice: "Maintain a balanced diet that includes a variety of fruits, vegetables, whole grains, and protein sources."
//     },
//     "Overweight (WHZ > +2)": {
//         nutritionalDiagnosis: "Overweight related to excessive energy intake or reduced physical activity as evidenced by a WHZ greater than +2.",
//         dietaryAdvice: "Focus on nutrient-dense foods with controlled portion sizes and increase physical activity to support healthy weight management."
//     }
},

wasting_5_to_19_girl: {
    'Severe Thinness': {
        nutritionalDiagnosis: "The child is severely underweight, the z score indicates severe wasting which needs to be addressed immediately. It can also indicate any underlying medical condition causing this severe malnutrition. Ensure regular follow-ups with the health care provider",
        dietaryAdvice: "Increase calorie-dense foods: whole milk, nuts, seeds, cheese, peanut butter. - Include protein-rich foods like eggs, chicken, fish, and lentils. - Fortify meals with healthy fats. Use full fat dairy products - Provide frequent small meals with snacks in between. Consult a pediatric dietitian for a tailored plan",

    },
    'Mild Thinness': {
        nutritionalDiagnosis: "The child is approaching underweight. Regular monitoring and preventive nutritional measures are advised.",
        dietaryAdvice: "Incorporate balanced meals with complex carbohydrates like whole grains, oats rice and whole grain pasta. - Add moderate amounts of healthy fats and proteins which includes all meats beans and lentils. - Introduce fortified cereals and dairy products. - Encourage healthy snacking between meals, like yogurt or fruit.",

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
        dietaryAdvice: "Incorporate balanced meals with complex carbohydrates like whole grains, oats rice and whole grain pasta. - Add moderate amounts of healthy fats and proteins which includes all meats beans and lentils. - Introduce fortified cereals and dairy products. - Encourage healthy snacking between meals, like yogurt or fruit.",

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
    $('#Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day,#food_items,#Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to').on('change', function() {
        updateComments();
        setDataValueForOptions1();
    });




            // Mapping object for select box options and their data-value attributes
            const dataOptionsAttributes = {
        


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
                            months: totalMonths,
                        },
                        success: function(response) {
                            // Handle success response
                            console.log('Success:', response);
                            // console.log('Response status:', response.status);
                            // console.log('Response z_index:', response.z_index);

                            if (response ) {

                                const bmi61 = parseFloat($("#bmi61").val());

                                const Neg3SD = parseFloat(response.data.Neg3SD);
                                const Neg2SD = parseFloat(response.data.Neg2SD);
                                const Neg1SD = parseFloat(response.data.Neg1SD);
                                const Median = parseFloat(response.data.Median);
                                const Pos1SD = parseFloat(response.data.Pos1SD);
                                const Pos2SD = parseFloat(response.data.Pos2SD);
                                const Pos3SD = parseFloat(response.data.Pos3SD);

                                  console.log("---- BMI Form Birth ----");
                                console.log("bmi61 " , bmi61);
                                console.log("Neg3SD " , Neg3SD);
                                console.log("Neg2SD " , Neg2SD);
                                console.log("Neg1SD " , Neg1SD);
                                console.log("Median " , Median);
                                console.log("Pos1SD " , Pos1SD);
                                console.log("Pos2SD " , Pos2SD);
                                console.log("Pos3SD " , Pos3SD);

                                const dropdownId = $("#gender").val() === 'female' ? "#wasting_birth_to_5_girl" : "#wasting_birth_to_5_boy";

                                 if (bmi61 < parseFloat(Neg3SD)) {
                                     console.log('Severe Thinness');
                                    $(dropdownId).val('Severe Thinness');
                                    $(dropdownId).attr('style', 'background-color: red !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'red', 'color': 'white'});

                                    

                                // } else if (bmi61 > Neg3SD && bmi61 < Neg2SD) {
                                } else if (bmi61 >= parseFloat(Neg3SD) && bmi61 < parseFloat(Neg2SD)) {
                                   
                                    $(dropdownId).val('Moderate Thinness');
                                    $(dropdownId).attr('style', 'background-color: orange !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'orange', 'color': 'white'});
                                    
                                // } else if (bmi61 > Neg2SD && bmi61 < Pos1SD) {
                                } else if (bmi61 >= parseFloat(Neg2SD)  && bmi61 < parseFloat(Neg1SD)  ) {
                                  console.log('Mild Thinness');
                                    $(dropdownId).val('Mild Thinness');
                                    $(dropdownId).attr('style', 'background-color: yellow !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'yellow', 'color': 'white'});

                                // } else if (bmi61 > Pos1SD) {
                                }  else if (bmi61 >= parseFloat(Neg1SD) && bmi61 <= parseFloat(Pos1SD)) {
                                    console.log('Normal Weight');
                                    $(dropdownId).val('Normal Weight');
                                    $(dropdownId).attr('style', 'background-color: green !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'green', 'color': 'white'});

                                // } else if (bmi61 > Pos1SD) {
                                  }  else if (bmi61 > parseFloat(Pos1SD) && bmi61 <= parseFloat(Pos2SD) ) {
                                   console.log('Mild Overweight');
                                  $(dropdownId).val('Mild Overweight');
                                  $(dropdownId).attr('style', 'background-color: yellow !important; color: white !important;');
                                  $('#bmi61').css({'background-color': 'yellow', 'color': 'white'});

                              // } else if (bmi61 > Pos1SD) {
                              }else if (bmi61 > parseFloat(Pos2SD) && bmi61 <= parseFloat(Pos3SD)) {
                                    // console.log(parseFloat(Pos2SD + .1))
                                     console.log('Overweight');
                                    $(dropdownId).val('Overweight');
                                    $(dropdownId).attr('style', 'background-color: orange !important; color: black !important;');
                                    $('#bmi61').css({'background-color': 'orange', 'color': 'black'});
                                } 
                                // else if (bmi61 > Pos2SD) {
                                else if (bmi61 > parseFloat(Pos3SD)) {
                                     console.log("Obesity");
                                        // console.log(parseFloat(Pos2SD + .1));
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

                                  if (bmi61 < parseFloat(Neg3SD)) {
                                  //  if (bmi61 <= parseFloat(Neg2SD - .1)) {
                                    $(dropdownId).val('Severe Thinness');
                                    $(dropdownId).attr('style', 'background-color: red !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'red', 'color': 'white'});

                                    

                                // } else if (bmi61 > Neg3SD && bmi61 < Neg2SD) {
                                } else if (bmi61 >= parseFloat(Neg3SD) && bmi61 < parseFloat(Neg2SD)) {
                                    console.log(parseFloat(Pos2SD));
                                    $(dropdownId).val('Moderate Thinness');
                                    $(dropdownId).attr('style', 'background-color: orange !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'orange', 'color': 'white'});
                                    
                                // } else if (bmi61 > Neg2SD && bmi61 < Pos1SD) {
                                } else if (bmi61 >= parseFloat(Neg2SD)  && bmi61 < parseFloat(Neg1SD)  ) {
                                  console.log('Mild Thinness');
                                    $(dropdownId).val('Mild Thinness');
                                    $(dropdownId).attr('style', 'background-color: yellow !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'yellow', 'color': 'white'});

                                // } else if (bmi61 > Pos1SD) {
                                 }  else if (bmi61 >= parseFloat(Neg1SD) && bmi61 <= parseFloat(Pos1SD)) {
                                  
                                    $(dropdownId).val('Normal Weight');
                                    $(dropdownId).attr('style', 'background-color: green !important; color: white !important;');
                                    $('#bmi61').css({'background-color': 'green', 'color': 'white'});

                                // } else if (bmi61 > Pos1SD) {
                                 }  else if (bmi61 > parseFloat(Pos1SD) && bmi61 <= parseFloat(Pos2SD) ) {
                                  
                                  $(dropdownId).val('Mild Overweight');
                                  $(dropdownId).attr('style', 'background-color: yellow !important; color: white !important;');
                                  $('#bmi61').css({'background-color': 'yellow', 'color': 'white'});

                              // } else if (bmi61 > Pos1SD) {
                              }else if (bmi61 > parseFloat(Pos2SD) && bmi61 <= parseFloat(Pos3SD)) {
                                    console.log(parseFloat(Pos2SD ));
                                    $(dropdownId).val('Overweight');
                                    $(dropdownId).attr('style', 'background-color: orange !important; color: black !important;');
                                    $('#bmi61').css({'background-color': 'orange', 'color': 'black'});
                                } 
                                // else if (bmi61 > Pos2SD) {
                                else if (bmi61 > parseFloat(Pos3SD)) {
                                        console.log(parseFloat(Pos2SD));
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



                                // helper to reliably set dropdown value and update UI (available to both branches)
                                function setDropdownValue(ddId, val) {
                                    var $dd = $(ddId);
                                    var $opt = $dd.find('option[value="' + val + '"]');
                                    if ($opt.length) {
                                        $opt.prop('selected', true);
                                        // suppress change handling while programmatically updating
                                        window.__suppressNutritionistChange = true;
                                        $dd.val(val).trigger('change');
                                        // release suppression after event dispatch completes
                                        setTimeout(function(){ window.__suppressNutritionistChange = false; }, 0);
                                    } else {
                                        console.warn('Option not found for', ddId, val);
                                    }
                                }

                                if($("#read_oly_age").val() >= 5 && $("#read_oly_age").val() <= 19)
                                {
                                    const dropdownId = $("#gender").val() === 'female' ? "#stunting_5_19_girl" : "#stunting_5_19_boy";

                                    if (Question_No_1_Height <= SD3neg) {
                                        console.log("SD3neg ");
                                        setDropdownValue(dropdownId, 'Severe Stunting');
                                        $(dropdownId).attr('style', 'background-color: red !important; color: white !important;');
                                    }
                                    else if (Question_No_1_Height > SD3neg && Question_No_1_Height <= SD2neg) {
                                        console.log("Stunting ");
                                        setDropdownValue(dropdownId, 'Stunting');
                                    $(dropdownId).attr('style', 'background-color: yellow !important; color: black !important;');

                                    }
                                    else if (Question_No_1_Height > SD2neg && Question_No_1_Height <= SD2) {
                                        console.log("Normal");
                                        setDropdownValue(dropdownId, 'Normal');
                                    $(dropdownId).attr('style', 'background-color: green !important; color: white !important;');

                                    }
                                    else if (Question_No_1_Height >= SD2) {
                                        console.log("Tall");
                                        setDropdownValue(dropdownId, 'Tall');
                                        $(dropdownId).attr('style', 'background-color: blue !important; color: white !important;');

                                    }
                                    else {
                                        console.log("Unknown Classification");
                                        $(dropdownId).val('');
                                    }

                                
                                }
                                else if($("#read_oly_age").val() < 2)
                                {
                                    const dropdownId = $("#gender").val() === 'female' ? "#stunting_birth_to_2_girl" : "#stunting_birth_to_2_boy";

                                    if (Question_No_1_Height <= SD3neg) {
                                        console.log("Severe Stunting (LAZ < -3)");
                                        setDropdownValue(dropdownId, 'Severe Stunting (LAZ < -3)');
                                        $(dropdownId).attr('style', 'background-color: red !important; color: white !important;');
                                    }
                                    else if (Question_No_1_Height > SD3neg && Question_No_1_Height <= SD2neg) {
                                        console.log("Stunting (LAZ between -3 and -2)");
                                        setDropdownValue(dropdownId, 'Stunting (LAZ between -3 and -2)');
                                        $(dropdownId).attr('style', 'background-color: yellow !important; color: black !important;');
                                    }
                                    else if (Question_No_1_Height > SD2neg && Question_No_1_Height <= SD2) {
                                        console.log("Normal (LAZ between -2 and +2)");
                                        setDropdownValue(dropdownId, 'Normal (LAZ between -2 and +2)');
                                        $(dropdownId).attr('style', 'background-color: green !important; color: white !important;');
                                    }
                                    else if ( Question_No_1_Height > SD2) {
                                        console.log("Tall (LAZ > +2)");
                                        setDropdownValue(dropdownId, 'Tall (LAZ > +2)');
                                        $(dropdownId).attr('style', 'background-color: blue !important; color: white !important;');
                                    }
                                    else {
                                        console.log("Unknown Classification");
                                        $(dropdownId).val('');
                                    }

                                }
                                else if($("#read_oly_age").val() >= 2 && $("#read_oly_age").val() <= 5)
                                {
                                    const dropdownId = $("#gender").val() === 'female' ? "#stunting_2_5_girl" : "#stunting_2_5_boy";

                                    if (Question_No_1_Height <= SD3neg) {
                                        console.log("Severe Stunting (LAZ/HAZ < -3)");
                                        setDropdownValue(dropdownId, 'Severe Stunting (LAZ/HAZ < -3)');
                                        $(dropdownId).attr('style', 'background-color: red !important; color: white !important;');
                                    }
                                    else if (Question_No_1_Height > SD3neg && Question_No_1_Height <= SD2neg) {
                                        console.log("Stunting (LAZ/HAZ between -3 and -2)");
                                        setDropdownValue(dropdownId, 'Stunting (LAZ/HAZ between -3 and -2)');
                                        $(dropdownId).attr('style', 'background-color: yellow !important; color: black !important;');
                                    }
                                    else if (Question_No_1_Height > SD2neg && Question_No_1_Height <= SD2) {
                                        console.log("Normal (LAZ/HAZ between -2 and +2)");
                                        setDropdownValue(dropdownId, 'Normal (LAZ/HAZ between -2 and +2)');
                                        $(dropdownId).attr('style', 'background-color: green !important; color: white !important;');
                                    }
                                    else if ( Question_No_1_Height > SD2) {
                                        console.log("Tall (LAZ/HAZ > +2)");
                                        setDropdownValue(dropdownId, 'Tall (LAZ/HAZ > +2)');
                                        $(dropdownId).attr('style', 'background-color: blue !important; color: white !important;');
                                    }
                                    else {
                                        console.log("Unknown Classification");
                                        $(dropdownId).val('');
                                    }

                                    
                                } else{
                                    
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

            // Attach change events with suppression to avoid recursive triggers
            window.__suppressNutritionistChange = false;
            $('.NutritionistSelectWasting, .NutritionistSelectStunting').on('change', function() {
                if (window.__suppressNutritionistChange) {
                    return; // skip updates triggered programmatically
                }
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
                var ageRaw = parseFloat($('#age').val());

                // Normalize decimal age: < .7 => floor, >= .7 => round up
                var ageNormalized = null;
                if (!isNaN(ageRaw)) {
                    var base = Math.floor(ageRaw);
                    var frac = ageRaw - base;
                    ageNormalized = base + (frac >= 0.7 ? 1 : 0);
                }

                var $status = $("#Blood_Pressure_Systolic");
                $status.text("").removeClass("text-success text-danger");
                $("#systolicresult").val("");

                // Age-based normal ranges using normalized age
                var min = null, max = null;
                if (!isNaN(ageNormalized)) {
                    if (ageNormalized >= 10 && ageNormalized <= 11) { // prioritize 10-11 specific range
                        min = 110; max = 120;
                    } else if (ageNormalized >= 1 && ageNormalized <= 4) {
                        min = 100; max = 110;
                    } else if (ageNormalized >= 5 && ageNormalized <= 9) {
                        min = 105; max = 120;
                    } else if (ageNormalized >= 12 && ageNormalized <= 13) {
                        min = 110; max = 130;
                    }else if (ageNormalized > 13) {
                        min = 131; max = 200;
                    }
                }

                if (min !== null && max !== null && !isNaN(systolic)) {
                    if (systolic < min) {
                        $status.text("LOW").addClass("text-danger");
                        $("#systolicresult").val("LOW");
                    } else if (systolic > max) {
                        $status.text("Elevated").addClass("text-danger");
                        $("#systolicresult").val("Elevated");
                    } else {
                        $status.text("Normal").addClass("text-success");
                        $("#systolicresult").val("Normal");
                    }
                }
            }).trigger('change');


            /* Question_No_6_Blood_Pressure_Diastolic */

            $("#Question_No_6_Blood_Pressure_Diastolic").on("keyup change", function(e) {
                var diastolic = parseInt($('#Question_No_6_Blood_Pressure_Diastolic').val());
                var ageRaw = parseFloat($('#age').val());

                // Normalize decimal age: < .7 => floor, >= .7 => round up (e.g., 8.6 => 8, 8.7 => 9)
                var ageNormalized = null;
                if (!isNaN(ageRaw)) {
                    var base = Math.floor(ageRaw);
                    var frac = ageRaw - base;
                    ageNormalized = base + (frac >= 0.7 ? 1 : 0);
                }

                var $status = $("#Blood_Pressure_Diastolic");
                $status.text("").removeClass("text-success text-danger");
                $("#diastolicresult").val("");

                // Age-based diastolic ranges
                var min = null, max = null;
                if (!isNaN(ageNormalized)) {
                    if (ageNormalized >= 10 && ageNormalized <= 11) { // prioritize 10-11 specific range
                        min = 70; max = 80;
                    } else if (ageNormalized >= 1 && ageNormalized <= 4) {
                        min = 50; max = 65;
                    } else if (ageNormalized >= 5 && ageNormalized <= 9) {
                        min = 65; max = 80;
                    } else if (ageNormalized >= 12 && ageNormalized <= 13) {
                        min = 70; max = 80;
                    } else if (ageNormalized >= 14 && ageNormalized <= 80) {
                        min = 70; max = 80;
                    }
                }

                if (min !== null && !isNaN(diastolic)) {
                    if (diastolic < min) {
                        $status.text("LOW").addClass("text-danger");
                        $("#diastolicresult").val("LOW");
                    } else if (diastolic > max) {
                        $status.text("Elevated").addClass("text-danger");
                        $("#diastolicresult").val("Elevated");
                    } else {
                        $status.text("Normal").addClass("text-success");
                        $("#diastolicresult").val("Normal");
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

            }).trigger("change");


            $("#Question_No_21_Any_Hair_Problem").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Kinky' || Formvalue == 'Brittle' || Formvalue == 'Dry') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger("change");


            $("#Question_No_22_Scalp").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Scaly' || Formvalue == 'Dry' || Formvalue == 'Moist') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger("change");


            $("#Question_No_23_Hair_Distribution").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Patchy' || Formvalue == 'Receding' || Formvalue == 'Receding_Hair_Line') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');

                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                    this.style.setProperty('color', 'black', 'important');

                }

            }).trigger("change");


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
                if (Formvalue == 'Vesicular_Breathing' || Formvalue == '') {

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');

                } else {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');
                }

            }).trigger('change');
  $("#Question_No_48_Frequently_put_things_in_mouth").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {

                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');
                   

                } else {

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');
                $("#Question_No_49_Child_eat_non_food_items_pica").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                    this.style.setProperty('color', 'white', 'important');
                   

                } else {

                    this.style.setProperty('color', 'black', 'important');
                    this.style.setProperty('background-color', 'white', 'important');
                }

            }).trigger('change');

            // Compute Lead Exposure Result: Yes (red) if any Q48/Q49 is Yes or Q50/Q51 is not "None"
            function computeExposureResult() {
                var v48 = ($('#Question_No_48_Frequently_put_things_in_mouth').val() || '').toLowerCase();
                var v49 = ($('#Question_No_49_Child_eat_non_food_items_pica').val() || '').toLowerCase();
                var v50 = ($('#Question_No_50_Contact_adult_job_lead_exposure').val() || '').toLowerCase();
                var v51 = ($('#Question_No_51_Contact_adult_hobby_lead_exposure').val() || '').toLowerCase();

                var anyYes = (v48 === 'yes') || (v49 === 'yes')
                    || (v50 !== '' && v50 !== 'none of above')
                    || (v51 !== '' && v51 !== 'none of the above');

                var $out = $('#expouser_result');
                if ($out.length) {
                    if (anyYes) {
                        $out.val('Yes');
                        $out.css({'background-color': 'red', 'color': 'white'});
                    } else {
                        $out.val('No');
                        $out.css({'background-color': 'green', 'color': 'white'});
                    }
                }
            }

            // Bind events and initialize on load
            $('#Question_No_48_Frequently_put_things_in_mouth, #Question_No_49_Child_eat_non_food_items_pica, #Question_No_50_Contact_adult_job_lead_exposure, #Question_No_51_Contact_adult_hobby_lead_exposure')
                .on('keyup change', computeExposureResult);
            computeExposureResult();

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



                    } else if (selectedValue === 'Moderately Active') {


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
                   
                    $('#food_allergiesContainer').removeClass('d-none');

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
                
                // Find the previous visible step (not hidden with d-none)
                while (prevStep.length > 0 && prevStep.hasClass('d-none')) {
                    prevStep = prevStep.prev('.step');
                }

                // Move to the previous step
                if (prevStep.length > 0) {
                    currentStep.removeClass('active');
                    prevStep.addClass('active');
                }
            });

            $('.form-group').on('blur change', '.error-border', function() {
                if ($(this).val()) {
                    $(this).removeClass('error-border').closest('.form-group').find('.error-text').remove();
                }
            })












            /****** Next Step ******/
            $('.nextStep').on('click', function(e) {



                const currentStep = $('.step.active'); // Get the current active step
                const visibleSteps = $('.step:not(.d-none)');
                
                // Check if current step is visible, if not find the correct position
                let currentStepNumber;
                if (currentStep.hasClass('d-none')) {
                    // If current active step is hidden, find its position among all steps
                    currentStepNumber = $('.step').index(currentStep) + 1;
                } else {
                    // If current step is visible, find its position among visible steps
                    currentStepNumber = visibleSteps.index(currentStep) + 1;
                }
                
                const totalVisibleSteps = visibleSteps.length;
                console.log("Current Step Number:", currentStepNumber);
                console.log("Total Visible Steps:", totalVisibleSteps);
                console.log("Is Current Step Hidden:", currentStep.hasClass('d-none'));

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


                                // Recalculate current step number based on visible steps
                                var currentActiveStep = $('.step.active');
                                var visibleSteps = $('.step:not(.d-none)');
                                var recalculatedStepNumber = visibleSteps.index(currentActiveStep) + 1;
                                var totalVisibleSteps = visibleSteps.length;
                                var isLastStep = (recalculatedStepNumber === totalVisibleSteps);
                                var screeningFormId = $("input[name='screeningFormId']").val();
                                console.log("Submit Check - Original Step Number:", currentStepNumber);
                                console.log("Submit Check - Recalculated Step Number:", recalculatedStepNumber);
                                console.log("Submit Check - Total Visible Steps:", totalVisibleSteps);
                                console.log("Submit Check - Is Last Step:", isLastStep);
                                console.log("Submit Check - Screening Form ID:", screeningFormId);
                                
                                /*  Last Step - Submit Form */
                                if (isLastStep && screeningFormId == 0) {
                                    console.log("Executing: New form submission (screeningFormId = 0)");
                                    redirectUrl = "{{ route('Screening') }}";
                                    window.location.href = redirectUrl;
                                } else if (isLastStep && screeningFormId > 0) {
                                    console.log("Executing: Update form submission (screeningFormId > 0)");
                                    redirectUrl = "{{ route('Details') }}/" + screeningFormId;
                                    window.location.href = redirectUrl;
                                } else if (isLastStep) {
                                    console.log("Last step but no valid screeningFormId condition met");
                                } else {
                                    console.log("Not the last step, continuing to next step");
                                }

                                $("input[name='updateID']").val(response
                                    .storedRecordId);

                                // window.location.href = redirectUrl;

                                console.log("redirectUrl " + redirectUrl);

                                currentStep.removeClass('active').addClass('completed');
                                
                                // Find the next visible step (not hidden with d-none)
                                var nextStep = currentStep.next('.step');
                                while (nextStep.length > 0 && nextStep.hasClass('d-none')) {
                                    nextStep = nextStep.next('.step');
                                }
                                
                                if (nextStep.length > 0) {
                                    nextStep.addClass('active');
                                }

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



                            // Recalculate for button text as well
                            var currentActiveStep = $('.step.active');
                            var visibleSteps = $('.step:not(.d-none)');
                            var recalculatedStepNumber = visibleSteps.index(currentActiveStep) + 1;
                            var totalVisibleSteps = visibleSteps.length;
                            
                            console.log("Button Text Check - Original Step:", currentStepNumber);
                            console.log("Button Text Check - Recalculated Step:", recalculatedStepNumber);
                            console.log("Button Text Check - Total Visible Steps:", totalVisibleSteps);
                            
                            if (recalculatedStepNumber < totalVisibleSteps) {
                                console.log("Setting button text to: Next");
                                submitBtn.text('Next').attr('disabled', false);


                            } else {
                                console.log("Setting button text to: Submit");
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


// new pshycology code
$('.playground-cognitive').on('change', function () {
       var play_ground_Cognitive_Result = 0;
        var q59 = $('select[name="QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box"]').val();
        var q60 = $('select[name="QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone"]').val();
                switch(q59){
                    case 'Yes':
                        play_ground_Cognitive_Result += 0;
                        break;
                        case 'Sometimes':
                            play_ground_Cognitive_Result += 1;
                            break;
                            case 'No':
                                play_ground_Cognitive_Result += 2;
                                break;
                }
                switch(q60){
                    case 'Yes':
                        play_ground_Cognitive_Result += 0;
                        break;
                        case 'Sometimes':
                            play_ground_Cognitive_Result += 1;
                            break;
                            case 'No':
                                play_ground_Cognitive_Result += 2;
                                break;
                }
                 if(play_ground_Cognitive_Result <= 2){
                 $('#play_ground_Cognitive_Result').val('Healthy Cognitions');
                 $('#play_ground_Cognitive_Result').css('background-color', 'green');
                 $('#play_ground_Cognitive_Result').css('color', 'white');
                }else{
                    $('#play_ground_Cognitive_Result').val(' Needs Assessment ');
                    $('#play_ground_Cognitive_Result').css('background-color', 'red');
                    $('#play_ground_Cognitive_Result').css('color', 'white');
                }
        console.log('Q59:', q59);
        console.log('Q60:', q60);
        console.log('Q60:', play_ground_Cognitive_Result);
        
        // Individual Cognitive Total Score
        var cognitiveTotalScore = play_ground_Cognitive_Result;
        $('#playground_cognitive_total_score').val(cognitiveTotalScore);
     
    }).trigger("change");

// Temperature indicator: 96–99.1°F = green, otherwise red
$('#Question_No_4_Body_Temperature').on('input change', function() {
    var $this = $(this);
    var raw = ($this.val() || '').toString().trim();
    if (raw === '') {
        $this.css({'background-color':'', 'color':''});
        return;
    }
    var val = parseFloat(raw);
    if (!isNaN(val) && val >= 96 && val <= 99.1) {
        $this.css({'background-color':'green', 'color':'white'});
    } else {
        $this.css({'background-color':'red', 'color':'white'});
    }
}).trigger('change');

    // Playground Motor
    $('.playground-motor').on('change', function () {
        var play_ground_Motor_Result = 0;
        var q61 = $('select[name="QuestionNo_61_Can_your_child_walk_without_help"]').val();
        var q62 = $('select[name="QuestionNo_62_Can_your_child_stack_two_or_more_blocks"]').val();
        
        switch(q61){
            case 'Yes':
                play_ground_Motor_Result += 0;
                break;
            case 'Sometimes':
                play_ground_Motor_Result += 1;
                break;
            case 'No':
                play_ground_Motor_Result += 2;
                break;
        }
        switch(q62){
            case 'Yes':
                play_ground_Motor_Result += 0;
                break;
            case 'Sometimes':
                play_ground_Motor_Result += 1;
                break;
            case 'No':
                play_ground_Motor_Result += 2;
                break;
        }
        
        if(play_ground_Motor_Result <= 2){
            $('#play_ground_Motor_Result').val('Well-Coordinated');
            $('#play_ground_Motor_Result').css('background-color', 'green');
            $('#play_ground_Motor_Result').css('color', 'white');
        }else{
            $('#play_ground_Motor_Result').val('Needs Assessment');
            $('#play_ground_Motor_Result').css('background-color', 'red');
            $('#play_ground_Motor_Result').css('color', 'white');
        }
        console.log('Motor Result:', play_ground_Motor_Result);
        
        // Individual Motor Total Score
        var motorTotalScore = play_ground_Motor_Result;
        $('#playground_motor_total_score').val(motorTotalScore);
   
    }).trigger("change");

    // Playground Language
    $('.playground-language').on('change', function () {
        var play_ground_Language_Result = 0;
        var q63 = $('select[name="QuestionNo_63_Does_your_child_point_to_objects_when_named"]').val();
        var q64 = $('select[name="QuestionNo_64_Can_your_child_say_at_least_5_10_words"]').val();
        
        switch(q63){
            case 'Yes':
                play_ground_Language_Result += 0;
                break;
            case 'Sometimes':
                play_ground_Language_Result += 1;
                break;
            case 'No':
                play_ground_Language_Result += 2;
                break;
        }
        switch(q64){
            case 'Yes':
                play_ground_Language_Result += 0;
                break;
            case 'Sometimes':
                play_ground_Language_Result += 1;
                break;
            case 'No':
                play_ground_Language_Result += 2;
                break;
        }
        
        if(play_ground_Language_Result <= 2){
            $('#play_ground_Language_Result').val('Clear Communicator');
            $('#play_ground_Language_Result').css('background-color', 'green');
            $('#play_ground_Language_Result').css('color', 'white');
        }else{
            $('#play_ground_Language_Result').val('Needs Assessment');
            $('#play_ground_Language_Result').css('background-color', 'red');
            $('#play_ground_Language_Result').css('color', 'white');
        }
        console.log('Language Result:', play_ground_Language_Result);
        
        // Individual Language Total Score
        var languageTotalScore = play_ground_Language_Result;
        $('#playground_language_total_score').val(languageTotalScore);
 
    }).trigger("change");

    // Playground Social-Emotional
    $('.playground-social-emotional').on('change', function () {
        var play_ground_SocialEmotional_Result = 0;
        var q65 = $('select[name="QuestionNo_65_Does_your_child_show_affection_to_familiar_people"]').val();
        var q66 = $('select[name="QuestionNo_66_Does_your_child_get_upset_when_separated_from_you"]').val();
        
        switch(q65){
            case 'Yes':
                play_ground_SocialEmotional_Result += 0;
                break;
            case 'Sometimes':
                play_ground_SocialEmotional_Result += 1;
                break;
            case 'No':
                play_ground_SocialEmotional_Result += 2;
                break;
        }
        switch(q66){
            case 'Yes':
                play_ground_SocialEmotional_Result += 0;
                break;
            case 'Sometimes':
                play_ground_SocialEmotional_Result += 1;
                break;
            case 'No':
                play_ground_SocialEmotional_Result += 2;
                break;
        }
        
        if(play_ground_SocialEmotional_Result <= 2){
            $('#play_ground_SocialEmotional_Result').val('Socially Engaged');
            $('#play_ground_SocialEmotional_Result').css('background-color', 'green');
            $('#play_ground_SocialEmotional_Result').css('color', 'white');
        }else{
            $('#play_ground_SocialEmotional_Result').val('Needs Assessment');
            $('#play_ground_SocialEmotional_Result').css('background-color', 'red');
            $('#play_ground_SocialEmotional_Result').css('color', 'white');
        }
        console.log('Social-Emotional Result:', play_ground_SocialEmotional_Result);
        
        // Individual Social-Emotional Total Score
        var socialEmotionalTotalScore = play_ground_SocialEmotional_Result;
        $('#playground_social_emotional_total_score').val(socialEmotionalTotalScore);
       
    }).trigger("change");

    // Playground Adaptive
    $('.playground-adaptive').on('change', function () {
        var play_ground_Adaptive_Result = 0;
        var q67 = $('select[name="QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon"]').val();
        var q68 = $('select[name="QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help"]').val();
        
        switch(q67){
            case 'Yes':
                play_ground_Adaptive_Result += 0;
                break;
            case 'Sometimes':
                play_ground_Adaptive_Result += 1;
                break;
            case 'No':
                play_ground_Adaptive_Result += 2;
                break;
        }
        switch(q68){
            case 'Yes':
                play_ground_Adaptive_Result += 0;
                break;
            case 'Sometimes':
                play_ground_Adaptive_Result += 1;
                break;
            case 'No':
                play_ground_Adaptive_Result += 2;
                break;
        }
        
        if(play_ground_Adaptive_Result <= 2){
            $('#play_ground_Adaptive_Result').val('Good Adaptability');
            $('#play_ground_Adaptive_Result').css('background-color', 'green');
            $('#play_ground_Adaptive_Result').css('color', 'white');
        }else{
            $('#play_ground_Adaptive_Result').val('Needs Assessment');
            $('#play_ground_Adaptive_Result').css('background-color', 'red');
            $('#play_ground_Adaptive_Result').css('color', 'white');
        }
        console.log('Adaptive Result:', play_ground_Adaptive_Result);
        
        // Individual Adaptive Total Score
        var adaptiveTotalScore = play_ground_Adaptive_Result;
        $('#playground_adaptive_total_score').val(adaptiveTotalScore);
  
    }).trigger("change");

    // Nursery Cognitive
    $('.nursery-cognitive').on('change', function () {
        var nursery_Cognitive_Result = 0;
        var q69 = $('select[name="QuestionNo_69_Can_your_child_complete_a_simple_puzzle"]').val();
        var q70 = $('select[name="QuestionNo_70_Does_your_child_match_similar_objects"]').val();
        
        switch(q69){
            case 'Yes':
                nursery_Cognitive_Result += 0;
                break;
            case 'Sometimes':
                nursery_Cognitive_Result += 1;
                break;
            case 'No':
                nursery_Cognitive_Result += 2;
                break;
        }
        switch(q70){
            case 'Yes':
                nursery_Cognitive_Result += 0;
                break;
            case 'Sometimes':
                nursery_Cognitive_Result += 1;
                break;
            case 'No':
                nursery_Cognitive_Result += 2;
                break;
        }
        
        if(nursery_Cognitive_Result <= 2){
            $('#nursery_Cognitive_Result').val('Healthy Cognitions');
            $('#nursery_Cognitive_Result').css('background-color', 'green');
            $('#nursery_Cognitive_Result').css('color', 'white');
        }else{
            $('#nursery_Cognitive_Result').val('Needs Assessment');
            $('#nursery_Cognitive_Result').css('background-color', 'red');
            $('#nursery_Cognitive_Result').css('color', 'white');
        }
        
        // Individual Cognitive Total Score
        var cognitiveTotalScore = nursery_Cognitive_Result;
        $('#nursery_cognitive_total_score').val(cognitiveTotalScore);
        
        console.log('Nursery Cognitive Result:', nursery_Cognitive_Result);
    }).trigger("change");

    // Nursery Motor
    $('.nursery-motor').on('change', function () {
        var nursery_Motor_Result = 0;
        var q71 = $('select[name="QuestionNo_71_Can_your_child_jump_with_both_feet"]').val();
        var q72 = $('select[name="QuestionNo_72_Can_your_child_draw_a_line_or_circle"]').val();
        
        switch(q71){
            case 'Yes':
                nursery_Motor_Result += 0;
                break;
            case 'Sometimes':
                nursery_Motor_Result += 1;
                break;
            case 'No':
                nursery_Motor_Result += 2;
                break;
        }
        switch(q72){
            case 'Yes':
                nursery_Motor_Result += 0;
                break;
            case 'Sometimes':
                nursery_Motor_Result += 1;
                break;
            case 'No':
                nursery_Motor_Result += 2;
                break;
        }
        
        if(nursery_Motor_Result <= 2){
            $('#nursery_Motor_Result').val('Well-Coordinated');
            $('#nursery_Motor_Result').css('background-color', 'green');
            $('#nursery_Motor_Result').css('color', 'white');
        }else{
            $('#nursery_Motor_Result').val('Needs Assessment');
            $('#nursery_Motor_Result').css('background-color', 'red');
            $('#nursery_Motor_Result').css('color', 'white');
        }
        
        // Individual Motor Total Score
        var motorTotalScore = nursery_Motor_Result;
        $('#nursery_motor_total_score').val(motorTotalScore);
        
        console.log('Nursery Motor Result:', nursery_Motor_Result);
    }).trigger("change");

    // Nursery Language
    $('.nursery-language').on('change', function () {
        var nursery_Language_Result = 0;
        var q73 = $('select[name="QuestionNo_73_Can_your_child_form_2_to_3_word_phrases"]').val();
        var q74 = $('select[name="QuestionNo_74_Does_your_child_ask_simple_questions"]').val();
        
        switch(q73){
            case 'Yes':
                nursery_Language_Result += 0;
                break;
            case 'Sometimes':
                nursery_Language_Result += 1;
                break;
            case 'No':
                nursery_Language_Result += 2;
                break;
        }
        switch(q74){
            case 'Yes':
                nursery_Language_Result += 0;
                break;
            case 'Sometimes':
                nursery_Language_Result += 1;
                break;
            case 'No':
                nursery_Language_Result += 2;
                break;
        }
        
        if(nursery_Language_Result <= 2){
            $('#nursery_Language_Result').val('Clear Communicator');
            $('#nursery_Language_Result').css('background-color', 'green');
            $('#nursery_Language_Result').css('color', 'white');
        }else{
            $('#nursery_Language_Result').val('Needs Assessment');
            $('#nursery_Language_Result').css('background-color', 'red');
            $('#nursery_Language_Result').css('color', 'white');
        }
        
        // Individual Language Total Score
        var languageTotalScore = nursery_Language_Result;
        $('#nursery_language_total_score').val(languageTotalScore);
        
        console.log('Nursery Language Result:', nursery_Language_Result);
    }).trigger("change");

    // Nursery Social-Emotional
    $('.nursery-social-emotional').on('change', function () {
        var nursery_SocialEmotional_Result = 0;
        var q75 = $('select[name="QuestionNo_75_Does_your_child_play_pretend"]').val();
        var q76 = $('select[name="QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings"]').val();
        
        switch(q75){
            case 'Yes':
                nursery_SocialEmotional_Result += 0;
                break;
            case 'Sometimes':
                nursery_SocialEmotional_Result += 1;
                break;
            case 'No':
                nursery_SocialEmotional_Result += 2;
                break;
        }
        switch(q76){
            case 'Yes':
                nursery_SocialEmotional_Result += 0;
                break;
            case 'Sometimes':
                nursery_SocialEmotional_Result += 1;
                break;
            case 'No':
                nursery_SocialEmotional_Result += 2;
                break;
        }
        
        if(nursery_SocialEmotional_Result <= 2){
            $('#nursery_SocialEmotional_Result').val('Socially Engaged');
            $('#nursery_SocialEmotional_Result').css('background-color', 'green');
            $('#nursery_SocialEmotional_Result').css('color', 'white');
        }else{
            $('#nursery_SocialEmotional_Result').val('Needs Assessment');
            $('#nursery_SocialEmotional_Result').css('background-color', 'red');
            $('#nursery_SocialEmotional_Result').css('color', 'white');
        }
        
        // Individual Social-Emotional Total Score
        var socialEmotionalTotalScore = nursery_SocialEmotional_Result;
        $('#nursery_social_emotional_total_score').val(socialEmotionalTotalScore);
        
        console.log('Nursery Social-Emotional Result:', nursery_SocialEmotional_Result);
    }).trigger("change");

    // Nursery Adaptive
    $('.nursery-adaptive').on('change', function () {
        var nursery_Adaptive_Result = 0;
        var q77 = $('select[name="QuestionNo_77_Can_your_child_take_off_some_clothes_without_help"]').val();
        var q78 = $('select[name="QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training"]').val();
        
        switch(q77){
            case 'Yes':
                nursery_Adaptive_Result += 0;
                break;
            case 'Sometimes':
                nursery_Adaptive_Result += 1;
                break;
            case 'No':
                nursery_Adaptive_Result += 2;
                break;
        }
        switch(q78){
            case 'Yes':
                nursery_Adaptive_Result += 0;
                break;
            case 'Sometimes':
                nursery_Adaptive_Result += 1;
                break;
            case 'No':
                nursery_Adaptive_Result += 2;
                break;
        }
        
        if(nursery_Adaptive_Result <= 2){
            $('#nursery_Adaptive_Result').val('Good Adaptability');
            $('#nursery_Adaptive_Result').css('background-color', 'green');
            $('#nursery_Adaptive_Result').css('color', 'white');
        }else{
            $('#nursery_Adaptive_Result').val('Needs Assessment');
            $('#nursery_Adaptive_Result').css('background-color', 'red');
            $('#nursery_Adaptive_Result').css('color', 'white');
        }
        
        // Individual Adaptive Total Score
        var adaptiveTotalScore = nursery_Adaptive_Result;
        $('#nursery_adaptive_total_score').val(adaptiveTotalScore);
        
        console.log('Nursery Adaptive Result:', nursery_Adaptive_Result);
    }).trigger("change")            ;

    // Kindergarten Cognitive
    $('.kindergarten-cognitive').on('change', function () {
        var kindergarten_Cognitive_Result = 0;
        var q79 = $('select[name="QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors"]').val();
        var q80 = $('select[name="QuestionNo_80_Can_your_child_follow_two_step_directions"]').val();
        
        switch(q79){
            case 'Yes':
                kindergarten_Cognitive_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_Cognitive_Result += 1;
                break;
            case 'No':
                kindergarten_Cognitive_Result += 2;
                break;
        }
        switch(q80){
            case 'Yes':
                kindergarten_Cognitive_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_Cognitive_Result += 1;
                break;
            case 'No':
                kindergarten_Cognitive_Result += 2;
                break;
        }
        
        if(kindergarten_Cognitive_Result <= 2){
            $('#kindergarten_Cognitive_Result').val('Healthy Cognitions');
            $('#kindergarten_Cognitive_Result').css('background-color', 'green');
            $('#kindergarten_Cognitive_Result').css('color', 'white');
        }else{
            $('#kindergarten_Cognitive_Result').val('Needs Assessment');
            $('#kindergarten_Cognitive_Result').css('background-color', 'red');
            $('#kindergarten_Cognitive_Result').css('color', 'white');
        }
        
        // Individual Cognitive Total Score
        var cognitiveTotalScore = kindergarten_Cognitive_Result;
        $('#kindergarten_cognitive_total_score').val(cognitiveTotalScore);
       
        console.log('Kindergarten Cognitive Result:', kindergarten_Cognitive_Result);
    }).trigger("change");

    // Kindergarten Motor
    $('.kindergarten-motor').on('change', function () {
        var kindergarten_Motor_Result = 0;
        var q81 = $('select[name="QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball"]').val();
        var q82 = $('select[name="QuestionNo_82_Can_your_child_use_scissors_to_cut_paper"]').val();
        
        switch(q81){
            case 'Yes':
                kindergarten_Motor_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_Motor_Result += 1;
                break;
            case 'No':
                kindergarten_Motor_Result += 2;
                break;
        }
        switch(q82){
            case 'Yes':
                kindergarten_Motor_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_Motor_Result += 1;
                break;
            case 'No':
                kindergarten_Motor_Result += 2;
                break;
        }
        
        if(kindergarten_Motor_Result <= 2){
            $('#kindergarten_Motor_Result').val('Well-Coordinated');
            $('#kindergarten_Motor_Result').css('background-color', 'green');
            $('#kindergarten_Motor_Result').css('color', 'white');
        }else{
            $('#kindergarten_Motor_Result').val('Needs Assessment');
            $('#kindergarten_Motor_Result').css('background-color', 'red');
            $('#kindergarten_Motor_Result').css('color', 'white');
        }
        
        // Individual Motor Total Score
        var motorTotalScore = kindergarten_Motor_Result;
        $('#kindergarten_motor_total_score').val(motorTotalScore);
      
        console.log('Kindergarten Motor Result:', kindergarten_Motor_Result);
    }).trigger("change");

    // Kindergarten Language
    $('.kindergarten-language').on('change', function () {
        var kindergarten_Language_Result = 0;
        var q83 = $('select[name="QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object"]').val();
        var q84 = $('select[name="QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time"]').val();
        
        switch(q83){
            case 'Yes':
                kindergarten_Language_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_Language_Result += 1;
                break;
            case 'No':
                kindergarten_Language_Result += 2;
                break;
        }
        switch(q84){
            case 'Yes':
                kindergarten_Language_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_Language_Result += 1;
                break;
            case 'No':
                kindergarten_Language_Result += 2;
                break;
        }
        
        if(kindergarten_Language_Result <= 2){
            $('#kindergarten_Language_Result').val('Clear Communicator');
            $('#kindergarten_Language_Result').css('background-color', 'green');
            $('#kindergarten_Language_Result').css('color', 'white');
        }else{
            $('#kindergarten_Language_Result').val('Needs Assessment');
            $('#kindergarten_Language_Result').css('background-color', 'red');
            $('#kindergarten_Language_Result').css('color', 'white');
        }
        
        // Individual Language Total Score
        var languageTotalScore = kindergarten_Language_Result;
        $('#kindergarten_language_total_score').val(languageTotalScore);
       
        console.log('Kindergarten Language Result:', kindergarten_Language_Result);
    }).trigger("change");

    // Kindergarten Social-Emotional
    $('.kindergarten-social-emotional').on('change', function () {
        var kindergarten_SocialEmotional_Result = 0;
        var q85 = $('select[name="QuestionNo_85_Does_your_child_play_cooperatively_with_other_children"]').val();
        var q86 = $('select[name="QuestionNo_86_Does_your_child_express_emotions_appropriately"]').val();
        
        switch(q85){
            case 'Yes':
                kindergarten_SocialEmotional_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_SocialEmotional_Result += 1;
                break;
            case 'No':
                kindergarten_SocialEmotional_Result += 2;
                break;
        }
        switch(q86){
            case 'Yes':
                kindergarten_SocialEmotional_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_SocialEmotional_Result += 1;
                break;
            case 'No':
                kindergarten_SocialEmotional_Result += 2;
                break;
        }
        
        if(kindergarten_SocialEmotional_Result <= 2){
            $('#kindergarten_SocialEmotional_Result').val('Socially Engaged');
            $('#kindergarten_SocialEmotional_Result').css('background-color', 'green');
            $('#kindergarten_SocialEmotional_Result').css('color', 'white');
        }else{
            $('#kindergarten_SocialEmotional_Result').val('Needs Assessment');
            $('#kindergarten_SocialEmotional_Result').css('background-color', 'red');
            $('#kindergarten_SocialEmotional_Result').css('color', 'white');
        }
        
        // Individual Social-Emotional Total Score
        var socialEmotionalTotalScore = kindergarten_SocialEmotional_Result;
        $('#kindergarten_social_emotional_total_score').val(socialEmotionalTotalScore);
        
        console.log('Kindergarten Social-Emotional Result:', kindergarten_SocialEmotional_Result);
    }).trigger("change");

    // Kindergarten Adaptive
    $('.kindergarten-adaptive').on('change', function () {
        var kindergarten_Adaptive_Result = 0;
        var q87 = $('select[name="QuestionNo_87_Can_your_child_dress_and_undress_without_help"]').val();
        var q88 = $('select[name="QuestionNo_88_Can_your_child_use_the_toilet_independently"]').val();
        
        switch(q87){
            case 'Yes':
                kindergarten_Adaptive_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_Adaptive_Result += 1;
                break;
            case 'No':
                kindergarten_Adaptive_Result += 2;
                break;
        }
        switch(q88){
            case 'Yes':
                kindergarten_Adaptive_Result += 0;
                break;
            case 'Sometimes':
                kindergarten_Adaptive_Result += 1;
                break;
            case 'No':
                kindergarten_Adaptive_Result += 2;
                break;
        }
        
        if(kindergarten_Adaptive_Result <= 2){
            $('#kindergarten_Adaptive_Result').val('Good Adaptability');
            $('#kindergarten_Adaptive_Result').css('background-color', 'green');
            $('#kindergarten_Adaptive_Result').css('color', 'white');
        }else{
            $('#kindergarten_Adaptive_Result').val('Needs Assessment');
            $('#kindergarten_Adaptive_Result').css('background-color', 'red');
            $('#kindergarten_Adaptive_Result').css('color', 'white');
        }
        
        // Individual Adaptive Total Score
        var adaptiveTotalScore = kindergarten_Adaptive_Result;
        $('#kindergarten_adaptive_total_score').val(adaptiveTotalScore);
       
        console.log('Kindergarten Adaptive Result:', kindergarten_Adaptive_Result);
    }).trigger("change");

    // Social Emotional Behavioral Screening
    $('.aches_pains, .sad_unhappy, .anxious_worries, .afraid_new_things, .refuses_separate, .nightmares_sleeping, .irritable_angry, .trouble_sitting, .easily_distracted, .doesnt_listen, .fidgets, .driven_motor, .argues_talks_back, .difficulty_waiting, .blames_others, .hits_kicks_bites, .loses_temper').on('change', function () {
        var social_emotional_score = 0;
        var externalizing_social_emotional_score = 0;
        var Attention_social_emotional_score = 0;
        // Get values from all social emotional fields
        var aches_pains = $('select[name="aches_pains"]').val();
        var sad_unhappy = $('select[name="sad_unhappy"]').val();
        var anxious_worries = $('select[name="anxious_worries"]').val();
        var afraid_new_things = $('select[name="afraid_new_things"]').val();
        var refuses_separate = $('select[name="refuses_separate"]').val();
        var nightmares_sleeping = $('select[name="nightmares_sleeping"]').val();
        var irritable_angry = $('select[name="irritable_angry"]').val();
        var trouble_sitting = $('select[name="trouble_sitting"]').val();
        var easily_distracted = $('select[name="easily_distracted"]').val();
        var doesnt_listen = $('select[name="doesnt_listen"]').val();
        var fidgets = $('select[name="fidgets"]').val();
        var driven_motor = $('select[name="driven_motor"]').val();
        var argues_talks_back = $('select[name="argues_talks_back"]').val();
        var difficulty_waiting = $('select[name="difficulty_waiting"]').val();
        var blames_others = $('select[name="blames_others"]').val();
        var hits_kicks_bites = $('select[name="hits_kicks_bites"]').val();
        var loses_temper = $('select[name="loses_temper"]').val();
        
        // Calculate score based on values
        switch(aches_pains){
            case 'Never':
                social_emotional_score += 0;
                break;
            case 'Sometimes':
                social_emotional_score += 1;
                break;
            case 'Often':
                social_emotional_score += 2;
                break;
        }
        
        switch(sad_unhappy){
            case 'Never':
                social_emotional_score += 0;
                break;
            case 'Sometimes':
                social_emotional_score += 1;
                break;
            case 'Often':
                social_emotional_score += 2;
                break;
        }
        
        switch(anxious_worries){
            case 'Never':
                social_emotional_score += 0;
                break;
            case 'Sometimes':
                social_emotional_score += 1;
                break;
            case 'Often':
                social_emotional_score += 2;
                break;
        }
        
        switch(afraid_new_things){
            case 'Never':
                social_emotional_score += 0;
                break;
            case 'Sometimes':
                social_emotional_score += 1;
                break;
            case 'Often':
                social_emotional_score += 2;
                break;
        }
        
        switch(refuses_separate){
            case 'Never':
                social_emotional_score += 0;
                break;
            case 'Sometimes':
                social_emotional_score += 1;
                break;
            case 'Often':
                social_emotional_score += 2;
                break;
        }
        
        switch(nightmares_sleeping){
            case 'Never':
                social_emotional_score += 0;
                break;
            case 'Sometimes':
                social_emotional_score += 1;
                break;
            case 'Often':
                social_emotional_score += 2;
                break;
        }
        
        // Calculate externalizing score for behavioral issues
        switch(irritable_angry){
            case 'Never':
                externalizing_social_emotional_score += 0;
                break;
            case 'Sometimes':
                externalizing_social_emotional_score += 1;
                break;
            case 'Often':
                externalizing_social_emotional_score += 2;
                break;
        }
        
        switch(trouble_sitting){
            case 'Never':
                Attention_social_emotional_score += 0;
                break;
            case 'Sometimes':
                Attention_social_emotional_score += 1;
                break;
            case 'Often':
                Attention_social_emotional_score += 2;
                break;
        }
        
        switch(easily_distracted){
            case 'Never':
                Attention_social_emotional_score += 0;
                break;
            case 'Sometimes':
                Attention_social_emotional_score += 1;
                break;
            case 'Often':
                Attention_social_emotional_score += 2;
                break;
        }
        
        switch(doesnt_listen){
            case 'Never':
                Attention_social_emotional_score += 0;
                break;
            case 'Sometimes':
                Attention_social_emotional_score += 1;
                break;
            case 'Often':
                Attention_social_emotional_score += 2;
                break;
        }
        
        switch(fidgets){
            case 'Never':
                Attention_social_emotional_score += 0;
                break;
            case 'Sometimes':
                Attention_social_emotional_score += 1;
                break;
            case 'Often':
                Attention_social_emotional_score += 2;
                break;
        }
        
        switch(driven_motor){
            case 'Never':
                Attention_social_emotional_score += 0;
                break;
            case 'Sometimes':
                Attention_social_emotional_score += 1;
                break;
            case 'Often':
                Attention_social_emotional_score += 2;
                break;
        }
        
        switch(argues_talks_back){
            case 'Never':
                externalizing_social_emotional_score += 0;
                break;
            case 'Sometimes':
                externalizing_social_emotional_score += 1;
                break;
            case 'Often':
                externalizing_social_emotional_score += 2;
                break;
        }
        
        switch(difficulty_waiting){
            case 'Never':
                Attention_social_emotional_score += 0;
                break;
            case 'Sometimes':
                Attention_social_emotional_score += 1;
                break;
            case 'Often':
                Attention_social_emotional_score += 2;
                break;
        }
        
        switch(blames_others){
            case 'Never':
                externalizing_social_emotional_score += 0;
                break;
            case 'Sometimes':
                externalizing_social_emotional_score += 1;
                break;
            case 'Often':
                externalizing_social_emotional_score += 2;
                break;
        }
        
        switch(hits_kicks_bites){
            case 'Never':
                externalizing_social_emotional_score += 0;
                break;
            case 'Sometimes':
                externalizing_social_emotional_score += 1;
                break;
            case 'Often':
                externalizing_social_emotional_score += 2;
                break;
        }
        
        switch(loses_temper){
            case 'Never':
                externalizing_social_emotional_score += 0;
                break;
            case 'Sometimes':
                externalizing_social_emotional_score += 1;
                break;
            case 'Often':
                externalizing_social_emotional_score += 2;
                break;
        }
        
        var social_emotional_score_comment ='';
        var externalizing_social_emotional_comment ='';
        var Attention_social_emotional_sComment = '';
        if(social_emotional_score <= 3){
            $('input[name="social_emotional_result"]').val('No concern');
            $('input[name="social_emotional_result"]').css('background-color', 'green');
            $('input[name="social_emotional_result"]').css('color', 'white');
            social_emotional_score_comment = 'Internalizing - Your child’s responses suggest they are generally feeling emotionally secure and adjusting well to their environment. Occasional clinginess or mood shifts are typical at this age and do not raise any current concerns. ';
        }else if(social_emotional_score >= 4 && social_emotional_score <= 8){
            $('input[name="social_emotional_result"]').val('Moderate concern');
            $('input[name="social_emotional_result"]').css('background-color', 'orange');
            $('input[name="social_emotional_result"]').css('color', 'black');
            social_emotional_score_comment = 'Internalizing - Your child may be showing some emotional discomfort such as worry, clinginess, or sleep related issues. These behaviors may come and go, but consistent routines and gentle reassurance can help support their emotional comfort';
        }else{
            $('input[name="social_emotional_result"]').val('High concern');
            $('input[name="social_emotional_result"]').css('background-color', 'red');
            $('input[name="social_emotional_result"]').css('color', 'white');
            social_emotional_score_comment = 'Internalizing- Your child’s responses suggest they may be experiencing emotional challenges that could affect their day-to-day comfort and confidence. We recommend gently exploring these behaviors with a school counselor or early childhood professional to identify ways to offer the right support. ';
        }
        
        if(externalizing_social_emotional_score <= 3){
            $('input[name="externalizing_social_emotional_score"]').val('No concern');
            $('input[name="externalizing_social_emotional_score"]').css('background-color', 'green');
            $('input[name="externalizing_social_emotional_score"]').css('color', 'white');
            externalizing_social_emotional_comment = 'Externalizing- Your child appears to manage frustration and social expectations appropriately for their age. No significant behavior-related concerns are noted at this time. ';
        }else if(externalizing_social_emotional_score >= 4 && externalizing_social_emotional_score <= 8){
            $('input[name="externalizing_social_emotional_score"]').val('Moderate concern');
            $('input[name="externalizing_social_emotional_score"]').css('background-color', 'orange');
            $('input[name="externalizing_social_emotional_score"]').css('color', 'black');
            externalizing_social_emotional_comment = 'Externalizing- Some behaviors such as irritability, difficulty following instructions, or occasional aggression may be emerging. These are not uncommon in early years, and gentle boundaries, consistent routines, and positive reinforcement can be helpful';
        }else{
            $('input[name="externalizing_social_emotional_score"]').val('High concern');
            $('input[name="externalizing_social_emotional_score"]').css('background-color', 'red');
            $('input[name="externalizing_social_emotional_score"]').css('color', 'white');
             externalizing_social_emotional_comment = 'Externalizing - Your child may be having some difficulty with self-regulation or expressing emotions appropriately. With consistent routines, clear boundaries, and positive reinforcement at home and school, your child can develop more adaptive behaviors. Speaking with a counselor or early childhood specialist can provide further guidance and support. ';
        }

         if(Attention_social_emotional_score <= 3){
            $('input[name="social_emotional_Attention_result"]').val('No concern');
            $('input[name="social_emotional_Attention_result"]').css('background-color', 'green');
            $('input[name="social_emotional_Attention_result"]').css('color', 'white');
            Attention_social_emotional_sComment = 'Attention- Your child shows developmentally appropriate levels of attention and activity. No specific concerns are evident in this area';
        }else if(Attention_social_emotional_score >= 4 && Attention_social_emotional_score <= 8){
            $('input[name="social_emotional_Attention_result"]').val('Moderate concern');
            $('input[name="social_emotional_Attention_result"]').css('background-color', 'orange');
            $('input[name="social_emotional_Attention_result"]').css('color', 'black');
            Attention_social_emotional_sComment = 'Attention- Your child may occasionally struggle with focus, sitting still, or waiting their turn, common in early childhood. Continued observation and simple strategies like structured routines and movement breaks may be supportive. ';
        }else{
            $('input[name="social_emotional_Attention_result"]').val('High concern');
            $('input[name="social_emotional_Attention_result"]').css('background-color', 'red');
            $('input[name="social_emotional_Attention_result"]').css('color', 'white');
             Attention_social_emotional_sComment = 'Attention- Some behaviors suggest your child may be finding it challenging to regulate their attention or activity levels. This may impact their participation in classroom routines. A conversation with a school counselor or learning support professional can help identify ways to support their growth in this area ';
        }
        
        // Concatenate comments and update psychological_comment textarea
        var final_psychological_comment = '';
        
        // Add social emotional comment (for all scores including 0)
        if(social_emotional_score_comment !== ''){
            final_psychological_comment +=  social_emotional_score_comment + '\n\n';
        }
        
        // Add externalizing comment (for all scores including 0)
        if(externalizing_social_emotional_comment !== ''){
            final_psychological_comment +=  externalizing_social_emotional_comment + '\n\n';
        }
        
        // Add attention comment (for all scores including 0)
        if(Attention_social_emotional_sComment !== ''){
            final_psychological_comment +=  Attention_social_emotional_sComment + '\n\n';
        }
        
        // Update the psychological_comment textarea with final comment
        $('#social_emotional-test').val(final_psychological_comment);
        // If no concerns, show positive message
        // if(social_emotional_score <= 3 && externalizing_social_emotional_score <= 3){
        //     final_psychological_comment = 'Your child appears to be developing well emotionally and behaviorally. No significant concerns are noted at this time. Continue to provide a supportive and nurturing environment.';
        // }
        
        // Update the psychological_comment textarea
        // $('textarea[name="social_emotional_behavior"]').val(final_psychological_comment);
        
        // Calculate individual total scores
        var socialEmotionalInternalizingTotalScore = social_emotional_score;
        var socialEmotionalAttentionTotalScore = Attention_social_emotional_score;
        var socialEmotionalExternalitingTotalScore = externalizing_social_emotional_score;
        // var socialEmotionalTotalScore = social_emotional_score + externalizing_social_emotional_score;
        
        // Update individual total score fields
        $('#social_emotional_total_score').val(socialEmotionalInternalizingTotalScore);
        $('#social_emotional_attention_total_score').val(socialEmotionalAttentionTotalScore);
        $('#externalizing_socialtotal_emotional_score').val(socialEmotionalExternalitingTotalScore);
        
        // console.log('Social Emotional Score:', social_emotional_score);
        // console.log('Externalizing Social Emotional Score:', externalizing_social_emotional_score);
        // console.log('Final Psychological Comment:', final_psychological_comment);
        
    }).trigger("change");

    // Autism Spectrum Disorder Screening
    // Emotional and Behavioral Assessment Function
    $('.emotional-behavior, .behavioral-issues, .attention-issues').on('change', function () {
        var psycologist_comment = '';
        // Get values from emotional behavior questions
        var feel_sad = $('select[name="feel_sad"]').val();
        var feel_nervous = $('select[name="feel_nervous"]').val();
        var trouble_sleeping = $('select[name="trouble_sleeping"]').val();
        var feel_lonely = $('select[name="feel_lonely"]').val();
        var dont_enjoy_things = $('select[name="dont_enjoy_things"]').val();
        var clingy_need_adults = $('select[name="clingy_need_adults"]').val();
        
        // Get values from behavioral issues questions
        var dont_listen_rules = $('select[name="dont_listen_rules"]').val();
        var argue_talk_back = $('select[name="argue_talk_back"]').val();
        var take_things_refuse_share = $('select[name="take_things_refuse_share"]').val();
        var fight_angry_quickly = $('select[name="fight_angry_quickly"]').val();
        
        // Get values from attention issues questions
        var easily_distracted_primary = $('select[name="easily_distracted_primary"]').val();
        var trouble_sitting_still = $('select[name="trouble_sitting_still"]').val();
        
        // Calculate emotional behavior score (Group 1)
        var emotional_score = 0;
        
        if(feel_sad === 'Never') emotional_score += 0;
        else if(feel_sad === 'Sometimes') emotional_score += 1;
        else if(feel_sad === 'Often') emotional_score += 2;
        
        if(feel_nervous === 'Never') emotional_score += 0;
        else if(feel_nervous === 'Sometimes') emotional_score += 1;
        else if(feel_nervous === 'Often') emotional_score += 2;
        
        if(trouble_sleeping === 'Never') emotional_score += 0;
        else if(trouble_sleeping === 'Sometimes') emotional_score += 1;
        else if(trouble_sleeping === 'Often') emotional_score += 2;
        
        if(feel_lonely === 'Never') emotional_score += 0;
        else if(feel_lonely === 'Sometimes') emotional_score += 1;
        else if(feel_lonely === 'Often') emotional_score += 2;
        
        if(dont_enjoy_things === 'Never') emotional_score += 0;
        else if(dont_enjoy_things === 'Sometimes') emotional_score += 1;
        else if(dont_enjoy_things === 'Often') emotional_score += 2;
        
        if(clingy_need_adults === 'Never') emotional_score += 0;
        else if(clingy_need_adults === 'Sometimes') emotional_score += 1;
        else if(clingy_need_adults === 'Often') emotional_score += 2;
        
        // Calculate behavioral issues score (Group 2)
        var behavioral_score = 0;
        
        if(dont_listen_rules === 'Never') behavioral_score += 0;
        else if(dont_listen_rules === 'Sometimes') behavioral_score += 1;
        else if(dont_listen_rules === 'Often') behavioral_score += 2;
        
        if(argue_talk_back === 'Never') behavioral_score += 0;
        else if(argue_talk_back === 'Sometimes') behavioral_score += 1;
        else if(argue_talk_back === 'Often') behavioral_score += 2;
        
        if(take_things_refuse_share === 'Never') behavioral_score += 0;
        else if(take_things_refuse_share === 'Sometimes') behavioral_score += 1;
        else if(take_things_refuse_share === 'Often') behavioral_score += 2;
        
        if(fight_angry_quickly === 'Never') behavioral_score += 0;
        else if(fight_angry_quickly === 'Sometimes') behavioral_score += 1;
        else if(fight_angry_quickly === 'Often') behavioral_score += 2;
        
        // Calculate attention issues score (Group 3)
        var attention_score = 0;
        
        if(easily_distracted_primary === 'Never') attention_score += 0;
        else if(easily_distracted_primary === 'Sometimes') attention_score += 1;
        else if(easily_distracted_primary === 'Often') attention_score += 2;
        
        if(trouble_sitting_still === 'Never') attention_score += 0;
        else if(trouble_sitting_still === 'Sometimes') attention_score += 1;
        else if(trouble_sitting_still === 'Often') attention_score += 2;
        
        // Set emotional behavior result
        if(emotional_score >= 0 && emotional_score <= 3){
            $('input[name="emotional_behavior_result"]').val('No concerns');
            $('input[name="emotional_behavior_result"]').css('background-color', '#90EE90');
            $('input[name="emotional_behavior_result"]').css('color', 'black');
            psycologist_comment += 'Your child’s responses suggest they are generally managing their emotions well. While occasional low mood or reduced social engagement can happen from time to time, there are no significant concerns indicated at this point.';
        }else if(emotional_score >= 4 && emotional_score <= 7){
            $('input[name="emotional_behavior_result"]').val('Moderate Concerns');
            $('input[name="emotional_behavior_result"]').css('background-color', 'orange');
            $('input[name="emotional_behavior_result"]').css('color', 'black');
            psycologist_comment += 'Your child may be showing some emotional discomfort such as low mood, tiredness, or worry. These feelings may fluctuate and could be temporary, but gentle support and regular check-ins are encouraged.\n\n';
        }else if(emotional_score >= 8 && emotional_score <= 12){
            $('input[name="emotional_behavior_result"]').val('High  Concerns');
            $('input[name="emotional_behavior_result"]').css('background-color', '#FF6B6B');
            $('input[name="emotional_behavior_result"]').css('color', 'white');
            psycologist_comment += 'Your child’s responses suggest they may be experiencing some emotional challenges, such as low mood or tiredness, which could be affecting their overall well-being. We recommend having a gentle conversation with a school counselor or pediatric specialist to explore these observations further and identify ways to support your child’s emotional growth and comfort.';
        }
        
        // Set behavioral issues result
        if(behavioral_score >= 0 && behavioral_score <= 2){
            $('input[name="behavioral_issues_result"]').val('No  Concerns');
            $('input[name="behavioral_issues_result"]').css('background-color', '#90EE90');
            $('input[name="behavioral_issues_result"]').css('color', 'black');
            psycologist_comment += 'Your child appears to manage frustration and social expectations appropriately. No notable behavior-related concerns were observed.\n\n';
        }else if(behavioral_score >= 3 && behavioral_score <= 4){
            $('input[name="behavioral_issues_result"]').val('Moderate Concerns');
            $('input[name="behavioral_issues_result"]').css('background-color', 'orange');
            $('input[name="behavioral_issues_result"]').css('color', 'black');
            psycologist_comment += 'Some behaviors such as irritability or difficulty following rules may be emerging. Monitoring and consistent routines at home and school may help.\n\n';
        }else if(behavioral_score >= 5 && behavioral_score <= 8){
            $('input[name="behavioral_issues_result"]').val('High  Concerns');
            $('input[name="behavioral_issues_result"]').css('background-color', '#FF6B6B');
            $('input[name="behavioral_issues_result"]').css('color', 'white');
            psycologist_comment += 'Your child may be having difficulty with behavioral self-regulation or peer interactions. With some additional support or structured strategies, they can be guided toward developing more positive and adaptive behaviors.\n\n';
        }
        
        // Set attention issues result
        if(attention_score >= 0 && attention_score <= 0){
            $('input[name="attention_issues_result"]').val('No  Concerns');
            $('input[name="attention_issues_result"]').css('background-color', '#90EE90');
            $('input[name="attention_issues_result"]').css('color', 'black');
            psycologist_comment += 'Your child shows age-appropriate attention and focus. No current concerns are evident in this area.\n\n';
        }else if(attention_score >= 1 && attention_score <= 2){
            $('input[name="attention_issues_result"]').val('Moderate  Concerns');
            $('input[name="attention_issues_result"]').css('background-color', 'orange');
            $('input[name="attention_issues_result"]').css('color', 'black');
            psycologist_comment += 'Your child may occasionally struggle with staying focused, sitting still, or completing tasks. Continued observation and supportive strategies may be helpful.\n\n';
        }else if(attention_score >= 3 && attention_score <= 4){
            $('input[name="attention_issues_result"]').val('High Concerns');
            $('input[name="attention_issues_result"]').css('background-color', '#FF6B6B');
            $('input[name="attention_issues_result"]').css('color', 'white');
            psycologist_comment += 'There are some signs of attentional challenges that may affect learning or daily routines. It may be beneficial to consult with a learning support professional or school counselor for further strategies.\n\n';
        }
        
        console.log('Emotional Score:', emotional_score);
        console.log('Behavioral Score:', behavioral_score);
        console.log('Attention Score:', attention_score);
        
        // Calculate individual total scores for psychological section
        var psychologicalInternalizationTotalScore = emotional_score;
        var psychologicalExternalizationTotalScore = behavioral_score;
        var psychologicalAttentionTotalScore = attention_score;
        
        // Update individual total score fields
        $('#psychological_internalization_total_score').val(psychologicalInternalizationTotalScore);
        $('#psychological_externalization_total_score').val(psychologicalExternalizationTotalScore);
        $('#psychological_attention_total_score').val(psychologicalAttentionTotalScore);
        
        // Update the psychological_comment textarea with the psycologist_comment variable
        if (typeof psycologist_comment !== 'undefined' && psycologist_comment) {
            $('textarea[name="psychological_comment"]').val(psycologist_comment);
        }
        
    }).trigger("change");

    $('.eye_contact, .show_feelings, .use_gestures, .react_to_changes, .respond_to_name, .use_words, .use_facial_expressions, .appropriate_activity_level, .play_with_others, .follow_directions').on('change', function () {
        var autism_spectrum_score = 0;
        
        // Get values from all autism spectrum fields
        var eye_contact = $('select[name="eye_contact"]').val();
        var show_feelings = $('select[name="show_feelings"]').val();
        var use_gestures = $('select[name="use_gestures"]').val();
        var react_to_changes = $('select[name="react_to_changes"]').val();
        var respond_to_name = $('select[name="respond_to_name"]').val();
        var use_words = $('select[name="use_words"]').val();
        var use_facial_expressions = $('select[name="use_facial_expressions"]').val();
        var appropriate_activity_level = $('select[name="appropriate_activity_level"]').val();
        var play_with_others = $('select[name="play_with_others"]').val();
        var follow_directions = $('select[name="follow_directions"]').val();
        
        // Calculate score based on values
        switch(eye_contact){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        switch(show_feelings){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        switch(use_gestures){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        switch(react_to_changes){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        switch(respond_to_name){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        switch(use_words){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        switch(use_facial_expressions){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        switch(appropriate_activity_level){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        switch(play_with_others){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        switch(follow_directions){
            case 'Never':
                autism_spectrum_score += 0;
                break;
            case 'Sometimes':
                autism_spectrum_score += 1;
                break;
            case 'Often':
                autism_spectrum_score += 2;
                break;
        }
        
        // Set result based on score
        if(autism_spectrum_score >= 16 && autism_spectrum_score <= 20){
            $('input[name="autism_spectrum_result"]').val('Typical Development');
            $('input[name="autism_spectrum_result"]').css('background-color', 'green');
            $('input[name="autism_spectrum_result"]').css('color', 'black');
        }else if(autism_spectrum_score >= 11 && autism_spectrum_score <= 15){
            $('input[name="autism_spectrum_result"]').val('Mild concerns');
            $('input[name="autism_spectrum_result"]').css('background-color', 'yellow');
            $('input[name="autism_spectrum_result"]').css('color', 'black');
        }else if(autism_spectrum_score >= 6 && autism_spectrum_score <= 10){
            $('input[name="autism_spectrum_result"]').val('Moderate Concerns');
            $('input[name="autism_spectrum_result"]').css('background-color', 'red');
            $('input[name="autism_spectrum_result"]').css('color', 'black');
        }else if(autism_spectrum_score >= 0 && autism_spectrum_score <= 5){
            $('input[name="autism_spectrum_result"]').val('Significant Concerns');
            $('input[name="autism_spectrum_result"]').css('background-color', 'red');
            $('input[name="autism_spectrum_result"]').css('color', 'black');
        }
        
        // Generate autism spectrum comment based on score
        var autism_spectrum_comment = '';
        if(autism_spectrum_score >= 16 && autism_spectrum_score <= 20){
            autism_spectrum_comment = 'Based on a comprehensive developmental screening across areas such as communication, social interaction, and adaptability, your child is currently demonstrating behaviors that are generally expected for their age. They appear to respond to social cues, use language and gestures meaningfully, and engage in interactions with others. While continued observation is always valuable as children grow, there are no significant concerns at this time. We encourage you to keep supporting your child\'s development through everyday play, conversation, and routines.';
        }else if(autism_spectrum_score >= 11 && autism_spectrum_score <= 15){
            autism_spectrum_comment = 'This screening shows that your child is developing in some areas while also displaying a few patterns that may benefit from closer observation. These could include occasional difficulty responding to social cues, using gestures consistently, or adjusting to changes in routine. While these behaviors may fall within a broad range of typical development, it may be helpful to monitor progress over the coming months and consider an informal conversation with a teacher or counselor to guide early support, if needed.';
        }else if(autism_spectrum_score >= 6 && autism_spectrum_score <= 10){
            autism_spectrum_comment = 'Based on the screening, we have noticed several areas where your child may be showing emerging developmental differences, particularly in how they communicate, respond socially, and adapt to new situations. These may include limited eye contact, inconsistent use of language or gestures, or difficulty joining in play with peers. These patterns suggest the benefit of a more detailed evaluation to better understand your child\'s individual needs and to explore ways you can support their ongoing development.';
        }else if(autism_spectrum_score >= 0 && autism_spectrum_score <= 5){
            autism_spectrum_comment = 'Based on a comprehensive developmental screening, it was observed that your child is currently not demonstrating expected behaviors in several foundational areas. These include responses to social cues, use of language and gestures, and engagement in play or interaction with others. While every child develops at their own pace, the current pattern suggests that further evaluation by a psychologist or early childhood specialist may be helpful to better understand your child\'s needs and determine how you can best support their development.';
        }
        
        // Update autism_spectrum_Comment textarea with autism spectrum comment
        var final_autism_comment = '';
        
        // Add autism spectrum comment based on score
        if(autism_spectrum_score >= 16 && autism_spectrum_score <= 20){
            final_autism_comment = autism_spectrum_comment;
        }else if(autism_spectrum_score >= 11 && autism_spectrum_score <= 15){
            final_autism_comment = autism_spectrum_comment;
        }else if(autism_spectrum_score >= 6 && autism_spectrum_score <= 10){
            final_autism_comment = autism_spectrum_comment;
        }else if(autism_spectrum_score >= 0 && autism_spectrum_score <= 5){
            final_autism_comment = autism_spectrum_comment;
        }
        
        $('textarea[name="autism_spectrum_Comment"]').val(final_autism_comment);
        
        // Update autism spectrum total score field
        $('#autism_spectrum_total_score').val(autism_spectrum_score);
        
        console.log('Autism Spectrum Score:', autism_spectrum_score);
        console.log('Eye Contact:', eye_contact);
        console.log('Show Feelings:', show_feelings);
        console.log('Use Gestures:', use_gestures);
        console.log('React to Changes:', react_to_changes);
        console.log('Respond to Name:', respond_to_name);
        console.log('Use Words:', use_words);
        console.log('Use Facial Expressions:', use_facial_expressions);
        console.log('Appropriate Activity Level:', appropriate_activity_level);
        console.log('Play with Others:', play_with_others);
        console.log('Follow Directions:', follow_directions);
        
    }).trigger("change");

        // MUAC Color Update Function - Defined globally so it can be called from HTML
        window.updateMuacColor = function(selectElement) {
            var selectedValue = selectElement.value;
            var select = $(selectElement);
            
            // Reset color first
            select.css('background-color', '');
            select.css('color', '');
            
            if (selectedValue) {
                // Parse the range to get the upper limit
                var upperLimit = parseFloat(selectedValue.split('-')[1]);
                
                // Apply colors based on MUAC score ranges
                if (upperLimit <= 12.5) {
                    // Malnourished - Red
                    select.css('background-color', '#ffcccc');
                    select.css('color', '#cc0000');
                } else if (upperLimit >= 12.6) {
                    // Normal - Green
                    select.css('background-color', '#ccffcc');
                    select.css('color', '#006600');
                }
            }
        };

        // Initialize colors for existing selections when page loads
        // This works for both add and edit forms
        // Check if we're in edit mode (form has existing values)
        var isEditMode = $('input[name="_method"]').val() === 'PUT' || 
                       $('input[name="_method"]').val() === 'PATCH' ||
                       $('input[name="id"]').val() ||
                       window.location.pathname.includes('edit') ||
                       window.location.pathname.includes('update');
        
        // Initialize colors for both dropdowns
        $('#muac_right_eye').each(function() {
            var currentValue = $(this).val();
            if (currentValue) {
                updateMuacColor(this);
            }
            
            // Also check for values from GET parameters or old input
            var getParamValue = new URLSearchParams(window.location.search).get($(this).attr('name'));
            if (getParamValue && !currentValue) {
                $(this).val(getParamValue);
                updateMuacColor(this);
            }
        });
        
        // If it's edit mode and no values are set, try to get from hidden fields or data attributes
        if (isEditMode) {
            // Check for any hidden input values
            $('input[type="hidden"][name*="muac"]').each(function() {
                var fieldName = $(this).attr('name');
                var fieldValue = $(this).val();
                if (fieldValue && fieldName.includes('muac')) {
                    if (fieldName.includes('right_eye')) {
                        $('#muac_right_eye').val(fieldValue).trigger('change');
                    } else if (fieldName.includes('left_eye')) {
                        $('#muac_left_eye').val(fieldValue).trigger('change');
                    }
                }
            });
        }

        // Visual Acuity Dropdown Color Function
        function updateVisualAcuityColor(selectElement) {
            var selectedValue = selectElement.value;
            var select = $(selectElement);
            
            // Reset color first
            select.css('background-color', '');
            select.css('color', '');
            
            if (selectedValue) {
                // Check if the selected value is from the 5th option onwards (20/30 and below)
                // These are the values that should turn red
                var redValues = [
                    '20/30 (6/9) - Below average',
                    '20/40 (6/12) - Minimum requirement for driving',
                    '20/50 (6/15) - Mild vision impairment',
                    '20/60 (6/18) - Blurred vision',
                    '20/80 (6/24) - Moderate vision impairment',
                    '20/100 (6/30) - Moderate to severe impairment',
                    '20/125 (6/38) - Vision severely compromised',
                    '20/160 (6/48) - Very poor distance vision',
                    '20/200 (6/60) - Legally blind'
                ];
                
                if (redValues.includes(selectedValue)) {
                    // Apply red color for concerning values
                    select.css('background-color', '#ffcccc');
                    select.css('color', '#cc0000');
                }
            }
        }

        // Initialize Visual Acuity dropdown colors for Right Eye
        $('#Question_No_24_Visual_acuity_using_Snellens_chart').each(function() {
            var currentValue = $(this).val();
            if (currentValue) {
                updateVisualAcuityColor(this);
            }
            
            // Also check for values from GET parameters or old input
            var getParamValue = new URLSearchParams(window.location.search).get($(this).attr('name'));
            if (getParamValue && !currentValue) {
                $(this).val(getParamValue);
                updateVisualAcuityColor(this);
            }
        });

        // Initialize Visual Acuity dropdown colors for Left Eye
        $('#Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye').each(function() {
            var currentValue = $(this).val();
            if (currentValue) {
                updateVisualAcuityColor(this);
            }
            
            // Also check for values from GET parameters or old input
            var getParamValue = new URLSearchParams(window.location.search).get($(this).attr('name'));
            if (getParamValue && !currentValue) {
                $(this).val(getParamValue);
                updateVisualAcuityColor(this);
            }
        });

        // Add change event listener for Visual Acuity dropdown - Right Eye
        $('#Question_No_24_Visual_acuity_using_Snellens_chart').on('change', function() {
            updateVisualAcuityColor(this);
        });

        // Add change event listener for Visual Acuity dropdown - Left Eye
        $('#Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye').on('change', function() {
            updateVisualAcuityColor(this);
        });
  
        });

      

    </script>
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
