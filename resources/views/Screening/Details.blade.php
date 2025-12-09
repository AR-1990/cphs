@php

    use App\Models\User;
    use App\Models\SchoolHealthPhysician;
    use App\Models\NutritionistHistoryEvaluationSection;
    use App\Models\PsychologistHistoryAssessmentSection;
    use App\Models\form_entry;
    use App\Models\FormData;
    use Illuminate\Support\Collection;
    use App\Models\StudentBiodata;
@endphp
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

        .link {
            color: white !important;
            border-bottom: 1px solid rgb(247, 190, 3);
        }



        #datatable_wrapper {
            padding: 10px;
        }

        div#datatable_info {
            color: #fff;
        }

        div#datatable_filter {
            display: flex;
            justify-content: end;
            margin-right: 20px;
        }

        .upload_csv {
            display: flex;
            gap: 20px;
            justify-content: end;
        }

        .upload_csv form {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        @media (min-width:992px) {

            .mdk-drawer-layout .container,
            .mdk-drawer-layout .container-fluid,
            .mdk-drawer-layout .container-lg,
            .mdk-drawer-layout .container-md,
            .mdk-drawer-layout .container-sm,
            .mdk-drawer-layout .container-xl {
                max-width: 1600px !important;
            }
        }

        .bg_blue {
            background-color: #1c3866;
        }

        .fs_15 {
            font-size: 17px;
            color: #1F3864;
        }

        label {
            color: #5b626b;
        }



        .position-relative {
            posiion: relative;
        }

        #changeImageBtn {
            display: none;
        }

        .position-relative:hover #changeImageBtn {
            display: block;
            cursor: pointer;
        }





        /* Style the button */
        .btn-round {
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 13px;
        }

        /* Style the dropdown container */
        .dropdown-content {
            display: none;
            position: absolute;
            top: 35px;
            background-color: #f9f9f9;
            min-width: -webkit-fill-available;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1;
            width: 100%;
            border: 1px solid #d86744;
            color: #000;
            padding: 1rem 2rem;
        }

        /* Style the links inside the dropdown */
        .dropdown-content a {
            color: #000!important;
            text-decoration: none;
            display: block;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 500;
            padding: 10px 10px;
            text-align: left;
            color: #fff;
        }

        /* Add hover effect for links */
        .dropdown-content a:hover {
            background-color: #d86744;
            color: #fff !important;
        }

        /* Show dropdown on hover */
        .btn-group:hover .dropdown-content {
            display: block;
        }

        /* Style the dropdown divider */
        .dropdown-divider {
            height: 1px;
            background-color: #ddd;
            margin: 8px 0;
        }

        #customId {
            gap: 20px;
        }

        #customId .dropbtn {
            border-radius: 8px;
            box-shadow: none;
            padding: 11px 10px;
            font-weight: 600;
            text-transform: uppercase;
            border: none;
        }
        #customId .dropbtn:focus{
            outline: none!important;
        }
/* 
        #customId .dropbtn:hover {
            background-color: #ffffff34!important;
        } */

    </style>
    <section>
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="d-flex align-items-center justify-content-end">


                        @php

                            $queryString =
                                !empty($details) && !empty($details['id']) ? 'screeningFormId=' . $details['id'] : 0;

                            $queryString .=
                                !empty($details) && !empty($details['gr_number'])
                                    ? '&gr_number=' . $details['gr_number']
                                    : '';

                            $queryString .=
                                !empty($details) && !empty($details['class']) ? '&class=' . $details['class'] : '';

                            $queryString .=
                                !empty($details) && !empty($details['name']) ? '&name=' . $details['name'] : '';
                            $queryString .=
                                !empty($details) && !empty($details['dob']) ? '&dob=' . $details['dob'] : '';
                            $queryString .=
                                !empty($details) && !empty($details['age']) ? '&age=' . $details['age'] : '';
                            $queryString .=
                                !empty($details) && !empty($details['gender']) ? '&gender=' . $details['gender'] : '';

                            $queryString .=
                                !empty($details) && !empty($details['school']) ? '&school=' . $details['school'] : '';

                            $queryString .=
                                !empty($details) && !empty($details['any_known_medical_condition'])
                                    ? '&any_known_medical_condition=' . $details['any_known_medical_condition']
                                    : '';

                            $queryString .=
                                !empty($details) && !empty($details['bio_data_comment'])
                                    ? '&bio_data_comment=' . urlencode($details['bio_data_comment'])
                                    : '';

                            $queryString .=
                                !empty($details) && !empty($details['address'])
                                    ? '&address=' . $details['address']
                                    : '';
                            $queryString .=
                                !empty($details) && !empty($details['emergency_contact_number'])
                                    ? '&emergency_contact_number=' . $details['emergency_contact_number']
                                    : '';

                            if (!empty($area)) {
                                foreach ($area as $item) {
                                    if (!empty($details) && !empty($details['area']) && $details['area'] == $item->id) {
                                        $queryString .=
                                            !empty($details) && !empty($details['area']) ? '&area=' . $item->id : '';
                                    }
                                }
                            }

                            if (!empty($area)) {
                                foreach ($city as $item) {
                                    if (!empty($details) && !empty($details['city']) && $details['city'] == $item->id) {
                                        $queryString .=
                                            !empty($details) && !empty($details['city']) ? '&city=' . $item->id : '';
                                    }
                                }
                            }

                            $queryString .=
                                !empty($details) && !empty($details['guardianname'])
                                    ? '&guardianname=' . $details['guardianname']
                                    : '';

                            $queryString .=
                                !empty($details) && !empty($details['blood_group'])
                                    ? '&blood_group=' . $details['blood_group']
                                    : '';

                            $classLabels1 = [
                                '0' => 'Play group',
                                '00' => 'KG-1',
                                '000' => 'KG-2',
                            ];

                            $queryStringClass = $classLabels1[$details['class']] ?? $details['class'];

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

                            $selectedClass = old('class', $details['class'] ?? '');

                            $queryString .= !empty($details) ? '&class=' . $selectedClass : '';

                        @endphp



                        @if (auth()->guard('admin')->check() &&
                                (auth()->guard('admin')->user()->role == 1 || auth()->guard('admin')->user()->role == 2))
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PrescriptionModal">
                            ADVICE <span class="material-icons sidebar-menu-icon ml-2">add</span>
                            </button>
                        @endif


                        <!-- The Modal -->
                        <div class="modal fade" id="PrescriptionModal" tabindex="-1" role="dialog"
                            aria-labelledby="PrescriptionModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="PrescriptionModalLabel">ADVICE</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="{{ route('Prescription') }}" method="POST" id="prescriptionForm">
                                        @csrf
                                        <div class="modal-body">
                                            <!-- Form Starts Here -->


                                            <input type="hidden" readonly name="form_entry_id" value="{{ $details['id'] }}"
                                                required>

                                            @php

                                                //  $Doctors = user::where('designation', '>',0)->get()->toArray();
                                                $Doctors = User::whereIn('designation', [1, 2, 3])->get();

                                            @endphp
                                            <!-- Select Box -->
                                            <div class="form-group">
                                                <label for="DoctorID">Select Doctor</label>
                                                <select class="form-control" id="DoctorID" name="DoctorID" required>
                                                    <option value="">Select</option>
                                                    @if (!empty($Doctors))
                                                        @foreach ($Doctors as $Doctor)
                                                            <option value="{{ $Doctor['id'] }}">{{ $Doctor['fullname'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif

                                                    {{-- <option value="Option1">Option 1</option>
                                                    <option value="Option2">Option 2</option>
                                                    <option value="Option3">Option 3</option> --}}

                                                </select>
                                            </div>

                                            <!-- Reason -->
                                            <div class="form-group">
                                                <label for="textarea">Reason</label>
                                                <textarea class="form-control" id="Reason" name="Reason" rows="3" required></textarea>
                                            </div>

                                            <!-- Prescription -->
                                            <div class="form-group">
                                                <label for="Prescription">Prescription</label>
                                                <input type="text" class="form-control" id="Prescription"
                                                    name="Prescription" required>
                                            </div>
                                            <!-- Form Ends Here -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>

                        &nbsp;
                        &nbsp;
                        &nbsp;

                        @if (auth()->guard('admin')->check() &&
                                (auth()->guard('admin')->user()->role == 1 || auth()->guard('admin')->user()->role == 2))
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AidsModal">
                                Aids <span class="material-icons sidebar-menu-icon ml-2">add</span>
                            </button>
                        @endif

                        <!-- The Modal -->
                        <div class="modal fade" id="AidsModal" tabindex="-1" role="dialog"
                            aria-labelledby="AidsModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AidsModalLabel">Aids</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="{{ route('Aids') }}" method="POST" id="aidsForm">
                                        @csrf
                                        <div class="modal-body">
                                            <!-- Form Starts Here -->


                                            <input type="hidden" readonly name="form_entry_id" value="{{ $details['id'] }}"
                                                required>

                                            @php

                                                //  $Doctors = user::where('designation', '>',0)->get()->toArray();
                                                $Doctors = User::whereIn('designation', [1, 2, 3])->get();

                                            @endphp
                                            <!-- Select Box -->
                                            <div class="form-group">
                                                <label for="DoctorID">Select Doctor</label>
                                                <select class="form-control" id="DoctorID" name="DoctorID" required>
                                                    <option value="">Select</option>
                                                    @if (!empty($Doctors))
                                                        @foreach ($Doctors as $Doctor)
                                                            <option value="{{ $Doctor['id'] }}">{{ $Doctor['fullname'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif

                                                    {{-- <option value="Option1">Option 1</option>
                                                    <option value="Option2">Option 2</option>
                                                    <option value="Option3">Option 3</option> --}}

                                                </select>
                                            </div>

                                            <!-- Reason -->
                                            <div class="form-group">
                                                <label for="textarea">Reason</label>
                                                <textarea class="form-control" id="Reason" name="Reason" rows="3" required></textarea>
                                            </div>

                                            <!-- Aids -->
                                            <div class="form-group">
                                                <label for="Aids">Aids</label>
                                                <input type="text" class="form-control" id="Aids" name="Aids"
                                                    required>
                                            </div>
                                            <!-- Form Ends Here -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"
                                                id="submitButton1">Submit</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>


                        &nbsp;
                        &nbsp;
                        &nbsp;

                        @if (auth()->guard('admin')->check() &&
                                (auth()->guard('admin')->user()->role == 1 || auth()->guard('admin')->user()->role == 2))
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#LabsModal">
                                Labs <span class="material-icons sidebar-menu-icon ml-2">add</span>
                            </button>
                        @endif

                        <!-- The Modal -->
                        <div class="modal fade" id="LabsModal" tabindex="-1" role="dialog"
                            aria-labelledby="LabsModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="LabsModalLabel">Upload Labs Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="{{ route('Labs') }}" method="POST" enctype="multipart/form-data"
                                        id="labsForm">
                                        @csrf
                                        <div class="modal-body">
                                            <!-- Form Starts Here -->

                                            <input type="hidden" name="form_entry_id" value="{{ $details['id'] }}"
                                                required>

                                            <!-- Title Field -->
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    required>
                                            </div>


                                            <!-- File Upload -->
                                            <div class="form-group">
                                                <label for="fileUpload">Upload Files</label>
                                                <input type="file" class="form-control" id="fileUpload"
                                                    name="files[]" multiple required>
                                            </div>

                                            <!-- Additional fields can be added here -->

                                            <!-- Form Ends Here -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"
                                                id="submitButton2">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>


                        @if (auth()->guard('admin')->check() &&
                                (auth()->guard('admin')->user()->role == 1 || auth()->guard('admin')->user()->role == 2))
                            <a href="{{ route('CreateScreening') }}?{{ $queryString }}" class="ml-2" target="_blank"
                                rel="noopener noreferrer">
                                <button class="btn btn-primary ml-auto d-block">Screening Form<span
                                        class="material-icons sidebar-menu-icon ml-2">add</span>
                                </button>
                            </a>

                            {{-- <a href="{{ route('screeningForm') }}?{{ $queryString }}" class="ml-2" target="_blank"
                                rel="noopener noreferrer">
                                <button class="btn btn-primary ml-auto d-block">Screening Form<span
                                        class="material-icons sidebar-menu-icon ml-2">add</span>
                                </button>
                            </a> --}}

                            <a href="{{ route('StudentBiodata') }}?{{ $queryString }}" class="ml-2" target="_blank"
                                rel="noopener noreferrer">
                                <button class="btn btn-primary ml-auto d-block">MEDICAL HISTORY<span
                                        class="material-icons sidebar-menu-icon ml-2">add</span>
                                </button>
                            </a>
                        @endif

                        {{-- <a href="{{ route('admin.form.index') }}?grno={{ $details['gr_number'] }}&name={{ $details['name'] }}&dob={{ $details['dob'] }}&age={{ $details['age'] }}&gender={{ $details['gender'] }}&school={{ $details['school'] }}&emergency_contact_number={{ $details['emergency_contact_number'] }}&address={{ $details['address'] }}" class="ml-2" target="_blank" rel="noopener noreferrer">
                            <button class="btn btn-primary ml-auto d-block">Screening Form<span
                                    class="material-icons sidebar-menu-icon ml-2">add</span>
                            </button>
                        </a> --}}
                        {{-- <a href="{{ route('StudentBiodata') }}?grno={{ $details['gr_number'] }}&name={{ $details['name'] }}&dob={{ $details['dob'] }}&age={{ $details['age'] }}&gender={{ $details['gender'] }}&school={{ $details['school'] }}&emergency_contact_number={{ $details['emergency_contact_number'] }}&address={{ $details['address'] }}"
                            class="ml-2" target="_blank" rel="noopener noreferrer">
                            <button class="btn btn-primary ml-auto d-block">MEDICAL HISTORY<span
                                    class="material-icons sidebar-menu-icon ml-2">add</span>
                            </button>
                        </a> --}}

                        {{-- <a href="{{route('follow-up')}}/{{$details['id']}}" class="ml-2" target="_blank" rel="noopener noreferrer">  
                                <button class="btn btn-primary ml-auto d-block">Add Visit <span class="material-icons sidebar-menu-icon ml-2">add</span>
                                </button>
                            </a> --}}

                        {{-- <button class="btn btn-primary ml-auto d-block">Add Visit <span class="material-icons sidebar-menu-icon ml-2">add</span</button> --}}


                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadModalLabel">Upload Profile Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="uploadForm" action="{{ route('upload.profile.image') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="profile_image">Choose an image</label>
                                    <input type="hidden" readonly name="updateID" value="{{ $details['id'] }}"
                                        required>
                                    <input type="file" class="form-control-file" id="profile_image"
                                        name="profile_image" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <form>
                <h4 class="mt-5" style="color:#e55123;">Student Details</h4>

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


                <div class="row mt-2">
                    <div class="col-6">






                        <div class="mb-1 row ms-0 align-items-center">
                            <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Profile Image
                                :</label>
                            <div class="col-md-5 position-relative">
                                @php
                                    // Define the default image path
                                    $defaultImage = asset('uploads/student/profile_images/default.png');

                                    // Check if the profile image exists
                                    $profileImagePath = $details['profile_image'] ?? null;

                                    $imagePath = public_path("uploads/student/profile_images/{$profileImagePath}");

                                    $profileImageUrl = file_exists($imagePath)
                                        ? asset('uploads/student/profile_images/' . $profileImagePath)
                                        : $defaultImage;

                                @endphp

                                <!-- Display the profile image or the default image -->
                                <img src="{{ $profileImageUrl }}" alt="Profile Image" class="img-fluid mt-1"
                                    style="max-width: 100px; max-height: 100px;">

                                <!-- Change image trigger -->
                                <button type="button" class="btn btn-secondary position-absolute" data-toggle="modal"
                                    data-target="#uploadModal" id="changeImageBtn" style="bottom: 10px; right: 10px;">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                        </div>


                        <div class="mb-1 row ms-0 align-items-center">
                            <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Name :</label>
                            <div class="col-md-9">
                                <label class="col-md-6 col-form-label mt-1 fs_15">{{ $details['name'] }} </label>
                            </div>
                        </div>

                        <div class="mb-1 row ms-0 align-items-center">
                            <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Gender
                                :</label>
                            <div class="col-md-9">
                                <label class="col-md-6 col-form-label mt-1 fs_15">{{ $details['gender'] }}</label>
                            </div>
                        </div>
                        <div class="mb-1 row ms-0 align-items-center">
                            <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">City :</label>
                            <div class="col-md-9">
                                <label class="col-md-6 col-form-label mt-1 fs_15">

                                    @if (!empty($city))
                                        @foreach ($city as $item)
                                            @if ($details['city'] == $item->id)
                                                {{ $item->name }}
                                            @endif
                                        @endforeach
                                    @endif

                                </label>
                            </div>
                        </div>
                        <div class="mb-1 row ms-0 align-items-center">
                            <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Date Of Birth
                                :</label>
                            <div class="col-md-9">
                                {{-- <label  class="col-md-6 col-form-label mt-1 fs_15">{{ $details['dob'] }}</label> --}}
                                <label class="col-md-6 col-form-label mt-1 fs_15">
                                    {{ \Carbon\Carbon::parse($details['dob'])->format('d M Y') }}

                                </label>
                            </div>
                        </div>
                        <div class="mb-1 row ms-0 align-items-center">
                            <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Emergency
                                Contact
                                Number :</label>
                            <div class="col-md-9">
                                <label
                                    class="col-md-6 col-form-label mt-1 fs_15">{{ $details['emergency_contact_number'] }}</label>
                            </div>
                        </div>
                        <div class="mb-1 row ms-0 align-items-center">
                            <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Address
                                :</label>
                            <div class="col-md-9">
                                <label class="col-md-6 col-form-label mt-1 fs_15">{{ $details['address'] }}</label>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div>
                            <div class="mb-1 row ms-0 align-items-center">
                                <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Guardian
                                    Name
                                    :</label>
                                <div class="col-md-9">
                                    <label
                                        class="col-md-6 col-form-label mt-1 fs_15">{{ $details['guardianname'] }}</label>
                                </div>
                            </div>
                            <div class="mb-1 row ms-0 align-items-center">
                                <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">School
                                    :</label>
                                <div class="col-md-9">
                                    <label class="col-md-6 col-form-label mt-1 fs_15">

                                        @if (!empty($school))
                                            @foreach ($school as $item)
                                                @if ($details['school'] == $item->id)
                                                    {{ $item->school_name }}
                                                @endif
                                            @endforeach
                                        @endif

                                    </label>
                                </div>
                            </div>
                            <div class="mb-1 row ms-0 align-items-center">
                                <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Area
                                    :</label>
                                <div class="col-md-9">
                                    <label class="col-md-6 col-form-label mt-1 fs_15">
                                        @if (!empty($area))
                                            @foreach ($area as $item)
                                                @if ($details['area'] == $item->id)
                                                    {{ $item->name }}
                                                @endif
                                            @endforeach
                                        @endif

                                    </label>
                                </div>
                            </div>
                            <div class="mb-1 row ms-0 align-items-center">
                                <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Age (Year:Month)
                                    :</label>
                                <div class="col-md-9">
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
                                     <label class="col-md-6 col-form-label mt-1 fs_15">{{ $renderAge }}</label>
                                </div>
                            </div>
                            <div class="mb-1 row ms-0 align-items-center">
                                <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">GR Number
                                    :</label>
                                <div class="col-md-9">
                                    <label class="col-md-6 col-form-label mt-1 fs_15">{{ $details['gr_number'] }}</label>
                                </div>
                            </div>
                            <div class="mb-1 row ms-0 align-items-center">
                                <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Blood
                                    Group
                                    :</label>
                                <div class="col-md-9">
                                    <label
                                        class="col-md-6 col-form-label mt-1 fs_15">{{ $details['blood_group'] }}</label>
                                </div>
                            </div>
                            <div class="mb-1 row ms-0 align-items-center">
                                <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Class
                                    :</label>
                                <div class="col-md-9">


                                    @php
                                        $classLabels = [
                                            '0' => 'Play group',
                                            '00' => 'KG-1',
                                            '000' => 'KG-2',
                                        ];
                                    @endphp

                                    <label class="col-md-6 col-form-label mt-1 fs_15">
                                        {{ $classLabels[$details['class']] ?? $details['class'] }}
                                    </label>


                                </div>
                            </div>


  <div class="mb-1 row ms-0 align-items-center">
                                <label class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Section
                                    :</label>
                                <div class="col-md-9">


                                   

                                    <label class="col-md-6 col-form-label mt-1 fs_15">
                                        {{ $classLabels[$details['class_section']] ?? $details['class_section']??'-' }}
                                    </label>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Button to open the modal -->
                {{-- <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#uploadModal">
                Upload Profile Image
            </button> --}}

            </form>






            <div class="row mt-5 align-items-center">
                <div class="col-md-12">
                    <h4 class="mt-5" style="color:#e55123;">Screening</h4>
                </div>


                <div class="col-md-12 d-flex align-items-center flex-wrap" id="customId">

                    {{-- <div class="d-flex align-items-center">
                        <a href="{{ route('Medical_Detail') }}/{{ $form_id }}" class="ScreeningAnchor">
                            <button class="btn btn-primary">Screening 0</button>
                        </a>


                    </div> --}}


                    <div class="dropdown">
                        <div class="btn-group mb-0">
                            <button class="dropbtn btn-primary btn-round" type="button">Screening at {{ \Carbon\Carbon::parse($form_date)->format('d-m-Y') }}

                                <span><i class="icofont icofont-arrow-down"></i></span></button>
                            <div class="dropdown-content col-md-6 flex justify">
                                <a href="{{ Route('Medical_Detail', $form_id) }}")">&nbsp;<i class="fa fa-eye"></i> View </a>
                                <a href="{{ Route('UpdateScreening', $form_id) }}")">&nbsp;<i class="fa fa-edit"></i> Edit </a>

                            </div>
                        </div>
                    </div>
                   
                  
                    

                    @php
                        $form_entry_screening = form_entry::where('screeningFormId', $form_id)->get()->toArray();
                        @endphp
                        @if (!empty($form_entry_screening))
                        @foreach ($form_entry_screening as $key => $value)
                       
                        <div class="dropdown">
                                <div class="btn-group mb-0">
                                    <button class="dropbtn btn-primary btn-round" type="button">Screening at
                                        
                                         {{ \Carbon\Carbon::parse($value['created_at'])->format('d-m-Y') }}

                                        <span><i class="icofont icofont-arrow-down"></i></span></button>
                                    <div class="dropdown-content col-md-6 flex justify">
                                        <a href="{{ Route('Medical_Detail', $value['id']) }}")">&nbsp;<i class="fa fa-eye"></i> View</a>
                                        <a href="{{ Route('UpdateScreening', $value['id']) }}")">&nbsp;<i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{ Route('DeleteRecord', $value['id']) }}"
                                            onclick="return confirm(\'Are you sure you want to delete this record?\');">&nbsp;<i class="fa fa-trash"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                    







                </div>










                <div class="col-md-12">
                    <h4 class="mt-5" style="color:#e55123;">Medical History</h4>
                </div>

                <div class="col-md-12 d-flex align-items-center flex-wrap" id="customId">
                    @if ($medical_history_id->isNotEmpty())
                        @foreach ($medical_history_id as $medical_id)
                        <!-- <a href="{{ route('ViewMedicalHistory1', $medical_id) }}" class="ScreeningAnchor mr-3"
                            data-id="{{ $medical_id }}">
                            <button class="btn btn-primary">MedicalHistory Ref# {{$medical_id}}</button>
                        </a> -->
                        <?php
                             $diagnoses = collect();

                             $icd1 = NutritionistHistoryEvaluationSection::where('StudentBiodataId', $medical_id)->value('Provisional_Diagnosis1');
                             $icd2 = PsychologistHistoryAssessmentSection::where('StudentBiodataId', $medical_id)->value('Provisional_Diagnosis2');
                             $icd3 = SchoolHealthPhysician::where('StudentBiodataId', $medical_id)->value('Provisional_Diagnosis');
                             $BioDataDate = StudentBiodata::where('id', $medical_id)->value('created_at');
                         
                             // Merge and split by "|"
                             foreach ([$icd1, $icd2, $icd3] as $icd) {
                                 if (!empty($icd)) {
                                     $parts = explode('|', $icd);
                                     $diagnoses = $diagnoses->merge($parts);
                                 }
                             }
                            //  dd($diagnoses);
                        ?>
                        <div class="dropdown">
                            <div class="btn-group mb-0">
                                <a href="{{ route('ViewMedicalHistory1', $medical_id) }}" class="dropbtn btn-primary btn-round">
                                    MedicalHistory at 
                                    {{ \Carbon\Carbon::parse($BioDataDate)->format('d-m-Y') }}
                                    <span><i class="icofont icofont-arrow-down"></i></span>
                                </a>
                                <div class="dropdown-content col-md-6 flex justify">
                                @foreach($diagnoses as $index => $diagnosis)
                                    <a href="#">{{ $diagnosis }}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>




                <div class="col-md-12" data-toggle="collapse" data-target="#followupsContent" aria-expanded="false"
                    aria-controls="followupsContent" style="cursor: pointer;">
                    <h4 class="mt-5" style="color:#e55123;">
                        Followup Details - {{count($followUps)}}
                        <!-- Toggle button for collapse -->
                        <button class="btn btn-secondary btn-sm float-right" type="button" data-toggle="collapse"
                            data-target="#followupsContent" aria-expanded="false" aria-controls="followupsContent">
                            <i class="fas fa-chevron-down"></i> <!-- You can use a chevron icon or other icons -->
                        </button>
                    </h4>
                </div>

                <!-- Collapsible content -->
                <!-- <div class="col-md-12 collapse" id="followupsContent">
                    <div class="d-flex align-items-center">
                        @if (!empty($medicalComplain))
                            @foreach ($medicalComplain as $medicalComplai)
                                {{-- <a href="{{ Route('follow-up') }}/{{$form_id}}/{{$medicalComplai['id']}}" class="btn btn-primary">
                                    Visit - {{ date('M-d-Y', strtotime($medicalComplai['created_at'])) }}
                                </a> --}}
                            @endforeach
                        @endif

                        @if (!empty($StudentBiodata))
                            @foreach ($StudentBiodata as $StudentBiodat)
                                @php
                                    $SchoolHealthPhysician = SchoolHealthPhysician::where('deleted', 0)
                                        ->where('Follow_up_Required', 'yes')
                                        ->where('StudentBiodataId', $StudentBiodat->id)
                                        ->get()
                                        ->toArray();
                                @endphp
                                @if (!empty($SchoolHealthPhysician))
                                    @foreach ($SchoolHealthPhysician as $SchoolHealthPhysicia)
                                        <a href="{{ Route('ViewMedicalHistory1') }}/{{ $SchoolHealthPhysicia['StudentBiodataId'] }}"
                                            class="btn btn-primary mr-2 followupsContentCount" target="_blank">
                                            Followup - {{ date('M-d-Y', strtotime($SchoolHealthPhysicia['created_at'])) }}
                                        </a>
                                    @endforeach
                                @endif

                                @php
                                    $NutritionistHistoryEvaluationSection = NutritionistHistoryEvaluationSection::where(
                                        'deleted',
                                        0,
                                    )
                                        ->where('Follow_up_Required1', 'yes')
                                        ->where('StudentBiodataId', $StudentBiodat->id)
                                        ->get()
                                        ->toArray();
                                @endphp
                                @if (!empty($NutritionistHistoryEvaluationSection))
                                    @foreach ($NutritionistHistoryEvaluationSection as $NutritionistHistoryEvaluationSectio)
                                        <a href="{{ Route('ViewMedicalHistory1') }}/{{ $NutritionistHistoryEvaluationSectio['StudentBiodataId'] }}"
                                            class="btn btn-primary mr-2 followupsContentCount" target="_blank">
                                            Followup -
                                            {{ date('M-d-Y', strtotime($NutritionistHistoryEvaluationSectio['created_at'])) }}
                                        </a>
                                    @endforeach
                                @endif

                                @php
                                    $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where(
                                        'deleted',
                                        0,
                                    )
                                        ->where('Follow_up_Required2', 'yes')
                                        ->where('StudentBiodataId', $StudentBiodat->id)
                                        ->get()
                                        ->toArray();
                                @endphp
                                @if (!empty($PsychologistHistoryAssessmentSection))
                                    @foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio)
                                        <a href="{{ Route('ViewMedicalHistory1') }}/{{ $PsychologistHistoryAssessmentSectio['StudentBiodataId'] }}"
                                            class="btn btn-primary mr-2 followupsContentCount" target="_blank">
                                            Followup -
                                            {{ date('M-d-Y', strtotime($PsychologistHistoryAssessmentSectio['created_at'])) }}
                                        </a>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif

                        {{-- <button class="btn btn-primary mr-2">Visit</button> --}}
                    </div>
                </div> -->

                <!-- FollowUpDropDown -->

                <div class="row collapse" id="followupsContent" style="">
                @if (!empty($followUps))
                @foreach ($followUps as $key => $followUp)
                        <div class="col-md-12">
                            <h4 class="mt-5" style="color:#e55123;">
                                                                    
                                                            </h4>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Follow Up Date:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">{{ date('M-d-Y', strtotime($followUp->created_at)) }}</span>
                            </div>
                        </div>


                        


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Reference Number:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">{{$followUp->ref}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">ICD:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">{{$followUp->icd}}</span>
                            </div>
                        </div>

                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Reason:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">{{$followUp->reason}} </span>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Description:</label>

                                             <span class="fs_15 font-weight-bolder ml-2 text-dark">{{$followUp->comment}}</span>
                                            

                                
                            </div>
                        </div>
                    @endforeach
                    @endif
                    </div>
            </div>







            <div class="row" data-toggle="collapse" data-target="#detailsCollapse" style="cursor: pointer;">

                <div class="col-md-12">
                    <h4 class="mt-5" style="color:#e55123;">

                        Additional Details - {{ count($StudentBiodata) + count($findings) }}
                        <button class="btn btn-secondary btn-sm float-right" type="button" data-toggle="collapse"
                            data-target="#detailsCollapse" aria-expanded="false" aria-controls="detailsCollapse">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </h4>
                </div>
            </div>

                        <!-- @php
                    $Screeningform = form_entry::where('screeningFormId', $form_id)
                    ->orWhere('id', $form_id)
                    ->get()
                    ->toArray(); 
                
                    @endphp -->
            @if (!empty($findings))
                @foreach ($findings as $key => $findingsData)

                    <div class="row collapse" id="detailsCollapse">

                        <div class="col-md-12">
                            <h4 class="mt-5" style="color:#e55123;">
                                @if ($key == 0)
                                    {{-- Additional Details --}}
                                @endif
                            </h4>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Date of Encounter:</label>
                                <span
                                    class="fs_15 font-weight-bolder ml-2 text-dark">{{ \Carbon\Carbon::parse($findingsData['created_at'])->format('d M Y, H:i') }}</span>
                            </div>
                        </div>


                        @php
                          

                          
                        @endphp



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Number of Encounter :</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">{{$findingsData['count']}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Encounter Type:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">Screened Form</span>
                            </div>
                        </div>

                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Encounter with:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                    @php 
                                    $UserDetails = user::where('id', $findingsData['created_by'])->first();
                                    @endphp
                                {{$UserDetails['fullname'] }}
                                </span>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Reportables:</label>

                                             <span class="fs_15 font-weight-bolder ml-2 text-dark">{{$findingsData['questions_with_answers']}}</span>
                                            

                                {{-- <span class="fs_15 font-weight-bolder ml-2 text-dark"></span> --}}
                            </div>
                        </div>

                    </div>
                @endforeach
            @endif

            @if (!empty($StudentBiodata))
                @foreach ($StudentBiodata as $key => $StudentBiodat)
                    <div class="row collapse" id="detailsCollapse">

                        <div class="col-md-12">
                            <h4 class="mt-5" style="color:#e55123;">
                                @if ($key == 0)
                                    {{-- Additional Details --}}
                                @endif
                            </h4>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Date of Encounter:</label>
                                <span
                                    class="fs_15 font-weight-bolder ml-2 text-dark">{{ \Carbon\Carbon::parse($StudentBiodat['created_at'])->format('d M Y, H:i') }}</span>
                            </div>
                        </div>


                        @php

                            $CountTotal = 0;
                            $CountLow = 0;
                            $CountHigh = 0;

                            $SchoolHealthPhysician5 = SchoolHealthPhysician::where('deleted', 0)
                                ->where('StudentBiodataId', $StudentBiodat['id'])
                                ->first();
                            if (!empty($SchoolHealthPhysician5)) {
                                $Blood_pressure_result = $SchoolHealthPhysician5['Blood_pressure_result'];

                                if ($Blood_pressure_result == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($Blood_pressure_result == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }

                                $BloodPressureDiastolicResult = $SchoolHealthPhysician5['BloodPressureDiastolicResult'];

                                if ($BloodPressureDiastolicResult == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($BloodPressureDiastolicResult == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }

                                $TemperatureResult = $SchoolHealthPhysician5['TemperatureResult'];

                                if ($TemperatureResult == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($TemperatureResult == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }

                                $PulseResult = $SchoolHealthPhysician5['PulseResult'];

                                if ($PulseResult == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($PulseResult == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }

                                $RespiratoryRateResult = $SchoolHealthPhysician5['RespiratoryRateResult'];

                                if ($RespiratoryRateResult == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($RespiratoryRateResult == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }

                                $WeightResult = $SchoolHealthPhysician5['WeightResult'];

                                if ($WeightResult == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($WeightResult == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }

                                $HeightResult = $SchoolHealthPhysician5['WeightResult'];

                                if ($HeightResult == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($HeightResult == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }

                                $BMIResult = $SchoolHealthPhysician5['BMIResult'];

                                if ($BMIResult == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($BMIResult == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }
                            }

                            $NutritionistHistoryEvaluationSection2 = NutritionistHistoryEvaluationSection::where(
                                'deleted',
                                0,
                            )
                                ->where('StudentBiodataId', $StudentBiodat['id'])
                                ->first();

                            if (!empty($NutritionistHistoryEvaluationSection2)) {
                                $HeightResult1 = $NutritionistHistoryEvaluationSection2['HeightResult1'];

                                if ($HeightResult1 == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($HeightResult1 == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }

                                $WeightResult1 = $NutritionistHistoryEvaluationSection2['WeightResult1'];

                                if ($WeightResult1 == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($WeightResult1 == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }

                                $BMIResult1 = $NutritionistHistoryEvaluationSection2['BMIResult1'];

                                if ($BMIResult1 == 'Low') {
                                    $CountLow += 1;
                                    $CountTotal += 1;
                                }
                                if ($BMIResult1 == 'High') {
                                    $CountHigh += 1;
                                    $CountTotal += 1;
                                }
                            }
                        @endphp



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Number of Encounter :</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">{{ $CountTotal }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Encounter Type:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">Medical History</span>
                            </div>
                        </div>

                        @php

                            $StudentBiodat_created_by_updated_by =
                                $StudentBiodat['created_by'] == 0
                                    ? $StudentBiodat['updated_by']
                                    : $StudentBiodat['created_by'];

                            $UserDetails = user::where('id', $StudentBiodat_created_by_updated_by)->first();

                        @endphp
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Encounter with:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                    @if (!empty($UserDetails))
                                        {{ $UserDetails['fullname'] }}
                                    @endif
                                </span>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Reportables:</label>

                                @php

                                    /* School Health Physician */

                                    $SchoolHealthPhysician5 = SchoolHealthPhysician::where('deleted', 0)
                                        ->where('StudentBiodataId', $StudentBiodat['id'])
                                        ->first();

                                    if (!empty($SchoolHealthPhysician5)) {
                                        $Blood_pressure_result = $SchoolHealthPhysician5['Blood_pressure_result'];

                                        if ($Blood_pressure_result == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Blood Pressure (Systolic) Low</span>';
                                        }
                                        if ($Blood_pressure_result == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Blood Pressure (Systolic) High</span>';
                                        }

                                        $BloodPressureDiastolicResult =
                                            $SchoolHealthPhysician5['BloodPressureDiastolicResult'];

                                        if ($BloodPressureDiastolicResult == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Blood Pressure (Diastolic) Low </span>';
                                        }
                                        if ($BloodPressureDiastolicResult == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Blood Pressure (Diastolic) High</span>';
                                        }

                                        $TemperatureResult = $SchoolHealthPhysician5['TemperatureResult'];

                                        if ($TemperatureResult == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Temperature  Low </span>';
                                        }
                                        if ($TemperatureResult == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Temperature  High</span>';
                                        }

                                        $PulseResult = $SchoolHealthPhysician5['PulseResult'];

                                        if ($PulseResult == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Pulse   Low </span>';
                                        }
                                        if ($PulseResult == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Pulse   Low </span>';
                                        }

                                        $RespiratoryRateResult = $SchoolHealthPhysician5['RespiratoryRateResult'];

                                        if ($RespiratoryRateResult == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Respiratory Rate   Low </span>';
                                        }
                                        if ($RespiratoryRateResult == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Respiratory Rate   Low </span>';
                                        }

                                        $WeightResult = $SchoolHealthPhysician5['WeightResult'];

                                        if ($WeightResult == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Weight   Low </span>';
                                        }
                                        if ($WeightResult == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Weight   Low </span>';
                                        }

                                        $HeightResult = $SchoolHealthPhysician5['WeightResult'];

                                        if ($HeightResult == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Height    Low </span>';
                                        }
                                        if ($HeightResult == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Height    Low </span>';
                                        }

                                        $BMIResult = $SchoolHealthPhysician5['BMIResult'];

                                        if ($BMIResult == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">BMI   Low </span>';
                                        }
                                        if ($BMIResult == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">BMI   Low </span>';
                                        }
                                    }

                                    /* Nutritionist History & Evaluation Section */

                                    $NutritionistHistoryEvaluationSection2 = NutritionistHistoryEvaluationSection::where(
                                        'deleted',
                                        0,
                                    )
                                        ->where('StudentBiodataId', $StudentBiodat['id'])
                                        ->first();

                                    if (!empty($NutritionistHistoryEvaluationSection2)) {
                                        $HeightResult1 = $NutritionistHistoryEvaluationSection2['HeightResult1'];

                                        if ($HeightResult1 == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Height (cm)Low</span><br>';
                                        }
                                        if ($HeightResult1 == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Height (cm) Low</span><br>';
                                        }

                                        $WeightResult1 = $NutritionistHistoryEvaluationSection2['WeightResult1'];

                                        if ($WeightResult1 == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Weight (kg) Low</span><br>';
                                        }
                                        if ($WeightResult1 == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">Weight (kg)  Low</span><br>';
                                        }

                                        $BMIResult1 = $NutritionistHistoryEvaluationSection2['BMIResult1'];

                                        if ($BMIResult1 == 'Low') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">BMI (auto-generated)  Low</span><br>';
                                        }
                                        if ($BMIResult1 == 'High') {
                                            echo '<span class="fs_15 font-weight-bolder ml-2 text-dark">BMI (auto-generated) Low</span><br>';
                                        }
                                    }

                                @endphp

                                {{-- <span class="fs_15 font-weight-bolder ml-2 text-dark"></span> --}}
                            </div>
                        </div>

                    </div>
                @endforeach
            @endif


            {{-- @if (!empty($Prescription)) --}}

            <div class="row" data-toggle="collapse" data-target="#prescriptionCollapse" style="cursor: pointer;">

                <div class="col-md-12">
                    <h4 class="mt-5" style="color:#e55123;">


                        Prescription - {{ count($Prescription) }}

                        <button class="btn btn-secondary btn-sm float-right" type="button" data-toggle="collapse"
                            data-target="#prescriptionCollapse" aria-expanded="false"
                            aria-controls="prescriptionCollapse">
                            <i class="fas fa-chevron-down"></i>
                        </button>

                    </h4>
                </div>
            </div>

            {{-- @endif --}}


            @if (!empty($Prescription))
                @foreach ($Prescription as $key => $Prescriptio)
                    <div class="row collapse" id="prescriptionCollapse">

                        <div class="col-md-12">
                            <h4 class="mt-5" style="color:#e55123;">


                                @if ($key == 0)
                                    {{-- Prescription --}}
                                @endif
                            </h4>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Date:</label>
                                <span
                                    class="fs_15 font-weight-bolder ml-2 text-dark">{{ \Carbon\Carbon::parse($Prescriptio['created_at'])->format('d M Y, H:i') }}</span>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Doctor:</label>

                                @php
                                    $detailsUser = user::find($Prescriptio['DoctorID']);
                                @endphp


                                <span
                                    class="fs_15 font-weight-bolder ml-2 text-dark">{{ $detailsUser['fullname'] ?? '' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Reason:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark"> {{ $Prescriptio['Reason'] ?? '' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Prescription:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                    {{ $Prescriptio['Prescription'] ?? '' }} </span>
                            </div>
                        </div>


                    </div>
                @endforeach
            @endif



            <div class="row" data-toggle="collapse" data-target="#aidsCollapse" style="cursor: pointer;">
                <div class="col-md-12">
                    <h4 class="mt-5" style="color:#e55123;">
                        Aids - {{ count($Aids) }}
                        <!-- Toggle button for collapse -->
                        <button class="btn btn-secondary btn-sm float-right" type="button" data-toggle="collapse"
                            data-target="#aidsCollapse" aria-expanded="false" aria-controls="aidsCollapse">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </h4>
                </div>
            </div>

            <!-- Collapsible content -->
            <div class="col-md-12 collapse" id="aidsCollapse">
                @if (!empty($Aids))
                    @foreach ($Aids as $key => $Aid)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="fs_15 font-weight-bolder">Date:</label>
                                    <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                        {{ \Carbon\Carbon::parse($Aid['created_at'])->format('d M Y, H:i') }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="fs_15 font-weight-bolder">Doctor:</label>
                                    @php
                                        $detailsUser = user::find($Aid['DoctorID']);
                                    @endphp
                                    <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                        {{ $detailsUser['fullname'] ?? '' }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="fs_15 font-weight-bolder">Reason:</label>
                                    <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                        {{ $Aid['Reason'] ?? '' }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="fs_15 font-weight-bolder">Aids:</label>
                                    <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                        {{ $Aid['Aids'] ?? '' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>



            <!-- Collapsible toggle header -->
            <div class="row" data-toggle="collapse" data-target="#labsCollapse" style="cursor: pointer;">
                <div class="col-md-12">
                    <h4 class="mt-5" style="color:#e55123;">
                        Labs - {{ count($Labs) }}
                        <!-- Add an icon to indicate collapse/expand state -->

                        <button class="btn btn-secondary btn-sm float-right" type="button" data-toggle="collapse"
                            data-target="#labsCollapse" aria-expanded="false" aria-controls="aidsCollapse">
                            <i class="fas fa-chevron-down"></i>
                        </button>

                    </h4>
                </div>
            </div>

            <!-- Collapsible content -->
            @if (!empty($Labs))
                @foreach ($Labs as $key => $Lab)
                    <div class="row collapse" id="labsCollapse">
                        <div class="col-md-12">
                            <h4 class="mt-5" style="color:#e55123;">
                                @if ($key == 0)
                                    {{-- Labs --}}
                                @endif
                            </h4>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Date:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                    {{ \Carbon\Carbon::parse($Lab['created_at'])->format('d M Y, H:i') }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Title:</label>
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                    {{ $Lab['title'] ?? '' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Uploaded By:</label>
                                @php
                                    $detailsUser = user::find($Lab['created_by']);
                                @endphp
                                <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                    {{ $detailsUser['fullname'] ?? '' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="fs_15 font-weight-bolder">Documents:</label>
                                @if (!empty($Lab['document_names']))
                                    @php
                                        $documents = explode('|', $Lab['document_names']);
                                    @endphp
                                    <ul>
                                        @foreach ($documents as $document)
                                            <li>
                                                <a href="{{ asset('uploads/labs/reports/' . $document) }}"
                                                    target="_blank">
                                                    {{ $document }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="fs_15 font-weight-bolder ml-2 text-dark">
                                        No documents available
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif




        </div>
    </section>

    <script>
        $(document).ready(function() {

            document.getElementById('prescriptionForm').addEventListener('submit', function(event) {
                var submitButton = document.getElementById('submitButton');
                submitButton.disabled = true; // Disable the button
                submitButton.innerHTML = 'Processing...'; // Change button text
            });

            document.getElementById('aidsForm').addEventListener('submit', function(event) {
                var submitButton1 = document.getElementById('submitButton1');
                submitButton1.disabled = true; // Disable the button
                submitButton1.innerHTML = 'Processing...'; // Change button text
            });

            document.getElementById('labsForm').addEventListener('submit', function(event) {
                var submitButton2 = document.getElementById('submitButton2');
                submitButton2.disabled = true; // Disable the button
                submitButton2.innerHTML = 'Processing...'; // Change button text
            });



            $(document).on('click', '.ScreeningAnchor', function() {

                var id = $(this).data('id');
                console.log('id ' + id);


                var base_url = '{!! Route('GeneralInfo') !!}';
                console.log("base_url " + base_url);
                $.ajax({
                    url: base_url,
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        // Handle success response
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.log('Error:', error);
                    }

                });


            });
        });
    </script>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#changeImageBtn').click(function() {
            $('#uploadModal').modal('show');
        });

        $(".FolowUpCount").html($(".followupsContentCount").length);
    });
</script>
