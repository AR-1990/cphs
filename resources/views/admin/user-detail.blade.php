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
    </style>
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">
                        Dashboard
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

            <a href="" class="btn btn-primary">Download PDF</a>


            <div class="table-responsive">
                <div class="container-fluid mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="data_heading">
                                <h3>Bio Data</h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="Name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                        value="" disabled>
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                        value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">

                                    <div class="form-group">
                                        <label for="school">School</label>
                    
                                                <input type="text" name="school" id="school" class="form-control"
                                                value="" disabled>
                                        
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                                <input type="text" name="gender" id="gender" class="form-control"
                                                value="" disabled>
                                        
                                    </div>
                                </div>
                                <div class="form-group col-md-6">

                                    <div class="form-group">
                                        <label for="area">Area</label>
                                                <input type="text" name="area" id="area" class="form-control"
                                                value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                        value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="text" class="form-control" id="age" name="age"
                                            value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="contact">Emergency Contact Number</label>
                                        <input type="text" class="form-control" id="Emergency_Contact_Number"
                                            name="Emergency_Contact_Number" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="contact">GR Number</label>
                                        <input type="text" class="form-control" id="Gr_Number" name="Gr_Number"
                                            value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="Medical_condition">Any Known Medical Condition</label>
                                        <input type="text" class="form-control" id="Any_Known_Medical_Condition"
                                            name="Any_Known_Medical_Condition" value="" disabled>
                                    </div>
                                </div>



                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="Address"
                                        value="" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group</label>
                                        <input type="text" name="blood_group" id="blood_group" class="form-control"
                                            value="" disabled>
                                    </div>
                                </div>
                                <div class="form-roup col-md-6">
                                    <div class="form-group">
                                        <label for="comment">Comment/Findings</label><br>
                                        <input type="text" name="bio_data_comment" id="bio_data_comment"
                                            class="form-control" value="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                      
                        {{-- <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="duration">DURATION</label><br>
                                <input type="text" name="duration" id="duration" class="form-control" value="1973" disabled>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>


    

        

    </div>

    </div>

    
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

