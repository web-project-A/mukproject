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

        <br>
        <button onclick="showThis()" id="showThis" style"display: block"><i>Send Email</i></button>

        <div id="show" name="show" style="display: none">
            <form method="POST" action="/sendEmail/{{$student->email}}">
                        @csrf
                <div class="form-group"><textarea rows="5" cols="20" name="sendEmail" value="{{ old('sendEmail') }}" type="text" id="sendEemail" required class="form-control @error('sendEmail') is-invalid @enderror">{{ old('SendEmail') }}</textarea>
                    @error('problems')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   
                </div> 
                <button type="submit" class="login100-form-btn">{{ __('Send') }}</button>
            </form>
        </div>
        @endforeach
    </div>
</div>

@endsection
<script>
    function showThis() {
        if(document.getElementById('show').style.display == 'none'){
            document.getElementById('show').style.display = '';
            document.getElementById('showThis').style.display = 'none'
        }else{
            document.getElementById('show').style.display = 'none';
        }
    }
</script>
