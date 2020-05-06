@extends('layouts.field')
@section('title', 'Field Supervisor')
@section('content')
 <!-- Page Wrapper -->
 <div id="wrapper">

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->

  @if(session()->has('Success'))
        <div class="alert alert-success alert-block" role="">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <div class="card-body">
                    {{session()->get('Success')}}
                </div>
        </div>
    @endif

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
                    <th>Registration Number</th>
                    <th>Course</th>
                </tr>
            </thead>
          <tbody>
          @foreach($students as $student)
            <tr>
                <td>{{$student->fname}}</td>
                <td>{{$student->other}}</td>
                <td>{{$student->reg_number}}</td>
                <td>{{$student->course}}</td>
                <td>
                    <a href="/Field/viewjournals1/{{$student->id}}">
                        <button type="" class="btn btn-primary" >View Journals</button>
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
