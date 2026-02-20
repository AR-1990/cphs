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





        .bg_secondary {
            background-color: #e7e7e7 !important;
        }

        .form-group h5 {
            border-bottom: 1px solid;
            width: fit-content;
        }

        select[disabled] {
            background-color: #e9ecef;
            /* Light gray background to indicate disabled state */
            color: #6c757d;
            /* Gray text color */
            cursor: not-allowed;
            /* Change cursor to indicate disabled state */
        }


        select:disabled {
            appearance: none;
            /* Removes the default arrow in most browsers */
            -webkit-appearance: none;
            /* For Safari and Chrome */
            -moz-appearance: none;
            /* For Firefox */
            background: #e9ecef;
            /* Optional: to match default disabled background */
            pointer-events: none;
            /* Prevent interactions */
            position: relative;
        }

        select:disabled::-ms-expand {
            display: none;
            /* For Internet Explorer */
        }

        .box_style {
            box-shadow: 0 0 20px #0002;
            padding: 2.5rem;
            border-radius: 1.5rem;
            margin-bottom: 2rem;
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
    </style>
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">
                        Screening Detail
                    </h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Detail

                        </li>

                    </ol>

                </div>
            </div>

        </div>
    </div>

    <!-- Page Content -->

    <div class="container page__container page__container page-section">

        {{-- <a class="" href="{{ url('/export_data') }}"><button class="btn btn-primary ml-auto d-block">Excel</button></a> --}}
        <div class="page-separator">
            <div class="page-separator__text">Detail</div>
        </div>
        <div class="col-md-12">

            <a href="{{ route('download.pdf', ['id' => $form_id]) }}" class="btn btn-primary mr-2">View Report</a>
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#sendMailModal" id="downloadPDF2">Send Mail
            </button>


            <div class="table-responsive">
                <div class="container-fluid mt-4">
                    <div class="row">
                        <div class="row rounded py-3">
                            <div class="col-12">
                                <div class="data_heading">
                                    <h3>Bio Data</h3>
                                </div>
                            </div>
                            <div class="col-12 box_style">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <h5>Name : {{ $details['name'] }}</h5>
                                            {{-- <input type="text" class="form-control" id="name" name="name"
                                        value="{{$details['name']}}" disabled> --}}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <h5>Date Of Birth : {{ $details['dob'] }}</h5>
                                            <input type="hidden" class="form-control" id="dob" name="dob"
                                                value="{{ $details['dob'] }}" disabled>
                                        </div>
                                    </div>
                                                   
                                              @php
                                         $renderAge = '';
                                         if (!empty($details['dob'])) {
                                             $dob = \Carbon\Carbon::parse($details['dob']);
                                             $now = \Carbon\Carbon::now();
                                             $diff = $dob->diff($now);
                                             $years = $diff->y;
                                             $months = $diff->m;
                                             $renderAge = $years . ':' . str_pad($months, 2, '0', STR_PAD_LEFT);
                                         } else {
                                             $renderAge = isset($details['age']) && $details['age'] !== '' ? $details['age'] . ':00' : '';
                                         }
                                     @endphp
                                           
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <h5>Age : {{ $renderAge }}</h5>
                                           

                                            

                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">


                                            @php
                                            $classLabels = [
                                                "0" => "Play group",
                                                '0000' => 'Nursery',
                                                "00" => "KG-1",
                                                "000" => "KG-2"
                                            ];
                                       @endphp
                                


                                        <h5>Class : {{ $classLabels[$details['class']] ?? $details['class'] }}</h5>

                                        
                                            {{-- <label for="class">Class</label> --}}
                                            <input type="hidden" class="form-control" id="class" name="class"
                                                value="{{ $details['class'] }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <h5>GR Number : {{ $details['gr_number'] }}</h5>
                                            <input type="hidden" class="form-control" id="gr_number" name="gr_number"
                                            value="{{$details['gr_number']}}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <h5>MR Number : {{ $details['mrr'] }}</h5>
                                            {{-- <input type="text" class="form-control" id="Mr_Number" name="Mr_Number"
                                            value="{{$details['mrr']}}" disabled> --}}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <h5>Guardian Name : {{ $details['guardianname'] }}</h5>
                                            {{-- <input type="text" class="form-control" id="guardianname" name="guardianname"
                                        value="{{$details['guardianname']}}" disabled> --}}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h5>Address : {{ $details['address'] }}</h5>
                                        {{-- <input type="text" class="form-control" id="address" name="Address"
                                        value="{{$details['address']}}" disabled> --}}
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <h5>Blood Group : {{ $details['blood_group'] }}</h5>
                                            {{-- <input type="text" name="blood_group" id="blood_group" class="form-control"
                                            value="{{ $details['blood_group']}}" disabled> --}}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <h5>Gender : {{ $details['gender'] }}</h5>

                                            {{-- <label for="gender">Gender</label> --}}
                                            <input type="hidden" name="gender" id="gender" class="form-control"
                                                value="{{ $details['gender'] }}" disabled>
                                        </div>
                                    </div>

                                    {{--
                                <div class="form-group col-md-12">

                                    <div class="form-group">
                                        <label for="school">School</label>
                                        @foreach ($school as $item)
                                            @if ($details['school'] == $item->id)
                                                <input type="text" name="school" id="school" class="form-control"
                                                value="{{$item->school_name}}" disabled>
                                            @endif
                                        
                                    @endforeach
                                       
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        @foreach ($city as $item)
                                            @if ($details['city'] == $item->id)
                                                <input type="text" name="city" id="city" class="form-control"
                                                value="{{$item->name}}" disabled>
                                            @endif
                                        
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group col-md-12">

                                    <div class="form-group">
                                        <label for="area">Area</label>
                                        @foreach ($area as $item)
                                            @if ($details['area'] == $item->id)
                                                <input type="text" name="area" id="area" class="form-control"
                                                value="{{$item->name}}" disabled>
                                            @endif                                        
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                        value="{{$details['dob']}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="text" class="form-control" id="age" name="age"
                                            value="{{$details['age']}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="contact">Emergency Contact Number</label>
                                        <input type="text" class="form-control" id="Emergency_Contact_Number"
                                            name="Emergency_Contact_Number" value="{{$details['emergency_contact_number']}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="contact">GR Number</label>
                                        <input type="text" class="form-control" id="Gr_Number" name="Gr_Number"
                                            value="{{$details['gr_number']}}" disabled>
                                    </div> 
                                </div> --}}
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Medical_condition">Any Known Medical Condition</label>
                                            <input type="text" class="form-control" id="Any_Known_Medical_Condition"
                                                name="Any_Known_Medical_Condition"
                                                value="{{ $details['any_known_medical_condition'] }}" disabled>
                                        </div>
                                    </div>




                                    <div class="form-roup col-md-12">
                                        <div class="form-group">
                                            <label for="comment">Comment/Findings</label><br>
                                            <input type="text" name="bio_data_comment" id="bio_data_comment"
                                                class="form-control" value="{{ $details['bio_data_comment'] }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Vitals/BMI</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group height">
                                        <div class="group-form">
                                            <label for="height" class="width-100">Question No.1: Height :cm(s)</label>
                                            <input type="text" class="form-control" id="height"
                                                name="Question_No_1_Weight" value="{{ $details['question_no_1_height'] }}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">

                                    <div class="form-group weight">
                                        <div class="group-form">
                                            <label for="weight" class="w-100">Question No.2: Weight :kg(s)
                                                <input type="text" class="form-control" id="weight"
                                                    name="Question_No_2_Weight"
                                                    value="{{ $details['question_no_2_weight'] }}" disabled>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="bmi">Question No.3: BMI (Red field means abnomality )</label>
                                        <input type="text" class="form-control" id="bmi"
                                            name="Question_No_3_BMI" value="{{ $details['question_no_3_bmi'] }}"
                                            disabled>

                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="temp">Question No.4: Body Temperature</label>
                                        <input type="text" class="form-control" id="temp"
                                            name="Question_No_4_Body_Temperature"
                                            value="{{ $details['question_no_4_body_temperature'] }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="blood">Question No.5: Blood Pressure (Systolic) (Red field means
                                            abnomality )</label>
                                        <span id="Blood_Pressure_Systolic"></span>
                                        <input type="text" class="form-control"
                                            id="Question_No_6_Blood_Pressure_Systolic"
                                            name="Question_No_5_Blood_Pressure_Systolic"
                                            value="{{ $details['question_no_5_blood_pressure_systolic'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="blood">Question No.6: Blood Pressure (Diastolic) (Red field means
                                            abnomality )</label>
                                        <span id="Blood_Pressure_Diastolic"></span>
                                        <input type="text" class="form-control"
                                            id="Question_No_6_Blood_Pressure_Diastolic"
                                            name="Question_No_6_Blood_Pressure_Diastolic"
                                            value="{{ $details['question_no_6_blood_pressure_diastolic'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="pulse">Question No.7: Pulse (Red field means abnomality )</label>
                                        <input type="text" class="form-control" id="Question_No_7_Pulse"
                                            name="Question_No_7_Pulse" value="{{ $details['question_no_7_pulse'] }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="comment">Comment/Findings</label><br>
                                        <input type="text" name="vitals_bmi_comment" id="comment"
                                            class="form-control" value="{{ $details['vitals_bmi_comment'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>General Apperance</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="field2">Question No.8: Normal Posture/Gait</label><br>
                                        <input type="text" name="Question_No_8_Normal_Posture_Gait" id="Posture"
                                            class="form-control"
                                            value="{{ $details['question_no_8_normal_posture_gait'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Mentalstatus">Question No.9: Mental Status</label><br>
                                        <input type="text" name="Question_No_9_Mental_Status" id="Mentalstatus"
                                            class="form-control" value="{{ $details['question_no_9_mental_status'] }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="jaundice">Question No.10: Look For jaundice</label><br>
                                        <input type="text" name="Question_No_10_Look_For_jaundice" id="jaundice"
                                            class="form-control"
                                            value="{{ $details['question_no_10_look_for_jaundice'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="anemia">Question No.11: Look For anemia</label><br>
                                        <input type="text" name="Question_No_11_Look_For_anemia" id="anemia"
                                            class="form-control" value="{{ $details['question_no_11_look_for_anemia'] }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="clubbing">Question No.12: Look For Clubbing</label><br>
                                        <input type="text" name="Question_No_12_Look_For_Clubbing" id="clubbing"
                                            class="form-control"
                                            value="{{ $details['question_no_12_look_for_clubbing'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="cyanosis">Question No.13: Look for Cyanosis</label><br>
                                        <input type="text" name="Question_No_13_Look_for_Cyanosis" id="cyanosis"
                                            class="form-control"
                                            value="{{ $details['question_no_13_look_for_cyanosis'] }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="skin">Question No.14: Skin</label><br>
                                        <input type="text" name="Question_No_14_Skin" id="skin"
                                            class="form-control" value="{{ $details['question_no_14_skin'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="breath">Question No.15: Breath</label><br>
                                        <input type="text" name="Question_No_15_Breath" id="breath"
                                            class="form-control" value="{{ $details['question_no_15_breath'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="comment">Comment/Findings</label><br>
                                        <input type="text" name="general_apperance_comment" id="comment"
                                            class="form-control" value="{{ $details['general_apperance_comment'] }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Inspect Hygiene </h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Nails">Question No.16: Nails</label><br>
                                        <input type="text" name="Question_No_16_Nails" id="Nails"
                                            class="form-control" value="{{ $details['question_no_16_nails'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Uniform-or-shoes">Question No.17: Uniform or shoes</label><br>
                                        <input type="text" name="Question_No_17_Uniform_or_shoes" id="Uniform-or-shoes" class="form-control" value="{{ $details['question_no_17_uniform_or_shoes']}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Lice/nits">Question No.18: Lice/nits</label><br>
                                        <input type="text" name="Question_No_18_Lice_nits" id="Lice_nits"
                                            class="form-control" value="{{ $details['question_no_18_lice_nits'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="field2">Question No.19: Discuss hygiene routines and practices.</label><br>
                                        <input type="text" name="Question_No_19_Discuss_hygiene_routines_and_practices" id="field2" class="form-control" value="{{ $details['question_no_19_discuss_hygiene_routines_and_practices']}}" disabled>

                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="comment">Comment/Findings</label><br>
                                        <input type="text" name="inspect_hygiene_comment" id="comment"
                                            class="form-control" value="{{ $details['inspect_hygiene_comment'] }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Head and Neck examination</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="hair_and_scalp">Question No:20 Hair and Scalp</label><br>
                                        <input type="text" name="Question_No_20_Hair_and_Scalp" id="hair_and_scalp"
                                            class="form-control" value="{{ $details['question_no_20_hair_and_scalp'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_21_Any_Hair_Problem">Question No.21: Any Hair
                                            Problem</label><br>
                                        <input type="text" name="Question_No_21_Any_Hair_Problem"
                                            id="Question_No_21_Any_Hair_Problem" class="form-control"
                                            value="{{ $details['question_no_21_any_hair_problem'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_22_Sclap">Question No.22: Scalp</label><br>
                                        <input type="text" name="Question_No_22_Sclap" id="Question_No_22_Sclap"
                                            class="form-control" value="{{ $details['question_no_22_sclap'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_23_Hair_distribution">Question No.23: Hair
                                            distribution</label><br>
                                        <input type="text" name="Question_No_23_Hair_distribution"
                                            id="Question_No_23_Hair_distribution" class="form-control"
                                            value="{{ $details['question_no_23_hair_distribution'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="head_and_neck_examination_comment">Comment/Findings</label><br>
                                        <input type="text" name="head_and_neck_examination_comment"
                                            id="head_and_neck_examination_comment" class="form-control"
                                            value="{{ $details['head_and_neck_examination_comment'] }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Eye:</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                               <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="normal_ocular_alignment">Question No.24: Visual acuity using Snellen’s (Right Eye)
                                                chart</label><br>
                                            <input type="text" id="Question_No_24_Visual_acuity_using_Snellen’s_chart"
                                                name="Question_No_24_Visual_acuity_using_Snellen’s_chart" class="form-control"
                                                value="{{ $details['question_no_24_visual_acuity_using_snellens_chart'] }}"
                                                disabled>
                                        </div>
                                    </div> 
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="normal_ocular_alignment">Question No.24: Visual acuity using Snellen’s (Left Eye)
                                                chart</label><br>
                                            <input type="text" id="Question_No_24_Visual_acuity_using_Snellen’s_chart"
                                                name="Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye" class="form-control"
                                                value="{{ $details['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] }}"
                                                disabled>
                                        </div>
                                    </div> 
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_25_Normal_ocular_alignment">Question No.25: Normal ocular
                                            alignment</label><br>
                                        <input type="text" id="Question_No_25_Normal_ocular_alignment"
                                            name="Question_No_25_Normal_ocular_alignment" class="form-control"
                                            value="{{ $details['question_no_25_normal_ocular_alignment'] }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_26_Normal_eye_inspection">Question No.26: Normal eye
                                            inspection</label><br>
                                        <input type="text" id="Question_No_26_Normal_eye_inspection"
                                            name="Question_No_26_Normal_eye_inspection" class="form-control"
                                            value="{{ $details['question_no_26_normal_eye_inspection'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Question_No_27_Normal_Color_vision">Question No.27: Normal Color
                                                vision</label><br>
                                            <input type="text" id="Question_No_27_Normal_Color_vision"
                                                name="Question_No_27_Normal_Color_vision" class="form-control"
                                                value="{{ $details['question_no_27_normal_color_vision'] }}" disabled>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_28_Nystagmus">Question No.28: Nystagmus</label><br>
                                        <input type="text" id="Question_No_28_Nystagmus"
                                            name="Question_No_28_Nystagmus" class="form-control"
                                            value="{{ $details['question_no_28_nystagmus'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="eye_comment">Comment/Findings</label><br>
                                        <input type="text" name="eye_comment" id="eye_comment" class="form-control"
                                            value="{{ $details['eye_comment'] }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Ears:</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_29_Normal_ears_shape_and_position">Question No.29: Normal
                                            ears shape and position</label><br>
                                        <input type="text" name="Question_No_29_Normal_ears_shape_and_position"
                                            id="Question_No_29_Normal_ears_shape_and_position" class="form-control"
                                            value="{{ $details['question_no_29_normal_ears_shape_and_position'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Right_ear">Question No.30: Ear examination</label><br>
                                        <input type="text" name="Question_No_30_Ear_examination" id="Right_ear"
                                            class="form-control" value="{{ $details['question_no_30_ear_examination'] }}"
                                            disabled>

                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_31_Conclusion_of_hearing">Question No.31: Conclusion of
                                            hearing test with Rinner and
                                            Weber</label><br>
                                        <input type="text" name="Question_No_31_Conclusion_of_hearing"
                                            id="Question_No_31_Conclusion_of_hearing" class="form-control"
                                            value="{{ $details['question_no_31_conclusion_of_hearing_test_with_rinner_and_weber'] }}"
                                            disabled>

                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="ears_comment">Comment/Findings</label><br>
                                        <input type="text" name="ears_comment" id="ears_comment" class="form-control"
                                            value="{{ $details['ears_comment'] }}" disabled>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Nose:</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row align-items-end">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_32_External_inasal_examinaton">Question No.32:External
                                            nasal examinaton</label><br>
                                        <input type="text" name="Question_No_32_External_inasal_examinaton"
                                            id="Question_No_32_External_inasal_examinaton" class="form-control"
                                            value="{{ $details['question_no_32_external_nasal_examinaton'] }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_33_perform">Question No.33:perform a nasal patency test
                                            [which involves gently closing one nostril at a time to assess the patient's
                                            ability to breathe through each nostril]</label><br>
                                        <input type="text" name="Question_No_33_perform" id="Question_No_33_perform"
                                            class="form-control"
                                            value="{{ $details['question_no_33_perform_a_nasal_patency'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="nose_comment">Comment/Findings</label><br>
                                        <input type="text" name="nose_comment" id="nose_comment" class="form-control"
                                            value="{{ $details['nose_comment'] }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step" id="step16">
                <h3>Lead Exposure</h3>
                <div class="form-row">
                    <!-- Question 48 -->
                    <div class="form-group col-md-6">
                        <label for="Question_No_48_Frequently_put_things_in_mouth">Question No. 48: Do you Frequently put things in his/her mouth such as toys, jewelry, or keys?</label>
                        <select class="form-control" id="Question_No_48_Frequently_put_things_in_mouth"
                            name="Question_No_48_Frequently_put_things_in_mouth" required disabled>
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
                            name="Question_No_49_Child_eat_non_food_items_pica" required disabled>
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
                            name="Question_No_50_Contact_adult_job_lead_exposure" required disabled>
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
                            name="Question_No_51_Contact_adult_hobby_lead_exposure" required disabled>
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

                    <!-- Comment -->
                    <div class="form-group col-md-12">
                        <label for="lead_exposure_comment">Comment/Findings</label>
                        <textarea name="lead_exposure_comment" id="lead_exposure_comment" class="form-control" placeholder="Comment here" cols="50" disabled>{{ isset($_GET['lead_exposure_comment']) ? $_GET['lead_exposure_comment'] : (isset($details['lead_exposure_comment']) ? $details['lead_exposure_comment'] : old('lead_exposure_comment')) }}</textarea>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                
            </div>


                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Oral:</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_34_Assess_gingiva">Question No.34: Assess
                                            gingiva</label><br>
                                        <input type="text" name="Question_No_34_Assess_gingiva"
                                            id="Question_No_34_Assess_gingiva" class="form-control"
                                            value="{{ $details['question_no_34_assess_gingiva'] }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_35_Are_there_dental_caries">Question No.35: Are there
                                            dental caries</label><br>
                                        <input type="text" name="Question_No_35_Are_there_dental_caries"
                                            id="Question_No_35_Are_there_dental_caries" class="form-control"
                                            value="{{ $details['question_no_35_are_there_dental_caries'] }}" disabled>

                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="oral_comment">Comment/Findings</label><br>
                                        <input type="text" name="oral_comment" id="oral_comment" class="form-control"
                                            value="{{ $details['oral_comment'] }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Throat:</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_36_Examine_tonsils">Question No.36: Examine tonsils</label>
                                        <input type="text" name="Question_No_36_Examine_tonsils"
                                            id="Question_No_36_Examine_tonsils" class="form-control"
                                            value="{{ $details['question_no_36_examine_tonsils'] }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_37_Normal_Speech_development">Question No.37: Normal Speech
                                            development</label><br>
                                        <input type="text" name="Question_No_37_Normal_Speech_development"
                                            id="Question_No_37_Normal_Speech_development" class="form-control"
                                            value="{{ $details['question_no_37_normal_speech_development'] }}" disabled>

                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="any_neck_swelling">Question No.38:Any Neck swelling </label><br>
                                        <input type="text" name="any_neck_swelling" id="any_neck_swelling"
                                            class="form-control"
                                            value="{{ $details['question_no_38_any_neck_swelling'] }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="lymph_node">Question No.39: Examine lymph node</label><br>
                                        <input type="text" name="lymph_node" id="lymph_node" class="form-control"
                                            value="{{ $details['question_no_39_examine_lymph_node'] }}" disabled>

                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Specify_lymph_node">Specify lymph node</label><br>
                                        <input type="text" name="Specify_lymph_node" id="Specify_lymph_node"
                                            class="form-control" value="{{ $details['specify_lymph_node'] }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="any_neck_swelling">Specify Any Neck swelling</label><br>
                                        <input type="text" name="any_neck_swelling" id="any_neck_swelling"
                                            class="form-control" value="{{ $details['specify_any_neck_swelling'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="throat_comment">Comment/Findings</label><br>
                                        <input type="text" name="throat_comment" id="throat_comment"
                                            class="form-control" value="{{ $details['throat_comment'] }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Chest:</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_40_Any_visible_chest_deformity">Question No.40 Any visible
                                            chest deformity</label><br>
                                        <input type="text" name="Question_No_40_Any_visible_chest_deformity"
                                            id="Question_No_40_Any_visible_chest_deformity" class="form-control"
                                            value="{{ $details['question_no_40_any_visible_chest_deformity'] }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_41_Lung_Auscultation">Question No.41 Lung
                                            Auscultation</label><br>
                                        <input type="text" name="Question_No_41_Lung_Auscultation"
                                            id="Question_No_41_Lung_Auscultation" class="form-control"
                                            value="{{ $details['question_no_41_lung_auscultation'] }}" disabled>
                                    </div>
                                </div>



                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_42_Cardiac_Auscultation">Question No.42: Cardiac
                                            Auscultation</label><br>
                                        <input type="text" name="Question_No_42_Cardiac_Auscultation"
                                            id="Question_No_42_Cardiac_Auscultation" class="form-control"
                                            value="{{ $details['question_no_42_cardiac_auscultation'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="chest_comment">Comment/Findings</label><br>
                                        <input type="text" name="chest_comment" id="chest_comment"
                                            class="form-control" value="{{ $details['chest_comment'] }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Abdomen:</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="distention_scar_mass">
                                            Question No.43: Did you observe any distension, scars, or masses on the child's
                                            abdomen?</label><br>
                                        <input type="text" name="distention_scar_mass" id="distention_scar_mass"
                                            class="form-control"
                                            value="{{ $details['question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'] }}"
                                            disabled>
                                    </div>
                                    <div class="form-group col-md-12">
                                            <label for="any_history_of_abdominal_pain">Question No.44 Any history of abdominal
                                                Pain</label><br>
                                            <input type="text" name="any_history_of_abdominal_pain"
                                                id="any_history_of_abdominal_pain" class="form-control"
                                                value="{{ $details['question_no_44_any_history_of_abdominal_pain'] }}"
                                                disabled>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="any_history_of_abdominal_pain_specify">Specify Abdominal
                                                    Pain</label><br>
                                                <input type="text" name="any_history_of_abdominal_pain_specify"
                                                    id="any_history_of_abdominal_pain_specify" class="form-control"
                                                    value="{{ $details['any_history_of_abdominal_pain_specify'] }}" disabled>
                                            </div>
                                        </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="abdomen_comment">Comment/Findings</label><br>
                                            <input type="text" name="abdomen_comment" id="abdomen_comment"
                                                class="form-control" value="{{ $details['abdomen_comment'] }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Musculoskeletal</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="limitations_range_motion">Question No.45: Did you observe any
                                            limitations in the child's range of
                                            joint motion during your examination?*</label><br>
                                        <input type="text" name="limitations_range_motion"
                                            id="limitations_range_motion" class="form-control"
                                            value="{{ $details['question_no_45_did_you_observe_any_limitations_in_the_childs_range_of_joint_motion_during_your_examination'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Specify_limitations_in_the_child">Specify limitations in the child's
                                            range of joint motion during
                                            your examination?*</label><br>
                                        <input type="text" name="Specify_limitations_in_the_child"
                                            id="Specify_limitations_in_the_child" class="form-control"
                                            value="{{ $details['specify_limitations_in_the_childs_range_of_joint_motion_during_your_examination'] }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="spinal_curvature_assessment">Question No.46: Spinal curvature
                                            assessment (tick positive finding) </label><br>
                                        <input type="text" name="spinal_curvature_assessment"
                                            id="spinal_curvature_assessment" class="form-control"
                                            value="{{ $details['question_no_46_spinal_curvature_assessment_tick_positive_finding'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="curvature_spine_resembling">Question No.47: side-to-side curvature in
                                            the spine resembling </label><br>
                                        <input type="text" name="curvature_spine_resembling"
                                            id="curvature_spine_resembling" class="form-control"
                                            value="{{ $details['question_no_47_side-to-side_curvature_in_the_spine_resembling'] }}"
                                            disabled>
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="adams_forward_bend_test">Question No.48: Adams forward bend
                                            test</label><br>
                                        <input type="text" name="adams_forward_bend_test" id="adams_forward_bend_test"
                                            class="form-control"
                                            value="{{ $details['question_no_48_adams_forward_bend_test'] }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="foot_or_toe_abnormalities">Question No.49: Any foot or toe
                                            abnormalities</label><br>
                                        <input type="text" name="foot_or_toe_abnormalities"
                                            id="foot_or_toe_abnormalities" class="form-control"
                                            value="{{ $details['question_no_49_any_foot_or_toe_abnormalities'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="musculoskeletal_comment">Comment/Findings</label><br>
                                        <input type="text" name="musculoskeletal_comment" id="musculoskeletal_comment"
                                            class="form-control" value="{{ $details['musculoskeletal_comment'] }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Vaccination:</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Question_No_50_Have_EPI_immunization_card">Question No.50: Have EPI
                                            immunization card?</label><br>
                                        <input type="text" name="Question_No_50_Have_EPI_immunization_card"
                                            id="Question_No_50_Have_EPI_immunization_card" class="form-control"
                                            value="{{ $details['question_no_50_have_epi_immunization_card'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="Reason_of_not_being_vaccinated">Reason of not being
                                            vaccinated</label><br>
                                        <input type="text" name="Reason_of_not_being_vaccinated"
                                            id="Reason_of_not_being_vaccinated" class="form-control"
                                            value="{{ $details['reason_of_not_being_vaccinated'] }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="BCG_1_dose">Question No.50: Mark all the vaccinations that are
                                            completed</label><br>
                                        <input type="text" name="BCG_1_dose" id="BCG_1_dose" class="form-control"
                                            value="{{ $details['BCG_1_dose'] }}, {{ $details['OPV_4_dose'] }}, {{ $details['Pentavalent_vaccine_DTP'] }}, {{ $details['rota'] }}, {{ $details['measles'] }}, {{ $details['never_had_any_vaccination'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="vaccination_comment">Comment/Findings</label><br>
                                        <input type="text" name="vaccination_comment" id="vaccination_comment"
                                            class="form-control" value="{{ $details['vaccination_comment'] }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="data_heading">
                                <h3>Lead exposure</h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="Question_51_Do_you_Frequently_put_things_in_his">
                                        Question.51:Do you Frequently put things in his/her mouth such as toys, jewelry, or
                                        keys?</label>
                                    <input type="text" name="Question_51_Do_you_Frequently_put_things_in_his"
                                        id="Question_51_Do_you_Frequently_put_things_in_his" class="form-control"
                                        value="{{ $details['question_51_do_you_frequently_put_things_in_hisher_mouth_such_as_toys_jewelry_or_keys'] }}"
                                        disabled>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="Question_52_Does_your_child">Question.52: Does your child eat non-food
                                        items(pica)?</label><br>
                                    <input type="text" name="Question_52_Does_your_child"
                                        id="Question_52_Does_your_child" class="form-control"
                                        value="{{ $details['question_52_does_your_child_eat_non_food_items_pica'] }}"
                                        disabled>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="Question_53_Do_you_frequently">Question.53: Do you frequently come in
                                        contact with an adult whose job
                                        involves exposure to lead?</label>
                                    <input type="text" name="Question_53_Do_you_frequently"
                                        id="Question_53_Do_you_frequently" class="form-control"
                                        value="{{ $details['question_53_do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead'] }}"
                                        disabled>

                                </div>
                                <div class="form-group col-md-12">
                                    <label for="Question_54_Do_you_frequently">Question.54: Do you frequently come in
                                        contact with an adult whose hobby
                                        involves exposure to lead?</label>
                                    <input type="text" name="Question_54_Do_you_frequently"
                                        id="Question_54_Do_you_frequently" class="form-control"
                                        value="{{ $details['question_54_do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead'] }}"
                                        disabled>

                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="lead_exposure_comment">Comment/Findings</label><br>
                                        <input type="text" name="lead_exposure_comment" id="lead_exposure_comment"
                                            class="form-control" value="{{ $details['lead_exposure_comment'] }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-12">
                                <div class="data_heading">
                                    <h3>Miscellaneous</h3>
                                </div>
                            </div> 
                       <div class="col-12 box_style">
                                <div class="form-row">
                                    <div class="form-group col-md-12 ">
                                        <label for="do_you_have_any_Allergies">Question No.55:Do you have any
                                            Allergies</label><br>
                                        <input type="text" name="do_you_have_any_Allergies" id="do_you_have_any_Allergies"
                                            class="form-control"
                                            value="{{ $details['question_no_55_do_you_have_any_allergies'] }}" disabled>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="Do_you_have_any_allergies_specify">Specify Allergies</label><br>
                                        <input type="text" name="Do_you_have_any_allergies_specify"
                                            id="Do_you_have_any_allergies_specify" class="form-control"
                                            value="{{ $details['do_you_have_any_allergies_specify'] }}" disabled>
                                    </div>

                                    {{-- <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Question_No_56_Girls_above_8_years_old_ask">Question No.56:Girls above
                                                8 years old ask age of Menarche:</label><br>
                                            <input type="text" name="Question_No_56_Girls_above_8_years_old_ask"
                                                id="Question_No_56_Girls_above_8_years_old_ask" class="form-control"
                                                value="{{ $details['question_no_56_girls_above_8_years_old_ask'] }}" disabled>
                                        </div>
                                    </div> --}}

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="discomfort_during_urination">Question No.57:Inquire about urinary
                                                frequency, urgency, and any pain
                                                or discomfort during urination.</label><br>
                                            <input type="text" name="discomfort_during_urination"
                                                id="discomfort_during_urination" class="form-control"
                                                value="{{ $details['question_no_57_inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination'] }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="any_menstrual_abnormality">Question No.58:Any menstrual
                                                abnormality.</label><br>
                                            <input type="text" name="any_menstrual_abnormality"
                                                id="any_menstrual_abnormality" class="form-control"
                                                value="{{ $details['questionno_58_any_menstrual_abnormality'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Any_menstrual_abnormality_specify">Specify Menstrual
                                                Abnormality</label><br>
                                            <input type="text" name="Any_menstrual_abnormality_specify"
                                                id="Any_menstrual_abnormality_specify" class="form-control"
                                                value="{{ $details['any_menstrual_abnormality_specify'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="miscellaneous_comment">Comment/Findings</label><br>
                                            <input type="text" name="miscellaneous_comment" id="miscellaneous_comment"
                                                class="form-control" value="{{ $details['miscellaneous_comment'] }}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Psychological</h3>
                            </div>
                        </div>
                        <div class="col-12 box_style">
                           

                 
                          

                            <!-- Nursery Developmental Screening (25–36.9 Months) -->
                            <div class="step last-step mb-5" id="step17">
                <div class="screener " id="pre_primary">
                    <h3 class="title">PRE-PRIMARY PSYCHOLOGICAL SCREENER</h3>

                    <div >
                        <h4 class="subTitle mt-3">DEVELOPMENTAL SCREENING</h4>
                        <div id="playgound_developmenr" >
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
                                        <select name="QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box" class="form-control playground-cognitive" disabled>
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
                                        <select name="QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone" class="form-control playground-cognitive" disabled>
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
                                        <select name="QuestionNo_61_Can_your_child_walk_without_help" class="form-control playground-motor" disabled>
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
                                        <select name="QuestionNo_62_Can_your_child_stack_two_or_more_blocks" class="form-control playground-motor" disabled>
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
                                        <select name="QuestionNo_63_Does_your_child_point_to_objects_when_named" class="form-control playground-language" disabled>
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
                                        <select name="QuestionNo_64_Can_your_child_say_at_least_5_10_words" class="form-control playground-language" disabled>
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
                                        <select name="QuestionNo_65_Does_your_child_show_affection_to_familiar_people" class="form-control playground-social-emotional" disabled>
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
                                        <select name="QuestionNo_66_Does_your_child_get_upset_when_separated_from_you" class="form-control playground-social-emotional" disabled>
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
                                        <select name="QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon" class="form-control playground-adaptive" disabled>
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
                                        <select name="QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help" class="form-control playground-adaptive" disabled>
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
                        <div id="nursary_developmenr" >
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
                                        <select name="QuestionNo_69_Can_your_child_complete_a_simple_puzzle" class="form-control nursery-cognitive" disabled>
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
                                        <select name="QuestionNo_70_Does_your_child_match_similar_objects" class="form-control nursery-cognitive" disabled>
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
                                        <select name="QuestionNo_71_Can_your_child_jump_with_both_feet" class="form-control nursery-motor" disabled>
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
                                        <select name="QuestionNo_72_Can_your_child_draw_a_line_or_circle" class="form-control nursery-motor" disabled>
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
                                        <select name="QuestionNo_73_Can_your_child_form_2_to_3_word_phrases" class="form-control nursery-language" disabled>
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
                                        <select name="QuestionNo_74_Does_your_child_ask_simple_questions" class="form-control nursery-language" disabled>
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
                                        <select name="QuestionNo_75_Does_your_child_play_pretend" class="form-control nursery-social-emotional" disabled>
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
                                        <select name="QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings" class="form-control nursery-social-emotional" disabled>
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
                                        <select name="QuestionNo_77_Can_your_child_take_off_some_clothes_without_help" class="form-control nursery-adaptive" disabled>
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
                                        <select name="QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training" class="form-control nursery-adaptive" disabled>
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
                        <div id="kindergarten_developmenr" >
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
                                        <select name="QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors" class="form-control kindergarten-cognitive" disabled>
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
                                        <select name="QuestionNo_80_Can_your_child_follow_two_step_directions" class="form-control kindergarten-cognitive" disabled>
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
                                        <select name="QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball" class="form-control kindergarten-motor" disabled>
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
                                        <select name="QuestionNo_82_Can_your_child_use_scissors_to_cut_paper" class="form-control kindergarten-motor" disabled>
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
                                        <select name="QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object" class="form-control kindergarten-language" disabled>
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
                                        <select name="QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time" class="form-control kindergarten-language" disabled>
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
                                        <select name="QuestionNo_85_Does_your_child_play_cooperatively_with_other_children" class="form-control kindergarten-social-emotional" disabled>
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
                                        <select name="QuestionNo_86_Does_your_child_express_emotions_appropriately" class="form-control kindergarten-social-emotional" disabled>
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
                                        <select name="QuestionNo_87_Can_your_child_dress_and_undress_without_help" class="form-control kindergarten-adaptive" disabled>
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
                                        <select name="QuestionNo_88_Can_your_child_use_the_toilet_independently" class="form-control kindergarten-adaptive" disabled>
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

                    <div id="playground_kindergarten_social_emotional" >
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
                                        <select name="aches_pains" class="form-control aches_pains" disabled>
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
                                        <select name="sad_unhappy" class="form-control sad_unhappy" disabled>
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
                                        <select name="irritable_angry" class="form-control irritable_angry" disabled>
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
                                        <select name="trouble_sitting" class="form-control trouble_sitting" disabled>
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
                                        <select name="easily_distracted" class="form-control easily_distracted" disabled>
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
                                        <select name="doesnt_listen" class="form-control doesnt_listen" disabled>
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
                                        <select name="fidgets" class="form-control fidgets" disabled>
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
                                        <select name="driven_motor" class="form-control driven_motor" disabled>
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
                                        <select name="argues_talks_back" class="form-control argues_talks_back" disabled>
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
                                        <select name="difficulty_waiting" class="form-control difficulty_waiting" disabled>
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
                                        <select name="blames_others" class="form-control blames_others" disabled>
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
                                        <select name="hits_kicks_bites" class="form-control hits_kicks_bites" disabled>
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
                                        <select name="anxious_worries" class="form-control anxious_worries" disabled>
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
                                        <select name="afraid_new_things" class="form-control afraid_new_things" disabled>
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
                                        <select name="refuses_separate" class="form-control refuses_separate" disabled>
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
                                        <select name="nightmares_sleeping" class="form-control nightmares_sleeping" disabled>
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
                                        <select name="loses_temper" class="form-control loses_temper" disabled>
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['loses_temper']) ? ($_GET['loses_temper'] == 'Never' ? 'selected' : '') : (isset($details['loses_temper']) ? ($details['loses_temper'] == 'Never' ? 'selected' : '') : (old('loses_temper') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['loses_temper']) ? ($_GET['loses_temper'] == 'Sometimes' ? 'selected' : '') : (isset($details['loses_temper']) ? ($details['loses_temper'] == 'Sometimes' ? 'selected' : '') : (old('loses_temper') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['loses_temper']) ? ($_GET['loses_temper'] == 'Often' ? 'selected' : '') : (isset($details['loses_temper']) ? ($details['loses_temper'] == 'Often' ? 'selected' : '') : (old('loses_temper') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Internalizing Score</label>
                                     <input type="text" name="social_emotional_result" class="form-control" value="{{ $details['social_emotional_result'] ?? '' }}" readonly>
                                    </div>
                                </div> -->
                                                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Attention Score</label>
                                     <input type="text" name="social_emotional_Attention_result" class="form-control" value="{{ $details['social_emotional_Attention_result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Externalizing Total Score:</strong></label>
                                        <input type="text" class="form-control" name="externalizing_socialtotal_emotional_score" id="externalizing_socialtotal_emotional_score" value="{{ $details['externalizing_socialtotal_emotional_score'] ?? '' }}" readonly>
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
                                 <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Internalizing Score:</strong></label>
                                        <input type="text" class="form-control" name="social_emotional_result" id="social_emotional_result" value="{{ $details['social_emotional_result'] ?? '' }}" readonly>
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

                    <div id="playground_kindergarten_autism_spectrum" >
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
                                        <select name="eye_contact" class="form-control eye_contact" disabled>
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
                                        <select name="show_feelings" class="form-control show_feelings" disabled>
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
                                        <select name="use_gestures" class="form-control use_gestures" disabled>
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
                                        <select name="react_to_changes" class="form-control react_to_changes" disabled>
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
                                        <select name="respond_to_name" class="form-control respond_to_name" disabled>
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
                                        <select name="use_words" class="form-control use_words" disabled>
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
                                        <select name="use_facial_expressions" class="form-control use_facial_expressions" disabled>
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
                                        <select name="appropriate_activity_level" class="form-control appropriate_activity_level" disabled>
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
                                        <select name="follow_directions" class="form-control follow_directions" disabled>
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
                                        <select name="play_with_others" class="form-control play_with_others" disabled>
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
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>AUTISM SPECTRUM  </label>
                                     <textarea name="autism_spectrum_Comment" id="autism_spectrum_Comment" cols="30" rows="10">{{ isset($_GET['autism_spectrum_Comment']) ? $_GET['autism_spectrum_Comment'] : (isset($details['autism_spectrum_Comment']) ? $details['autism_spectrum_Comment'] : old('autism_spectrum_Comment')) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="screener" id="primary_secondary" >
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
                                    <select name="feel_sad" class="form-control emotional-behavior" disabled>
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
                                    <select name="easily_distracted_primary" class="form-control attention-issues" disabled>
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
                                    <select name="feel_nervous" class="form-control emotional-behavior" disabled>
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
                                    <select name="trouble_sleeping" class="form-control emotional-behavior" disabled>
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
                                    <select name="feel_lonely" class="form-control emotional-behavior" disabled>
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
                                    <select name="argue_talk_back" class="form-control behavioral-issues" disabled>
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
                                    <select name="take_things_refuse_share" class="form-control behavioral-issues" disabled>
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
                                    <select name="fight_angry_quickly" class="form-control behavioral-issues" disabled>
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
                                    <select name="dont_enjoy_things" class="form-control emotional-behavior" disabled>
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
                                    <select name="clingy_need_adults" class="form-control emotional-behavior" disabled>
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
                                    <select name="trouble_sitting_still" class="form-control attention-issues" disabled>
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
                                    <select name="dont_listen_rules" class="form-control behavioral-issues" disabled>
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['dont_listen_rules']) ? ($_GET['dont_listen_rules'] == 'Never' ? 'selected' : '') : (isset($details['dont_listen_rules']) ? ($details['dont_listen_rules'] == 'Never' ? 'selected' : '') : (old('dont_listen_rules') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['dont_listen_rules']) ? ($_GET['dont_listen_rules'] == 'Sometimes' ? 'selected' : '') : (isset($details['dont_listen_rules']) ? ($details['dont_listen_rules'] == 'Sometimes' ? 'selected' : '') : (old('dont_listen_rules') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['dont_listen_rules']) ? ($_GET['dont_listen_rules'] == 'Often' ? 'selected' : '') : (isset($details['dont_listen_rules']) ? ($details['dont_listen_rules'] == 'Often' ? 'selected' : '') : (old('dont_listen_rules') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>Internalizing  Result</label>
                                    <input type="text" name="emotional_behavior_result" class="form-control" value="{{ $details['emotional_behavior_result'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label><strong>Internalizing  Total Score:</strong></label>
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
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label for="psychological_comment"><b>Psychological Assessment Comments:</b></label><br>
                            <textarea name="psychological_comment" id="psychological_comment" placeholder="Comments will be auto-generated based on assessment scores" cols="50" rows="5" readonly>{{ isset($_GET['psychological_comment']) ? $_GET['psychological_comment'] : (isset($details['psychological_comment']) ? $details['psychological_comment'] : old('psychological_comment')) }}</textarea>
                        </div>
                    </div>
                </div>


          
            </div>

                            <div class="col-12">
                                <div class="data_heading">
                                    <h3>Nutritionist</h3>
                                </div>
                            </div>

                            <div class="col-12 NutritionistCol">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Question_No_60_How_would_you_describe_your_lifestyle">Question
                                                No.60:
                                                How would
                                                you describe your lifestyle?</label><br>
                                            <select class="form-control"
                                                id="Question_No_60_How_would_you_describe_your_lifestyle"
                                                name="Question_No_60_How_would_you_describe_your_lifestyle" required>


                                                <option value="">Select</option>
                                                <option value="Sedentary"
                                                    {{ $details['Question_No_60_How_would_you_describe_your_lifestyle'] === 'Sedentary' ? 'selected' : '' }}>
                                                    Sedentary</option>


                                                <option value="Moderately Active"
                                                    {{ $details['Question_No_60_How_would_you_describe_your_lifestyle'] === 'Moderately Active' ? 'selected' : '' }}>
                                                    Moderately Active</option>


                                                {{-- <option value="Low Active"
                                                {{ $details['Question_No_60_How_would_you_describe_your_lifestyle'] === 'Low Active' ? 'selected' : '' }}>
                                                Low Active</option> --}}

                                                <option value="Active"
                                                    {{ $details['Question_No_60_How_would_you_describe_your_lifestyle'] === 'Active' ? 'selected' : '' }}>
                                                    Active</option>

                                                {{-- <option value="Very Active (Athletic)"
                                                {{ $details['Question_No_60_How_would_you_describe_your_lifestyle'] === 'Very Active (Athletic)' ? 'selected' : '' }}>
                                                Very Active (Athletic)</option> --}}

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 bmi61">
                                        <div class="form-group">
                                            <label for="bmi61">Question No.61: BMI</label><br>
                                            <input type="text" name="bmi61" class="form-control" id="bmi61"
                                                placeholder="BMI" value="{{ $details['bmi61'] }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-12 muac" id="muac-container">
                                        <div class="form-group">
                                            <label for="muac">Question No.62: MUAC</label><br>
                                            <input type="text" name="muac" class="form-control" id="muac"
                                                placeholder="MUAC" value="{{ $details['muac'] }}">

                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 Daily_Protien_requirement">
                                        <div class="form-group">
                                            <label for="Daily_Protien_requirement">Question No.63: Daily Protien
                                                requirement </label><br>

                                            <input type="text" name="Daily_Protien_requirement"
                                                class="form-control"
                                                value="{{ $details['Daily_Protien_requirement'] }}"
                                                id="Daily_Protien_requirement" placeholder="Daily Protien requirement">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-12 Daily_energy_requirement">
                                        <div class="form-group">
                                            <label for="Daily_energy_requirement">Question No.64: Daily Energy <br>
                                                requirement </label><br>

                                            <input type="text" name="Daily_energy_requirement" class="form-control"
                                                value="{{ $details['Daily_energy_requirement'] }}"
                                                id="Daily_energy_requirement" placeholder="Daily Energy requirement">






                                        </div>
                                    </div>
                                     <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label
                                                for="Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day">Question
                                                No.65: How many glasses of water/liquids do you consume in a day?</label><br>

                                            <select class="form-control"
                                                id="Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day"
                                                name="Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day"
                                                required>

                                                <option value="">Select</option>
                                                <option value="6-8" <?php if (isset($details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day']) && $details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] == '6-8') {
                                                    echo 'selected';
                                                } ?>>6-8</option>
                                                <option value="4-6" <?php if (isset($details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day']) && $details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] == '4-6') {
                                                    echo 'selected';
                                                } ?>>4-6</option>
                                                <option value="< 4" <?php if (isset($details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day']) && $details['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] == '< 4') {
                                                    echo 'selected';
                                                } ?>>
                                                    < 4</option>
                                            </select>






                                        </div>
                                    </div> 
                                </div>

                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label
                                                for="Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to">Question
                                                No.66: Does the child have any history of substances abuse or addiction
                                                to</label><br>




                                            <select class="form-control"
                                                id="Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to"
                                                name="Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to"
                                                required>
                                                <option value="">Select</option>
                                                <option value="Yes" <?php if (isset($details['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to']) && $details['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] == 'Yes') {
                                                    echo 'selected';
                                                } ?>>Yes</option>
                                                <option value="No" <?php if (isset($details['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to']) && $details['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] == 'No') {
                                                    echo 'selected';
                                                } ?>>No</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 d-none" id="addictionContainer">
                                        <div class="form-group">
                                            <label for="addiction">Please Specify</label><br>

                                            <select class="form-control mt-4" id="addiction" name="addiction" required>
                                                <option value="">Select</option>
                                                <option value="Smoking" <?php if (isset($details['addiction']) && $details['addiction'] == 'Smoking') {
                                                    echo 'selected';
                                                } ?>>Smoking</option>
                                                <option value="Alcohol" <?php if (isset($details['addiction']) && $details['addiction'] == 'Alcohol') {
                                                    echo 'selected';
                                                } ?>>Alcohol</option>
                                                <option value="Pan / Gutka / Chalia consumption" <?php if (isset($details['addiction']) && $details['addiction'] == 'Pan / Gutka / Chalia consumption') {
                                                    echo 'selected';
                                                } ?>>Pan /
                                                    Gutka / Chalia
                                                    consumption</option>
                                                <option value="Substance / Drugs abuse" <?php if (isset($details['addiction']) && $details['addiction'] == 'Substance / Drugs abuse') {
                                                    echo 'selected';
                                                } ?>>Substance / Drugs
                                                    abuse
                                                </option>
                                                <option value="gutka" <?php if (isset($details['addiction']) && $details['addiction'] == 'gutka') {
                                                    echo 'selected';
                                                } ?>>gutka</option>
                                                <option value="chalia" <?php if (isset($details['addiction']) && $details['addiction'] == 'chalia') {
                                                    echo 'selected';
                                                } ?>>chalia</option>
                                                <option value="substance" <?php if (isset($details['addiction']) && $details['addiction'] == 'substance') {
                                                    echo 'selected';
                                                } ?>>substance</option>
                                                <option value="drug abuse" <?php if (isset($details['addiction']) && $details['addiction'] == 'drug abuse') {
                                                    echo 'selected';
                                                } ?>>drug abuse</option>
                                                <option value="other" <?php if (isset($details['addiction']) && $details['addiction'] == 'other') {
                                                    echo 'selected';
                                                } ?>>other</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="form-group col-md-12 d-none" id="otherAddictionContainer">
                                        <div class="form-group">
                                            <label for="other_addiction">Please Describe</label><br>

                                            <textarea class="form-control w-100" name="other_addiction" id="other_addiction" rows="3"><?php echo isset($details['other_addiction']) ? htmlspecialchars($details['other_addiction']) : ''; ?></textarea>

                                        </div>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="food_allergies">Question No.67: Does the child suffer from any food
                                                intolerances/
                                                food allergies?</label><br>




                                            <select class="form-control" id="food_allergies" name="food_allergies" required>
                                                <option value="">Select</option>
                                                <option value="Yes" <?php if (isset($details['food_allergies']) && $details['food_allergies'] == 'Yes') {
                                                    echo 'selected';
                                                } ?>>Yes</option>
                                                <option value="No" <?php if (isset($details['food_allergies']) && $details['food_allergies'] == 'No') {
                                                    echo 'selected';
                                                } ?>>No</option>
                                            </select>

                                        </div>
                                    </div>
                                                    
                                    <div class="form-group col-md-12 d-none" id="food_allergiesContainer">
                                        <div class="form-group">
                                            <label for="other_addiction">Specify the foods</label><br>
                                            <textarea class="form-control" name="other_food_allergies" id="other_food_allergies" class="w-100" rows="3"></textarea> 
                                             

                                            <select name="other_food_allergies" id="other_food_allergies"
                                                class="form-control">
                                                <option value="Milk" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Milk' ? 'selected' : ''; ?>>Milk</option>
                                                <option value="Eggs" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Eggs' ? 'selected' : ''; ?>>Eggs</option>
                                                <option value="Peanuts" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Peanuts' ? 'selected' : ''; ?>>Peanuts</option>
                                                <option value="Tree nuts (e.g., almonds, walnuts, cashews)"
                                                    <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Tree nuts (e.g., almonds, walnuts, cashews)' ? 'selected' : ''; ?>>Tree nuts
                                                    (e.g., almonds, walnuts, cashews)</option>
                                                <option value="Almonds" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Almonds' ? 'selected' : ''; ?>>Almonds</option>
                                                <option value="Walnuts" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Walnuts' ? 'selected' : ''; ?>>Walnuts</option>
                                                <option value="Cashews" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Cashews' ? 'selected' : ''; ?>>Cashews</option>
                                                <option value="Fish (e.g., salmon, tuna)" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Fish (e.g., salmon, tuna)' ? 'selected' : ''; ?>>Fish (e.g.,
                                                    salmon, tuna)
                                                </option>
                                                <option value="Salmon" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Salmon' ? 'selected' : ''; ?>>Salmon</option>
                                                <option value="Tuna" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Tuna' ? 'selected' : ''; ?>>Tuna</option>
                                                <option value="Shellfish (e.g., shrimp, crab)" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Shellfish (e.g., shrimp, crab)' ? 'selected' : ''; ?>>Shellfish
                                                    (e.g.,
                                                    shrimp, crab)</option>
                                                <option value="Shrimp" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Shrimp' ? 'selected' : ''; ?>>Shrimp</option>
                                                <option value="Crab" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Crab' ? 'selected' : ''; ?>>Crab</option>
                                                <option value="Soy" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Soy' ? 'selected' : ''; ?>>Soy</option>
                                                <option value="Wheat" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Wheat' ? 'selected' : ''; ?>>Wheat</option>
                                                
                                                <option value="Others" <?php echo isset($details['other_food_allergies']) && $details['other_food_allergies'] == 'Others' ? 'selected' : ''; ?>>Others</option>
                                            </select>



                                        </div>
                                    </div>




                                    {{-- <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="lifestyle">Question No.68: How would you describe your <br> lifestyle?</label><br>
            
                                        <select class="form-control" id="lifestyle" name="lifestyle" required>
                                            <option value="">Select</option>
                                            <option value="Sedentary" <?php if (isset($details['lifestyle']) && $details['lifestyle'] == 'Sedentary') {
                                                echo 'selected';
                                            } ?>>Sedentary</option>
                                            <option value="Low Active" <?php if (isset($details['lifestyle']) && $details['lifestyle'] == 'Low Active') {
                                                echo 'selected';
                                            } ?>>Low Active</option>
                                            <option value="Active" <?php if (isset($details['lifestyle']) && $details['lifestyle'] == 'Active') {
                                                echo 'selected';
                                            } ?>>Active</option>
                                            <option value="Very Active (Athletic)" <?php if (isset($details['lifestyle']) && $details['lifestyle'] == 'Very Active (Athletic)') {
                                                echo 'selected';
                                            } ?>>Very Active (Athletic)
                                            </option>
                                        </select>
            
            
                                    </div>
                                </div>  --}}
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="meals">Question No.69: How many meals (breakfast / lunch / dinner)
                                                do you
                                                consume in a day?</label><br>

                                            <select class="form-control" id="meals" name="meals" required>
                                                <option value="">Select</option>
                                                <option value="1" <?php if (isset($details['meals']) && $details['meals'] == '1') {
                                                    echo 'selected';
                                                } ?>>1</option>
                                                <option value="2-3" <?php if (isset($details['meals']) && $details['meals'] == '2-3') {
                                                    echo 'selected';
                                                } ?>>2-3</option>
                                                <option value=">3" <?php if (isset($details['meals']) && $details['meals'] == '>3') {
                                                    echo 'selected';
                                                } ?>>>3</option>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="food_items">Question No.70: How many packed items/foods (chips /
                                                biscuits sodas)
                                                do you consume in average in a day?</label><br>


                                            <select class="form-control" id="food_items" name="food_items" required>
                                                <option value="">Select</option>
                                                <option value="0-1" <?php if (isset($details['food_items']) && $details['food_items'] == '0-1') {
                                                    echo 'selected';
                                                } ?>>0-1</option>
                                                <option value="1-2" <?php if (isset($details['food_items']) && $details['food_items'] == '1-2') {
                                                    echo 'selected';
                                                } ?>>1-2</option>
                                                <option value="3 or more" <?php if (isset($details['food_items']) && $details['food_items'] == '3 or more') {
                                                    echo 'selected';
                                                } ?>>3 or more</option>
                                            </select>



                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="fast_food">Question No.71: How frequently do you consume fast food on
                                                dineout on
                                                average in a week?</label><br>
                                            <select class="form-control" id="fast_food" name="fast_food" required>
                                                <option value="">Select</option>

                                                {{-- <option value="0-1" <?php if (isset($details['fast_food']) && $details['fast_food'] == '0-1') {
                                                    echo 'selected';
                                                } ?>>0-1</option> --}}




                                                <option value="< 1" <?php if (isset($details['fast_food']) && $details['fast_food'] == '< 1') {
                                                    echo 'selected';
                                                } ?>>
                                                    < 1</option>

                                                <option value="1-2" <?php if (isset($details['fast_food']) && $details['fast_food'] == '1-2') {
                                                    echo 'selected';
                                                } ?>>1-2</option>




                                                <option value="3 or more" <?php if (isset($details['fast_food']) && $details['fast_food'] == '3 or more') {
                                                    echo 'selected';
                                                } ?>>3 or more</option>



                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="NutritionistComment">Comment</label><br>

                                            <textarea class="form-control w-100" name="NutritionistComment" id="NutritionistComment" rows="3"
                                                required><?php echo isset($details['NutritionistComment']) ? htmlspecialchars($details['NutritionistComment']) : ''; ?></textarea>

                                        </div>
                                    </div>

                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Follow_up_Required">Follow-up Required</label>
                                            <select id="Follow_up_Required" name="Follow_up_Required"
                                                class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="Yes" <?php if (isset($details['Follow_up_Required']) && $details['Follow_up_Required'] == 'Yes') {
                                                    echo 'selected';
                                                } ?>>Yes</option>
                                                <option value="No" <?php if (isset($details['Follow_up_Required']) && $details['Follow_up_Required'] == 'No') {
                                                    echo 'selected';
                                                } ?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row d-none refer_to_form_row ">
                                 

                                    <div class="form-row d-none refer_to_form_row ">
                                        <div class="form-group col-md-12">
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


                                </div>

                               

                                   
                                <div class="form-row d-none" id="follow_up_show">

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="Reason_for_Follow_up">Reason for Follow-up</label>
                                            <input placeholder="Reason for Follow-up" name="Reason_for_Follow_up"
                                                id="Reason_for_Follow_up"
                                                value="{{ $details['Reason_for_Follow_up'] }}" class="form-control" />
                                        </div>
                                    </div>
                                   
                                    <div class="form-group col-md-6">
                                        <form id="followUpForm">
                                            @csrf
                                            <input type="hidden" value="{{ $details['id'] }}" name="entry_id"
                                                id="entryId">
                                            <div class="form-group">
                                                <label for="Follow_up_Date">Follow-up Date </label>
                                                <input type="date" placeholder="Follow-up Date"
                                                    name="follow_up_date" id="Follow_up_Date"
                                                    value="{{ $details['Follow_up_Date'] }}" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                {{-- <input type="checkbox" id="FollowUpCheck"> Submit Form on Check --}}
                                                <input type="checkbox" id="FollowUpCheck"
                                                    {{ !empty($details['Follow_up_Date']) ? 'checked' : '' }}> Submit Form
                                                on Check
                                            </div>
                                        </form>
                                    </div>
                                    @if($details['id'] >5540)

                                    <div class="form-group col-md-6">
                                        <form id="followUpFormPhycologist">
                                            @csrf
                                            <input type="hidden" value="{{ $details['id'] }}" name="entry_idforPhycologist"
                                                id="entryIdforPhycologist">
                                            <div class="form-group">
                                                <label for="Follow_up_Date">Follow-up Date Psycologist</label>
                                                <input type="date" placeholder="Follow-up Date"
                                                    name="follow_up_dateforPhycologist" id="Follow_up_DateforPhycologist"
                                                    value="{{ $details['Physician_Follow_up_Date'] }}" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                {{-- <input type="checkbox" id="FollowUpCheckforPhycologist"> Submit Form on Check --}}
                                                <input type="checkbox" id="FollowUpCheckforPhycologist"
                                                    {{ !empty($details['Physician_Follow_up_Date']) ? 'checked' : '' }}> Submit Form
                                                on Check
                                            </div>
                                        </form>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <form id="followUpFormExternal">
                                            @csrf
                                            <input type="hidden" value="{{ $details['id'] }}" name="entry_idforExternal"
                                                id="entry_idforExternal">
                                            <div class="form-group">
                                                <label for="Follow_up_Date">Follow-up Date External Specialist </label>
                                                <input type="date" placeholder="Follow-up Date"
                                                    name="follow_up_dateforExternal" id="Follow_up_DateforExternal"
                                                    value="{{ $details['externalspecialist_Follow_up_Date'] }}" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                {{-- <input type="checkbox" id="FollowUpCheckforExternal"> Submit Form on Check --}}
                                                <input type="checkbox" id="FollowUpCheckforExternal"
                                                    {{ !empty($details['externalspecialist_Follow_up_Date']) ? 'checked' : '' }}> Submit Form
                                                on Check
                                            </div>
                                        </form>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <form id="followUpFormPhysician">
                                            @csrf
                                            <input type="hidden" value="{{ $details['id'] }}" name="entry_idforgeneralphysician"
                                                id="entryIdforgeneralphysician">
                                            <div class="form-group">
                                                <label for="Follow_up_Date">Follow-up Date General Physician </label>
                                                <input type="date" placeholder="Follow-up Date"
                                                    name="follow_up_dateforgeneralphysician" id="Follow_up_Dateforgeneralphysician"
                                                    value="{{ $details['generalphysician_Follow_up_Date'] }}" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                {{-- <input type="checkbox" id="FollowUpCheck"> Submit Form on Check --}}
                                                <input type="checkbox" id="Follow_up_forgeneralphysician"
                                                    {{ !empty($details['generalphysician_Follow_up_Date']) ? 'checked' : '' }}> Submit Form
                                                on Check
                                            </div>
                                        </form>
                                    </div>
                                        @endif
                                </div>



                            </div>

                            {{-- <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="duration">DURATION</label><br>
                                <input type="text" name="duration" id="duration" class="form-control" value="1973" disabled>
                            </div>
                        </div> --}}


                            <div class="form-row align-items-center my-4" id="birth_5_wasting_girls">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="wasting_birth_to_5_girl">For Wasting criteria from Birth to 5 years
                                            Girls</label>
                                        <input type="text" name="wasting_birth_to_5_girl"
                                            id="wasting_birth_to_5_girl" class="form-control"
                                            value="{{ $details['wasting_birth_to_5_girl'] }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="form-row align-items-center my-4 " id="birth_5_wasting_boys">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="wasting_birth_to_5_boy">For Wasting criteria from Birth to 5 years
                                            Boys</label>
                                        <input type="text" name="wasting_birth_to_5_boy"
                                            id="wasting_birth_to_5_boy" class="form-control"
                                            value="{{ $details['wasting_birth_to_5_boy'] }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="form-row align-items-center my-4 " id="5_19_wasting_girls">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="wasting_5_to_19_girl">For children and adolescents(Girls) Wasting
                                            (Criteria 5-19)</label>
                                        <input type="text" name="wasting_5_to_19_girl" id="wasting_5_to_19_girl"
                                            class="form-control" value="{{ $details['wasting_5_to_19_girl'] }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="form-row align-items-center my-4 " id="5_19_wasting_boys">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="wasting_5_to_19_boy">For children and adolescents(Boys) Wasting
                                            (Criteria 5-19)</label>
                                        <input type="text" name="wasting_5_to_19_boy" id="wasting_5_to_19_boy"
                                            class="form-control" value="{{ $details['wasting_5_to_19_boy'] }}" />
                                    </div>
                                </div>

                            </div>


                            <div class="form-row align-items-center my-4 " id="birth_2_stunting_girls">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stunting_birth_to_2_girl">STUNTING CRITERIA: FOR BIRTH TO 2 YEARS
                                            Girls</label>
                                        <input type="text" name="stunting_birth_to_2_girl"
                                            id="stunting_birth_to_2_girl" class="form-control"
                                            value="{{ $details['stunting_birth_to_2_girl'] }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="form-row align-items-center my-4 " id="birth_2_stunting_boys">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stunting_birth_to_2_boy">STUNTING CRITERIA: FOR BIRTH TO 2 YEARS
                                            Boys</label>
                                        <input type="text" name="stunting_birth_to_2_boy"
                                            id="stunting_birth_to_2_boy" class="form-control"
                                            value="{{ $details['stunting_birth_to_2_boy'] }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="form-row align-items-center my-4 " id="2_5_stunting_girls">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stunting_2_5_girl">STUNTING CRITERIA: FOR 2 TO 5 YEARS Girls</label>
                                        <input type="text" name="stunting_2_5_girl" id="stunting_2_5_girl"
                                            class="form-control" value="{{ $details['stunting_2_5_girl'] }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="form-row align-items-center my-4 " id="2_5_stunting_boys">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stunting_2_5_boy">STUNTING CRITERIA: FOR 2 TO 5 YEARS Boys</label>
                                        <input type="text" name="stunting_2_5_boy" id="stunting_2_5_boy"
                                            class="form-control" value="{{ $details['stunting_2_5_boy'] }}" />
                                    </div>
                                </div>

                            </div>


                            <div class="form-row align-items-center my-4 " id="5_19_stunting_girls">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stunting_5_19_girl">STUNTING CRITERIA: FOR 5 TO 19 YEARS Girls</label>
                                        <input type="text" name="stunting_5_19_girl" id="stunting_5_19_girl"
                                            class="form-control" value="{{ $details['stunting_5_19_girl'] }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="form-row align-items-center my-4 " id="5_19_stunting_boys">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stunting_5_19_boy">STUNTING CRITERIA: FOR 5 TO 19 YEARS Boys</label>
                                        <input type="text" name="stunting_5_19_boy" id="stunting_5_19_boy"
                                            class="form-control" value="{{ $details['stunting_5_19_boy'] }}" />

                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12">
                                    <div class="form-group">
                                        <label for="DietaryAdviceComment">DIETERY COMMENT</label>
                                        <textarea name="DietaryAdviceComment" id="DietaryAdviceComment" class="form-control" rows="4" readonly>{{ $details['DietaryAdviceComment'] }}</textarea>
                                    </div>
                                </div>
                      
                            <div class="col-12">
                                    <div class="form-group">
                                        <label for="doctors_comment">DOCTOR COMMENT</label>
                                        <textarea name="doctor_comment" id="doctor_comment" class="form-control" rows="4">{{ $details['doctor_comment'] }}</textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="row">
                <div class="col-md-12">

                </div>
                <a href="#" class="btn btn-primary" id="psychiatrist">View By Psychologist</a>
                &nbsp;
                <a href="#" class="btn btn-primary" id="doc">View By Doctor</a>
                &nbsp;
                &nbsp;
                <a href="#" class="btn btn-primary" id="docComment">Submit Doctor Comment</a>
                &nbsp;
                <a href="#" class="btn btn-primary" id="nutritionist">View By Nutritionist </a>
                &nbsp;
                <a href="#" class="btn btn-primary" id="PsychologistFindings">Sumbit Psychologist findings</a>
            </div>

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
                            <input type="email" name="to" class="form-control" placeholder="To" value="{{ isset($details['school_email']) ? (is_object($details['school_email']) ? ($details['school_email']->email ?? '') : (is_array($details['school_email']) ? ($details['school_email']['email'] ?? '') : $details['school_email'])) : '' }}" readonly required>
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
                        <input type="hidden" id="pdfPath" name="pdfPath" value="Medical-History.pdf">
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

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(function(){
  $('#sendMailForm').on('submit', function(e){
    e.preventDefault();
    var form = this;
    var submitButton = $(form).find('button[type="submit"]');
    submitButton.find('.spinner-border').removeClass('d-none');
    var formData = new FormData(form);
    formData.append('_token', '{{ csrf_token() }}');
    var ccRaw = ($('input[name="cc"]').val() || '').trim();
    if (ccRaw.length > 0) {
      var emails = ccRaw.split(/[,;\s]+/).filter(function(x){ return x.length > 0; });
      var ccJson = emails.map(function(email){ return { value: email }; });
      formData.set('cc', JSON.stringify(ccJson));
    }
    $.ajax({
      url: $(form).attr('action'),
      method: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response){
        Swal.fire({ title: 'Success', text: 'Email sent successfully!', icon: 'success', timer: 5000, showConfirmButton: false });
        submitButton.text('Send Mail');
        submitButton.find('.spinner-border').addClass('d-none');
        $('#sendMailModal').modal('hide');
        $(form)[0].reset();
        $('#downloadPDF2').text('Send Mail');
      },
      error: function(response){
        var errorMessage = 'An error occurred while sending the email.';
        if (response.responseJSON && response.responseJSON.error) { errorMessage = response.responseJSON.error; }
        Swal.fire({ title: 'Error', text: errorMessage, icon: 'error', timer: 5000, showConfirmButton: false });
        submitButton.text('Send Mail');
        submitButton.find('.spinner-border').addClass('d-none');
      },
      complete: function(){
        submitButton.prop('disabled', false);
        submitButton.find('.spinner-border').addClass('d-none');
      }
    });
  });
});
</script>
<script>
    $(document).ready(function() {

        $("#refer_to").select2({
            placeholder: "Refer To",
            allowClear: true,
            multiple: true,

        });

        $('#FollowUpCheck').on('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            var followUpDate = $("#Follow_up_Date").val();
            var entryid = $("#entryId").val(); // Get entry ID
            var Reason_for_Follow_up = $("#Reason_for_Follow_up").val(); // Get entry ID
            var gr_number = $("#gr_number").val(); // Get entry ID

            console.log('Follow-up Date:', followUpDate);

            $.ajax({
                url: "{{ route('store.follow.up.date') }}", // Ensure this route is correct
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    follow_up_date: followUpDate,
                    entry_id: entryid,
                    Reason_for_Follow_up: Reason_for_Follow_up,
                    gr_number: gr_number,
                },
                success: function(response) {
                    alert('Follow-up date updated successfully.');

                },
                error: function(xhr) {
                    console.log(xhr.responseJSON); // Log the full response for debugging
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessages = [];
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages.push(errors[key].join(', '));
                            }
                        }
                        // Optionally display error messages
                        alert('Validation errors: ' + errorMessages.join(', '));
                    } else {
                        // alert('An error occurred.');
                    }
                }
            });
        });

        $('#FollowUpCheckforPhycologist').on('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            var followUpDate = $("#Follow_up_DateforPhycologist").val();
            var entryid = $("#entryIdforPhycologist").val(); // Get entry ID
            var Reason_for_Follow_up = $("#Reason_for_Follow_up").val(); // Get entry ID
            var gr_number = $("#gr_number").val(); // Get entry ID

            console.log('Follow-up Date:', followUpDate);

            $.ajax({
                url: "{{ route('store.follow.up.Phycologist.date') }}", // Ensure this route is correct
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    follow_up_date: followUpDate,
                    entry_id: entryid,
                    Reason_for_Follow_up: Reason_for_Follow_up,
                    gr_number: gr_number,
                },
                success: function(response) {
                    alert('Follow-up date updated successfully.');

                },
                error: function(xhr) {
                    console.log(xhr.responseJSON); // Log the full response for debugging
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessages = [];
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages.push(errors[key].join(', '));
                            }
                        }
                        // Optionally display error messages
                        alert('Validation errors: ' + errorMessages.join(', '));
                    } else {
                        // alert('An error occurred.');
                    }
                }
            });
        });
        $('#FollowUpCheckforExternal').on('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            var followUpDate = $("#Follow_up_DateforExternal").val();
            var entryid = $("#entry_idforExternal").val(); // Get entry ID
            var Reason_for_Follow_up = $("#Reason_for_Follow_up").val(); // Get entry ID
            var gr_number = $("#gr_number").val(); // Get entry ID

            console.log('Follow-up Date:', followUpDate);

            $.ajax({
                url: "{{ route('store.follow.up.External.date') }}", // Ensure this route is correct
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    follow_up_date: followUpDate,
                    entry_id: entryid,
                    Reason_for_Follow_up: Reason_for_Follow_up,
                    gr_number: gr_number,
                },
                success: function(response) {
                    alert('Follow-up date updated successfully.');

                },
                error: function(xhr) {
                    console.log(xhr.responseJSON); // Log the full response for debugging
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessages = [];
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages.push(errors[key].join(', '));
                            }
                        }
                        // Optionally display error messages
                        alert('Validation errors: ' + errorMessages.join(', '));
                    } else {
                        // alert('An error occurred.');
                    }
                }
            });
        });
        $('#Follow_up_forgeneralphysician').on('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            var followUpDate = $("#Follow_up_Dateforgeneralphysician").val();
            var entryid = $("#entryIdforgeneralphysician").val(); // Get entry ID
            var Reason_for_Follow_up = $("#Reason_for_Follow_up").val(); // Get entry ID
            var gr_number = $("#gr_number").val(); // Get entry ID

            console.log('Follow-up Date:', followUpDate);

            $.ajax({
                url: "{{ route('store.follow.up.generalphysician.date') }}", // Ensure this route is correct
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    follow_up_date: followUpDate,
                    entry_id: entryid,
                    Reason_for_Follow_up: Reason_for_Follow_up,
                    gr_number: gr_number,
                },
                success: function(response) {
                    alert('Follow-up date updated successfully.');

                },
                error: function(xhr) {
                    console.log(xhr.responseJSON); // Log the full response for debugging
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessages = [];
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages.push(errors[key].join(', '));
                            }
                        }
                        // Optionally display error messages
                        alert('Validation errors: ' + errorMessages.join(', '));
                    } else {
                        // alert('An error occurred.');
                    }
                }
            });
        });
        function updateBackgroundColor(selector, selectValue, category) {
            var backgroundColor = '';
            var textColor = 'white'; // Default text color

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
                        case 'Obesity':
                            backgroundColor = 'red';
                            $('#bmi, #bmi61').css({'background-color': 'red', 'color': 'black'});
                            break;
                        case 'Moderate Wasting (WHZ between -3 and -2)':
                        case 'Moderate Thinness':
                        case 'Overweight':
                            backgroundColor = 'orange';
                            $('#bmi, #bmi61').css({'background-color': 'orange', 'color': 'black'});
                            break;
                        case 'Mild Thinness':
                        case 'Mild Overweight':
                            backgroundColor = 'yellow';
                            $('#bmi, #bmi61').css({'background-color': 'yellow', 'color': 'black'});
                            break;
                        case 'Normal (WHZ between -2 and +2)':
                        case 'Normal Weight':
                            backgroundColor = 'green';
                            $('#bmi, #bmi61').css({'background-color': 'green', 'color': 'black'});
                            break;
                        case 'Overweight (WHZ > +2)':
                        case 'Overweight':
                            backgroundColor = 'yellow';
                            textColor = 'black';
                            $('#bmi, #bmi61').css({'background-color': 'yellow', 'color': 'black'});
                            break;
                        case 'Obesity':
                            backgroundColor = 'red';
                            $('#bmi, #bmi61').css({'background-color': 'red', 'color': 'black'});
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
                $(selector).attr('style', ''); // Reset style if no background color is set
            }
        }

        // Field mappings
        var fieldMappings = [{
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

        // Loop through the mappings and run the function for each text field
        fieldMappings.forEach(function(mapping) {
            var selectedValue = $(mapping.id).val(); // Get the current value of the text field
            updateBackgroundColor(mapping.id, selectedValue, mapping
            .category); // Call the function immediately
        });

        $('#birth_5_wasting_girls, #birth_5_wasting_boys, #5_19_wasting_girls, #5_19_wasting_boys, #birth_2_stunting_girls, #birth_2_stunting_boys, #2_5_stunting_girls, #2_5_stunting_boys, #5_19_stunting_girls, #5_19_stunting_boys')
            .addClass('d-none');

      var age = "{{ $details['age'] ?? '' }}";
        console.log("fresh age ",age);
        var gender = $("#gender").val();
        // var gender = $('#gender').val();
        // var dob = $('#dob').val();

        // Calculate age from dob
        // var today = new Date();
        // var birthDate = new Date(dob);
        // var age = today.getFullYear() - birthDate.getFullYear();
        // var monthDiff = today.getMonth() - birthDate.getMonth();

        // Adjust age if the birth month hasn't occurred yet in the current year
        // if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        //     age--;
        // }
        console.log("not fresh age ",age);
        // Set calculated age to the readonly input
        //  $('#read_oly_age').val(age);
// console.write(a);
        // $('#read_oly_gender').val(gender);
        if (gender == 'female' && age <= 5) {
            $('#birth_5_wasting_girls').removeClass('d-none');
        } else if (gender == 'male' && age <= 5) {
            $('#birth_5_wasting_boys').removeClass('d-none');
        } else if (gender == 'female' && age > 5 && age <= 19) {
            $('#5_19_wasting_girls').removeClass('d-none');
        } else if (gender == 'male' && age > 5 && age <= 19) {
            $('#5_19_wasting_boys').removeClass('d-none');

        } else {}

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

        var Posture = $("#Posture").val();
        if (Posture == 'No') {
            $("#Posture").addClass("bg-danger");
        } else {}

        var jaundice = $("#jaundice").val();
        if (jaundice == 'yes') {
            $("#jaundice").addClass("bg-danger");
        } else {}

        var Mentalstatus = $("#Mentalstatus").val();
        if (Mentalstatus == 'Lethargic') {
            $("#Mentalstatus").addClass("bg-danger");
        } else {}

        var anemia = $("#anemia").val();
        if (anemia == 'Yes') {
            $("#anemia").addClass("bg-danger");
        } else {}

        var clubbing = $("#clubbing").val();
        if (clubbing == 'Yes') {
            $("#clubbing").addClass("bg-danger");
        } else {}

        var cyanosis = $("#cyanosis").val();
        if (cyanosis == 'Yes') {
            $("#cyanosis").addClass("bg-danger");
        } else {}

        var cyanosis = $("#cyanosis").val();
        if (cyanosis == 'Yes') {
            $("#cyanosis").addClass("bg-danger");
        } else {}

        var skin = $("#skin").val();
        if (skin == 'Rash' || skin == 'Allergy' || skin == 'Lesion' || skin == 'Bruises') {
            $("#skin").addClass("bg-danger");
        } else {}

        var breath = $("#breath").val();
        if (breath == 'Bad Breath') {
            $("#breath").addClass("bg-danger");
        } else {}

        var Nails = $("#Nails").val();
        if (Nails == 'Dirty') {
            $("#Nails").addClass("bg-danger");
        } else {}

        var Lice_nits = $("#Lice_nits").val();
        if (Lice_nits == 'Yes') {
            $("#Lice_nits").addClass("bg-danger");
        } else {}

        var hair_and_scalp = $("#hair_and_scalp").val();
        if (hair_and_scalp == 'Color-faded') {
            $("#hair_and_scalp").addClass("bg-danger");
        } else {}

        var Question_No_21_Any_Hair_Problem = $("#Question_No_21_Any_Hair_Problem").val();
        if (Question_No_21_Any_Hair_Problem == 'Kinky' || Question_No_21_Any_Hair_Problem == 'Brittle' ||
            Question_No_21_Any_Hair_Problem == 'Dry') {
            $("#Question_No_21_Any_Hair_Problem").addClass("bg-danger");
        } else {}

        var Question_No_22_Sclap = $("#Question_No_22_Sclap").val();
        if (Question_No_22_Sclap == 'Scaly' || Question_No_22_Sclap == 'Dry' || Question_No_22_Sclap ==
            'Moist') {
            $("#Question_No_22_Sclap").addClass("bg-danger");
        } else {}

        var Question_No_23_Hair_distribution = $("#Question_No_23_Hair_distribution").val();
        if (Question_No_23_Hair_distribution == 'Patchy' || Question_No_23_Hair_distribution == 'Receding' ||
            Question_No_23_Hair_distribution == 'Receding_Hair_Line') {
            $("#Question_No_23_Hair_distribution").addClass("bg-danger");
        } else {}

        var Question_No_25_Normal_ocular_alignment = $("#Question_No_25_Normal_ocular_alignment").val();
        if (Question_No_25_Normal_ocular_alignment == 'No' || Question_No_25_Normal_ocular_alignment == 'no') {
            $("#Question_No_25_Normal_ocular_alignment").addClass("bg-danger");
        } else {}

        var Question_No_26_Normal_eye_inspection = $("#Question_No_26_Normal_eye_inspection").val();
        if (Question_No_26_Normal_eye_inspection == 'No' || Question_No_26_Normal_eye_inspection == 'no') {
            $("#Question_No_26_Normal_eye_inspection").addClass("bg-danger");
        } else {}

         var Question_No_27_Normal_Color_vision = $("#Question_No_27_Normal_Color_vision").val();
         if(Question_No_27_Normal_Color_vision == 'No' || Question_No_27_Normal_Color_vision == 'no'){
             $("#Question_No_27_Normal_Color_vision").addClass("bg-danger");
         }else{}

        var Question_No_28_Nystagmus = $("#Question_No_28_Nystagmus").val();
        if (Question_No_28_Nystagmus == 'Yes' || Question_No_28_Nystagmus == 'yes') {
            $("#Question_No_28_Nystagmus").addClass("bg-danger");
        } else {}

        var Question_No_29_Normal_ears_shape_and_position = $("#Question_No_29_Normal_ears_shape_and_position")
            .val();
        if (Question_No_29_Normal_ears_shape_and_position == 'No' ||
            Question_No_29_Normal_ears_shape_and_position == 'no') {
            $("#Question_No_29_Normal_ears_shape_and_position").addClass("bg-danger");
        } else {}

        var Right_ear = $("#Right_ear").val();
        if (Right_ear == 'Ear wax' || Right_ear == 'Canal infection') {
            $("#Right_ear").addClass("bg-danger");
        } else {}

        var Question_No_31_Conclusion_of_hearing = $("#Question_No_31_Conclusion_of_hearing").val();
        if (Question_No_31_Conclusion_of_hearing == 'right_ear_conductive_hearing_loss' || Right_ear ==
            'left_ear_conductive_hearing_loss' || Right_ear == 'right_ear_sensorineural_hearing_loss' ||
            Right_ear == 'left_ear_sensorineural_hearing_loss') {
            $("#Question_No_31_Conclusion_of_hearing").addClass("bg-danger");
        } else {}

        var Question_No_32_External_inasal_examinaton = $("#Question_No_32_External_inasal_examinaton").val();
        if (Question_No_32_External_inasal_examinaton != 'Normal' &&
            Question_No_32_External_inasal_examinaton != 'normal') {
            $("#Question_No_32_External_inasal_examinaton").addClass("bg-danger");
        } else {}

        var Question_No_33_perform = $("#Question_No_33_perform").val();
        if (Question_No_33_perform != 'Normal' && Question_No_33_perform != 'normal') {
            $("#Question_No_33_perform").addClass("bg-danger");
        } else {}

        var Question_No_34_Assess_gingiva = $("#Question_No_34_Assess_gingiva").val();
        if (Question_No_34_Assess_gingiva != 'Normal' && Question_No_34_Assess_gingiva != 'normal') {
            $("#Question_No_34_Assess_gingiva").addClass("bg-danger");
        } else {}

        var Question_No_35_Are_there_dental_caries = $("#Question_No_35_Are_there_dental_caries").val();
        if (Question_No_35_Are_there_dental_caries == 'Yes' || Question_No_35_Are_there_dental_caries ==
            'yes') {
            $("#Question_No_35_Are_there_dental_caries").addClass("bg-danger");
        } else {}

        var Question_No_36_Examine_tonsils = $("#Question_No_36_Examine_tonsils").val();
        if (Question_No_36_Examine_tonsils == 'Tonsillitis') {
            $("#Question_No_36_Examine_tonsils").addClass("bg-danger");
        } else {}

        var Question_No_37_Normal_Speech_development = $("#Question_No_37_Normal_Speech_development").val();
        if (Question_No_37_Normal_Speech_development == 'No' || Question_No_37_Normal_Speech_development ==
            'no') {
            $("#Question_No_37_Normal_Speech_development").addClass("bg-danger");
        } else {}

        var any_neck_swelling = $("#any_neck_swelling").val();
        if (any_neck_swelling == 'Yes' || any_neck_swelling == 'yes') {
            $("#any_neck_swelling").addClass("bg-danger");
        } else {}

        var lymph_node = $("#lymph_node").val();
        if (lymph_node == 'abnormal') {
            $("#lymph_node").addClass("bg-danger");
        } else {}

        var Question_No_40_Any_visible_chest_deformity = $("#Question_No_40_Any_visible_chest_deformity").val();
        if (Question_No_40_Any_visible_chest_deformity == 'Yes' || Question_No_40_Any_visible_chest_deformity ==
            'yes') {
            $("#Question_No_40_Any_visible_chest_deformity").addClass("bg-danger");
        } else {}

        var Question_No_41_Lung_Auscultation = $("#Question_No_41_Lung_Auscultation").val();
        if (Question_No_41_Lung_Auscultation != 'Ronchi' && Question_No_41_Lung_Auscultation !=
            'Vesicular_Breathing') {
            $("#Question_No_41_Lung_Auscultation").addClass("bg-danger");
        } else {}

        var Question_No_42_Cardiac_Auscultation = $("#Question_No_42_Cardiac_Auscultation").val();
        if (Question_No_42_Cardiac_Auscultation == 'Murmur') {
            $("#Question_No_42_Cardiac_Auscultation").addClass("bg-danger");
        } else {}

        var distention_scar_mass = $("#distention_scar_mass").val();
        if (distention_scar_mass != 'Normal' && distention_scar_mass != 'normal') {
            $("#distention_scar_mass").addClass("bg-danger");
        } else {}

         var any_history_of_abdominal_pain = $("#any_history_of_abdominal_pain").val();
         if(any_history_of_abdominal_pain == 'Yes'|| any_history_of_abdominal_pain == 'yes'){
             $("#any_history_of_abdominal_pain").addClass("bg-danger");
         }else{}

         var any_history_of_abdominal_pain = $("#any_history_of_abdominal_pain").val();
         if(any_history_of_abdominal_pain == 'Yes'|| any_history_of_abdominal_pain == 'yes'){
             $("#any_history_of_abdominal_pain").addClass("bg-danger");
        }else{}

        var Formvalue = $('#curvature_spine_resembling').val();
        if (Formvalue != 'Normal' && Formvalue != 'normal') {
            $("#curvature_spine_resembling").addClass("bg-danger");
        } else {}


        var Formvalue = $('#spinal_curvature_assessment').val();
        if (Formvalue != 'Normal' && Formvalue != 'normal') {
            $("#spinal_curvature_assessment").addClass("bg-danger");
        } else {}


        var limitations_range_motion = $("#limitations_range_motion").val();
        if (limitations_range_motion == 'Yes' || limitations_range_motion == 'yes') {
            $("#limitations_range_motion").addClass("bg-danger");
        } else {}

        var adams_forward_bend_test = $("#adams_forward_bend_test").val();
        if (adams_forward_bend_test == 'Positive' || adams_forward_bend_test == 'positive') {
            $("#adams_forward_bend_test").addClass("bg-danger");
        } else {}

        var foot_or_toe_abnormalities = $("#foot_or_toe_abnormalities").val();
        if (foot_or_toe_abnormalities != 'Normal' && foot_or_toe_abnormalities != 'normal') {
            $("#foot_or_toe_abnormalities").addClass("bg-danger");
        } else {}

        var Question_No_50_Have_EPI_immunization_card = $("#Question_No_50_Have_EPI_immunization_card").val();
        if (Question_No_50_Have_EPI_immunization_card == 'No' || Question_No_50_Have_EPI_immunization_card ==
            'no') {
            $("#Question_No_50_Have_EPI_immunization_card").addClass("bg-danger");
        } else {}

         var do_you_have_any_Allergies = $("#do_you_have_any_Allergies").val();
         if(do_you_have_any_Allergies == 'Yes'|| do_you_have_any_Allergies == 'yes'){
             $("#do_you_have_any_Allergies").addClass("bg-danger");
         }else{}

         var discomfort_during_urination = $("#discomfort_during_urination").val();
        if(discomfort_during_urination != 'No urinary issues reported'){
             $("#discomfort_during_urination").addClass("bg-danger");
         }else{}

         var any_menstrual_abnormality = $("#any_menstrual_abnormality").val();
         if(any_menstrual_abnormality == 'Yes' || any_menstrual_abnormality == 'yes'){
             $("#any_menstrual_abnormality").addClass("bg-danger");
         }else{}

         var any_menstrual_abnormality = $("#any_menstrual_abnormality").val();
         if(any_menstrual_abnormality == 'Yes' || any_menstrual_abnormality == 'yes'){
             $("#any_menstrual_abnormality").addClass("bg-danger");
         }else{}

        var observation1 = $("#observation1").val();
        if (observation1 == '3' || observation1 == '4') {
            $("#observation1").addClass("bg-danger");
        } else {}

        var observation2 = $("#observation2").val();
        if (observation2 == '3' || observation2 == '4') {
            $("#observation2").addClass("bg-danger");
        } else {}

        var observation3 = $("#observation3").val();
        if (observation3 == '3' || observation3 == '4') {
            $("#observation3").addClass("bg-danger");
        } else {}

        var observation4 = $("#observation4").val();
        if (observation4 == '3' || observation4 == '4') {
            $("#observation4").addClass("bg-danger");
        } else {}

        var observation5 = $("#observation5").val();
        if (observation5 == '3' || observation5 == '4') {
            $("#observation5").addClass("bg-danger");
        } else {}

        var observation6 = $("#observation6").val();
        if (observation6 == '3' || observation6 == '4') {
            $("#observation6").addClass("bg-danger");
        } else {}

        var observation7 = $("#observation7").val();
        if (observation7 == '3' || observation7 == '4') {
            $("#observation7").addClass("bg-danger");
        } else {}

        var observation8 = $("#observation8").val();
        if (observation8 == '3' || observation8 == '4') {
            $("#observation8").addClass("bg-danger");
        } else {}

        var observation9 = $("#observation9").val();
        if (observation9 == '3' || observation9 == '4') {
            $("#observation9").addClass("bg-danger");
        } else {}

        var observation10 = $("#observation10").val();
        if (observation10 == '3' || observation10 == '4') {
            $("#observation10").addClass("bg-danger");
        } else {}

        $(".observation").hide();

        var updateFields = function() {

            var value = parseFloat($("#class").val());

            if (value <= 2 || value == 'KG-2' || value == 'KG-1' || value == 'Nursery' || value ==
                'Play group') {

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

        };

        // Initial check on page load
        updateFields();

        // Attach event listeners for keyup and change events
        $("#class").on("keyup change", function() {
            updateFields();
        });

        $('#Follow_up_Required').on('change', function() {
            var selectedValue = $(this).val();

            if (selectedValue === "Yes") {

                $('#follow_up_show').removeClass('d-none');
                $("#Reason_for_Follow_up").attr('required', true);
                $("#Follow_up_Date").attr('required', true);

                $('.refer_to_form_row').removeClass('d-none');
                $("#refer_to").attr('required', true);

            } else {

                $('.refer_to_form_row').addClass('d-none');
                $("#refer_to").attr('required', false);

                $('#follow_up_show').addClass('d-none');
                $("#Reason_for_Follow_up").attr('required', false);
                $("#Follow_up_Date").attr('required', false);
                $("#Reason_for_Follow_up").val('');
                $("#Follow_up_Date").val('');



            }
        });

        $('#Follow_up_Required').change();


        function updateEventColor(referToValue) {
            var color;
            var textColor = 'white';

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

            // Apply the background and text color to the select element
            $('#refer_to').css({
                'background-color': color,
                'color': textColor
            });
        }

        // Set the initial color based on the current selected value
        var initialReferToValue = $('#refer_to').val();
        // updateEventColor(initialReferToValue);

        // Update the color whenever the dropdown value changes
        // $('#refer_to').on('change', function() {
        //     var selectedValue = $(this).val();
        //     updateEventColor(selectedValue);
        // });



        /****************************** Nutritionist ***********************************/

        /* food_allergies */
         $('#food_allergies').change(function() {


             var selectedValue = $(this).val();
            // console.log("selectedValue " + selectedValue);

            var other_food_allergies = document.getElementById("other_food_allergies");

             const food_allergiesContainer = document.getElementById('food_allergiesContainer');

             if (selectedValue === 'Yes') {


                other_food_allergies.style.setProperty('background-color', 'red', 'important');
                 other_food_allergies.style.setProperty('color', 'white', 'important');
                 food_allergiesContainer.classList.remove('d-none');

            } else {

                 other_food_allergies.style.removeProperty('background-color');
                 other_food_allergies.style.removeProperty('color');
                 food_allergiesContainer.classList.add('d-none');

             }
         });

         $('#food_allergies').change();

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

         $('#Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day').change();

        /* Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to */
         $('#Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to').change(
             function() {


                var selectedValue = $(this).val();
                 // console.log("Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to "+ selectedValue);

                 var addiction = document.getElementById("addiction");

                 // Select the container of the second form group
                 const addictionContainer = document.getElementById('addictionContainer');
                 const otherAddictionContainer = document.getElementById('otherAddictionContainer');


                 if (selectedValue === 'Yes') {

                     addiction.style.setProperty('background-color', 'red', 'important');
                    addiction.style.setProperty('color', 'white', 'important');
                     addictionContainer.classList.remove('d-none');
                     otherAddictionContainer.classList.remove('d-none');


                 } else {

                     addiction.style.removeProperty('background-color');
                     addiction.style.removeProperty('color');
                     addictionContainer.classList.add('d-none');
                     otherAddictionContainer.classList.add('d-none');

                 }
            });

         $('#Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to').change();


        /* Function to capitalize the first letter of a string */
         function capitalizeFirstLetter(string) {
                 return string.charAt(0).toUpperCase() + string.slice(1);
             }

        /* Function to capitalize the first letter of a string */
        function capitalizeFirstLetter(string) {
            if (typeof string !== 'string' || !string) {
                return ''; // Return an empty string or handle invalid input appropriately
            }
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





                } else if (selectedValue === 'Moderately Active' || selectedValue === 'Moderately') {


                    Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty(
                        'background-color', 'yellow', 'important');
                    Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty('color', 'black',
                        'important');







                } else if (selectedValue === 'Active') {


                    Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty(
                        'background-color', 'green', 'important');
                    Question_No_60_How_would_you_describe_your_lifestyle.style.setProperty('color', 'white',
                        'important');




                } else {

                    Question_No_60_How_would_you_describe_your_lifestyle.style.removeProperty(
                        'background-color');
                    Question_No_60_How_would_you_describe_your_lifestyle.style.removeProperty('color');
                    $("#Daily_energy_requirement").val('').attr('readonly', false);


                }
            });


        $('#Question_No_60_How_would_you_describe_your_lifestyle').change();





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



            } else {

                $("#age").val("");
                $("#Daily_Protien_requirement").val("").attr('readonly', false);


            }



            console.log("age " + age);
            /* Check if age is less than 5 */
            if (parseFloat(age) < 5) {


                /* Show the field and ensure the required attribute is present */
                $('#muac').closest('.form-group').show();
                $('#muac').attr('required', true);
                //    $('#muac').val('');
                $('#muac-container').show();


            } else {

                /* Hide the field and remove the required attribute */
                $('#muac').closest('.form-group').hide();
                $('#muac').removeAttr('required');
                $('#muac').val('');
                $('#muac-container').hide();


            }




        });



        $('#dob').change();


        /* weight*/
        $("#weight").on("keyup change", function(e) {

            $("#dob").change();

            var weight = parseFloat($("#weight").val());
            var dailyEnergyRequirement = parseFloat($("#Daily_Protien_requirement").val());
            /*console.log("weight "+ weight);
            console.log("dailyEnergyRequirement "+ dailyEnergyRequirement);*/

            if (weight > 0) {

                var dailyProteinRequirement = dailyEnergyRequirement * weight;

                console.log('dailyProteinRequirement', dailyProteinRequirement);


                // Format to at least 3 decimal places
                var formattedDailyProteinRequirement = dailyProteinRequirement.toFixed(3);

                console.log('formattedDailyProteinRequirement', formattedDailyProteinRequirement);

                /*console.log("dailyProteinRequirement "+ formattedDailyProteinRequirement);*/

                $("#Daily_Protien_requirement").val(formattedDailyProteinRequirement).attr('readonly',
                    true);
            }

        });

        $("#weight").change();


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


        $('#lifestyle').change();



        /* meals*/
        $('#meals').change(function() {
            var selectedValue = $(this).val();
            // console.log("meals " + selectedValue);

            if (selectedValue === "1") {

                this.style.setProperty('background-color', 'red', 'important');
                this.style.setProperty('color', 'white', 'important');

            } else {

                this.style.removeProperty('background-color');
                this.style.removeProperty('color');
            }
        });


        $('#meals').change();



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


        $('#food_items').change();



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

           function computeExposureResult() {
    // get all field values
    var v48 = ($('#Question_No_48_Frequently_put_things_in_mouth').val() || '').toLowerCase();
    var v49 = ($('#Question_No_49_Child_eat_non_food_items_pica').val() || '').toLowerCase();
    var v50 = ($('#Question_No_50_Contact_adult_job_lead_exposure').val() || '').toLowerCase();
    var v51 = ($('#Question_No_51_Contact_adult_hobby_lead_exposure').val() || '').toLowerCase();

    // reset backgrounds first
    $('#Question_No_48_Frequently_put_things_in_mouth, #Question_No_49_Child_eat_non_food_items_pica, #Question_No_50_Contact_adult_job_lead_exposure, #Question_No_51_Contact_adult_hobby_lead_exposure')
        .css({ 'background-color': '', 'color': '' });

    // check conditions
    var anyYes = false;

    if (v48 === 'yes') {
        $('#Question_No_48_Frequently_put_things_in_mouth').css({ 'background-color': 'red', 'color': 'white' });
        anyYes = true;
    }

    if (v49 === 'yes') {
        $('#Question_No_49_Child_eat_non_food_items_pica').css({ 'background-color': 'red', 'color': 'white' });
        anyYes = true;
    }

    if (v50 !== '' && v50 !== 'none of above') {
    // console.log(v50);
        $('#Question_No_50_Contact_adult_job_lead_exposure').css({ 'background-color': 'red', 'color': 'white' });
        anyYes = true;
    }

    if (v51 !== '' && v51 !== 'none of the above') {
        //   console.log(v51);
        $('#Question_No_51_Contact_adult_hobby_lead_exposure').css({ 'background-color': 'red', 'color': 'white' });
        anyYes = true;
    }

    // update output field
    var $out = $('#expouser_result');
    if ($out.length) {
        if (anyYes) {
            $out.val('Yes');
            $out.css({ 'background-color': 'red', 'color': 'white' });
        } else {
            $out.val('No');
            $out.css({ 'background-color': 'green', 'color': 'white' });
        }
    }
}

computeExposureResult();
    $(document).on('change', '#Question_No_48_Frequently_put_things_in_mouth, #Question_No_49_Child_eat_non_food_items_pica, #Question_No_50_Contact_adult_job_lead_exposure, #Question_No_51_Contact_adult_hobby_lead_exposure', function() {
    computeExposureResult();
});
        // $('.NutritionistCol').find('input, select, textarea').attr('disabled', true);
        $('.NutritionistCol').find('input, select, textarea').not('#Follow_up_Date, #FollowUpCheck,#FollowUpCheckforPhycologist,#Follow_up_DateforPhycologist,#Follow_up_DateforExternal,#FollowUpCheckforExternal,#Follow_up_Dateforgeneralphysician,#Follow_up_forgeneralphysician').attr(
            'disabled', true);

        /************************************************************************************************/



        $('#PsychologistFindings').click(function(e) {
            var comment = $('#findings_by_psychologist').val();
            var PsychologistRefferedTo = $('#PsychologistRefferedTo').val();
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ url('PsychologistFindings') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: {{ $form_id }},
                    comment: comment,
                    PsychologistRefferedTo: PsychologistRefferedTo,
                },
                dataType: "json",
                beforeSend: function() {

                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Enrollment has been submitted successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 2000, // Set the timer to 2 seconds (in milliseconds)
                        timerProgressBar: true, // Show a progress bar during the timer
                        showConfirmButton: false // Hide the "OK" button
                    }).then(() => {
                        // window.location.href = "{{ route('admin.form_entry.index') }}"
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        $('#psychiatrist').click(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ url('ViewByphy') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: {{ $form_id }},
                },
                dataType: "json",
                beforeSend: function() {

                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Enrollment has been submitted successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 2000, // Set the timer to 2 seconds (in milliseconds)
                        timerProgressBar: true, // Show a progress bar during the timer
                        showConfirmButton: false // Hide the "OK" button
                    }).then(() => {
                        window.location.href =
                            "https://cphs.biopharmainfo.net/admin/screening"
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
        $('#nutritionist').click(function(e) {

            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ url('ViewBynutritionist') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: {{ $form_id }},
                },
                dataType: "json",
                beforeSend: function() {

                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Enrollment has been submitted successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 2000, // Set the timer to 2 seconds (in milliseconds)
                        timerProgressBar: true, // Show a progress bar during the timer
                        showConfirmButton: false // Hide the "OK" button
                    }).then(() => {
                        window.location.href =
                            "https://cphs.biopharmainfo.net/admin/screening"
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
        $('#doc').click(function(e) {
          
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ url('ViewByDoc') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: {{ $form_id }},
                   
                },
                dataType: "json",
                beforeSend: function() {

                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Enrollment has been submitted successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 2000, // Set the timer to 2 seconds (in milliseconds)
                        timerProgressBar: true, // Show a progress bar during the timer
                        showConfirmButton: false // Hide the "OK" button
                    }).then(() => {
                        window.location.href =
                           "https://cphs.biopharmainfo.net/admin/screening"
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
        $('#docComment').click(function(e) {
            var comment = $('#doctor_comment').val();
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ url('DoctorComment') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: {{ $form_id }},
                    doctor_comment:comment,
                },
                dataType: "json",
                beforeSend: function() {

                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Comment has been submitted successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 2000, // Set the timer to 2 seconds (in milliseconds)
                        timerProgressBar: true, // Show a progress bar during the timer
                        showConfirmButton: false // Hide the "OK" button
                    }).then(() => {
                        window.location.href =
                           "https://cphs.biopharmainfo.net/admin/screening"
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
        // new code 
        function setBMIBasedOnValue(bmiValue, bmiInputId) {
            var bmiInput = $(bmiInputId);
            if (bmiValue <= 18.4 || bmiValue >= 24.10) {
                // bmiInput.addClass("bg-danger");
                // $("#bmishow").val("High");
                // $("#bmiresult").val('High');
            } else {
                // bmiInput.removeClass("bg-danger");
                // $("#bmishow").val("Normal");
                // $("#bmiresult").val('Normal');
            }
        }

        // Fetch and apply color for initial BMI values
        var initialBMI = parseFloat("{{ $details['question_no_3_bmi'] }}"); // For Question No.3
        if (!isNaN(initialBMI)) {
            setBMIBasedOnValue(initialBMI, '#bmi');
        }

        var initialBMI61 = parseFloat("{{ $details['bmi61'] }}"); // For Question No.61
        if (!isNaN(initialBMI61)) {
            setBMIBasedOnValue(initialBMI61, '#bmi61');
        }

        // Existing keyup/change logic for height and weight
        $("#weight, #height").on("keyup change", function(e) {
            var height = $('#height').val();
            var weight = $('#weight').val();
            if (height != '' && height > 0 && weight != '' && weight > 0) {
                var result = (weight / height / height) * 10000;
                $('#bmi').val(result.toFixed(2));
                setBMIBasedOnValue(result, '#bmi');
            }
        });

        // Add additional logic to calculate and set the BMI for bmi61 if needed
        $("#weight61, #height61").on("keyup change", function(e) {
            var height61 = $('#height61').val(); // Make sure you have this input
            var weight61 = $('#weight61').val(); // Make sure you have this input
            if (height61 != '' && height61 > 0 && weight61 != '' && weight61 > 0) {
                var result61 = (weight61 / height61 / height61) * 10000;
                $('#bmi61').val(result61.toFixed(2));
                setBMIBasedOnValue(result61, '#bmi61');
            }
        });

        

        function validatePulse() {
            var pulse = parseInt($('#Question_No_7_Pulse').val());
            var age = parseInt($('#age').val());

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
        }

        // Initial validation on page load
        validatePulse();
    var play_ground_Cognitive_Result = $('#play_ground_Cognitive_Result').val();
    if(play_ground_Cognitive_Result == 'Healthy Cognitions'){               
                 $('#play_ground_Cognitive_Result').css('background-color', 'green');
                 $('#play_ground_Cognitive_Result').css('color', 'white');
                }else if(play_ground_Cognitive_Result == 'Needs Assessment'){                    
                    $('#play_ground_Cognitive_Result').css('background-color', 'red');
                    $('#play_ground_Cognitive_Result').css('color', 'white');
                }

var play_ground_Motor_Result = $('#play_ground_Motor_Result').val();
  if(play_ground_Motor_Result == 'Well-Coordinated'){
            
            $('#play_ground_Motor_Result').css('background-color', 'green');
            $('#play_ground_Motor_Result').css('color', 'white');
        }else if(play_ground_Motor_Result == 'Needs Assessment'){
            $('#play_ground_Motor_Result').val('Needs Assessment');
            $('#play_ground_Motor_Result').css('background-color', 'red');
            $('#play_ground_Motor_Result').css('color', 'white');
        }   
        
        var play_ground_Language_Result = parseInt($('#play_ground_Language_Result').val());
         if(play_ground_Language_Result == 'Clear Communicator'){            
            $('#play_ground_Language_Result').css('background-color', 'green');
            $('#play_ground_Language_Result').css('color', 'white');
        }else if(play_ground_Language_Result == 'Needs Assessment'){
            $('#play_ground_Language_Result').css('background-color', 'red');
            $('#play_ground_Language_Result').css('color', 'white');
        }

            var play_ground_SocialEmotional_Result = $('#play_ground_SocialEmotional_Result').val();
         if(play_ground_SocialEmotional_Result == 'Socially Engaged'){
            $('#play_ground_SocialEmotional_Result').css('background-color', 'green');
            $('#play_ground_SocialEmotional_Result').css('color', 'white');
        }else if(play_ground_SocialEmotional_Result == 'Needs Assessment'){
            $('#play_ground_SocialEmotional_Result').css('background-color', 'red');
            $('#play_ground_SocialEmotional_Result').css('color', 'white');
        }

            var play_ground_Adaptive_Result = $('#play_ground_Adaptive_Result').val();
         if(play_ground_Adaptive_Result == 'Good Adaptability') {
            $('#play_ground_Adaptive_Result').css('background-color', 'green');
            $('#play_ground_Adaptive_Result').css('color', 'white');
        }else if(play_ground_Adaptive_Result == 'Needs Assessment'){
            $('#play_ground_Adaptive_Result').css('background-color', 'red');
            $('#play_ground_Adaptive_Result').css('color', 'white');
        }
var nursery_Cognitive_Result = $('#nursery_Cognitive_Result').val();

           if(nursery_Cognitive_Result == 'Healthy Cognitions'){
            $('#nursery_Cognitive_Result').css('background-color', 'green');
            $('#nursery_Cognitive_Result').css('color', 'white');
        }else if(nursery_Cognitive_Result == 'Needs Assessment'){
            $('#nursery_Cognitive_Result').css('background-color', 'red');
            $('#nursery_Cognitive_Result').css('color', 'white');
        }

var nursery_Motor_Result = $('#nursery_Motor_Result').val();
          if(nursery_Motor_Result == 'Well-Coordinated'){
            $('#nursery_Motor_Result').css('background-color', 'green');
            $('#nursery_Motor_Result').css('color', 'white');
        }else if(nursery_Motor_Result == 'Needs Assessment'){
            $('#nursery_Motor_Result').css('background-color', 'red');
            $('#nursery_Motor_Result').css('color', 'white');
        }
var nursery_Language_Result = $('#nursery_Language_Result').val();
   if(nursery_Language_Result == 'Clear Communicator'){
            $('#nursery_Language_Result').css('background-color', 'green');
            $('#nursery_Language_Result').css('color', 'white');
        }else if(nursery_Language_Result == 'Needs Assessment'){
            $('#nursery_Language_Result').css('background-color', 'red');
            $('#nursery_Language_Result').css('color', 'white');
        }

var nursery_SocialEmotional_Result = $('#nursery_SocialEmotional_Result').val();
          if(nursery_SocialEmotional_Result == 'Socially Engaged'){
            $('#nursery_SocialEmotional_Result').css('background-color', 'green');
            $('#nursery_SocialEmotional_Result').css('color', 'white');
        }else if(nursery_SocialEmotional_Result == 'Needs Assessment'){
            $('#nursery_SocialEmotional_Result').css('background-color', 'red');
            $('#nursery_SocialEmotional_Result').css('color', 'white');
        }

var nursery_Adaptive_Result = $('#nursery_Adaptive_Result').val();
         if(nursery_Adaptive_Result == 'Good Adaptability'){
            $('#nursery_Adaptive_Result').css('background-color', 'green');
            $('#nursery_Adaptive_Result').css('color', 'white');
        }else if(nursery_Adaptive_Result == 'Needs Assessment'){
            $('#nursery_Adaptive_Result').css('background-color', 'red');
            $('#nursery_Adaptive_Result').css('color', 'white');
        }

var kindergarten_Cognitive_Result = $('#kindergarten_Cognitive_Result').val();
           if(kindergarten_Cognitive_Result == 'Healthy Cognitions'){
            $('#kindergarten_Cognitive_Result').css('background-color', 'green');
            $('#kindergarten_Cognitive_Result').css('color', 'white');
        }else if(kindergarten_Cognitive_Result == 'Needs Assessment'){
            $('#kindergarten_Cognitive_Result').css('background-color', 'red');
            $('#kindergarten_Cognitive_Result').css('color', 'white');
        }

        var kindergarten_Motor_Result = $('#kindergarten_Motor_Result').val();
 if(kindergarten_Motor_Result == 'Well-Coordinated' ){
            $('#kindergarten_Motor_Result').val('Well-Coordinated');
            $('#kindergarten_Motor_Result').css('background-color', 'green');
            $('#kindergarten_Motor_Result').css('color', 'white');
        }else{
            $('#kindergarten_Motor_Result').val('Needs Assessment');
            $('#kindergarten_Motor_Result').css('background-color', 'red');
            $('#kindergarten_Motor_Result').css('color', 'white');
        }

var kindergarten_Language_Result = $('#kindergarten_Language_Result').val();
       if(kindergarten_Language_Result == 'Clear Communicator'){
            
            $('#kindergarten_Language_Result').css('background-color', 'green');
            $('#kindergarten_Language_Result').css('color', 'white');
        }else if(kindergarten_Language_Result == 'Needs Assessment'){    
            $('#kindergarten_Language_Result').css('background-color', 'red');
            $('#kindergarten_Language_Result').css('color', 'white');
        }
var kindergarten_SocialEmotional_Result = $('#kindergarten_SocialEmotional_Result').val();
         if(kindergarten_SocialEmotional_Result == 'Socially Engaged'){
            $('#kindergarten_SocialEmotional_Result').css('background-color', 'green');
            $('#kindergarten_SocialEmotional_Result').css('color', 'white');
        }else if(kindergarten_SocialEmotional_Result == 'Needs Assessment'){    
            $('#kindergarten_SocialEmotional_Result').css('background-color', 'red');
            $('#kindergarten_SocialEmotional_Result').css('color', 'white');
        }
var kindergarten_Adaptive_Result = $('#kindergarten_Adaptive_Result').val();
         if(kindergarten_Adaptive_Result == 'Good Adaptability'){
            $('#kindergarten_Adaptive_Result').css('background-color', 'green');
            $('#kindergarten_Adaptive_Result').css('color', 'white');
        }else if(kindergarten_Adaptive_Result == 'Needs Assessment'){    
            $('#kindergarten_Adaptive_Result').css('background-color', 'red');
            $('#kindergarten_Adaptive_Result').css('color', 'white');
        }

var social_emotional_score = $('input[name="social_emotional_result"]').val();
         if(social_emotional_score == 'No concern'){
            $('input[name="social_emotional_result"]').css('background-color', 'green');
            $('input[name="social_emotional_result"]').css('color', 'white');          
        }else if(social_emotional_score == 'Moderate concern'){
            $('input[name="social_emotional_result"]').css('background-color', 'orange');
            $('input[name="social_emotional_result"]').css('color', 'black');
        }else if(social_emotional_score == 'High concern'){
            $('input[name="social_emotional_result"]').css('background-color', 'red');
            $('input[name="social_emotional_result"]').css('color', 'white');
        }

var externalizing_social_emotional_score = $('input[name="externalizing_social_emotional_score"]').val();        
        if(externalizing_social_emotional_score == 'No concern'){
            $('input[name="externalizing_social_emotional_score"]').val('No concern');
            $('input[name="externalizing_social_emotional_score"]').css('background-color', 'green');
            $('input[name="externalizing_social_emotional_score"]').css('color', 'white'); 
        }else if(externalizing_social_emotional_score == 'Moderate concern'){
            $('input[name="externalizing_social_emotional_score"]').val('Moderate concern');
            $('input[name="externalizing_social_emotional_score"]').css('background-color', 'orange');
            $('input[name="externalizing_social_emotional_score"]').css('color', 'black');           
        }else if(externalizing_social_emotional_score == 'High concern'){
            $('input[name="externalizing_social_emotional_score"]').val('High concern');
            $('input[name="externalizing_social_emotional_score"]').css('background-color', 'red');
            $('input[name="externalizing_social_emotional_score"]').css('color', 'white'); 
        }

        var Attention_social_emotional_score =  $('input[name="social_emotional_Attention_result"]').val();
         if(Attention_social_emotional_score == 'No concern'){
            $('input[name="social_emotional_Attention_result"]').css('background-color', 'green');
            $('input[name="social_emotional_Attention_result"]').css('color', 'white');
        }else if(Attention_social_emotional_score == 'Moderate concern'){
            $('input[name="social_emotional_Attention_result"]').css('background-color', 'orange');
            $('input[name="social_emotional_Attention_result"]').css('color', 'black');
        }else if(Attention_social_emotional_score == 'High concern'){
            $('input[name="social_emotional_Attention_result"]').css('background-color', 'red');
            $('input[name="social_emotional_Attention_result"]').css('color', 'white');
        }

        var emotional_score = $('input[name="emotional_behavior_result"]').val();
 if(emotional_score == 'No concerns'){
            $('input[name="emotional_behavior_result"]').css('background-color', '#90EE90');
            $('input[name="emotional_behavior_result"]').css('color', 'black');
        }else if(emotional_score == 'Moderate Concerns'){
            $('input[name="emotional_behavior_result"]').css('background-color', 'orange');
            $('input[name="emotional_behavior_result"]').css('color', 'black');
        
        }else if(emotional_score == 'High Concerns'){
            $('input[name="emotional_behavior_result"]').css('background-color', '#FF6B6B');
            $('input[name="emotional_behavior_result"]').css('color', 'white');           
        }
        
        var behavioral_score = $('input[name="behavioral_issues_result"]').val();
        if(behavioral_score == 'No  Concerns'){
            $('input[name="behavioral_issues_result"]').css('background-color', '#90EE90');
            $('input[name="behavioral_issues_result"]').css('color', 'black');          
        }else if(behavioral_score == 'Moderate Concerns'){            
            $('input[name="behavioral_issues_result"]').css('background-color', 'orange');
            $('input[name="behavioral_issues_result"]').css('color', 'black');          
        }else if(behavioral_score == 'High  Concerns'){
            $('input[name="behavioral_issues_result"]').css('background-color', '#FF6B6B');
            $('input[name="behavioral_issues_result"]').css('color', 'white');        
        }
        
var attention_score = $('input[name="attention_issues_result"]').val();
        if(attention_score == 'No  Concerns'){
            $('input[name="attention_issues_result"]').css('background-color', '#90EE90');
            $('input[name="attention_issues_result"]').css('color', 'black');
           
        }else if(attention_score == 'Moderate  Concerns'){
            $('input[name="attention_issues_result"]').css('background-color', 'orange');
            $('input[name="attention_issues_result"]').css('color', 'black');
            
        }else if(attention_score == 'High  Concerns'){
            $('input[name="attention_issues_result"]').css('background-color', '#FF6B6B');
            $('input[name="attention_issues_result"]').css('color', 'white');            
        }

        var autism_spectrum_score = $('input[name="autism_spectrum_result"]').val();
        if(autism_spectrum_score == 'Typical Development'){
            $('input[name="autism_spectrum_result"]').css('background-color', 'green');
            $('input[name="autism_spectrum_result"]').css('color', 'black');
        }else if(autism_spectrum_score == 'Mild concerns'){
            $('input[name="autism_spectrum_result"]').css('background-color', 'yellow');
            $('input[name="autism_spectrum_result"]').css('color', 'black');
        }else if(autism_spectrum_score == 'Moderate Concerns'){
            $('input[name="autism_spectrum_result"]').css('background-color', 'red');
            $('input[name="autism_spectrum_result"]').css('color', 'black');
        }else if(autism_spectrum_score == 'Significant Concerns'){
            $('input[name="autism_spectrum_result"]').css('background-color', 'red');
            $('input[name="autism_spectrum_result"]').css('color', 'black');
        }
        
        var play_ground_Language_Result = $('#play_ground_Language_Result').val();
          if(play_ground_Language_Result == 'Clear Communicator'){
 
            $('#play_ground_Language_Result').css('background-color', 'green');
            $('#play_ground_Language_Result').css('color', 'white');
        }else if(play_ground_Language_Result == 'Needs Assessment'){
            $('#play_ground_Language_Result').css('background-color', 'red');
            $('#play_ground_Language_Result').css('color', 'white');
        }

var classToFilter = $('#class').val();
$('#nursary_developmenr,#playground_kindergarten_social_emotional,#playground_kindergarten_autism_spectrum,#playgound_developmenr,#kindergarten_developmenr,#primary_secondary,#step16,#muac-container').addClass('d-none');
                
                switch(classToFilter) {
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
                    var numValue = parseFloat(classToFilter);
                    if(!isNaN(numValue) && numValue >= 1) {
                        // $('#step16').removeClass('d-none');
                      $('#primary_secondary').removeClass('d-none');
                    //  $('#step16').addClass('d-none');
                    }
                    break;
                }

    }); 
</script>
