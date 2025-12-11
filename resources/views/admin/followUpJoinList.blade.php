@extends('admin.main')
@section('content')
<style>
  @media (min-width:992px) {
    .mdk-drawer-layout .container,
    .mdk-drawer-layout .container-fluid,
    .mdk-drawer-layout .container-lg,
    .mdk-drawer-layout .container-md,
    .mdk-drawer-layout .container-sm,
    .mdk-drawer-layout .container-xl { max-width: 1200px; }
  }

   @media (min-width:992px) {

            .mdk-drawer-layout .container,
            .mdk-drawer-layout .container-fluid,
            .mdk-drawer-layout .container-lg,
            .mdk-drawer-layout .container-md,
            .mdk-drawer-layout .container-sm,
            .mdk-drawer-layout .container-xl {
                max-width: 1700px !important;
            }
        }

  div#datatable_filter {
    display: flex;
    justify-content: end;
    margin-right: 20px;
  }
  .dataTables_length,
  .dataTables_filter {
    margin: 20px 10px;
  }
  .page__container { padding-left: 12px; padding-right: 12px; }
  .table-responsive { overflow-x: auto; }
  #datatable { width: 100%; }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container page__container page-section">
    <div class="page-separator">
        <div class="page-separator__text">Follow Up (Join)</div>
    </div>
    <div class="card mb-0">
        <form id="DateFilterForm" method="GET" action="{{ Route('followUpJoinList') }}" class="row mb-3" style="padding: 10px;">
            <input type="hidden" name="schoolId" value="{{ request('schoolId') }}">
            <div class="col-md-3">
                <label>From Date</label>
                <input type="date" id="fromDate" name="fromDate" class="form-control" value="{{ request('fromDate') }}" />
            </div>
            <div class="col-md-3">
                <label>To Date</label>
                <input type="date" id="toDate" name="toDate" class="form-control" value="{{ request('toDate') }}" />
            </div>
            <div class="col-md-2" style="display:flex;align-items:flex-end;gap:8px;">
                <button type="submit" class="btn btn-primary">Apply</button>
                <a href="{{ Route('followUpJoinList') }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-stripped table-bordered datatable" id="datatable" style="width:100%">
                <thead>
                    <tr class="bg-primary white">
                        <th>S.no</th>
                        <th>GrNo</th>
                        <th>Name</th>
                        <th>School Name</th>
                        <th>ICD</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
$(function() {
  var base_url = '{!! Route('followUpJoinListDatatable') !!}';
  var schoolId = new URLSearchParams(window.location.search).get('schoolId');
  var table = $('#datatable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    paging: true,
    ordering: false,
    searching: true,
    info: false,
    language: { processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-light"></i>' },
    ajax: {
      type: 'POST',
      url: base_url,
      dataType: 'json',
      data: function(d) {
        if (schoolId) { d.schoolId = schoolId; }
        d.startDate = $('#fromDate').val() || '';
        d.endDate = $('#toDate').val() || '';
        d.fromDate = $('#fromDate').val() || '';
        d.toDate = $('#toDate').val() || '';
      }
    },
    columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex' },
      { data: 'GRNo', name: 'GRNo' },
      { data: 'name', name: 'name' },
      { data: 'School_Name', name: 'School_Name' },
      { data: 'icd', name: 'icd' },
      { data: 'created_at', name: 'created_at' },
      { data: 'action', name: 'action', searchable: false }
    ]
  });
  $('#datatable thead tr').clone(true).appendTo('#datatable thead');
  $('#datatable thead tr:eq(1) th').each(function(i) {
    var title = $(this).text().trim();
  var allow = ['GrNo','Name','School Name','ICD'];
    if (title === 'Created At' || title === 'Action') {
      $(this).html('');
      return;
    }
    var disabled = allow.indexOf(title) === -1;
    $(this).html('<input type="text" class="form-control form-control-sm" ' + (disabled ? 'disabled' : '') + ' placeholder="Search ' + title + '" />');
    $('input', this).on('input', function() { table.column(i).search(this.value).draw(); });
  });
});
</script>
@endsection
