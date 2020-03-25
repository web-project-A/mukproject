@extends('layouts.stud')

@section('title', 'Daily Journal')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">

    <div class="card">
        <div class="card-header"><strong><h3>DAILY JOURNAL</h3></strong></div>
            <div class="card-body card-block">
            @foreach($student as $stud)
                <form method="POST" action="/fillJournal/{{$stud->std_number}}">

                    {{ csrf_field() }}
                    @if(session()->has('Success'))
                            <div class="alert alert-success alert-block" role="">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="card-body">
                                    {{session()->get('Success')}}
                                </div>
                            </div>
                        @endif

                    <div class="form-group"><label for="fname" class=" form-control-label">{{ __("Student's First Name") }}</label><input name="fname" value="{{ $stud->fname}}" type="text" id="fname" required class="form-control @error('fname') is-invalid @enderror">
                        @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group"><label for="other_name" class=" form-control-label">{{ __("Student's Other Names") }}</label><input name="other_name" value="{{$stud->other_name}}" type="text" id="other_name" required class="form-control @error('other_name') is-invalid @enderror">
                        @error('other_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>     
                    
                    <div class="form-group"><label for="reg_number" class=" form-control-label">{{ __("Student's Registration Number") }}</label><input name="reg_number" value="{{$stud->reg_number}}" type="text" id="reg_number" required class="form-control @error('reg_number') is-invalid @enderror">
                        @error('reg_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>                                 

                    <div class="form-group"><label for="course" class=" form-control-label">{{ __("Course") }}</label><input name="course" value="{{$stud->course}}" type="text" id="course" required class="form-control @error('course') is-invalid @enderror">
                        @error('course')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="phoneCode" class=" form-control-label">{{ __("Student's Phone Code") }}</label><input name="phoneCode" value="{{$stud->phoneCode}}" type="text" id="phoneCode" required class="form-control @error('phoneCode') is-invalid @enderror">
                        @error('phoneCode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="number" class=" form-control-label">{{ __("Student's Phone Number") }}</label><input name="number" value="{{$stud->number}}" type="text" id="number" required class="form-control @error('number') is-invalid @enderror">
                        @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="email" class=" form-control-label">{{ __("Student's Email Address") }}</label><input name="email" value="{{$stud->email}}" type="text" id="email" required class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="org_name" class=" form-control-label">{{ __("Name of the Organisation") }}</label><input name="org_name" value="{{$stud->organisation}}" type="text" id="org_name" required class="form-control @error('org_name') is-invalid @enderror">
                        @error('org_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="org_address" class=" form-control-label">{{ __("Organisation Address") }}</label><input name="org_address" value="" type="text" id="org_address" required class="form-control @error('org_address') is-invalid @enderror">
                        @error('org_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="org_number" class=" form-control-label">{{ __("Organisation Phone Number") }}</label><input name="org_number" value="" type="text" id="org_number" required class="form-control @error('org_number') is-invalid @enderror">
                        @error('org_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="field_supervisor_fname" class=" form-control-label">{{ __("Field Supervisor's First Name") }}</label><input name="field_supervisor_fname" value="{{$stud->field_supervisor_fname}}" type="text" id="field_supervisor_fname" required class="form-control @error('field_supervisor_fname') is-invalid @enderror">
                        @error('field_supervisor_fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>  

                    <div class="form-group"><label for="field_supervisor_other" class=" form-control-label">{{ __("Field Supervisor's Other Names") }}</label><input name="field_supervisor_other" value="{{$stud->field_supervisor_other}}" type="text" id="field_supervisor_other" required class="form-control @error('field_supervisor_other') is-invalid @enderror">
                        @error('field_supervisor_other')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                    @endforeach

                    <div class="form-group"><label for="academic_supervisor_fname" class=" form-control-label">{{ __("Academic Supervisor's First Name") }}</label><input name="academic_supervisor_fname" value="" type="text" id="academic_supervisor_fname" required class="form-control @error('academic_supervisor_fname') is-invalid @enderror">
                        @error('academic_supervisor_fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>         

                    <div class="form-group"><label for="academic_supervisor_other" class=" form-control-label">{{ __("Academic Supervisor's Other Names") }}</label><input name="academic_supervisor_other" value="" type="text" id="academic_supervisor_other" required class="form-control @error('academic_supervisor_other') is-invalid @enderror">
                        @error('academic_supervisor_other')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>                                    
                    
                    <button type="submit" class="btn btn-primary" >Submit</button>
                    <button type="reset" class="btn btn-primary">Refresh</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection 


