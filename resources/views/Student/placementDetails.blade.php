@extends('layouts.stud')

@section('title', 'Placement Details')

@section('content')
<div class="container">
    <style>
    .form1{
       float:left;
       margin-left:40px;
    }
    .form2{
       float:right;
       margin-right:150px;
    }
    </style>

    <div class="form1">
        <div class="card">
            <div class="card-header"><strong><h3>PLACEMENT</h3></strong></div>
                <div class="card-body card-block">
                    <form method="POST" action="/Studentplacement">
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

                        <div class="form-group"><label for="start_date" class=" form-control-label">{{ __('Start Date') }}</label><input name="start_date" type="text" id="start_date" placeholder="yyyy/MM/dd" required class="form-control"></div>
                        <div class="form-group"><label for="end_date" class=" form-control-label">{{ __('End Date') }}</label><input name="end_date" type="text" id="end_date" placeholder="yyyy/MM/dd" required class="form-control"></div>

                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button type="reset" class="btn btn-primary">Refresh</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>

   <div class="form2">
    <div class="container">
        <div class="card">
            <div class="card-header"><strong><h3>ORGANISATION DETAILS</h3></strong></div>
                <div class="card-body card-block">
                    <form method="POST" action="/Studentorg">
                        {{ csrf_field() }}
                        <!--need to place google map feature-->
                        <div class="form-group"><label for="address" class=" form-control-label">{{ __('Organisation Address') }}</label><input name="address" type="text" id="address" placeholder="" required class="form-control"></div>
                        <!--end of google map feature-->
                        <div class="form-group"><label for="additional_information" class=" form-control-label">{{ __('Additional Address Information') }}</label><input name="additional_information" type="text" id="additional_information" placeholder="" required class="form-control"></div>


                        <div class="form-group"><label for="region" class=" form-control-label">{{ __('Enter Region of Organisation') }}</label>
                            <select id="region" type="text" class="form-control @error('region') is-invalid @enderror" name="region" placeholder="Enter Region of Organisation" required autocomplete="region">
                                <option value="Kampala Region">Kampala Region</option>
                                <option value="Northern Region">Northern Region</option>
                                <option value="Western Region">Western Region</option>
                                <option value="Rest of Central Region">Rest of Central Region</option>
                                <option value="Eastern Region">Eastern Region</option>
                                <option value="Entebbe Region">Entebbe Region</option>
                            </select>
                        </div>

                        <div class="form-group"><label for="city" class=" form-control-label">{{ __('City of Organisation') }}</label><input name="city" type="text" id="city" placeholder="" required class="form-control"></div>

                        <div class="form-group"><label for="contact" class=" form-control-label">{{ __("Organisation's Contact") }}</label><input name="contact" type="text" id="contact" placeholder="" required class="form-control" size="30"></div>
                        <div class="form-group"><label for="email" class=" form-control-label">{{ __("Organisation's E-mail") }}</label><input name="email" type="text" id="email" placeholder="" required class="form-control"></div>

                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button type="reset" class="btn btn-primary">Refresh</button>
                    </form>
                </div>
            </div>
        </div>
   </div>

</div>
@endsection
