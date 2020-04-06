
@extends('layouts.stud')

@section('title', 'Student')
@section('content')
 <!-- Page Wrapper -->
 <div id="wrapper">

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">ITEMS</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <tbody>
            <tr>
              <td>Placement Letter</td>
              <td><input type="checkbox" @php echo $upload_check; @endphp value="yes" class="btn btn-success btn-circle btn-sm"></td>
              <td>
                <button type="" class="btn btn-primary" >Edit</button>
              </td>
            </tr>
            <tr>
              <td>Placement Details</td>
              <td><input type="checkbox" @php echo $placement_check; @endphp  class="btn btn-success btn-circle btn-sm"></td>
              <td>
                <a href="/placementDetailsEdit">
                    <button type="" class="btn btn-primary" >Edit</button>
                </a>
              </td>
            </tr>
            <tr>
              <td>Daily Journal</td>
              <td><input type="checkbox" @php echo $daily_check; @endphp  class="btn btn-success btn-circle btn-sm"></td>
              <td>
                <a href="/dailyJournalEdit">
                    <button type="" class="btn btn-primary" >Edit</button>
                </a>
              </td>
            </tr>
            <tr>
              <td>Reports</td>
              <td>@php echo $report_number; @endphp</td>
              <td>
                <button type="" class="btn btn-primary" >Edit</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Page Wrapper -->

@endsection
