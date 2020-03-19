@extends('layouts.stud')

@section('title', 'Internship Details')

@section('content')
<div class="container">


    <div class="form1">
        <div class="card">
            <div class="card-header"><strong><h3>INTERNSHIP DETAILS</h3></strong></div>
                <div class="card-body card-block">
                    <form method="POST" action="/Studentinternshipdetails">
                        {{ csrf_field() }}
                        @if(session()->has('Success'))
                                <div class="alert alert-success alert-block" role="">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <div class="card-body">
                                        {{session()->get('Success')}}
                                    </div>
                                </div>
                            @endif
                        <div class="form-group"><label for="field_supervisor_fname" class=" form-control-label">{{ __("Field Supervisor's First Name") }}</label><input name="field_supervisor_fname" type="text" id="field_supervisor_fname" placeholder="" required class="form-control" size="30"></div>
                        <div class="form-group"><label for="field_supervisor_lname" class=" form-control-label">{{ __("Field Supervisor's Last Name") }}</label><input name="field_supervisor_lname" type="text" id="field_supervisor_lname" placeholder="" required class="form-control"></div>
                        <div class="form-group"><label for="organisation" class=" form-control-label">{{ __("Field Organisation's Name") }}</label><input name="organisation" type="text" id="organisation" placeholder="" required class="form-control"></div>



                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button type="reset" class="btn btn-primary">Refresh</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>


</div>
@endsection
