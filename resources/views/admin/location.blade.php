@extends('admin.main')
@section('content')
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>
                
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Location

                        </li>

                    </ol>

                </div>
            </div>
            <div class="row" role="tablist">
                <div class="col-auto">
                    <!-- <a href="{{ url('/module') }}" class="btn btn-outline-secondary"><i class="fa fa-plus"></i> &nbsp; Add Student</a> -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">  <i class="fas fa-user-plus"></i>Add Location </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->

    <div class="container page__container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Location</div>
        </div>
        <div class="card mb-0">
            <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-employee-name"
                data-lists-values='["js-lists-values-employee-name", "js-lists-values-employer-name", "js-lists-values-projects", "js-lists-values-activity", "js-lists-values-earnings"]'>
                <div class="card-header">
                    <form class="form-inline">
                        <input type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0" id="inlineFormFilterBy"
                            placeholder="Search ...">
                    </form>
                </div>
                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Contact
                            </th>

                            <th>
                                City
                            </th>

                            <th>
                                Registration Date
                            </th>
                            <th>
                                Fee Status
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list" id="staff">

                        <tr>

                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Dummy Name
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">123-123-1234</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">Boston</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">03 May, 2023</td>
                            <td class="js-lists-values-earnings small">Paid</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Dummy Name
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">123-123-1234</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">Boston</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">03 May, 2023</td>
                            <td class="js-lists-values-earnings small">Paid</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Dummy Name
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">123-123-1234</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">Boston</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">03 May, 2023</td>
                            <td class="js-lists-values-earnings small">Paid</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Dummy Name
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">123-123-1234</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">Boston</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">03 May, 2023</td>
                            <td class="js-lists-values-earnings small">Paid</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">

                                    <div class="media-body">

                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-employee-name">
                                                    Dummy Name
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="text-70"><span
                                            class="js-lists-values-employer-name">
                                            dummyemail@gmail.com
                                        </span></a>
                                </div>
                            </td>

                            <td class="text-center js-lists-values-projects small">123-123-1234</td>

                            <td>

                                <a href="javascript:void(0);" class="text-70">Boston</a>

                            </td>

                            <td class="text-70 js-lists-values-activity small">03 May, 2023</td>
                            <td class="js-lists-values-earnings small">Paid</td>
                            <td class="js-lists-values-earnings small">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="javascript:void(0);" class="delete-alert">
                                    <i class="material-icons">delete</i>
                                </a>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer p-8pt">

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

    </div>

    <!-- Add Student Modal  -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" required>
                        </div>
                       
                        <div class="form-group">
                            <label for="selectOption">Blood Group</label>
                            <select class="form-control" id="selectOption">
                                <option value="">Choose...</option>
                                <option value="option1">O positive</option>
                                <option value="option2">O negative</option>
                                <option value="option3">A positive</option>
                                <option value="option3">A negative</option>
                                <option value="option3">B positive</option>
                                <option value="option3">B negative</option>
                                <option value="option3">AB positive</option>
                                <option value="option3">AB negative</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="age">Gender</label>
                            <input type="text" class="form-control" id="phone" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="submitStudent"> 
                        <!-- <i class="fas fa-check"></i> -->
                        Submit</button>
                </div>
            </div>
        </div>
    </div>
    

    <!-- // END Page Content -->
@endsection
