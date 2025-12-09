@extends('admin.main')
@section('content')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <div class="container">
        <h1 class="mb-4 mt-5">Child Health Checkup Survey</h1>

        @if (Session::has('error_message'))
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
                {{ Session::get('error_message') }}.

            </div>
        @endif

        @if (Session::has('success_message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
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

        
        <form id="multiStepForm"
    @if (!empty($BioData))
        action="{{ route('BioData') }}/{{ $BioData['id'] }}"
    @else
        action="{{ route('BioData') }}"
    @endif
    method="POST">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="step active mb-5" id="step1">
        <h3>Bio Data</h3>
        <div class="form-row">
            <!-- Name Field -->
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    @if (!empty($BioData) && !empty($BioData['name']))
                        value="{{ $BioData['name'] }}"
                    @elseif (isset($_GET['name']))
                        value="{{ $_GET['name'] }}"
                    @else
                        value="{{ old('name') }}"
                    @endif
                    required>
            </div>

            <!-- Guardian Name Field -->
            <div class="form-group col-md-6">
                <label for="guardianname">Guardian Name</label>
                <input type="text" class="form-control" id="guardianname" name="guardianname"
                    @if (!empty($BioData) && !empty($BioData['guardianname']))
                        value="{{ $BioData['guardianname'] }}"
                    @elseif (isset($_GET['guardianname']))
                        value="{{ $_GET['guardianname'] }}"
                    @else
                        value="{{ old('guardianname') }}"
                    @endif
                    required>
                <span class="error-message"></span>
            </div>

            <!-- Gender Field -->
            <div class="form-group col-md-6">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">Select</option>
                    <option value="male" @if (
                        (!empty($BioData) && $BioData['gender'] == 'male') ||
                        (isset($_GET['gender']) && $_GET['gender'] == 'male') ||
                        old('gender') == 'male') selected @endif>Male
                    </option>
                    <option value="female" @if (
                        (!empty($BioData) && $BioData['gender'] == 'female') ||
                        (isset($_GET['gender']) && $_GET['gender'] == 'female') ||
                        old('gender') == 'female') selected @endif>Female
                    </option>
                    <option value="other" @if (
                        (!empty($BioData) && $BioData['gender'] == 'other') ||
                        (isset($_GET['gender']) && $_GET['gender'] == 'other') ||
                        old('gender') == 'other') selected @endif>Other
                    </option>
                </select>
            </div>

            <!-- School Field -->
            <div class="form-group col-md-6">
                <label for="school">School</label>
                <select class="form-control" id="school" name="school" required>
                    <option value="">Select</option>
                    @foreach ($school as $item)
                        <option value="{{ $item->id }}" @if (
                            (!empty($BioData) && $BioData['school'] == $item->id) ||
                            (isset($_GET['school']) && $_GET['school'] == $item->id) ||
                            old('school') == $item->id) selected @endif>
                            {{ $item->school_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- City Field -->
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city" required>
                    <option value="">Select</option>
                    @foreach ($city as $item)
                        <option value="{{ $item->id }}" @if (
                            (!empty($BioData) && $BioData['city'] == $item->id) ||
                            (isset($_GET['city']) && $_GET['city'] == $item->id) ||
                            old('city') == $item->id) selected @endif>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Area Field -->
            <div class="form-group col-md-6">
                <label for="area">Area</label>
                <select class="form-control" id="area" name="area" required>
                    <option value="">Select</option>
                    @foreach ($area as $item)
                        <option value="{{ $item->id }}" @if (
                            (!empty($BioData) && $BioData['area'] == $item->id) ||
                            (isset($_GET['area']) && $_GET['area'] == $item->id) ||
                            old('area') == $item->id) selected @endif>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date Of Birth Field -->
            <div class="form-group col-md-6">
                <label for="dob">Date Of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob"
                    @if (!empty($BioData) && !empty($BioData['dob']))
                        value="{{ $BioData['dob']->format('Y-m-d') }}"
                    @elseif (isset($_GET['dob']))
                        value="{{ $_GET['dob'] }}"
                    @else
                        value="{{ old('dob') }}"
                    @endif
                    required>
            </div>

            <!-- Age Field -->
            <div class="form-group col-md-6">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" readonly
                    @if (!empty($BioData) && !empty($BioData['age']))
                        value="{{ $BioData['age'] }}"
                    @elseif (isset($_GET['age']))
                        value="{{ $_GET['age'] }}"
                    @else
                        value="{{ old('age') }}"
                    @endif
                    required>
            </div>

            <!-- Emergency Contact Number Field -->
            <div class="form-group col-md-6">
                <label for="Emergency_Contact_Number">Emergency Contact Number</label>
                <input type="text" class="form-control" id="Emergency_Contact_Number"
                    name="Emergency_Contact_Number"
                    @if (!empty($BioData) && !empty($BioData['Emergency_Contact_Number']))
                        value="{{ $BioData['Emergency_Contact_Number'] }}"
                    @elseif (isset($_GET['Emergency_Contact_Number']))
                        value="{{ $_GET['Emergency_Contact_Number'] }}"
                    @else
                        value="{{ old('Emergency_Contact_Number') }}"
                    @endif
                    required>
            </div>

            <!-- GR Number Field -->
            <div class="form-group col-md-6">
                <label for="Gr_Number">GR Number</label>
                <input type="text" class="form-control" id="Gr_Number" name="Gr_Number"
                    @if (!empty($BioData) && !empty($BioData['Gr_Number']))
                        value="{{ $BioData['Gr_Number'] }}"
                    @elseif (isset($_GET['Gr_Number']))
                        value="{{ $_GET['Gr_Number'] }}"
                    @else
                        value="{{ old('Gr_Number') }}"
                    @endif
                    required>
            </div>

            <!-- Any Known Medical Condition Field -->
            <div class="form-group col-md-6">
                <label for="Any_Known_Medical_Condition">Any Known Medical Condition</label>
                <input type="text" class="form-control" id="Any_Known_Medical_Condition"
                    name="Any_Known_Medical_Condition"
                    @if (!empty($BioData) && !empty($BioData['Any_Known_Medical_Condition']))
                        value="{{ $BioData['Any_Known_Medical_Condition'] }}"
                    @elseif (isset($_GET['Any_Known_Medical_Condition']))
                        value="{{ $_GET['Any_Known_Medical_Condition'] }}"
                    @else
                        value="{{ old('Any_Known_Medical_Condition') }}"
                    @endif
                    required>
            </div>

            <!-- Address Field -->
            <div class="form-group col-md-6">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="address" name="Address"
                    @if (!empty($BioData) && !empty($BioData['Address']))
                        value="{{ $BioData['Address'] }}"
                    @elseif (isset($_GET['Address']))
                        value="{{ $_GET['Address'] }}"
                    @else
                        value="{{ old('Address') }}"
                    @endif
                    required>
            </div>

            <!-- Blood Group Field -->
            <div class="form-group col-md-12">
                <label for="blood_group">Blood Group</label>
                <select class="form-control" id="blood_group" name="Blood_group" required>
                    <option value="">Select</option>
                    <option value="A+" @if (
                        (!empty($BioData) && $BioData['Blood_group'] == 'A+') ||
                        (isset($_GET['Blood_group']) && $_GET['Blood_group'] == 'A+') ||
                        old('Blood_group') == 'A+') selected @endif>A+</option>
                    <option value="A-" @if (
                        (!empty($BioData) && $BioData['Blood_group'] == 'A-') ||
                        (isset($_GET['Blood_group']) && $_GET['Blood_group'] == 'A-') ||
                        old('Blood_group') == 'A-') selected @endif>A-</option>
                    <option value="B+" @if (
                        (!empty($BioData) && $BioData['Blood_group'] == 'B+') ||
                        (isset($_GET['Blood_group']) && $_GET['Blood_group'] == 'B+') ||
                        old('Blood_group') == 'B+') selected @endif>B+</option>
                    <option value="B-" @if (
                        (!empty($BioData) && $BioData['Blood_group'] == 'B-') ||
                        (isset($_GET['Blood_group']) && $_GET['Blood_group'] == 'B-') ||
                        old('Blood_group') == 'B-') selected @endif>B-</option>
                    <option value="O+" @if (
                        (!empty($BioData) && $BioData['Blood_group'] == 'O+') ||
                        (isset($_GET['Blood_group']) && $_GET['Blood_group'] == 'O+') ||
                        old('Blood_group') == 'O+') selected @endif>O+</option>
                    <option value="O-" @if (
                        (!empty($BioData) && $BioData['Blood_group'] == 'O-') ||
                        (isset($_GET['Blood_group']) && $_GET['Blood_group'] == 'O-') ||
                        old('Blood_group') == 'O-') selected @endif>O-</option>
                    <option value="AB+" @if (
                        (!empty($BioData) && $BioData['Blood_group'] == 'AB+') ||
                        (isset($_GET['Blood_group']) && $_GET['Blood_group'] == 'AB+') ||
                        old('Blood_group') == 'AB+') selected @endif>AB+</option>
                    <option value="AB-" @if (
                        (!empty($BioData) && $BioData['Blood_group'] == 'AB-') ||
                        (isset($_GET['Blood_group']) && $_GET['Blood_group'] == 'AB-') ||
                        old('Blood_group') == 'AB-') selected @endif>AB-</option>
                    <option value="Unknown" @if (
                        (!empty($BioData) && $BioData['Blood_group'] == 'Unknown') ||
                        (isset($_GET['Blood_group']) && $_GET['Blood_group'] == 'Unknown') ||
                        old('Blood_group') == 'Unknown') selected @endif>Unknown</option>
                </select>
            </div>

            <!-- Comment/Findings Field -->
            <div class="form-group col-md-12">
                <label for="bio_data_comment">Comment/Findings</label>
                <textarea class="form-control" name="bio_data_comment" id="comment" cols="50" required>
                    @if (!empty($BioData) && !empty($BioData['bio_data_comment']))
                        {{ trim($BioData['bio_data_comment']) }}
                    @elseif (isset($_GET['bio_data_comment']))
                        {{ trim($_GET['bio_data_comment']) }}
                    @else
                        {{ trim(old('bio_data_comment')) }}
                    @endif
                </textarea>
            </div>

        </div>
        {{-- <button type="submit" class="btn btn-primary">Next</button> --}}
        <button type="button" class="btn btn-primary nextStep">Next</button>

    </div>
</form>


    </div>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            /* dob */
            $("#dob").on("change", function() {

                var dob = $(this).val();

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


            });

            $('#multiStepForm').on('submit', function(event) {

                // $('#submitButton').prop('disabled', true);

                $('#submitButton').text('Processing...');


            });

        });
    </script>
@endsection
