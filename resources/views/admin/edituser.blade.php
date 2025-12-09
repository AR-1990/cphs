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

        input,
        select {
            height: 50px !important;
            border-radius: 8px !important;
            border: 1px solid rgba(0, 0, 0, .15) !important;
            background-color: transparent !important;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container">
        <h1 class="mb-3 mt-5">User Edit Form</h1>


        <form action="{{ route('update_user') }}" method="POST" onsubmit="return validateForm()">
            <!-- Step-one -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $detail->id }}">
            <div class="step active ml-128pt" id="step1">

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required
                                value="{{ $detail->fullname }}" disabled><br>
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="{{ $detail->email }}" disabled><br>

                            <label for="school">School </label>
                            {{-- <select class="form-control" name="school" id="school"> --}}

                            <select class="form-control" name="school[]" id="school" required multiple>


                                @if (!empty($School))
                                    <option value="select_all">Select All</option>
                                    @foreach ($School as $sh)
                                        <option value="{{ $sh->id }}" @if(in_array($sh->id, json_decode($detail->school_id))) selected @endif  >
                                            {{ $sh->school_name }}
                                        </option>
                                    @endforeach
                                @endif


                            </select>
                            
                            <br>

                            <br>

                            <label for="designation">Designation </label>
                            <select name="designation" id="designation" class="form-control">
                                <option value="">Select</option>

                                {{-- <option value="0" {{ old('designation',  $detail->designation) == 0 ? 'selected' : '' }}>Admin</option> --}}
                                <option value="1"
                                    {{ old('designation', $detail->designation) == 1 ? 'selected' : '' }}>Doctor</option>
                                <option value="2"
                                    {{ old('designation', $detail->designation) == 2 ? 'selected' : '' }}>Nutritionist
                                </option>
                                <option value="3"
                                    {{ old('designation', $detail->designation) == 3 ? 'selected' : '' }}>Psychologist
                                </option>
                                <option value="4"
                                    {{ old('designation', $detail->designation) == 4 ? 'selected' : '' }}>Founder and
                                    Director</option>
                                <option value="5"
                                    {{ old('designation', $detail->designation) == 5 ? 'selected' : '' }}>Co Founder And
                                    chief Ooperating Officer </option>
                                <option value="6"
                                    {{ old('designation', $detail->designation) == 6 ? 'selected' : '' }}>Chief Advisor
                                    And Business Support Manager</option>
                                <option value="7"
                                    {{ old('designation', $detail->designation) == 7 ? 'selected' : '' }}>Clinical
                                    Operations Lead</option>
                                <option value="8"
                                    {{ old('designation', $detail->designation) == 8 ? 'selected' : '' }}>Adminstrive
                                    Coordinator</option>
                                <option value="9"
                                    {{ old('designation', $detail->designation) == 9 ? 'selected' : '' }}>Clinical
                                    Psychologist</option>
                                <option value="10"
                                    {{ old('designation', $detail->designation) == 10 ? 'selected' : '' }}>Clinical
                                    Nutritionist</option>
                                <option value="11"
                                    {{ old('designation', $detail->designation) == 11 ? 'selected' : '' }}>School Health
                                    Physican (KIRAN FOUNDATION)</option>
                                <option value="12"
                                    {{ old('designation', $detail->designation) == 12 ? 'selected' : '' }}>School Health
                                    Physican (SAVE THE FUTURE)</option>
                                <option value="13"
                                    {{ old('designation', $detail->designation) == 13 ? 'selected' : '' }}>School Health
                                    Physican (THE SET SCHOOL)</option>
                                <option value="14"
                                    {{ old('designation', $detail->designation) == 14 ? 'selected' : '' }}>School Health
                                    Physican (LOCUM)</option>

                            </select>

                            <br>

                            <label for="address">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                oninput="validatePassword()"><br>
                            <label for="address">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required oninput="validatePassword()">

                            <!-- Display password match status -->
                            <div id="passwordStatus" style="margin-top: 10px;"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>

   
   
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                // Show SweetAlert for password mismatch
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password and Confirm Password do not match!',
                    confirmButtonText: 'OK',
                    timer: 2000, // Set the timer to 10 seconds (in milliseconds)
                    timerProgressBar: true, // Show a progress bar during the timer
                    showConfirmButton: false // Hide the "OK" button
                });

                // Prevent form submission
                return false;
            }

            // Show SweetAlert for password match
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                timer: 1000,
                text: 'Password Matched!',
            });

            // Proceed with form submission
            return true;
        }

        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            // Display password match status
            var passwordStatus = document.getElementById("passwordStatus");

            if (password === confirmPassword) {
                passwordStatus.innerHTML = '<span style="color:green;">Password Matched</span>';
            } else {
                passwordStatus.innerHTML = '<span style="color:red;">Password Does Not Match</span>';
            }
        }



        $('#school').select2({
            placeholder: 'Select an option',
            allowClear: true
        });

       
        
        // Add "Select All" functionality
        $('#school').on('select2:select', function(e) {
            var selectedValue = e.params.data.id;
            var select = $(this);
            if (selectedValue === 'select_all') {
                // Select all options
                var allOptions = select.find('option[value!="select_all"]').map(function() {
                    return $(this).val();
                }).get();
                select.val(allOptions).trigger('change');
            }
        });

        $('#school').on('select2:unselect', function(e) {
            var unselectedValue = e.params.data.id;
            var select = $(this);
            if (unselectedValue === 'select_all') {
                // Deselect all options
                select.val(null).trigger('change');
            }
        });
    </script>

@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
