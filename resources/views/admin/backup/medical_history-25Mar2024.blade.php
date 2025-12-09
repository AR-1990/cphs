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
    .form-row{
        align-items: end;
    }

</style>



<div class="container">
    <h2 class="text-center">
        Medical History and Presenting Complaints Form

    </h2>
    <form id="multiStepForm" method="post" action="{{route('medical_history')}}">
        @csrf


        
        <!-- Step-one -->
        <div class="step active" id="step1">
            <h3>Patient Information</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="gr_no">GR.No.</label>
                        <input type="text" class="form-control" id="gr_no" name="gr_no" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="class">Class</label>
                        <input type="text" class="form-control" id="class" name="class" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" max="2024-02-21" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="blood_group">Blood group</label>
                        <select class="form-control" id="blood_group" name="Blood_group" required>
                            <option value="">Select</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="Unknown">Unknown</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="tel" class="form-control" id="contact" name="contact" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <hr>
                <h6 class="w-100">
                    Emergency Contact
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="emergency_name">Name</label>
                        <input type="text" class="form-control" id="emergency_name" name="emergency_name" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="emergency_relationship">Relationship</label>
                        <input type="text" class="form-control" id="emergency_relationship" name="emergency_relationship" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="emergency_contact">Contact</label>
                        <input type="tel" class="form-control" id="emergency_contact" name="emergency_contact" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary nextStep">Next</button>
            {{-- <button type="submit" class="btn btn-primary nextStep">Submit</button> --}}
        </div>

        <!-- Second Step -->

        <div class="step" id="step2">
            <h3>Presenting Complaints</h3>

            <h6 class="w-100">
                Main Complaint
            </h6>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset">Onset</label>
                        <input type="text" class="form-control" id="onset" name="onset" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="severity">Severity (Scale 1-10)</label>
                        <select class="form-control" id="severity" name="severity" required>
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="9">10</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="relieving_factors">Aggravating/Relieving Factors</label>
                        <input type="text" class="form-control" id="relieving_factors" name="relieving_factors" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="associated_symptoms">Associated Symptoms</label>
                        <input type="text" class="form-control" id="associated_symptoms" name="associated_symptoms" required>
                    </div>
                </div>
            </div>

            <h6 class="w-100">
                Secondary Complaints (if any)
            </h6>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_description">Description</label>
                        <input type="text" class="form-control" id="sec_description" name="sec_description" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_onset">Onset</label>
                        <input type="text" class="form-control" id="sec_onset" name="sec_onset" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_duration">Duration</label>
                        <input type="text" class="form-control" id="sec_duration" name="sec_duration" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_severity">Severity (Scale 1-10)</label>
                        <select class="form-control" id="sec_severity" name="sec_severity" required>
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="9">10</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_relieving_factors">Aggravating/Relieving Factors</label>
                        <input type="text" class="form-control" id="sec_relieving_factors" name="sec_relieving_factors" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_associated_symptoms">Associated Symptoms</label>
                        <input type="text" class="form-control" id="sec_associated_symptoms" name="sec_associated_symptoms" required>
                    </div>
                </div>
            </div>

            <h6 class="w-100">
                Recent Changes or Symptoms of Concern
            </h6>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_description">Description</label>
                        <input type="text" class="form-control" id="recent_description" name="recent_description" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_onset">Onset</label>
                        <input type="text" class="form-control" id="recent_onset" name="recent_onset" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_duration">Duration</label>
                        <input type="text" class="form-control" id="recent_duration" name="recent_duration" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_severity">Severity (Scale 1-10)</label>
                        <select class="form-control" id="recent_severity" name="recent_severity" required>
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="9">10</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_relieving_factors">Aggravating/Relieving Factors</label>
                        <input type="text" class="form-control" id="recent_relieving_factors" name="recent_relieving_factors" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_associated_symptoms">Associated Symptoms</label>
                        <input type="text" class="form-control" id="recent_associated_symptoms" name="recent_associated_symptoms" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>
        <!-- ADD  Step -->
       

        <div class="step" id="step3">
            <h3>VITAL SIGNS</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="pulse">Pulse</label>
                        <input type="text" class="form-control" id="pulse" name="pulse" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="temperature">Temperature</label>
                        <input type="text" class="form-control" id="temperature" name="temperature" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bp">bp</label>
                        <input type="text" class="form-control" id="bp" name="bp" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="respiratory_rate">Respiratory Rate</label>
                        <input type="text" class="form-control" id="respiratory_rate" name="respiratory_rate" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bmi_weight">BMI Weight</label>
                        <input type="text" class="form-control" id="bmi_weight" name="bmi_weight" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bmi_height">BMI Height</label>
                        <input type="text" class="form-control" id="bmi_height" name="bmi_height" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>

        <div class="step" id="step4">
            <h3>Fever History</h3>
            <h6 class="w-100">
               Temperature Measurement
            </h6>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="actual_temperature">Actual temperature measured (e.g., with a thermometer)</label>
                        <input type="text" class="form-control" id="actual_temperature" name="actual_temperature" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="description_fever">Description of fever</label>
                        <select class="form-control" id="description_fever" name="description_fever" required>
                            <option value="">Select</option>
                            <option value="Low-grade">Low-grade</option>
                            <option value="High-grade">High-grade</option>
                            <option value="Intermittent">Intermittent</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset_duration">Onset and Duration</label>
                        <select class="form-control" id="onset_duration" name="onset_duration" required>
                            <option value="">Select</option>
                            <option value="Sudden onset">Sudden onset</option>
                            <option value="Gradual onset">Gradual onset</option>
                            <option value="Duration of fever episodes">Duration of fever episodes</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6" id="durationInput" style="display:none">
                    <div class="form-group">
                        <label for="duration_fever_episodes">Duration of fever episodes</label>
                        <input type="text" class="form-control" id="duration_fever_episodes" name="duration_fever_episodes" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="pattern_fever">Pattern of Fever</label>
                        <select class="form-control" id="pattern_fever" name="pattern_fever" required>
                            <option value="">Select</option>
                            <option value="Intermittent"> Intermittent (fever spikes followed by normal temperature)</option>
                            <option value="Remittent">Remittent (fever fluctuates but does not return to normal)</option>
                            <option value="Continuous">Continuous (fever persists without significant fluctuation)</option>
                            <option value="Fever associated with chills or rigors">Fever associated with chills or rigors</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="associated_symptoms">Associated Symptoms</label>
                        <select class="form-control" id="associated_symptoms" name="associated_symptoms" required>
                            <option value="">Select</option>
                            <option value="Headache">Headache</option>
                            <option value="Body aches"> Body aches</option>
                            <option value="Fatigue">Fatigue</option>
                            <option value="Sweating">Sweating</option>
                            <option value="Cough">Cough</option>
                            <option value="Sore throat">Sore throat</option>
                            <option value="Runny nose">Runny nose</option>
                            <option value="Shortness of breath">Shortness of breath</option>
                            <option value="Nausea">Nausea</option>
                            <option value="Vomiting">Vomiting</option>
                            <option value="Diarrhea">Diarrhea</option>
                            <option value="Abdominal pain">Abdominal pain</option>
                            <option value="Rash">Rash</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_exposures">Recent Exposures or Travel</label>
                        <select class="form-control" id="recent_exposures" name="recent_exposures" required>
                            <option value="">Select</option>
                            <option value="Exposure to individuals with infectious illnesses">Exposure to individuals with infectious illnesses</option>
                            <option value="Travel to regions with endemic infectious diseases"> Travel to regions with endemic infectious diseases</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>

        <div class="step" id="step5">
            <h3>Headache</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="cluster_headache">Cluster Headache</label>
                        <select class="form-control" id="cluster_headache" name="cluster_headache" required>
                            <option value="">Select</option>
                            <option value="One-sided pain">One-sided pain, typically behind or around one eye</option>
                            <option value="Rapid onset of severe pain">Rapid onset of severe pain</option>
                            <option value="Shorter duration (15 minutes to 3 hours)">Shorter duration (15 minutes to 3 hours)</option>
                            <option value="Associated symptoms: tearing of the eye, nasal congestion, restlessness">Associated symptoms: tearing of the eye, nasal congestion, restlessness</option>
                            <option value="Occurs in clusters over weeks to months (episodic) or persistently (chronic)">Occurs in clusters over weeks to months (episodic) or persistently (chronic)</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Migraine">Migraine</label>
                        <select class="form-control" id="Migraine" name="Migraine" required>
                            <option value="">Select</option>
                            <option value="One-sided or bilateral pain, often localized to the temple, forehead, or around the eyes">One-sided or bilateral pain, often localized to the temple, forehead, or around the eyes</option>
                            <option value="Longer duration compared to cluster headaches (4 to 72 hours if untreated)">Longer duration compared to cluster headaches (4 to 72 hours if untreated)</option>
                            <option value="Associated with nausea, vomiting, photophobia, and phonophobia">Associated with nausea, vomiting, photophobia, and phonophobia</option>
                            <option value=" May have prodromal symptoms (aura) such as visual disturbances or sensory changes"> May have prodromal symptoms (aura) such as visual disturbances or sensory changes</option>
                            <option value="Triggers may include hormonal changes, certain foods, stress, or environmental factors">Triggers may include hormonal changes, certain foods, stress, or environmental factors</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="tension_headache">Tension Headache</label>
                        <select class="form-control" id="tension_headache" name="tension_headache" required>
                            <option value="">Select</option>
                            <option value="Bilateral pain, often described as a band-like pressure or tightness around the head">Bilateral pain, often described as a band-like pressure or tightness around the head</option>
                            <option value="Gradual onset of mild to moderate pain">Gradual onset of mild to moderate pain</option>
                            <option value="Often triggered by stress, poor posture, or muscle tension">Often triggered by stress, poor posture, or muscle tension</option>
                            <option value="Usually no associated symptoms of nausea, vomiting, or sensitivity to light/sound">Usually no associated symptoms of nausea, vomiting, or sensitivity to light/sound</option>
                            <option value="Can be chronic (frequent episodes) or episodic">Can be chronic (frequent episodes) or episodic</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

               
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>
        <div class="step" id="step6">
            <h3>MENINGITIS</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset_progression">Onset and Progression</label>
                        <select class="form-control" id="onset_progression" name="onset_progression" required>
                            <option value="">Select</option>
                            <option value="Sudden onset of symptoms">Sudden onset of symptoms</option>
                            <option value="Rapid progression of symptoms over hours to days">Rapid progression of symptoms over hours to days</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Headache">Headache</label>
                        <select class="form-control" id="Headache" name="Headache" required>
                            <option value="">Select</option>
                            <option value="Headache is typically severe">Headache is typically severe</option>
                            <option value="Headache may be described as the worst headache of my life">Headache may be described as "the worst headache of my life"</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Fever">Fever</label>
                        <select class="form-control" id="Fever" name="Fever" required>
                            <option value="">Select</option>
                            <option value="Neck Stiffness">Neck Stiffness</option>
                            <option value="Neck stiffness, especially when trying to touch the chin to the chest (neck flexion)">Neck stiffness, especially when trying to touch the chin to the chest (neck flexion)</option>
                            <option value="Altered Mental Status">Altered Mental Status</option>
                            <option value="Nausea and Vomiting">Nausea and Vomiting</option>
                            <option value="Photophobia">Photophobia</option>
                            <option value="Rash">Rash</option>
                            <option value="Recent Infection">Recent Infection</option>
                            <option value="Recent exposure to someone with meningitis or a known outbreak">Recent exposure to someone with meningitis or a known outbreak</option>
                            <option value="Incomplete or lack of vaccination against bacterial causes of meningitis">Incomplete or lack of vaccination against bacterial causes of meningitis</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

               
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>

        <div class="step" id="step7">
            <h3>Abdominal Pain History</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="location_of_pain">Location of Pain</label>
                        <select class="form-control" id="location_of_pain" name="location_of_pain" required>
                            <option value="">Select</option>
                            <option value="Upper abdomen (epigastric)">Upper abdomen (epigastric)</option>
                            <option value="Lower abdomen (hypogastric)"> Lower abdomen (hypogastric)</option>
                            <option value="Right upper quadrant (RUQ)">Right upper quadrant (RUQ)</option>
                            <option value="Left upper quadrant (LUQ)">Left upper quadrant (LUQ)</option>
                            <option value="Right lower quadrant (RLQ)">Right lower quadrant (RLQ)</option>
                            <option value="Left lower quadrant (LLQ)">Left lower quadrant (LLQ)</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="character_of_pain">Character of Pain</label>
                        <select class="form-control" id="character_of_pain" name="character_of_pain" required>
                            <option value="">Select</option>
                            <option value="Sharp">Sharp</option>
                            <option value="Dull">Dull</option>
                            <option value="Burning">Burning</option>
                            <option value="Cramping">Cramping</option>
                            <option value="Colicky (waves of intense pain)">Colicky (waves of intense pain)</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset_and_duration">Onset and Duration</label>
                        <select class="form-control" id="onset_and_duration" name="onset_and_duration" required>
                            <option value="">Select</option>
                            <option value="Sudden onset">Sudden onset</option>
                            <option value="Gradual onset">Gradual onset</option>
                            <option value="Constant">Constant</option>
                            <option value="Intermittent">Intermittent</option>
                            <option value="Duration of pain episodes">Duration of pain episodes</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="relieving_factors">Aggravating or Relieving Factors</label>
                        <select class="form-control" id="relieving_factors" name="relieving_factors" required>
                            <option value="">Select</option>
                            <option value="Aggravated by eating">Aggravated by eating</option>
                            <option value="Relieved by eating">Relieved by eating</option>
                            <option value="Aggravated by movement or certain positions">Aggravated by movement or certain positions</option>
                            <option value="Relieved by rest or specific positions">Relieved by rest or specific positions</option>
                            <option value="Aggravated by certain foods or drinks">Aggravated by certain foods or drinks</option>
                            <option value="Associated with bowel movements or urination">Associated with bowel movements or urination</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="associated_symptoms">Associated Symptoms</label>
                        <select class="form-control" id="associated_symptoms" name="associated_symptoms" required>
                            <option value="">Select</option>
                            <option value="Nausea">Nausea</option>
                            <option value="Vomiting">Vomiting</option>
                            <option value="Diarrhea">Diarrhea</option>
                            <option value="Constipation">Constipation</option>
                            <option value="Fever">Fever</option>
                            <option value="Bloating">Bloating</option>
                            <option value="Changes in appetite or weight">Changes in appetite or weight</option>
                            <option value="Blood in stool">Blood in stool</option>
                            <option value="Blood in vomit">Blood in vomit</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="medical_history">Medical History</label>
                        <select class="form-control" id="medical_history" name="medical_history" required>
                            <option value="">Select</option>
                            <option value="Previous Episodes">Previous Episodes</option>
                            <option value="Digestive Disorders">Digestive Disorders</option>
                            <option value="Gallstones/Kidney Stones(known)">Gallstones/Kidney Stones(known)</option>
                            <option value="Dietary Changes">Dietary Changes</option>
                            <option value="Travel History">Travel History</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6" id="previous_episode" style="display:none">
                    <div class="form-group">
                        <label for="previous_episodes">Previous Episodes</label>
                        <input type="text" class="form-control" id="previous_episodes" name="previous_episodes" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="digestive_disorder" style="display:none">
                    <div class="form-group">
                        <label for="digestive_disorders">Digestive Disorders:if diagnosed</label>
                        <input type="text" class="form-control" id="digestive_disorders" name="digestive_disorders" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="dietary_changes_time" style="display:none">
                    <div class="form-group">
                        <label for="dietary_changes_times">Dietary Changes:timing</label>
                        <input type="text" class="form-control" id="dietary_changes_times" name="dietary_changes_times" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="dietary_changes_routine" style="display:none">
                    <div class="form-group">
                        <label for="dietary_changes_routines">Dietary Changes:routine</label>
                        <input type="text" class="form-control" id="dietary_changes_routines" name="dietary_changes_routines" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="travel_history" style="display:none">
                    <div class="form-group">
                        <label for="travel_historys">Travel History</label>
                        <input type="text" class="form-control" id="travel_historys" name="travel_historys" required>
                    </div>
                </div>
                <h6 class="w-100">
                    Personal History
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lifestyle_habits">Lifestyle Habits</label>
                        <select class="form-control" id="lifestyle_habits" name="lifestyle_habits" required>
                            <option value="">Select</option>
                            <option value="Smoking">Smoking</option>
                            <option value="Exercise"> Exercise</option>
                            <option value="Current Medications">Current Medications</option>
                            <option value="Weight lifting">Weight lifting</option>
                            <option value="Home chores">Home chores</option>
                            <option value="Sports">Sports</option>
                            <option value="Homework and studies">Homework and studies</option>
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6" id="current_medication" style="display:none">
                    <div class="form-group">
                        <label for="current_medications">Current Medications</label>
                        <input type="text" class="form-control" id="current_medications" name="current_medications" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="sport" style="display:none">
                    <div class="form-group">
                        <label for="sports">Sports</label>
                        <input type="text" class="form-control" id="sports" name="sports" required>
                    </div>
                </div>

               
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>

        <div class="step" id="step8">
            <h3>Sleep Routine</h3>
            <div class="form-row">
                
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bed_time">Bed time</label>
                        <input type="text" class="form-control" id="bed_time" name="bed_time" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sleep_duration">Sleep duration</label>
                        <input type="text" class="form-control" id="sleep_duration" name="sleep_duration" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sleep_quality">Sleep quality</label>
                        <select class="form-control" id="sleep_quality" name="sleep_quality" required>
                            <option value="">Select</option>
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
                            <option value="none">none</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bedtime_routine">Bedtime routine</label>
                        <input type="text" class="form-control" id="bedtime_routine" name="bedtime_routine" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="daytime_naps">Daytime naps</label>
                        <input type="text" class="form-control" id="daytime_naps" name="daytime_naps" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="breathing_difficulties">Snoring or breathing difficulties</label>
                        <input type="text" class="form-control" id="breathing_difficulties" name="breathing_difficulties" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="restlessness_sleep">Restlessness during sleep</label>
                        <input type="text" class="form-control" id="restlessness_sleep" name="restlessness_sleep" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sleep_environment">Sleep environment (noise, light, etc.)</label>
                        <input type="text" class="form-control" id="sleep_environment" name="sleep_environment" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sleep_related_behaviors">Sleep-related behaviors (sleepwalking, teeth grinding, etc.)</label>
                        <input type="text" class="form-control" id="sleep_related_behaviors" name="sleep_related_behaviors" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="medical_conditions_affecting">Medical conditions affecting sleep</label>
                        <input type="text" class="form-control" id="medical_conditions_affecting" name="medical_conditions_affecting" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="medications_impacting_sleep">Medications impacting sleep</label>
                        <input type="text" class="form-control" id="medications_impacting_sleep" name="medications_impacting_sleep" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="enuresis">Enuresis</label>
                        <input type="text" class="form-control" id="enuresis" name="enuresis" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="immunization_history">Immunization history</label>
                        <input type="text" class="form-control" id="immunization_history" name="immunization_history" required>
                    </div>
                </div>


               
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>

        <div class="step" id="step9">
            <h3>Nutrition History</h3>
            <div class="form-row">
                
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="breakfast">Breakfast if yes</label>
                        <input type="text" class="form-control" id="breakfast" name="breakfast" >
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="roti_eat">How much roti did they eat?</label>
                        <input type="text" class="form-control" id="roti_eat" name="roti_eat" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lunch">Lunch</label>
                        <input type="text" class="form-control" id="lunch" name="lunch" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="skip_meal">Skip meals</label>
                        <input type="text" class="form-control" id="skip_meal" name="skip_meal" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="meal_preference">Meal preferences especially dislikes</label>
                        <input type="text" class="form-control" id="meal_preference" name="meal_preference" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="food_allergies">Food allergies</label>
                        <input type="text" class="form-control" id="food_allergies" name="food_allergies" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dietary_restrictions">Dietary restrictions</label>
                        <input type="text" class="form-control" id="dietary_restrictions" name="dietary_restrictions" >
                    </div>
                </div>

                
               
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>


        <div class="step" id="step10">
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
                        <input type="text" class="form-control" id="onset" name="onset" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="severity">Severity</label>
                        <select class="form-control" id="severity" name="severity" required>
                            <option value="">Select</option>
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
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="location">location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="palpitations">Palpitations</label>
                        <input type="text" class="form-control" id="palpitations" name="palpitations" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fainting_syncope">Fainting/syncope</label>
                        <input type="text" class="form-control" id="fainting_syncope" name="fainting_syncope" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="cyanosis">Cyanosis</label>
                        <input type="text" class="form-control" id="cyanosis" name="cyanosis" required>
                    </div>
                </div>
                <h5 class="w-100">Sob</h5>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_exertion">on exertion</label>
                        <input type="text" class="form-control" id="on_exertion" name="on_exertion" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_rest">on rest</label>
                        <input type="text" class="form-control" id="on_rest" name="on_rest" required>
                    </div>
                </div>
                <h5 class="w-100">Respiratory System</h5>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="nasal_patency">Nasal patency</label>
                        <input type="text" class="form-control" id="nasal_patency" name="nasal_patency" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="clubbing">Clubbing</label>
                        <input type="text" class="form-control" id="clubbing" name="clubbing" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="asthma">Asthma</label>
                        <input type="text" class="form-control" id="asthma" name="asthma" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>
        <div class="step" id="step11">
            <h3>Upper Resp</h3>
            <div class="form-row">

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sore_throat">Sore throat</label>
                        <input type="text" class="form-control" id="sore_throat" name="sore_throat" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="ear_ache">Ear Ache</label>
                        <input type="text" class="form-control" id="ear_ache" name="ear_ache" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="ear_discharge">Ear discharge</label>
                        <select class="form-control" id="ear_discharge" name="ear_discharge" required>
                            <option value="">Select</option>
                            <option value="White">White</option>
                            <option value="Pussy">Pussy</option>
                            <option value="odour">odour</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="runny_nose">Runny nose</label>
                        <input type="text" class="form-control" id="runny_nose" name="runny_nose" required>
                    </div>
                </div>
                <h6 class="w-100">Cough</h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sputum_color">Sputum color</label>
                        <input type="text" class="form-control" id="sputum_color" name="sputum_color" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sputum_quantity">Sputum quantity</label>
                        <input type="text" class="form-control" id="sputum_quantity" name="sputum_quantity" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Brasky">Brasky</label>
                        <input type="text" class="form-control" id="Brasky" name="Brasky" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="whooping">Whooping</label>
                        <input type="text" class="form-control" id="whooping" name="whooping" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="blood_in_sputum">Blood in sputum</label>
                        <input type="text" class="form-control" id="blood_in_sputum" name="blood_in_sputum" required>
                    </div>
                </div>

                <h4 class="w-100">
                    History of Pneumonia
                </h4>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="episode_per_month">Episodes per month</label>
                        <input type="text" class="form-control" id="episode_per_month" name="episode_per_month" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="hospitalization">Hospitalization</label>
                        <input type="text" class="form-control" id="hospitalization" name="hospitalization" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>

        <div class="step" id="step12">
            <h3>Lower Respiratory tract infections</h3>
            <div class="form-row">

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_sputum_color">Sputum color</label>
                        <input type="text" class="form-control" id="lower_sputum_color" name="lower_sputum_color" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_speutum_quantitiy">Sputum quantity</label>
                        <input type="text" class="form-control" id="lower_speutum_quantitiy" name="lower_speutum_quantitiy" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_brasky">Brasky</label>
                        <input type="text" class="form-control" id="lower_brasky" name="lower_brasky" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_whooping">Whooping</label>
                        <input type="text" class="form-control" id="lower_whooping" name="lower_whooping" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_blood_in_sputum">Blood in sputum</label>
                        <input type="text" class="form-control" id="lower_blood_in_sputum" name="lower_blood_in_sputum" required>
                    </div>
                </div>

                <h5 class="w-100">Sob</h5>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_exertion_mild">On Exertion Mild</label>
                        <input type="text" class="form-control" id="on_exertion_mild" name="on_exertion_mild" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_exertion_moderate">On Exertion Moderate</label>
                        <input type="text" class="form-control" id="on_exertion_moderate" name="on_exertion_moderate" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_exertion_severe">On Exertion Severe</label>
                        <input type="text" class="form-control" id="on_exertion_severe" name="on_exertion_severe" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="wheezing">Wheezing</label>
                        <input type="text" class="form-control" id="wheezing" name="wheezing" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="crackles">Crackles</label>
                        <input type="text" class="form-control" id="crackles" name="crackles" required>
                    </div>
                </div>

                <h5 class="w-100">History of Infections</h5>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="infection_episodes_per_month">Episodes per month</label>
                        <input type="text" class="form-control" id="infection_episodes_per_month" name="infection_episodes_per_month" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="hospitalisation">Hospitalisation</label>
                        <input type="text" class="form-control" id="hospitalisation" name="hospitalisation" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="gastrointestinal_system">Gastrointestinal System</label>
                        <select class="form-control" id="gastrointestinal_system" name="gastrointestinal_system" required>
                            <option value="">Select</option>
                            <option value="GERD">GERD</option>
                            <option value="Blood in stool">Blood in stool</option>
                            <option value="Blood in vomiting">Blood in vomiting</option>
                            <option value="Black tarry stools">Black tarry stools</option>
                            <option value="Distension">Distension</option>
                            <option value="Abdominal Tenderness">Abdominal Tenderness</option>
                            <option value="Abdominal pain">Abdominal pain</option>
                            <option value="jaundice / skin itching">jaundice / skin itching</option>
                            <option value="Diarrhoea">Diarrhoea</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="endocrine_system">Endocrine System</label>
                        <select class="form-control" id="endocrine_system" name="endocrine_system" required>
                            <option value="">Select</option>
                            <option value="Diabetes Mellitus">Diabetes Mellitus</option>
                            <option value="Thyroid Disorders">Thyroid Disorders</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="renal_system">Renal System</label>
                        <select class="form-control" id="renal_system" name="renal_system" required>
                            <option value="">Select</option>
                            <option value="Kidney Stones">Kidney Stones</option>
                            <option value="Polyuria">Polyuria</option>
                            <option value="dysuria">dysuria</option>
                            <option value="Back pain">Back pain</option>
                            <option value="Blood in urine">Blood in urine</option>
                            <option value="Foamy urine">Foamy urine</option>
                            <option value="Urinary Tract Infections">Urinary Tract Infections</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6" id="renal_kidney" style="display:none">
                    <div class="form-group">
                        <label for="kidney_stones_case">Kidney Stones: known case</label>
                        <input type="text" class="form-control" id="kidney_stones_case" name="kidney_stones_case" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="back_pain" style="display:none">
                    <div class="form-group">
                        <label for="back_pain_site">Back pain :site</label>
                        <input type="text" class="form-control" id="back_pain_site" name="back_pain_site" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="urinary_episodes" style="display:none">
                    <div class="form-group">
                        <label for="urinary_tract">Urinary Tract Infections:no.of episodes in a year</label>
                        <input type="text" class="form-control" id="urinary_tract" name="urinary_tract" required>
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="neurological_system">Neurological System</label>
                        <select class="form-control" id="neurological_system" name="neurological_system" required>
                            <option value="">Select</option>
                            <option value="Seizure Disorder">Seizure Disorder</option>
                            <option value="Migraines">Migraines</option>
                            <option value="Falls">Falls</option>
                            <option value="Syncope">Syncope</option>
                            <option value="Blurr vision">Blurr vision</option>
                            <option value="Confusion">Confusion</option>
                            <option value="Incontinence">Incontinence</option>
                            <option value="Headache">Headache</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6" id="neuro_falls" style="display:none">
                    <div class="form-group">
                        <label for="neuro_falls_number">Falls</label>
                        <input type="number" class="form-control" id="neuro_falls_number" name="neuro_falls_number" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="neuro_syncope" style="display:none">
                    <div class="form-group">
                        <label for="Syncope">Syncope</label>
                        <input type="text" class="form-control" id="Syncope" name="Syncope" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="musculoskeletal_system">Musculoskeletal System</label>
                        <select class="form-control" id="musculoskeletal_system" name="musculoskeletal_system" required>
                            <option value="">Select</option>
                            <option value="Bone pain">Bone pain</option>
                            <option value="Back Pain">Back Pain</option>
                            <option value="Ambulatory">Ambulatory</option>
                            <option value="Joint movement">Joint movement</option>
                            <option value="Swellings">Swellings</option>
                            <option value="Congenital deformity">Congenital deformity</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6" id="muscu_body_pain" style="display:none">
                    <div class="form-group">
                        <label for="muscu_body_pain_specify">Bone pain: Specify</label>
                        <input type="number" class="form-control" id="muscu_body_pain_specify" name="kidney_stones_case" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="hematologic_system">Hematologic System</label>
                        <select class="form-control" id="hematologic_system" name="hematologic_system" required>
                            <option value="">Select</option>
                            <option value="Anemia">Anemia</option>
                            <option value="Excessive bleeding">Excessive bleeding</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>

        <div class="step" id="step13">
            <h3>SKIN DISEASE</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="rashes">Rashes</label>
                        <select class="form-control" id="rashes" name="rashes" required>
                            <option value="">Select</option>
                            <option value="Macular">Macular</option>
                            <option value="papules">papules</option>
                            <option value="vesicular">vesicular</option>
                            <option value="Painful">Painful</option>
                            <option value="painless">painless</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset_of_rashes">Onset of rashes</label>
                        <input type="text" class="form-control" id="onset_of_rashes" name="onset_of_rashes" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="rashes_site">Site</label>
                        <input type="text" class="form-control" id="rashes_site" name="rashes_site" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="started_from">Started From</label>
                        <input type="text" class="form-control" id="started_from" name="started_from" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="itching">Itching</label>
                        <input type="text" class="form-control" id="itching" name="itching" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="rashes_fever">Fever</label>
                        <select class="form-control" id="rashes_fever" name="rashes_fever" required>
                            <option value="">Select</option>
                            <option value="onset">onset</option>
                            <option value="before rash">before rash</option>
                            <option value="after rash">after rash</option> 
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="coryza">Coryza</label>
                        <input type="text" class="form-control" id="coryza" name="coryza" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>

        <div class="step" id="step14">
            <h3>Chief Complaint</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="chief_complaint">Chief Complaint</label>
                        <select class="form-control" id="chief_complaint" name="chief_complaint" required>
                            <option value="">Select</option>
                            <option value="Fungal Infection">Fungal Infection</option>
                            <option value="Dermatitis">Dermatitis</option>
                            <option value="Scabies">Scabies</option>
                            <option value="Herpes">Herpes</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6" id="chef_comlaint_div" style="display:none">
                    <div class="form-group">
                        <label for="chef_comlaint_specify">Specify</label>
                        <input type="text" class="form-control" id="chef_comlaint_specify" name="chef_comlaint_specify" required>
                    </div>
                </div>
                <h6 class="w-100">
                    Past Medical History
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="previous_skin_conditions">Previous skin conditions or diseases</label>
                        <input type="text" class="form-control" id="previous_skin_conditions" name="previous_skin_conditions" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="skincare_products">Allergies or sensitivities to medications or skincare products</label>
                        <input type="text" class="form-control" id="skincare_products" name="skincare_products" required>
                    </div>
                </div>

                <h6 class="w-100">
                    Family History
                </h6>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="family_skin_disease">Family history of skin diseases (specify if known)</label>
                        <input type="text" class="form-control" id="family_skin_disease" name="family_skin_disease" required>
                    </div>
                </div>

                <h6 class="w-100">
                    Fungal Infections:ring like lesion ,white lesion ,itching then suspect fungal infections
                </h6>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fungal_infections_type">Type</label>
                        <input type="text" class="form-control" id="fungal_infections_type" name="fungal_infections_type" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fungal_infections_duration">Duration  (days/weeks/months/years)</label>
                        <input type="text" class="form-control" id="fungal_infections_duration" name="fungal_infections_duration" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fungal_previous_treatments">Previous treatments and efficacy</label>
                        <input type="text" class="form-control" id="fungal_previous_treatments" name="fungal_previous_treatments" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fungal_infections_recurrence">Recurrence or spread</label>
                        <select class="form-control" id="fungal_infections_recurrence" name="fungal_infections_recurrence" required>
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <h6 class="w-100">
                    Dermatitis
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dermatitis_type">Type: _irritant or contact or atopic</label>
                        <input type="text" class="form-control" id="dermatitis_type" name="dermatitis_type" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dermatitis_triggers">Triggers or aggravating factors</label>
                        <input type="text" class="form-control" id="dermatitis_triggers" name="dermatitis_triggers" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dermatitis_symptoms">Symptoms</label>
                        <input type="text" class="form-control" id="dermatitis_symptoms" name="dermatitis_symptoms" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dermatitis_previous_treatments">Previous treatments and response</label>
                        <input type="text" class="form-control" id="dermatitis_previous_treatments" name="dermatitis_previous_treatments" required>
                    </div>
                </div>
                <h6 class="w-100">
                    Scabies:if severe itching with linear burrows
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="scabies_history">History of exposure</label>
                        <select class="form-control" id="scabies_history" name="scabies_history" required>
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="scabies_symptoms">Symptoms</label>
                        <input type="text" class="form-control" id="scabies_symptoms" name="scabies_symptoms" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="scabies_previous_treatments">Previous treatments and response</label>
                        <input type="text" class="form-control" id="scabies_previous_treatments" name="scabies_previous_treatments" required>
                    </div>
                </div>
                <h6 class="w-100">
                    Herpes: if painful lesion especially around corner of mouth
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_type">Type: (oral/genital)</label>
                        <input type="text" class="form-control" id="herpes_type" name="herpes_type" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_triggers">Triggers for outbreaks</label>
                        <input type="text" class="form-control" id="herpes_triggers" name="herpes_triggers" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_location">Location</label>
                        <input type="text" class="form-control" id="herpes_location" name="herpes_location" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_pain">pain</label>
                        <input type="text" class="form-control" id="herpes_pain" name="herpes_pain" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_symptoms">Symptoms during outbreaks</label>
                        <input type="text" class="form-control" id="herpes_symptoms" name="herpes_symptoms" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_previous_treatments">Previous antiviral treatments and effectiveness</label>
                        <input type="text" class="form-control" id="herpes_previous_treatments" name="herpes_previous_treatments" required>
                    </div>
                </div>
                <h6 class="w-100">
                    Current Medications
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_current_medication">Any current medications, including topical treatments for skin conditions.</label>
                        <input type="text" class="form-control" id="herpes_current_medication" name="herpes_current_medication" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="current_additional_notes">Additional Notes</label>
                        <input type="text" class="form-control" id="current_additional_notes" name="current_additional_notes" required>
                    </div>
                </div>

                <h6 class="w-100">
                    Menstural History
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="age_first_menstrual">Age of first menstrual period (menarche)</label>
                        <select class="form-control" id="age_first_menstrual" name="age_first_menstrual" required>
                            <option value="">Select</option>
                            <option value="<10 years old">&lt;10 years old</option>
                            <option value="10-12 years old">10-12 years old</option>
                            <option value="13-15 years old">13-15 years old</option>
                            <option value=">15 years old">&gt;15 years old</option>
                            <option value="Not started">Not started</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="regularity_menstrual">Regularity of menstrual cycles</label>
                        <select class="form-control" id="regularity_menstrual" name="regularity_menstrual" required>
                            <option value="">Select</option>
                            <option value="Regular (occurring every 21-35 days)">Regular (occurring every 21-35 days)</option>
                            <option value="Irregular (less predictable, varying cycle lengths)">Irregular (less predictable, varying cycle lengths)</option>
                            <option value="Unsure">Unsure</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="duration_menstrual">Duration of menstrual flow</label>
                        <select class="form-control" id="duration_menstrual" name="duration_menstrual" required>
                            <option value="">Select</option>
                            <option value="1-3 days">1-3 days</option>
                            <option value="4-5 days">4-5 days</option>
                            <option value="6-7 days">6-7 days</option>
                            <option value="More than 7 days">More than 7 days</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="amount_menstrual_bleeding">Amount of menstrual bleeding</label>
                        <select class="form-control" id="amount_menstrual_bleeding" name="amount_menstrual_bleeding" required>
                            <option value="">Select</option>
                            <option value="Light (requires only a few pads per day)">Light (requires only a few pads per day)</option>
                            <option value="Moderate (requires several pads per day)">Moderate (requires several pads per day)</option>
                            <option value="Heavy (requires frequent pad/tampon changes)">Heavy (requires frequent pad/tampon changes)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="symptoms_menstruation">Symptoms experienced during menstruation</label>
                        <select class="form-control" id="symptoms_menstruation" name="symptoms_menstruation" required>
                            <option value="">Select</option>
                            <option value="Cramps">Cramps</option>
                            <option value="Back pain">Back pain</option>
                            <option value="Headaches">Headaches</option>
                            <option value="Bloating">Bloating</option>
                            <option value="Mood swings">Mood swings</option>
                            <option value="Nausea">Nausea</option>
                            <option value="Fatigue">Fatigue</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="use_menstrual_products">Use of menstrual hygiene products</label>
                        <select class="form-control" id="use_menstrual_products" name="use_menstrual_products" required>
                            <option value="">Select</option>
                            <option value="Pads">Pads</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6" id="use_menstrual_products_div" style="display:none;">
                    <div class="form-group">
                        <label for="menstrual_products_specify">Please specify</label>
                        <input type="text" class="form-control" id="menstrual_products_specify" name="menstrual_products_specify" required>
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="history_menstrual_disorder">Any history of menstrual disorders or complications</label>
                        <select class="form-control" id="history_menstrual_disorder" name="history_menstrual_disorder" required>
                            <option value="">Select</option>
                            <option value="Dysmenorrhea (painful periods)">Dysmenorrhea (painful periods)</option>
                            <option value="Amenorrhea (absence of periods)">Amenorrhea (absence of periods)</option>
                            <option value="Menorrhagia (excessive menstrual bleeding)">Menorrhagia (excessive menstrual bleeding)</option>
                            <option value="Oligomenorrhea (infrequent periods)">Oligomenorrhea (infrequent periods)</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6" id="dysmenorrhea_div" style="display:none;">
                    <div class="form-group">
                        <label for="dysmenorrhea_onset">Dysmenorrhea (painful periods):onset</label>
                        <input type="text" class="form-control" id="dysmenorrhea_onset" name="dysmenorrhea_onset" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="amenorrhea_div" style="display:none;">
                    <div class="form-group">
                        <label for="amenorrhea_duration">Amenorrhea (absence of periods):duration</label>
                        <input type="text" class="form-control" id="amenorrhea_duration" name="amenorrhea_duration" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="menorrhagia_duration_div" style="display:none;">
                    <div class="form-group">
                        <label for="menorrhagia_duration">Menorrhagia (excessive menstrual bleeding) duration</label>
                        <input type="text" class="form-control" id="menorrhagia_duration" name="menorrhagia_duration" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="menorrhagia_severity_div" style="display:none;">
                    <div class="form-group">
                        <label for="menorrhagia_severity">Menorrhagia (excessive menstrual bleeding) severity</label>
                        <input type="text" class="form-control" id="menorrhagia_severity" name="menorrhagia_severity" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="oligomenorrhea_duration_div" style="display:none;">
                    <div class="form-group">
                        <label for="oligomenorrhea_duration">Oligomenorrhea (infrequent periods):duration</label>
                        <input type="text" class="form-control" id="oligomenorrhea_duration" name="oligomenorrhea_duration" required>
                    </div>
                </div>
                <div class="form-group col-md-6" id="menstrual_disorder_other_div" style="display:none;">
                    <div class="form-group">
                        <label for="menstrual_disorder_other">Please specify</label>
                        <input type="text" class="form-control" id="menstrual_disorder_other" name="menstrual_disorder_other" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>
        <div class="step" id="step15">
            <!-- <h3>SKIN DISEASE</h3> -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="any_previous_medication_menstruation">Any previous medical treatments or interventions related to menstruation</label>
                        <select class="form-control" id="any_previous_medication_menstruation" name="any_previous_medication_menstruation" required>
                            <option value="">Select</option>
                            <option value="Pain medications">Pain medications</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6" id="medication_menstruation_other_div" style="display:none">
                    <div class="form-group">
                        <label for="medication_menstruation_other">Please specify</label>
                        <input type="text" class="form-control" id="medication_menstruation_other" name="medication_menstruation_other" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="additional_concerns">Additional comments or concerns</label>
                        <input type="text" class="form-control" id="additional_concerns" name="additional_concerns" required>
                    </div>
                </div>
                <h6 class="w-100">
                    Past Medical Conditions
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="longterm_health">long-term health conditions</label>
                        <select class="form-control" id="longterm_health" name="longterm_health" required>
                            <option value="">Select</option>
                            <option value="Asthma">Asthma</option>
                            <option value="Diabetes">Diabetes</option>
                            <option value="Hypertension">Hypertension</option> 
                            <option value="other">other</option> 
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6" id="longterm_health_other_div" style="display:none">
                    <div class="form-group">
                        <label for="longterm_health_other">Please specify</label>
                        <input type="text" class="form-control" id="longterm_health_other" name="longterm_health_other" required>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="accident_or_injuries">Accident or Injuries</label>
                        <input type="text" class="form-control" id="accident_or_injuries" name="accident_or_injuries" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="surgeries">Surgeries</label>
                        <input type="text" class="form-control" id="surgeries" name="surgeries" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="any_current_medications">Any Current medications</label>
                        <input type="text" class="form-control" id="any_current_medications" name="any_current_medications" required>
                    </div>
                </div>
                <h6 class="w-100">
                    Allergies
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_medications">Medications</label>
                        <input type="text" class="form-control" id="alergies_medications" name="alergies_medications" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_chemicals">Chemicals</label>
                        <input type="text" class="form-control" id="alergies_chemicals" name="alergies_chemicals" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_pollen">Pollen/Furs</label>
                        <input type="text" class="form-control" id="alergies_pollen" name="alergies_pollen" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_food">Food</label>
                        <input type="text" class="form-control" id="alergies_food" name="alergies_food" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_metals">Metals</label>
                        <input type="text" class="form-control" id="alergies_metals" name="alergies_metals" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_other">Other</label>
                        <input type="text" class="form-control" id="alergies_other" name="alergies_other" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="family_history_past">Family History</label>
                        <select class="form-control" id="family_history_past" name="family_history_past" required>
                            <option value="">Select</option>
                            <option value="heart disease">heart disease</option>
                            <option value="Hypertension">Hypertension</option>
                            <option value="Obesity">Obesity</option> 
                            <option value="Cancer">Cancer</option> 
                            <option value="Diabetes">Diabetes</option> 
                            <option value="or other">or other</option> 
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="button" class="btn btn-primary nextStep mb-3">Next</button>
        </div>

        <div class="step" id="step16">
            <h3>SOCIOECONOMIC</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="water">Water</label>
                        <select class="form-control" id="water" name="water" required>
                            <option value="">Select</option>
                            <option value="Tap">Tap</option>
                            <option value="Boiled">Boiled</option>
                            <option value="filtered">filtered</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="milk">Milk</label>
                        <select class="form-control" id="milk" name="milk" required>
                            <option value="">Select</option>
                            <option value="Boiled (unpasturized milk)">Boiled (unpasturized milk)</option>
                            <option value="Tetrapack">Tetrapack</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="rooms">Rooms</label>
                        <select class="form-control" id="rooms" name="rooms" required>
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option> 
                            <option value="4">4</option> 
                            <option value="5">5</option> 
                            <option value="5+">5+</option> 
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="infectious_disease">Infectious disease and any sick people at home</label>
                        <select class="form-control" id="infectious_disease" name="infectious_disease" required>
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="NO">NO</option> 
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
                        <input type="text" class="form-control" id="ddx" name="ddx" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="note_to_principal">Note to principal</label>
                        <input type="text" class="form-control" id="note_to_principal" name="note_to_principal" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="note_to_parent">Note to parent</label>
                        <input type="text" class="form-control" id="note_to_parent" name="note_to_parent" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="attach_picture">Attach Picture</label>
                        <input type="file" class="form-control" id="attach_picture" name="attach_picture" required>
                    </div>
                </div>
                
            </div>

            <button type="button" class="btn btn-primary prevStep mb-3">Previous</button>
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </div>
        
    </form>

</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>


function validate(e, isLastStep = false) 
{

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
                    for( fieldError of fieldErrors ) {
                        $('#'+fieldError)
                        .addClass('error-border')
                        .closest('.form-group')
                        .append('<small class="text-danger error-text">This field is required</small>');
                    }
                }
                return isValid;
            }

            // $('.nextStep').click(validate)
            
        // Add an event listener to the select element
        document.getElementById('onset_duration').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var durationInput = document.getElementById('durationInput');

            // Check if the selected value is "Duration of fever episodes"
            if (selectedValue === 'Duration of fever episodes') {
                
                durationInput.style.display = 'block';
            } else {
                
                durationInput.style.display = 'none';
            }
        });
        document.getElementById('lifestyle_habits').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var current_medication = document.getElementById('current_medication');
            var Sport = document.getElementById('sport');
            // Check if the selected value is "Duration of fever episodes"
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

        document.getElementById('renal_system').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var renal_kidney = document.getElementById('renal_kidney');
            var back_pain = document.getElementById('back_pain');
            var urinary_episodes = document.getElementById('urinary_episodes');
            // Check if the selected value is "Duration of fever episodes"
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

        document.getElementById('neurological_system').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var neuro_falls = document.getElementById('neuro_falls');
            var neuro_syncope = document.getElementById('neuro_syncope');
            // Check if the selected value is "Duration of fever episodes"
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

        document.getElementById('musculoskeletal_system').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var muscu_body_pain = document.getElementById('muscu_body_pain');
            // Check if the selected value is "Duration of fever episodes"
            if (selectedValue === 'Bone pain') {
                
                muscu_body_pain.style.display = 'block';
            } else {
                
                muscu_body_pain.style.display = 'none';
            }
        });

        document.getElementById('chief_complaint').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var chef_comlaint_div = document.getElementById('chef_comlaint_div');
            // Check if the selected value is "Duration of fever episodes"
            if (selectedValue === 'Other') {
                
                chef_comlaint_div.style.display = 'block';
            } else {
                
                chef_comlaint_div.style.display = 'none';
            }
        });

        document.getElementById('use_menstrual_products').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var use_menstrual_products_div = document.getElementById('use_menstrual_products_div');
            // Check if the selected value is "Duration of fever episodes"
            if (selectedValue === 'Other') {
                
                use_menstrual_products_div.style.display = 'block';
            } else {
                
                use_menstrual_products_div.style.display = 'none';
            }
        });
        document.getElementById('history_menstrual_disorder').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var dysmenorrhea_div = document.getElementById('dysmenorrhea_div');
            var amenorrhea_div = document.getElementById('amenorrhea_div');
            var menorrhagia_duration_div = document.getElementById('menorrhagia_duration_div');
            var menorrhagia_severity_div = document.getElementById('menorrhagia_severity_div');
            var oligomenorrhea_duration_div = document.getElementById('oligomenorrhea_duration_div');
            var menstrual_disorder_other_div = document.getElementById('menstrual_disorder_other_div');
            // Check if the selected value is "Duration of fever episodes"
            if (selectedValue === 'Dysmenorrhea (painful periods)') {
                
                dysmenorrhea_div.style.display = 'block';
            }else{
                dysmenorrhea_div.style.display = 'none';
            } 
            if (selectedValue === 'Amenorrhea (absence of periods)') {
                
                amenorrhea_div.style.display = 'block';
            }else{
                amenorrhea_div.style.display = 'none';
            } 
            if (selectedValue === 'Menorrhagia (excessive menstrual bleeding)') {
                
                menorrhagia_duration_div.style.display = 'block';
                menorrhagia_severity_div.style.display = 'block';
            }else{
                menorrhagia_duration_div.style.display = 'none';
                menorrhagia_severity_div.style.display = 'none';
            } 
            if (selectedValue === 'Oligomenorrhea (infrequent periods)') {
                
                oligomenorrhea_duration_div.style.display = 'block';
            }else{
                oligomenorrhea_duration_div.style.display = 'none';
            } 
            if (selectedValue === 'Other') {
                
                menstrual_disorder_other_div.style.display = 'block';
            }
             else {
                
                menstrual_disorder_other_div.style.display = 'none';
            }
        });

        document.getElementById('any_previous_medication_menstruation').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var medication_menstruation_other_div = document.getElementById('medication_menstruation_other_div');
            // Check if the selected value is "Duration of fever episodes"
            if (selectedValue === 'Other') {
                
                medication_menstruation_other_div.style.display = 'block';
            } else {
                
                medication_menstruation_other_div.style.display = 'none';
            }
        });

        document.getElementById('longterm_health').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var longterm_health_other_div = document.getElementById('longterm_health_other_div');
            // Check if the selected value is "Duration of fever episodes"
            if (selectedValue === 'Other') {
                
                longterm_health_other_div.style.display = 'block';
            } else {
                
                longterm_health_other_div.style.display = 'none';
            }
        });

        document.getElementById('medical_history').addEventListener('change', function() {
            // Get the selected value
            var selectedValue = this.value;

            // Get the input field
            var previous_episode = document.getElementById('previous_episode');
            var digestive_disorder = document.getElementById('digestive_disorder');
            var dietary_changes_time = document.getElementById('dietary_changes_time');
            var dietary_changes_routine = document.getElementById('dietary_changes_routine');
            var travel_history = document.getElementById('travel_history');
            // Check if the selected value is "Duration of fever episodes"
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
    </script>
<script>
    $(document).ready(function () {
        $('.nextStep').click(function () {
            var currentStep = $(this).closest('.step');
            var nextStep = currentStep.next('.step');

            // Move to the next step
            currentStep.removeClass('active');
            nextStep.addClass('active');
        });

        $('.prevStep').click(function () {
            var currentStep = $(this).closest('.step');
            var prevStep = currentStep.prev('.step');

            // Move to the previous step
            currentStep.removeClass('active');
            prevStep.addClass('active');
        });
    });
</script>
@endsection