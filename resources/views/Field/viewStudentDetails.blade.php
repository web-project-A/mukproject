@extends('layouts.field')
@section('title', 'Student Details')
@section('content')
<!-- Details -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">DETAILS</h3>
    </div>
    <div class="card-body">
    @foreach($students as $student)
        <h5>First Name: <i><b>{{$student->fname}}</b></i></h5>
        <h5>Last Name: <i><b>{{$student->other}}</b></i></h5>
        <h5>Gender: <i><b>{{$student->gender}}</b></i></h5>
        <h5>Email Address: <i><b>{{$student->email}}</b></i></h5>
        <h5>Phone Number: <i><b>{{$student->phonenumber}}</b></i></h5>
        <h5>Student's Number: <i><b>{{$student->std_number}}</b></i></h5>
        <h5>Registration Number: <i><b>{{$student->reg_number}}</b></i></h5>
        <h5>Course: <i><b>{{$student->course}}</b></i></h5>
        <h5>Start Date: <i><b>{{$student->start_date}}</b></i></h5>
        <h5>End Date: <i><b>{{$student->end_date}}</b></i></h5>
    @endforeach
    </div>
</div>

@endsection