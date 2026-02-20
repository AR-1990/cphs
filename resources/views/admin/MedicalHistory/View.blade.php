@extends('admin.main')
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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

        .form-row {
            align-items: end;
        }
        

         /* Hide the arrow for select boxes */
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        /* Add other styling properties as needed */
    }
    </style>



    <div class="container">
        <h2 class="text-center">
            Medical History and Presenting Complaints Form

        </h2>



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



        <form id="multiStepForm" method="post" action="{{ route('CreateMedicalHistory') }}" enctype="multipart/form-data">
            @csrf


            <div class="step active" id="step1">
                <h3>Patient Information</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="gr_no">GR.No.</label>
                            <input type="text" class="form-control" id="GrNo" name="GrNo" required
                                @if (!empty($GeneralInfo['GrNo'])) value="{{ $GeneralInfo['GrNo'] }}"
                        @else
                        value="{{ old('GrNo') }}" @endif>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                @if (!empty($GeneralInfo['name'])) value="{{ $GeneralInfo['name'] }}"
                        @else
                        value="{{ old('name') }}" @endif
                                required>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="class">Class</label>
                            <input type="text" class="form-control" id="class" name="class"
                                @if (!empty($GeneralInfo['class'])) value="{{ $GeneralInfo['class'] }}"
                        @else
                        value="{{ old('class') }}" @endif
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                @if (!empty($GeneralInfo['dob'])) value="{{ $GeneralInfo['dob'] }}"
                        @else
                        value="{{ old('dob') }}" @endif
                                required>
                        </div>
                    </div>

                   
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender </label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select</option>
                                <option value="male" @if (!empty($GeneralInfo['gender']) && $GeneralInfo['gender'] == 'male') selected @endif>Male</option>
                                <option value="female" @if (!empty($GeneralInfo['gender']) && $GeneralInfo['gender'] == 'female') selected @endif>Female</option>
                                <option value="other" @if (!empty($GeneralInfo['gender']) && $GeneralInfo['gender'] == 'other') selected @endif>Other</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="BloodGroup">Blood group</label>
                            <select class="form-control" id="BloodGroup" name="BloodGroup" required>
                                <option value="" @if (empty($GeneralInfo['BloodGroup'])) selected @endif>Select</option>
                                <option value="A+" @if (!empty($GeneralInfo['BloodGroup']) && $GeneralInfo['BloodGroup'] == 'A+') selected @endif>A+</option>
                                <option value="A-" @if (!empty($GeneralInfo['BloodGroup']) && $GeneralInfo['BloodGroup'] == 'A-') selected @endif>A-</option>
                                <option value="B+" @if (!empty($GeneralInfo['BloodGroup']) && $GeneralInfo['BloodGroup'] == 'B+') selected @endif>B+</option>
                                <option value="B-" @if (!empty($GeneralInfo['BloodGroup']) && $GeneralInfo['BloodGroup'] == 'B-') selected @endif>B-</option>
                                <option value="O+" @if (!empty($GeneralInfo['BloodGroup']) && $GeneralInfo['BloodGroup'] == 'O+') selected @endif>O+</option>
                                <option value="O-" @if (!empty($GeneralInfo['BloodGroup']) && $GeneralInfo['BloodGroup'] == 'O-') selected @endif>O-</option>
                                <option value="AB+" @if (!empty($GeneralInfo['BloodGroup']) && $GeneralInfo['BloodGroup'] == 'AB+') selected @endif>AB+</option>
                                <option value="AB-" @if (!empty($GeneralInfo['BloodGroup']) && $GeneralInfo['BloodGroup'] == 'AB-') selected @endif>AB-</option>
                                <option value="Unknown" @if (!empty($GeneralInfo['BloodGroup']) && $GeneralInfo['BloodGroup'] == 'Unknown') selected @endif>Unknown</option>
                            </select>
                            
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="tel" class="form-control" id="contact" name="contact"
                                @if (!empty($GeneralInfo['contact'])) value="{{ $GeneralInfo['contact'] }}"
                        @else
                        value="{{ old('contact') }}" @endif
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                @if (!empty($GeneralInfo['email'])) value="{{ $GeneralInfo['email'] }}"
                        @else
                        value="{{ old('email') }}" @endif
                                required>
                        </div>
                    </div>
                    <hr>
                    <h6 class="w-100">
                        Emergency Contact
                    </h6>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="emergency_name">Name</label>
                            <input type="text" class="form-control" id="emergency_name" name="emergency_name"
                                @if (!empty($GeneralInfo['emergency_name'])) value="{{ $GeneralInfo['emergency_name'] }}"
                        @else
                        value="{{ old('emergency_name') }}" @endif
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="emergency_relationship">Relationship</label>
                            <input type="text" class="form-control" id="emergency_relationship"
                                name="emergency_relationship"
                                @if (!empty($GeneralInfo['emergency_relationship'])) value="{{ $GeneralInfo['emergency_relationship'] }}"
                        @else
                        value="{{ old('emergency_relationship') }}" @endif
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="emergency_contact">Contact</label>
                            <input type="tel" class="form-control" id="emergency_contact" name="emergency_contact"
                                @if (!empty($GeneralInfo['emergency_contact'])) value="{{ $GeneralInfo['emergency_contact'] }}"
                        @else
                        value="{{ old('emergency_contact') }}" @endif
                                required>
                        </div>
                    </div>
                </div>
                {{-- <button type="button" class="btn btn-primary nextStep">Next</button> --}}
            </div>


            <div class="step  active" id="step2">
                <h3>Presenting Complaints</h3>

                <h6 class="w-100">
                    Main Complaint
                </h6>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="Description" name="Description" 
                            
                            @if (!empty($MainComplaint['Description'])) value="{{ $MainComplaint['Description'] }}"
                            @else
                            value="{{ old('Description') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="onset">Onset</label>
                            <input type="text" class="form-control" id="Onset" name="Onset" 
                            
                            @if (!empty($MainComplaint['Onset'])) value="{{ $MainComplaint['Onset'] }}"
                            @else
                            value="{{ old('Onset') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="Duration" name="Duration" 
                            
                            @if (!empty($MainComplaint['Duration'])) value="{{ $MainComplaint['Duration'] }}"
                            @else
                            value="{{ old('Duration') }}" @endif 
                            
                            required>




                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="severity">Severity (Scale 1-10)</label>
                            <select class="form-control" id="Severity" name="Severity" required>
                                <option value="" @if (empty($MainComplaint['Severity']) && !old('Severity')) selected @endif>Select</option>
                                <option value="1" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '1' || old('Severity') == '1') selected @endif>1</option>
                                <option value="2" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '2' || old('Severity') == '2') selected @endif>2</option>
                                <option value="3" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '3' || old('Severity') == '3') selected @endif>3</option>
                                <option value="4" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '4' || old('Severity') == '4') selected @endif>4</option>
                                <option value="5" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '5' || old('Severity') == '5') selected @endif>5</option>
                                <option value="6" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '6' || old('Severity') == '6') selected @endif>6</option>
                                <option value="7" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '7' || old('Severity') == '7') selected @endif>7</option>
                                <option value="8" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '8' || old('Severity') == '8') selected @endif>8</option>
                                <option value="9" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '9' || old('Severity') == '9') selected @endif>9</option>
                                <option value="10" @if (!empty($MainComplaint) && $MainComplaint['Severity'] == '10' || old('Severity') == '10') selected @endif>10</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="RelievingFactor">Aggravating/Relieving Factors</label>
                            <input type="text" class="form-control" id="RelievingFactor" name="RelievingFactor"

                            @if (!empty($MainComplaint['RelievingFactor'])) value="{{ $MainComplaint['RelievingFactor'] }}"
                            @else
                            value="{{ old('RelievingFactor') }}" @endif 



                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="associated_symptoms">Associated Symptoms</label>
                            <input type="text" class="form-control" id="AssociatedSymptoms" name="AssociatedSymptoms"

                            @if (!empty($MainComplaint['AssociatedSymptoms'])) value="{{ $MainComplaint['AssociatedSymptoms'] }}"
                            @else
                            value="{{ old('AssociatedSymptoms') }}" @endif 



                                required>
                        </div>
                    </div>
                </div>

                <h6 class="w-100">
                    Secondary Complaints (if any)
                </h6>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Description2">Description</label>
                            <input type="text" class="form-control" id="Description2" name="Description2" 
                            
                            
                            
                            @if (!empty($SecondaryComplain['Description'])) value="{{ $SecondaryComplain['Description'] }}"
                            @else
                            value="{{ old('Description2') }}" @endif 
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Onset2">Onset</label>
                            <input type="text" class="form-control" id="Onset2" name="Onset2"
                            
                            
                              @if (!empty($SecondaryComplain['Onset'])) value="{{ $SecondaryComplain['Onset'] }}"
                            @else
                            value="{{ old('Onset2') }}" @endif
                            
                            
                             required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Duration2">Duration</label>
                            <input type="text" class="form-control" id="Duration2" name="Duration2" 
                            
                            @if (!empty($SecondaryComplain['Duration'])) value="{{ $SecondaryComplain['Duration'] }}"
                            @else
                            value="{{ old('Duration2') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Severity2">Severity (Scale 1-10)</label>

                            <select class="form-control" id="Severity2" name="Severity2" required>
                                <option value="" @if (empty($SecondaryComplain['Severity']) && !old('Severity2')) selected @endif>Select</option>
                                
                                @foreach(range(1, 10) as $number)
                                    <option value="{{ $number }}" @if (($SecondaryComplain['Severity'] ?? old('Severity2')) == $number) selected @endif>{{ $number }}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="RelievingFactor2">Aggravating/Relieving Factors</label>
                            <input type="text" class="form-control" id="RelievingFactor2" name="RelievingFactor2"

                            @if (!empty($SecondaryComplain['RelievingFactor'])) value="{{ $SecondaryComplain['RelievingFactor'] }}"
                            @else
                            value="{{ old('RelievingFactor2') }}" @endif


                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="AssociatedSymptoms2">Associated Symptoms</label>
                            <input type="text" class="form-control" id="AssociatedSymptoms2"
                                name="AssociatedSymptoms2" 
                                
                                @if (!empty($SecondaryComplain['AssociatedSymptoms'])) value="{{ $SecondaryComplain['AssociatedSymptoms'] }}"
                                @else
                                value="{{ old('AssociatedSymptoms2') }}" @endif
                                
                                
                                required>
                        </div>
                    </div>
                </div>

                <h6 class="w-100">
                    Recent Changes or Symptoms of Concern
                </h6>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Description3">Description</label>
                            <input type="text" class="form-control" id="Description3" name="Description3" 
                            
                            @if (!empty($RecentChangesOrConcern['Description'])) value="{{ $RecentChangesOrConcern['Description'] }}"
                            @else
                            value="{{ old('Description3') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Onset3">Onset</label>
                            <input type="text" class="form-control" id="Onset3" name="Onset3"
                            
                            @if (!empty($RecentChangesOrConcern['Onset'])) value="{{ $RecentChangesOrConcern['Onset'] }}"
                            @else
                            value="{{ old('Onset3') }}" @endif
                            
                            
                            
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Duration3">Duration</label>
                            <input type="text" class="form-control" id="Duration3" name="Duration3"
                            
                            @if (!empty($RecentChangesOrConcern['Duration'])) value="{{ $RecentChangesOrConcern['Duration'] }}"
                            @else
                            value="{{ old('Duration3') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Severity3">Severity (Scale 1-10)</label>
                            
                            

                            <select class="form-control" id="Severity3" name="Severity3" required>
                                <option value="" @if (empty($RecentChangesOrConcern['Severity']) && !old('Severity3')) selected @endif>Select</option>
                                <option value="1" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '1') selected @elseif(old('Severity3') == '1') selected @endif>1</option>
                                <option value="2" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '2') selected @elseif(old('Severity3') == '2') selected @endif>2</option>
                                <option value="3" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '3') selected @elseif(old('Severity3') == '3') selected @endif>3</option>
                                <option value="4" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '4') selected @elseif(old('Severity3') == '4') selected @endif>4</option>
                                <option value="5" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '5') selected @elseif(old('Severity3') == '5') selected @endif>5</option>
                                <option value="6" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '6') selected @elseif(old('Severity3') == '6') selected @endif>6</option>
                                <option value="7" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '7') selected @elseif(old('Severity3') == '7') selected @endif>7</option>
                                <option value="8" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '8') selected @elseif(old('Severity3') == '8') selected @endif>8</option>
                                <option value="9" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '9') selected @elseif(old('Severity3') == '9') selected @endif>9</option>
                                <option value="10" @if (!empty($RecentChangesOrConcern['Severity']) && $RecentChangesOrConcern['Severity'] == '10') selected @elseif(old('Severity3') == '10') selected @endif>10</option>
                            </select>


                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="RelievingFactor3">Aggravating/Relieving Factors</label>
                            <input type="text" class="form-control" id="RelievingFactor3" name="RelievingFactor3"

                            @if (!empty($RecentChangesOrConcern['RelievingFactor'])) value="{{ $RecentChangesOrConcern['RelievingFactor'] }}"
                            @else
                            value="{{ old('RelievingFactor3') }}" @endif


                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="AssociatedSymptoms3">Associated Symptoms</label>
                            <input type="text" class="form-control" id="AssociatedSymptoms3"
                                name="AssociatedSymptoms3" 
                                
                                @if (!empty($RecentChangesOrConcern['AssociatedSymptoms'])) value="{{ $RecentChangesOrConcern['AssociatedSymptoms'] }}"
                                @else
                                value="{{ old('AssociatedSymptoms3') }}" @endif
    
    
    
                                required>
                        </div>
                    </div>

                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>


            <div class="step active" id="step3">
                <h3>VITAL SIGNS</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="pulse">Pulse</label>
                            <input type="text" class="form-control" id="pulse" name="pulse" 
                            
                            @if (!empty($VitalSign['pulse'])) value="{{ $VitalSign['pulse'] }}"
                            @else
                            value="{{ old('pulse') }}" @endif
                          
                          
                          
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="temperature">Temperature</label>
                            <input type="text" class="form-control" id="temperature" name="temperature"
                            
                            @if (!empty($VitalSign['temperature'])) value="{{ $VitalSign['temperature'] }}"
                            @else
                            value="{{ old('temperature') }}" @endif
                            
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="bp">bp</label>
                            <input type="text" class="form-control" id="bp" name="bp" 
                            
                            @if (!empty($VitalSign['bp'])) value="{{ $VitalSign['bp'] }}"
                            @else
                            value="{{ old('bp') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="RespiratoryRate">Respiratory Rate</label>
                            <input type="text" class="form-control" id="RespiratoryRate" name="RespiratoryRate"

                            @if (!empty($VitalSign['RespiratoryRate'])) value="{{ $VitalSign['RespiratoryRate'] }}"
                            @else
                            value="{{ old('RespiratoryRate') }}" @endif


                                required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="bmi_weight">BMI Weight</label>
                            <input type="text" class="form-control" id="bmi_weight" name="bmi_weight" 
                            
                            @if (!empty($VitalSign['bmi_weight'])) value="{{ $VitalSign['bmi_weight'] }}"
                            @else
                            value="{{ old('bmi_weight') }}" @endif




                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="bmi_height">BMI Height</label>
                            <input type="text" class="form-control" id="bmi_height" name="bmi_height" 
                            
                            @if (!empty($VitalSign['bmi_height'])) value="{{ $VitalSign['bmi_height'] }}"
                            @else
                            value="{{ old('bmi_height') }}" @endif



                            required>
                        </div>
                    </div>
                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>

            <div class="step active" id="step4">
                <h3>Fever History</h3>
                <h6 class="w-100">
                    Temperature Measurement
                </h6>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="actual_temperature">Actual temperature measured (e.g., with a thermometer)</label>
                            <input type="text" class="form-control" id="actual_temperature" name="actual_temperature"
                                
                            
                            @if (!empty($FeverHistory['temperature'])) value="{{ $FeverHistory['temperature'] }}"
                            @else
                            value="{{ old('actual_temperature') }}" @endif
                          
                          
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="description_fever">Description of fever</label>
                           
                            
                            
                            <select class="form-control" id="description_fever" name="description_fever" required>
                                <option value="" @if (empty($FeverHistory['Description_of_fever']) && !old('description_fever')) selected @endif>Select</option>
                            
                                <option value="Low-grade" @if (!empty($FeverHistory) && $FeverHistory['Description_of_fever'] == 'Low-grade' || old('description_fever') == 'Low-grade') selected @endif>Low-grade</option>
                                <option value="High-grade" @if (!empty($FeverHistory) && $FeverHistory['Description_of_fever'] == 'High-grade' || old('description_fever') == 'High-grade') selected @endif>High-grade</option>
                                <option value="Intermittent" @if (!empty($FeverHistory) && $FeverHistory['Description_of_fever'] == 'Intermittent' || old('description_fever') == 'Intermittent') selected @endif>Intermittent</option>
                                <option value="none" @if (!empty($FeverHistory) && $FeverHistory['Description_of_fever'] == 'none' || old('description_fever') == 'none') selected @endif>None</option>
                            </select>
                            
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="onset_duration">Onset and Duration</label>
                          
                            

                            <select class="form-control" id="onset_duration" name="onset_duration" required>
                                <option value="" @if (empty($FeverHistory['Onset_Duration']) && !old('onset_duration')) selected @endif>Select</option>
                                <option value="Sudden onset" @if (!empty($FeverHistory) && $FeverHistory['Onset_Duration'] == 'Sudden onset' || old('onset_duration') == 'Sudden onset') selected @endif>Sudden onset</option>
                                <option value="Gradual onset" @if (!empty($FeverHistory) && $FeverHistory['Onset_Duration'] == 'Gradual onset' || old('onset_duration') == 'Gradual onset') selected @endif>Gradual onset</option>
                                <option value="Duration of fever episodes" @if (!empty($FeverHistory) && $FeverHistory['Onset_Duration'] == 'Duration of fever episodes' || old('onset_duration') == 'Duration of fever episodes') selected @endif>Duration of fever episodes</option>
                                <option value="none" @if (!empty($FeverHistory) && $FeverHistory['Onset_Duration'] == 'none' || old('onset_duration') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>

                    <div class="form-group col-md-6" id="durationInput"
                    
                    @if (!empty($FeverHistory['Duration'])) 

                    @else
                    
                    style="display:none"
                    
                    @endif
                    >
                        <div class="form-group">
                            <label for="duration_fever_episodes">Duration of fever episodes</label>
                            <input type="text" class="form-control" name="duration_fever_episodes"

                            @if (!empty($FeverHistory['Duration'])) value="{{ $FeverHistory['Duration'] }}"
                            @else
                            value="{{ old('duration_fever_episodes') }}" @endif

                            >
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="pattern_fever">Pattern of Fever</label>
                            

                            <select class="form-control" id="pattern_fever" name="pattern_fever" required>
                                <option value="" @if (empty($FeverHistory['PatternOfFever']) && !old('pattern_fever')) selected @endif>Select</option>
                                <option value="Intermittent" @if (!empty($FeverHistory) && $FeverHistory['PatternOfFever'] == 'Intermittent' || old('pattern_fever') == 'Intermittent') selected @endif>Intermittent (fever spikes followed by normal temperature)</option>
                                <option value="Remittent" @if (!empty($FeverHistory) && $FeverHistory['PatternOfFever'] == 'Remittent' || old('pattern_fever') == 'Remittent') selected @endif>Remittent (fever fluctuates but does not return to normal)</option>
                                <option value="Continuous" @if (!empty($FeverHistory) && $FeverHistory['PatternOfFever'] == 'Continuous' || old('pattern_fever') == 'Continuous') selected @endif>Continuous (fever persists without significant fluctuation)</option>
                                <option value="Fever associated with chills or rigors" @if (!empty($FeverHistory) && $FeverHistory['PatternOfFever'] == 'Fever associated with chills or rigors' || old('pattern_fever') == 'Fever associated with chills or rigors') selected @endif>Fever associated with chills or rigors</option>
                                <option value="none" @if (!empty($FeverHistory) &&  $FeverHistory['PatternOfFever'] == 'none' || old('pattern_fever') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="associated_symptoms">Associated Symptoms</label>
                           
                            <select class="form-control" id="associated_symptoms1" name="associated_symptoms1" required>
                                <option value="" @if (empty($FeverHistory['AssociatedSymptoms']) && !old('associated_symptoms1')) selected @endif>Select</option>
                                <option value="Headache" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Headache' || old('associated_symptoms1') == 'Headache') selected @endif>Headache</option>
                                <option value="Body aches" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Body aches' || old('associated_symptoms1') == 'Body aches') selected @endif>Body aches</option>
                                <option value="Fatigue" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Fatigue' || old('associated_symptoms1') == 'Fatigue') selected @endif>Fatigue</option>
                                <option value="Sweating" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Sweating' || old('associated_symptoms1') == 'Sweating') selected @endif>Sweating</option>
                                <option value="Cough" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Cough' || old('associated_symptoms1') == 'Cough') selected @endif>Cough</option>
                                <option value="Sore throat" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Sore throat' || old('associated_symptoms1') == 'Sore throat') selected @endif>Sore throat</option>
                                <option value="Runny nose" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Runny nose' || old('associated_symptoms1') == 'Runny nose') selected @endif>Runny nose</option>
                                <option value="Shortness of breath" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Shortness of breath' || old('associated_symptoms1') == 'Shortness of breath') selected @endif>Shortness of breath</option>
                                <option value="Nausea" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Nausea' || old('associated_symptoms1') == 'Nausea') selected @endif>Nausea</option>
                                <option value="Vomiting" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Vomiting' || old('associated_symptoms1') == 'Vomiting') selected @endif>Vomiting</option>
                                <option value="Diarrhea" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Diarrhea' || old('associated_symptoms1') == 'Diarrhea') selected @endif>Diarrhea</option>
                                <option value="Abdominal pain" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Abdominal pain' || old('associated_symptoms1') == 'Abdominal pain') selected @endif>Abdominal pain</option>
                                <option value="Rash" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'Rash' || old('associated_symptoms1') == 'Rash') selected @endif>Rash</option>
                                <option value="none" @if (!empty($FeverHistory) && $FeverHistory['AssociatedSymptoms'] == 'none' || old('associated_symptoms1') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="recent_exposures">Recent Exposures or Travel</label>
                            <select class="form-control" id="recent_exposures" name="recent_exposures" required>
                                <option value="" @if (empty($FeverHistory['RecentExposuresOrTravel']) && !old('recent_exposures')) selected @endif>Select</option>
                                <option value="Exposure to individuals with infectious illnesses" @if (!empty($FeverHistory) && $FeverHistory['RecentExposuresOrTravel'] == 'Exposure to individuals with infectious illnesses' || old('recent_exposures') == 'Exposure to individuals with infectious illnesses') selected @endif>Exposure to individuals with infectious illnesses</option>
                                <option value="Travel to regions with endemic infectious diseases" @if (!empty($FeverHistory) && $FeverHistory['RecentExposuresOrTravel'] == 'Travel to regions with endemic infectious diseases' || old('recent_exposures') == 'Travel to regions with endemic infectious diseases') selected @endif>Travel to regions with endemic infectious diseases</option>
                                <option value="none" @if (!empty($FeverHistory) && $FeverHistory['RecentExposuresOrTravel'] == 'none' || old('recent_exposures') == 'none') selected @endif>none</option>
                            </select>
                            
                        </div>
                    </div>
                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>

            <div class="step active" id="step5">
                <h3>Headache</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="ClusterHeadache">Cluster Headache</label>
                           
                            

                            <select class="form-control" id="ClusterHeadache" name="ClusterHeadache" required>
                                <option value="" @if (empty($Headache['ClusterHeadache']) && !old('ClusterHeadache')) selected @endif>Select</option>
                                <option value="One-sided pain" @if (!empty($Headache) && $Headache['ClusterHeadache'] == 'One-sided pain' || old('ClusterHeadache') == 'One-sided pain') selected @endif>One-sided pain, typically behind or around one eye</option>
                                <option value="Rapid onset of severe pain" @if (!empty($Headache) && $Headache['ClusterHeadache'] == 'Rapid onset of severe pain' || old('ClusterHeadache') == 'Rapid onset of severe pain') selected @endif>Rapid onset of severe pain</option>
                                <option value="Shorter duration (15 minutes to 3 hours)" @if (!empty($Headache) && $Headache['ClusterHeadache'] == 'Shorter duration (15 minutes to 3 hours)' || old('ClusterHeadache') == 'Shorter duration (15 minutes to 3 hours)') selected @endif>Shorter duration (15 minutes to 3 hours)</option>
                                <option value="Associated symptoms: tearing of the eye, nasal congestion, restlessness" @if (!empty($Headache) && $Headache['ClusterHeadache'] == 'Associated symptoms: tearing of the eye, nasal congestion, restlessness' || old('ClusterHeadache') == 'Associated symptoms: tearing of the eye, nasal congestion, restlessness') selected @endif>Associated symptoms: tearing of the eye, nasal congestion, restlessness</option>
                                <option value="Occurs in clusters over weeks to months (episodic) or persistently (chronic)" @if (!empty($Headache) && $Headache['ClusterHeadache'] == 'Occurs in clusters over weeks to months (episodic) or persistently (chronic)' || old('ClusterHeadache') == 'Occurs in clusters over weeks to months (episodic) or persistently (chronic)') selected @endif>Occurs in clusters over weeks to months (episodic) or persistently (chronic)</option>
                                <option value="none" @if (!empty($Headache) &&  $Headache['ClusterHeadache'] == 'none' || old('ClusterHeadache') == 'none') selected @endif>none</option>
                            </select>

                            
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Migraine">Migraine</label>
                           
                            <select class="form-control" id="Migraine" name="Migraine" required>
                                <option value="" @if (empty($Headache['Migraine']) && !old('Migraine')) selected @endif>Select</option>
                                <option value="One-sided or bilateral pain, often localized to the temple, forehead, or around the eyes" @if (!empty($Headache) && $Headache['Migraine'] == 'One-sided or bilateral pain, often localized to the temple, forehead, or around the eyes' || old('Migraine') == 'One-sided or bilateral pain, often localized to the temple, forehead, or around the eyes') selected @endif>One-sided or bilateral pain, often localized to the temple, forehead, or around the eyes</option>
                                <option value="Longer duration compared to cluster headaches (4 to 72 hours if untreated)" @if (!empty($Headache) && $Headache['Migraine'] == 'Longer duration compared to cluster headaches (4 to 72 hours if untreated)' || old('Migraine') == 'Longer duration compared to cluster headaches (4 to 72 hours if untreated)') selected @endif>Longer duration compared to cluster headaches (4 to 72 hours if untreated)</option>
                                <option value="Associated with nausea, vomiting, photophobia, and phonophobia" @if (!empty($Headache) && $Headache['Migraine'] == 'Associated with nausea, vomiting, photophobia, and phonophobia' || old('Migraine') == 'Associated with nausea, vomiting, photophobia, and phonophobia') selected @endif>Associated with nausea, vomiting, photophobia, and phonophobia</option>
                                <option value="May have prodromal symptoms (aura) such as visual disturbances or sensory changes" @if (!empty($Headache) && $Headache['Migraine'] == 'May have prodromal symptoms (aura) such as visual disturbances or sensory changes' || old('Migraine') == 'May have prodromal symptoms (aura) such as visual disturbances or sensory changes') selected @endif>May have prodromal symptoms (aura) such as visual disturbances or sensory changes</option>
                                <option value="Triggers may include hormonal changes, certain foods, stress, or environmental factors" @if (!empty($Headache) && $Headache['Migraine'] == 'Triggers may include hormonal changes, certain foods, stress, or environmental factors' || old('Migraine') == 'Triggers may include hormonal changes, certain foods, stress, or environmental factors') selected @endif>Triggers may include hormonal changes, certain foods, stress, or environmental factors</option>
                                <option value="none" @if (!empty($Headache) &&  $Headache['Migraine'] == 'none' || old('Migraine') == 'none') selected @endif>none</option>
                            </select>

                            
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="TensionHeadache">Tension Headache</label>
                          


                            <select class="form-control" id="TensionHeadache" name="TensionHeadache" required>
                                <option value="" @if (empty($Headache['TensionHeadache']) && !old('TensionHeadache')) selected @endif>Select</option>
                                <option value="Bilateral pain, often described as a band-like pressure or tightness around the head" @if (!empty($Headache) &&  $Headache['TensionHeadache'] == 'Bilateral pain, often described as a band-like pressure or tightness around the head' || old('TensionHeadache') == 'Bilateral pain, often described as a band-like pressure or tightness around the head') selected @endif>Bilateral pain, often described as a band-like pressure or tightness around the head</option>
                                <option value="Gradual onset of mild to moderate pain" @if (!empty($Headache) &&  $Headache['TensionHeadache'] == 'Gradual onset of mild to moderate pain' || old('TensionHeadache') == 'Gradual onset of mild to moderate pain') selected @endif>Gradual onset of mild to moderate pain</option>
                                <option value="Often triggered by stress, poor posture, or muscle tension" @if (!empty($Headache) &&  $Headache['TensionHeadache'] == 'Often triggered by stress, poor posture, or muscle tension' || old('TensionHeadache') == 'Often triggered by stress, poor posture, or muscle tension') selected @endif>Often triggered by stress, poor posture, or muscle tension</option>
                                <option value="Usually no associated symptoms of nausea, vomiting, or sensitivity to light/sound" @if (!empty($Headache) &&  $Headache['TensionHeadache'] == 'Usually no associated symptoms of nausea, vomiting, or sensitivity to light/sound' || old('TensionHeadache') == 'Usually no associated symptoms of nausea, vomiting, or sensitivity to light/sound') selected @endif>Usually no associated symptoms of nausea, vomiting, or sensitivity to light/sound</option>
                                <option value="Can be chronic (frequent episodes) or episodic" @if (!empty($Headache) &&  $Headache['TensionHeadache'] == 'Can be chronic (frequent episodes) or episodic' || old('TensionHeadache') == 'Can be chronic (frequent episodes) or episodic') selected @endif>Can be chronic (frequent episodes) or episodic</option>
                                <option value="none" @if (!empty($Headache) &&  $Headache['TensionHeadache'] == 'none' || old('TensionHeadache') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>


                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>

            <div class="step active " id="step6">
                <h3>MENINGITIS</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="onset_progression">Onset and Progression</label>
                           
                            
                            <select class="form-control" id="onset_progression" name="onset_progression" required>
                                <option value="" @if (empty($Meningitis['OnsetAndProgression']) && !old('onset_progression')) selected @endif>Select</option>
                                <option value="Sudden onset of symptoms" @if (!empty($Meningitis) && $Meningitis['OnsetAndProgression'] == 'Sudden onset of symptoms' || old('onset_progression') == 'Sudden onset of symptoms') selected @endif>Sudden onset of symptoms</option>
                                <option value="Rapid progression of symptoms over hours to days" @if (!empty($Meningitis) &&  $Meningitis['OnsetAndProgression'] == 'Rapid progression of symptoms over hours to days' || old('onset_progression') == 'Rapid progression of symptoms over hours to days') selected @endif>Rapid progression of symptoms over hours to days</option>
                                <option value="none" @if (!empty($Meningitis) && $Meningitis['OnsetAndProgression'] == 'none' || old('onset_progression') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Headache">Headache</label>
                            

                            <select class="form-control" id="Headache" name="Headache" required>
                                <option value="" @if (empty($Meningitis['Headache']) && !old('Headache')) selected @endif>Select</option>
                                <option value="Headache is typically severe" @if (!empty($Meningitis) && $Meningitis['Headache'] == 'Headache is typically severe' || old('Headache') == 'Headache is typically severe') selected @endif>Headache is typically severe</option>
                                <option value="Headache may be described as the worst headache of my life" @if (!empty($Meningitis) && $Meningitis['Headache'] == 'Headache may be described as the worst headache of my life' || old('Headache') == 'Headache may be described as the worst headache of my life') selected @endif>Headache may be described as "the worst headache of my life"</option>
                                <option value="none" @if (!empty($Meningitis) && $Meningitis['Headache'] == 'none' || old('Headache') == 'none') selected @endif>none</option>
                            </select>
                            


                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Fever">Fever</label>
                            <select class="form-control" id="Fever" name="Fever" required>
                                <option value="" @if (empty($Meningitis['Fever']) && !old('Fever')) selected @endif>Select</option>
                                <option value="Neck Stiffness" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'Neck Stiffness' || old('Fever') == 'Neck Stiffness') selected @endif>Neck Stiffness</option>
                                <option value="Neck stiffness, especially when trying to touch the chin to the chest (neck flexion)" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'Neck stiffness, especially when trying to touch the chin to the chest (neck flexion)' || old('Fever') == 'Neck stiffness, especially when trying to touch the chin to the chest (neck flexion)') selected @endif>Neck stiffness, especially when trying to touch the chin to the chest (neck flexion)</option>
                                <option value="Altered Mental Status" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'Altered Mental Status' || old('Fever') == 'Altered Mental Status') selected @endif>Altered Mental Status</option>
                                <option value="Nausea and Vomiting" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'Nausea and Vomiting' || old('Fever') == 'Nausea and Vomiting') selected @endif>Nausea and Vomiting</option>
                                <option value="Photophobia" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'Photophobia' || old('Fever') == 'Photophobia') selected @endif>Photophobia</option>
                                <option value="Rash" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'Rash' || old('Fever') == 'Rash') selected @endif>Rash</option>
                                <option value="Recent Infection" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'Recent Infection' || old('Fever') == 'Recent Infection') selected @endif>Recent Infection</option>
                                <option value="Recent exposure to someone with meningitis or a known outbreak" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'Recent exposure to someone with meningitis or a known outbreak' || old('Fever') == 'Recent exposure to someone with meningitis or a known outbreak') selected @endif>Recent exposure to someone with meningitis or a known outbreak</option>
                                <option value="Incomplete or lack of vaccination against bacterial causes of meningitis" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'Incomplete or lack of vaccination against bacterial causes of meningitis' || old('Fever') == 'Incomplete or lack of vaccination against bacterial causes of meningitis') selected @endif>Incomplete or lack of vaccination against bacterial causes of meningitis</option>
                                <option value="none" @if (!empty($Meningitis) && $Meningitis['Fever'] == 'none' || old('Fever') == 'none') selected @endif>none</option>
                            </select>
                            
                        </div>
                    </div>


                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>


            <div class="step active" id="step7">
                <h3>Abdominal Pain History</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="location_of_pain">Location of Pain</label>
                            

                            <select class="form-control" id="location_of_pain" name="location_of_pain" required>
                                <option value="" @if (empty($AbdominalPainHistory['LocationOfPain']) && !old('location_of_pain')) selected @endif>Select</option>
                                <option value="Upper abdomen (epigastric)" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['LocationOfPain'] == 'Upper abdomen (epigastric)' || old('location_of_pain') == 'Upper abdomen (epigastric)') selected @endif>Upper abdomen (epigastric)</option>
                                <option value="Lower abdomen (hypogastric)" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['LocationOfPain'] == 'Lower abdomen (hypogastric)' || old('location_of_pain') == 'Lower abdomen (hypogastric)') selected @endif>Lower abdomen (hypogastric)</option>
                                <option value="Right upper quadrant (RUQ)" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['LocationOfPain'] == 'Right upper quadrant (RUQ)' || old('location_of_pain') == 'Right upper quadrant (RUQ)') selected @endif>Right upper quadrant (RUQ)</option>
                                <option value="Left upper quadrant (LUQ)" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['LocationOfPain'] == 'Left upper quadrant (LUQ)' || old('location_of_pain') == 'Left upper quadrant (LUQ)') selected @endif>Left upper quadrant (LUQ)</option>
                                <option value="Right lower quadrant (RLQ)" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['LocationOfPain'] == 'Right lower quadrant (RLQ)' || old('location_of_pain') == 'Right lower quadrant (RLQ)') selected @endif>Right lower quadrant (RLQ)</option>
                                <option value="Left lower quadrant (LLQ)" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['LocationOfPain'] == 'Left lower quadrant (LLQ)' || old('location_of_pain') == 'Left lower quadrant (LLQ)') selected @endif>Left lower quadrant (LLQ)</option>
                                <option value="none" @if (!empty($AbdominalPainHistory) &&  $AbdominalPainHistory['LocationOfPain'] == 'none' || old('location_of_pain') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="character_of_pain">Character of Pain</label>
                            


                            <select class="form-control" id="character_of_pain" name="character_of_pain" required>
                                <option value="" @if (empty(!empty($AbdominalPainHistory) && $AbdominalPainHistory['CharacterOfPain']) && !old('character_of_pain')) selected @endif>Select</option>
                                <option value="Sharp" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['CharacterOfPain'] == 'Sharp' || old('character_of_pain') == 'Sharp') selected @endif>Sharp</option>
                                <option value="Dull" @if ( !empty($AbdominalPainHistory) &&$AbdominalPainHistory['CharacterOfPain'] == 'Dull' || old('character_of_pain') == 'Dull') selected @endif>Dull</option>
                                <option value="Burning" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['CharacterOfPain'] == 'Burning' || old('character_of_pain') == 'Burning') selected @endif>Burning</option>
                                <option value="Cramping" @if ( !empty($AbdominalPainHistory) &&$AbdominalPainHistory['CharacterOfPain'] == 'Cramping' || old('character_of_pain') == 'Cramping') selected @endif>Cramping</option>
                                <option value="Colicky (waves of intense pain)" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['CharacterOfPain'] == 'Colicky (waves of intense pain)' || old('character_of_pain') == 'Colicky (waves of intense pain)') selected @endif>Colicky (waves of intense pain)</option>
                                <option value="none" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['CharacterOfPain'] == 'none' || old('character_of_pain') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="onset_and_duration">Onset and Duration</label>
                            
                            <select class="form-control" id="onset_and_duration" name="onset_and_duration" required>
                                <option value="" @if (empty($AbdominalPainHistory['OnsetAndDuration']) && !old('onset_and_duration')) selected @endif>Select</option>
                                <option value="Sudden onset" @if ( !empty($AbdominalPainHistory) && $AbdominalPainHistory['OnsetAndDuration'] == 'Sudden onset' || old('onset_and_duration') == 'Sudden onset') selected @endif>Sudden onset</option>
                                <option value="Gradual onset" @if ( !empty($AbdominalPainHistory) && $AbdominalPainHistory['OnsetAndDuration'] == 'Gradual onset' || old('onset_and_duration') == 'Gradual onset') selected @endif>Gradual onset</option>
                                <option value="Constant" @if ( !empty($AbdominalPainHistory) && $AbdominalPainHistory['OnsetAndDuration'] == 'Constant' || old('onset_and_duration') == 'Constant') selected @endif>Constant</option>
                                <option value="Intermittent" @if ( !empty($AbdominalPainHistory) && $AbdominalPainHistory['OnsetAndDuration'] == 'Intermittent' || old('onset_and_duration') == 'Intermittent') selected @endif>Intermittent</option>
                                <option value="Duration of pain episodes" @if ( !empty($AbdominalPainHistory) && $AbdominalPainHistory['OnsetAndDuration'] == 'Duration of pain episodes' || old('onset_and_duration') == 'Duration of pain episodes') selected @endif>Duration of pain episodes</option>
                                <option value="none" @if (!empty($AbdominalPainHistory) &&  $AbdominalPainHistory['OnsetAndDuration'] == 'none' || old('onset_and_duration') == 'none') selected @endif>none</option>
                            </select>

                            
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="relieving_factors">Aggravating or Relieving Factors</label>
                          
                            

                            <select class="form-control" id="relieving_factors" name="relieving_factors" required>
                                <option value="" @if (empty($AbdominalPainHistory['AggravatingOrRelieving']) && !old('relieving_factors')) selected @endif>Select</option>
                                <option value="Aggravated by eating" @if (!empty($AbdominalPainHistory) &&  $AbdominalPainHistory['AggravatingOrRelieving'] == 'Aggravated by eating' || old('relieving_factors') == 'Aggravated by eating') selected @endif>Aggravated by eating</option>
                                <option value="Relieved by eating" @if (!empty($AbdominalPainHistory) &&  $AbdominalPainHistory['AggravatingOrRelieving'] == 'Relieved by eating' || old('relieving_factors') == 'Relieved by eating') selected @endif>Relieved by eating</option>
                                <option value="Aggravated by movement or certain positions" @if (!empty($AbdominalPainHistory) &&  $AbdominalPainHistory['AggravatingOrRelieving'] == 'Aggravated by movement or certain positions' || old('relieving_factors') == 'Aggravated by movement or certain positions') selected @endif>Aggravated by movement or certain positions</option>
                                <option value="Relieved by rest or specific positions" @if (!empty($AbdominalPainHistory) &&  $AbdominalPainHistory['AggravatingOrRelieving'] == 'Relieved by rest or specific positions' || old('relieving_factors') == 'Relieved by rest or specific positions') selected @endif>Relieved by rest or specific positions</option>
                                <option value="Aggravated by certain foods or drinks" @if (!empty($AbdominalPainHistory) &&  $AbdominalPainHistory['AggravatingOrRelieving'] == 'Aggravated by certain foods or drinks' || old('relieving_factors') == 'Aggravated by certain foods or drinks') selected @endif>Aggravated by certain foods or drinks</option>
                                <option value="Associated with bowel movements or urination" @if (!empty($AbdominalPainHistory) &&  $AbdominalPainHistory['AggravatingOrRelieving'] == 'Associated with bowel movements or urination' || old('relieving_factors') == 'Associated with bowel movements or urination') selected @endif>Associated with bowel movements or urination</option>
                                <option value="none" @if (!empty($AbdominalPainHistory) &&  $AbdominalPainHistory['AggravatingOrRelieving'] == 'none' || old('relieving_factors') == 'none') selected @endif>none</option>
                            </select>

                            
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="associated_symptoms">Associated Symptoms</label>
                           

                            <select class="form-control" id="associated_symptoms" name="associated_symptoms" required>
                                <option value="" @if (empty($AbdominalPainHistory['AssociatedSymptoms']) && !old('associated_symptoms')) selected @endif>Select</option>
                                <option value="Nausea" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'Nausea' || old('associated_symptoms') == 'Nausea') selected @endif>Nausea</option>
                                <option value="Vomiting" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'Vomiting' || old('associated_symptoms') == 'Vomiting') selected @endif>Vomiting</option>
                                <option value="Diarrhea" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'Diarrhea' || old('associated_symptoms') == 'Diarrhea') selected @endif>Diarrhea</option>
                                <option value="Constipation" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'Constipation' || old('associated_symptoms') == 'Constipation') selected @endif>Constipation</option>
                                <option value="Fever" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'Fever' || old('associated_symptoms') == 'Fever') selected @endif>Fever</option>
                                <option value="Bloating" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'Bloating' || old('associated_symptoms') == 'Bloating') selected @endif>Bloating</option>
                                <option value="Changes in appetite or weight" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'Changes in appetite or weight' || old('associated_symptoms') == 'Changes in appetite or weight') selected @endif>Changes in appetite or weight</option>
                                <option value="Blood in stool" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'Blood in stool' || old('associated_symptoms') == 'Blood in stool') selected @endif>Blood in stool</option>
                                <option value="Blood in vomit" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'Blood in vomit' || old('associated_symptoms') == 'Blood in vomit') selected @endif>Blood in vomit</option>
                                <option value="none" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['AssociatedSymptoms'] == 'none' || old('associated_symptoms') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="medical_history">Medical History</label>
                           

                            <select class="form-control" id="medical_history" name="medical_history" required>
                                <option value="" @if (empty($AbdominalPainHistory['MedicalHistory']) && !old('medical_history')) selected @endif>Select</option>
                                <option value="Previous Episodes" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['MedicalHistory'] == 'Previous Episodes' || old('medical_history') == 'Previous Episodes') selected @endif>Previous Episodes</option>
                                <option value="Digestive Disorders" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['MedicalHistory'] == 'Digestive Disorders' || old('medical_history') == 'Digestive Disorders') selected @endif>Digestive Disorders</option>
                                <option value="Gallstones/Kidney Stones(known)" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['MedicalHistory'] == 'Gallstones/Kidney Stones(known)' || old('medical_history') == 'Gallstones/Kidney Stones(known)') selected @endif>Gallstones/Kidney Stones(known)</option>
                                <option value="Dietary Changes" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['MedicalHistory'] == 'Dietary Changes' || old('medical_history') == 'Dietary Changes') selected @endif>Dietary Changes</option>
                                <option value="Travel History" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['MedicalHistory'] == 'Travel History' || old('medical_history') == 'Travel History') selected @endif>Travel History</option>
                                <option value="none" @if (!empty($AbdominalPainHistory) && $AbdominalPainHistory['MedicalHistory'] == 'none' || old('medical_history') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>
                    <div class="form-group col-md-6" id="previous_episode"
                    @if (!empty($AbdominalPainHistory['previous_episodes'])) 
                    
                    @else

                    style="display:none"
                    
                    @endif
                    
                    >
                        <div class="form-group">
                            <label for="previous_episodes">Previous Episodes</label>
                            <input type="text" class="form-control" name="previous_episodes"
                            
                            
                                           
                            @if (!empty($AbdominalPainHistory['previous_episodes'])) value="{{ $AbdominalPainHistory['previous_episodes'] }}"
                            @else
                            value="{{ old('previous_episodes') }}" @endif
                         
                         
                     
                         
                         
                         
                            >
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="digestive_disorder" 
                    
                    @if (!empty($AbdominalPainHistory['digestive_disorders'])) 
                    
                    @else

                    style="display:none"
                    
                    @endif
                    
                    >
                        <div class="form-group">
                            <label for="digestive_disorders">Digestive Disorders:if diagnosed</label>
                            <input type="text" class="form-control" name="digestive_disorders"
                            
                            @if (!empty($AbdominalPainHistory['digestive_disorders'])) value="{{ $AbdominalPainHistory['digestive_disorders'] }}"
                            @else
                            value="{{ old('digestive_disorders') }}" @endif
                         
                         
                            >
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="dietary_changes_time"
                    
                    @if (!empty($AbdominalPainHistory['dietary_changes_times'])) 
                    
                    @else

                    style="display:none"
                    
                    @endif
                    
                    >
                        <div class="form-group">
                            <label for="dietary_changes_times">Dietary Changes:timing</label>
                            <input type="text" class="form-control" name="dietary_changes_times"
                            
                            @if (!empty($AbdominalPainHistory['dietary_changes_times'])) value="{{ $AbdominalPainHistory['dietary_changes_times'] }}"
                            @else
                            value="{{ old('dietary_changes_times') }}" @endif
                         
                         
                         
                            >
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="dietary_changes_routine" 
                    
                    @if (!empty($AbdominalPainHistory['dietary_changes_routines'])) 
                    
                    @else

                    style="display:none"
                    
                    @endif
                    
                    
                    >
                        <div class="form-group">
                            <label for="dietary_changes_routines">Dietary Changes:routine</label>
                            <input type="text" class="form-control" name="dietary_changes_routines"
                            
                            @if (!empty($AbdominalPainHistory['dietary_changes_routines'])) value="{{ $AbdominalPainHistory['dietary_changes_routines'] }}"
                            @else
                            value="{{ old('dietary_changes_routines') }}" @endif
                         
                         
                         
                            >
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="travel_history" 
                    
                    @if (!empty($AbdominalPainHistory['travel_historys'])) 
                    
                    @else

                    style="display:none"
                    
                    @endif
                    
                    
                    >
                        <div class="form-group">
                            <label for="travel_historys">Travel History</label>
                            <input type="text" class="form-control" name="travel_historys"
                            
                                
                            @if (!empty($AbdominalPainHistory['travel_historys'])) value="{{ $AbdominalPainHistory['travel_historys'] }}"
                            @else
                            value="{{ old('travel_historys') }}" @endif
                         
                         
                         
                            >
                        </div>
                    </div>
                    <h6 class="w-100">
                        Personal History
                    </h6>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="lifestyle_habits">Lifestyle Habits</label>
                            
                            

                            <select class="form-control" id="lifestyle_habits" name="lifestyle_habits" required>
                                <option value="" @if (empty($PersonalHistory['LifestyleHabits']) && !old('lifestyle_habits')) selected @endif>Select</option>
                                <option value="Smoking" @if (!empty($PersonalHistory) && $PersonalHistory['LifestyleHabits'] == 'Smoking' || old('lifestyle_habits') == 'Smoking') selected @endif>Smoking</option>
                                <option value="Exercise" @if (!empty($PersonalHistory) && $PersonalHistory['LifestyleHabits'] == 'Exercise' || old('lifestyle_habits') == 'Exercise') selected @endif>Exercise</option>
                                <option value="Current Medications" @if (!empty($PersonalHistory) && $PersonalHistory['LifestyleHabits'] == 'Current Medications' || old('lifestyle_habits') == 'Current Medications') selected @endif>Current Medications</option>
                                <option value="Weight lifting" @if (!empty($PersonalHistory) && $PersonalHistory['LifestyleHabits'] == 'Weight lifting' || old('lifestyle_habits') == 'Weight lifting') selected @endif>Weight lifting</option>
                                <option value="Home chores" @if (!empty($PersonalHistory) && $PersonalHistory['LifestyleHabits'] == 'Home chores' || old('lifestyle_habits') == 'Home chores') selected @endif>Home chores</option>
                                <option value="Sports" @if (!empty($PersonalHistory) && $PersonalHistory['LifestyleHabits'] == 'Sports' || old('lifestyle_habits') == 'Sports') selected @endif>Sports</option>
                                <option value="Homework and studies" @if (!empty($PersonalHistory) && $PersonalHistory['LifestyleHabits'] == 'Homework and studies' || old('lifestyle_habits') == 'Homework and studies') selected @endif>Homework and studies</option>
                                <option value="none" @if (!empty($PersonalHistory) && $PersonalHistory['LifestyleHabits'] == 'none' || old('lifestyle_habits') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>
                    <div class="form-group col-md-6" id="current_medication" 
                    
                    @if (!empty($PersonalHistory['CurrentMedications'])) 
                    
                    @else

                    style="display:none"
                    
                    @endif
                    
                    >
                        <div class="form-group">
                            <label for="current_medications">Current Medications</label>
                            <input type="text" class="form-control" name="current_medications"
                            
                            @if (!empty($PersonalHistory['CurrentMedications'])) value="{{ $PersonalHistory['CurrentMedications'] }}"
                            @else
                            value="{{ old('current_medications') }}" @endif
                         
                         
                         
                            >
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="sport" 
                    
                    @if (!empty($PersonalHistory['sports'])) 
                    
                    @else

                    style="display:none"
                    
                    @endif
                    
                    
                    >
                        <div class="form-group">
                            <label for="sports">Sports</label>
                            <input type="text" class="form-control" name="sports"
                            
                            @if (!empty($PersonalHistory['sports'])) value="{{ $PersonalHistory['sports'] }}"
                            @else
                            value="{{ old('sports') }}" @endif
                         >



                        </div>
                    </div>


                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>

            <div class="step active " id="step8">
                <h3>Sleep Routine</h3>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="bed_time">Bed time</label>
                            <input type="text" class="form-control" id="bed_time" name="bed_time" 
                            
                                                  
                            @if (!empty($SleepRoutine['BedTime'])) value="{{ $SleepRoutine['BedTime'] }}"
                            @else
                            value="{{ old('bed_time') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="sleep_duration">Sleep duration</label>
                            <input type="text" class="form-control" id="sleep_duration" name="sleep_duration"

                                                     
                            @if (!empty($SleepRoutine['SleepDuration'])) value="{{ $SleepRoutine['SleepDuration'] }}"
                            @else
                            value="{{ old('bed_time') }}" @endif
                            



                                required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="sleep_quality">Sleep quality</label>
                          
                            

                            <select class="form-control" id="sleep_quality" name="sleep_quality" required>
                                <option value="" @if (empty($SleepRoutine['SleepQuality']) && !old('sleep_quality')) selected @endif>Select</option>
                                <option value="1" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '1' || old('sleep_quality') == '1') selected @endif>1</option>
                                <option value="2" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '2' || old('sleep_quality') == '2') selected @endif>2</option>
                                <option value="3" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '3' || old('sleep_quality') == '3') selected @endif>3</option>
                                <option value="4" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '4' || old('sleep_quality') == '4') selected @endif>4</option>
                                <option value="5" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '5' || old('sleep_quality') == '5') selected @endif>5</option>
                                <option value="6" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '6' || old('sleep_quality') == '6') selected @endif>6</option>
                                <option value="7" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '7' || old('sleep_quality') == '7') selected @endif>7</option>
                                <option value="8" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '8' || old('sleep_quality') == '8') selected @endif>8</option>
                                <option value="9" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '9' || old('sleep_quality') == '9') selected @endif>9</option>
                                <option value="10" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == '10' || old('sleep_quality') == '10') selected @endif>10</option>
                                <option value="none" @if (!empty($SleepRoutine) && $SleepRoutine['SleepQuality'] == 'none' || old('sleep_quality') == 'none') selected @endif>none</option>
                            </select>

                            

                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="bedtime_routine">Bedtime routine</label>
                            <input type="text" class="form-control" id="bedtime_routine" name="bedtime_routine"

                            @if (!empty($SleepRoutine['BedtimeRoutine'])) value="{{ $SleepRoutine['BedtimeRoutine'] }}"
                            @else
                            value="{{ old('bedtime_routine') }}" @endif



                                required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="daytime_naps">Daytime naps</label>
                            <input type="text" class="form-control" id="daytime_naps" name="daytime_naps" 
                            
                            @if (!empty($SleepRoutine['DaytimeNaps'])) value="{{ $SleepRoutine['DaytimeNaps'] }}"
                            @else
                            value="{{ old('daytime_naps') }}" @endif 


                            required>


                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="breathing_difficulties">Snoring or breathing difficulties</label>
                            <input type="text" class="form-control" id="breathing_difficulties"
                                name="breathing_difficulties" 
                                
                                @if (!empty($SleepRoutine['SnoringOrBreathing'])) value="{{ $SleepRoutine['SnoringOrBreathing'] }}"
                                @else
                                value="{{ old('breathing_difficulties') }}" @endif
    
    
    
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="restlessness_sleep">Restlessness during sleep</label>
                            <input type="text" class="form-control" id="restlessness_sleep" name="restlessness_sleep"

                            @if (!empty($SleepRoutine['RestlessnessDuringSleep'])) value="{{ $SleepRoutine['RestlessnessDuringSleep'] }}"
                            @else
                            value="{{ old('restlessness_sleep') }}" @endif



                                required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="sleep_environment">Sleep environment (noise, light, etc.)</label>
                            <input type="text" class="form-control" id="sleep_environment" name="sleep_environment"

                            @if (!empty($SleepRoutine['SleepEnvironment'])) value="{{ $SleepRoutine['SleepEnvironment'] }}"
                            @else
                            value="{{ old('sleep_environment') }}" @endif 


                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="sleep_related_behaviors">Sleep-related behaviors (sleepwalking, teeth grinding,
                                etc.)</label>
                            <input type="text" class="form-control" id="sleep_related_behaviors"
                                name="sleep_related_behaviors" 
                                
                                
                                @if (!empty($SleepRoutine['SleepRelatedBehaviors'])) value="{{ $SleepRoutine['SleepRelatedBehaviors'] }}"
                                @else
                                value="{{ old('sleep_related_behaviors') }}" @endif
    
    
    
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="medical_conditions_affecting">Medical conditions affecting sleep</label>
                            <input type="text" class="form-control" id="medical_conditions_affecting"
                                name="medical_conditions_affecting"  
                                
                                @if (!empty($SleepRoutine['AffectingSleep'])) value="{{ $SleepRoutine['AffectingSleep'] }}"
                                @else
                                value="{{ old('medical_conditions_affecting') }}" @endif
    
    
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="medications_impacting_sleep">Medications impacting sleep</label>
                            <input type="text" class="form-control" id="medications_impacting_sleep"
                                name="medications_impacting_sleep" 
                                
                                @if (!empty($SleepRoutine['ImpactingSleep'])) value="{{ $SleepRoutine['ImpactingSleep'] }}"
                                @else
                                value="{{ old('medications_impacting_sleep') }}" @endif
    
    
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="enuresis">Enuresis</label>
                            <input type="text" class="form-control" id="enuresis" name="enuresis" 
                            
                            @if (!empty($SleepRoutine['Enuresis'])) value="{{ $SleepRoutine['Enuresis'] }}"
                            @else
                            value="{{ old('enuresis') }}" @endif



                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="immunization_history">Immunization history</label>
                            <input type="text" class="form-control" id="immunization_history"
                                name="immunization_history" 
                                
                                @if (!empty($SleepRoutine['ImmunizationHistory'])) value="{{ $SleepRoutine['ImmunizationHistory'] }}"
                                @else
                                value="{{ old('immunization_history') }}" @endif
    
    
                                required>
                        </div>
                    </div>



                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>

            <div class="step active" id="step9">
                <h3>Nutrition History</h3>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="breakfast">Breakfast if yes</label>
                            <input type="text" class="form-control" id="breakfast" name="breakfast"
                            
                            @if (!empty($NutritionHistory['BreakfastIfYes'])) value="{{ $NutritionHistory['BreakfastIfYes'] }}"
                            @else
                            value="{{ old('breakfast') }}" @endif
                            
                            
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="roti_eat">How much roti did they eat?</label>
                            <input type="text" class="form-control" id="roti_eat" name="roti_eat"
                            
                            @if (!empty($NutritionHistory['RotiTheyEat'])) value="{{ $NutritionHistory['RotiTheyEat'] }}"
                            @else
                            value="{{ old('roti_eat') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="lunch">Lunch</label>
                            <input type="text" class="form-control" id="lunch" name="lunch" 
                            
                                 
                            @if (!empty($NutritionHistory['Lunch'])) value="{{ $NutritionHistory['Lunch'] }}"
                            @else
                            value="{{ old('lunch') }}" @endif
                            
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="skip_meal">Skip meals</label>
                            <input type="text" class="form-control" id="skip_meal" name="skip_meal" 
                            
                            
                            @if (!empty($NutritionHistory['SkipMeals'])) value="{{ $NutritionHistory['SkipMeals'] }}"
                            @else
                            value="{{ old('skip_meal') }}" @endif
                            
                            
                            
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="meal_preference">Meal preferences especially dislikes</label>
                            <input type="text" class="form-control" id="meal_preference" name="meal_preference"

                            @if (!empty($NutritionHistory['MealPreferences'])) value="{{ $NutritionHistory['MealPreferences'] }}"
                            @else
                            value="{{ old('meal_preference') }}" @endif


                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="food_allergies">Food allergies</label>
                            <input type="text" class="form-control" id="food_allergies" name="food_allergies"

                            @if (!empty($NutritionHistory['FoodAllergies'])) value="{{ $NutritionHistory['FoodAllergies'] }}"
                            @else
                            value="{{ old('food_allergies') }}" @endif



                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="dietary_restrictions">Dietary restrictions</label>
                            <input type="text" class="form-control" id="dietary_restrictions"
                                name="dietary_restrictions"
                                
                                @if (!empty($NutritionHistory['DietaryRestrictions'])) value="{{ $NutritionHistory['DietaryRestrictions'] }}"
                                @else
                                value="{{ old('dietary_restrictions') }}" @endif

                                required
                                >
                        </div>
                    </div>



                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>



            <div class="step active " id="step10">
                <h3>Medical History</h3>
                <h4 class="w-100">
                    Cardiovascular System:
                </h4>
                <h6 class="w-100">
                    Chest pain
                </h6>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="onset">Onset</label>
                            <input type="text" class="form-control" id="onset" name="onset"
                            
                            @if (!empty($ChestPain['Onset'])) value="{{ $ChestPain['Onset'] }}"
                                @else
                                value="{{ old('onset') }}" @endif



                                required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" 
                            
                            @if (!empty($ChestPain['Duration'])) value="{{ $ChestPain['Duration'] }}"
                            @else
                            value="{{ old('duration') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="severity">Severity</label>
                           


                            <select class="form-control" id="severity" name="severity" required>
                                <option value="" @if (empty($ChestPain['Severity']) && !old('severity')) selected @endif>Select</option>
                                <option value="1" @if (!empty($ChestPain) && $ChestPain['Severity'] == '1' || old('severity') == '1') selected @endif>1</option>
                                <option value="2" @if (!empty($ChestPain) && $ChestPain['Severity'] == '2' || old('severity') == '2') selected @endif>2</option>
                                <option value="3" @if (!empty($ChestPain) && $ChestPain['Severity'] == '3' || old('severity') == '3') selected @endif>3</option>
                                <option value="4" @if (!empty($ChestPain) && $ChestPain['Severity'] == '4' || old('severity') == '4') selected @endif>4</option>
                                <option value="5" @if (!empty($ChestPain) && $ChestPain['Severity'] == '5' || old('severity') == '5') selected @endif>5</option>
                                <option value="6" @if (!empty($ChestPain) && $ChestPain['Severity'] == '6' || old('severity') == '6') selected @endif>6</option>
                                <option value="7" @if (!empty($ChestPain) && $ChestPain['Severity'] == '7' || old('severity') == '7') selected @endif>7</option>
                                <option value="8" @if (!empty($ChestPain) && $ChestPain['Severity'] == '8' || old('severity') == '8') selected @endif>8</option>
                                <option value="9" @if (!empty($ChestPain) && $ChestPain['Severity'] == '9' || old('severity') == '9') selected @endif>9</option>
                                <option value="10" @if (!empty($ChestPain) && $ChestPain['Severity'] == '10' || old('severity') == '10') selected @endif>10</option>
                            </select>

                            

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="location">location</label>
                            <input type="text" class="form-control" id="location" name="location" 
                            
                            @if (!empty($ChestPain['Location'])) value="{{ $ChestPain['Location'] }}"
                            @else
                            value="{{ old('location') }}" @endif
                            
                            
                            
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="palpitations">Palpitations</label>
                            <input type="text" class="form-control" id="palpitations" name="palpitations" 
                            
                            
                            @if (!empty($ChestPain['Palpitations'])) value="{{ $ChestPain['Palpitations'] }}"
                            @else
                            value="{{ old('palpitations') }}" @endif
                            
                            
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="fainting_syncope">Fainting/syncope</label>
                            <input type="text" class="form-control" id="fainting_syncope" name="fainting_syncope"

                               
                            @if (!empty($ChestPain['FaintingSyncope'])) value="{{ $ChestPain['FaintingSyncope'] }}"
                            @else
                            value="{{ old('fainting_syncope') }}" @endif
                          


                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="cyanosis">Cyanosis</label>
                            <input type="text" class="form-control" id="cyanosis" name="cyanosis" 
                            
                            @if (!empty($ChestPain['Cyanosis'])) value="{{ $ChestPain['Cyanosis'] }}"
                            @else
                            value="{{ old('cyanosis') }}" @endif
                          
                          
                            required>
                        </div>
                    </div>
                    <h5 class="w-100">Sob</h5>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="on_exertion">on exertion</label>
                            <input type="text" class="form-control" id="on_exertion" name="on_exertion" 
                            
                            
                            @if (!empty($Sob['OnExertion'])) value="{{ $Sob['OnExertion'] }}"
                            @else
                            value="{{ old('on_exertion') }}" @endif
                          
                          
                          
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="on_rest">on rest</label>
                            <input type="text" class="form-control" id="on_rest" name="on_rest"  
                            
                             
                            @if (!empty($Sob['OnRst'])) value="{{ $Sob['OnRst'] }}"
                            @else
                            value="{{ old('on_rest') }}" @endif
                          
                          
                          
                            required>
                        </div>
                    </div>
                    <h5 class="w-100">Respiratory System</h5>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="nasal_patency">Nasal patency</label>
                            <input type="text" class="form-control" id="nasal_patency" name="nasal_patency"
                            
                            @if (!empty($RespiratorySystem['NasalPatency'])) value="{{ $RespiratorySystem['NasalPatency'] }}"
                            @else
                            value="{{ old('nasal_patency') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="clubbing">Clubbing</label>
                            <input type="text" class="form-control" id="clubbing" name="clubbing"
                            
                            @if (!empty($RespiratorySystem['Clubbing'])) value="{{ $RespiratorySystem['Clubbing'] }}"
                            @else
                            value="{{ old('clubbing') }}" @endif
                          
                          
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="asthma">Asthma</label>
                            <input type="text" class="form-control" id="asthma" name="asthma" 
                            
                            @if (!empty($RespiratorySystem['Asthma'])) value="{{ $RespiratorySystem['Asthma'] }}"
                            @else
                            value="{{ old('asthma') }}" @endif
                            
                            
                            required>
                        </div>
                    </div>
                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>



            <div class="step active" id="step11">
                <h3>Upper Resp</h3>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="sore_throat">Sore throat</label>
                            <input type="text" class="form-control" id="sore_throat" name="sore_throat" 
                            
                            @if (!empty($UpperResp['SoreThroat'])) value="{{ $UpperResp['SoreThroat'] }}"
                            @else
                            value="{{ old('sore_throat') }}" @endif



                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="ear_ache">Ear Ache</label>
                            <input type="text" class="form-control" id="ear_ache" name="ear_ache" 
                            
                            @if (!empty($UpperResp['EarAche'])) value="{{ $UpperResp['EarAche'] }}"
                            @else
                            value="{{ old('ear_ache') }}" @endif




                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="ear_discharge">Ear discharge</label>
                          

                            <select class="form-control" id="ear_discharge" name="ear_discharge" required>
                                <option value="" @if (empty($UpperResp['EarDischarge']) && !old('ear_discharge')) selected @endif>Select</option>
                                <option value="White" @if (!empty($UpperResp) && $UpperResp['EarDischarge'] == 'White' || old('ear_discharge') == 'White') selected @endif>White</option>
                                <option value="Pussy" @if (!empty($UpperResp) && $UpperResp['EarDischarge'] == 'Pussy' || old('ear_discharge') == 'Pussy') selected @endif>Pussy</option>
                                <option value="odour" @if (!empty($UpperResp) && $UpperResp['EarDischarge'] == 'odour' || old('ear_discharge') == 'odour') selected @endif>odour</option>
                            </select>

                            

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="runny_nose">Runny nose</label>
                            <input type="text" class="form-control" id="runny_nose" name="runny_nose"
                            
                            @if (!empty($UpperResp['RunnyNse'])) value="{{ $UpperResp['RunnyNse'] }}"
                            @else
                            value="{{ old('runny_nose') }}" @endif



                            required>
                        </div>
                    </div>
                    <h6 class="w-100">Cough</h6>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="sputum_color">Sputum color</label>
                            <input type="text" class="form-control" id="sputum_color" name="sputum_color" 
                            
                                
                            @if (!empty($Cough['SputumColor'])) value="{{ $Cough['SputumColor'] }}"
                            @else
                            value="{{ old('sputum_color') }}" @endif 
                            
                            required>



                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="sputum_quantity">Sputum quantity</label>
                            <input type="text" class="form-control" id="sputum_quantity" name="sputum_quantity"
                                        
                            @if (!empty($Cough['SputumQuantity'])) value="{{ $Cough['SputumQuantity'] }}"
                            @else
                            value="{{ old('sputum_quantity') }}" @endif 
                            
                            
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Brasky">Brasky</label>
                            <input type="text" class="form-control" id="Brasky" name="Brasky" 
                            
                                               
                            @if (!empty($Cough['Brasky'])) value="{{ $Cough['Brasky'] }}"
                            @else
                            value="{{ old('Brasky') }}" @endif 
                        
                        
                        
                        
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="whooping">Whooping</label>
                            <input type="text" class="form-control" id="whooping" name="whooping" 
                            
                                                     
                            @if (!empty($Cough['Whooping'])) value="{{ $Cough['Whooping'] }}"
                            @else
                            value="{{ old('whooping') }}" @endif 
                        
                        
                        
                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="blood_in_sputum">Blood in sputum</label>
                            <input type="text" class="form-control" id="blood_in_sputum" name="blood_in_sputum"

                            @if (!empty($Cough['BloodInSputum'])) value="{{ $Cough['BloodInSputum'] }}"
                            @else
                            value="{{ old('blood_in_sputum') }}" @endif 
                        


                                required>
                        </div>
                    </div>

                    <h4 class="w-100">
                        History of Pneumonia
                    </h4>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="episode_per_month">Episodes per month</label>
                            <input type="text" class="form-control" id="episode_per_month"
                                name="episode_per_month" 
                                
                                @if (!empty($HistoryOfPneumonia['EpisodesPerMonth'])) value="{{ $HistoryOfPneumonia['EpisodesPerMonth'] }}"
                            @else
                            value="{{ old('episode_per_month') }}" @endif 
                        



                            required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="hospitalization">Hospitalization</label>
                            <input type="text" class="form-control" id="hospitalization" name="hospitalization"

                            @if (!empty($HistoryOfPneumonia['Hospitalization'])) value="{{ $HistoryOfPneumonia['Hospitalization'] }}"
                            @else
                            value="{{ old('hospitalization') }}" @endif 



                                required>
                        </div>
                    </div>
                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>


            <div class="step active" id="step12">
                <h3>Lower Respiratory tract infections</h3>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="lower_sputum_color">Sputum color</label>
                            <input type="text" class="form-control" id="lower_sputum_color"
                                name="lower_sputum_color" 
                                
                                @if (!empty($LowerRespiratoryTractInfections['SputumColor'])) value="{{ $LowerRespiratoryTractInfections['SputumColor'] }}"
                            @else
                            value="{{ old('lower_sputum_color') }}" @endif



                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="lower_speutum_quantitiy">Sputum quantity</label>
                            <input type="text" class="form-control" id="lower_speutum_quantitiy"
                                name="lower_speutum_quantitiy" 
                                
                                @if (!empty($LowerRespiratoryTractInfections['SputumQuantity'])) 
                                value="{{ $LowerRespiratoryTractInfections['SputumQuantity'] }}"
                                @else
                                value="{{ old('lower_speutum_quantitiy') }}" 
                                @endif
    
    
    
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="lower_brasky">Brasky</label>
                            <input type="text" class="form-control" id="lower_brasky" name="lower_brasky"

                            @if (!empty($LowerRespiratoryTractInfections['Brasky'])) 
                            value="{{ $LowerRespiratoryTractInfections['Brasky'] }}"
                            @else
                            value="{{ old('lower_brasky') }}" 
                            @endif


                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="lower_whooping">Whooping</label>
                            <input type="text" class="form-control" id="lower_whooping" name="lower_whooping"

                            @if (!empty($LowerRespiratoryTractInfections['Whooping'])) 
                            value="{{ $LowerRespiratoryTractInfections['Whooping'] }}"
                            @else
                            value="{{ old('lower_whooping') }}" 
                            @endif


                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="lower_blood_in_sputum">Blood in sputum</label>
                            <input type="text" class="form-control" id="lower_blood_in_sputum"
                                name="lower_blood_in_sputum" 
                                
                                @if (!empty($LowerRespiratoryTractInfections['BloodInSputum'])) 
                                value="{{ $LowerRespiratoryTractInfections['BloodInSputum'] }}"
                                @else
                                value="{{ old('lower_blood_in_sputum') }}" 
                                @endif
                                
                                
                                required>
                        </div>
                    </div>

                    <h5 class="w-100">Sob</h5>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="on_exertion_mild">On Exertion Mild</label>
                            <input type="text" class="form-control" id="on_exertion_mild" name="on_exertion_mild"

                            @if (!empty($LowerRespiratorySob['OnExertionMild'])) 
                            value="{{ $LowerRespiratorySob['OnExertionMild'] }}"
                            @else
                            value="{{ old('on_exertion_mild') }}" 
                            @endif


                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="on_exertion_moderate">On Exertion Moderate</label>
                            <input type="text" class="form-control" id="on_exertion_moderate"
                                name="on_exertion_moderate" 
                                
                                @if (!empty($LowerRespiratorySob['OnExertionModerate'])) 
                                value="{{ $LowerRespiratorySob['OnExertionModerate'] }}"
                                @else
                                value="{{ old('on_exertion_moderate') }}" 
                                @endif
                                
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="on_exertion_severe">On Exertion Severe</label>
                            <input type="text" class="form-control" id="on_exertion_severe"
                                name="on_exertion_severe"
                                
                                @if (!empty($LowerRespiratorySob['OnExertionSevere'])) 
                                value="{{ $LowerRespiratorySob['OnExertionSevere'] }}"
                                @else
                                value="{{ old('on_exertion_severe') }}" 
                                @endif
                                
                                
                                required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="wheezing">Wheezing</label>
                            <input type="text" class="form-control" id="wheezing" name="wheezing" 
                            
                            @if (!empty($LowerRespiratorySob['Wheezing'])) 
                            value="{{ $LowerRespiratorySob['Wheezing'] }}"
                            @else
                            value="{{ old('wheezing') }}" 
                            @endif 
                            
                            
                            required>



                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="crackles">Crackles</label>
                            <input type="text" class="form-control" id="crackles" name="crackles"
                            
                            @if (!empty($LowerRespiratorySob['Crackles'])) 
                            value="{{ $LowerRespiratorySob['Crackles'] }}"
                            @else
                            value="{{ old('crackles') }}" 
                            @endif required>




                        </div>
                    </div>
                    <h5 class="w-100">History of Infections</h5>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="infection_episodes_per_month">Episodes per month</label>
                            <input type="text" class="form-control" id="infection_episodes_per_month"
                                name="infection_episodes_per_month" 
                                
                                @if (!empty($HistoryOfInfection['EpisodesPerMonth'])) 
                            value="{{ $HistoryOfInfection['EpisodesPerMonth'] }}"
                            @else
                            value="{{ old('infection_episodes_per_month') }}" 
                            @endif  
                            
                            
                            required>



                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="hospitalisation">Hospitalisation</label>
                            <input type="text" class="form-control" id="hospitalisation" name="hospitalisation"
                                
                            
                            @if (!empty($HistoryOfInfection['Hospitalisation'])) 
                            value="{{ $HistoryOfInfection['Hospitalisation'] }}"
                            @else
                            value="{{ old('hospitalisation') }}" 
                            @endif  
                            
                            
                            required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="gastrointestinal_system">Gastrointestinal System</label>
                          

                            <select class="form-control" id="gastrointestinal_system" name="gastrointestinal_system" required>
                                <option value="" @if (empty($HistoryOfInfection['GastrointestinalSystem']) && !old('gastrointestinal_system')) selected @endif>Select</option>
                                <option value="GERD" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['GastrointestinalSystem'] == 'GERD' || old('gastrointestinal_system') == 'GERD') selected @endif>GERD</option>
                                <option value="Blood in stool" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['GastrointestinalSystem'] == 'Blood in stool' || old('gastrointestinal_system') == 'Blood in stool') selected @endif>Blood in stool</option>
                                <option value="Blood in vomiting" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['GastrointestinalSystem'] == 'Blood in vomiting' || old('gastrointestinal_system') == 'Blood in vomiting') selected @endif>Blood in vomiting</option>
                                <option value="Black tarry stools" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['GastrointestinalSystem'] == 'Black tarry stools' || old('gastrointestinal_system') == 'Black tarry stools') selected @endif>Black tarry stools</option>
                                <option value="Distension" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['GastrointestinalSystem'] == 'Distension' || old('gastrointestinal_system') == 'Distension') selected @endif>Distension</option>
                                <option value="Abdominal Tenderness" @if (!empty($HistoryOfInfection) &&$HistoryOfInfection['GastrointestinalSystem'] == 'Abdominal Tenderness' || old('gastrointestinal_system') == 'Abdominal Tenderness') selected @endif>Abdominal Tenderness</option>
                                <option value="Abdominal pain" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['GastrointestinalSystem'] == 'Abdominal pain' || old('gastrointestinal_system') == 'Abdominal pain') selected @endif>Abdominal pain</option>
                                <option value="jaundice / skin itching" @if (!empty($HistoryOfInfection) &&$HistoryOfInfection['GastrointestinalSystem'] == 'jaundice / skin itching' || old('gastrointestinal_system') == 'jaundice / skin itching') selected @endif>jaundice / skin itching</option>
                                <option value="Diarrhoea" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['GastrointestinalSystem'] == 'Diarrhoea' || old('gastrointestinal_system') == 'Diarrhoea') selected @endif>Diarrhoea</option>
                            </select>
                            
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="endocrine_system">Endocrine System</label>
                            

                            <select class="form-control" id="endocrine_system" name="endocrine_system" required>
                                <option value="" @if (empty($HistoryOfInfection['EndocrineSystem']) && !old('endocrine_system')) selected @endif>Select</option>
                                <option value="Diabetes Mellitus" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['EndocrineSystem'] == 'Diabetes Mellitus' || old('endocrine_system') == 'Diabetes Mellitus') selected @endif>Diabetes Mellitus</option>
                                <option value="Thyroid Disorders" @if (!empty($HistoryOfInfection) &&  $HistoryOfInfection['EndocrineSystem'] == 'Thyroid Disorders' || old('endocrine_system') == 'Thyroid Disorders') selected @endif>Thyroid Disorders</option>
                            </select>

                            

                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="renal_system">Renal System</label>
                            
                            <select class="form-control" id="renal_system" name="renal_system" required>
                                <option value="" @if (empty($HistoryOfInfection['RenalSystem']) && !old('renal_system')) selected @endif>Select</option>
                                <option value="Kidney Stones" @if ( !empty($HistoryOfInfection) &&  $HistoryOfInfection['RenalSystem'] == 'Kidney Stones' || old('renal_system') == 'Kidney Stones') selected @endif>Kidney Stones</option>
                                <option value="Polyuria" @if ( !empty($HistoryOfInfection) &&   $HistoryOfInfection['RenalSystem'] == 'Polyuria' || old('renal_system') == 'Polyuria') selected @endif>Polyuria</option>
                                <option value="dysuria" @if (!empty($HistoryOfInfection) &&   $HistoryOfInfection['RenalSystem'] == 'dysuria' || old('renal_system') == 'dysuria') selected @endif>dysuria</option>
                                <option value="Back pain" @if (!empty($HistoryOfInfection) &&   $HistoryOfInfection['RenalSystem'] == 'Back pain' || old('renal_system') == 'Back pain') selected @endif>Back pain</option>
                                <option value="Blood in urine" @if (!empty($HistoryOfInfection) &&   $HistoryOfInfection['RenalSystem'] == 'Blood in urine' || old('renal_system') == 'Blood in urine') selected @endif>Blood in urine</option>
                                <option value="Foamy urine" @if ( !empty($HistoryOfInfection) &&   $HistoryOfInfection['RenalSystem'] == 'Foamy urine' || old('renal_system') == 'Foamy urine') selected @endif>Foamy urine</option>
                                <option value="Urinary Tract Infections" @if ( !empty($HistoryOfInfection) &&   $HistoryOfInfection['RenalSystem'] == 'Urinary Tract Infections' || old('renal_system') == 'Urinary Tract Infections') selected @endif>Urinary Tract Infections</option>
                            </select>

                            

                        </div>
                    </div>

                    <div class="form-group col-md-6" id="renal_kidney"
                    
                    @if (!empty($HistoryOfInfection['KidneyStones']))
 
                    @else
                    
                    style="display:none">

                    @endif  
                    


                        <div class="form-group">
                            <label for="kidney_stones_case">Kidney Stones: known case</label>
                            <input type="text" class="form-control" id="kidney_stones_case"
                                name="kidney_stones_case"
                                
                                
                                @if (!empty($HistoryOfInfection['KidneyStones'])) 
                                value="{{ $HistoryOfInfection['KidneyStones'] }}"
                                @else
                                value="{{ old('kidney_stones_case') }}" 
                                @endif  
                                
                                >
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="back_pain" 
                    
                    @if (!empty($HistoryOfInfection['BackPain']))
 
                    @else
                    
                    style="display:none">
                    
                    @endif  
                    
                    
                    >
                        <div class="form-group">
                            <label for="back_pain_site">Back pain :site</label>
                            <input type="text" class="form-control" id="back_pain_site" name="back_pain_site"
                            
                            @if (!empty($HistoryOfInfection['BackPain'])) 
                            value="{{ $HistoryOfInfection['BackPain'] }}"
                            @else
                            value="{{ old('back_pain_site') }}" 
                            @endif  
                            
                            
                            >
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="urinary_episodes" 
                    
                    @if (!empty($HistoryOfInfection['UrinaryTractInfections']))
 
                    @else
                    
                    style="display:none">
                    
                    @endif  
                    
                    
                    
                    >
                        <div class="form-group">
                            <label for="urinary_tract">Urinary Tract Infections:no.of episodes in a year</label>
                            <input type="text" class="form-control" id="urinary_tract" name="urinary_tract"
                            
                            @if (!empty($HistoryOfInfection['UrinaryTractInfections'])) 
                            value="{{ $HistoryOfInfection['UrinaryTractInfections'] }}"
                            @else
                            value="{{ old('urinary_tract') }}" 
                            @endif  >



                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="neurological_system">Neurological System</label>
                            

                            <select class="form-control" id="neurological_system" name="neurological_system" required>
                                <option value="" @if (empty($HistoryOfInfection['NeurologicalSystem']) && !old('neurological_system')) selected @endif>Select</option>
                                <option value="Seizure Disorder" @if (!empty($HistoryOfInfection) &&   $HistoryOfInfection['NeurologicalSystem'] == 'Seizure Disorder' || old('neurological_system') == 'Seizure Disorder') selected @endif>Seizure Disorder</option>
                                <option value="Migraines" @if (!empty($HistoryOfInfection) &&   $HistoryOfInfection['NeurologicalSystem'] == 'Migraines' || old('neurological_system') == 'Migraines') selected @endif>Migraines</option>
                                <option value="Falls" @if (!empty($HistoryOfInfection) &&  $HistoryOfInfection['NeurologicalSystem'] == 'Falls' || old('neurological_system') == 'Falls') selected @endif>Falls</option>
                                <option value="Syncope" @if (!empty($HistoryOfInfection) &&  $HistoryOfInfection['NeurologicalSystem'] == 'Syncope' || old('neurological_system') == 'Syncope') selected @endif>Syncope</option>
                                <option value="Blurr vision" @if (!empty($HistoryOfInfection) &&  $HistoryOfInfection['NeurologicalSystem'] == 'Blurr vision' || old('neurological_system') == 'Blurr vision') selected @endif>Blurr vision</option>
                                <option value="Confusion" @if (!empty($HistoryOfInfection) &&  $HistoryOfInfection['NeurologicalSystem'] == 'Confusion' || old('neurological_system') == 'Confusion') selected @endif>Confusion</option>
                                <option value="Incontinence" @if (!empty($HistoryOfInfection) &&  $HistoryOfInfection['NeurologicalSystem'] == 'Incontinence' || old('neurological_system') == 'Incontinence') selected @endif>Incontinence</option>
                                <option value="Headache" @if (!empty($HistoryOfInfection) &&   $HistoryOfInfection['NeurologicalSystem'] == 'Headache' || old('neurological_system') == 'Headache') selected @endif>Headache</option>
                            </select>
                            

                        </div>
                    </div>

                    <div class="form-group col-md-6" id="neuro_falls" 
                    
                    @if (!empty($HistoryOfInfection['Falls'])) 
                                                    @else
                                                    style="display:none"

                                                    @endif 
                                
                                
                                >
                        <div class="form-group">
                            <label for="neuro_falls_number">Falls</label>
                            <input type="number" class="form-control" id="neuro_falls_number"
                                name="neuro_falls_number"
                                
                                @if (!empty($HistoryOfInfection['Falls'])) 
                                value="{{ $HistoryOfInfection['Falls'] }}"
                                @else
                                value="{{ old('neuro_falls_number') }}" 
                                @endif  
                                
                                >



                        </div>
                    </div>
                    <div class="form-group col-md-6" id="neuro_syncope" 
                    
                    @if (!empty($HistoryOfInfection['Syncope'])) 
                    @else
                    style="display:none"

                    @endif >


                        <div class="form-group">
                            <label for="Syncope">Syncope</label>
                            <input type="text" class="form-control" id="Syncope" name="Syncope"
                            
                            
                            @if (!empty($HistoryOfInfection['Syncope'])) 
                            value="{{ $HistoryOfInfection['Syncope'] }}"
                            @else
                            value="{{ old('Syncope') }}" 
                            @endif  >



                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="musculoskeletal_system">Musculoskeletal System</label>
                            


                            <select class="form-control" id="musculoskeletal_system" name="musculoskeletal_system" required>
                                <option value="" @if (empty($HistoryOfInfection['MusculoskeletalSystem']) && !old('musculoskeletal_system')) selected @endif>Select</option>
                                <option value="Bone pain" @if (!empty($HistoryOfInfection) &&  $HistoryOfInfection['MusculoskeletalSystem'] == 'Bone pain' || old('musculoskeletal_system') == 'Bone pain') selected @endif>Bone pain</option>
                                <option value="Back Pain" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['MusculoskeletalSystem'] == 'Back Pain' || old('musculoskeletal_system') == 'Back Pain') selected @endif>Back Pain</option>
                                <option value="Ambulatory" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['MusculoskeletalSystem'] == 'Ambulatory' || old('musculoskeletal_system') == 'Ambulatory') selected @endif>Ambulatory</option>
                                <option value="Joint movement" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['MusculoskeletalSystem'] == 'Joint movement' || old('musculoskeletal_system') == 'Joint movement') selected @endif>Joint movement</option>
                                <option value="Swellings" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['MusculoskeletalSystem'] == 'Swellings' || old('musculoskeletal_system') == 'Swellings') selected @endif>Swellings</option>
                                <option value="Congenital deformity" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['MusculoskeletalSystem'] == 'Congenital deformity' || old('musculoskeletal_system') == 'Congenital deformity') selected @endif>Congenital deformity</option>
                            </select>

                            

                        </div>
                    </div>

                    <div class="form-group col-md-6" id="muscu_body_pain"
                    
                    @if (!empty($HistoryOfInfection['BonePainSpecify'])) 
                    @else
                  
                    style="display:none"

                    @endif >



                        <div class="form-group">
                            <label for="muscu_body_pain_specify">Bone pain: Specify</label>
                            <input type="number" class="form-control" id="muscu_body_pain_specify"
                                name="muscu_body_pain_specify"
                                
                                @if (!empty($HistoryOfInfection['BonePainSpecify'])) 
                                value="{{ $HistoryOfInfection['BonePainSpecify'] }}"
                                @else
                                value="{{ old('muscu_body_pain_specify') }}" 
                                @endif 
                                
                                
                                >
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="hematologic_system">Hematologic System</label>
                          
                            

                            <select class="form-control" id="hematologic_system" name="hematologic_system" required>
                                <option value="" @if (empty($HistoryOfInfection['HematologicSystem']) && !old('hematologic_system')) selected @endif>Select</option>
                                <option value="Anemia" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['HematologicSystem'] == 'Anemia' || old('hematologic_system') == 'Anemia') selected @endif>Anemia</option>
                                <option value="Excessive bleeding" @if (!empty($HistoryOfInfection) && $HistoryOfInfection['HematologicSystem'] == 'Excessive bleeding' || old('hematologic_system') == 'Excessive bleeding') selected @endif>Excessive bleeding</option>
                            </select>
                            
                        </div>
                    </div>
                </div>

                {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
                {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
            </div>

       
            
    <div class="step active" id="step13">
        <h3>SKIN DISEASE</h3>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="rashes">Rashes</label>
                    <select class="form-control" id="rashes" name="rashes" required>
                        <option value="" @if (empty($SkinDisease['Rashes']) && !old('rashes')) selected @endif>Select</option>
                        <option value="Macular" @if ((!empty($SkinDisease) && $SkinDisease['Rashes'] == 'Macular') || old('rashes') == 'Macular') selected @endif>Macular</option>
                        <option value="papules" @if ((!empty($SkinDisease) && $SkinDisease['Rashes'] == 'papules') || old('rashes') == 'papules') selected @endif>papules</option>
                        <option value="vesicular" @if ((!empty($SkinDisease) && $SkinDisease['Rashes'] == 'vesicular') || old('rashes') == 'vesicular') selected @endif>vesicular</option>
                        <option value="Painful" @if ((!empty($SkinDisease) && $SkinDisease['Rashes'] == 'Painful') || old('rashes') == 'Painful') selected @endif>Painful</option>
                        <option value="painless" @if ((!empty($SkinDisease) && $SkinDisease['Rashes'] == 'painless') || old('rashes') == 'painless') selected @endif>painless</option>
                    </select>

                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="onset_of_rashes">Onset of rashes</label>
                    <input type="text" class="form-control" id="onset_of_rashes" name="onset_of_rashes"
                        @if (!empty($SkinDisease['OnsetOfRashes'])) value="{{ $SkinDisease['OnsetOfRashes'] }}"
                            @else
                            value="{{ old('onset_of_rashes') }}" @endif
                        required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="rashes_site">Site</label>
                    <input type="text" class="form-control" id="rashes_site" name="rashes_site"
                        @if (!empty($SkinDisease['Site'])) value="{{ $SkinDisease['Site'] }}"
                            @else
                            value="{{ old('rashes_site') }}" @endif
                        required>



                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="started_from">Started From</label>
                    <input type="text" class="form-control" id="started_from" name="started_from"
                        @if (!empty($SkinDisease['StartedFrom'])) value="{{ $SkinDisease['StartedFrom'] }}"
                            @else
                            value="{{ old('started_from') }}" @endif
                        required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="itching">Itching</label>
                    <input type="text" class="form-control" id="itching" name="itching"
                        @if (!empty($SkinDisease['Itching'])) value="{{ $SkinDisease['Itching'] }}"
                            @else
                            value="{{ old('itching') }}" @endif
                        required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="rashes_fever">Fever</label>
                    <select class="form-control" id="rashes_fever" name="rashes_fever" required>
                        <option value="" @if (empty($SkinDisease['Fever']) && !old('rashes_fever')) selected @endif>Select</option>
                        <option value="onset" @if ((!empty($SkinDisease) && $SkinDisease['Fever'] == 'onset') || old('rashes_fever') == 'onset') selected @endif>onset</option>
                        <option value="before rash" @if ((!empty($SkinDisease) && $SkinDisease['Fever'] == 'before rash') || old('rashes_fever') == 'before rash') selected @endif>before rash
                        </option>
                        <option value="after rash" @if ((!empty($SkinDisease) && $SkinDisease['Fever'] == 'after rash') || old('rashes_fever') == 'after rash') selected @endif>after rash
                        </option>
                    </select>

                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="coryza">Coryza</label>
                    <input type="text" class="form-control" id="coryza" name="coryza"
                        @if (!empty($SkinDisease['Coryza'])) value="{{ $SkinDisease['Coryza'] }}"
                            @else
                            value="{{ old('coryza') }}" @endif
                        required>
                </div>
            </div>
        </div>

        {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
        {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
    </div>



           
    <div class="step active" id="step14">
        <h3>Chief Complaint</h3>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="chief_complaint">Chief Complaint</label>
                    <select class="form-control" id="chief_complaint" name="chief_complaint" required>
                        <option value="" @if (empty($ChiefComplaint['chief_complaint']) && !old('chief_complaint')) selected @endif>Select</option>
                        <option value="Fungal Infection" @if (!empty($ChiefComplaint) && $ChiefComplaint['chief_complaint'] == 'Fungal Infection' || old('chief_complaint') == 'Fungal Infection') selected @endif>Fungal Infection</option>
                        <option value="Dermatitis" @if (!empty($ChiefComplaint) && $ChiefComplaint['chief_complaint'] == 'Dermatitis' || old('chief_complaint') == 'Dermatitis') selected @endif>Dermatitis</option>
                        <option value="Scabies" @if (!empty($ChiefComplaint) && $ChiefComplaint['chief_complaint'] == 'Scabies' || old('chief_complaint') == 'Scabies') selected @endif>Scabies</option>
                        <option value="Herpes" @if (!empty($ChiefComplaint) && $ChiefComplaint['chief_complaint'] == 'Herpes' || old('chief_complaint') == 'Herpes') selected @endif>Herpes</option>
                        <option value="Other" @if (!empty($ChiefComplaint) && $ChiefComplaint['chief_complaint'] == 'Other' || old('chief_complaint') == 'Other') selected @endif>Other</option>
                    </select>
                    
                </div>
            </div>

            <div class="form-group col-md-6" id="chef_comlaint_div" 
            
                     
            @if (!empty($ChiefComplaint['chef_comlaint_specify']))
            
            @else
           
            style="display:none">
            
            @endif
            
            
                <div class="form-group">
                    <label for="chef_comlaint_specify">Specify</label>
                    <input type="text" class="form-control" id="chef_comlaint_specify"
                        name="chef_comlaint_specify" 
                        
                        
                        @if (!empty($ChiefComplaint['chef_comlaint_specify'])) value="{{ $ChiefComplaint['chef_comlaint_specify'] }}"
                        @else
                        value="{{ old('chef_comlaint_specify') }}" @endif
                        
                        
                        >
                </div>
            </div>
            <h6 class="w-100">
                Past Medical History
            </h6>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="previous_skin_conditions">Previous skin conditions or diseases</label>
                    <input type="text" class="form-control" id="previous_skin_conditions"
                        name="previous_skin_conditions" 
                        
                        @if (!empty($ChiefComplaint['previous_skin_conditions'])) 
                        value="{{ $ChiefComplaint['previous_skin_conditions'] }}"
                        @else
                        value="{{ old('previous_skin_conditions') }}" 
                        @endif


                        required>



                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="skincare_products">Allergies or sensitivities to medications or skincare
                        products</label>
                    <input type="text" class="form-control" id="skincare_products" name="skincare_products"

                    @if (!empty($ChiefComplaint['skincare_products'])) 
                    value="{{ $ChiefComplaint['skincare_products'] }}"
                    @else
                    value="{{ old('skincare_products') }}" 
                    @endif



                        required>
                </div>
            </div>

            <h6 class="w-100">
                Family History
            </h6>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="family_skin_disease">Family history of skin diseases (specify if known)</label>
                    <input type="text" class="form-control" id="family_skin_disease" name="family_skin_disease"

                    
                    @if (!empty($ChiefComplaint['family_skin_disease'])) 
                    value="{{ $ChiefComplaint['family_skin_disease'] }}"
                    @else
                    value="{{ old('family_skin_disease') }}" 
                    @endif


                        required>
                </div>
            </div>

            <h6 class="w-100">
                Fungal Infections:ring like lesion ,white lesion ,itching then suspect fungal infections
            </h6>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="fungal_infections_type">Type</label>
                    <input type="text" class="form-control" id="fungal_infections_type"
                        name="fungal_infections_type" 
                        
                        @if (!empty($ChiefComplaint['fungal_infections_type'])) 
                        value="{{ $ChiefComplaint['fungal_infections_type'] }}"
                        @else
                        value="{{ old('fungal_infections_type') }}" 
                        @endif
                        
                        
                        required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="fungal_infections_duration">Duration (days/weeks/months/years)</label>
                    <input type="text" class="form-control" id="fungal_infections_duration"
                        name="fungal_infections_duration" 
                        
                        
                        @if (!empty($ChiefComplaint['fungal_infections_duration'])) 
                        value="{{ $ChiefComplaint['fungal_infections_duration'] }}"
                        @else
                        value="{{ old('fungal_infections_duration') }}" 
                        @endif
                        
                        
                        required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="fungal_previous_treatments">Previous treatments and efficacy</label>
                    <input type="text" class="form-control" id="fungal_previous_treatments"
                        name="fungal_previous_treatments" 
                        
                        
                        @if (!empty($ChiefComplaint['fungal_previous_treatments'])) 
                        value="{{ $ChiefComplaint['fungal_previous_treatments'] }}"
                        @else
                        value="{{ old('fungal_previous_treatments') }}" 
                        @endif 
                        
                        required>



                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="fungal_infections_recurrence">Recurrence or spread</label>
                    <select class="form-control" id="fungal_infections_recurrence" name="fungal_infections_recurrence" required>
                        <option value="" @if (empty($ChiefComplaint['fungal_infections_recurrence']) && !old('fungal_infections_recurrence')) selected @endif>Select</option>
                        <option value="Yes" @if (!empty($ChiefComplaint) && $ChiefComplaint['fungal_infections_recurrence'] == 'Yes' || old('fungal_infections_recurrence') == 'Yes') selected @endif>Yes</option>
                        <option value="No" @if (!empty($ChiefComplaint) &&  $ChiefComplaint['fungal_infections_recurrence'] == 'No' || old('fungal_infections_recurrence') == 'No') selected @endif>No</option>
                    </select>
                    
                </div>
            </div>
            <h6 class="w-100">
                Dermatitis
            </h6>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="dermatitis_type">Type: _irritant or contact or atopic</label>
                    <input type="text" class="form-control" id="dermatitis_type" name="dermatitis_type"
                    
                    @if (!empty($ChiefComplaint['dermatitis_type'])) 
                    value="{{ $ChiefComplaint['dermatitis_type'] }}"
                    @else
                    value="{{ old('dermatitis_type') }}" 
                    @endif
                    
                    
                    required>



                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="dermatitis_triggers">Triggers or aggravating factors</label>
                    <input type="text" class="form-control" id="dermatitis_triggers" name="dermatitis_triggers"

                    @if (!empty($ChiefComplaint['dermatitis_triggers'])) 
                    value="{{ $ChiefComplaint['dermatitis_triggers'] }}"
                    @else
                    value="{{ old('dermatitis_triggers') }}" 
                    @endif



                        required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="dermatitis_symptoms">Symptoms</label>
                    <input type="text" class="form-control" id="dermatitis_symptoms" name="dermatitis_symptoms"

                    @if (!empty($ChiefComplaint['dermatitis_symptoms'])) 
                    value="{{ $ChiefComplaint['dermatitis_symptoms'] }}"
                    @else
                    value="{{ old('dermatitis_symptoms') }}" 
                    @endif



                        required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="dermatitis_previous_treatments">Previous treatments and response</label>
                    <input type="text" class="form-control" id="dermatitis_previous_treatments"
                        name="dermatitis_previous_treatments" 
                        
                        @if (!empty($ChiefComplaint['dermatitis_previous_treatments'])) 
                        value="{{ $ChiefComplaint['dermatitis_previous_treatments'] }}"
                        @else
                        value="{{ old('dermatitis_previous_treatments') }}" 
                        @endif
    
    
    
    
                        required>
                </div>
            </div>
            <h6 class="w-100">
                Scabies:if severe itching with linear burrows
            </h6>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="scabies_history">History of exposure</label>
                    
                    <select class="form-control" id="scabies_history" name="scabies_history" required>
                        <option value="" @if (empty($ChiefComplaint['scabies_history']) && !old('scabies_history')) selected @endif>Select</option>
                        <option value="Yes" @if (!empty($ChiefComplaint) &&  $ChiefComplaint['scabies_history'] == 'Yes' || old('scabies_history') == 'Yes') selected @endif>Yes</option>
                        <option value="No" @if (!empty($ChiefComplaint) && $ChiefComplaint['scabies_history'] == 'No' || old('scabies_history') == 'No') selected @endif>No</option>
                    </select>

                    
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="scabies_symptoms">Symptoms</label>
                    <input type="text" class="form-control" id="scabies_symptoms" name="scabies_symptoms"

                    @if (!empty($ChiefComplaint['scabies_symptoms'])) 
                    value="{{ $ChiefComplaint['scabies_symptoms'] }}"
                    @else
                    value="{{ old('scabies_symptoms') }}" 
                    @endif



                        required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="scabies_previous_treatments">Previous treatments and response</label>
                    <input type="text" class="form-control" id="scabies_previous_treatments"
                        name="scabies_previous_treatments" 
                        
                        @if (!empty($ChiefComplaint['scabies_previous_treatments'])) 
                        value="{{ $ChiefComplaint['scabies_previous_treatments'] }}"
                        @else
                        value="{{ old('scabies_previous_treatments') }}" 
                        @endif
                        
                        
                        required>
                </div>
            </div>
            <h6 class="w-100">
                Herpes: if painful lesion especially around corner of mouth
            </h6>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="herpes_type">Type: (oral/genital)</label>
                    <input type="text" class="form-control" id="herpes_type" name="herpes_type" 
                    
                    @if (!empty($ChiefComplaint['herpes_type'])) 
                    value="{{ $ChiefComplaint['herpes_type'] }}"
                    @else
                    value="{{ old('herpes_type') }}" 
                    @endif 
                    
                    required>



                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="herpes_triggers">Triggers for outbreaks</label>
                    <input type="text" class="form-control" id="herpes_triggers" name="herpes_triggers" 
                    
                    @if (!empty($ChiefComplaint['herpes_triggers'])) 
                    value="{{ $ChiefComplaint['herpes_triggers'] }}"
                    @else
                    value="{{ old('herpes_triggers') }}" 
                    @endif 
                    
                    
                    required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="herpes_location">Location</label>
                    <input type="text" class="form-control" id="herpes_location" name="herpes_location" 
                    
                    @if (!empty($ChiefComplaint['herpes_location'])) 
                    value="{{ $ChiefComplaint['herpes_location'] }}"
                    @else
                    value="{{ old('herpes_location') }}" 
                    @endif required>



                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="herpes_pain">pain</label>
                    <input type="text" class="form-control" id="herpes_pain" name="herpes_pain" 
                    
                    @if (!empty($ChiefComplaint['herpes_pain'])) 
                    value="{{ $ChiefComplaint['herpes_pain'] }}"
                    @else
                    value="{{ old('herpes_pain') }}" 
                    @endif 
                    
                    
                    required>

                    


                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="herpes_symptoms">Symptoms during outbreaks</label>
                    <input type="text" class="form-control" id="herpes_symptoms" name="herpes_symptoms"  
                    
                    
                    @if (!empty($ChiefComplaint['herpes_symptoms'])) 
                    value="{{ $ChiefComplaint['herpes_symptoms'] }}"
                    @else
                    value="{{ old('herpes_symptoms') }}" 
                    @endif
                    
                    
                    required>



                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="herpes_previous_treatments">Previous antiviral treatments and
                        effectiveness</label>
                    <input type="text" class="form-control" id="herpes_previous_treatments"
                        name="herpes_previous_treatments" 
                        
                              
                    @if (!empty($ChiefComplaint['herpes_previous_treatments'])) 
                    value="{{ $ChiefComplaint['herpes_previous_treatments'] }}"
                    @else
                    value="{{ old('herpes_previous_treatments') }}" 
                    @endif
                    
                    
                    required>
                </div>
            </div>
            <h6 class="w-100">
                Current Medications
            </h6>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="herpes_current_medication">Any current medications, including topical treatments
                        for skin conditions.</label>
                    <input type="text" class="form-control" id="herpes_current_medication"
                        name="herpes_current_medication" 
                        
                        @if (!empty($ChiefComplaint['herpes_current_medication'])) 
                        value="{{ $ChiefComplaint['herpes_current_medication'] }}"
                        @else
                        value="{{ old('herpes_current_medication') }}" 
                        @endif
                        
                        
                        required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="current_additional_notes">Additional Notes</label>
                    <input type="text" class="form-control" id="current_additional_notes"
                        name="current_additional_notes"
                        
                        @if (!empty($ChiefComplaint['current_additional_notes'])) 
                        value="{{ $ChiefComplaint['current_additional_notes'] }}"
                        @else
                        value="{{ old('current_additional_notes') }}" 
                        @endif
                        
                        
                        required>
                </div>
            </div>

            <h6 class="w-100">
                Menstural History
            </h6>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="age_first_menstrual">Age of first menstrual period (menarche)</label>
                    
                    <select class="form-control" id="age_first_menstrual" name="age_first_menstrual" required>
                        <option value="" @if (empty($ChiefComplaint['age_first_menstrual']) && !old('age_first_menstrual')) selected @endif>Select</option>
                        <option value="<10 years old" @if (!empty($ChiefComplaint) && $ChiefComplaint['age_first_menstrual'] == '<10 years old' || old('age_first_menstrual') == '<10 years old') selected @endif>&lt;10 years old</option>
                        <option value="10-12 years old" @if (!empty($ChiefComplaint) && $ChiefComplaint['age_first_menstrual'] == '10-12 years old' || old('age_first_menstrual') == '10-12 years old') selected @endif>10-12 years old</option>
                        <option value="13-15 years old" @if (!empty($ChiefComplaint) && $ChiefComplaint['age_first_menstrual'] == '13-15 years old' || old('age_first_menstrual') == '13-15 years old') selected @endif>13-15 years old</option>
                        <option value=">15 years old" @if (!empty($ChiefComplaint) && $ChiefComplaint['age_first_menstrual'] == '>15 years old' || old('age_first_menstrual') == '>15 years old') selected @endif>&gt;15 years old</option>
                        <option value="Not started" @if (!empty($ChiefComplaint) && $ChiefComplaint['age_first_menstrual'] == 'Not started' || old('age_first_menstrual') == 'Not started') selected @endif>Not started</option>
                    </select>

                    
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="regularity_menstrual">Regularity of menstrual cycles</label>
                   

                    <select class="form-control" id="regularity_menstrual" name="regularity_menstrual" required>
                        <option value="" @if (empty($ChiefComplaint['regularity_menstrual']) && !old('regularity_menstrual')) selected @endif>Select</option>
                        <option value="Regular (occurring every 21-35 days)" @if (!empty($ChiefComplaint) && $ChiefComplaint['regularity_menstrual'] == 'Regular (occurring every 21-35 days)' || old('regularity_menstrual') == 'Regular (occurring every 21-35 days)') selected @endif>Regular (occurring every 21-35 days)</option>
                        <option value="Irregular (less predictable, varying cycle lengths)" @if (!empty($ChiefComplaint) && $ChiefComplaint['regularity_menstrual'] == 'Irregular (less predictable, varying cycle lengths)' || old('regularity_menstrual') == 'Irregular (less predictable, varying cycle lengths)') selected @endif>Irregular (less predictable, varying cycle lengths)</option>
                        <option value="Unsure" @if (!empty($ChiefComplaint) && $ChiefComplaint['regularity_menstrual'] == 'Unsure' || old('regularity_menstrual') == 'Unsure') selected @endif>Unsure</option>
                    </select>

                    
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="duration_menstrual">Duration of menstrual flow</label>
                

                    <select class="form-control" id="duration_menstrual" name="duration_menstrual" required>
                        <option value="" @if (empty($ChiefComplaint['duration_menstrual']) && !old('duration_menstrual')) selected @endif>Select</option>
                        <option value="1-3 days" @if (!empty($ChiefComplaint) && $ChiefComplaint['duration_menstrual'] == '1-3 days' || old('duration_menstrual') == '1-3 days') selected @endif>1-3 days</option>
                        <option value="4-5 days" @if (!empty($ChiefComplaint) && $ChiefComplaint['duration_menstrual'] == '4-5 days' || old('duration_menstrual') == '4-5 days') selected @endif>4-5 days</option>
                        <option value="6-7 days" @if (!empty($ChiefComplaint) && $ChiefComplaint['duration_menstrual'] == '6-7 days' || old('duration_menstrual') == '6-7 days') selected @endif>6-7 days</option>
                        <option value="More than 7 days" @if (!empty($ChiefComplaint) && $ChiefComplaint['duration_menstrual'] == 'More than 7 days' || old('duration_menstrual') == 'More than 7 days') selected @endif>More than 7 days</option>
                    </select>

                    

                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="amount_menstrual_bleeding">Amount of menstrual bleeding</label>
                   

                    <select class="form-control" id="amount_menstrual_bleeding" name="amount_menstrual_bleeding" required>
                        <option value="" @if (empty($ChiefComplaint['amount_menstrual_bleeding']) && !old('amount_menstrual_bleeding')) selected @endif>Select</option>
                        <option value="Light (requires only a few pads per day)" @if (!empty($ChiefComplaint) && $ChiefComplaint['amount_menstrual_bleeding'] == 'Light (requires only a few pads per day)' || old('amount_menstrual_bleeding') == 'Light (requires only a few pads per day)') selected @endif>Light (requires only a few pads per day)</option>
                        <option value="Moderate (requires several pads per day)" @if (!empty($ChiefComplaint) && $ChiefComplaint['amount_menstrual_bleeding'] == 'Moderate (requires several pads per day)' || old('amount_menstrual_bleeding') == 'Moderate (requires several pads per day)') selected @endif>Moderate (requires several pads per day)</option>
                        <option value="Heavy (requires frequent pad/tampon changes)" @if (!empty($ChiefComplaint) && $ChiefComplaint['amount_menstrual_bleeding'] == 'Heavy (requires frequent pad/tampon changes)' || old('amount_menstrual_bleeding') == 'Heavy (requires frequent pad/tampon changes)') selected @endif>Heavy (requires frequent pad/tampon changes)</option>
                    </select>

                    

                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="symptoms_menstruation">Symptoms experienced during menstruation</label>
                    


                    <select class="form-control" id="symptoms_menstruation" name="symptoms_menstruation" required>
                        <option value="" @if (empty($ChiefComplaint['symptoms_menstruation']) && !old('symptoms_menstruation')) selected @endif>Select</option>
                        <option value="Cramps" @if (!empty($ChiefComplaint) && $ChiefComplaint['symptoms_menstruation'] == 'Cramps' || old('symptoms_menstruation') == 'Cramps') selected @endif>Cramps</option>
                        <option value="Back pain" @if (!empty($ChiefComplaint) && $ChiefComplaint['symptoms_menstruation'] == 'Back pain' || old('symptoms_menstruation') == 'Back pain') selected @endif>Back pain</option>
                        <option value="Headaches" @if (!empty($ChiefComplaint) && $ChiefComplaint['symptoms_menstruation'] == 'Headaches' || old('symptoms_menstruation') == 'Headaches') selected @endif>Headaches</option>
                        <option value="Bloating" @if (!empty($ChiefComplaint) && $ChiefComplaint['symptoms_menstruation'] == 'Bloating' || old('symptoms_menstruation') == 'Bloating') selected @endif>Bloating</option>
                        <option value="Mood swings" @if (!empty($ChiefComplaint) && $ChiefComplaint['symptoms_menstruation'] == 'Mood swings' || old('symptoms_menstruation') == 'Mood swings') selected @endif>Mood swings</option>
                        <option value="Nausea" @if (!empty($ChiefComplaint) && $ChiefComplaint['symptoms_menstruation'] == 'Nausea' || old('symptoms_menstruation') == 'Nausea') selected @endif>Nausea</option>
                        <option value="Fatigue" @if (!empty($ChiefComplaint) && $ChiefComplaint['symptoms_menstruation'] == 'Fatigue' || old('symptoms_menstruation') == 'Fatigue') selected @endif>Fatigue</option>
                    </select>
                    


                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="use_menstrual_products">Use of menstrual hygiene products</label>
                  


                    <select class="form-control" id="use_menstrual_products" name="use_menstrual_products" required>
                        <option value="" @if (empty($ChiefComplaint['use_menstrual_products']) && !old('use_menstrual_products')) selected @endif>Select</option>
                        <option value="Pads" @if (!empty($ChiefComplaint) && $ChiefComplaint['use_menstrual_products'] == 'Pads' || old('use_menstrual_products') == 'Pads') selected @endif>Pads</option>
                        <option value="Other" @if (!empty($ChiefComplaint) && $ChiefComplaint['use_menstrual_products'] == 'Other' || old('use_menstrual_products') == 'Other') selected @endif>Other</option>
                    </select>
                    


                </div>
            </div>
            <div class="form-group col-md-6" id="use_menstrual_products_div" 
            
            @if (!empty($ChiefComplaint['menstrual_products_specify'])) 

            @else
                        
            style="display:none;"

            @endif >>



                <div class="form-group">
                    <label for="menstrual_products_specify">Please specify</label>
                    <input type="text" class="form-control" id="menstrual_products_specify"
                        name="menstrual_products_specify"
                        
                        @if (!empty($ChiefComplaint['menstrual_products_specify'])) 
                        value="{{ $ChiefComplaint['menstrual_products_specify'] }}"
                        @else
                        value="{{ old('menstrual_products_specify') }}" 
                        @endif>


                </div>
            </div>


            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="history_menstrual_disorder">Any history of menstrual disorders or
                        complications</label>
                    
                        <select class="form-control" id="history_menstrual_disorder" name="history_menstrual_disorder" required>
                            <option value="" @if (empty($ChiefComplaint['history_menstrual_disorder']) && !old('history_menstrual_disorder')) selected @endif>Select</option>
                            <option value="Dysmenorrhea (painful periods)" @if (!empty($ChiefComplaint) && $ChiefComplaint['history_menstrual_disorder'] == 'Dysmenorrhea (painful periods)' || old('history_menstrual_disorder') == 'Dysmenorrhea (painful periods)') selected @endif>Dysmenorrhea (painful periods)</option>
                            <option value="Amenorrhea (absence of periods)" @if (!empty($ChiefComplaint) && $ChiefComplaint['history_menstrual_disorder'] == 'Amenorrhea (absence of periods)' || old('history_menstrual_disorder') == 'Amenorrhea (absence of periods)') selected @endif>Amenorrhea (absence of periods)</option>
                            <option value="Menorrhagia (excessive menstrual bleeding)" @if (!empty($ChiefComplaint) && $ChiefComplaint['history_menstrual_disorder'] == 'Menorrhagia (excessive menstrual bleeding)' || old('history_menstrual_disorder') == 'Menorrhagia (excessive menstrual bleeding)') selected @endif>Menorrhagia (excessive menstrual bleeding)</option>
                            <option value="Oligomenorrhea (infrequent periods)" @if (!empty($ChiefComplaint) && $ChiefComplaint['history_menstrual_disorder'] == 'Oligomenorrhea (infrequent periods)' || old('history_menstrual_disorder') == 'Oligomenorrhea (infrequent periods)') selected @endif>Oligomenorrhea (infrequent periods)</option>
                            <option value="Other" @if (!empty($ChiefComplaint) &&  $ChiefComplaint['history_menstrual_disorder'] == 'Other' || old('history_menstrual_disorder') == 'Other') selected @endif>Other</option>
                        </select>

                        

                </div>
            </div>
            <div class="form-group col-md-6" id="dysmenorrhea_div"
            
            @if (!empty($ChiefComplaint['dysmenorrhea_onset'])) 
          
            
            @else
            style="display:none;"
            @endif>
            
            
                <div class="form-group">
                    <label for="dysmenorrhea_onset">Dysmenorrhea (painful periods):onset</label>
                    <input type="text" class="form-control" id="dysmenorrhea_onset" name="dysmenorrhea_onset" 
                    
                    @if (!empty($ChiefComplaint['dysmenorrhea_onset'])) 
                    value="{{ $ChiefComplaint['dysmenorrhea_onset'] }}"
                    @else
                    value="{{ old('dysmenorrhea_onset') }}" 
                    @endif>
                    
                    
                    
                </div>
            </div>
            <div class="form-group col-md-6" id="amenorrhea_div"  
            
            @if (!empty($ChiefComplaint['amenorrhea_duration'])) 

            @else

            style="display:none;"
            
            @endif> 
            
            >
                <div class="form-group">
                    <label for="amenorrhea_duration">Amenorrhea (absence of periods):duration</label>
                    <input type="text" class="form-control" id="amenorrhea_duration" name="amenorrhea_duration"
                    
                    @if (!empty($ChiefComplaint['amenorrhea_duration'])) 
                    value="{{ $ChiefComplaint['amenorrhea_duration'] }}"
                    @else
                    value="{{ old('amenorrhea_duration') }}" 
                    @endif

                    >



                </div>
            </div>
            <div class="form-group col-md-6" id="menorrhagia_duration_div" 
            
                
            @if (!empty($ChiefComplaint['menorrhagia_duration'])) 

            @else
            style="display:none;"            @endif

            
            >
                <div class="form-group">
                    <label for="menorrhagia_duration">Menorrhagia (excessive menstrual bleeding) duration</label>
                    <input type="text" class="form-control" id="menorrhagia_duration"
                        name="menorrhagia_duration"
                        
                        @if (!empty($ChiefComplaint['menorrhagia_duration'])) 
                    value="{{ $ChiefComplaint['menorrhagia_duration'] }}"
                    @else
                    value="{{ old('menorrhagia_duration') }}" 
                    @endif
                    
                    >



                </div>
            </div>
            <div class="form-group col-md-6" id="menorrhagia_severity_div" 
            
            
            @if (!empty($ChiefComplaint['menorrhagia_severity'])) 

            @else
            style="display:none;"            @endif
            
            
            >
                <div class="form-group">
                    <label for="menorrhagia_severity">Menorrhagia (excessive menstrual bleeding) severity</label>
                    <input type="text" class="form-control" id="menorrhagia_severity"
                        name="menorrhagia_severity"
                        
                        @if (!empty($ChiefComplaint['menorrhagia_severity'])) 
                        value="{{ $ChiefComplaint['menorrhagia_severity'] }}"
                        @else
                        value="{{ old('menorrhagia_severity') }}" 
                        @endif


                        >



                </div>
            </div>
            <div class="form-group col-md-6" id="oligomenorrhea_duration_div" 
            
            
            @if (!empty($ChiefComplaint['oligomenorrhea_duration'])) 

            @else
            style="display:none;"            @endif
            
            
            >
                <div class="form-group">
                    <label for="oligomenorrhea_duration">Oligomenorrhea (infrequent periods):duration</label>
                    <input type="text" class="form-control" id="oligomenorrhea_duration"
                        name="oligomenorrhea_duration"
                        
                        @if (!empty($ChiefComplaint['oligomenorrhea_duration'])) 
                        value="{{ $ChiefComplaint['oligomenorrhea_duration'] }}"
                        @else
                        value="{{ old('oligomenorrhea_duration') }}" 
                        @endif
                        
                        >



                </div>
            </div>
            <div class="form-group col-md-6" id="menstrual_disorder_other_div"
            
            @if (!empty($ChiefComplaint['menstrual_disorder_other'])) 

            @else
            style="display:none;"            @endif


            
            >
                <div class="form-group">
                    <label for="menstrual_disorder_other">Please specify</label>
                    <input type="text" class="form-control" id="menstrual_disorder_other"
                        name="menstrual_disorder_other" 
                        
                        @if (!empty($ChiefComplaint['menstrual_disorder_other'])) 
                        value="{{ $ChiefComplaint['menstrual_disorder_other'] }}"
                        @else
                        value="{{ old('menstrual_disorder_other') }}" 
                        @endif
                        
                        >




                </div>
            </div>
        </div>

        {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
        {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
    </div>


          
    
    <div class="step active" id="step15">

        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="any_previous_medication_menstruation">Any previous medical treatments or
                        interventions related to menstruation</label>
                 
                   
                    <select class="form-control" id="any_previous_medication_menstruation" name="any_previous_medication_menstruation" required>
                        <option value="" @if (empty($previousMenstruationTreatmentOrInterventions['PreviousMenstruationTreatmentOrInterventions']) && !old('any_previous_medication_menstruation')) selected @endif>Select</option>
                        <option value="Pain medications" @if (!empty($previousMenstruationTreatmentOrInterventions) && $previousMenstruationTreatmentOrInterventions['PreviousMenstruationTreatmentOrInterventions'] == 'Pain medications' || old('any_previous_medication_menstruation') == 'Pain medications') selected @endif>Pain medications</option>
                        <option value="Other" @if (!empty($previousMenstruationTreatmentOrInterventions) && $previousMenstruationTreatmentOrInterventions['PreviousMenstruationTreatmentOrInterventions'] == 'Other' || old('any_previous_medication_menstruation') == 'Other') selected @endif>Other</option>
                    </select>
                    

                </div>
            </div>

            <div class="form-group col-md-6" id="medication_menstruation_other_div"
            
                        @if (!empty($previousMenstruationTreatmentOrInterventions['Specify'])) 
            
                        @else
                        
                        style="display:none"
                        
                        
                        @endif


                         >
                <div class="form-group">
                    <label for="medication_menstruation_other">Please specify</label>
                    <input type="text" class="form-control" id="medication_menstruation_other"
                        name="medication_menstruation_other" 
                        
                        @if (!empty($previousMenstruationTreatmentOrInterventions['Specify'])) 
                        value="{{ $previousMenstruationTreatmentOrInterventions['Specify'] }}"
                        @else
                        value="{{ old('medication_menstruation_other') }}" 
                        @endif>



                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="additional_concerns">Additional comments or concerns</label>
                    <input type="text" class="form-control" id="additional_concerns" name="additional_concerns"
                        
                    @if (!empty($previousMenstruationTreatmentOrInterventions['comment'])) 
                    value="{{ $previousMenstruationTreatmentOrInterventions['comment'] }}"
                    @else
                    value="{{ old('additional_concerns') }}" 
                    @endif
                    
                        
                  
                    
                    
                    required>
                </div>
            </div>
            <h6 class="w-100">
                Past Medical Conditions
            </h6>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="longterm_health">long-term health conditions</label>
                    

                    <select class="form-control" id="longterm_health" name="longterm_health" required>
                        <option value="" @if (empty($PastMedicalConditions['LongTermHealthConditions']) && !old('longterm_health')) selected @endif>Select</option>
                        <option value="Asthma" @if (!empty($PastMedicalConditions) && $PastMedicalConditions['LongTermHealthConditions'] == 'Asthma' || old('longterm_health') == 'Asthma') selected @endif>Asthma</option>
                        <option value="Diabetes" @if (!empty($PastMedicalConditions) && $PastMedicalConditions['LongTermHealthConditions'] == 'Diabetes' || old('longterm_health') == 'Diabetes') selected @endif>Diabetes</option>
                        <option value="Hypertension" @if (!empty($PastMedicalConditions) && $PastMedicalConditions['LongTermHealthConditions'] == 'Hypertension' || old('longterm_health') == 'Hypertension') selected @endif>Hypertension</option>
                        <option value="Other" @if (!empty($PastMedicalConditions) && $PastMedicalConditions['LongTermHealthConditions'] == 'Other' || old('longterm_health') == 'Other') selected @endif>Other</option>
                    </select>

                    
                </div>
            </div>

            <div class="form-group col-md-6" id="longterm_health_other_div" 
            
            @if (!empty($PastMedicalConditions['longterm_health_other'])) 
            @else
            style="display:none"            @endif
            
            >
                <div class="form-group">
                    <label for="longterm_health_other">Please specify</label>
                    <input type="text" class="form-control" id="longterm_health_other"
                        name="longterm_health_other" 
                        
                        @if (!empty($PastMedicalConditions['longterm_health_other'])) 
                        value="{{ $PastMedicalConditions['longterm_health_other'] }}"
                        @else
                        value="{{ old('longterm_health_other') }}" 
                        @endif
                        
                        >



                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="accident_or_injuries">Accident or Injuries</label>
                    <input type="text" class="form-control" id="accident_or_injuries" name="accident_or_injuries"
                        
                    @if (!empty($PastMedicalConditions['AccidentOrInjuries'])) 
                    value="{{ $PastMedicalConditions['AccidentOrInjuries'] }}"
                    @else
                    value="{{ old('accident_or_injuries') }}" 
                    @endif
                    
                    required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="surgeries">Surgeries</label>
                    <input type="text" class="form-control" id="surgeries" name="surgeries"  
                    
                    
                    @if (!empty($PastMedicalConditions['Surgeries'])) 
                    value="{{ $PastMedicalConditions['Surgeries'] }}"
                    @else
                    value="{{ old('surgeries') }}" 
                    @endif 
                    
                    
                    required>


                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="any_current_medications">Any Current medications</label>
                    <input type="text" class="form-control" id="any_current_medications"
                        name="any_current_medications" 
                        
                        @if (!empty($PastMedicalConditions['AnyCurrentMdications'])) 
                        value="{{ $PastMedicalConditions['AnyCurrentMdications'] }}"
                        @else
                        value="{{ old('any_current_medications') }}" 
                        @endif required>



                </div>
            </div>
            <h6 class="w-100">
                Allergies
            </h6>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="alergies_medications">Medications</label>
                    <input type="text" class="form-control" id="alergies_medications" name="alergies_medications"
                        
                    
                    @if (!empty($Allergies['Medications'])) 
                    value="{{ $Allergies['Medications'] }}"
                    @else
                    value="{{ old('alergies_medications') }}" 
                    @endif 
                    
                    required
                    
                    >



                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="alergies_chemicals">Chemicals</label>
                    <input type="text" class="form-control" id="alergies_chemicals" name="alergies_chemicals"
                        
                    @if (!empty($Allergies['Chemicals'])) 
                    value="{{ $Allergies['Chemicals'] }}"
                    @else
                    value="{{ old('alergies_chemicals') }}" 
                    @endif 
                    
                    
                    required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="alergies_pollen">Pollen/Furs</label>
                    <input type="text" class="form-control" id="alergies_pollen" name="alergies_pollen" 
                    
                    @if (!empty($Allergies['PollenFurs'])) 
                    value="{{ $Allergies['PollenFurs'] }}"
                    @else
                    value="{{ old('alergies_pollen') }}" 
                    @endif
                    
                    required>



                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="alergies_food">Food</label>
                    <input type="text" class="form-control" id="alergies_food" name="alergies_food" 
                    
                    @if (!empty($Allergies['Food'])) 
                    value="{{ $Allergies['Food'] }}"
                    @else
                    value="{{ old('alergies_food') }}" 
                    @endif
                    


                    required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="alergies_metals">Metals</label>
                    <input type="text" class="form-control" id="alergies_metals" name="alergies_metals" 
                    
                    
                    @if (!empty($Allergies['Metals'])) 
                    value="{{ $Allergies['Metals'] }}"
                    @else
                    value="{{ old('alergies_metals') }}" 
                    @endif
                    
                    required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="alergies_other">Other</label>
                    <input type="text" class="form-control" id="alergies_other" name="alergies_other" 
                    
                    @if (!empty($Allergies['Other'])) 
                    value="{{ $Allergies['Other'] }}"
                    @else
                    value="{{ old('alergies_other') }}" 
                    @endif
                    
                    required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="family_history_past">Family History</label>
                    
                    <select class="form-control" id="family_history_past" name="family_history_past" required>
                        <option value="" @if (empty($Allergies['FamilyHistory']) && !old('family_history_past')) selected @endif>Select</option>
                        <option value="heart disease" @if (!empty($Allergies) && $Allergies['FamilyHistory'] == 'heart disease' || old('family_history_past') == 'heart disease') selected @endif>Heart Disease</option>
                        <option value="Hypertension" @if (!empty($Allergies) && $Allergies['FamilyHistory'] == 'Hypertension' || old('family_history_past') == 'Hypertension') selected @endif>Hypertension</option>
                        <option value="Obesity" @if (!empty($Allergies) && $Allergies['FamilyHistory'] == 'Obesity' || old('family_history_past') == 'Obesity') selected @endif>Obesity</option>
                        <option value="Cancer" @if (!empty($Allergies) && $Allergies['FamilyHistory'] == 'Cancer' || old('family_history_past') == 'Cancer') selected @endif>Cancer</option>
                        <option value="Diabetes" @if (!empty($Allergies) && $Allergies['FamilyHistory'] == 'Diabetes' || old('family_history_past') == 'Diabetes') selected @endif>Diabetes</option>
                        <option value="or other" @if (!empty($Allergies) &&  $Allergies['FamilyHistory'] == 'or other' || old('family_history_past') == 'or other') selected @endif>Other</option>
                    </select>

                    
                </div>
            </div>
        </div>

        {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
        {{-- <button type="button" class="btn btn-primary nextStep mb-3">Next</button> --}}
    </div>

            
    <div class="step active" id="step16">


        <h3>SOCIOECONOMIC</h3>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="water">Water</label>



                    <select class="form-control" id="water" name="water" required>
                        <option value="" @if (empty($Socioeconomic['Water']) && !old('water')) selected @endif>Select</option>
                        <option value="Tap" @if ((!empty($Socioeconomic) && $Socioeconomic['Water'] == 'Tap') || old('water') == 'Tap') selected @endif>Tap</option>
                        <option value="Boiled" @if ((!empty($Socioeconomic) && $Socioeconomic['Water'] == 'Boiled') || old('water') == 'Boiled') selected @endif>Boiled</option>
                        <option value="filtered" @if ((!empty($Socioeconomic) && $Socioeconomic['Water'] == 'filtered') || old('water') == 'filtered') selected @endif>Filtered</option>
                    </select>


                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="milk">Milk</label>



                    <select class="form-control" id="milk" name="milk" required>

                        <option value="" @if (empty($Socioeconomic['Milk']) && !old('milk')) selected @endif>Select</option>
                        <option value="Boiled (unpasturized milk)" 
                        @if ((!empty($Socioeconomic) && $Socioeconomic['Milk'] == 'Boiled (unpasturized milk)') || old('milk') == 'Boiled (unpasturized milk)') 
                        selected 
                        @endif
                        >
                        Boiled (unpasturized milk)</option>
                        <option value="Tetrapack" @if ((!empty($Socioeconomic) && $Socioeconomic['Milk'] == 'Tetrapack') || old('milk') == 'Tetrapack') selected @endif>Tetrapack</option>
                    </select>






                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="rooms">Rooms</label>



                    <select class="form-control" id="rooms" name="rooms" required>
                        <option value="" @if (empty($Socioeconomic['Rooms']) && !old('rooms')) selected @endif>Select</option>
                        <option value="1" @if ((!empty($Socioeconomic) && $Socioeconomic['Rooms'] == '1') || old('rooms') == '1') selected @endif>1</option>
                        <option value="2" @if ((!empty($Socioeconomic) && $Socioeconomic['Rooms'] == '2') || old('rooms') == '2') selected @endif>2</option>
                        <option value="3" @if ((!empty($Socioeconomic) && $Socioeconomic['Rooms'] == '3') || old('rooms') == '3') selected @endif>3</option>
                        <option value="4" @if ((!empty($Socioeconomic) && $Socioeconomic['Rooms'] == '4') || old('rooms') == '4') selected @endif>4</option>
                        <option value="5" @if ((!empty($Socioeconomic) && $Socioeconomic['Rooms'] == '5') || old('rooms') == '5') selected @endif>5</option>
                        <option value="5+" @if ((!empty($Socioeconomic) && $Socioeconomic['Rooms'] == '5+') || old('rooms') == '5+') selected @endif>5+</option>
                    </select>



                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="infectious_disease">Infectious disease and any sick people at home</label>



                    <select class="form-control" id="infectious_disease" name="infectious_disease" required>
                        <option value="" @if (empty($Socioeconomic['infectious_disease']) && !old('infectious_disease')) selected @endif>Select</option>
                        <option value="Yes" @if ((!empty($Socioeconomic) && $Socioeconomic['infectious_disease'] == 'Yes') || old('infectious_disease') == 'Yes') selected @endif>Yes</option>
                        <option value="NO" @if ((!empty($Socioeconomic) && $Socioeconomic['infectious_disease'] == 'NO') || old('infectious_disease') == 'NO') selected @endif>NO</option>
                    </select>

                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="father_occupation">Father Occupation</label>
                    <select class="form-control" id="father_occupation" name="father_occupation" required>






                        <option value="">Select</option>
                        <option value="Office worker">Office worker</option>
                        <option value="Welder">Welder</option>
                        <option value="Clerick">Clerick</option>
                        <option value="Shopkeeper">Shopkeeper</option>
                        <option value="Tailor">Tailor</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Factory worker">Factory worker</option>
                        <option value="Own work">Own work</option>
                        <option value="Driver">Driver</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="ddx">DDX</label>
                    <input type="text" class="form-control" id="ddx" name="ddx"
                        @if (!empty($Socioeconomic['DDX'])) value="{{ $Socioeconomic['DDX'] }}"
                    @else
                    value="{{ old('ddx') }}" @endif
                        required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="note_to_principal">Note to principal</label>
                    <input type="text" class="form-control" id="note_to_principal" name="note_to_principal"
                        @if (!empty($Socioeconomic['NoteToPrincipal'])) value="{{ $Socioeconomic['NoteToPrincipal'] }}"
                    @else
                    value="{{ old('note_to_principal') }}" @endif
                        required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="note_to_parent">Note to parent</label>
                    <input type="text" class="form-control" id="note_to_parent" name="note_to_parent"
                        @if (!empty($Socioeconomic['NoteToParent'])) value="{{ $Socioeconomic['NoteToParent'] }}"
                    @else
                    value="{{ old('note_to_parent') }}" @endif
                        required>
                </div>
            </div>
           
            {{-- <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="attach_picture">Attach Picture</label>
                    <input type="file" class="form-control" id="attach_picture" name="attach_picture" required>

                   

                </div>
            </div> --}}

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="attach_picture">Attach Picture</label>
                    @if (!empty($Socioeconomic['Picture']))
                    <a href="{{ asset('uploads/patient') }}/{{ $Socioeconomic['Picture'] }}"
                        target="_blacnk">View</a>
                    <input type="hidden"
                        @if (!empty($Socioeconomic['Picture'])) value="{{ $Socioeconomic['Picture'] }}"
                @else
                value="{{ old('note_to_parent') }}" @endif
                        name="attach_picture_update">
                @endif
                   

                </div>
            </div>


            

            {{-- <button type="button" class="btn btn-primary prevStep mb-3">Previous</button> --}}
            {{-- <button type="submit" class="btn btn-primary mb-3">Submit</button> --}}
        </div>




    </div>

</form>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function validate(e, isLastStep = false) {
            console.log("HERE");
            $('.error-text').remove()
            let closestDiv = isLastStep ? '.last-step' : '.step';
            var currentStep = $(e.target).closest(closestDiv);
            var nextStep = currentStep.next('.step');
            var checkboxes = $('.form-group input[type="checkbox"]');
            var isValid = true;

            var fieldErrors = [];
            // Check if all required fields in the current step are filled
            currentStep.find('input[required], select[required], input[type="checkbox"]:checked').each(function() {

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

        $('.nextStep').click(validate);




        document.getElementById('longterm_health').addEventListener('change', function() {
            console.log("HERE");
            var selectedValue = this.value;
            console.log("selectedValue " + selectedValue);

            var longterm_health_other_div = document.getElementById('longterm_health_other_div');
            if (selectedValue === 'Other') {
                longterm_health_other_div.style.display = 'block';
            } else {

                longterm_health_other_div.style.display = 'none';
            }
        });

        document.getElementById('any_previous_medication_menstruation').addEventListener('change', function() {
            var selectedValue = this.value;
            var medication_menstruation_other_div = document.getElementById('medication_menstruation_other_div');
            if (selectedValue === 'Other') {

                medication_menstruation_other_div.style.display = 'block';
            } else {

                medication_menstruation_other_div.style.display = 'none';
            }
        });


        document.getElementById('history_menstrual_disorder').addEventListener('change', function() {
            var selectedValue = this.value;
            var dysmenorrhea_div = document.getElementById('dysmenorrhea_div');
            var amenorrhea_div = document.getElementById('amenorrhea_div');
            var menorrhagia_duration_div = document.getElementById('menorrhagia_duration_div');
            var menorrhagia_severity_div = document.getElementById('menorrhagia_severity_div');
            var oligomenorrhea_duration_div = document.getElementById('oligomenorrhea_duration_div');
            var menstrual_disorder_other_div = document.getElementById('menstrual_disorder_other_div');
            if (selectedValue === 'Dysmenorrhea (painful periods)') {

                dysmenorrhea_div.style.display = 'block';
            } else {
                dysmenorrhea_div.style.display = 'none';
            }
            if (selectedValue === 'Amenorrhea (absence of periods)') {

                amenorrhea_div.style.display = 'block';
            } else {
                amenorrhea_div.style.display = 'none';
            }
            if (selectedValue === 'Menorrhagia (excessive menstrual bleeding)') {

                menorrhagia_duration_div.style.display = 'block';
                menorrhagia_severity_div.style.display = 'block';
            } else {
                menorrhagia_duration_div.style.display = 'none';
                menorrhagia_severity_div.style.display = 'none';
            }
            if (selectedValue === 'Oligomenorrhea (infrequent periods)') {

                oligomenorrhea_duration_div.style.display = 'block';
            } else {
                oligomenorrhea_duration_div.style.display = 'none';
            }
            if (selectedValue === 'Other') {

                menstrual_disorder_other_div.style.display = 'block';
            } else {

                menstrual_disorder_other_div.style.display = 'none';
            }
        });


        document.getElementById('use_menstrual_products').addEventListener('change', function() {
            var selectedValue = this.value;
            var use_menstrual_products_div = document.getElementById('use_menstrual_products_div');
            if (selectedValue === 'Other') {

                use_menstrual_products_div.style.display = 'block';
            } else {

                use_menstrual_products_div.style.display = 'none';
            }
        });


        document.getElementById('chief_complaint').addEventListener('change', function() {
            var selectedValue = this.value;
            var chef_comlaint_div = document.getElementById('chef_comlaint_div');
            if (selectedValue === 'Other') {

                chef_comlaint_div.style.display = 'block';
            } else {

                chef_comlaint_div.style.display = 'none';
            }
        });


        document.getElementById('musculoskeletal_system').addEventListener('change', function() {
            var selectedValue = this.value;

            var muscu_body_pain = document.getElementById('muscu_body_pain');
            if (selectedValue === 'Bone pain') {

                muscu_body_pain.style.display = 'block';
            } else {

                muscu_body_pain.style.display = 'none';
            }
        });

        document.getElementById('neurological_system').addEventListener('change', function() {
            var selectedValue = this.value;
            var neuro_falls = document.getElementById('neuro_falls');
            var neuro_syncope = document.getElementById('neuro_syncope');
            if (selectedValue === 'Falls') {

                neuro_falls.style.display = 'block';
            } else {

                neuro_falls.style.display = 'none';
            }
            if (selectedValue === 'Syncope') {

                neuro_syncope.style.display = 'block';
            } else {

                neuro_syncope.style.display = 'none';
            }
        });

        document.getElementById('renal_system').addEventListener('change', function() {
            var selectedValue = this.value;
            var renal_kidney = document.getElementById('renal_kidney');
            var back_pain = document.getElementById('back_pain');
            var urinary_episodes = document.getElementById('urinary_episodes');
            if (selectedValue === 'Kidney Stones') {

                renal_kidney.style.display = 'block';
            } else {

                renal_kidney.style.display = 'none';
            }
            if (selectedValue === 'Back pain') {

                back_pain.style.display = 'block';
            } else {

                back_pain.style.display = 'none';
            }
            if (selectedValue === 'Urinary Tract Infections') {

                urinary_episodes.style.display = 'block';
            } else {

                urinary_episodes.style.display = 'none';
            }
        });



        document.getElementById('medical_history').addEventListener('change', function() {
            var selectedValue = this.value;
            console.log("selectedValue" + selectedValue);
            var previous_episode = document.getElementById('previous_episode');
            var digestive_disorder = document.getElementById('digestive_disorder');
            var dietary_changes_time = document.getElementById('dietary_changes_time');
            var dietary_changes_routine = document.getElementById('dietary_changes_routine');
            var travel_history = document.getElementById('travel_history');
            if (selectedValue === 'Previous Episodes') {

                previous_episode.style.display = 'block';
            } else {

                previous_episode.style.display = 'none';
            }
            if (selectedValue === 'Digestive Disorders') {

                digestive_disorder.style.display = 'block';
            } else {

                digestive_disorder.style.display = 'none';
            }
            if (selectedValue === 'Dietary Changes') {

                dietary_changes_time.style.display = 'block';
                dietary_changes_routine.style.display = 'block';
            } else {

                dietary_changes_time.style.display = 'none';
                dietary_changes_routine.style.display = 'none';
            }
            if (selectedValue === 'Travel History') {

                travel_history.style.display = 'block';
            } else {

                travel_history.style.display = 'none';
            }
        });


        document.getElementById('lifestyle_habits').addEventListener('change', function() {
            var selectedValue = this.value;
            var current_medication = document.getElementById('current_medication');
            var Sport = document.getElementById('sport');
            if (selectedValue === 'Current Medications') {

                current_medication.style.display = 'block';
            } else {

                current_medication.style.display = 'none';
            }
            if (selectedValue === 'Sports') {

                Sport.style.display = 'block';
            } else {

                Sport.style.display = 'none';
            }
        });



        document.getElementById('onset_duration').addEventListener('change', function() {
            var selectedValue = this.value;
            var durationInput = document.getElementById('durationInput');
            if (selectedValue === 'Duration of fever episodes') {
                $("#durationInput").css("display", "block");

            } else {


                $("#durationInput").css("display", "none");

            }
        });








        $(document).ready(function() {

            $('input, select').prop('disabled', true);



            // $('.nextStep').click(function () {
            //     var currentStep = $(this).closest('.step');
            //     var nextStep = currentStep.next('.step');

            //     // Move to the next step
            //     currentStep.removeClass('active');
            //     nextStep.addClass('active');
            // });

            $('.prevStep').click(function() {
                var currentStep = $(this).closest('.step');
                var prevStep = currentStep.prev('.step');

                // Move to the previous step
                currentStep.removeClass('active');
                prevStep.addClass('active');
            });
        });
    </script>
    </div>
@endsection
