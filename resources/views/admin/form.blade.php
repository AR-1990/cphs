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
            background-color: transparent !important;
        }

        .error-border {
            border: 2px solid #dc3545 !important;
        }
    </style>



    <div class="container">
        <h1 class="mb-4 mt-5">Child Health Checkup Survey</h1>
        <p id="timer">Time: 0 seconds</p>
        <form id="multiStepForm">
            <!-- Step-one -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="step active mb-5" id="step1">
                <h3>Bio Data</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                @if (isset($_GET['name'])) value="{{ $_GET['name'] }}"

                            @else
                            value="{{ old('name') }}" @endif
                                required>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="GName">Guardian Name</label>
                            <input type="text" class="form-control" id="guardianname" name="guardianname"
                                @if (isset($_GET['guardianname'])) value="{{ $_GET['guardianname'] }}"

                            @else
                            value="{{ old('guardianname') }}" @endif
                                required>



                            <span class="error-message"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select</option>
                                {{-- <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option> --}}

                                <option value="male"
                                    {{ (isset($_GET['gender']) && $_GET['gender'] == 'male') || old('gender') == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>

                                <option value="female"
                                    {{ (isset($_GET['gender']) && $_GET['gender'] == 'female') || old('gender') == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>

                                <option value="other"
                                    {{ (isset($_GET['gender']) && $_GET['gender'] == 'other') || old('gender') == 'other' ? 'selected' : '' }}>
                                    Other
                                </option>


                            </select>
                        </div>
                    </div>




                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="class">Class</label>
                            <!-- <input placeholder="Class" type="number" step="any" class="form-control" id="class"
                                                        name="class" required> -->
                            <select class="form-control" id="class" name="class" required>
                                <option value="">Select</option>
                                <option value="0">Play group</option>
                                <option value="00">KG-1 </option>
                                <option value="000">KG-2</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                </option>
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
                                        <option @if (isset($_GET['school']) && $_GET['school'] == $item->id) selected @endif
                                            value="{{ $item->id }}">{{ $item->school_name }}</option>
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
                                        <option @if (isset($_GET['city']) && $_GET['city'] == $item->id) selected @endif
                                            value="{{ $item->id }}">{{ $item->name }}</option>
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
                                        <option @if (isset($_GET['area']) && $_GET['area'] == $item->id) selected @endif
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif


                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                @if (isset($_GET['dob'])) value="{{ $_GET['dob'] }}"

                            @else
                            value="{{ old('dob') }}" @endif
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" readonly required
                                @if (isset($_GET['age'])) value="{{ $_GET['age'] }}"

                               @else
                               value="{{ old('age') }}" @endif>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="contact">Emergency Contact Number</label>
                            <input type="text" class="form-control" id="Emergency_Contact_Number"
                                name="Emergency_Contact_Number"
                                @if (isset($_GET['emergency_contact_number'])) value="{{ $_GET['emergency_contact_number'] }}" @endif
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="contact">GR Number ( only numeric value )</label>
                            <input type="number" class="form-control" id="Gr_Number" name="Gr_Number"
                                @if (isset($_GET['grno'])) value="{{ $_GET['grno'] }}"

                            @else
                            value="{{ old('Gr_Number') }}" @endif
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Medical_condition">Any Known Medical Condition</label>
                            <input type="text" class="form-control" id="Any_Known_Medical_Condition"
                                name="Any_Known_Medical_Condition" required>
                        </div>
                    </div>



                    <div class="form-group col-md-6">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="Address" required>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label for="contact">Blood Group</label>




                            <?php
                            $selectedBloodGroup = isset($_GET['blood_group']) ? $_GET['blood_group'] : ''; // Default to an empty string if 'blood_group' is not set
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
                            <label for="comment">Comment/Findings</label><br>
                            <textarea name = "bio_data_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>

            <!-- Second Step -->

            <div class="step" id="step2">
                <h3>Vitals/BMI</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group height">
                            <div class="group-form">
                                <label for="height" class="width-100">Height :cm(s)<input type="number"
                                        class="form-control" id="height" name="Question_No_1_Height"
                                        placeholder="Height in cm example 170" required> </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">

                        <div class="form-group weight">
                            <div class="group-form">
                                <label for="weight" class="width-100">Question No.2: Weight :kg(s)
                                    <input type="number" class="form-control" id="weight"
                                        name="Question_No_2_Weight"placeholder="Weight in kg example 65" required> </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="bmi">Question No.3: BMI (Red field means abnomality )</label>
                            <span id="bmishow"></span>
                            <input type="number" class="form-control" id="bmi" name="Question_No_3_BMI"
                                placeholder="auto calculate" readonly required>

                        </div>
                        <input type="hidden" class="form-control" id="bmiresult" name="bmiresult" readonly
                            @if (isset($_GET['bmiresult'])) value="{{ $_GET['bmiresult'] }}" readonly

                    @else
                    value="{{ old('bmiresult') }}" @endif>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="temp">Question No.4: Body Temperature</label>
                            <div class="row">
                                <div class="form-group col-md-8 pr-2">
                                    <input type="number" class="form-control" id="Question_No_4_Body_Temperature"
                                        name="Question_No_4_Body_Temperature" required>
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
                                name="Question_No_5_Blood_Pressure_Systolic" required>
                        </div>

                        <input type="hidden" class="form-control" id="systolicresult" name="systolicresult" readonly
                            @if (isset($_GET['systolicresult'])) value="{{ $_GET['systolicresult'] }}"

                    @else
                    value="{{ old('systolicresult') }}" @endif>

                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="blood">Question No.6: Blood Pressure (Diastolic) (Red field means abnomality
                                ) </label> <span id="Blood_Pressure_Diastolic"></span>
                            <input type="number" class="form-control" id="Question_No_6_Blood_Pressure_Diastolic"
                                name="Question_No_6_Blood_Pressure_Diastolic" required>
                        </div>
                        <input type="hidden" class="form-control" id="diastolicresult" name="diastolicresult" readonly
                            @if (isset($_GET['diastolicresult'])) value="{{ $_GET['diastolicresult'] }}"

                    @else
                    value="{{ old('diastolicresult') }}" @endif>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="pulse">Question No.7: Pulse (Red field means abnomality )</label>
                            <input type="text" class="form-control" id="Question_No_7_Pulse"
                                name="Question_No_7_Pulse" required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label><br>
                            <textarea name = "vitals_bmi_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>

            <!-- ADD  Step -->


            <!-- Third Step -->
            <div class="step" id="step3">
                <h3>General Apperance</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="field2">Question No.8: Normal Posture/Gait</label><br>
                            <select class="form-control" id="Question_No_8_Normal_Posture_Gait"
                                name="Question_No_8_Normal_Posture/Gait" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Mentalstatus">Question No.9: Mental Status</label><br>
                            <select class="form-control" id="Question_No_9_Mental_Status"
                                name="Question_No_9_Mental_Status" required>
                                <option value="">Select</option>
                                <option value="Alert">Alert</option>
                                <option value="Lethargic">Lethargic</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="jaundice">Question No.10: Look For jaundice</label><br>
                            <select class="form-control" id="Question_No_10_Look_For_jaundice"
                                name="Question_No_10_Look_For_jaundice" required>
                                <option value="">Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="anemia">Question No.11: Look For anemia</label><br>
                            <select class="form-control" id="Question_No_11_Look_For_anemia"
                                name="Question_No_11_Look_For_anemia" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="clubbing">Question No.12: Look For Clubbing</label><br>
                            <select class="form-control" id="Question_No_12_Look_For_Clubbing"
                                name="Question_No_12_Look_For_Clubbing" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="cyanosis">Question No.13: Look for Cyanosis</label><br>
                            <select class="form-control" id="Question_No_13_Look_for_Cyanosis"
                                name="Question_No_13_Look_for_Cyanosis" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="skin">Question No.14: Skin</label><br>
                            <select class="form-control" id="Question_No_14_Skin" name="Question_No_14_Skin" required>
                                <option value="">Select</option>
                                <option value="Rash">Rash</option>
                                <option value="Allergy">Allergy</option>
                                <option value="Lesion">Lesion</option>
                                <option value="Bruises">Bruises</option>
                                <option value="Normal">Normal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="breath">Question No.15: Breath</label><br>
                            <select class="form-control" id="Question_No_15_Breath" name="Question_No_15_Breath"
                                required>
                                <option value="">Select</option>
                                <option value="Bad Breath">Bad Breath</option>
                                <option value="Normal">Normal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label><br>
                            <textarea name = "general_apperance_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>
            <!-- Fourth Step -->
            {{-- add step end --}}
            <div class="step" id="step4">
                <h3>Inspect Hygiene </h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Nails">Question No.16: Nails</label><br>
                            <select class="form-control" id="Question_No_16_Nails" name="Question_No_16_Nails" required>
                                <option value="">Select</option>
                                <option value="Clean">Clean</option>
                                <option value="Dirty">Dirty</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Uniform or shoes">Question No.17: Uniform or shoes</label><br>
                            <select class="form-control" id="Question_No_17_Uniform_or_shoes"
                                name="Question_No_17_Uniform_or_shoes" required>
                                <option value="">Select</option>
                                <option value="Tidy">Tidy</option>
                                <option value="Untidy">Untidy</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Lice/nits">Question No.18: Lice/nits</label><br>
                            <select class="form-control" id="Question_No_18_Lice_nits" name="Question_No_18_Lice/nits"
                                required ">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="field2">Question No.19: Discuss hygiene routines and practices.</label><br>
                                <select class="form-control" id="Question_No_19_Discuss_hygiene_routines_and_practices"
                                    name="Question_No_19_Discuss_hygiene_routines_and_practices" required>
                                    <option value="">Select</option>
                                    <option value="well-aware">well-aware</option>
                                    <option value="not-aware">not aware</option>
                                    <option value="has-been-counseled">has been counseled</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="comment">Comment/Findings</label><br>
                                <textarea name = "inspect_hygiene_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary prevStep">Previous</button>
                    <button type="button" class="btn btn-primary nextStep">Next</button>
                </div>

                <!--  Step Five -->
                <div class="step" id="step5">
                    <h3>Head and Neck examination</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="hair_and_scalp">Question No:20 Hair and Scalp</label><br>
                                <select class="form-control" id="Question_No_20_Hair_and_Scalp"
                                    name="Question_No_20_Hair_and_Scalp" required>
                                    <option value="">Select</option>
                                    <option value="Straight">Straight</option>
                                    <option value="Wavy">Wavy</option>
                                    <option value="Curly">Curly</option>
                                    <option value="Color-faded">Color faded</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="field2">Question No.21: Any Hair Problem</label><br>
                                <select class="form-control" id="Question_No_21_Any_Hair_Problem"
                                    name="Question_No_21_Any_Hair_Problem" required>
                                    <option value="">Select</option>
                                    <option value="Kinky">Kinky</option>
                                    <option value="Brittle">Brittle</option>
                                    <option value="Dry">Dry</option>
                                    <option value="Normal">Normal</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="field2">Question No.22: Scalp</label><br>
                                <select class="form-control" id="Question_No_22_Sclap" name="Question_No_22_Sclap" required>
                                    <option value="">Select</option>
                                    <option value="Scaly">Scaly</option>
                                    <option value="Dry">Dry</option>
                                    <option value="Moist">Moist</option>
                                    <option value="Normal">Normal</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="field2">Question No.23: Hair distribution</label><br>
                                <select class="form-control" id="Question_No_23_Hair_distribution"
                                    name="Question_No_23_Hair_distribution" required>
                                    <option value="">Select</option>
                                    <option value="Even">Even</option>
                                    <option value="Patchy">Patchy</option>
                                    <option value="Receding">Receding</option>
                                    <option value="Receding_Hair_Line">Receding Hair Line</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="comment">Comment/Findings</label><br>
                                <textarea name = "head_and_neck_examination_comment" placeholder = "Comment here" id = "comment" cols="50"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary prevStep">Previous</button>
                    <button type="button" class="btn btn-primary nextStep">Next</button>

                </div>
                <!--  Step six -->
                <div class="step" id="step6">
                    <h3>Eye:</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="normal_ocular_alignment">Question No.24: Visual acuity using Snellen’s
                                    chart</label><br>
                                <input type="text" id="Question_No_24_Visual_acuity_using_Snellen’s_chart"
                                    name="Question_No_24_Visual_acuity_using_Snellen’s_chart" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="nystagmus">Question No.25: Normal ocular alignment</label><br>
                                <select class="form-control" id="Question_No_25_Normal_ocular_alignment"
                                    name="Question_No_25_Normal_ocular_alignment" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="normal_eye_inspection">Question No.26: Normal eye inspection</label><br>
                                <select class="form-control" id="Question_No_26_Normal_eye_inspection"
                                    name="Question_No_26_Normal_eye_inspection" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="normal_color_vision">Question No.27: Normal Color vision</label><br>
                                <select class="form-control" id="Question_No_27_Normal_Color_vision"
                                    name="Question_No_27_Normal_Color_vision" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="Nystagmus">Question No.28: Nystagmus</label><br>
                                <select class="form-control" id="Question_No_28_Nystagmus" name="Question_No_28_Nystagmus"
                                    required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="comment">Comment/Findings</label><br>
                                <textarea name = "eye_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary prevStep">Previous</button>
                    <button type="button" class="btn btn-primary nextStep">Next</button>
                </div>
                <!--  Step Seven -->
                <div class="step" id="step7">
                    <h3>Ears:</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="Right_ear">Question No.29: Normal ears shape and position</label><br>
                                <select class="form-control" id="Question_No_29_Normal_ears_shape_and_position"
                                    name="Question_No_29_Normal_ears_shape_and_position"required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="Right_ear">Question No.30: Ear examination</label><br>
                                <select class="form-control" id="Question_No_30_Ear_examination"
                                    name="Question_No_30_Ear_examination" required>
                                    <option value="">Select</option>
                                    <option value="Ear wax">Ear wax</option>
                                    <option value="Canal infection">Canal infection</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="field8">Question No.31: Conclusion of hearing test with Rinner and
                                    Weber</label><br>
                                <select class="form-control"
                                    id="Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber"
                                    name="Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber" required>
                                    <option value="">Select</option>
                                    <option value="Normal">Normal</option>
                                    <option value="right_ear_conductive_hearing_loss">right ear conductive hearing loss
                                    </option>
                                    <option value="left_ear_conductive_hearing_loss">left ear conductive hearing loss </option>
                                    <option value="right_ear_sensorineural_hearing_loss">right sensorineural hearing loss
                                    </option>
                                    <option value="left_ear_sensorineural_hearing_loss">left sensorineural hearing loss
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="comment">Comment/Findings</label><br>
                                <textarea name = "ears_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary prevStep">Previous</button>
                    <button type="button" class="btn btn-primary nextStep">Next</button>
                </div>

                <!--  Step nine -->
                <div class="step" id="step9">
                    <h3>Nose</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="nose">Question No.32:External nasal examinaton</label><br>
                                <select class="form-control" id="Question_No_32_External_inasal_examinaton"
                                    name="Question_No_32_External_nasal_examinaton" required>
                                    <option value="">Select</option>
                                    <option value="Deformities">Deformities</option>
                                    <option value="Swelling">Swelling </option>
                                    <option value="Redness">Redness </option>
                                    <option value="Lesions">Lesions </option>
                                    <option value="Nasal Discharge">Nasal Discharge </option>
                                    <option value="Crusting">Crusting</option>
                                    <option value="Normal">Normal </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="field9">Question No.33:perform a nasal patency test [which involves gently
                                    closing
                                    one nostril at a time to assess the patient's ability to breathe through each
                                    nostril]</label><br>
                                <select class="form-control"
                                    id="Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient_s_ability_to_breathe_through_each_nostril"
                                    name="Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"
                                    required>
                                    <option value="">Select</option>
                                    <option value="Obstruction">Obstruction </option>
                                    <option value="DNS">DNS </option>
                                    <option value="Normal">Normal </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="comment">Comment/Findings</label><br>
                                <textarea name = "nose_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary prevStep">Previous</button>
                    <button type="button" class="btn btn-primary nextStep">Next</button>
                </div>
                <!--  Step Ten -->
                <div class="step" id="step10">
                    <h3>Oral</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="assess_gingiva">Question No.34: Assess gingiva</label><br>
                                <select class="form-control" id="Question_No_34_Assess_gingiva"
                                    name="Question_No_34_Assess_gingiva"
                                    required >
                                        <option value="">Select</option>
                                        <option value="Infection">Infection</option>
                                        <option value="Bleed">Bleed </option>
                                        <option value="Normal">Normal </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="are_there_dental_caries">Question No.35: Are there dental caries</label><br>
                                    <select class="form-control" id="Question_No_35_Are_there_dental_caries"
                                        name="Question_No_35_Are_there_dental_caries"
                                        required>
                                                                                                                                <option value="">Select</option>
                                                                                                                                <option value="Yes">Yes</option>
                                                                                                                                <option value="No">No </option>
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group col-md-6">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="comment">Comment/Findings</label><br>
                                                                                                                            <textarea name = "oral_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <button type="button" class="btn btn-primary prevStep">Previous</button>
                                                                                                                <button type="button" class="btn btn-primary nextStep">Next</button>
                                                                                                            </div>
                                                                                                            <!--  Step Eleven -->
                                                                                                            <div class="step" id="step10">
                                                                                                                <h3>Throat</h3>
                                                                                                                <div class="form-row">
                                                                                                                    <div class="form-group col-md-6">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="Examine tonsils">Question No.36: Examine tonsils</label>
                                                                                                                            <select class="form-control" id="Question_No_36_Examine_tonsils"
                                                                                                                                name="Question_No_36_Examine_tonsils" required>
                                                                                                                                <option value="">Select</option>
                                                                                                                                <option value="Normal">Normal</option>
                                                                                                                                <option value="Tonsillitis">Tonsillitis</option>
                                                                                                                                <option value="Tonsillectomy done">Tonsillectomy done</option>
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                    <div class="form-group col-md-6">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="normal_speech_development">Question No.37: Normal Speech development</label><br>
                                                                                                                            <select class="form-control" id="Question_No_37_Normal_Speech_development"
                                                                                                                                name="Question_No_37_Normal_Speech_development" required>
                                                                                                                                <option value="">Select</option>
                                                                                                                                <option value="Yes">Yes</option>
                                                                                                                                <option value="No">No </option>
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                    <div class="form-group col-md-6">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="any_neck_swelling">Question No.38:Any Neck swelling </label><br>
                                                                                                                            <select class="form-control" id="any_neck_swelling" name="Question_No_38_Any_Neck_swelling"
                                                                                                                                required  ">
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Examine lymph_node">Question No.39: Examine lymph node</label><br>
                            <select class="form-control" id="lymph_node" name="Question_No_39_Examine_lymph_node"
                                required>
                                <option value="">Select</option>
                                <option value="normal">normal</option>
                                <option value="abnormal">abnormal</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group lymph_node_specify d-none">
                            <label for="lymph_node_specify">Specify lymph node</label><br>
                            <input type="text" name="Specify_lymph_node" class="form-control" id="Specify_lymph_node"
                                placeholder="Please specify lymph node"><br>
                        </div>
                    </div>

                    <div class="form-group col-md-6 any_neck_swelling_specify d-none">
                        <div class="form-group">
                            <label for="any_neck_swelling">Specify Any Neck swelling</label><br>
                            <input type="text" name="Specify_Any_Neck_swelling" class="form-control"
                                id="Specify_Any_Neck_swelling" placeholder="please specify Neck swelling"><br>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="comment">Comment/Findings</label><br>
                                <textarea name = "throat_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>
            <!--  Step Twelve -->
            <div class="step" id="step12">
                <h3>Chest</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="any_visible_chest_deformity">Question No.40 Any visible chest deformity</label><br>
                            <select class="form-control" id="Question_No_40_Any_visible_chest_deformity"
                                name="Question_No_40_Any_visible_chest_deformity" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="lung_auscultation">Question No.41 Lung Auscultation</label><br>
                            <select class="form-control" id="Question_No_41_Lung_Auscultation"
                                name="Question_No_41_Lung_Auscultation" required>
                                <option value="">Select</option>
                                <option value="Ronchi">Ronchi </option>
                                <option value="Wheezing">Wheezing </option>
                                <option value="Crackles">Crackles</option>
                                <option value="Vesicular_Breathing">Vesicular_Breathing</option>
                                <option value="Vesicular Diminished Breath Sound(specify)">Vesicular Diminished Breath
                                    Sound(specify)</option>

                            </select>
                        </div>
                    </div>



                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Cardiac Auscultation">Question No.42: Cardiac Auscultation</label><br>
                            <select class="form-control" id="Question_No_42_Cardiac_Auscultation"
                                name="Question_No_42_Cardiac_Auscultation" required>
                                <option value="">Select</option>
                                <option value="Normal S1/S2">Normal S1/S2 </option>
                                <option value="Murmur">Murmur</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label><br>
                            <textarea name = "chest_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>

            <!--  Step Thirteen -->
            <div class="step" id="step12">
                <h3>Abdomen</h3>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="did you observe any distension, scars, or masses on the child's abdomen">
                                Question No.43: Did you observe any distension, scars, or masses on the child's
                                abdomen?</label><br>
                            <select class="form-control" id="distention_scar_mass"
                                name="Question_No_43_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?"
                                required>
                                <option value="">Select</option>
                                <option value="Distention">Distention</option>
                                <option value="Scar">Scar</option>
                                <option value="Mass">Mass</option>
                                <option value="Normal">Normal</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for=" Any history of abdominal Pain">Question No.44 Any history of abdominal
                                Pain</label><br>
                            <select class="form-control" id="any_history_of_abdominal_pain"
                                name="Question_No_44_Any_history_of_abdominal_Pain" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No </option>
                            </select>
                        </div>



                        <div class="form-group col-md-6 any_history_of_abdominal_pain_specify d-none">
                            <div class="form-group">
                                <label for="any_neck_swelling">Specify Abdominal Pain</label><br>
                                <input type="text" name="any_history_of_abdominal_pain_specify" class="form-control"
                                    id="any_history_of_abdominal_pain_specify"
                                    placeholder="Please specify any history of abdominal Pain">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label><br>
                            <textarea name = "abdomen_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>
            <!--  Step Fourteen -->
            <div class="step" id="step13">
                <h3>Musculoskeletal</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="field6">Question No.45: Did you observe any limitations in the child's range of
                                joint motion during your examination?*</label><br>
                            <select class="form-control" id="limitations_range_motion"
                                name="Question_No_45_Did_you_observe_any_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"
                                required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group limitations_range_motion_specify d-none">
                            <label for="any_neck_swelling">Specify limitations in the child's range of joint motion during
                                your examination?*</label><br>
                            <input type="text"
                                name="Specify_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"
                                class="form-control" id="limitations_range_motion_specify"
                                placeholder="Please specify limitations in the child's range of joint motion during your examination?*"><br>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="field6">Question No.46: Spinal curvature assessment (tick positive finding)
                            </label><br>
                            <select class="form-control" id="spinal_curvature_assessment"
                                name="Question_No_46_Spinal_curvature_assessment_(tick_positive_finding)" required>
                                <option value="">Select</option>
                                <option value="Uneven shoulders">Uneven Shoulders</option>
                                <option value="Shoulder Blade">Shoulder Blade</option>
                                <option value="Uneven waist">Uneven Waist</option>
                                <option value="Hips">Hips</option>
                                <option value="Normal">Normal</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="side-to-side curvature in the spine resembling ">Question No.47: side-to-side
                                curvature in the spine resembling </label><br>
                            <select class="form-control" id="curvature_spine_resembling"
                                name="Question_No_47_side-to-side_curvature_in_the_spine_resembling" required>
                                <option value="">Select</option>
                                <option value="S_Shape">S Shape</option>
                                <option value="C_Shape">C Shape</option>
                                <option value="Normal">Normal</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Adams forward bend test">Question No.48: Adams forward bend test</label><br><br>
                            <select class="form-control" id="adams_forward_bend_test"
                                name="Question_No_48_Adams_forward_bend_test" required>
                                <option value="">Select</option>
                                <option value="Positive">Positive</option>
                                <option value="Negative">Negative</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="field6">Question No.49: Any foot or toe abnormalities</label><br>
                            <select class="form-control" id="foot_or_toe_abnormalities"
                                name="Question_No_49_Any_foot_or_toe_abnormalities" required>
                                <option value="">Select</option>
                                <option value="Normal">Normal</option>
                                <option value="Flat Feet">Flat Feet</option>
                                <option value="Varus">Varus</option>
                                <option value="Valgus">Valgus</option>
                                <option value="High Arch">High Arch</option>
                                <option value="Hammer Toe">Hammer Toe</option>
                                <option value="Bunion">Bunion</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label><br>
                            <textarea name = "musculoskeletal_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>
           
            <!--  Step Fourteen -->
            <div class="step" id="step14">
                <h3>Vaccination:</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="field13">Question No.50: Have EPI immunization card? </label><br>
                            <select class="form-control" id="immunization_card"
                                name="Question_No_50_Have_EPI_immunization_card?" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group immunization_card_specify d-none">
                            <label for="Reason">Reason of not being vaccinated</label><br>
                            <input type="text" name="Reason_of_not_being_vaccinated" class="form-control"
                                id="Reason_of_not_being_vaccinated">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="field13">Question No.50: Mark all the vaccinations that are completed</label><br>
                            <input type="checkbox" value="BCG_1_dose" id="BCG_1_dose" name="BCG_1_dose">
                            <label for="deformities ">BCG_1_dose</label><br>
                            <input type="checkbox" value="OPV_4_dose" id="OPV_4_dose" name="OPV_4_dose">
                            <label for="swelling ">OPV_4_dose </label><br>
                            <input type="checkbox" value="Pentavalent vaccine (DTP+Hep B + Hib) 3 dose" id="Pentavalent"
                                name="Pentavalent_vaccine_(DTP+Hep B + Hib)_3_dose">
                            <label for="redness">Pentavalent_vaccine_(DTP+Hep B + Hib)_3_dose </label><br>
                            <input type="checkbox" value="Rota 2 doses" id="rota" name="rota">
                            <label for="of nasal discharge ">Rota_2_doses</label><br>
                            <input type="checkbox" value="Measles 2 dose" id="measles" name="measles">
                            <label for="lesions ">Measles 2 dose</label><br>
                            <input type="checkbox" value="Never had any vaccination" id="never_had_any_vaccination"
                                name="never_had_any_vaccination">
                            <label for="of nasal discharge ">Never had any vaccination</label>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label><br>
                            <textarea name = "vaccination_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>

            <!--  Step Sixteen -->
            <!-- <div class="step" id="step15">
                                        <h3>Lead exposure</h3>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="field51">
                                                    Question.51:Do you Frequently put things in his/her mouth such as toys, jewelry, or
                                                    keys?</label>
                                                <select class="form-control"
                                                    name="Question_51_Do_you_Frequently_put_things_in_his/her_mouth_such_as_toys,_jewelry,_or_keys?"
                                                    id="Question_51_Do_you_Frequently_put_things_in_his_her_mouth_such_as_toys_jewelry_or_keys"
                                                    required>
                                                    <option value="">Select</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Does your child eat non-food items(pica)">Question.52: Does your child eat non-food
                                                    <br> items(pica)?</label><br>
                                                <select class="form-control" id="eat_non-food_items"
                                                    name="Question_52_Does_your_child_eat_non_food_items_(pica)?" required>
                                                    <option value="">Select</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="field6">Question.53: Do you frequently come in contact with an adult whose job
                                                    involves exposure to lead?</label>
                                                <select class="form-control"
                                                    id="Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead"
                                                    name="Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead?"
                                                    required>
                                                    <option value="">Select</option>
                                                    <option value="House painting">House painting</option>
                                                    <option value="Plumbing">Plumbing</option>
                                                    <option value="Renovation">Renovation</option>
                                                    <option value="Construction">Construction</option>
                                                    <option value="Auto repair">Auto repair</option>
                                                    <option value="Welding">Welding</option>
                                                    <option value="Electronics repair">Electronics repair</option>
                                                    <option value="Jewelry or pottery making">Jewelry or pottery making</option>
                                                    <option value="None of the above">None of the above</option>

                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="field6">Question.54: Do you frequently come in contact with an adult whose hobby
                                                    involves exposure to lead?</label>
                                                <select class="form-control" id="hobby_involves"
                                                    name="Question_54_Do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead?"
                                                    required>
                                                    <option value="">Select</option>
                                                    <option value="Making stained glass">Making stained glass</option>
                                                    <option value="Pottery">Pottery</option>
                                                    <option value="Firearm making">Firearm making</option>
                                                    <option value="Collecting lead">Collecting lead</option>
                                                    <option value="None of the above">None of the above</option>

                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="comment">Comment/Findings</label><br>
                                                    <textarea name = "lead_exposure_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary prevStep">Previous</button>
                                        <button type="button" class="btn btn-primary nextStep">Next</button>
                                    </div>  -->
            {{-- step 18 --}}
            
            <div class="step" id="step15">
                <h3>Miscellaneous</h3>
                <div class="form-row">
                    <div class="form-group col-md-6 ">
                        <label for="do_you_have_any_Allergies">Question No.55:Do you have any Allergies</label><br>
                        <select class="form-control" id="do_you_have_any_Allergies"
                            name="Question_No_55_Do_you_have_any_Allergies" required>
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No </option>
                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group do_you_have_any_Allergies_specify d-none">
                            <label for="Specify Allergies">Specify Allergies</label><br>
                            <input type="text" name="Do_you_have_any_allergies_specify" class="form-control"
                                id="do_you_have_any_allergies_specify" placeholder="Please specify allergies"><br>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Menarche age">Question No.56:Girls above 8 years old ask age of
                                Menarche:</label><br><br>
                            <input type="text" name="Question_No_56_Girls_above_8_years_old_ask:"
                                class="form-control"id=" menarche_age" placeholder="Write Age"><br>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Menarche age">Question No.57:Inquire about urinary frequency, urgency, and any
                                pain
                                or discomfort during urination.</label><br>
                            <select class="form-control" id="discomfort_during_urination"
                                name="Question_No_57_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination"
                                required>
                                <option value="">Select</option>
                                <option value="No urinary issues reported">No urinary issues reported</option>
                                <option value="Urinary frequency">Urinary frequency</option>
                                <option value="Urinary urgency">Urinary urgency</option>
                                <option value="Pain or discomfort during urination">Pain or discomfort during urination
                                </option>
                                <option value="Nocturnal enuresis">Nocturnal enuresis</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="menstrual abnormality">Question No.58:Any menstrual abnormality.</label><br>
                            <select class="form-control" id="any_menstrual_abnormality"
                                name="QuestionNo_58_Any_menstrual_abnormality" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group any_menstrual_abnormality_specify d-none">
                            <label for="any_menstrual_abnormality">Specify Menstrual Abnormality</label><br>
                            <input type="text" name="Any_menstrual_abnormality_specify" class="form-control"
                                id="any_menstrual_abnormality_specify" placeholder="Please Menstrual Abnormality"><br>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label><br>
                            <textarea name = "miscellaneous_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>
            {{-- step 19 --}}
            <div class="step last-step mb-5" id="step17">
                <h3>Psychological</h3>
                <div class="form-row">

                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Thought Patterns">Question No.59: <b>Thought Patterns:</b>How often do you
                                experience negative or intrusive thoughts?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts"
                                name="Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts?"
                                required>
                                <option value="">Select</option>
                                <option value="Rarely">Rarely</option>
                                <option value="Occasionally">Occasionally</option>
                                <option value="Frequently">Frequently</option>
                                <option value="Almost always">Almost always</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Self-Esteem">Question No.60: <b>Self-Esteem:</b> How would you rate your overall
                                self-esteem and self-confidence?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence"
                                name="Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence?"
                                required>
                                <option value="">Select</option>
                                <option value="Very high">Very high</option>
                                <option value="Moderately high">Moderately high</option>
                                <option value="Moderately low">Moderately low</option>
                                <option value="Very low">Very low</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Energy Levels">Question No.61: <b>Energy Levels:</b> How would you describe your
                                energy levels throughout a typical day?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day"
                                name="Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day?"
                                required>
                                <option value="">Select</option>
                                <option value="High and consistent">High and consistent</option>
                                <option value="Moderate and stable">Moderate and stable</option>
                                <option value="Fluctuating">Fluctuating</option>
                                <option value="Low and inconsistent">Low and inconsistent</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Coping Strategies">Question No.62: <b>Coping Strategies:</b> When faced with
                                challenges, what are your typical coping mechanisms?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms"
                                name="Question_No_62_When_faced_with_challenges,_what_are_your_typical_coping_mechanisms?"
                                required>
                                <option value="">Select</option>
                                <option value="Healthy coping strategies">Healthy coping strategies</option>
                                <option value="Neutral coping strategies">Neutral coping strategies</option>
                                <option value="Unhealthy coping strategies">Unhealthy coping strategies</option>
                                <option value="No clear coping strategies">No clear coping strategies</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- new --}}
                <div class="form-row">
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Sleep Quality">Question No.63: <b>Sleep Quality:</b> How would you rate the
                                quality of your sleep on average?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average"
                                name="Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average?" required>
                                <option value="">Select</option>
                                <option value="Excellent">Excellent</option>
                                <option value="Good">Good</option>
                                <option value="Fair">Fair</option>
                                <option value="Poor">Poor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Stress Levels">Question No.64: <b>Stress Levels:</b> How often have you felt
                                overwhelmed or stressed in the last few weeks?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks"
                                name="Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks?"
                                required>
                                <option value="">Select</option>
                                <option value="Rarely">Rarely</option>
                                <option value="Occasionally">Occasionally</option>
                                <option value="Frequently">Frequently</option>
                                <option value="Almost always">Almost always</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Mood Assessment">Question No.65: <b>Mood Assessment:</b> How would you describe
                                your overall mood during the day?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_65_How_would_you_describe_your_overall_mood_during_the_day"
                                name="Question_No_65_How_would_you_describe_your_overall_mood_during_the_day?" required>
                                <option value="">Select</option>
                                <option value="Very positive">Very positive</option>
                                <option value="Mostly positive">Mostly positive</option>
                                <option value="Mixed">Mixed</option>
                                <option value="Mostly negative">Mostly negative</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Family Relationships">Question No.66: <b>Family Relationships:</b> How would you
                                describe the quality of your relationships with family members?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members"
                                name="Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members?"
                                required>
                                <option value="">Select</option>
                                <option value="Very positive">Very positive</option>
                                <option value="Mostly positive">Mostly positive</option>
                                <option value="Mixed">Mixed</option>
                                <option value="Mostly negative">Mostly negative</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Sleep Quality">Question No.67: <b>Problem-Solving Skills:</b> How well does you
                                handle challenges and solve problems?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_67_How_well_does_you_handle_challenges_and_solve_problems"
                                name="Question_No_67_How_well_does_you_handle_challenges_and_solve_problems?" required>
                                <option value="">Select</option>
                                <option value="Very well">Very well</option>
                                <option value="Moderately well">Moderately well</option>
                                <option value="Somewhat poorly">Somewhat poorly</option>
                                <option value="Very poorly">Very poorly</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Sleep Patterns">Question No.68: <b>Sleep Patterns:</b> How many hours of sleep
                                does you typically get on a school night?</label><br>
                            <select class="form-control PsychologicalSelectedAttribute"
                                id="Question_No_68_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night"
                                name="Question_No_68_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night?"
                                required>
                                <option value="">Select</option>
                                <option value="9 or more hours">9 or more hours</option>
                                <option value="7-8 hours">7-8 hours</option>
                                <option value="6 hours or less">6 hours or less</option>
                                <option value="Variable, inconsistent">Variable, inconsistent</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group">
                            <label for="Sleep Quality">Question No.69: <b> followup required?:</b></label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="followup_required"
                                name="followup_required" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6 Psychological">
                        <div class="form-group reffered d-none">
                            <label for="Sleep Patterns">Question No.70: <b>Referred By:</b></label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="referred_by"
                                name="referred_by">
                                <option value="">Select</option>
                                <option value="Teacher">Teacher</option>
                                <option value="School Docotor">School Docotor</option>
                                <option value="Both">Both</option>
                                <option value="None">None</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">








                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="Sleep Patterns">Question: Restless or overactive? (tell me about his/her focus
                                level see if the child is shifting by asking him any question related to his/her name, which
                                subject he/she likes)</label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation1"
                                name="observation1">
                                <option value="">Select</option>
                                <option value="1">Not At All </option>
                                <option value="2">Just a Little </option>
                                <option value="3">Pretty Much </option>
                                <option value="4">Very Much</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="Sleep Patterns">Question: Excitable, Impulsive? (ask about aggression level,
                                how often child engage in fight during class)</label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation2"
                                name="observation2">
                                <option value="">Select</option>
                                <option value="1">Not At All </option>
                                <option value="2">Just a Little </option>
                                <option value="3">Pretty Much </option>
                                <option value="4">Very Much</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="Sleep Patterns">Question:Disturbs other children? (pin or irritate that can
                                disturb the whole class)</label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation3"
                                name="observation3">
                                <option value="">Select</option>
                                <option value="1">Not At All </option>
                                <option value="2">Just a Little </option>
                                <option value="3">Pretty Much </option>
                                <option value="4">Very Much</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="Sleep Patterns">Question:Fails to finish things started-short attention span?
                                (couldn’t able to complete the task at all) </label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation4"
                                name="observation4">
                                <option value="">Select</option>
                                <option value="1">Not At All </option>
                                <option value="2">Just a Little </option>
                                <option value="3">Pretty Much </option>
                                <option value="4">Very Much</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="Inattentive, easily distracted">Question:Inattentive, easily distracted?
                                (difficulty
                                following
                                instructions, generally ask any question and see if the child is able to follow it or
                                not)</label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation5"
                                name="observation5">
                                <option value="">Select</option>
                                <option value="1">Not At All </option>
                                <option value="2">Just a Little </option>
                                <option value="3">Pretty Much </option>
                                <option value="4">Very Much</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="Sleep Patterns">Question:Cries often and easily? (How often child cries during
                                the class)</label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation6"
                                name="observation6">
                                <option value="">Select</option>
                                <option value="1">Not At All </option>
                                <option value="2">Just a Little </option>
                                <option value="3">Pretty Much </option>
                                <option value="4">Very Much</option>
                            </select>
                        </div>
                    </div>




                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="Sleep Patterns">Question:Is your spelling poor? (ask any 2 spellings like cook,
                                him, her and see if there are errors)</label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation7"
                                name="observation7">
                                <option value="">Select</option>
                                <option value="1">Not At All </option>
                                <option value="2">Just a Little </option>
                                <option value="3">Pretty Much </option>
                                <option value="4">Very Much</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="Sleep Patterns">Question:When writing down the date, do you often make
                                mistakes? (ask about the date and see if the child is making a mistake) </label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation8"
                                name="observation8">
                                <option value="">Select</option>
                                <option value="1">Not At All </option>
                                <option value="2">Just a Little </option>
                                <option value="3">Pretty Much </option>
                                <option value="4">Very Much</option>
                            </select>
                        </div>
                    </div>







                    <div class="form-group col-md-6">
                        <div class="form-group observation">
                            <label for="Sleep Patterns">Question:Do you find difficulty in telling left from right?
                                (generally ask about left and right , to see the difficulty child is having)</label><br>
                            <select class="form-control PsychologicalSelectedAttribute" id="observation9"
                                name="observation9">
                                <option value="">Select</option>
                                <option value="1">Not At All </option>
                                <option value="2">Just a Little </option>
                                <option value="3">Pretty Much </option>
                                <option value="4">Very Much</option>
                            </select>
                        </div>
                    </div>

                </div>


                <div class="form-group col-md-6">
                    <div class="form-group observation">
                        <label for="Sleep Patterns">Question:Do you mix up bus numbers like 35 and 53? (Ask any 2 numbers
                            like 35 and 53 and see if the child is making a mistake or not)</label><br>
                        <select class="form-control PsychologicalSelectedAttribute" id="observation10"
                            name="observation10">
                            <option value="">Select</opt ion>
                            <option value="1">Not At All </option>
                            <option value="2">Just a Little </option>
                            <option value="3">Pretty Much </option>
                            <option value="4">Very Much</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6 ">
                    <div class="form-group">
                        <label for="comment">Comment/Findings</label><br>
                        <textarea name = "psychological_comment" placeholder = "Comment here" id = "comment" cols="50" required></textarea>
                    </div>
                </div>


                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
                {{-- <button type="button" id="submit" name="submit" class="btn btn-success">Submit</button> --}}
            </div>
            {{-- step 20 --}}
            <div class="step last-step mb-5" id="step18">
                <h3>Nutritionist</h3>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_60_How_would_you_describe_your_lifestyle">Question No.60: How would
                                you describe your lifestyle?</label><br>
                            <select class="form-control" id="Question_No_60_How_would_you_describe_your_lifestyle"
                                name="Question_No_60_How_would_you_describe_your_lifestyle" required>
                                <option value="">Select</option>
                                <option value="Sedentary">Sedentary</option>
                                <option value="Moderately">Moderately</option>
                                {{-- <option value="Low Active">Low Active</option> --}}
                                <option value="Active">Active</option>
                                {{-- <option value="Very Active (Athletic)">Very Active (Athletic)</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 bmi61">
                        <div class="form-group">
                            <label for="bmi61">Question No.61: BMI</label><br>
                            <input type="text" name="bmi61" class="form-control" id="bmi61"
                                placeholder="BMI" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 muac" id="muac-container">
                        <div class="form-group">
                            <label for="muac">Question No.62: MUAC</label><br>
                            <input type="text" name="muac" class="form-control" id="muac"
                                placeholder="MUAC">

                        </div>
                    </div>
                    <div class="form-group col-md-6 Daily_Protien_requirement">
                        <div class="form-group">
                            <label for="Daily_Protien_requirement">Question No.63: Daily Protien requirement</label><br>
                            <input type="text" name="Daily_Protien_requirement" class="form-control"
                                id="Daily_Protien_requirement" placeholder="Daily Protien requirement">
                        </div>
                    </div>
                </div>
                {{-- new --}}
                <div class="form-row">
                    <div class="form-group col-md-6 Daily_energy_requirement">
                        <div class="form-group">
                            <label for="Daily_energy_requirement">Question No.64: Daily Energy <br>
                                requirement</label><br>

                            <input type="text" name="Daily_energy_requirement" class="form-control"
                                id="Daily_energy_requirement" placeholder="Daily Energy requirement">


                            <select class="form-control" id="Daily_energy_requirement1" style="display: none;">
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

                                            echo "<option value='{$energychartID}' id='{$energychartID}' age='{$AGE}' gender='{$Gander}' sedentary='{$sedentary}' Moderate='{$Moderate}' activela='{$activela}' > {$activela} {$Gander} {$AGE}  </option>";
                                        }
                                    }
                                @endphp
                            </select>

                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day">Question
                                No.65: How many glasses of water/liquids do you consume in a day?</label><br>
                            <select class="form-control"
                                id="Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day"
                                name="Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day" required>
                                <option value="">Select</option>
                                <option value="6-8">6-8</option>
                                <option value="4-6">4-6</option>
                                <option value="< 4">
                                    < 4</option>
                            </select>

                        </div>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label
                                for="Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to">Question
                                No.66: Does the child have any history of substances abuse or addiction to</label><br>
                            <select class="form-control"
                                id="Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to"
                                name="Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to"
                                required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6 d-none" id="addictionContainer">
                        <div class="form-group">
                            <label for="addiction">Please Specify</label><br>
                            <select class="form-control mt-4" id="addiction" name="addiction">
                                <option value="">Select</option>
                                <option value="Smoking">Smoking</option>
                                <option value="Alcohol">Alcohol</option>
                                <option value="Pan / Gutka / Chalia consumption">Pan / Gutka / Chalia consumption</option>
                                <option value="Substance / Drugs abuse">Substance / Drugs abuse</option>
                                <option value="gutka">gutka</option>
                                <option value="chalia">chalia</option>
                                <option value="substance">substance </option>
                                <option value="drug abuse">drug abuse </option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-6 d-none" id="otherAddictionContainer">
                        <div class="form-group">
                            <label for="other_addiction">Please Describe</label><br>
                            <textarea class="form-control" name="other_addiction" id="other_addiction" class="w-100" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="food_allergies">Question No.67: Does the child suffer from any food intolerances/
                                food allergies?</label><br>
                            <select class="form-control" id="food_allergies" name="food_allergies" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6 d-none" id="food_allergiesContainer">
                        <div class="form-group">
                            <label for="other_addiction">Specify the foods</label><br>
                            {{-- <textarea class="form-control" name="other_food_allergies" id="other_food_allergies" class="w-100" rows="3"></textarea> --}}


                            <select name="other_food_allergies" id="other_food_allergies" class="form-control">
                                <option value="Milk" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Milk' ? 'selected' : ''; ?>>Milk</option>
                                <option value="Eggs" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Eggs' ? 'selected' : ''; ?>>Eggs</option>
                                <option value="Peanuts" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Peanuts' ? 'selected' : ''; ?>>Peanuts</option>
                                <option value="Tree nuts (e.g., almonds, walnuts, cashews)" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Tree nuts (e.g., almonds, walnuts, cashews)' ? 'selected' : ''; ?>>Tree nuts
                                    (e.g., almonds, walnuts, cashews)</option>
                                <option value="Almonds" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Almonds' ? 'selected' : ''; ?>>Almonds</option>
                                <option value="Walnuts" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Walnuts' ? 'selected' : ''; ?>>Walnuts</option>
                                <option value="Cashews" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Cashews' ? 'selected' : ''; ?>>Cashews</option>
                                <option value="Fish (e.g., salmon, tuna)" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Fish (e.g., salmon, tuna)' ? 'selected' : ''; ?>>Fish (e.g., salmon, tuna)
                                </option>
                                <option value="Salmon" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Salmon' ? 'selected' : ''; ?>>Salmon</option>
                                <option value="Tuna" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Tuna' ? 'selected' : ''; ?>>Tuna</option>
                                <option value="Shellfish (e.g., shrimp, crab)" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Shellfish (e.g., shrimp, crab)' ? 'selected' : ''; ?>>Shellfish (e.g.,
                                    shrimp, crab)</option>
                                <option value="Shrimp" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Shrimp' ? 'selected' : ''; ?>>Shrimp</option>
                                <option value="Crab" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Crab' ? 'selected' : ''; ?>>Crab</option>
                                <option value="Soy" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Soy' ? 'selected' : ''; ?>>Soy</option>
                                <option value="Wheat" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Wheat' ? 'selected' : ''; ?>>Wheat</option>
                                <option value="Others" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Others' ? 'selected' : ''; ?>>Others</option>
                            </select>


                        </div>
                    </div>
                    <!-- <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="lifestyle">Question No.68: How would you describe your <br> lifestyle?</label><br>
                                                    <select class="form-control" id="lifestyle" name="lifestyle" required>
                                                        <option value="">Select</option>
                                                        <option value="Sedentary">Sedentary</option>
                                                        <option value="Low Active">Low Active</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Very Active (Athletic)">Very Active (Athletic)</option>
                                                    </select>
                                                </div>
                                            </div>  -->
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="meals">Question No.69: How many meals (breakfast / lunch / dinner) do you
                                consume in a day?</label><br>
                            <select class="form-control" id="meals" name="meals" required>
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2-3">2-3</option>
                                <option value=">3"> >3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="food_items">Question No.70: How many packed items/foods (chips / biscuits sodas)
                                do you consume in average in a day?</label><br>
                            <select class="form-control" id="food_items" name="food_items" required>
                                <option value="">Select</option>
                                <option value="0-1">0-1</option>
                                <option value="1-2">1-2</option>
                                <option value="3 or more">3 or more</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="fast_food">Question No.71: How frequently do you consume fast food on dineout on
                                average in a week?</label><br>
                            <select class="form-control" id="fast_food" name="fast_food" required>
                                <option value="">Select</option>
                                {{-- <option value="0-1">0-1</option> --}}
                                <option value="< 1">
                                    < 1</option>
                                <option value="1-2">1-2</option>
                                <option value="3 or more">3 or more</option>
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
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row d-none refer_to_form_row ">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="refer_to">Refer To</label>
                            <select id="refer_to" name="refer_to" class="form-control" multiple required>
                                {{-- <option value="">Select</option> --}}
                                <option value="1">Psychologist</option>
                                <option value="2">Nutritionist</option>
                                {{-- <option value="3">Physician</option> --}}
                                <option value="4">External Specialists</option>
                                <option value="5">General Physician (school health physician )</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-row d-none" id="follow_up_show">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Reason_for_Follow_up">Reason for Follow-up</label>
                            <input placeholder="Reason for Follow-up" name="Reason_for_Follow_up"
                                id="Reason_for_Follow_up" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Follow_up_Date">Follow-up Date</label>
                            <input type="date" placeholder="Follow-up Date" name="Follow_up_Date"
                                id="Follow_up_Date" class="form-control" />
                        </div>
                    </div>
                </div>


                <div class="form-row align-items-center my-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="read_oly_age">Age</label>
                            <input type="text" name="read_oly_age" id="read_oly_age" class="form-control"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="read_oly_gender">Gender</label>
                            <input type="text" name="read_oly_gender" id="read_oly_gender" class="form-control"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="form-row align-items-center my-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="read_oly_weight">Weight</label>
                            <input type="text" name="read_oly_weight" id="read_oly_weight" class="form-control"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="read_oly_height">Height</label>
                            <input type="text" name="read_oly_height" id="read_oly_height" class="form-control"
                                readonly>
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
                                        <option value="Severe Wasting (WHZ < -3)">Severe Wasting (WHZ < -3)</option>
                                        <option value="Moderate Wasting (WHZ between -3 and -2)">Moderate Wasting (WHZ
                                            between -3 and -2)</option>
                                        <option value="Normal (WHZ between -2 and +2)">Normal (WHZ between -2 and +2)
                                        </option>
                                        <option value="Overweight (WHZ > +2)">Overweight (WHZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/born-5-whz-girls.png') }}">
                    </div>
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
                                        <option value="Severe Wasting (WHZ < -3)">Severe Wasting (WHZ < -3)</option>
                                        <option value="Moderate Wasting (WHZ between -3 and -2)">Moderate Wasting (WHZ
                                            between -3 and -2)</option>
                                        <option value="Normal (WHZ between -2 and +2)">Normal (WHZ between -2 and +2)
                                        </option>
                                        <option value="Overweight (WHZ > +2)">Overweight (WHZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/born-5-whz-boys.png') }}">
                    </div>
                </div>

                <div class="form-row align-items-center my-4 d-none" id="5_19_wasting_girls">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wasting_5_to_19_girl">For children and adolescents(Girls) Wasting (Criteria
                                5-19)</label>
                            <p>Severe Thinness: BMI-for-age Z-score < -3</p>
                                    <p>Moderate Thinness: BMI-for-age Z-score between -3 and -2</p>
                                    <p>Normal Weight: BMI-for-age Z-score between -2 and +1</p>
                                    <p>Overweight: BMI-for-age Z-score > +1</p>
                                    <p>Obesity: BMI-for-age Z-score > +2</p>
                                    <select name="wasting_5_to_19_girl" id="wasting_5_to_19_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectWasting">
                                        <option value="">Select</option>
                                        <option value="Severe Thinness">Severe Thinness</option>
                                        <option value="Moderate Thinness">Moderate Thinness</option>
                                        <option value="Normal Weight">Normal Weight</option>
                                        <option value="Overweight">Overweight</option>
                                        <option value="Obesity">Obesity</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/5-19_bmi_girls.png') }}">
                    </div>
                </div>

                <div class="form-row align-items-center my-4 d-none" id="5_19_wasting_boys">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wasting_5_to_19_boy">For children and adolescents(Boys) Wasting (Criteria
                                5-19)</label>
                            <p>Severe Thinness: BMI-for-age Z-score < -3</p>
                                    <p>Moderate Thinness: BMI-for-age Z-score between -3 and -2</p>
                                    <p>Normal Weight: BMI-for-age Z-score between -2 and +1</p>
                                    <p>Overweight: BMI-for-age Z-score > +1</p>
                                    <p>Obesity: BMI-for-age Z-score > +2</p>

                                    <select name="wasting_5_to_19_boy" id="wasting_5_to_19_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectWasting">
                                        <option value="">Select</option>
                                        <option value="Severe Thinness">Severe Thinness</option>
                                        <option value="Moderate Thinness">Moderate Thinness</option>
                                        <option value="Normal Weight">Normal Weight</option>
                                        <option value="Overweight">Overweight</option>
                                        <option value="Obesity">Obesity</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/5-19_bmi_boys.png') }}">
                    </div>
                </div>

                {{-- -------------------------------- STUNTING CRITERIA ------------------------------------ --}}
                <div class="form-row align-items-center my-4 d-none" id="birth_2_stunting_girls">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_birth_to_2_girl">STUNTING CRITERIA: FOR BIRTH TO 2 YEARS Girls</label>
                            <p>Severe Stunting (LAZ < -3): </p>
                                    <p>Stunting (LAZ between -3 and -2): </p>
                                    <p>Normal (LAZ between -2 and +2): </p>
                                    <p>Tall (LAZ > +2): </p>

                                    <select name="stunting_birth_to_2_girl" id="stunting_birth_to_2_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting (LAZ < -3)">Severe Stunting (LAZ < -3)</option>
                                        <option value="Stunting (LAZ between -3 and -2)">Stunting (LAZ between -3 and -2)
                                        </option>
                                        <option value="Normal (LAZ between -2 and +2)">Normal (LAZ between -2 and +2)
                                        </option>
                                        <option value="Tall (LAZ > +2)">Tall (LAZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/birth-2_stun_girls.png') }}">
                    </div>
                </div>

                <div class="form-row align-items-center my-4 d-none" id="birth_2_stunting_boys">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_birth_to_2_boy">STUNTING CRITERIA: FOR BIRTH TO 2 YEARS Boys</label>
                            <p>Severe Stunting (LAZ < -3): </p>
                                    <p>Stunting (LAZ between -3 and -2): </p>
                                    <p>Normal (LAZ between -2 and +2): </p>
                                    <p>Tall (LAZ > +2): </p>
                                    <select name="stunting_birth_to_2_boy" id="stunting_birth_to_2_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting (LAZ < -3)">Severe Stunting (LAZ < -3)</option>
                                        <option value="Stunting (LAZ between -3 and -2)">Stunting (LAZ between -3 and -2)
                                        </option>
                                        <option value="Normal (LAZ between -2 and +2)">Normal (LAZ between -2 and +2)
                                        </option>
                                        <option value="Tall (LAZ > +2)">Tall (LAZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/birth-2_stun_boys.png') }}">
                    </div>
                </div>

                <div class="form-row align-items-center my-4 d-none" id="2_5_stunting_girls">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_2_5_girl">STUNTING CRITERIA: FOR 2 TO 5 YEARS Girls</label>
                            <p>Severe Stunting (LAZ/HAZ < -3): </p>
                                    <p>Stunting (LAZ/HAZ between -3 and -2): </p>
                                    <p>Normal (LAZ/HAZ between -2 and +2): </p>
                                    <p>Tall (LAZ/HAZ > +2): </p>

                                    <select name="stunting_2_5_girl" id="stunting_2_5_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting (LAZ/HAZ < -3)">Severe Stunting (LAZ/HAZ <
                                                -3)</option>
                                        <option value="Stunting (LAZ/HAZ between -3 and -2)">Stunting (LAZ/HAZ between -3
                                            and -2)</option>
                                        <option value="Normal (LAZ/HAZ between -2 and +2)">Normal (LAZ/HAZ between -2 and
                                            +2)</option>
                                        <option value="Tall (LAZ/HAZ > +2)">Tall (LAZ/HAZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/2-5_stun_boys.png') }}">
                    </div>
                </div>

                <div class="form-row align-items-center my-4 d-none" id="2_5_stunting_boys">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_2_5_boy">STUNTING CRITERIA: FOR 2 TO 5 YEARS Boys</label>
                            <p>Severe Stunting (LAZ/HAZ < -3): </p>
                                    <p>Stunting (LAZ/HAZ between -3 and -2): </p>
                                    <p>Normal (LAZ/HAZ between -2 and +2): </p>
                                    <p>Tall (LAZ/HAZ > +2): </p>
                                    <select name="stunting_2_5_boy" id="stunting_2_5_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting (LAZ/HAZ < -3)">Severe Stunting (LAZ/HAZ <
                                                -3)</option>
                                        <option value="Stunting (LAZ/HAZ between -3 and -2)">Stunting (LAZ/HAZ between -3
                                            and -2)</option>
                                        <option value="Normal (LAZ/HAZ between -2 and +2)">Normal (LAZ/HAZ between -2 and
                                            +2)</option>
                                        <option value="Tall (LAZ/HAZ > +2)">Tall (LAZ/HAZ > +2)</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/2-5_stun_girls.png') }}">
                    </div>
                </div>


                <div class="form-row align-items-center my-4 d-none" id="5_19_stunting_girls">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_5_19_girl">STUNTING CRITERIA: FOR 5 TO 19 YEARS Girls</label>
                            <p> Severe Stunting: Height-for-age Z-score (HAZ) < -3 </p>
                                    <p> Stunting: Height-for-age Z-score (HAZ) between -3 and -2 </p>
                                    <p>Normal: Height-for-age Z-score (HAZ) between -2 and +2 </p>
                                    <p>Tall: Height-for-age Z-score (HAZ) > +2 </p>

                                    <select name="stunting_5_19_girl" id="stunting_5_19_girl"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting">Severe Stunting</option>
                                        <option value="Stunting">Stunting</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Tall">Tall</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/5-19_stun_girls.png') }}">
                    </div>
                </div>

                <div class="form-row align-items-center my-4 d-none" id="5_19_stunting_boys">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_5_19_boy">STUNTING CRITERIA: FOR 5 TO 19 YEARS Boys</label>
                            <p> Severe Stunting: Height-for-age Z-score (HAZ) < -3 </p>
                                    <p> Stunting: Height-for-age Z-score (HAZ) between -3 and -2 </p>
                                    <p>Normal: Height-for-age Z-score (HAZ) between -2 and +2 </p>
                                    <p>Tall: Height-for-age Z-score (HAZ) > +2 </p>

                                    <select name="stunting_5_19_boy" id="stunting_5_19_boy"
                                        class="form-control NutritionistOptionsAttribute NutritionistSelectStunting">
                                        <option value="">Select</option>
                                        <option value="Severe Stunting">Severe Stunting</option>
                                        <option value="Stunting">Stunting</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Tall">Tall</option>
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('admin/images/wasting-criteria/5-19_stun_boys.png') }}">
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="NutritionistComment">Comment</label><br>

                        <textarea class="form-control w-100" name="NutritionistComment" id="NutritionistComment" rows="5"
                            required><?php echo isset($details['NutritionistComment']) ? htmlspecialchars($details['NutritionistComment']) : ''; ?></textarea>

                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="DietaryAdviceComment">Dietary Advice Comment</label><br>

                        <textarea class="form-control w-100" name="DietaryAdviceComment" id="DietaryAdviceComment" rows="5"
                            required><?php echo isset($details['DietaryAdviceComment']) ? htmlspecialchars($details['DietaryAdviceComment']) : ''; ?></textarea>

                    </div>
                </div>




                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" id="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
        </form>

    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {



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
                        nutritionalDiagnosis: "Severe thinness related to inadequate caloric intake as evidenced by BMI-for-age Z-score below -3 and visible signs of undernutrition.",
                        dietaryAdvice: "Encourage energy-dense foods like avocados, nuts, full-fat dairy, and regular meals/snacks to increase calorie intake."
                    },
                    'Moderate Thinness': {
                        nutritionalDiagnosis: "Moderate thinness related to insufficient caloric intake.",
                        dietaryAdvice: "Provide a balanced diet with moderate increases in calories and nutrient-rich foods."
                    },
                    'Normal Weight': {
                        nutritionalDiagnosis: "Healthy weight status maintained through appropriate dietary intake, as evidenced by BMI-for-age Z-score between -2 and +1.",
                        dietaryAdvice: "Encourage a balanced diet with a variety of fruits, vegetables, whole grains, and lean proteins to support growth and development."
                    },
                    'Overweight': {
                        nutritionalDiagnosis: "Overweight related to excessive caloric intake and/or low physical activity, as evidenced by BMI-for-age Z-score greater than +1.",
                        dietaryAdvice: "Focus on nutrient-dense foods like vegetables, fruits, whole grains, and moderate portion sizes; encourage regular physical activity."
                    },
                    'Obesity': {
                        nutritionalDiagnosis: "Obesity related to high intake of energy-dense foods and/or low activity levels, as evidenced by BMI-for-age Z-score greater than +2.",
                        dietaryAdvice: "Limit sugary drinks and processed foods, emphasize fiber-rich vegetables, lean proteins, and regular physical activity."
                    }
                },
                wasting_5_to_19_boy: {
                    'Severe Thinness': {
                        nutritionalDiagnosis: "Severe thinness related to inadequate caloric intake as evidenced by BMI-for-age Z-score below -3 and visible signs of undernutrition.",
                        dietaryAdvice: "Encourage energy-dense foods like avocados, nuts, full-fat dairy, and regular meals/snacks to increase calorie intake."
                    },
                    'Moderate Thinness': {
                        nutritionalDiagnosis: "Moderate thinness related to insufficient caloric intake.",
                        dietaryAdvice: "Provide a balanced diet with moderate increases in calories and nutrient-rich foods."
                    },
                    'Normal Weight': {
                        nutritionalDiagnosis: "Healthy weight status maintained through appropriate dietary intake, as evidenced by BMI-for-age Z-score between -2 and +1.",
                        dietaryAdvice: "Encourage a balanced diet with a variety of fruits, vegetables, whole grains, and lean proteins to support growth and development."
                    },
                    'Overweight': {
                        nutritionalDiagnosis: "Overweight related to excessive caloric intake and/or low physical activity, as evidenced by BMI-for-age Z-score greater than +1.",
                        dietaryAdvice: "Focus on nutrient-dense foods like vegetables, fruits, whole grains, and moderate portion sizes; encourage regular physical activity."
                    },
                    'Obesity': {
                        nutritionalDiagnosis: "Obesity related to high intake of energy-dense foods and/or low activity levels, as evidenced by BMI-for-age Z-score greater than +2.",
                        dietaryAdvice: "Limit sugary drinks and processed foods, emphasize fiber-rich vegetables, lean proteins, and regular physical activity."
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


            function updateComments() {
                // Get selected options for NutritionistSelect (Wasting)
                const wastingSelectedOptions = $('.NutritionistSelectWasting').find(':selected');

                const wastingDiagnosis = wastingSelectedOptions.map(function() {
                    return $(this).attr('data-nutritional-diagnosis');
                }).get().join(' ');

                const wastingDietaryAdvice = wastingSelectedOptions.map(function() {
                    return $(this).attr('data-dietary-advice');
                }).get().join('\n');

                // Get selected options for NutritionistSelectStunting
                const stuntingSelectedOptions = $('.NutritionistSelectStunting').find(':selected');
                const stuntingDiagnosis = stuntingSelectedOptions.map(function() {
                    return $(this).attr('data-nutritional-diagnosis');
                }).get().join(' ');

                const stuntingDietaryAdvice = stuntingSelectedOptions.map(function() {
                    return $(this).attr('data-dietary-advice');
                }).get().join('\n');

                console.log("wastingDiagnosis ", wastingDiagnosis);
                console.log("stuntingDiagnosis ", stuntingDiagnosis);


                // Combine values for #NutritionistComment
                const nutritionalDiagnosis = [wastingDiagnosis, stuntingDiagnosis]
                    .filter(Boolean) // Remove empty values
                    .join(' '); // Separator can be customized


                console.log("wastingDietaryAdvice ", wastingDietaryAdvice);
                console.log("stuntingDietaryAdvice ", stuntingDietaryAdvice);


                // Combine values for #DietaryAdviceComment
                const combinedDietaryAdvice = [wastingDietaryAdvice, stuntingDietaryAdvice]
                    .filter(Boolean)
                    .join('\n'); // Separator can be customized

                // Update the respective textareas
                $('#NutritionistComment').val(nutritionalDiagnosis);
                $('#DietaryAdviceComment').val(combinedDietaryAdvice);
            }

            // Attach change events
            $('.NutritionistSelectWasting, .NutritionistSelectStunting').change(function() {
                updateComments();
            });


            /*
            $('.NutritionistSelectWasting').change(function() {

                const NutritionistSelectWastingDetails = $(this);
                console.log("NutritionistSelectWastingDetails "+ NutritionistSelectWastingDetails);

                var NutritionistSelectWastingID = NutritionistSelectWastingDetails.attr('id');
                console.log("NutritionistSelectWastingID "+ NutritionistSelectWastingID);

                // Get the selected option from both select elements
                const wastingSelectedOption = NutritionistSelectWastingDetails.find(':selected');
                const stuntingSelectedOption = $('.NutritionistSelectStunting').find(':selected');

                // Retrieve the data-nutritional-diagnosis from each selected option
                // const wastingDiagnosis = wastingSelectedOption.attr('data-nutritional-diagnosis') || "";
                // const stuntingDiagnosis = stuntingSelectedOption.attr('data-nutritional-diagnosis') || "";

                const wastingDiagnosis = NutritionistSelectWastingDetails.find(':selected')
                    .map(function() {
                        return $(this).attr('data-nutritional-diagnosis');
                    }).get().join(' ');

                const stuntingDiagnosis = $('.NutritionistSelectStunting').find(':selected')
                    .map(function() {
                        return $(this).attr('data-nutritional-diagnosis');
                    }).get().join(' ');


                console.log("wastingDiagnosis "+ wastingDiagnosis);
                console.log("stuntingDiagnosis "+ stuntingDiagnosis);

                // Merge the diagnoses with a separator (e.g., newline or period)
                const nutritionalDiagnosis = [wastingDiagnosis, stuntingDiagnosis]
                    .filter(Boolean) // Remove empty values
                    .join(' '); // Join with a space or preferred separator

                console.log("nutritionalDiagnosis "+ nutritionalDiagnosis);


                
                // Fill the merged value in the #NutritionistComment field
                $('#NutritionistComment').val(nutritionalDiagnosis);

             
                    

            
            });



            $('.NutritionistSelectStunting').change(function() {

                const NutritionistSelectStuntingDetails = $(this);
                console.log("NutritionistSelectStuntingDetails "+ NutritionistSelectStuntingDetails);

                var NutritionistSelectStuntingID = NutritionistSelectStuntingDetails.attr('id');
                console.log("NutritionistSelectStuntingID "+ NutritionistSelectStuntingID);


                // Get the selected option from NutritionistSelect (wasting)
                const wastingSelectedOption = $('NutritionistSelect').find(':selected');
                const wastingDietaryAdvice = wastingSelectedOption.attr('data-dietary-advice') || "";

                console.log("wastingDietaryAdvice "+ wastingDietaryAdvice);


                // Get the selected option from NutritionistSelectStunting
                const stuntingSelectedOption = $(this).find(':selected');
                const stuntingDietaryAdvice = stuntingSelectedOption.attr('data-dietary-advice') || "";

                console.log("stuntingDietaryAdvice "+ stuntingDietaryAdvice);

                // Concatenate the dietary advice from both select elements
                const combinedDietaryAdvice = [wastingDietaryAdvice, stuntingDietaryAdvice]
                    .filter(Boolean) // Remove empty values
                    .join('\n'); // Join with a newline or preferred separator

                // Assign the combined advice to the #DietaryAdviceComment textarea
                $('#DietaryAdviceComment').val(combinedDietaryAdvice);

            });
            */





            // Mapping object for select box options and their data-value attributes
            const dataOptionsAttributes = {
                observation1: {
                    1: "Child’s overall behavior is normal",
                    2: "Child is a bit restless",
                    3: "He is pretty much restless and active",
                    4: "He is very much overactive and restless."
                },
                observation2: {
                    1: "The child has no aggressive symptoms",
                    2: "The child has a very mild level of impulses",
                    3: "The child is pretty much impulsive",
                    4: "The child is very much impulsive"
                },
                observation3: {
                    1: "Overall good conduct in class",
                    2: "The child disturbs others a bit",
                    3: "He disturbs the class quite a lot",
                    4: "He disturbs the class significantly."
                },
                observation4: {
                    1: "The child attention span is appropriate",
                    2: "A little bit of Attention span issues",
                    3: "A lot of attention span issues",
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
                    2: "A bit of crying spells in the class",
                    3: "The child cries a lot in the class",
                    4: "The child cries extensively"
                },
                observation7: {
                    1: "No spelling errors",
                    2: "A bit of spelling mistakes",
                    3: "The child's spelling is very poor",
                    4: "Severe spelling issues"
                },
                observation8: {
                    1: "Properly writing dates",
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
                    3: "Child is unable to find differences in bus numbers",
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
                    "Variable, inconsistent": "Sleep patterns vary"
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


            // Trigger setDataValueForOptions when an element with class 'PsychologicalSelectedAttribute' is changed
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

                console.log("selectedValues.join(',')", selectedValues.join(','));


                $("[name='psychological_comment']").val(selectedValues.join(','));


            });



            $("#refer_to").select2({
                placeholder: "Refer To",
                allowClear: true
            });

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
        });


        $(document).ready(function() {
            $("#gender, #dob").on("keyup change", function() {

                $('#birth_5_wasting_girls, #birth_5_wasting_boys, #5_19_wasting_girls, #5_19_wasting_boys, #birth_2_stunting_girls, #birth_2_stunting_boys, #2_5_stunting_girls, #2_5_stunting_boys, #5_19_stunting_girls, #5_19_stunting_boys')
                    .addClass('d-none');
                var gender = $('#gender').val();
                var dob = $('#dob').val();

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
                $('#read_oly_age').val(age);
                $('#read_oly_gender').val(gender);


                console.log("gender ", gender);
                console.log("age ", age);

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

                if (gender == 'female' && age <= 5) {
                    $('#birth_5_wasting_girls').removeClass('d-none');
                } else if (gender == 'male' && age <= 5) {
                    $('#birth_5_wasting_boys').removeClass('d-none');
                } else if (gender == 'female' && age > 5 && age <= 19) {
                    $('#5_19_wasting_girls').removeClass('d-none');
                } else if (gender == 'male' && age > 5 && age <= 19) {
                    $('#5_19_wasting_boys').removeClass('d-none');

                } else {}

                /* stunting */
                if (gender == 'female' && age <= 2) {
                    $('#birth_2_stunting_girls').removeClass('d-none');
                } else if (gender == 'male' && age <= 2) {
                    $('#birth_2_stunting_boys').removeClass('d-none');
                } else if (gender == 'female' && age > 2 && age <= 5) {
                    $('#2_5_stunting_girls').removeClass('d-none');
                } else if (gender == 'male' && age > 2 && age <= 5) {
                    $('#2_5_stunting_boys').removeClass('d-none');
                } else if (gender == 'female' && age > 5 && age <= 19) {
                    $('#5_19_stunting_girls').removeClass('d-none');
                } else if (gender == 'male' && age > 5 && age <= 19) {
                    $('#5_19_stunting_boys').removeClass('d-none');
                }





            });
            $("#Question_No_8_Normal_Posture_Gait").on("keyup change", function() {
                var pocture = $(this).val();
                if (pocture == 'No') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_9_Mental_Status").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Lethargic') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_10_Look_For_jaundice").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_11_Look_For_anemia").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_12_Look_For_Clubbing").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_13_Look_for_Cyanosis").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_14_Skin").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Rash' || Formvalue == 'Allergy' || Formvalue == 'Lesion' || Formvalue ==
                    'Bruises') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_15_Breath").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Bad Breath') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_16_Nails").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Dirty') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_17_Uniform_or_shoes").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Untidy') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_18_Lice_nits").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_19_Discuss_hygiene_routines_and_practices").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'not-aware') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_20_Hair_and_Scalp").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Color-faded') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_21_Any_Hair_Problem").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Kinky' || Formvalue == 'Brittle' || Formvalue == 'Dry') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_22_Sclap").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Scaly' || Formvalue == 'Dry' || Formvalue == 'Moist') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_23_Hair_distribution").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Patchy' || Formvalue == 'Receding' || Formvalue == 'Receding_Hair_Line') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_25_Normal_ocular_alignment").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_26_Normal_eye_inspection").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_27_Normal_Color_vision").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_28_Nystagmus").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_29_Normal_ears_shape_and_position").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_30_Ear_examination").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Ear wax' || Formvalue == 'Canal infection') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'right_ear_conductive_hearing_loss' || Formvalue ==
                    'left_ear_conductive_hearing_loss' || Formvalue ==
                    'right_ear_sensorineural_hearing_loss' || Formvalue ==
                    'left_ear_sensorineural_hearing_loss') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_32_External_inasal_examinaton").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue != 'Normal' && Formvalue != 'normal') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient_s_ability_to_breathe_through_each_nostril")
                .on("keyup change", function() {
                    var Formvalue = $(this).val();
                    if (Formvalue != 'Normal' && Formvalue != 'normal') {
                        this.style.setProperty('background-color', 'red', 'important');
                    } else {
                        this.style.setProperty('background-color', 'white', 'important');
                    }

                });
            $("#Question_No_34_Assess_gingiva").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue != 'Normal' && Formvalue != 'normal') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_35_Are_there_dental_caries").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_36_Examine_tonsils").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Tonsillitis') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_37_Normal_Speech_development").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No' || Formvalue == 'no') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#any_neck_swelling").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#lymph_node").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'abnormal') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_40_Any_visible_chest_deformity").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_41_Lung_Auscultation").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue != 'Ronchi' && Formvalue != 'Vesicular_Breathing') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#Question_No_42_Cardiac_Auscultation").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Murmur') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#distention_scar_mass").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue != 'Normal' && Formvalue != 'normal') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#any_history_of_abdominal_pain").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#limitations_range_motion").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#spinal_curvature_assessment").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue != 'Normal' && Formvalue != 'normal') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#curvature_spine_resembling").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue != 'Normal' && Formvalue != 'normal') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#adams_forward_bend_test").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Positive' || Formvalue == 'positive') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#foot_or_toe_abnormalities").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue != 'Normal' && Formvalue != 'normal') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#immunization_card").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'No') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#do_you_have_any_Allergies").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#discomfort_during_urination").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue != 'No urinary issues reported') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#any_menstrual_abnormality").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == 'Yes' || Formvalue == 'yes') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation1").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation2").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation3").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation4").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation5").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation6").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation7").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation8").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation9").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $("#observation10").on("keyup change", function() {
                var Formvalue = $(this).val();
                if (Formvalue == '3' || Formvalue == '4') {
                    this.style.setProperty('background-color', 'red', 'important');
                } else {
                    this.style.setProperty('background-color', 'white', 'important');
                }

            });
            $(".observation").hide();

            $("#class").on("keyup change", function() {
                var value = parseFloat($(this).val());

                // if (value >= 1 && value <= 5) 
                if (value <= 2)

                {
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

            });

            $('#Follow_up_Required').on('change', function() {
                var selectedValue = $(this).val();
                console.log("selectedValue " + selectedValue);
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
            });


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


            /* food_allergies */
            $('#food_allergies').change(function() {


                var selectedValue = $(this).val();
                console.log("selectedValue " + selectedValue);

                var other_food_allergies = document.getElementById("other_food_allergies");

                if (selectedValue === 'Yes') {


                    other_food_allergies.style.setProperty('background-color', 'red', 'important');
                    other_food_allergies.style.setProperty('color', 'white', 'important');

                } else {

                    other_food_allergies.style.removeProperty('background-color');
                    other_food_allergies.style.removeProperty('color');

                }
            });


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
            });



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
                });



            /* Function to capitalize the first letter of a string */
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            /* Question_No_60_How_would_you_describe_your_lifestyle */
            $('#Question_No_60_How_would_you_describe_your_lifestyle').change(
                function() {


                    var age = $("#age").val();
                    var gender = $("#gender").val();

                    // Capitalize the first letter
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
                            return $(this).attr('age') === age &&
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
                            return $(this).attr('age') === age &&
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
                            return $(this).attr('age') === age &&
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
                });










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
            });


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
            });



            /* food_items*/
            $('#food_items').change(function() {
                var selectedValue = $(this).val();
                // console.log("meals " + selectedValue);

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
            });




            /* fast_food*/
            $('#fast_food').change(function() {
                var selectedValue = $(this).val();
                // console.log("meals " + selectedValue);

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
            });


            $('#fast_food').change();




            var currentDate = new Date().toISOString().split('T')[0];
            $('#dob').attr('max', currentDate);

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

            /*
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

                                console.log("INVALID attr " + $(this).attr('id'));

                                fieldErrors.push($(this).attr('id'))
                                isValid = false;
                                return false; // Exit the loop if a required field is empty
                            }
                        });


                    if (isValid && !isLastStep) {
                        currentStep.removeClass('active');
                        nextStep.addClass('active');
                    } else {
                        for (fieldError of fieldErrors) {

                            console.log("fieldErrors " + fieldErrors);

                            $('#' + fieldError)
                                .addClass('error-border')
                                .closest('.form-group')
                                .append('<small class="text-danger error-text">This field is required</small>');
                        }
                    }
                    return isValid;
                }

            function validate(e, isLastStep = false) {
                $('.error-text').remove();
                let closestDiv = isLastStep ? '.last-step' : '.step';
                var currentStep = $(e.target).closest(closestDiv);
                var nextStep = currentStep.next('.step');
                var checkboxes = $('.form-group input[type="checkbox"]');
                var isValid = true;

                var fieldErrors = [];
                var firstInvalidField = null; // Variable to hold the first invalid field

                // Check if all required fields in the current step are filled
                currentStep.find('input[required], select[required], input[type="checkbox"]:checked').each(
                function() {

                    var value = $.trim($(this).val()); // Trim whitespace from the value

                    if (value === '' || value === null) 

                    // if ($(this).val() == '' || $(this).val() == null)
                    {
                        console.log("INVALID attr " + $(this).attr('id'));

                        fieldErrors.push($(this).attr('id'));
                        isValid = false;
                        if (firstInvalidField === null) {
                            firstInvalidField = $(this); // Set the first invalid field
                        }
                        return false; // Exit the loop if a required field is empty
                    }
                });

                if (isValid && !isLastStep) {
                    currentStep.removeClass('active');
                    nextStep.addClass('active');
                } else {
                    for (fieldError of fieldErrors) {
                        console.log("fieldErrors " + fieldErrors);

                        $('#' + fieldError)
                            .addClass('error-border')
                            .closest('.form-group')
                            .append('<small class="text-danger error-text">This field is required</small>');
                    }

                    // Move focus to the first invalid field
                    if (firstInvalidField) {
                        $('html, body').animate({
                            scrollTop: firstInvalidField.offset().top - 100 // Adjust the offset as needed
                        }, 500, function() {
                            firstInvalidField.focus(); // Focus on the field
                        });
                    }
                }

                return isValid;
            }

            */


            function validate(e, isLastStep = false) {
                $('.error-text').remove();
                let closestDiv = isLastStep ? '.last-step' : '.step';
                var currentStep = $(e.target).closest(closestDiv);
                var nextStep = currentStep.next('.step');
                var checkboxes = $('.form-group input[type="checkbox"]');
                var isValid = true;

                var fieldErrors = [];
                var firstInvalidField = null; // Variable to hold the first invalid field

                // Check if all required fields in the current step are filled
                currentStep.find('input[required], select[required], input[type="checkbox"]:checked').each(
                    function() {
                        var value = $.trim($(this).val()); // Trim whitespace from the value

                        if (value === '' || value === null) {
                            console.log("INVALID attr " + $(this).attr('id'));

                            fieldErrors.push($(this).attr('id'));
                            isValid = false;
                            if (firstInvalidField === null) {
                                firstInvalidField = $(this); // Set the first invalid field
                            }
                            return false; // Exit the loop if a required field is empty
                        }
                    });

                // Check for GR Number existence
                if (isValid) {

                    //   var base_url = '{!! Route('HeightForAge') !!}';

                    var grNumber = $('#Gr_Number').val();
                    var name = $('#name').val();
                    var school = $('#school').val();
                    if (grNumber) {
                        $.ajax({


                            url: "{{ route('admin.form_entry.checkGrNumber') }}",

                            method: 'POST',
                            data: {
                                // _token: $('meta[name="csrf-token"]').attr(
                                // 'content'), // CSRF token for security
                                "_token": "{{ csrf_token() }}",
                                school: school,
                                gr_number: grNumber,
                                name: name
                            },
                            success: function(response) {
                                if (response.exists) {
                                    // Show error if GR Number exists
                                    $('#Gr_Number')
                                        .addClass('error-border')
                                        .closest('.form-group')
                                        .append(
                                            '<small class="text-danger error-text">This GR Number already exists.</small>'
                                        );
                                    isValid = false;
                                    // Move focus to the GR Number field
                                    $('html, body').animate({
                                        scrollTop: $('#Gr_Number').offset().top -
                                            100 // Adjust the offset as needed
                                    }, 500, function() {
                                        $('#Gr_Number').focus(); // Focus on the field
                                    });
                                } else {
                                    // Proceed to next step if no errors
                                    if (isValid && !isLastStep) {
                                        currentStep.removeClass('active');
                                        nextStep.addClass('active');
                                    }
                                }
                            },
                            error: function() {
                                // Handle server errors if needed
                                alert('An error occurred while checking the GR Number.');
                            }
                        });
                    } else {
                        // Proceed to next step if GR Number is empty
                        if (isValid && !isLastStep) {
                            currentStep.removeClass('active');
                            nextStep.addClass('active');
                        }
                    }
                } else {
                    for (fieldError of fieldErrors) {
                        console.log("fieldErrors " + fieldErrors);

                        $('#' + fieldError)
                            .addClass('error-border')
                            .closest('.form-group')
                            .append('<small class="text-danger error-text">This field is required</small>');
                    }

                    // Move focus to the first invalid field
                    if (firstInvalidField) {
                        $('html, body').animate({
                            scrollTop: firstInvalidField.offset().top - 100 // Adjust the offset as needed
                        }, 500, function() {
                            firstInvalidField.focus(); // Focus on the field
                        });
                    }
                }

                return isValid;
            }



            $('.nextStep').click(validate)
            // });

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
                        $("#bmishow").val("High")
                        $("#bmiresult").val('High')
                        $("#bmi61").addClass("bg-danger");

                    } else {
                        $("#bmi").removeClass("bg-danger");
                        $("#bmishow").val("Noraml")
                        $("#bmiresult").val('Noraml')
                        $("#bmi61").removeClass("bg-danger");

                    }
                }
            });


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
            });


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



            /* weight*/
            $("#weight").on("keyup change", function(e) {

                $("#dob").change();

                var weight = parseFloat($("#weight").val());
                $('#read_oly_weight').val(weight);
                var dailyEnergyRequirement = parseFloat($("#Daily_Protien_requirement").val());
                console.log("weight " + weight);
                console.log("dailyEnergyRequirement " + dailyEnergyRequirement);

                if (weight > 0) {

                    var dailyProteinRequirement = dailyEnergyRequirement * weight;

                    // Format to at least 3 decimal places
                    var formattedDailyProteinRequirement = dailyProteinRequirement.toFixed(3);


                    /*console.log("dailyProteinRequirement " + formattedDailyProteinRequirement);*/

                    $("#Daily_Protien_requirement").val(formattedDailyProteinRequirement).attr('readonly',
                        true);
                }

            });


            $("#dob").on("change", function() {

                var dob = $(this).val();

                if (dob) {

                    var today = new Date();
                    var birthDate = new Date(dob);
                    var age = today.getFullYear() - birthDate.getFullYear();
                    var monthDiff = today.getMonth() - birthDate.getMonth();
                    var gender = $("#gender").val();

                    var totalMonths = (age * 12) + monthDiff;

                    if (today.getDate() < birthDate.getDate()) {
                        totalMonths--;
                    }

                    $("#age").val(age);

                    if (totalMonths >= 7 && totalMonths <= 12) {
                        $("#Daily_Protien_requirement").val("1.0").attr('readonly', true);
                    } else if (age >= 1 && age <= 3) {
                        $("#Daily_Protien_requirement").val("0.87").attr('readonly', true);
                    } else if (age >= 4 && age <= 8) {
                        $("#Daily_Protien_requirement").val("0.76").attr('readonly', true);
                    } else if (age >= 9 && age <= 13) {
                        $("#Daily_Protien_requirement").val("0.76").attr('readonly', true);
                    } else if (age >= 14 && age <= 18 && $("#gender").val() == "male") {
                        $("#Daily_Protien_requirement").val("0.73").attr('readonly', true);
                    } else if (age >= 14 && age <= 18 && $("#gender").val() == "female") {
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
                if (parseFloat(age) < 5) {


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









            });


            $('#submit').on('click', function(e) {

                if (!validate(e, true)) return;
                //    console.log(validate());


                var submitBtn = $(this);

                // Change the button text to "Processing..."
                $(this).text('Processing...').attr('disabled', false);

                var form = $('#multiStepForm');

                /*var formData = form.serializeArray();
                console.log("formData ", formData);*/

                var secondsOnSubmit;


                var endTime = new Date();
                var timeDiff = endTime - startTime;
                secondsOnSubmit = Math.round(timeDiff / 1000);

                var formData = $('#multiStepForm').serializeArray();
                console.log("formData " + formData);



                /*$.each(formData, function(index, field) {

                    var fieldId = field['name'].trim();
                    var fieldValue = field['value'].trim();

                    console.log("fieldId ", fieldId);
                    console.log("fieldValue ", fieldValue);

                });*/

                let _token = $('meta[name="csrf-token"]').attr('content');
                formData.push({
                    name: 'duration',
                    value: secondsOnSubmit
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('post_data') }}",
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

                        if (response.status) {

                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then(() => {
                                // Optionally redirect or perform other actions here
                                // window.location.href = "{{ route('admin.form.index') }}";


                                var userRole = "{!! auth()->guard('admin')->user()->role !!}";
                                if (userRole == 1) {

                                    window.location.href =
                                        "{{ route('admin.form_entry.getformData1') }}";

                                } else if (userRole == 2) {

                                    window.location.href =
                                        "{{ route('user_form_data') }}";

                                } else {
                                    window.location.href =
                                        "{{ route('admin.form_entry.getformData1') }}";

                                }

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

                            submitBtn.text('Submit').attr('disabled', false);

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

        // Auto-color Body Temperature: green for 96–99.1°F, red otherwise
        function setTempColorAdmin() {
            var $temp = $('#Question_No_4_Body_Temperature');
            if ($temp.length === 0) return;
            var raw = $temp.val();
            var val = parseFloat(raw);
            var unit = ($('#bodytempunit').val() || 'f').toLowerCase();
            if (unit === 'c' && !isNaN(val)) { val = (val * 9/5) + 32; }
            if (raw === '') { $temp.removeClass('bg-success bg-danger'); return; }
            if (!isNaN(val) && val >= 96 && val <= 99.1) {
                $temp.removeClass('bg-danger').addClass('bg-success');
            } else {
                $temp.removeClass('bg-success').addClass('bg-danger');
            }
        }
        $(function() {
            setTempColorAdmin();
            $('#Question_No_4_Body_Temperature').on('input change blur', setTempColorAdmin);
        });
    </script>

@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
