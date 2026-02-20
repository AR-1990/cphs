@extends('admin.main')

@section('content')

    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
        }

        .is-invalid {
            border-color: red;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="container">
        <h1 class="mb-4 mt-5">Child Health Checkup Survey</h1>

        <form action="{{ Route('screeningForm') }}" method="post" id="screeningForm">

            @csrf


            @if (Session::has('error_message'))
                <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
                    <strong>Error ! </strong>
                    {{ Session::get('error_message') }}.


                </div>
            @endif

            @if (Session::has('success_message'))
                <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                    <strong>Success ! </strong>
                    {{ Session::get('success_message') }}.


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


            <!-- Step-one -->



            <div class="step active mb-5" id="step1">
                <h3>Bio Data</h3>
                <div class="form-row">
                    <!-- Check if updateID exists -->
                    <input type="text" name="updateID" value="{{ $_GET['updateID'] ?? ($updateID ?? '') }}" readonly>

                    <div class="form-group col-md-6">
                        <label for="screeningFormId">Screening Form ID</label>
                        <input type="text" class="form-control" id="screeningFormId" name="screeningFormId"
                            value="{{ $_GET['screeningFormId'] ?? ($bio_data->screeningFormId ?? 0) }}" readonly required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $_GET['name'] ?? ($bio_data->name ?? old('name')) }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="guardianname">Guardian Name</label>
                        <input type="text" class="form-control" id="guardianname" name="guardianname"
                            value="{{ $_GET['guardianname'] ?? ($bio_data->guardian_name ?? old('guardianname')) }}"
                            required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select</option>
                            <option value="male"
                                {{ ($_GET['gender'] ?? ($bio_data->gender ?? old('gender'))) == 'male' ? 'selected' : '' }}>
                                Male</option>
                            <option value="female"
                                {{ ($_GET['gender'] ?? ($bio_data->gender ?? old('gender'))) == 'female' ? 'selected' : '' }}>
                                Female</option>
                            <option value="other"
                                {{ ($_GET['gender'] ?? ($bio_data->gender ?? old('gender'))) == 'other' ? 'selected' : '' }}>
                                Other</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="class">Class</label>
                        @php
                            $classLabels = [
                                '0' => 'Play group',
                                '00' => 'KG-1',
                                '000' => 'KG-2',
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                '7' => '7',
                                '8' => '8',
                                '9' => '9',
                                '10' => '10',
                                '11' => '11',
                                '12' => '12',
                            ];
                            $selectedClass = $_GET['class'] ?? ($bio_data->class ?? old('class'));
                        @endphp
                        <select class="form-control" id="class" name="class" required>
                            <option value="">Select</option>
                            @foreach ($classLabels as $key => $label)
                                <option value="{{ $key }}" {{ $selectedClass == $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="school">School</label>
                        <select class="form-control" id="school" name="school" required>
                            <option value="">Select</option>
                            @if (!empty($School))
                                @foreach ($School as $item)
                                    <option value="{{ $item->id }}"
                                        {{ ($_GET['school'] ?? ($bio_data->school_id ?? '')) == $item->id ? 'selected' : '' }}>
                                        {{ $item->school_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <select class="form-control" id="city" name="city" required>
                            <option value="">Select</option>
                            @if (!empty($City))
                                @foreach ($City as $item)
                                    <option value="{{ $item->id }}"
                                        {{ ($_GET['city'] ?? ($bio_data->city_id ?? '')) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="area">Area</label>
                        <select class="form-control" id="area" name="area" required>
                            <option value="">Select</option>
                            @if (!empty($Area))
                                @foreach ($Area as $item)
                                    <option value="{{ $item->id }}"
                                        {{ ($_GET['area'] ?? ($bio_data->area_id ?? '')) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="dob">Date Of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob"
                            value="{{ $_GET['dob'] ?? ($bio_data->dob ?? old('dob')) }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age"
                            value="{{ $_GET['age'] ?? ($bio_data->age ?? old('age')) }}" readonly required>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Emergency_Contact_Number">Emergency Contact Number</label>
                            <input type="text" class="form-control" id="Emergency_Contact_Number"
                                name="Emergency_Contact_Number"
                                value="{{ $_GET['emergency_contact_number'] ?? ($bio_data->emergency_contact_number ?? old('Emergency_Contact_Number')) }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Gr_Number">GR Number (only numeric value)</label>
                            <input type="number" class="form-control" id="Gr_Number" name="Gr_Number"
                                value="{{ $_GET['grno'] ?? ($bio_data->gr_number ?? old('Gr_Number')) }}" required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Any_Known_Medical_Condition">Any Known Medical Condition</label>
                            <input type="text" class="form-control" id="Any_Known_Medical_Condition"
                                name="Any_Known_Medical_Condition"
                                value="{{ $_GET['any_known_medical_condition'] ?? ($bio_data->medical_condition ?? old('Any_Known_Medical_Condition')) }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="Address"
                            value="{{ $_GET['address'] ?? ($bio_data->address ?? old('Address')) }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="blood_group">Blood Group</label>
                        <select class="form-control" id="blood_group" name="Blood_group" required>
                            <option value="">Select</option>
                            @php
                                $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-', 'Unknown'];
                                $selectedBloodGroup =
                                    $_GET['blood_group'] ?? ($bio_data->blood_group ?? old('Blood_group'));
                            @endphp
                            @foreach ($bloodGroups as $group)
                                <option value="{{ $group }}"
                                    {{ $selectedBloodGroup == $group ? 'selected' : '' }}>
                                    {{ $group }}
                                </option>
                            @endforeach
                        </select>
                    </div>







                    <div class="form-group col-md-12">
                        <label for="bio_data_comment">Comment/Findings</label>
                        <textarea name="bio_data_comment" class="form-control" id="bio_data_comment" required>{{ $_GET['bio_data_comment'] ?? ($bio_data->bio_data_comment ?? old('bio_data_comment')) }}</textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Second Step -->


            <!-- Second Step -->
            <div class="step" id="step2">
                <h3>Vitals/BMI</h3>
                <div class="form-row">
                    <!-- Height -->
                    <div class="form-group col-md-6">
                        <label for="height" class="width-100">Height (cm)</label>
                        <input type="number" class="form-control" id="height" name="Question_No_1_Height"
                            placeholder="Height in cm (e.g., 170)"
                            value="{{ $vitals_bms->Question_No_1_Height ?? old('Question_No_1_Height') }}" required>
                    </div>

                    <!-- Weight -->
                    <div class="form-group col-md-6">
                        <label for="weight" class="width-100">Weight (kg)</label>
                        <input type="number" class="form-control" id="weight" name="Question_No_2_Weight"
                            placeholder="Weight in kg (e.g., 65)"
                            value="{{ $vitals_bms->Question_No_2_Weight ?? old('Question_No_2_Weight') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- BMI -->
                    <div class="form-group col-md-6">
                        <label for="bmi">BMI (Red field means abnormality)</label>
                        <span id="bmishow"></span>
                        <input type="number" class="form-control" id="bmi" name="Question_No_3_BMI"
                            placeholder="Auto calculate"
                            value="{{ $vitals_bms->Question_No_3_BMI ?? old('Question_No_3_BMI') }}" readonly required>
                        <input type="text" class="form-control" id="bmiresult" name="bmiresult"
                            value="{{ $vitals_bms->bmiresult ?? old('bmiresult') }}" readonly>
                    </div>

                    <!-- Body Temperature -->
                    <div class="form-group col-md-6">
                        <label for="temp">Body Temperature (°F)</label>
                        <input type="number" class="form-control" id="Question_No_4_Body_Temperature"
                            name="Question_No_4_Body_Temperature"
                            value="{{ $vitals_bms->Question_No_4_Body_Temperature ?? old('Question_No_4_Body_Temperature') }}"
                            required>
                        <input type="text" id="bodytempunit" name="Bodytempunit" value="f" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Blood Pressure (Systolic) -->
                    <div class="form-group col-md-6">
                        <label for="blood">Blood Pressure (Systolic)</label>
                        <span id="Blood_Pressure_Systolic"></span>
                        <input type="number" class="form-control" id="Question_No_5_Blood_Pressure_Systolic"
                            name="Question_No_5_Blood_Pressure_Systolic"
                            value="{{ $vitals_bms->Question_No_5_Blood_Pressure_Systolic ?? old('Question_No_5_Blood_Pressure_Systolic') }}"
                            required>
                        <input type="text" class="form-control" id="systolicresult" name="systolicresult"
                            value="{{ $vitals_bms->systolicresult ?? old('systolicresult') }}" readonly>
                    </div>

                    <!-- Blood Pressure (Diastolic) -->
                    <div class="form-group col-md-6">
                        <label for="blood">Blood Pressure (Diastolic)</label>
                        <span id="Blood_Pressure_Diastolic"></span>
                        <input type="number" class="form-control" id="Question_No_6_Blood_Pressure_Diastolic"
                            name="Question_No_6_Blood_Pressure_Diastolic"
                            value="{{ $vitals_bms->Question_No_6_Blood_Pressure_Diastolic ?? old('Question_No_6_Blood_Pressure_Diastolic') }}"
                            required>
                        <input type="text" class="form-control" id="diastolicresult" name="diastolicresult"
                            value="{{ $vitals_bms->diastolicresult ?? old('diastolicresult') }}" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Pulse -->
                    <div class="form-group col-md-6">
                        <label for="pulse">Pulse (Red field means abnormality)</label>
                        <input type="text" class="form-control" id="Question_No_7_Pulse" name="Question_No_7_Pulse"
                            value="{{ $vitals_bms->Question_No_7_Pulse ?? old('Question_No_7_Pulse') }}" required>
                    </div>

                    <!-- Comments/Findings -->
                    <div class="form-group col-md-6">
                        <label for="comment">Comments/Findings</label>
                        <textarea name="vitals_bmi_comment" placeholder="Comment here" cols="50" required>{{ $vitals_bms->vitals_bmi_comment ?? old('vitals_bmi_comment') }}</textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>



            <!-- Third Step -->

            <div class="step" id="step3">
                <h3>General Appearance</h3>
                <div class="form-row">
                    <!-- Normal Posture/Gait -->
                    <div class="form-group col-md-6">
                        <label for="field2">Question No.8: Normal Posture/Gait</label><br>
                        <select class="form-control" id="Question_No_8_Normal_Posture_Gait"
                            name="Question_No_8_Normal_Posture_Gait" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ isset($general_appearance->Question_No_8_Normal_Posture_Gait) && $general_appearance->Question_No_8_Normal_Posture_Gait == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ isset($general_appearance->Question_No_8_Normal_Posture_Gait) && $general_appearance->Question_No_8_Normal_Posture_Gait == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Mental Status -->
                    <div class="form-group col-md-6">
                        <label for="Mentalstatus">Question No.9: Mental Status</label><br>
                        <select class="form-control" id="Question_No_9_Mental_Status" name="Question_No_9_Mental_Status"
                            required>
                            <option value="">Select</option>
                            <option value="Alert"
                                {{ isset($general_appearance->Question_No_9_Mental_Status) && $general_appearance->Question_No_9_Mental_Status == 'Alert' ? 'selected' : '' }}>
                                Alert</option>
                            <option value="Lethargic"
                                {{ isset($general_appearance->Question_No_9_Mental_Status) && $general_appearance->Question_No_9_Mental_Status == 'Lethargic' ? 'selected' : '' }}>
                                Lethargic</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Look for Jaundice -->
                    <div class="form-group col-md-6">
                        <label for="jaundice">Question No.10: Look For jaundice</label><br>
                        <select class="form-control" id="Question_No_10_Look_For_jaundice"
                            name="Question_No_10_Look_For_jaundice" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ isset($general_appearance->Question_No_10_Look_For_jaundice) && $general_appearance->Question_No_10_Look_For_jaundice == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ isset($general_appearance->Question_No_10_Look_For_jaundice) && $general_appearance->Question_No_10_Look_For_jaundice == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Look for Anemia -->
                    <div class="form-group col-md-6">
                        <label for="anemia">Question No.11: Look For anemia</label><br>
                        <select class="form-control" id="Question_No_11_Look_For_anemia"
                            name="Question_No_11_Look_For_anemia" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ isset($general_appearance->Question_No_11_Look_For_anemia) && $general_appearance->Question_No_11_Look_For_anemia == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ isset($general_appearance->Question_No_11_Look_For_anemia) && $general_appearance->Question_No_11_Look_For_anemia == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Look for Clubbing -->
                    <div class="form-group col-md-6">
                        <label for="clubbing">Question No.12: Look For Clubbing</label><br>
                        <select class="form-control" id="Question_No_12_Look_For_Clubbing"
                            name="Question_No_12_Look_For_Clubbing" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ isset($general_appearance->Question_No_12_Look_For_Clubbing) && $general_appearance->Question_No_12_Look_For_Clubbing == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ isset($general_appearance->Question_No_12_Look_For_Clubbing) && $general_appearance->Question_No_12_Look_For_Clubbing == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Look for Cyanosis -->
                    <div class="form-group col-md-6">
                        <label for="cyanosis">Question No.13: Look for Cyanosis</label><br>
                        <select class="form-control" id="Question_No_13_Look_for_Cyanosis"
                            name="Question_No_13_Look_for_Cyanosis" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ isset($general_appearance->Question_No_13_Look_for_Cyanosis) && $general_appearance->Question_No_13_Look_for_Cyanosis == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ isset($general_appearance->Question_No_13_Look_for_Cyanosis) && $general_appearance->Question_No_13_Look_for_Cyanosis == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Skin -->
                    <div class="form-group col-md-6">
                        <label for="skin">Question No.14: Skin</label><br>
                        <select class="form-control" id="Question_No_14_Skin" name="Question_No_14_Skin" required>
                            <option value="">Select</option>
                            <option value="Rash"
                                {{ isset($general_appearance->Question_No_14_Skin) && $general_appearance->Question_No_14_Skin == 'Rash' ? 'selected' : '' }}>
                                Rash</option>
                            <option value="Allergy"
                                {{ isset($general_appearance->Question_No_14_Skin) && $general_appearance->Question_No_14_Skin == 'Allergy' ? 'selected' : '' }}>
                                Allergy</option>
                            <option value="Lesion"
                                {{ isset($general_appearance->Question_No_14_Skin) && $general_appearance->Question_No_14_Skin == 'Lesion' ? 'selected' : '' }}>
                                Lesion</option>
                            <option value="Bruises"
                                {{ isset($general_appearance->Question_No_14_Skin) && $general_appearance->Question_No_14_Skin == 'Bruises' ? 'selected' : '' }}>
                                Bruises</option>
                            <option value="Normal"
                                {{ isset($general_appearance->Question_No_14_Skin) && $general_appearance->Question_No_14_Skin == 'Normal' ? 'selected' : '' }}>
                                Normal</option>
                        </select>
                    </div>

                    <!-- Breath -->
                    <div class="form-group col-md-6">
                        <label for="breath">Question No.15: Breath</label><br>
                        <select class="form-control" id="Question_No_15_Breath" name="Question_No_15_Breath" required>
                            <option value="">Select</option>
                            <option value="Bad Breath"
                                {{ isset($general_appearance->Question_No_15_Breath) && $general_appearance->Question_No_15_Breath == 'Bad Breath' ? 'selected' : '' }}>
                                Bad Breath</option>
                            <option value="Normal"
                                {{ isset($general_appearance->Question_No_15_Breath) && $general_appearance->Question_No_15_Breath == 'Normal' ? 'selected' : '' }}>
                                Normal</option>
                        </select>
                    </div>
                </div>

                <!-- Comments/Findings -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="comment">Comment/Findings</label><br>
                        <textarea name="general_apperance_comment" placeholder="Comment here" cols="50" required>{{ $general_appearance->general_apperance_comment ?? old('general_apperance_comment') }}</textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>




            <!-- Fourth Step -->

            <div class="step" id="step4">
                <h3>Inspect Hygiene </h3>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Nails">Question No.16: Nails</label><br>
                        <select class="form-control" id="Question_No_16_Nails" name="Question_No_16_Nails" required>
                            <option value="">Select</option>
                            <option value="Clean"
                                {{ old('Question_No_16_Nails', $existingInspectHygiene->Question_No_16_Nails ?? '') == 'Clean' ? 'selected' : '' }}>
                                Clean</option>
                            <option value="Dirty"
                                {{ old('Question_No_16_Nails', $existingInspectHygiene->Question_No_16_Nails ?? '') == 'Dirty' ? 'selected' : '' }}>
                                Dirty</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Uniform or shoes">Question No.17: Uniform or shoes</label><br>
                        <select class="form-control" id="Question_No_17_Uniform_or_shoes"
                            name="Question_No_17_Uniform_or_shoes" required>
                            <option value="">Select</option>
                            <option value="Tidy"
                                {{ old('Question_No_17_Uniform_or_shoes', $existingInspectHygiene->Question_No_17_Uniform_or_shoes ?? '') == 'Tidy' ? 'selected' : '' }}>
                                Tidy</option>
                            <option value="Untidy"
                                {{ old('Question_No_17_Uniform_or_shoes', $existingInspectHygiene->Question_No_17_Uniform_or_shoes ?? '') == 'Untidy' ? 'selected' : '' }}>
                                Untidy</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Lice/nits">Question No.18: Lice/nits</label><br>
                        <select class="form-control" id="Question_No_18_Lice_nits" name="Question_No_18_Lice_nits"
                            required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ old('Question_No_18_Lice_nits', $existingInspectHygiene->Question_No_18_Lice_nits ?? '') == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ old('Question_No_18_Lice_nits', $existingInspectHygiene->Question_No_18_Lice_nits ?? '') == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Question_No_19_Discuss_hygiene_routines_and_practices">Question No.19: Discuss hygiene
                            routines and practices.</label><br>
                        <select class="form-control" id="Question_No_19_Discuss_hygiene_routines_and_practices"
                            name="Question_No_19_Discuss_hygiene_routines_and_practices" required>
                            <option value="">Select</option>
                            <option value="well-aware"
                                {{ old('Question_No_19_Discuss_hygiene_routines_and_practices', $existingInspectHygiene->Question_No_19_Discuss_hygiene_routines_and_practices ?? '') == 'well-aware' ? 'selected' : '' }}>
                                well-aware</option>
                            <option value="not-aware"
                                {{ old('Question_No_19_Discuss_hygiene_routines_and_practices', $existingInspectHygiene->Question_No_19_Discuss_hygiene_routines_and_practices ?? '') == 'not-aware' ? 'selected' : '' }}>
                                not aware</option>
                            <option value="has-been-counseled"
                                {{ old('Question_No_19_Discuss_hygiene_routines_and_practices', $existingInspectHygiene->Question_No_19_Discuss_hygiene_routines_and_practices ?? '') == 'has-been-counseled' ? 'selected' : '' }}>
                                has been counseled</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="inspect_hygiene_comment">Comment/Findings</label><br>
                        <textarea name="inspect_hygiene_comment" placeholder="Comment here" cols="50" required>{{ old('inspect_hygiene_comment', $existingInspectHygiene->inspect_hygiene_comment ?? '') }}</textarea>
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
                        <label for="Question_No_20_Hair_and_Scalp">Question No:20 Hair and Scalp</label>
                        <select class="form-control" id="Question_No_20_Hair_and_Scalp"
                            name="Question_No_20_Hair_and_Scalp" required>
                            <option value="">Select</option>
                            <option value="Straight"
                                {{ old('Question_No_20_Hair_and_Scalp', $headAndNeckData->Question_No_20_Hair_and_Scalp ?? '') == 'Straight' ? 'selected' : '' }}>
                                Straight</option>
                            <option value="Wavy"
                                {{ old('Question_No_20_Hair_and_Scalp', $headAndNeckData->Question_No_20_Hair_and_Scalp ?? '') == 'Wavy' ? 'selected' : '' }}>
                                Wavy</option>
                            <option value="Curly"
                                {{ old('Question_No_20_Hair_and_Scalp', $headAndNeckData->Question_No_20_Hair_and_Scalp ?? '') == 'Curly' ? 'selected' : '' }}>
                                Curly</option>
                            <option value="Color-faded"
                                {{ old('Question_No_20_Hair_and_Scalp', $headAndNeckData->Question_No_20_Hair_and_Scalp ?? '') == 'Color-faded' ? 'selected' : '' }}>
                                Color faded</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Question_No_21_Any_Hair_Problem">Question No.21: Any Hair Problem</label>
                        <select class="form-control" id="Question_No_21_Any_Hair_Problem"
                            name="Question_No_21_Any_Hair_Problem" required>
                            <option value="">Select</option>
                            <option value="Kinky"
                                {{ old('Question_No_21_Any_Hair_Problem', $headAndNeckData->Question_No_21_Any_Hair_Problem ?? '') == 'Kinky' ? 'selected' : '' }}>
                                Kinky</option>
                            <option value="Brittle"
                                {{ old('Question_No_21_Any_Hair_Problem', $headAndNeckData->Question_No_21_Any_Hair_Problem ?? '') == 'Brittle' ? 'selected' : '' }}>
                                Brittle</option>
                            <option value="Dry"
                                {{ old('Question_No_21_Any_Hair_Problem', $headAndNeckData->Question_No_21_Any_Hair_Problem ?? '') == 'Dry' ? 'selected' : '' }}>
                                Dry</option>
                            <option value="Normal"
                                {{ old('Question_No_21_Any_Hair_Problem', $headAndNeckData->Question_No_21_Any_Hair_Problem ?? '') == 'Normal' ? 'selected' : '' }}>
                                Normal</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Question_No_22_Sclap">Question No.22: Scalp</label>
                        <select class="form-control" id="Question_No_22_Sclap" name="Question_No_22_Sclap" required>
                            <option value="">Select</option>
                            <option value="Scaly"
                                {{ old('Question_No_22_Sclap', $headAndNeckData->Question_No_22_Sclap ?? '') == 'Scaly' ? 'selected' : '' }}>
                                Scaly</option>
                            <option value="Dry"
                                {{ old('Question_No_22_Sclap', $headAndNeckData->Question_No_22_Sclap ?? '') == 'Dry' ? 'selected' : '' }}>
                                Dry</option>
                            <option value="Moist"
                                {{ old('Question_No_22_Sclap', $headAndNeckData->Question_No_22_Sclap ?? '') == 'Moist' ? 'selected' : '' }}>
                                Moist</option>
                            <option value="Normal"
                                {{ old('Question_No_22_Sclap', $headAndNeckData->Question_No_22_Sclap ?? '') == 'Normal' ? 'selected' : '' }}>
                                Normal</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Question_No_23_Hair_distribution">Question No.23: Hair distribution</label>
                        <select class="form-control" id="Question_No_23_Hair_distribution"
                            name="Question_No_23_Hair_distribution" required>
                            <option value="">Select</option>
                            <option value="Even"
                                {{ old('Question_No_23_Hair_distribution', $headAndNeckData->Question_No_23_Hair_distribution ?? '') == 'Even' ? 'selected' : '' }}>
                                Even</option>
                            <option value="Patchy"
                                {{ old('Question_No_23_Hair_distribution', $headAndNeckData->Question_No_23_Hair_distribution ?? '') == 'Patchy' ? 'selected' : '' }}>
                                Patchy</option>
                            <option value="Receding"
                                {{ old('Question_No_23_Hair_distribution', $headAndNeckData->Question_No_23_Hair_distribution ?? '') == 'Receding' ? 'selected' : '' }}>
                                Receding</option>
                            <option value="Receding_Hair_Line"
                                {{ old('Question_No_23_Hair_distribution', $headAndNeckData->Question_No_23_Hair_distribution ?? '') == 'Receding_Hair_Line' ? 'selected' : '' }}>
                                Receding Hair Line</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="head_and_neck_examination_comment">Comment/Findings</label>
                        <textarea name="head_and_neck_examination_comment" cols="50" placeholder="Comment here" required>{{ old('head_and_neck_examination_comment', $headAndNeckData->head_and_neck_examination_comment ?? '') }}</textarea>
                    </div>
                </div>


                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>

            </div>






            <!-- Step six -->
            <div class="step" id="step6">
                <h3>Eye:</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_24_Visual_acuity_using_Snellen_chart">Question No.24: Visual acuity
                                using Snellen’s chart</label><br>
                            <input type="text" id="Question_No_24_Visual_acuity_using_Snellen_chart"
                                name="Question_No_24_Visual_acuity_using_Snellen_chart" class="form-control" required
                                value="{{ old('Question_No_24_Visual_acuity_using_Snellen_chart', $eyeExamination->Question_No_24_Visual_acuity_using_Snellen_chart ?? '') }}">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_25_Normal_ocular_alignment">Question No.25: Normal ocular
                                alignment</label><br>
                            <select class="form-control" id="Question_No_25_Normal_ocular_alignment"
                                name="Question_No_25_Normal_ocular_alignment" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ old('Question_No_25_Normal_ocular_alignment', $eyeExamination->Question_No_25_Normal_ocular_alignment ?? '') == 'Yes' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="No"
                                    {{ old('Question_No_25_Normal_ocular_alignment', $eyeExamination->Question_No_25_Normal_ocular_alignment ?? '') == 'No' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_26_Normal_eye_inspection">Question No.26: Normal eye
                                inspection</label><br>
                            <select class="form-control" id="Question_No_26_Normal_eye_inspection"
                                name="Question_No_26_Normal_eye_inspection" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ old('Question_No_26_Normal_eye_inspection', $eyeExamination->Question_No_26_Normal_eye_inspection ?? '') == 'Yes' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="No"
                                    {{ old('Question_No_26_Normal_eye_inspection', $eyeExamination->Question_No_26_Normal_eye_inspection ?? '') == 'No' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_27_Normal_Color_vision">Question No.27: Normal Color vision</label><br>
                            <select class="form-control" id="Question_No_27_Normal_Color_vision"
                                name="Question_No_27_Normal_Color_vision" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ old('Question_No_27_Normal_Color_vision', $eyeExamination->Question_No_27_Normal_Color_vision ?? '') == 'Yes' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="No"
                                    {{ old('Question_No_27_Normal_Color_vision', $eyeExamination->Question_No_27_Normal_Color_vision ?? '') == 'No' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_28_Nystagmus">Question No.28: Nystagmus</label><br>
                            <select class="form-control" id="Question_No_28_Nystagmus" name="Question_No_28_Nystagmus"
                                required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ old('Question_No_28_Nystagmus', $eyeExamination->Question_No_28_Nystagmus ?? '') == 'Yes' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="No"
                                    {{ old('Question_No_28_Nystagmus', $eyeExamination->Question_No_28_Nystagmus ?? '') == 'No' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="eye_comment">Comment/Findings</label><br>
                            <textarea name="eye_comment" placeholder="Comment here" cols="50" required>
                    {{ old('eye_comment', $eyeExamination->eye_comment ?? '') }}
                </textarea>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>



            <!-- Step Seven -->
            <div class="step" id="step7">
                <h3>Ears:</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_29_Normal_ears_shape_and_position">Question No.29: Normal ears shape
                                and position</label><br>
                            <select class="form-control" id="Question_No_29_Normal_ears_shape_and_position"
                                name="Question_No_29_Normal_ears_shape_and_position" required>
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ old('Question_No_29_Normal_ears_shape_and_position', $earExaminations->Question_No_29_Normal_ears_shape_and_position ?? '') == 'Yes' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="No"
                                    {{ old('Question_No_29_Normal_ears_shape_and_position', $earExaminations->Question_No_29_Normal_ears_shape_and_position ?? '') == 'No' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_30_Ear_examination">Question No.30: Ear examination</label><br>
                            <select class="form-control" id="Question_No_30_Ear_examination"
                                name="Question_No_30_Ear_examination" required>
                                <option value="">Select</option>
                                <option value="Ear wax"
                                    {{ old('Question_No_30_Ear_examination', $earExaminations->Question_No_30_Ear_examination ?? '') == 'Ear wax' ? 'selected' : '' }}>
                                    Ear wax</option>
                                <option value="Canal infection"
                                    {{ old('Question_No_30_Ear_examination', $earExaminations->Question_No_30_Ear_examination ?? '') == 'Canal infection' ? 'selected' : '' }}>
                                    Canal infection</option>
                                <option value="None"
                                    {{ old('Question_No_30_Ear_examination', $earExaminations->Question_No_30_Ear_examination ?? '') == 'None' ? 'selected' : '' }}>
                                    None</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber">Question No.31:
                                Conclusion of hearing test with Rinner and Weber</label><br>
                            <select class="form-control"
                                id="Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber"
                                name="Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber" required>
                                <option value="">Select</option>
                                <option value="Normal"
                                    {{ old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber', $earExaminations->Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber ?? '') == 'Normal' ? 'selected' : '' }}>
                                    Normal</option>
                                <option value="right_ear_conductive_hearing_loss"
                                    {{ old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber', $earExaminations->Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber ?? '') == 'right_ear_conductive_hearing_loss' ? 'selected' : '' }}>
                                    Right ear conductive hearing loss</option>
                                <option value="left_ear_conductive_hearing_loss"
                                    {{ old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber', $earExaminations->Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber ?? '') == 'left_ear_conductive_hearing_loss' ? 'selected' : '' }}>
                                    Left ear conductive hearing loss</option>
                                <option value="right_ear_sensorineural_hearing_loss"
                                    {{ old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber', $earExaminations->Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber ?? '') == 'right_ear_sensorineural_hearing_loss' ? 'selected' : '' }}>
                                    Right ear sensorineural hearing loss</option>
                                <option value="left_ear_sensorineural_hearing_loss"
                                    {{ old('Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber', $earExaminations->Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber ?? '') == 'left_ear_sensorineural_hearing_loss' ? 'selected' : '' }}>
                                    Left ear sensorineural hearing loss</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="ears_comment">Comment/Findings</label><br>
                            <textarea name="ears_comment" placeholder="Comment here" id="ears_comment" cols="50" required>{{ old('ears_comment', $earExaminations->ears_comment ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!--  Step Eight -->
            <div class="step" id="step8">
                <h3>Nose</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="nose">Question No.32: External nasal examination</label><br>
                            <select class="form-control" id="Question_No_32_External_nasal_examinaton"
                                name="Question_No_32_External_nasal_examinaton" required>
                                <option value="">Select</option>
                                <option value="Deformities"
                                    {{ old('Question_No_32_External_nasal_examinaton', $noseExamination->Question_No_32_External_nasal_examinaton ?? '') == 'Deformities' ? 'selected' : '' }}>
                                    Deformities</option>
                                <option value="Swelling"
                                    {{ old('Question_No_32_External_nasal_examinaton', $noseExamination->Question_No_32_External_nasal_examinaton ?? '') == 'Swelling' ? 'selected' : '' }}>
                                    Swelling</option>
                                <option value="Redness"
                                    {{ old('Question_No_32_External_nasal_examinaton', $noseExamination->Question_No_32_External_nasal_examinaton ?? '') == 'Redness' ? 'selected' : '' }}>
                                    Redness</option>
                                <option value="Lesions"
                                    {{ old('Question_No_32_External_nasal_examinaton', $noseExamination->Question_No_32_External_nasal_examinaton ?? '') == 'Lesions' ? 'selected' : '' }}>
                                    Lesions</option>
                                <option value="Nasal Discharge"
                                    {{ old('Question_No_32_External_nasal_examinaton', $noseExamination->Question_No_32_External_nasal_examinaton ?? '') == 'Nasal Discharge' ? 'selected' : '' }}>
                                    Nasal Discharge</option>
                                <option value="Crusting"
                                    {{ old('Question_No_32_External_nasal_examinaton', $noseExamination->Question_No_32_External_nasal_examinaton ?? '') == 'Crusting' ? 'selected' : '' }}>
                                    Crusting</option>
                                <option value="Normal"
                                    {{ old('Question_No_32_External_nasal_examinaton', $noseExamination->Question_No_32_External_nasal_examinaton ?? '') == 'Normal' ? 'selected' : '' }}>
                                    Normal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label for="field9">Question No.33: Perform a nasal patency test</label><br>
                            <select class="form-control" id="Question_No_33_perform_a_nasal_patency_test"
                                name="Question_No_33_perform_a_nasal_patency_test" required>
                                <option value="">Select</option>
                                <option value="Obstruction"
                                    {{ old('Question_No_33_perform_a_nasal_patency_test', $noseExamination->Question_No_33_perform_a_nasal_patency_test ?? '') == 'Obstruction' ? 'selected' : '' }}>
                                    Obstruction</option>
                                <option value="DNS"
                                    {{ old('Question_No_33_perform_a_nasal_patency_test', $noseExamination->Question_No_33_perform_a_nasal_patency_test ?? '') == 'DNS' ? 'selected' : '' }}>
                                    DNS</option>
                                <option value="Normal"
                                    {{ old('Question_No_33_perform_a_nasal_patency_test', $noseExamination->Question_No_33_perform_a_nasal_patency_test ?? '') == 'Normal' ? 'selected' : '' }}>
                                    Normal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="comment">Comment/Findings</label><br>
                            <textarea name="nose_comment" placeholder="Comment here" cols="50" required>{{ old('nose_comment', $noseExamination->nose_comment ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!--  Step Nine -->
            <div class="step" id="step9">
                <h3>Oral</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="assess_gingiva">Question No.34: Assess gingiva</label><br>
                        <select class="form-control" id="Question_No_34_Assess_gingiva"
                            name="Question_No_34_Assess_gingiva" required>
                            <option value="">Select</option>
                            <option value="Infection"
                                {{ old('Question_No_34_Assess_gingiva', $oralExamination->Question_No_34_Assess_gingiva ?? '') == 'Infection' ? 'selected' : '' }}>
                                Infection</option>
                            <option value="Bleed"
                                {{ old('Question_No_34_Assess_gingiva', $oralExamination->Question_No_34_Assess_gingiva ?? '') == 'Bleed' ? 'selected' : '' }}>
                                Bleed</option>
                            <option value="Normal"
                                {{ old('Question_No_34_Assess_gingiva', $oralExamination->Question_No_34_Assess_gingiva ?? '') == 'Normal' ? 'selected' : '' }}>
                                Normal</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="are_there_dental_caries">Question No.35: Are there dental caries</label><br>
                        <select class="form-control" id="Question_No_35_Are_there_dental_caries"
                            name="Question_No_35_Are_there_dental_caries" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ old('Question_No_35_Are_there_dental_caries', $oralExamination->Question_No_35_Are_there_dental_caries ?? '') == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ old('Question_No_35_Are_there_dental_caries', $oralExamination->Question_No_35_Are_there_dental_caries ?? '') == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="comment">Comment/Findings</label><br>
                        <textarea name="oral_comment" placeholder="Comment here" cols="50" required>{{ old('oral_comment', $oralExamination->oral_comment ?? '') }}</textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>




            <!-- Step Ten: Throat -->
            <div class="step" id="step10">
                <h3>Throat Examination</h3>
                <div class="form-row">

                    <!-- Question No.36: Examine Tonsils -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_36_Examine_tonsils">Question No.36: Examine tonsils</label>
                        <select class="form-control" id="Question_No_36_Examine_tonsils"
                            name="Question_No_36_Examine_tonsils" required>
                            <option value="">Select</option>
                            <option value="Normal"
                                {{ old('Question_No_36_Examine_tonsils', $throatExaminations->Question_No_36_Examine_tonsils ?? '') == 'Normal' ? 'selected' : '' }}>
                                Normal</option>
                            <option value="Tonsillitis"
                                {{ old('Question_No_36_Examine_tonsils', $throatExaminations->Question_No_36_Examine_tonsils ?? '') == 'Tonsillitis' ? 'selected' : '' }}>
                                Tonsillitis</option>
                            <option value="Tonsillectomy done"
                                {{ old('Question_No_36_Examine_tonsils', $throatExaminations->Question_No_36_Examine_tonsils ?? '') == 'Tonsillectomy done' ? 'selected' : '' }}>
                                Tonsillectomy done</option>
                        </select>
                    </div>

                    <!-- Question No.37: Normal Speech Development -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_37_Normal_Speech_development">Question No.37: Normal Speech
                            Development</label>
                        <select class="form-control" id="Question_No_37_Normal_Speech_development"
                            name="Question_No_37_Normal_Speech_development" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ old('Question_No_37_Normal_Speech_development', $throatExaminations->Question_No_37_Normal_Speech_development ?? '') == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ old('Question_No_37_Normal_Speech_development', $throatExaminations->Question_No_37_Normal_Speech_development ?? '') == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Question No.38: Any Neck Swelling -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_38_Any_Neck_swelling">Question No.38: Any Neck Swelling</label>
                        <select class="form-control" id="any_neck_swelling" name="Question_No_38_Any_Neck_swelling"
                            required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ old('Question_No_38_Any_Neck_swelling', $throatExaminations->Question_No_38_Any_Neck_swelling ?? '') == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ old('Question_No_38_Any_Neck_swelling', $throatExaminations->Question_No_38_Any_Neck_swelling ?? '') == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Specify Any Neck Swelling -->
                    <div
                        class="form-group col-md-6 any_neck_swelling_specify {{ old('Question_No_38_Any_Neck_swelling', $throatExaminations->Question_No_38_Any_Neck_swelling ?? '') == 'Yes' ? '' : 'd-none' }}">
                        <label for="Specify_Any_Neck_swelling">Specify Any Neck Swelling</label>
                        <input type="text" class="form-control" id="Specify_Any_Neck_swelling"
                            name="Specify_Any_Neck_swelling"
                            value="{{ old('Specify_Any_Neck_swelling', $throatExaminations->Specify_Any_Neck_swelling ?? '') }}"
                            placeholder="Specify neck swelling">
                    </div>



                    <!-- Question No.39: Examine Lymph Node -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_39_Examine_lymph_node">Question No.39: Examine Lymph Node</label>
                        <select class="form-control" id="lymph_node" name="Question_No_39_Examine_lymph_node" required>
                            <option value="">Select</option>
                            <option value="normal"
                                {{ old('Question_No_39_Examine_lymph_node', $throatExaminations->Question_No_39_Examine_lymph_node ?? '') == 'normal' ? 'selected' : '' }}>
                                Normal</option>
                            <option value="abnormal"
                                {{ old('Question_No_39_Examine_lymph_node', $throatExaminations->Question_No_39_Examine_lymph_node ?? '') == 'abnormal' ? 'selected' : '' }}>
                                Abnormal</option>
                        </select>
                    </div>



                    <!-- Specify Lymph Node -->
                    <div
                        class="form-group col-md-6 lymph_node_specify {{ old('Question_No_39_Examine_lymph_node', $throatExaminations->Question_No_39_Examine_lymph_node ?? '') == 'abnormal' ? '' : 'd-none' }}">
                        <label for="Specify_lymph_node">Specify Lymph Node</label>
                        <input type="text" class="form-control" id="Specify_lymph_node" name="Specify_lymph_node"
                            value="{{ old('Specify_lymph_node', $throatExaminations->Specify_lymph_node ?? '') }}"
                            placeholder="Specify lymph node">
                    </div>


                    <!-- Comment/Findings -->
                    <div class="form-group col-md-12">
                        <label for="throat_comment">Comment/Findings</label>
                        <textarea class="form-control" id="throat_comment" name="throat_comment" placeholder="Enter your comments here"
                            rows="3" required>{{ old('throat_comment', $throatExaminations->throat_comment ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!-- Step Eleven -->
            <div class="step" id="step11">
                <h3>Chest</h3>
                <div class="form-row">
                    <!-- Question No.40: Any visible chest deformity -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_40_Any_visible_chest_deformity">Question No.40: Any visible chest
                            deformity</label><br>
                        <select class="form-control" id="Question_No_40_Any_visible_chest_deformity"
                            name="Question_No_40_Any_visible_chest_deformity" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ old('Question_No_40_Any_visible_chest_deformity', $chestExamination->Question_No_40_Any_visible_chest_deformity ?? '') == 'Yes' ? 'selected' : '' }}>
                                Yes</option>
                            <option value="No"
                                {{ old('Question_No_40_Any_visible_chest_deformity', $chestExamination->Question_No_40_Any_visible_chest_deformity ?? '') == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Question No.41: Lung Auscultation -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_41_Lung_Auscultation">Question No.41: Lung Auscultation</label><br>
                        <select class="form-control" id="Question_No_41_Lung_Auscultation"
                            name="Question_No_41_Lung_Auscultation" required>
                            <option value="">Select</option>
                            <option value="Ronchi"
                                {{ old('Question_No_41_Lung_Auscultation', $chestExamination->Question_No_41_Lung_Auscultation ?? '') == 'Ronchi' ? 'selected' : '' }}>
                                Ronchi</option>
                            <option value="Wheezing"
                                {{ old('Question_No_41_Lung_Auscultation', $chestExamination->Question_No_41_Lung_Auscultation ?? '') == 'Wheezing' ? 'selected' : '' }}>
                                Wheezing</option>
                            <option value="Crackles"
                                {{ old('Question_No_41_Lung_Auscultation', $chestExamination->Question_No_41_Lung_Auscultation ?? '') == 'Crackles' ? 'selected' : '' }}>
                                Crackles</option>
                            <option value="Vesicular_Breathing"
                                {{ old('Question_No_41_Lung_Auscultation', $chestExamination->Question_No_41_Lung_Auscultation ?? '') == 'Vesicular_Breathing' ? 'selected' : '' }}>
                                Vesicular Breathing</option>
                            <option value="Vesicular Diminished Breath Sound(specify)"
                                {{ old('Question_No_41_Lung_Auscultation', $chestExamination->Question_No_41_Lung_Auscultation ?? '') == 'Vesicular Diminished Breath Sound(specify)' ? 'selected' : '' }}>
                                Vesicular Diminished Breath Sound (specify)</option>
                        </select>
                    </div>

                    <!-- Question No.42: Cardiac Auscultation -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_42_Cardiac_Auscultation">Question No.42: Cardiac Auscultation</label><br>
                        <select class="form-control" id="Question_No_42_Cardiac_Auscultation"
                            name="Question_No_42_Cardiac_Auscultation" required>
                            <option value="">Select</option>
                            <option value="Normal S1/S2"
                                {{ old('Question_No_42_Cardiac_Auscultation', $chestExamination->Question_No_42_Cardiac_Auscultation ?? '') == 'Normal S1/S2' ? 'selected' : '' }}>
                                Normal S1/S2</option>
                            <option value="Murmur"
                                {{ old('Question_No_42_Cardiac_Auscultation', $chestExamination->Question_No_42_Cardiac_Auscultation ?? '') == 'Murmur' ? 'selected' : '' }}>
                                Murmur</option>
                        </select>
                    </div>

                </div>

                <!-- Comment/Findings -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="chest_comment">Comment/Findings</label><br>
                        <textarea class="form-control" id="chest_comment" name="chest_comment" placeholder="Comment here" rows="3"
                            required>{{ old('chest_comment', $chestExamination->chest_comment ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>




            <!-- Step twelve -->
            <div class="step" id="step12">
                <h3>Abdomen</h3>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="distention_scar_mass">
                                Question No.43: Did you observe any distension, scars, or masses on the child's abdomen?
                            </label><br>
                            <select class="form-control" id="distention_scar_mass"
                                name="Question_No_43_Did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen"
                                required>
                                <option value="">Select</option>
                                <option value="Distention" @if (old(
                                        'Question_No_43_Did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen',
                                        $Abdomens->distention_scar_mass ?? '') == 'Distention') selected @endif>Distention
                                </option>
                                <option value="Scar" @if (old(
                                        'Question_No_43_Did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen',
                                        $Abdomens->distention_scar_mass ?? '') == 'Scar') selected @endif>Scar</option>
                                <option value="Mass" @if (old(
                                        'Question_No_43_Did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen',
                                        $Abdomens->distention_scar_mass ?? '') == 'Mass') selected @endif>Mass</option>
                                <option value="Normal" @if (old(
                                        'Question_No_43_Did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen',
                                        $Abdomens->distention_scar_mass ?? '') == 'Normal') selected @endif>Normal</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="any_history_of_abdominal_pain">
                                Question No.44: Any history of abdominal pain?
                            </label><br>
                            <select class="form-control" id="any_history_of_abdominal_pain"
                                name="Question_No_44_Any_history_of_abdominal_Pain" required>
                                <option value="">Select</option>
                                <option value="Yes" @if (old('Question_No_44_Any_history_of_abdominal_Pain', $Abdomens->any_history_of_abdominal_pain ?? '') == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if (old('Question_No_44_Any_history_of_abdominal_Pain', $Abdomens->any_history_of_abdominal_pain ?? '') == 'No') selected @endif>No</option>
                            </select>
                        </div>

                        <div
                            class="form-group col-md-6 any_history_of_abdominal_pain_specify @if (old('Question_No_44_Any_history_of_abdominal_Pain', $Abdomens->any_history_of_abdominal_pain ?? '') == 'Yes') d-block @else d-none @endif">
                            <div class="form-group">
                                <label for="any_history_of_abdominal_pain_specify">Specify Abdominal Pain</label><br>
                                <input type="text" name="any_history_of_abdominal_pain_specify" class="form-control"
                                    id="any_history_of_abdominal_pain_specify"
                                    value="{{ old('any_history_of_abdominal_pain_specify', $Abdomens->any_history_of_abdominal_pain_specify ?? '') }}"
                                    placeholder="Please specify any history of abdominal pain">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="abdomens_comment">Comment/Findings</label><br>
                            <textarea name="abdomens_comment" placeholder="Comment here" id="abdomens_comment" cols="50" required>{{ old('abdomens_comment', $Abdomens->abdomen_comment ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>


            <!--  Step thirdteen -->
            <div class="step" id="step13">
                <h3>Musculoskeletal</h3>
                <div class="form-row">
                    <!-- Question No.45 -->
                    <div class="form-group col-md-6">
                        <label for="limitations_range_motion">Question No.45: Did you observe any limitations in the
                            child's range of joint motion during your examination?*</label><br>
                        <select class="form-control" id="limitations_range_motion"
                            name="Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"
                            required>
                            <option value="">Select</option>
                            <option value="Yes" @if (old(
                                    'Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination',
                                    $Musculoskeletal->limitations_range_motion ?? '') == 'Yes') selected @endif>Yes</option>
                            <option value="No" @if (old(
                                    'Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination',
                                    $Musculoskeletal->limitations_range_motion ?? '') == 'No') selected @endif>No</option>
                        </select>
                    </div>
                    <div
                        class="form-group col-md-6 limitations_range_motion_specify @if (old(
                                'Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination',
                                $Musculoskeletal->limitations_range_motion ?? '') == 'Yes') d-block @else d-none @endif">
                        <label for="limitations_range_motion_specify">Specify limitations in the child's range of joint
                            motion during your examination?*</label><br>
                        <input type="text"
                            name="Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"
                            class="form-control" id="limitations_range_motion_specify"
                            value="{{ old('Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination', $Musculoskeletal->limitations_specify ?? '') }}"
                            placeholder="Please specify limitations in the child's range of joint motion during your examination?*">
                    </div>

                </div>

                <!-- Question No.46 -->
                <div class="form-group col-md-6">
                    <label for="spinal_curvature_assessment">Question No.46: Spinal curvature assessment (tick positive
                        finding)</label><br>
                    <select class="form-control" id="spinal_curvature_assessment"
                        name="Question_No_46_Spinal_curvature_assessment_tick_positive_finding" required>
                        <option value="">Select</option>
                        <option value="Uneven shoulders" @if (old(
                                'Question_No_46_Spinal_curvature_assessment_tick_positive_finding',
                                $Musculoskeletal->spinal_curvature_assessment ?? '') == 'Uneven shoulders') selected @endif>Uneven
                            Shoulders</option>
                        <option value="Shoulder Blade" @if (old(
                                'Question_No_46_Spinal_curvature_assessment_tick_positive_finding',
                                $Musculoskeletal->spinal_curvature_assessment ?? '') == 'Shoulder Blade') selected @endif>Shoulder Blade
                        </option>
                        <option value="Uneven waist" @if (old(
                                'Question_No_46_Spinal_curvature_assessment_tick_positive_finding',
                                $Musculoskeletal->spinal_curvature_assessment ?? '') == 'Uneven waist') selected @endif>Uneven Waist
                        </option>
                        <option value="Hips" @if (old(
                                'Question_No_46_Spinal_curvature_assessment_tick_positive_finding',
                                $Musculoskeletal->spinal_curvature_assessment ?? '') == 'Hips') selected @endif>Hips</option>
                        <option value="Normal" @if (old(
                                'Question_No_46_Spinal_curvature_assessment_tick_positive_finding',
                                $Musculoskeletal->spinal_curvature_assessment ?? '') == 'Normal') selected @endif>Normal</option>
                    </select>
                </div>

                <!-- Question No.47 -->
                <div class="form-group col-md-6">
                    <label for="curvature_spine_resembling">Question No.47: Side-to-side curvature in the spine
                        resembling</label><br>
                    <select class="form-control" id="curvature_spine_resembling"
                        name="Question_No_47_side-to-side_curvature_in_the_spine_resembling" required>
                        <option value="">Select</option>
                        <option value="S_Shape" @if (old(
                                'Question_No_47_side-to-side_curvature_in_the_spine_resembling',
                                $Musculoskeletal->curvature_spine_resembling ?? '') == 'S_Shape') selected @endif>S Shape</option>
                        <option value="C_Shape" @if (old(
                                'Question_No_47_side-to-side_curvature_in_the_spine_resembling',
                                $Musculoskeletal->curvature_spine_resembling ?? '') == 'C_Shape') selected @endif>C Shape</option>
                        <option value="Normal" @if (old(
                                'Question_No_47_side-to-side_curvature_in_the_spine_resembling',
                                $Musculoskeletal->curvature_spine_resembling ?? '') == 'Normal') selected @endif>Normal</option>
                    </select>
                </div>

                <!-- Question No.48 -->
                <div class="form-group col-md-6">
                    <label for="adams_forward_bend_test">Question No.48: Adams forward bend test</label><br>
                    <select class="form-control" id="adams_forward_bend_test"
                        name="Question_No_48_Adams_forward_bend_test" required>
                        <option value="">Select</option>
                        <option value="Positive" @if (old('Question_No_48_Adams_forward_bend_test', $Musculoskeletal->adams_forward_bend_test ?? '') == 'Positive') selected @endif>Positive</option>
                        <option value="Negative" @if (old('Question_No_48_Adams_forward_bend_test', $Musculoskeletal->adams_forward_bend_test ?? '') == 'Negative') selected @endif>Negative</option>
                    </select>
                </div>

                <!-- Question No.49 -->
                <div class="form-group col-md-6">
                    <label for="foot_or_toe_abnormalities">Question No.49: Any foot or toe abnormalities</label><br>
                    <select class="form-control" id="foot_or_toe_abnormalities"
                        name="Question_No_49_Any_foot_or_toe_abnormalities" required>
                        <option value="">Select</option>
                        <option value="Normal" @if (old('Question_No_49_Any_foot_or_toe_abnormalities', $Musculoskeletal->foot_or_toe_abnormalities ?? '') == 'Normal') selected @endif>Normal</option>
                        <option value="Flat Feet" @if (old('Question_No_49_Any_foot_or_toe_abnormalities', $Musculoskeletal->foot_or_toe_abnormalities ?? '') ==
                                'Flat Feet') selected @endif>Flat Feet</option>
                        <option value="Varus" @if (old('Question_No_49_Any_foot_or_toe_abnormalities', $Musculoskeletal->foot_or_toe_abnormalities ?? '') == 'Varus') selected @endif>Varus</option>
                        <option value="Valgus" @if (old('Question_No_49_Any_foot_or_toe_abnormalities', $Musculoskeletal->foot_or_toe_abnormalities ?? '') == 'Valgus') selected @endif>Valgus</option>
                        <option value="High Arch" @if (old('Question_No_49_Any_foot_or_toe_abnormalities', $Musculoskeletal->foot_or_toe_abnormalities ?? '') ==
                                'High Arch') selected @endif>High Arch</option>
                        <option value="Hammer Toe" @if (old('Question_No_49_Any_foot_or_toe_abnormalities', $Musculoskeletal->foot_or_toe_abnormalities ?? '') ==
                                'Hammer Toe') selected @endif>Hammer Toe</option>
                        <option value="Bunion" @if (old('Question_No_49_Any_foot_or_toe_abnormalities', $Musculoskeletal->foot_or_toe_abnormalities ?? '') == 'Bunion') selected @endif>Bunion</option>
                    </select>
                </div>

                <!-- Comments -->
                <div class="form-group col-md-6">
                    <label for="comment">Comment/Findings</label><br>
                    <textarea name="musculoskeletal_comment" placeholder="Comment here" cols="50" required>{{ old('musculoskeletal_comment', $Musculoskeletal->comment ?? '') }}</textarea>
                </div>


                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>

            </div>



            <!-- Step Fourteen -->
            <div class="step" id="step14">
                <h3>Vaccination:</h3>
                <div class="form-row">
                    <!-- EPI Immunization Card Question -->
                    <div class="form-group col-md-6">
                        <label for="immunization_card">Question No.50: Have EPI immunization card?*</label>
                        <select class="form-control" id="immunization_card"
                            name="Question_No_50_Have_EPI_immunization_card" required>
                            <option value="">Select</option>
                            <option value="Yes" @if (old('Question_No_50_Have_EPI_immunization_card', $Vaccination->immunization_card ?? '') == 'Yes') selected @endif>Yes</option>
                            <option value="No" @if (old('Question_No_50_Have_EPI_immunization_card', $Vaccination->immunization_card ?? '') == 'No') selected @endif>No</option>
                        </select>
                    </div>

                    <!-- Reason for Not Being Vaccinated -->
                    <div
                        class="form-group col-md-6 immunization_card_specify @if (old('Question_No_50_Have_EPI_immunization_card', $Vaccination->immunization_card ?? '') == 'No') d-block @else d-none @endif">
                        <label for="Reason_of_not_being_vaccinated">Reason for not being vaccinated*</label>
                        <input type="text" name="Reason_of_not_being_vaccinated" class="form-control"
                            id="Reason_of_not_being_vaccinated"
                            value="{{ old('Reason_of_not_being_vaccinated', $Vaccination->reason_of_not_being_vaccinated ?? '') }}">
                    </div>

                    <!-- Completed Vaccinations -->
                    <div class="form-group col-md-6">
                        <label>Question No.50: Mark all the vaccinations that are completed</label><br>
                        <div>
                            <input type="checkbox" value="BCG_1_dose" id="BCG_1_dose" name="vaccinations[]"
                                @if (in_array('BCG_1_dose', old('vaccinations', explode(',', $Vaccination->vaccinations_completed ?? '')))) checked @endif>
                            <label for="BCG_1_dose">BCG 1 dose</label>
                        </div>
                        <div>
                            <input type="checkbox" value="OPV_4_dose" id="OPV_4_dose" name="vaccinations[]"
                                @if (in_array('OPV_4_dose', old('vaccinations', explode(',', $Vaccination->vaccinations_completed ?? '')))) checked @endif>
                            <label for="OPV_4_dose">OPV 4 doses</label>
                        </div>
                        <div>
                            <input type="checkbox" value="Pentavalent_vaccine_(DTP+Hep B + Hib)_3_dose" id="Pentavalent"
                                name="vaccinations[]" @if (in_array(
                                        'Pentavalent_vaccine_(DTP+Hep B + Hib)_3_dose',
                                        old('vaccinations', explode(',', $Vaccination->vaccinations_completed ?? '')))) checked @endif>
                            <label for="Pentavalent">Pentavalent vaccine (DTP+Hep B + Hib) 3 doses</label>
                        </div>
                        <div>
                            <input type="checkbox" value="Rota_2_doses" id="Rota" name="vaccinations[]"
                                @if (in_array('Rota_2_doses', old('vaccinations', explode(',', $Vaccination->vaccinations_completed ?? '')))) checked @endif>
                            <label for="Rota">Rota 2 doses</label>
                        </div>
                        <div>
                            <input type="checkbox" value="Measles_2_doses" id="Measles" name="vaccinations[]"
                                @if (in_array('Measles_2_doses', old('vaccinations', explode(',', $Vaccination->vaccinations_completed ?? '')))) checked @endif>
                            <label for="Measles">Measles 2 doses</label>
                        </div>
                        <div>
                            <input type="checkbox" value="Never_had_any_vaccination" id="never_had_any_vaccination"
                                name="vaccinations[]" @if (in_array(
                                        'Never_had_any_vaccination',
                                        old('vaccinations', explode(',', $Vaccination->vaccinations_completed ?? '')))) checked @endif>
                            <label for="never_had_any_vaccination">Never had any vaccination</label>
                        </div>
                    </div>
                </div>

                <!-- Comment Section -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="comment">Comment/Findings</label>
                        <textarea name="vaccination_comment" placeholder="Comment here" cols="50" class="form-control" required>{{ old('vaccination_comment', $Vaccination->vaccination_comment ?? '') }}</textarea>
                    </div>
                </div>

                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>




            <!-- Step Fifteen -->
            <div class="step" id="step15">
                <h3>Miscellaneous</h3>
                <div class="form-row">
                    <!-- Question No. 55: Allergies -->
                    <div class="form-group col-md-6">
                        <label for="do_you_have_any_Allergies">Question No.55: Do you have any Allergies</label><br>
                        <select class="form-control" id="do_you_have_any_Allergies"
                            name="Question_No_55_Do_you_have_any_Allergies" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ old('Question_No_55_Do_you_have_any_Allergies', $Miscellaneous->allergies ?? '') == 'Yes' ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ old('Question_No_55_Do_you_have_any_Allergies', $Miscellaneous->allergies ?? '') == 'No' ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Specify Allergies -->
                    <div class="form-group col-md-6">
                        <div
                            class="form-group do_you_have_any_Allergies_specify {{ old('Question_No_55_Do_you_have_any_Allergies', $Miscellaneous->Question_No_55_Do_you_have_any_Allergies ?? '') == 'Yes' ? '' : 'd-none' }}">
                            <label for="Specify Allergies">Specify Allergies</label><br>
                            <input type="text" name="Do_you_have_any_allergies_specify" class="form-control"
                                id="do_you_have_any_allergies_specify" placeholder="Please specify allergies"
                                value="{{ old('Do_you_have_any_allergies_specify', $Miscellaneous->Do_you_have_any_allergies_specify ?? '') }}"><br>
                        </div>
                    </div>

                    <!-- Question No. 56: Age of Menarche -->
                    <div class="form-group col-md-6">
                        <label for="menarche_age">Question No.56: Girls above 8 years old ask age of
                            Menarche:</label><br><br>
                        <input type="number" name="Question_No_56_Girls_above_8_years_old_ask" class="form-control"
                            id="menarche_age" placeholder="Write Age"
                            value="{{ old('Question_No_56_Girls_above_8_years_old_ask', $Miscellaneous->menarche_age ?? '') }}"
                            min="1" max="100"><br>
                        <span id="menarche_age_error" style="color: red; display: none;">The age of menarche cannot be
                            greater than 100.</span>
                    </div>

                    <!-- Question No. 57: Urinary Issues -->
                    <div class="form-group col-md-6">
                        <label for="discomfort_during_urination">Question No.57: Inquire about urinary frequency, urgency,
                            and any pain or discomfort during urination.</label><br>
                        <select class="form-control" id="discomfort_during_urination"
                            name="Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination"
                            required>
                            <option value="">Select</option>
                            <option value="No urinary issues reported"
                                {{ old('Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination', $Miscellaneous->urinary_issues ?? '') == 'No urinary issues reported' ? 'selected' : '' }}>
                                No urinary issues reported</option>
                            <option value="Urinary frequency"
                                {{ old('Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination', $Miscellaneous->urinary_issues ?? '') == 'Urinary frequency' ? 'selected' : '' }}>
                                Urinary frequency</option>
                            <option value="Urinary urgency"
                                {{ old('Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination', $Miscellaneous->urinary_issues ?? '') == 'Urinary urgency' ? 'selected' : '' }}>
                                Urinary urgency</option>
                            <option value="Pain or discomfort during urination"
                                {{ old('Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination', $Miscellaneous->urinary_issues ?? '') == 'Pain or discomfort during urination' ? 'selected' : '' }}>
                                Pain or discomfort during urination</option>
                            <option value="Nocturnal enuresis"
                                {{ old('Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination', $Miscellaneous->urinary_issues ?? '') == 'Nocturnal enuresis' ? 'selected' : '' }}>
                                Nocturnal enuresis</option>
                        </select>
                    </div>

                    <!-- Question No. 58: Menstrual Abnormality -->
                    <div class="form-group col-md-6">
                        <label for="any_menstrual_abnormality">Question No.58: Any menstrual abnormality.</label><br>
                        <select class="form-control" id="any_menstrual_abnormality"
                            name="QuestionNo_58_Any_menstrual_abnormality" required>
                            <option value="">Select</option>
                            <option value="Yes"
                                {{ old('QuestionNo_58_Any_menstrual_abnormality', $Miscellaneous->menstrual_abnormality ?? '') == 'Yes' ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="No"
                                {{ old('QuestionNo_58_Any_menstrual_abnormality', $Miscellaneous->menstrual_abnormality ?? '') == 'No' ? 'selected' : '' }}>
                                No</option>
                        </select>
                    </div>

                    <!-- Specify Menstrual Abnormality -->
                    <div class="form-group col-md-6">
                        <div
                            class="form-group any_menstrual_abnormality_specify {{ old('QuestionNo_58_Any_menstrual_abnormality', $Miscellaneous->QuestionNo_58_Any_menstrual_abnormality ?? '') == 'Yes' ? '' : 'd-none' }}">
                            <label for="any_menstrual_abnormality">Specify Menstrual Abnormality</label><br>
                            <input type="text" name="Any_menstrual_abnormality_specify" class="form-control"
                                id="any_menstrual_abnormality_specify" placeholder="Please specify menstrual abnormality"
                                value="{{ old('Any_menstrual_abnormality_specify', $Miscellaneous->Any_menstrual_abnormality_specify ?? '') }}"><br>
                        </div>
                    </div>

                    <!-- Comments/Findings -->
                    <div class="form-group col-md-6">
                        <label for="comment">Comment/Findings</label><br>
                        <textarea name="miscellaneous_comment" placeholder="Comment here" cols="50" required>{{ old('miscellaneous_comment', $Miscellaneous->miscellaneous_comment ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>






            <button type="Submit" class="btn btn-primary">Submit</button>





        </form>




    </div>
@endsection



@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {

            console.log("READY");


            let currentStep = 1; // Initialize the current step

            // Function to show only the current step
            function showStep(step) {
                $(".step").hide(); // Hide all steps
                $(`#step${step}`).show(); // Show the current step
            }

            // Initially, show only the first step
            showStep(currentStep);


            $("#screeningForm").validate({
                errorElement: "span",
                errorClass: "error-message",
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function(form) {
                    form.submit(); // Submit the form
                }
            });


            // Next Step Button Click
            $(".nextStep").click(function() {
                // Validate the current step
                if ($("#screeningForm").valid()) {
                    currentStep++;
                    showStep(currentStep); // Show the next step
                } else {
                    // If validation fails, it will show errors
                    $("#screeningForm").valid();
                }
            });

            // Previous Step Button Click
            $(".prevStep").click(function() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep); // Show the previous step
                }
            });


            /* // Auto-calculate BMI */

            $("#height, #weight").on("input", function() {
                let height = parseFloat($("#height").val());
                let weight = parseFloat($("#weight").val());

                // Check if both height and weight are positive numbers
                if (height > 0 && weight > 0) {
                    // Calculate BMI using the formula: weight / height^2
                    let bmi = (weight / ((height / 100) ** 2)).toFixed(2);
                    $("#bmi").val(bmi); // Update BMI field

                    // Check if the BMI is in the abnormal range (underweight or overweight)
                    if (bmi <= 18.4 || bmi >= 24.10) {
                        $("#bmi").addClass("bg-danger");
                        $("#bmishow").text("High");
                        $("#bmiresult").val('High');
                    } else {
                        $("#bmi").removeClass("bg-danger");
                        $("#bmishow").text("Normal");
                        $("#bmiresult").val('Normal');
                    }
                } else {
                    // Reset the BMI field and remove highlights if inputs are invalid
                    $("#bmi").val("");
                    $("#bmishow").text("");
                    $("#bmiresult").val("");
                    $("#bmi").removeClass("bg-danger");
                }
            });



            /* // Event listener for date of birth field */
            $("#dob").on("change", function() {
                let dob = new Date($(this).val()); // Get the selected date
                let today = new Date(); // Get the current date

                /* // Calculate the age */
                let age = today.getFullYear() - dob.getFullYear();
                let monthDiff = today.getMonth() - dob.getMonth();
                let dayDiff = today.getDate() - dob.getDate();

                /* // Adjust age if the birthday hasn't occurred yet this year */
                if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                    age--;
                }

                /* // Set the calculated age in the age input field */
                if (!isNaN(age) && age >= 0) {
                    $("#age").val(age);
                } else {
                    $("#age").val(""); // Clear age if DOB is invalid
                }
            });



            /* Blood Pressure (Systolic) */

            $(document).on("keyup change", "#Question_No_5_Blood_Pressure_Systolic", function(e) {

                var systolic = parseInt($('#Question_No_5_Blood_Pressure_Systolic').val());
                var age = parseInt($('#age').val());


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


            $("#Question_No_5_Blood_Pressure_Systolic").change();



            /* Blood Pressure (Diastolic) */
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


            $("#Question_No_6_Blood_Pressure_Diastolic").change();



            /* Throat Examination */


            // Handle Lymph Node visibility
            $('#lymph_node').on('change', function() {
                const lymphNodeSpecify = $('.lymph_node_specify');
                if ($(this).val() === 'abnormal') {
                    lymphNodeSpecify.removeClass('d-none');
                } else {
                    lymphNodeSpecify.addClass('d-none');
                    $('#Specify_lymph_node').val(''); // Clear input
                }
            });

            // Trigger change to initialize the lymph node visibility based on pre-selected value
            $('#lymph_node').change();

            // Handle Neck Swelling visibility
            $('#any_neck_swelling').on('change', function() {
                const neckSwellingSpecify = $('.any_neck_swelling_specify');
                if ($(this).val() === 'Yes') {
                    neckSwellingSpecify.removeClass('d-none');
                } else {
                    neckSwellingSpecify.addClass('d-none');
                    $('#Specify_Any_Neck_swelling').val(''); // Clear input
                }
            });

            // Trigger change to initialize the neck swelling visibility based on pre-selected value
            $('#any_neck_swelling').change();




            /* Step twelve */


            $('#any_history_of_abdominal_pain').change(function() {
                if ($(this).val() === 'Yes') {
                    $('.any_history_of_abdominal_pain_specify').removeClass('d-none');
                    $('.any_history_of_abdominal_pain_specify').addClass('d-block');

                } else {
                    $('.any_history_of_abdominal_pain_specify').addClass('d-none');
                    $('.any_history_of_abdominal_pain_specify').removeClass('d-block');

                    $('#any_history_of_abdominal_pain_specify').val(''); // Clear input

                }


            });



            /* Step thirdteen */

            /* Musculoskeletal */

            // Set the initial state on page load
            var initialResult = $('#limitations_range_motion').val();
            toggleLimitationsField(initialResult);

            // Handle dropdown change
            $('#limitations_range_motion').on('change', function() {
                var result = $(this).val();
                toggleLimitationsField(result);
            });

            // Function to show or hide the field and clear its value when hidden
            function toggleLimitationsField(result) {
                if (result === 'Yes') {
                    $('.limitations_range_motion_specify').removeClass('d-none');
                } else {
                    $('.limitations_range_motion_specify').removeClass('d-block');
                    $('.limitations_range_motion_specify').addClass('d-none');
                    $('#limitations_range_motion_specify').val(''); // Clear the field
                }
            }



            /* Step Fourteen */

            // Handle initial visibility of the reason field
            var initialResult = $('#immunization_card').val();
            toggleImmunizationReason(initialResult);

            // Handle dropdown change for immunization card
            $('#immunization_card').on('change', function() {
                var result = $(this).val();
                toggleImmunizationReason(result);
            });

            // Function to toggle visibility of the reason field
            function toggleImmunizationReason(result) {
                if (result === 'No') {
                    $('.immunization_card_specify').removeClass('d-none');
                } else {
                    $('.immunization_card_specify').addClass('d-none');
                    $('.immunization_card_specify').removeClass('d-block');
                    $('#Reason_of_not_being_vaccinated').val(''); // Clear the field
                }
            }



            /* Step Fifteen */

            /* Miscellaneous */

            // Toggle "Specify Allergies" field visibility
            $('#do_you_have_any_Allergies').change(function() {
                if ($(this).val() == 'Yes') {
                    $('.do_you_have_any_Allergies_specify').removeClass('d-none');
                } else {
                    $('.do_you_have_any_Allergies_specify').addClass('d-none');
                }
            });

            // Toggle "Specify Menstrual Abnormality" field visibility
            $('#any_menstrual_abnormality').change(function() {
                if ($(this).val() == 'Yes') {
                    $('.any_menstrual_abnormality_specify').removeClass('d-none');
                } else {
                    $('.any_menstrual_abnormality_specify').addClass('d-none');
                }
            });


            // jQuery validation to ensure the age of menarche is between 1 and 100
            $('#menarche_age').on('input', function() {
                var age = $(this).val();
                if (age > 100) {
                    $('#menarche_age_error').show();
                    $(this).val(100); // Automatically set the value to 100 if it's greater
                } else {
                    $('#menarche_age_error').hide();
                }
            });

            // Auto-color Body Temperature: green for 96–99.1°F, red otherwise
            function setTempColorStudent() {
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
            setTempColorStudent();
            $('#Question_No_4_Body_Temperature').on('input change blur', setTempColorStudent);


        });
    </script>
@endsection
