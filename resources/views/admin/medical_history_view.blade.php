@extends('admin.main')
@section('content')

<style>
    body {
        margin: 30px;
        background-color: aliceblue;
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
    <form id="multiStepFormView">
        <!-- Step-one -->
            <h3>Patient Information</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="gr_no">GR.No.</label>
                        <input type="text" class="form-control" id="gr_no" name="gr_no" value="123" >
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="test">
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="class">Class</label>
                        <input type="text" class="form-control" id="class" name="class" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="text" class="form-control" id="dob" name="dob" value="2024-02-21">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" value="Female">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="blood_group">Blood group</label>
                        <input type="text" class="form-control" id="blood_group" name="Blood_group" value="O+">
                       
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="132546">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="test@gmail.com">
                    </div>
                </div>
                <hr>
                <h6 class="w-100">
                    Emergency Contact
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="emergency_name">Name</label>
                        <input type="text" class="form-control" id="emergency_name" name="emergency_name" value="Test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="emergency_relationship">Relationship</label>
                        <input type="text" class="form-control" id="emergency_relationship" name="emergency_relationship" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="emergency_contact">Contact</label>
                        <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" value="132154">
                    </div>
                </div>
            </div>

            <h3>Presenting Complaints</h3>

            <h6 class="w-100">
                Main Complaint
            </h6>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset">Onset</label>
                        <input type="text" class="form-control" id="onset" name="onset" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="severity">Severity (Scale 1-10)</label>
                        <input type="text" class="form-control" id="severity" name="severity" value="9">
                       
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="relieving_factors">Aggravating/Relieving Factors</label>
                        <input type="text" class="form-control" id="relieving_factors" name="relieving_factors" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="associated_symptoms">Associated Symptoms</label>
                        <input type="text" class="form-control" id="associated_symptoms" name="associated_symptoms" value="test">
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
                        <input type="text" class="form-control" id="sec_description" name="sec_description" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_onset">Onset</label>
                        <input type="text" class="form-control" id="sec_onset" name="sec_onset" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_duration">Duration</label>
                        <input type="text" class="form-control" id="sec_duration" name="sec_duration" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_severity">Severity (Scale 1-10)</label>
                        <input type="text" class="form-control" id="sec_severity" name="sec_severity" value="8">
                       
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_relieving_factors">Aggravating/Relieving Factors</label>
                        <input type="text" class="form-control" id="sec_relieving_factors" name="sec_relieving_factors" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sec_associated_symptoms">Associated Symptoms</label>
                        <input type="text" class="form-control" id="sec_associated_symptoms" name="sec_associated_symptoms" value="test">
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
                        <input type="text" class="form-control" id="recent_description" name="recent_description" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_onset">Onset</label>
                        <input type="text" class="form-control" id="recent_onset" name="recent_onset" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_duration">Duration</label>
                        <input type="text" class="form-control" id="recent_duration" name="recent_duration" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_severity">Severity (Scale 1-10)</label>
                        <input type="text" class="form-control" id="recent_severity" name="recent_severity" value="5">
                       
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_relieving_factors">Aggravating/Relieving Factors</label>
                        <input type="text" class="form-control" id="recent_relieving_factors" name="recent_relieving_factors" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_associated_symptoms">Associated Symptoms</label>
                        <input type="text" class="form-control" id="recent_associated_symptoms" name="recent_associated_symptoms" value="test">
                    </div>
                </div>
            </div>

            <h3>VITAL SIGNS</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="pulse">Pulse</label>
                        <input type="text" class="form-control" id="pulse" name="pulse" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="temperature">Temperature</label>
                        <input type="text" class="form-control" id="temperature" name="temperature" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bp">bp</label>
                        <input type="text" class="form-control" id="bp" name="bp" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="respiratory_rate">Respiratory Rate</label>
                        <input type="text" class="form-control" id="respiratory_rate" name="respiratory_rate" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bmi_weight">BMI Weight</label>
                        <input type="text" class="form-control" id="bmi_weight" name="bmi_weight" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bmi_height">BMI Height</label>
                        <input type="text" class="form-control" id="bmi_height" name="bmi_height" value="test">
                    </div>
                </div>
            </div>

            <h3>Fever History</h3>
            <h6 class="w-100">
               Temperature Measurement
            </h6>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="actual_temperature">Actual temperature measured (e.g., with a thermometer)</label>
                        <input type="text" class="form-control" id="actual_temperature" name="actual_temperature" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="description_fever">Description of fever</label>
                        <input type="text" class="form-control" id="description_fever" name="description_fever" value="Low-grade">
                       
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset_duration">Onset and Duration</label>
                        <input type="text" class="form-control" id="onset_duration" name="onset_duration" value="Duration of fever episodes">
                        
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="duration_fever_episodes">Duration of fever episodes</label>
                        <input type="text" class="form-control" id="duration_fever_episodes" name="duration_fever_episodes" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="pattern_fever">Pattern of Fever</label>
                        <input type="text" class="form-control" id="pattern_fever" name="pattern_fever" value="Intermittent (fever spikes followed by normal temperature">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="associated_symptoms">Associated Symptoms</label>
                        <input type="text" class="form-control" id="associated_symptoms" name="associated_symptoms" value="Headache">
                     
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="recent_exposures">Recent Exposures or Travel</label>
                        <input type="text" class="form-control" id="recent_exposures" name="recent_exposures" value="test">
                        
                    </div>
                </div>
            </div>

            <h3>Headache</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="cluster_headache">Cluster Headache</label>
                        <input type="text" class="form-control" id="cluster_headache" name="cluster_headache" value="One-sided pain, typically behind or around one eye">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Migraine">Migraine</label>
                        <input type="text" class="form-control" id="Migraine" name="Migraine" value="Longer duration compared to cluster headaches (4 to 72 hours if untreated)">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="tension_headache">Tension Headache</label>
                        <input type="text" class="form-control" id="tension_headache" name="tension_headache" value="Gradual onset of mild to moderate pain">
                        
                    </div>
                </div>

               
            </div>

            <h3>MENINGITIS</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset_progression">Onset and Progression</label>
                        <input type="text" class="form-control" id="onset_progression" name="onset_progression" value="Sudden onset of symptoms">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Headache">Headache</label>
                        <input type="text" class="form-control" id="Headache" name="Headache" value="Headache is typically severe">
                       
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Fever">Fever</label>
                        <input type="text" class="form-control" id="Fever" name="Fever" value="Neck Stiffness">
                       
                    </div>
                </div>

               
            </div>

            <h3>Abdominal Pain History</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="location_of_pain">Location of Pain</label>
                        <input type="text" class="form-control" id="location_of_pain" name="location_of_pain" value="Upper abdomen (epigastric)">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="character_of_pain">Character of Pain</label>
                        <input type="text" class="form-control" id="character_of_pain" name="character_of_pain" value="Sharp">
                        
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset_and_duration">Onset and Duration</label>
                        <input type="text" class="form-control" id="onset_and_duration" name="onset_and_duration" value="Sudden onset">
                        
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="relieving_factors">Aggravating or Relieving Factors</label>
                        <input type="text" class="form-control" id="relieving_factors" name="relieving_factors" value="Aggravated by eating">
                       
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="associated_symptoms">Associated Symptoms</label>
                        <input type="text" class="form-control" id="associated_symptoms" name="associated_symptoms" value="Nausea">
                        
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="medical_history">Medical History</label>
                        <input type="text" class="form-control" id="medical_history" name="medical_history" value="Previous Episodes">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="previous_episodes">Previous Episodes</label>
                        <input type="text" class="form-control" id="previous_episodes" name="previous_episodes" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="digestive_disorder">
                    <div class="form-group">
                        <label for="digestive_disorders">Digestive Disorders:if diagnosed</label>
                        <input type="text" class="form-control" id="digestive_disorders" name="digestive_disorders" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="dietary_changes_time">
                    <div class="form-group">
                        <label for="dietary_changes_times">Dietary Changes:timing</label>
                        <input type="text" class="form-control" id="dietary_changes_times" name="dietary_changes_times" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="dietary_changes_routine">
                    <div class="form-group">
                        <label for="dietary_changes_routines">Dietary Changes:routine</label>
                        <input type="text" class="form-control" id="dietary_changes_routines" name="dietary_changes_routines" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="travel_history">
                    <div class="form-group">
                        <label for="travel_historys">Travel History</label>
                        <input type="text" class="form-control" id="travel_historys" name="travel_historys" value="test">
                    </div>
                </div>
                <h6 class="w-100">
                    Personal History
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lifestyle_habits">Lifestyle Habits</label>
                        <input type="text" class="form-control" id="lifestyle_habits" name="lifestyle_habits" value="Smoking">
                        
                    </div>
                </div>
                <div class="form-group col-md-6" id="current_medication">
                    <div class="form-group">
                        <label for="current_medications">Current Medications</label>
                        <input type="text" class="form-control" id="current_medications" name="current_medications" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="sport">
                    <div class="form-group">
                        <label for="sports">Sports</label>
                        <input type="text" class="form-control" id="sports" name="sports" value="test">
                    </div>
                </div>

               
            </div>

       
            <h3>Sleep Routine</h3>
            <div class="form-row">
                
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bed_time">Bed time</label>
                        <input type="text" class="form-control" id="bed_time" name="bed_time" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sleep_duration">Sleep duration</label>
                        <input type="text" class="form-control" id="sleep_duration" name="sleep_duration" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sleep_quality">Sleep quality</label>
                        <input type="text" class="form-control" id="sleep_quality" name="sleep_quality" value="5">
                       
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="bedtime_routine">Bedtime routine</label>
                        <input type="text" class="form-control" id="bedtime_routine" name="bedtime_routine" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="daytime_naps">Daytime naps</label>
                        <input type="text" class="form-control" id="daytime_naps" name="daytime_naps" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="breathing_difficulties">Snoring or breathing difficulties</label>
                        <input type="text" class="form-control" id="breathing_difficulties" name="breathing_difficulties" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="restlessness_sleep">Restlessness during sleep</label>
                        <input type="text" class="form-control" id="restlessness_sleep" name="restlessness_sleep" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sleep_environment">Sleep environment (noise, light, etc.)</label>
                        <input type="text" class="form-control" id="sleep_environment" name="sleep_environment" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sleep_related_behaviors">Sleep-related behaviors (sleepwalking, teeth grinding, etc.)</label>
                        <input type="text" class="form-control" id="sleep_related_behaviors" name="sleep_related_behaviors" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="medical_conditions_affecting">Medical conditions affecting sleep</label>
                        <input type="text" class="form-control" id="medical_conditions_affecting" name="medical_conditions_affecting" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="medications_impacting_sleep">Medications impacting sleep</label>
                        <input type="text" class="form-control" id="medications_impacting_sleep" name="medications_impacting_sleep" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="enuresis">Enuresis</label>
                        <input type="text" class="form-control" id="enuresis" name="enuresis" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="immunization_history">Immunization history</label>
                        <input type="text" class="form-control" id="immunization_history" name="immunization_history" value="test">
                    </div>
                </div>


               
            </div>

            
            <h3>Nutrition History</h3>
            <div class="form-row">
                
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="breakfast">Breakfast if yes</label>
                        <input type="text" class="form-control" id="breakfast" name="breakfast" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="roti_eat">How much roti did they eat?</label>
                        <input type="text" class="form-control" id="roti_eat" name="roti_eat" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lunch">Lunch</label>
                        <input type="text" class="form-control" id="lunch" name="lunch" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="skip_meal">Skip meals</label>
                        <input type="text" class="form-control" id="skip_meal" name="skip_meal" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="meal_preference">Meal preferences especially dislikes</label>
                        <input type="text" class="form-control" id="meal_preference" name="meal_preference" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="food_allergies">Food allergies</label>
                        <input type="text" class="form-control" id="food_allergies" name="food_allergies" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dietary_restrictions">Dietary restrictions</label>
                        <input type="text" class="form-control" id="dietary_restrictions" name="dietary_restrictions" value="test">
                    </div>
                </div>

                
               
            </div>


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
                        <input type="text" class="form-control" id="onset" name="onset" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="severity">Severity</label>
                        <input type="text" class="form-control" id="severity" name="severity" value="2">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="location">location</label>
                        <input type="text" class="form-control" id="location" name="location" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="palpitations">Palpitations</label>
                        <input type="text" class="form-control" id="palpitations" name="palpitations" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fainting_syncope">Fainting/syncope</label>
                        <input type="text" class="form-control" id="fainting_syncope" name="fainting_syncope" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="cyanosis">Cyanosis</label>
                        <input type="text" class="form-control" id="cyanosis" name="cyanosis" value="test">
                    </div>
                </div>
                <h5 class="w-100">Sob</h5>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_exertion">on exertion</label>
                        <input type="text" class="form-control" id="on_exertion" name="on_exertion" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_rest">on rest</label>
                        <input type="text" class="form-control" id="on_rest" name="on_rest" value="test">
                    </div>
                </div>
                <h5 class="w-100">Respiratory System</h5>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="nasal_patency">Nasal patency</label>
                        <input type="text" class="form-control" id="nasal_patency" name="nasal_patency" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="clubbing">Clubbing</label>
                        <input type="text" class="form-control" id="clubbing" name="clubbing" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="asthma">Asthma</label>
                        <input type="text" class="form-control" id="asthma" name="asthma" value="test">
                    </div>
                </div>
            </div>

            <h3>Upper Resp</h3>
            <div class="form-row">

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sore_throat">Sore throat</label>
                        <input type="text" class="form-control" id="sore_throat" name="sore_throat" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="ear_ache">Ear Ache</label>
                        <input type="text" class="form-control" id="ear_ache" name="ear_ache" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="ear_discharge">Ear discharge</label>
                        <input type="text" class="form-control" id="ear_discharge" name="ear_discharge" value="White">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="runny_nose">Runny nose</label>
                        <input type="text" class="form-control" id="runny_nose" name="runny_nose" value="test">
                    </div>
                </div>
                <h6 class="w-100">Cough</h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sputum_color">Sputum color</label>
                        <input type="text" class="form-control" id="sputum_color" name="sputum_color" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="sputum_quantity">Sputum quantity</label>
                        <input type="text" class="form-control" id="sputum_quantity" name="sputum_quantity" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Brasky">Brasky</label>
                        <input type="text" class="form-control" id="Brasky" name="Brasky" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="whooping">Whooping</label>
                        <input type="text" class="form-control" id="whooping" name="whooping" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="blood_in_sputum">Blood in sputum</label>
                        <input type="text" class="form-control" id="blood_in_sputum" name="blood_in_sputum" value="test">
                    </div>
                </div>

                <h4 class="w-100">
                    History of Pneumonia
                </h4>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="episode_per_month">Episodes per month</label>
                        <input type="text" class="form-control" id="episode_per_month" name="episode_per_month" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="hospitalization">Hospitalization</label>
                        <input type="text" class="form-control" id="hospitalization" name="hospitalization" value="test">
                    </div>
                </div>
            </div>

            <h3>Lower Respiratory tract infections</h3>
            <div class="form-row">

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_sputum_color">Sputum color</label>
                        <input type="text" class="form-control" id="lower_sputum_color" name="lower_sputum_color" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_speutum_quantitiy">Sputum quantity</label>
                        <input type="text" class="form-control" id="lower_speutum_quantitiy" name="lower_speutum_quantitiy" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_brasky">Brasky</label>
                        <input type="text" class="form-control" id="lower_brasky" name="lower_brasky" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_whooping">Whooping</label>
                        <input type="text" class="form-control" id="lower_whooping" name="lower_whooping" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="lower_blood_in_sputum">Blood in sputum</label>
                        <input type="text" class="form-control" id="lower_blood_in_sputum" name="lower_blood_in_sputum" value="test">
                    </div>
                </div>

                <h5 class="w-100">Sob</h5>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_exertion_mild">On Exertion Mild</label>
                        <input type="text" class="form-control" id="on_exertion_mild" name="on_exertion_mild" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_exertion_moderate">On Exertion Moderate</label>
                        <input type="text" class="form-control" id="on_exertion_moderate" name="on_exertion_moderate" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="on_exertion_severe">On Exertion Severe</label>
                        <input type="text" class="form-control" id="on_exertion_severe" name="on_exertion_severe" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="wheezing">Wheezing</label>
                        <input type="text" class="form-control" id="wheezing" name="wheezing" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="crackles">Crackles</label>
                        <input type="text" class="form-control" id="crackles" name="crackles" value="test">
                    </div>
                </div>

                <h5 class="w-100">History of Infections</h5>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="infection_episodes_per_month">Episodes per month</label>
                        <input type="text" class="form-control" id="infection_episodes_per_month" name="infection_episodes_per_month" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="hospitalisation">Hospitalisation</label>
                        <input type="text" class="form-control" id="hospitalisation" name="hospitalisation" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="gastrointestinal_system">Gastrointestinal System</label>
                        <input type="text" class="form-control" id="gastrointestinal_system" name="gastrointestinal_system" value="GERD">
                        
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="endocrine_system">Endocrine System</label>
                        <input type="text" class="form-control" id="endocrine_system" name="endocrine_system" value="Diabetes Mellitus">
                        
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="renal_system">Renal System</label>
                        <input type="text" class="form-control" id="renal_system" name="renal_system" value="Kidney Stones">
                        
                    </div>
                </div>

                <div class="form-group col-md-6" id="renal_kidney">
                    <div class="form-group">
                        <label for="kidney_stones_case">Kidney Stones: known case</label>
                        <input type="text" class="form-control" id="kidney_stones_case" name="kidney_stones_case" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="back_pain">
                    <div class="form-group">
                        <label for="back_pain_site">Back pain :site</label>
                        <input type="text" class="form-control" id="back_pain_site" name="back_pain_site" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="urinary_episodes">
                    <div class="form-group">
                        <label for="urinary_tract">Urinary Tract Infections:no.of episodes in a year</label>
                        <input type="text" class="form-control" id="urinary_tract" name="urinary_tract" value="test">
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="neurological_system">Neurological System</label>
                        <input type="text" class="form-control" id="neurological_system" name="neurological_system" value="Migraines">
                        
                    </div>
                </div>

                <div class="form-group col-md-6" id="neuro_falls">
                    <div class="form-group">
                        <label for="neuro_falls_number">Falls</label>
                        <input type="number" class="form-control" id="neuro_falls_number" name="neuro_falls_number" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="neuro_syncope">
                    <div class="form-group">
                        <label for="Syncope">Syncope</label>
                        <input type="text" class="form-control" id="Syncope" name="Syncope" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="musculoskeletal_system">Musculoskeletal System</label>
                        <input type="text" class="form-control" id="musculoskeletal_system" name="musculoskeletal_system" value="Bone pain">
                        
                    </div>
                </div>

                <div class="form-group col-md-6" id="muscu_body_pain">
                    <div class="form-group">
                        <label for="muscu_body_pain_specify">Bone pain: Specify</label>
                        <input type="number" class="form-control" id="muscu_body_pain_specify" name="kidney_stones_case" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="hematologic_system">Hematologic System</label>
                        <input type="text" class="form-control" id="hematologic_system" name="hematologic_system" value="Anemia">
                       
                    </div>
                </div>
            </div>

            <h3>SKIN DISEASE</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="rashes">Rashes</label>
                        <input type="text" class="form-control" id="rashes" name="rashes" value="Macular">
                        
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="onset_of_rashes">Onset of rashes</label>
                        <input type="text" class="form-control" id="onset_of_rashes" name="onset_of_rashes" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="rashes_site">Site</label>
                        <input type="text" class="form-control" id="rashes_site" name="rashes_site" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="started_from">Started From</label>
                        <input type="text" class="form-control" id="started_from" name="started_from" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="itching">Itching</label>
                        <input type="text" class="form-control" id="itching" name="itching" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="rashes_fever">Fever</label>
                        <input type="text" class="form-control" id="rashes_fever" name="rashes_fever" value="onset">
                        
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="coryza">Coryza</label>
                        <input type="text" class="form-control" id="coryza" name="coryza" value="test">
                    </div>
                </div>
            </div>

            <h3>Chief Complaint</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="chief_complaint">Chief Complaint</label>
                        <input type="text" class="form-control" id="chief_complaint" name="chief_complaint" value="Dermatitis">
                        
                    </div>
                </div>

                <div class="form-group col-md-6" id="chef_comlaint_div">
                    <div class="form-group">
                        <label for="chef_comlaint_specify">Specify</label>
                        <input type="text" class="form-control" id="chef_comlaint_specify" name="chef_comlaint_specify" value="test">
                    </div>
                </div>
                <h6 class="w-100">
                    Past Medical History
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="previous_skin_conditions">Previous skin conditions or diseases</label>
                        <input type="text" class="form-control" id="previous_skin_conditions" name="previous_skin_conditions" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="skincare_products">Allergies or sensitivities to medications or skincare products</label>
                        <input type="text" class="form-control" id="skincare_products" name="skincare_products" value="test">
                    </div>
                </div>

                <h6 class="w-100">
                    Family History
                </h6>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="family_skin_disease">Family history of skin diseases (specify if known)</label>
                        <input type="text" class="form-control" id="family_skin_disease" name="family_skin_disease" value="test">
                    </div>
                </div>

                <h6 class="w-100">
                    Fungal Infections:ring like lesion ,white lesion ,itching then suspect fungal infections
                </h6>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fungal_infections_type">Type</label>
                        <input type="text" class="form-control" id="fungal_infections_type" name="fungal_infections_type" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fungal_infections_duration">Duration  (days/weeks/months/years)</label>
                        <input type="text" class="form-control" id="fungal_infections_duration" name="fungal_infections_duration" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fungal_previous_treatments">Previous treatments and efficacy</label>
                        <input type="text" class="form-control" id="fungal_previous_treatments" name="fungal_previous_treatments" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="fungal_infections_recurrence">Recurrence or spread</label>
                        <input type="text" class="form-control" id="fungal_infections_recurrence" name="fungal_infections_recurrence" value="Yes">
                        
                    </div>
                </div>
                <h6 class="w-100">
                    Dermatitis
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dermatitis_type">Type: _irritant or contact or atopic</label>
                        <input type="text" class="form-control" id="dermatitis_type" name="dermatitis_type" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dermatitis_triggers">Triggers or aggravating factors</label>
                        <input type="text" class="form-control" id="dermatitis_triggers" name="dermatitis_triggers" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dermatitis_symptoms">Symptoms</label>
                        <input type="text" class="form-control" id="dermatitis_symptoms" name="dermatitis_symptoms" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="dermatitis_previous_treatments">Previous treatments and response</label>
                        <input type="text" class="form-control" id="dermatitis_previous_treatments" name="dermatitis_previous_treatments" value="test">
                    </div>
                </div>
                <h6 class="w-100">
                    Scabies:if severe itching with linear burrows
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="scabies_history">History of exposure</label>
                        <input type="text" class="form-control" id="scabies_history" name="scabies_history" value="Yes">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="scabies_symptoms">Symptoms</label>
                        <input type="text" class="form-control" id="scabies_symptoms" name="scabies_symptoms" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="scabies_previous_treatments">Previous treatments and response</label>
                        <input type="text" class="form-control" id="scabies_previous_treatments" name="scabies_previous_treatments" value="test">
                    </div>
                </div>
                <h6 class="w-100">
                    Herpes: if painful lesion especially around corner of mouth
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_type">Type: (oral/genital)</label>
                        <input type="text" class="form-control" id="herpes_type" name="herpes_type" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_triggers">Triggers for outbreaks</label>
                        <input type="text" class="form-control" id="herpes_triggers" name="herpes_triggers" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_location">Location</label>
                        <input type="text" class="form-control" id="herpes_location" name="herpes_location" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_pain">pain</label>
                        <input type="text" class="form-control" id="herpes_pain" name="herpes_pain" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_symptoms">Symptoms during outbreaks</label>
                        <input type="text" class="form-control" id="herpes_symptoms" name="herpes_symptoms" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_previous_treatments">Previous antiviral treatments and effectiveness</label>
                        <input type="text" class="form-control" id="herpes_previous_treatments" name="herpes_previous_treatments" value="test">
                    </div>
                </div>
                <h6 class="w-100">
                    Current Medications
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="herpes_current_medication">Any current medications, including topical treatments for skin conditions.</label>
                        <input type="text" class="form-control" id="herpes_current_medication" name="herpes_current_medication" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="current_additional_notes">Additional Notes</label>
                        <input type="text" class="form-control" id="current_additional_notes" name="current_additional_notes" value="test">
                    </div>
                </div>

                <h6 class="w-100">
                    Menstural History
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="age_first_menstrual">Age of first menstrual period (menarche)</label>
                        <input type="text" class="form-control" id="age_first_menstrual" name="age_first_menstrual" value="<10 years old">
                       
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="regularity_menstrual">Regularity of menstrual cycles</label>
                        <input type="text" class="form-control" id="regularity_menstrual" name="regularity_menstrual" value="Regular (occurring every 21-35 days)">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="duration_menstrual">Duration of menstrual flow</label>
                        <input type="text" class="form-control" id="duration_menstrual" name="duration_menstrual" value="1-3 days">
                        
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="amount_menstrual_bleeding">Amount of menstrual bleeding</label>
                        <input type="text" class="form-control" id="amount_menstrual_bleeding" name="amount_menstrual_bleeding" value="Light (requires only a few pads per day)">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="symptoms_menstruation">Symptoms experienced during menstruation</label>
                        <input type="text" class="form-control" id="symptoms_menstruation" name="symptoms_menstruation" value="Cramps">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="use_menstrual_products">Use of menstrual hygiene products</label>
                        <input type="text" class="form-control" id="use_menstrual_products" name="use_menstrual_products" value="Pads">
                        
                    </div>
                </div>
                <div class="form-group col-md-6" id="use_menstrual_products_div">
                    <div class="form-group">
                        <label for="menstrual_products_specify">Please specify</label>
                        <input type="text" class="form-control" id="menstrual_products_specify" name="menstrual_products_specify" value="test">
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="history_menstrual_disorder">Any history of menstrual disorders or complications</label>
                        <input type="text" class="form-control" id="history_menstrual_disorder" name="history_menstrual_disorder" value="Dysmenorrhea (painful periods)">
                      
                    </div>
                </div>
                <div class="form-group col-md-6" id="dysmenorrhea_div">
                    <div class="form-group">
                        <label for="dysmenorrhea_onset">Dysmenorrhea (painful periods):onset</label>
                        <input type="text" class="form-control" id="dysmenorrhea_onset" name="dysmenorrhea_onset" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="amenorrhea_div">
                    <div class="form-group">
                        <label for="amenorrhea_duration">Amenorrhea (absence of periods):duration</label>
                        <input type="text" class="form-control" id="amenorrhea_duration" name="amenorrhea_duration" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="menorrhagia_duration_div">
                    <div class="form-group">
                        <label for="menorrhagia_duration">Menorrhagia (excessive menstrual bleeding) duration</label>
                        <input type="text" class="form-control" id="menorrhagia_duration" name="menorrhagia_duration" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="menorrhagia_severity_div">
                    <div class="form-group">
                        <label for="menorrhagia_severity">Menorrhagia (excessive menstrual bleeding) severity</label>
                        <input type="text" class="form-control" id="menorrhagia_severity" name="menorrhagia_severity" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="oligomenorrhea_duration_div">
                    <div class="form-group">
                        <label for="oligomenorrhea_duration">Oligomenorrhea (infrequent periods):duration</label>
                        <input type="text" class="form-control" id="oligomenorrhea_duration" name="oligomenorrhea_duration" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6" id="menstrual_disorder_other_div">
                    <div class="form-group">
                        <label for="menstrual_disorder_other">Please specify</label>
                        <input type="text" class="form-control" id="menstrual_disorder_other" name="menstrual_disorder_other" value="test">
                    </div>
                </div>
            </div>

  
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="any_previous_medication_menstruation">Any previous medical treatments or interventions related to menstruation</label>
                        <input type="text" class="form-control" id="any_previous_medication_menstruation" name="any_previous_medication_menstruation" value="Pain medications">
                        
                    </div>
                </div>

                <div class="form-group col-md-6" id="medication_menstruation_other_div">
                    <div class="form-group">
                        <label for="medication_menstruation_other">Please specify</label>
                        <input type="text" class="form-control" id="medication_menstruation_other" name="medication_menstruation_other" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="additional_concerns">Additional comments or concerns</label>
                        <input type="text" class="form-control" id="additional_concerns" name="additional_concerns" value="test">
                    </div>
                </div>
                <h6 class="w-100">
                    Past Medical Conditions
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="longterm_health">long-term health conditions</label>
                        <input type="text" class="form-control" id="longterm_health" name="longterm_health" value="Asthma">
                     
                    </div>
                </div>

                <div class="form-group col-md-6" id="longterm_health_other_div">
                    <div class="form-group">
                        <label for="longterm_health_other">Please specify</label>
                        <input type="text" class="form-control" id="longterm_health_other" name="longterm_health_other" value="test">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="accident_or_injuries">Accident or Injuries</label>
                        <input type="text" class="form-control" id="accident_or_injuries" name="accident_or_injuries" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="surgeries">Surgeries</label>
                        <input type="text" class="form-control" id="surgeries" name="surgeries" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="any_current_medications">Any Current medications</label>
                        <input type="text" class="form-control" id="any_current_medications" name="any_current_medications" value="test">
                    </div>
                </div>
                <h6 class="w-100">
                    Allergies
                </h6>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_medications">Medications</label>
                        <input type="text" class="form-control" id="alergies_medications" name="alergies_medications" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_chemicals">Chemicals</label>
                        <input type="text" class="form-control" id="alergies_chemicals" name="alergies_chemicals" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_pollen">Pollen/Furs</label>
                        <input type="text" class="form-control" id="alergies_pollen" name="alergies_pollen" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_food">Food</label>
                        <input type="text" class="form-control" id="alergies_food" name="alergies_food" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_metals">Metals</label>
                        <input type="text" class="form-control" id="alergies_metals" name="alergies_metals" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="alergies_other">Other</label>
                        <input type="text" class="form-control" id="alergies_other" name="alergies_other" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="family_history_past">Family History</label>
                        <input type="text" class="form-control" id="family_history_past" name="family_history_past" value="heart disease">
                      
                    </div>
                </div>
            </div>

            <h3>SOCIOECONOMIC</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="water">Water</label>
                        <input type="text" class="form-control" id="water" name="water" value="Tap">
                       
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="milk">Milk</label>
                        <input type="text" class="form-control" id="milk" name="milk" value="Boiled (unpasturized milk)">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="rooms">Rooms</label>
                        <input type="text" class="form-control" id="rooms" name="rooms" value="1">
                     
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="infectious_disease">Infectious disease and any sick people at home</label>
                        <input type="text" class="form-control" id="infectious_disease" name="infectious_disease" value="Yes">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="father_occupation">Father Occupation</label>
                        <input type="text" class="form-control" id="father_occupation" name="father_occupation" value="Office worker">
                        
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="ddx">DDX</label>
                        <input type="text" class="form-control" id="ddx" name="ddx" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="note_to_principal">Note to principal</label>
                        <input type="text" class="form-control" id="note_to_principal" name="note_to_principal" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="note_to_parent">Note to parent</label>
                        <input type="text" class="form-control" id="note_to_parent" name="note_to_parent" value="test">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="attach_picture">Attach Picture</label>
                        <input type="file" class="form-control" id="attach_picture" name="attach_picture" value="test">
                    </div>
                </div>
                
            </div>

        
    </form>

</div>

@endsection