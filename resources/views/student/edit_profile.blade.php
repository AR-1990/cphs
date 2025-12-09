@extends('student.main')
@section('content')
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Profile</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/student_dashboard') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Edit Profile

                        </li>

                    </ol>

                </div>
            </div>

        </div>
    </div>

    <!-- BEFORE Page Content -->

    <!-- // END BEFORE Page Content -->

    <!-- Page Content -->

    <div class="container page__container page-section d-flex justify-content-center">
        <!-- <div class="page-separator">
                        <div class="page-separator__text">Basic Information</div>
                    </div> -->
        <div class="col-md-6 p-0">
            <form>
                <div class="form-group">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview"
                                style="background-image: url('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png');">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center p-0">
                    <label class="form-label">Alexander Watson</label>
                    <!-- <input type="text" class="form-control" value="Alexander" placeholder="Your first name ..."> -->
                </div>
                <!-- <div class="form-group">
                                <label class="form-label">Last name</label>
                                <input type="text" class="form-control" value="Watson" placeholder="Your last name ...">
                            </div> -->
                <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" value="alexander.watson@gmail.com"
                        placeholder="Your email address ..." disabled>
                    <!-- <small class="form-text text-muted">Note that if you change your email, you will have to
                                    confirm it again.</small> -->
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" value="">
                </div>
                <button class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>

    <!-- // END Page Content -->
@endsection
