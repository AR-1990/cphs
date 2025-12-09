@extends('admin.main')
@section('content')
<style>
    @media (min-width:992px) {
    .mdk-drawer-layout .container, .mdk-drawer-layout .container-fluid, .mdk-drawer-layout .container-lg, .mdk-drawer-layout .container-md, .mdk-drawer-layout .container-sm, .mdk-drawer-layout .container-xl {
        max-width: 1440px;
    }
}
.link{
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
    .mdk-drawer-layout .container, .mdk-drawer-layout .container-fluid, .mdk-drawer-layout .container-lg, .mdk-drawer-layout .container-md, .mdk-drawer-layout .container-sm, .mdk-drawer-layout .container-xl {
        max-width: 1600px!important;
    }
}
.bg_blue{
    background-color: #1c3866;
}
.fs_15 {
    font-size: 17px;
    color: #1F3864;
}
label{
    color: #5b626b;
}
.hidden {
        display: none !important;
    }
</style>
<section>
    <div class="container">
        
        {{-- <div class="ml-auto mt-4">
            <button class="btn btn-primary ml-auto d-block">Add Visit <span class="material-icons sidebar-menu-icon ml-2">add</span</button>
        </div> --}}

        @if(Session::has('error_message'))


        <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
            {{--<strong>Error ! </strong> --}}
            {{Session::get('error_message')}}.
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                    data-bs-original-title="" title=""></button>
        </div>

    @endif

    @if(Session::has('success_message'))

        <div class="alert alert-success dark alert-dismissible fade show" role="alert">
            {{--<strong>Success ! </strong>--}}
            {{Session::get('success_message')}}.
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


            <form action="{{Route('follow-up')}}/{{$id}}" method="post">
                @csrf

                <input type="hidden" value="{{$id}}" name="stdId">
                <h4 class="mt-5" style="color:#e55123;">Follow Up</h4>
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="mb-1 row ms-0 align-items-center">
                            <label for="example-text-input" class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Name :</label>
                            <div class="col-md-9">
                                <label for="example-text-input" class="col-md-6 col-form-label mt-1 fs_15">{{$details->name}}</label>
                            </div>
                        </div>
                       
                        <div class="mb-1 row ms-0 align-items-center">
                            <label for="example-text-input" class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">GR No :</label>
                            <div class="col-md-9">
                                <label for="example-text-input" class="col-md-6 col-form-label mt-1 fs_15">{{$details->grno}}</label>
                            </div>
                        </div>
                        <div class="mb-1 row ms-0 align-items-center">
                            <label for="example-text-input" class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">School :</label>
                            <div class="col-md-9">
                                <label for="example-text-input" class="col-md-6 col-form-label mt-1 fs_15">{{$details->school}}</label>
                            </div>
                        </div>
                        <div class="mb-1 row ms-0 align-items-center">
                            <label for="diagnoses" class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Diagnoses :</label>
                            <div class="col-md-12">

                                @php
                                // echo "id ".$id;echo "<BR>";
                                // echo "diagnose ". $medicalComplain['diagnose'];

                                    // $medicalComplain = json_decode(json_encode($medicalComplain),true);
        // echo "<PRE>";
        // print_r($medicalComplain);
        // exit;
                                @endphp
                                <textarea class="form-control w-50" name="diagnose" id="diagnoses" rows="4" required>@if(!empty($medicalComplain) && !empty($medicalComplain->diagnose)) {{$medicalComplain->diagnose}} @endif</textarea>
                            </div>
                        </div>
                        <div class="mb-1 row ms-0 align-items-center">
                            <label for="next-follow-up" class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Next Follow Up :</label>
                            <div class="col-md-12">
                                <select class="form-control w-50" name="followupRequired" id="NextFollowUp" required>

                                    

                                    <option value="" >Please Select</option>
                                    <option value="yes" @if(!empty($medicalComplain) && !empty($medicalComplain->followupRequired) && $medicalComplain->followupRequired == "yes") selected @endif>Yes</option>
                                    <option value="no" @if(!empty($medicalComplain) && !empty($medicalComplain->followupRequired) && $medicalComplain->followupRequired == "no") selected @endif>No</option>
                                </select>
                            </div>
                        </div>
                       
                       
                    </div>
                    <div class="col-6">
                        <div>
                            <div class="mb-1 row ms-0 align-items-center">
                                <label for="example-text-input" class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Father Name :</label>
                                <div class="col-md-9">
                                    <label for="example-text-input" class="col-md-6 col-form-label mt-1 fs_15">{{$details->lname}}</label>
                                </div>
                            </div>
                            <div class="mb-1 row ms-0 align-items-center">
                                <label for="example-text-input" class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">MR No :</label>
                                <div class="col-md-9">
                                    <label for="example-text-input" class="col-md-6 col-form-label mt-1 fs_15">    
                                        {{$details->name}}
                                    </label>
                                </div>
                            </div>
                            <div class="mb-1 mt-5 row ms-0 align-items-center">
                                <label for="current-issue" class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Current Issue :</label><br>
                                <div class="col-md-12">
                                    <textarea class="form-control w-50" name="issue" id="current-issue" rows="4" required>@if(!empty($medicalComplain) && !empty($medicalComplain->issue)) {{$medicalComplain->issue}} @endif</textarea>
                                </div>
                            </div>
                            <div class="mb-1 row ms-0 align-items-center" id="SectionVisitDate">
                                <label for="calendarSection" class="col-md-3 col-form-label leaddetailslabel fs_15 font-weight-bolder">Calendar :</label><br>
                                <div class="col-md-12">
                                    <input class="form-control w-50" type="date" name="dateOfFolloup" id="calendarSection"
                                    
                                    @if(!empty($medicalComplain) && !empty($medicalComplain->dateOfFolloup)) value="{{$medicalComplain->dateOfFolloup}}"" @endif
                                    
                                    >
                                </div>
                            </div>

                            @if(empty($medicalComplain))
                            <input type="submit" class="btn btn-primary">
                           @endif
                            <a href="{{Route('GeneralInfo')}}/{{$id}}" class="btn btn-info">Back</a>
                        </div>
                    </div>
                </div>
            </form>
            {{-- <div class="row mt-5 align-items-center">
                <div class="d-flex">
                    <div>
                        <a href="{{url('Medical_Detail')}}/{{$form_id}}"><button class="btn btn-primary">Screening</button></a>
                    </div>
                    <div class="ml-2">
                        <button class="btn btn-primary">Presenting Complain</button>
                    </div>
                    <div class="ml-2">
                        <button class="btn btn-primary">Visit</button>
                    </div>
                </div>
               
            </div> --}}

    </div>
</section> 

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
               $(document).ready(function() {

                @if(!empty($medicalComplain) && !empty($medicalComplain->followupRequired) && $medicalComplain->followupRequired == "yes") 
                
                $('#SectionVisitDate').show();

                @else

                $('#SectionVisitDate').hide();

                @endif

                    $('#NextFollowUp').change(function() {
                        if ($('#NextFollowUp').val() === 'yes') {
                            $('#SectionVisitDate').show();
                            $('#calendarSection').attr('required',true);

                           
                        } else {
                            $('#SectionVisitDate').hide();
                            $('#calendarSection').val('');
                            $('#calendarSection').attr('required',false);
                            
                        }
                    });
                });    
</script>

