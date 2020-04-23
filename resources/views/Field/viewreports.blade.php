@extends('layouts.field')
@section('title', 'Field Supervisor')
@section('content')
 <!-- Page Wrapper -->
 <div id="wrapper">

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">STUDENTS</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Student's Number</th>
                    <th>Registration Number</th>
                    <th>Course</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
          <tbody>
          @foreach($students as $student)
            <tr>
                <td>{{$student->fname}}</td>
                <td>{{$student->other}}</td>
                <td>{{$student->gender}}</td>
                <td>{{$student->email}}</td>
                <td>{{$student->phonenumber}}</td>
                <td>{{$student->std_number}}</td>
                <td>{{$student->reg_number}}</td>
                <td>{{$student->course}}</td>
                <td>{{$student->start_date}}</td>
                <td>{{$student->end_date}}</td>
                <td>
                    <a href="/Field/viewreports1/{{$student->id}}">
                        <button type="" class="btn btn-primary" >View Reports</button>
                    </a>
              </td>
            </tr>
            @endforeach
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
