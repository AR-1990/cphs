@extends('admin.main')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css
">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css
">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js
"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js
"></script>

<style>
  
</style>
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>
                
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Students

                        </li>

                    </ol>

                </div>
            </div>
            
            <div class="row" role="tablist">
                <div class="col-auto">
                    <!-- <a href="{{ url('/module') }}" class="btn btn-outline-secondary"><i class="fa fa-plus"></i> &nbsp; Add Student</a> -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">  <i class="fas fa-user-plus"></i>Add Student </button>
                </div>
            </div>
        </div>
    </div>

    <body>
        <div class="table-container">
        <table id="example" class="table table-striped table-bordered" style="width:100%; color: black">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
              
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009-10-09</td>
                    <td>$1,200,000</td>
                </tr>
             
            </tbody>
          
        </table>
        </div>
        <script>
            $(document).ready(function() {
            var table = $('#example').DataTable({
                scrollY: '50vh', // 50% of viewport height, you can adjust this value as needed
                scrollX: true,   // Enable horizontal scrolling
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ]
            });
        });

        // Add a dropdown to select number of records to display
        $('#example').DataTable( {
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
        } );

        </script>

    <!-- Page Content -->

     {{-- <div class="container page__container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Students</div>
        </div>
        <div class="card mb-0">
            <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-employee-name"
                data-lists-values='["js-lists-values-employee-name", "js-lists-values-employer-name", "js-lists-values-projects", "js-lists-values-activity", "js-lists-values-earnings"]'>
                <div class="card-header">
                    <form class="form-inline">
                        <input type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0" id="inlineFormFilterBy"
                            placeholder="Search ...">
                    </form>
                </div> --}}
                {{-- <table class="table mb-0 thead-border-top-0 table-nowrap table-striped" >
                    <thead>
                        <tr> 
                            <th>
                                First Name
                            </th>

                            <th>
                                Last Name
                            </th>

                            <th>
                                Email
                            </th> --}}

                            <!-- <th>
                                Password
                            </th> -->

                            {{-- <th>
                                Phone
                            </th>
                            <th>
                                Gender
                            </th>
                            <th>
                                Age
                            </th>
                            <th>
                                Blood Group
                            </th>
                            <th>
                                Height
                            </th>
                            <th>
                                Weight
                            </th>
                            <th>
                                Grade
                            </th>
                            <th>
                                Guardian Name
                            </th>
                            <th>
                                Guardian Email
                            </th>
                            <th>
                                Guardian Phone
                            </th>
                            <th>
                                Guardian Relation
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list" id="staff" >

                    <tbody   class="table-lg" >                      
                        @foreach ($details as $value )
                            
                        <tr>
                            <td>{{$value->first_name}}</td>
                            <td>{{$value->last_name}}</td>
                            <td>{{$value->email}}</td>
                            <!-- <td>{{$value->password}}</td> -->
                            <td>{{$value->phone}}</td>
                            <td>{{$value->gender}}</td>
                            <td>{{$value->age}}</td>
                            <td>{{$value->blood_group}}</td>
                            <td>{{$value->height}}</td>
                            <td>{{$value->weight}}</td>
                            <td>{{$value->grade}}</td>
                            <td>{{$value->guardian_name}}</td>
                            <td>{{$value->guardian_email}}</td>
                            <td>{{$value->guardian_phone}}</td>
                            <td>{{$value->guardian_relation}}</td>
                            
                        </tr>                    
                        @endforeach
                        </tbody>
                    </tbody>
                </table>
            </div> --}}

            {{-- <div class="card-footer p-8pt">

                <ul class="pagination justify-content-start pagination-xsm m-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true" class="material-icons">chevron_left</span>
                            <span>Prev</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Page 1">
                            <span>1</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Page 2">
                            <span>2</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span>Next</span>
                            <span aria-hidden="true" class="material-icons">chevron_right</span>
                        </a>
                    </li>
                </ul>

            </div>

        </div>

    </div>  --}}

    <!-- Add Student Modal  -->
     {{-- <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                </div>
                <div class="modal-body">
    <form id="addStudentForm">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control" id="fname" required name="fname">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" class="form-control" id="lname" required name="lname">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="email" required autocomplete="off" name="email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" id="password" required autocomplete="off" name="password">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Phone">Phone</label>
                    <input type="number" class="form-control" id="phone" required name="phone">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Gender">Gender</label>
                    <input type="text" class="form-control" id="gender" required name="gender">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" required name="age"> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="selectOption">Blood Group</label>
                    <select class="form-control" id="bloodgroup" name="bloodgroup">
                        <option value="">Choose...</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="height">Height</label>
                    <input type="text" class="form-control" id="height" required name="height">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="text" class="form-control" id="weight" required name="weight">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Grade">Grade</label>
                    <input type="text" class="form-control" id="grade" required name="grade">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="guardian_name">Guardian Name</label>
                    <input type="text" class="form-control" id="guardian_name" required name="guardian_name">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="guardian_email">Guardian Email</label>
                    <input type="text" class="form-control" id="guardian_email" required name="guardian_email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="guardian_phone">Guardian Phone</label>
                    <input type="text" class="form-control" id="guardian_phone" required name="guardian_phone">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="guardian_relation">Guardian Relation</label>
                    <input type="text" class="form-control" id="guardian_relation" required name="guardian_relation">
                </div>
            </div>
        </div>
    </form>
</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="submitStudent" name="submitStudent"> 
                        <!-- <i class="fas fa-check"></i> -->
                    Submit</button>
                </div>
            </div>
        </div>
    </div>
      --}}
    
    <!-- // END Page Content -->
@endsection


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js
"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
$(document).ready(function(){
   
    
  $("#submitStudent").click(function(){
    let _token = $('meta[name="csrf-token"]').attr('content');
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var phone = document.getElementById("phone").value;
    var gender = document.getElementById("gender").value;
    var age = document.getElementById("age").value;
    var bloodgroup = document.getElementById("bloodgroup").value;
    var height = document.getElementById("height").value;
    var weight = document.getElementById("weight").value;
    var grade = document.getElementById("grade").value;
    var guardian_name = document.getElementById("guardian_name").value;
    var guardian_email = document.getElementById("guardian_email").value;
    var guardian_phone = document.getElementById("guardian_phone").value;
    var guardian_relation = document.getElementById("guardian_relation").value;
    
     var formData = new FormData();
                            formData.append('_token', _token);
                            formData.append('fname', fname);
                            formData.append('lname', lname);
                            formData.append('email', email);
                            formData.append('password', password);
                            formData.append('phone', phone);
                            formData.append('gender', gender);
                            formData.append('age', age);
                            formData.append('bloodgroup', bloodgroup);
                            formData.append('height', height);
                            formData.append('weight', weight);
                            formData.append('grade', grade);
                            formData.append('guardian_name', guardian_name);
                            formData.append('guardian_email', guardian_email);
                            formData.append('guardian_phone', guardian_phone);
                            formData.append('guardian_relation', guardian_relation);
                            $.ajax({
                                type: "post",
                                
                                url: "{{ route('admin.students.create') }}",
                                data: formData,
                                dataType: "json",
                                processData: false,
                                contentType: false,
                                cache: false,
                                success: function(response) {
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'success...',
                                     text: 'Successfully added',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })
                                    // document.getElementById("addStudentModal").reset();
                                    $('#addStudentModal').modal('hide');
                                    console.log(response);
                                },
                                error: function(e) {
                                    console.log(e);
                                }
                            });
    
  });
});
</script>