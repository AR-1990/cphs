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

        .height::after {
            content: 'ft.inch';
        }

        .weight::after {
            content: 'kg(s)';
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

        input, select {
            height: 50px !important;
            border-radius: 8px !important;
            border: 1px solid rgba(0, 0, 0, .15) !important;
            background-color: transparent !important;
        }
        label {
            margin-top: 15px;
        }
    </style>


    
    <div class="container">
        <h1 class="mb-4 mt-5">School Edit Form</h1>


        @if (Session::has('error_message'))
        <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
            {{-- <strong>Error ! </strong> --}}
            {{ Session::get('error_message') }}.
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                data-bs-original-title="" title=""></button>
        </div>
    @endif

    @if (Session::has('success_message'))
        <div class="alert alert-success dark alert-dismissible fade show" role="alert">
            {{-- <strong>Success ! </strong> --}}
            {{ Session::get('success_message') }}.
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                data-bs-original-title="" title=""></button>
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

    
        <form action="{{route('edit_school')}}" method="POST" enctype="multipart/form-data">
             <!-- Step-one -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{$detail->id}}">
             <div class="step active ml-128pt" id="step1">
              
                <div class="form-row ">
                    <div class="form-group col-md-8">
                        <div class="form-group">
                            <label for="Name">School Name</label>
                            <input type="text" class="form-control" id="schoolname" name="school_name" required value="{{$detail->school_name}}">
                            <label for="GName">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required value="{{$detail->address}}">
                            <label for="Name">Area</label>
                            <input type="text" class="form-control" id="area" name="area" required value="{{$detail->area}}">
                            <label for="GName">School Representative</label>
                            <input type="text" class="form-control" id="school_representative" name="school_representative" required value="{{$detail->school_name}}">
                            <label for="Name">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required value="{{$detail->email}}">
                            
                            <h6 class="mt-3">HEALTH SCREENING CONDUCTED BY</h6>
                            <label for="health_screening_conducted_by_name">Name</label>
                            <input type="text" class="form-control" id="health_screening_conducted_by_name" name="health_screening_conducted_by_name" value="{{$detail->health_screening_conducted_by_name ?? ''}}">
                            <label for="health_screening_conducted_by_qualification">Qualification</label>
                            <input type="text" class="form-control" id="health_screening_conducted_by_qualification" name="health_screening_conducted_by_qualification" value="{{$detail->health_screening_conducted_by_qualification ?? ''}}" placeholder="e.g., MBBS, MRCP UK">
                            <label for="health_screening_conducted_by_designation">Designation</label>
                            <input type="text" class="form-control" id="health_screening_conducted_by_designation" name="health_screening_conducted_by_designation" value="{{$detail->health_screening_conducted_by_designation ?? ''}}">

                            <h6 class="mt-3">RECHECKED BY</h6>
                            <label for="rechecked_by_name">Name</label>
                            <input type="text" class="form-control" id="rechecked_by_name" name="rechecked_by_name" value="{{$detail->rechecked_by_name ?? ''}}">
                            <label for="rechecked_by_qualification">Qualification</label>
                            <input type="text" class="form-control" id="rechecked_by_qualification" name="rechecked_by_qualification" value="{{$detail->rechecked_by_qualification ?? ''}}">
                            <label for="rechecked_by_designation">Designation</label>
                            <input type="text" class="form-control" id="rechecked_by_designation" name="rechecked_by_designation" value="{{$detail->rechecked_by_designation ?? ''}}">

                            <h6 class="mt-3">PSYCHOLOGICAL SCREENING REVIEWED BY</h6>
                            <label for="psychological_screening_reviewed_by_name">Name</label>
                            <input type="text" class="form-control" id="psychological_screening_reviewed_by_name" name="psychological_screening_reviewed_by_name" value="{{$detail->psychological_screening_reviewed_by_name ?? ''}}">
                            <label for="psychological_screening_reviewed_by_qualification">Qualification</label>
                            <input type="text" class="form-control" id="psychological_screening_reviewed_by_qualification" name="psychological_screening_reviewed_by_qualification" value="{{$detail->psychological_screening_reviewed_by_qualification ?? ''}}">
                            <label for="psychological_screening_reviewed_by_designation">Designation</label>
                            <input type="text" class="form-control" id="psychological_screening_reviewed_by_designation" name="psychological_screening_reviewed_by_designation" value="{{$detail->psychological_screening_reviewed_by_designation ?? ''}}">

                            <h6 class="mt-3">NUTRITIONAL ASSESSMENT REVIEWED BY</h6>
                             <label for="nutritional_assessment_reviewed_by_name">Name</label>
                             <input type="text" class="form-control" id="nutritional_assessment_reviewed_by_name" name="nutritional_assessment_reviewed_by_name" value="{{$detail->nutritional_assessment_reviewed_by_name ?? ''}}">
                             <label for="nutritional_assessment_reviewed_by_qualification">Qualification</label>
                             <input type="text" class="form-control" id="nutritional_assessment_reviewed_by_qualification" name="nutritional_assessment_reviewed_by_qualification" value="{{$detail->nutritional_assessment_reviewed_by_qualification ?? ''}}">
                             <label for="nutritional_assessment_reviewed_by_designation">Designation</label>
                             <input type="text" class="form-control" id="nutritional_assessment_reviewed_by_designation" name="nutritional_assessment_reviewed_by_designation" value="{{$detail->nutritional_assessment_reviewed_by_designation ?? ''}}">

                             <h6 class="mt-3">School Logo</h6>
                             @if(!empty($detail->logo_path))
                                 <img src="{{ asset($detail->logo_path) }}" alt="School Logo" style="max-width: 150px; height: auto;" class="mb-2">
                             @endif
                             <label for="logo">Upload Logo (PNG/JPG)</label>
                             <input type="file" class="form-control" id="logo" name="logo" accept="image/png, image/jpeg">
                         </div>
                     </div>

                    <div class="form-group col-md-12">
                        <div class="form-group position-relative">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control" id="Password" name="Password" required>
                            <span class="toggle-password position-absolute">
                                <i class="fas fa-eye "></i>
                            </span>
                        </div>
                    </div>


              
             </div>
            <!-- Second Step -->

           
                <button type="submit" id="submit" name="submit" class="btn btn-primary" onclick="datapass()">Submit</button>
        
            </div>
        </form>
    
    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .position-relative {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 55% !important;
            cursor: pointer;
            z-index: 10;
            color: black;
            /* Black color for the eye icon */
        }

        .toggle-password i {
            font-size: 20px;
            /* Adjust size if needed */
        }

        .eye-with-cross {
            position: relative;
            display: inline-block;
        }

        .eye-with-cross::before,
        .eye-with-cross::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 2px;
            /* Thickness of the line */
            background-color: black;
            /* Color of the line */
            transform: translate(-50%, -50%);
        }

        .eye-with-cross::before {
            transform: translate(-50%, -50%) rotate(45deg);
            /* Rotate line to form a cross */
            width: 100%;
            /* Adjust width if necessary */
        }

        .eye-with-cross::after {
            transform: translate(-50%, -50%) rotate(-45deg);
            /* Rotate line to form a cross */
            width: 100%;
            /* Adjust width if necessary */
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.toggle-password').on('click', function() {
                const passwordField = $('#Password');
                const eyeIcon = $(this).find('i');

                console.log(passwordField.html());
                console.log(eyeIcon.html());
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                    eyeIcon.removeClass('eye-with-cross');
                } else {
                    passwordField.attr('type', 'password');
                    eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                    eyeIcon.addClass('eye-with-cross');
                }
            });
        });
    </script>


    {{-- <script>
         
            $(document).ready(function() {

                $('.nextStep').click(function() {
                    var currentStep = $(this).closest('.step');
                    var nextStep = currentStep.next('.step');
                    var checkboxes = $('.form-group input[type="checkbox"]');
                    var isChecked = false;

                    checkboxes.each(function() {
                        if ($(this).is(':checked')) {
                            isChecked = true;
                            return false; // Exit the loop if a checkbox is checked
                        }
                    });
                    $('.prevStep').click(function() {
                    var currentStep = $(this).closest('.step');
                    var prevStep = currentStep.prev('.step');

                    // Move to the previous step
                    currentStep.removeClass('active');
                    prevStep.addClass('active');
                });

                    if (isChecked) {
                        // Move to the next step
                        var currentStep = $(this).closest('.step');
                        var nextStep = currentStep.next('.step');
                        currentStep.removeClass('active');
                        nextStep.addClass('active');
                    }


                    var isValid = true;

                    // Check if all required fields in the current step are filled
                    currentStep.find('input[required], select[required], input[type="checkbox"]:checked').each(function() {
                        if ($(this).val() === '') {
                            isValid = false;
                            return false; // Exit the loop if a required field is empty
                        }
                    });

                    if (isValid) {
                        currentStep.removeClass('active');
                        nextStep.addClass('active');
                    } else {
                        alert('Please fill out all required fields before proceeding.');
                        $(currentStep).find('input[required], select[required], input[type="checkbox"]:checked').each(function() {
                            if ($(this).val() === '') {
                                $(this).focus();
                                return false;
                            }
                        });
                    }
                });
            });



          
           
    

    </script> --}}
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

