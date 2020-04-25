@extends('layouts.stud')
@section('title', 'Weekly Progress Report')
@section('content')
 <!-- Page Wrapper -->
 <div id="wrapper">

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">REPORTS</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">

    @if(session()->has('Success'))
        <div class="alert alert-success alert-block" role="">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <div class="card-body">
                    {{session()->get('Success')}}
                </div>
        </div>
    @endif

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Task Completed</th>
                    <th>Tasks in Progress</th>
                    <th>Next Day's Tasks</th>
                    <th>Problems/challenges</th>
                </tr>
            </thead>
          <tbody>
          @foreach($reports as $report)
            <tr>
                <td>{{$report->date}}</td>
                <td>{{$report->task_completed}}</td>
                <td>{{$report->task_in_progress}}</td>
                <td>{{$report->next_day_tasks}}</td>
                <td>{{$report->problems}}</td>
                <td>
                    <a href="/Student/reportedit1/{{$report->id}}">
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Page Wrapper -->

@endsection
