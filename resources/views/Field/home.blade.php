@extends('layouts.field')
@section('title', 'Field Supervisor')
@section('content')
 <!-- Page Wrapper -->
 <div id="wrapper">

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  @if(!empty($journals))
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
                    <button type="" class="btn btn-primary" onclick="location.href='/viewStudentDetails/{{$student->id}}'">Details</button>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <!-- /.container-fluid -->

  <h1 class="h3 mb-2 text-gray-800">UNASSESSED DAILY JOURNALS</h1>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>Date</th>
                      <th>Task Completed</th>
                      <th>Task in Progress</th>
                      <th>Next Day's Tasks</th>
                      <th>Problems/challenges</th>
                      <th>Field Supervisor's Comment</th>
                      <th>Score</th>
                  </tr>
              </thead>
            <tbody>
            @foreach($journals as $journal)
              <tr>
                  <td>{{$journal->date}}</td>
                  <td>{{$journal->task_completed}}</td>
                  <td>{{$journal->task_in_progress}}</td>
                  <td>{{$journal->next_day_tasks}}</td>
                  <td>{{$journal->problems}}</td>
                  <td>{{$journal->field_supervisor_comments}}</td>
                  <td>{{$journal->score}}</td>
                  <td>           
                    <a href="/Field/viewjournals2/{{$journal->id}}">
                        <button type="" class="btn btn-primary" >Edit</button>
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
  <!-- End of Main Content -->

  </div>
  <!-- End of Page Wrapper -->
  
  @else
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
                    <button type="" class="btn btn-primary" onclick="location.href='/viewStudentDetails/{{$student->id}}'">Details</button>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  </div>
  <!-- End of Page Wrapper -->
  @endif
@endsection
