<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FromSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $form_datail = [
            'forms' => ['name' => 'Form 1', 'form_steps' => [
                // Step 1
                ['order' => 1,'name','Bio Data','form_step_fields' => [
                        ['type' => 'text', 'name' => 'name', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Name', 'form_step_field_options' => null ],
                        ['type' => 'text', 'name' => 'guardian_name', 'label' => 'Guardian Name', 'e_class' => 'form-control', 'e_id' => null, 'form_step_field_options' => null],
                        ['type' => 'select', 'name' => 'gender', 'label' => 'Gender', 'e_class' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                                ['text' => '', 'value' => ''],
                                ['text' => 'Male', 'value' => 'male'],
                                ['text' => 'Female', 'value' => 'female'],
                            ],
                        ],
                        ['type' => 'text', 'name' => 'age', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Age', 'form_step_field_options' => null ],
                        ['type' => 'text', 'name' => 'dob', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'DOB', 'form_step_field_options' => null ],
                        ['type' => 'text', 'name' => 'contact', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Emergency Contact Number', 'form_step_field_options' => null ],
                        ['type' => 'text', 'name' => 'gr_no', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'GR Number', 'form_step_field_options' => null ],
                        ['type' => 'text', 'name' => 'medical_condition', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Any Known Medical Condition', 'form_step_field_options' => null ],
                        ['type' => 'text', 'name' => 'address', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Address', 'form_step_field_options' => null ],
                        ['type' => 'select', 'name' => 'blood_group', 'label' => 'Blood Group', 'e_class' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                                ['text' => '', 'value' => ''],
                                ['text' => 'A+', 'value' => 'A+'],
                                ['text' => 'A-', 'value' => 'A-'],
                                ['text' => 'B+', 'value' => 'B+'],
                                ['text' => 'B+', 'value' => 'B-'],
                                ['text' => 'O+', 'value' => 'O+'],
                                ['text' => 'O+', 'value' => 'O-'],
                                ['text' => 'AB+', 'value' => 'AB+'],
                                ['text' => 'AB+', 'value' => 'AB+'],        
                            ],
                        ],
                        ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],
                    ],
                ],

                    // Step 2

                    ['order' => 2,'name','Vitals/BMI','form_step_fields' => [
                        ['type' => 'number', 'name' => 'height', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Height', 'form_step_field_options' => null ],
                        ['type' => 'number', 'name' => 'weight', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Weight', 'form_step_field_options' => null ],                  
                        ['type' => 'number', 'name' => 'bmi', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'BMI', 'form_step_field_options' => null ],                  
                        ['type' => 'number', 'name' => 'body_temperature', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Body Temperature', 'form_step_field_options' => null ],
                        ['type' => 'select', 'name' => '', 'label' => '', 'e_class' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                            ['text' => 'Select Unit', 'value' => ''],
                            ['text' => 'f (fahrenheit)', 'value' => 'f (fahrenheit)'],
                            ['text' => 'c (celsius)', 'value' => 'c (celsius)'],
                        ],
                    ],                  
                        ['type' => 'text', 'name' => 'pulse', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Pulse', 'form_step_field_options' => null ],                  
                        ['type' => 'text', 'name' => 'blood_pressure', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Blood Pressure', 'form_step_field_options' => null ],    
                        ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],              
                    ],
                ],


                // Step 3

                ['order' => 3,'name','General Appearance','form_step_fields' => [
                    ['type' => 'select', 'name' => '', 'label' => '', 'Normal Posture/Gait' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                        ['text' => 'Select', 'value' => ''],
                        ['text' => 'Yes', 'value' => 'Yes'],
                        ['text' => 'No', 'value' => 'No'],
                    ],
                ],      
                    ['type' => 'select', 'name' => '', 'label' => '', 'Mental Status' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                        ['text' => 'Select', 'value' => ''],
                        ['text' => 'Alert', 'value' => 'Alert'],
                        ['text' => 'Lethargic', 'value' => 'Lethargic'],
                    ],
                ],  
                    
                    ['type' => 'select', 'name' => '', 'label' => '', 'Look For Jaundice' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                        ['text' => 'Select', 'value' => ''],
                        ['text' => 'Yes', 'value' => 'Yes'],
                        ['text' => 'No', 'value' => 'No'],
                    ],
                ],      
                    ['type' => 'select', 'name' => '', 'label' => '', 'Look For Anemia' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                        ['text' => 'Select', 'value' => ''],
                        ['text' => 'Yes', 'value' => 'Yes'],
                        ['text' => 'No', 'value' => 'No'],
                    ],
                ],      
                    ['type' => 'select', 'name' => '', 'label' => '', 'Look For Clubbing' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                        ['text' => 'Select', 'value' => ''],
                        ['text' => 'Yes', 'value' => 'Yes'],
                        ['text' => 'No', 'value' => 'No'],
                    ],
                ],      
                    ['type' => 'select', 'name' => '', 'label' => '', 'Look for Cyanosis' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                        ['text' => 'Select', 'value' => ''],
                        ['text' => 'Yes', 'value' => 'Yes'],
                        ['text' => 'No', 'value' => 'No'],
                    ],
                ],      
                    ['type' => 'select', 'name' => '', 'label' => '', 'Skin' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                        ['text' => 'Select', 'value' => ''],
                        ['text' => 'Rash', 'value' => 'Rash'],
                        ['text' => 'Allergy', 'value' => 'Allergy'],
                        ['text' => 'Lesion', 'value' => 'Lesion'],
                        ['text' => 'Normal', 'value' => 'Normal'],
                    ],
                ],      
                    ['type' => 'select', 'name' => '', 'label' => '', 'Breath' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                        ['text' => 'Select', 'value' => ''],
                        ['text' => 'Bad Breath', 'value' => 'Bad Breath'],
                        ['text' => 'Normal', 'value' => 'Normal'],
                    ],
                ],   
                    ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],             
                ],
            ],

            //Step 4

                ['order' => 4,'name','Psychological','form_step_fields' => [
                    ['type' => 'text', 'name' => 'How_Do_You_Feel_Most_of_the_Time?', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'How Do You Feel Most of the Time?', 'form_step_field_options' => null ],
                    ['type' => 'text', 'name' => 'Do_You_Have_Any_Friends_at_School?', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Do You Have Any Friends at School?', 'form_step_field_options' => null ],                  
                    ['type' => 'text', 'name' => 'Do_You_Feel_Safe_and_Supported_at_Home?', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Do You Feel Safe and Supported at Home?', 'form_step_field_options' => null ],                  
                    ['type' => 'text', 'name' => 'Do_You_Ever_Feel_Lonely_or_Left_Out?', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Do You Ever Feel Lonely or Left Out?', 'form_step_field_options' => null ],             
                    ['type' => 'text', 'name' => 'Is_There_Anything_You_Want_to_Talk_About_or_Share_Today?', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Is There Anything You Want to Talk About or Share Today?', 'form_step_field_options' => null ],                  
                    ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],              
                ],
            ],

            //Step 5
                    ['order' => 5,'name','Inspect Hygiene','form_step_fields' => [
                        ['type' => 'select', 'name' => '', 'label' => '', 'Nails' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                            ['text' => 'Select', 'value' => ''],
                            ['text' => 'Clean', 'value' => 'Clean'],
                            ['text' => 'Dirty', 'value' => 'Dirty'],
                        ],
                    ],
                        ['type' => 'select', 'name' => '', 'label' => '', 'Uniform or Shoes' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                            ['text' => 'Select', 'value' => ''],
                            ['text' => 'Tidy', 'value' => 'Tidy'],
                            ['text' => 'Untidy', 'value' => 'Untidy'],
                        ],
                    ],
                        ['type' => 'select', 'name' => '', 'label' => '', 'Discuss hygiene routines and practices' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                            ['text' => 'Select', 'value' => ''],
                            ['text' => 'Well-Aware', 'value' => 'Well-Aware'],
                            ['text' => 'Not-Aware', 'value' => 'Not-Aware'],
                            ['text' => 'Has been Counseled', 'value' => 'Has been Counseled'],
                        ],
                    ],
                        ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ], 
                ],
            ],

            //Step 6

                    ['order' => 6,'name','Head and Neck examination','form_step_fields' => [
                        ['type' => 'select', 'name' => '', 'label' => '', 'Hair and Scalp' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                            ['text' => 'Select', 'value' => ''],
                            ['text' => 'Straight', 'value' => 'Straight'],
                            ['text' => 'Wavy', 'value' =>  'Wavy'],
                            ['text' => 'Curly', 'value' => 'Curly'],
                            ['text' => 'Kinky', 'value' => 'Kinky'],
                        ],
                    ],
                        ['type' => 'select', 'name' => '', 'label' => '', 'Hair distribution' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                            ['text' => 'Select', 'value' => ''],
                            ['text' => 'Even', 'value' => 'Even'],
                            ['text' => 'Distribution', 'value' =>  'Distribution'],
                            ['text' => 'Patchiness', 'value' => 'Patchiness'],
                        ],
                    ],

                        ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ], 
                ],
            ],

            //Step 7


            ['order' => 7,'name','Eye:','form_step_fields' => [
                ['type' => 'text', 'name' => 'Visual_acuity_using_Snellen’s_chart?', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Visual acuity using Snellen’s chart', 'form_step_field_options' => null ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Normal ocular alignment?' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ], 
                ['type' => 'select', 'name' => '', 'label' => '', 'Normal eye inspection' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ], 
                ['type' => 'select', 'name' => '', 'label' => '', 'Normal Color vision' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ], 
                ['type' => 'select', 'name' => '', 'label' => '', 'Nystagmus' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ], 
                ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],    
                        
                ],
            ],

            //Step 8

            ['order' => 8,'name','Ears:','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', 'Normal ears shape and position' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ], 
                ['type' => 'select', 'name' => '', 'label' => '', 'Ear examination' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Ear Wax', 'value' => 'Ear Wax'],
                    ['text' => 'Canal Infection', 'value' =>  'Canal Infection'],
                    ['text' => 'None', 'value' =>  'None'],
                ],
            ], 
                ['type' => 'select', 'name' => '', 'label' => '', 'Conclusion of hearing test with Rinner and Weber' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'right ear conductive hearing loss', 'value' => 'right ear conductive hearing loss'],
                    ['text' => 'left ear conductive hearing loss', 'value' =>  'left ear conductive hearing loss'],
                    ['text' => 'right sensorineural hearing loss', 'value' =>  'right sensorineural hearing loss'],
                    ['text' => 'left sensorineural hearing loss', 'value' =>  'left sensorineural hearing loss'],
                ],
            ], 
            ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],  

                ],
            ],  

            //Step 9
                
            ['order' => 9,'name','Nose:','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', 'External inasal examinaton' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Deformities', 'value' => 'Deformities'],
                    ['text' => 'Swelling ', 'value' =>  'Swelling'],
                    ['text' => 'Redness ', 'value' =>  'Redness'],
                    ['text' => 'Lesions ', 'value' =>  'Lesions'],
                    ['text' => 'Of Nasal Discharge', 'value' =>  'Of_Nasal_Discharge'],
                    ['text' => 'Crusting Normal', 'value' =>  'Crusting_Normal'],
                    ['text' => 'Normal', 'value' =>  'Normal '],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', "perform a nasal patency test [which involves gently closing one nostril at a time to assess the patient's ability to breathe through each nostril]" => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Narrowing', 'value' => 'Narrowing'],
                    ['text' => 'Obstruction  ', 'value' =>  'Obstruction '],
                    ['text' => 'DNS  ', 'value' =>  'DNS '],
                    ['text' => 'Lesions ', 'value' =>  'Lesions'],
                    ['text' => 'Normal', 'value' =>  'Normal '],
                ],
            ],
                    ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],  

                ],
            ],  
                
            //Step 10

            ['order' => 10,'name','Oral','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', 'Assess gingiva' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Infection', 'value' => 'Infection'],
                    ['text' => 'Bleed', 'value' =>  'Bleed'],
                    ['text' => 'Normal', 'value' =>  'Normal '],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Are there dental caries' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ],
                    ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],
                ],
            ],

            //Step 11

            ['order' => 11,'name','Throat','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', 'Check gag reflex' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Positive', 'value' => 'Positive'],
                    ['text' => 'Negative', 'value' =>  'Negative'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Examine tonsils' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Normal', 'value' => 'Normal'],
                    ['text' => 'Tonsillitis', 'value' =>  'Tonsillitis'],
                    ['text' => 'Tonsillectomy done', 'value' =>  'tonsillectomy_done'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Normal Speech development' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Any Neck Swelling' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Examine Lymph Node' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Normal', 'value' => 'Normal'],
                    ['text' => 'Abnormal', 'value' =>  'Abnormal'],
                ],
            ],
                ['type' => 'text', 'name' => 'Specify_Any_Neck_Swelling?', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Specify Any Neck Swelling', 'form_step_field_options' => null ],
                ['type' => 'text', 'name' => 'Specify_Lymph_Node', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Specify Lymph Node', 'form_step_field_options' => null ],
                ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],

                ],
            ],

            //Step 12

            ['order' => 12,'name','Chest','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', 'Any visible chest deformity' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Lung Auscultation' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Ronchi', 'value' => 'Ronchi'],
                    ['text' => 'Wheezing', 'value' =>  'Wheezing'],
                    ['text' => 'Vesicular Breathing', 'value' =>  'Vesicular_Breathing'],
                    ['text' => 'Vesicular Diminished Breath Sound(specify)', 'value' =>  'Vesicular Diminished Breath Sound(specify)'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Cardiac Auscultation' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Normal S1/S2', 'value' => 'Normal_S1/S2'],
                    ['text' => 'Murmur', 'value' =>  'Murmur'],
                ],
            ],
                ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],

                
                ],
            ],

            //Step 13

            ['order' => 13,'name','Chest','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', "Did you observe any distension, scars, or masses on the child's abdomen?" => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Distension', 'value' => 'Distension'],
                    ['text' => 'Scar', 'value' =>  'Scar'],
                    ['text' => 'Mass', 'value' =>  'Mass'],
                    ['text' => 'Normal', 'value' =>  'Normal'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Any history of abdominal pain' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ],
                ['type' => 'text', 'name' => 'Specify_Abdominal_pain?', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Specify Abdominal Pain?', 'form_step_field_options' => null ],
                ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],

                ],
            ],

            //Step 14

            ['order' => 14,'name','Musculoskeletal','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', "Did you observe any limitations in the child's range of joint motion during your examination?" => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ],
                ['type' => 'text', 'name' => 'range_of_joint_motion', 'e_class' => 'form-control', 'e_id' => null, 'label' => "Specify limitations in the child's range of joint motion during your examination?", 'form_step_field_options' => null ],
                ['type' => 'select', 'name' => '', 'label' => '', "Spinal curvature assessment (tick positive finding)" => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Uneven Shoulders', 'value' => 'Uneven Shoulders'],
                    ['text' => 'Shoulder Blade', 'value' =>  'Shoulder Blade'],
                    ['text' => 'Uneven Waist', 'value' =>  'Uneven Waist'],
                    ['text' => 'Hips', 'value' =>  'Hips'],
                    ['text' => 'Normal', 'value' =>  'Normal'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'side-to-side curvature in the spine resembling' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'S Shape', 'value' => 'S Shape'],
                    ['text' => 'C Shape', 'value' =>  'C Shape'],
                    ['text' => 'Normal', 'value' =>  'Normal'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Adams forward bend test' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Positive', 'value' => 'Positive'],
                    ['text' => 'Negative', 'value' =>  'Negative'],
                ],
            ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Any foot or toe abnormalities' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Normal', 'value' => 'Normal'],
                    ['text' => 'Flat Feet', 'value' =>  'Flat Feet'],
                    ['text' => 'Varus', 'value' =>  'Varus'],
                    ['text' => 'Valgus', 'value' =>  'Valgus'],
                    ['text' => 'High Arch', 'value' =>  'High Arch'],
                    ['text' => 'Ammer Toe', 'value' =>  'Ammer Toe'],
                    ['text' => 'Bunion', 'value' =>  'Bunion'],
                ],
            ],
                ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],

                ],
            ],

            //Step 15

            ['order' => 15,'name','Vaccination:','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', 'Have EPI immunization card?' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ], 
            ['type' => 'text', 'name' => 'Reason of not being vaccinated', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Reason of not being vaccinated', 'form_step_field_options' => null ],
            ['type' => 'checkbox', 'name' => '[]', 'label' => '', 'Mark all the vaccinations that are completed' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                ['text' => 'BCG 1 dose', 'value' => 'BCG 1 dose'],
                ['text' => 'OPV 4 dose', 'value' => 'OPV 4 dose'],
                ['text' => 'Pentavalent vaccine (DTP+Hep B + Hib) 3 dose', 'value' =>  'Pentavalent vaccine (DTP+Hep B + Hib) 3 dose'],
                ['text' => 'Rota: 2 doses', 'value' =>  'Rota: 2 doses'],
                ['text' => 'Measles 2 dose', 'value' =>  'Measles 2 dose'],
                ['text' => 'Never had any vaccination', 'value' =>  'Never had any vaccination'],
                ],
            ],

                ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],
            ],
                ],

            //Step 16

            ['order' => 16,'name','Lead exposure','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', 'Do you Frequently put things in his/her mouth such as toys, jewelry, or keys?' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ], 
                ['type' => 'select', 'name' => '', 'label' => '', 'Does your child eat non-food items(pica)?' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ], 
                ['type' => 'select', 'name' => '', 'label' => '', 'Do you frequently come in contact with an adult whose job involves exposure to lead?' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'house painting', 'value' => 'house_painting'],
                    ['text' => 'plumbing', 'value' =>  'plumbing'],
                    ['text' => 'renovation', 'value' =>  'renovation'],
                    ['text' => 'construction', 'value' =>  'construction'],
                    ['text' => 'auto repair', 'value' =>  'auto_repair'],
                    ['text' => 'welding', 'value' =>  'welding'],
                    ['text' => 'electronics repair', 'value' =>  'electronics_repair'],
                    ['text' => 'jewelry or pottery making', 'value' =>  'jewelry_or_pottery_making'],
                ],
            ], 
                ['type' => 'select', 'name' => '', 'label' => '', 'Do you frequently come in contact with an adult whose hobby involves exposure to lead?' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'making stained glass', 'value' => 'making_stained_glass'],
                    ['text' => 'pottery', 'value' =>  'pottery'],
                    ['text' => 'firearm making', 'value' =>  'firearm_making'],
                    ['text' => 'collecting lead', 'value' =>  'collecting_lead'],
                    ['text' => 'none of the above', 'value' =>  'none_of_the_above'],
                ],
            ], 
                ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],

            ],
        ],
            //Step 17

            ['order' => 17,'name','Miscellaneous:','form_step_fields' => [
                ['type' => 'select', 'name' => '', 'label' => '', 'Do you have any Allergies' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ], 
                ['type' => 'text', 'name' => 'Girls above 8 years old ask', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Girls above 8 years old ask', 'form_step_field_options' => null ],    
                ['type' => 'select', 'name' => '', 'label' => '', 'Inquire about urinary frequency, urgency, and any pain or discomfort during urination' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'No urinary issues reported', 'value' => 'No urinary issues reported'],
                    ['text' => 'Urinary frequency', 'value' => 'Urinary frequency'],
                    ['text' => 'Urinary urgency', 'value' =>  'Urinary urgency'],
                    ['text' => 'Pain or discomfort during urination', 'value' =>  'Pain or discomfort during urination'],
                    ['text' => 'Nocturnal enuresis', 'value' =>  'Nocturnal enuresis'],
                    ],
                ],
                ['type' => 'select', 'name' => '', 'label' => '', 'Any menstrual abnormality' => 'form-control', 'e_id' => null, 'form_step_field_options' => [
                    ['text' => 'Select', 'value' => ''],
                    ['text' => 'Yes', 'value' => 'Yes'],
                    ['text' => 'No', 'value' =>  'No'],
                ],
            ],
                ['type' => 'text', 'name' => 'Specify Menstrual Abnormality', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Specify Menstrual Abnormality', 'form_step_field_options' => null ],    
                ['type' => 'textarea', 'name' => 'comment', 'e_class' => 'form-control', 'e_id' => null, 'label' => 'Comment/Findings', 'form_step_field_options' => null ],

            

            
            ],
        ],
            ],
        ],
            ];
        }
    }
