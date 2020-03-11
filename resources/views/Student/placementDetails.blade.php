@extends('layouts.stud')

@section('title', 'Placement Details')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header"><strong><h3>PLACEMENT</h3></strong></div>
            <div class="card-body card-block">
                <form method="post" action="/registeragent">
                    {{ csrf_field() }}
                    <div class="form-group"><label for="field_supervisor_fname" class=" form-control-label"></label><input name="field_supervisor_fname" type="text" id="field_supervisor_fname" placeholder="Enter Field Supervisor's First Name" required class="form-control"></div>
                    <div class="form-group"><label for="field_supervisor_lname" class=" form-control-label"></label><input name="field_supervisor_lname" type="text" id="field_supervisor_lname" placeholder="Enter Field Supervisor's Last Name" required class="form-control"></div>
                    <div class="form-group"><label for="organisation" class=" form-control-label"></label><input name="organisation" type="text" id="organisation" placeholder="Enter Organisation's Name" required class="form-control"></div>
                    
                    <div class="form-group"><label for="start_date" class=" form-control-label"></label><input name="start_date" type="text" id="start_date" placeholder="Fill Start Date (yyyy/MM/dd)" required class="form-control"></div>
                    <div class="form-group"><label for="end_date" class=" form-control-label"></label><input name="end_date" type="text" id="end_date" placeholder="Fill End Date (yyyy/MM/dd)" required class="form-control"></div>

                    <button type="submit" class="btn btn-primary" >Submit</button>
                    <button type="reset" class="btn btn-primary">Refresh</button>                         
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-header"><strong><h3>ORGANISATION DETAILS</h3></strong></div>
            <div class="card-body card-block">
                <form method="post" action="/registeragent">
                    {{ csrf_field() }}
                    <div class="form-group"><label for="field_supervisor_fname" class=" form-control-label"></label><input name="field_supervisor_fname" type="text" id="field_supervisor_fname" placeholder="Enter Field Supervisor's First Name" required class="form-control"></div>
                    <div class="form-group"><label for="field_supervisor_lname" class=" form-control-label"></label><input name="field_supervisor_lname" type="text" id="field_supervisor_lname" placeholder="Enter Field Supervisor's Last Name" required class="form-control"></div>
                    <div class="form-group"><label for="organisation" class=" form-control-label"></label><input name="organisation" type="text" id="organisation" placeholder="Enter Organisation's Name" required class="form-control"></div>

                    <div class="form-group"><label for="start_date" class=" form-control-label"></label><input name="start_date" type="text" id="start_date" placeholder="Fill Start Date (yyyy/MM/dd)" required class="form-control"></div>
                    <div class="form-group"><label for="end_date" class=" form-control-label"></label><input name="end_date" type="text" id="end_date" placeholder="Fill End Date (yyyy/MM/dd)" required class="form-control"></div>

                    <button type="submit" class="btn btn-primary" >Submit</button>
                    <button type="reset" class="btn btn-primary">Refresh</button>                         
                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection