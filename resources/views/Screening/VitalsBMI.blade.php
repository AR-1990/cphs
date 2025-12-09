@extends('admin.main')
@section('content')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
            @if (!empty($BioData)) action="{{ route('BioData') }}/{{ $BioData['id'] }}"  @else action="{{ route('BioData') }}" @endif
            method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="step" id="step2">
                <h3>Vitals/BMI</h3>

                @php
                    dd($bioData);
                @endphp
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group height">
                            <div class="group-form">
                                <label for="height" class="width-100">Question No.1: Height :cm(s)<input type="number"
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
                <a style="color: white;" class="btn btn-primary prevStep">Previous</a>

                <button type="submit" class="btn btn-primary">Next</button>
            </div>


        </form>

    </div>

    <script>
        $(document).ready(function() {



        });
    </script>
@endsection
