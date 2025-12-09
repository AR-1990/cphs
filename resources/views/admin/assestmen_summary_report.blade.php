@extends('admin.main')
@section('content')

<div class="container-fluid page__container page__container page-section" style="max-width: 100% !important;">
<div class="pt-32pt">
    <div class="d-flex flex-column flex-md-row align-items-center text-center text-sm-left mx-auto">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Dashboard</h2>
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">
                        Assestment-summary-report
                    </li>
                </ol>
            </div>
        </div>
        <form class="fromtosearch" method="GET" action="{{route('admin.assesment-summary-report')}}">
            <label for="start_date">
                <span class="d-block">From</span>
                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="">
            </label>
            <label for="end_date">
                <span class="d-block">To</span>
                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" value="">
            </label>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>    

<div class="row justify-content-center">
        <div class="col-md-12 py-5">
            <div class="page-separator">
                <div class="page-separator__text"> Assestment-summary-report</div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>School Name</th>
                                    <th>Total</th>
                                    @foreach($types as $type)
                                        <th>{{ $type }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $row)
                                    <tr>
                                        <td>{{ $row['school'] }}</td>
                                        <td><button class="btn" data-school="{{ $row['school'] }}" data-title="Total">{{ $row['total'] }}</button></td>
                                        @foreach($types as $type)
                                            <td>
                                                <button class="btn-primary btn-sm followup-btn"
                                                    data-school="{{ $row['school'] }}" 
                                                    data-title="{{ $type }}"
                                                    data-type="{{ $type }}"
                                                    data-count="{{ $row[$type] }}" style="border: 1px solid #d86744; color: #d86744; background: none; font-weight: 600;">
                                                    {{ $row[$type] }}
                                                </button>
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($types) + 2 }}" class="text-center">No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="studentsModal" tabindex="-1" role="dialog" aria-labelledby="studentsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="studentsModalLabel">Student Details</h5>
          </div>
          <div class="modal-body">
            <div id="studentsModalContent"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success btn-sm mr-2" id="exportExcelBtn">Export to Excel</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >
            close
            </button>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
    const allDetails = @json($data);
    let lastModalStudents = [];
    let lastModalTitle = '';
    let lastModalSchool = '';

    function exportToCSV(students, title, school) {
        if (!students.length) return;
        let csv = 'Name,Phone,Show Details Link\n';
        students.forEach(stu => {
            let name = (stu.name ?? '').replace(/,/g, ' ');
            let phone = (stu.phone ?? '').replace(/,/g, ' ');
            let link = (stu.redirect_link ?? '').replace(/,/g, ' ');
            csv += `"${name}","${phone}","${link}"\n`;
        });
        let blob = new Blob([csv], { type: 'text/csv' });
        let url = window.URL.createObjectURL(blob);
        let a = document.createElement('a');
        a.href = url;
        a.download = `${school}_${title}_students.csv`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    }

    $(document).ready(function() {
        $('.followup-btn').on('click', function() {
            const school = $(this).data('school');
            const type = $(this).data('type');
            const count = $(this).data('count');
            let students = [];
            let schoolRow = allDetails.find(row => row.school === school);
            if (schoolRow && schoolRow[type + '_students']) {
                students = schoolRow[type + '_students'];
            }
            lastModalStudents = students;
            lastModalTitle = type;
            lastModalSchool = school;
            let html = `<h5>${type} - ${school}</h5>`;
            if (students.length > 0) {
                html += `<table class='table table-bordered'><thead><tr><th>Name</th><th>Phone</th><th>Show Details</th></tr></thead><tbody>`;
                students.forEach(stu => {
                    html += `<tr>
                        <td>${stu.name ?? ''}</td>
                        <td>${stu.phone ?? ''}</td>
                        <td><a href="${stu.redirect_link}" target="_blank" class="btn btn-success btn-sm">Show Details</a></td>
                    </tr>`;
                });
                html += `</tbody></table>`;
            } else {
                html += `<div class='alert alert-info'>No students found for this follow-up type.</div>`;
            }
            $('#studentsModalContent').html(html);
            $('#studentsModal').modal('show');
        });
        // Optionally, handle total-btn click for all students in the school
        $('#exportExcelBtn').on('click', function() {
            exportToCSV(lastModalStudents, lastModalTitle, lastModalSchool);
        });
    });
</script>
@endsection 