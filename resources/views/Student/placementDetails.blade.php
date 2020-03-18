@extends('layouts.stud')

@section('title', 'Placement Details')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header"><strong><h3>PLACEMENT</h3></strong></div>
            <div class="card-body card-block">
                <form method="POST" action="/Studentplacement/{{$student->std_number}}">

                    {{ csrf_field() }}
                    @if(session()->has('Success'))
                            <div class="alert alert-success alert-block" role="">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="card-body">
                                    {{session()->get('Success')}}
                                </div>
                            </div>
                        @endif

                    <div class="form-group"><label for="field_supervisor_fname" class=" form-control-label">{{ __("Field Supervisor's First Name") }}</label><input name="field_supervisor_fname" type="text" id="field_supervisor_fname" placeholder="" required class="form-control @error('field_supervisor_fname') is-invalid @enderror"></div>
                    @error('field_supervisor_fname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group"><label for="field_supervisor_other" class=" form-control-label">{{ __("Field Supervisor's Other Names") }}</label><input name="field_supervisor_other" type="text" id="field_supervisor_lname" placeholder="" required class="form-control @error('field_supervisor_other') is-invalid @enderror"></div>
                    @error('field_supervisor_other')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                    
                    <div class="form-group"><label for="start_date" class=" form-control-label">{{ __('Start Date') }}</label><input name="start_date" type="date" id="start_date" placeholder="yyyy/MM/dd" required class="form-control @error('start_date') is-invalid @enderror"></div>
                    @error('start_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group"><label for="end_date" class=" form-control-label">{{ __('End Date') }}</label><input name="end_date" type="date" id="end_date" placeholder="yyyy/MM/dd" required class="form-control @error('end_date') is-invalid @enderror"></div>
                    @error('end_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

            </div>

                    <div class="card-header"><strong><h3>ORGANISATION DETAILS</h3></strong></div>
                    <div class="card-body card-block">
                     <!--need to place google map feature-->
                     <div class="form-group"><label for="organisation" class=" form-control-label">{{ __('Name') }}</label><input name="organisation" type="text" id="organisation" placeholder="" required class="form-control @error('organisation') is-invalid @enderror"></div>
                     @error('organisation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group"><label for="address" class=" form-control-label">{{ __('Address') }}</label><input name="address" type="text" id="address" placeholder="" required class="form-control @error('address') is-invalid @enderror"></div>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!--end of google map feature-->
                    <div class="form-group"><label for="additional_information" class=" form-control-label">{{ __('Additional Address Information') }}</label><input name="additional_information" type="text" id="additional_information" placeholder="" required class="form-control @error('additional_information') is-invalid @enderror"></div>
                    @error('additional_information')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    

                    <div class="form-group"><label for="region" class=" form-control-label">{{ __('Region') }}</label>

                        <select id="region" type="text" class="form-control @error('region') is-invalid @enderror" name="region" placeholder="Enter Region of Organisation" required autocomplete="region">
                            <option value="Kampala Region">Kampala Region</option>
                            <option value="Northern Region">Northern Region</option>
                            <option value="Western Region">Western Region</option>
                            <option value="Rest of Central Region">Rest of Central Region</option>
                            <option value="Eastern Region">Eastern Region</option>
                            <option value="Entebbe Region">Entebbe Region</option>
                        </select>
                        @error('region')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                    </div>

                    <div class="form-group"><label for="city" class=" form-control-label">{{ __('City') }}</label><input name="city" type="text" id="city" placeholder="" required class="form-control @error('city') is-invalid @enderror"></div>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    

                    <div class="form-group"><label for="contact" class=" form-control-label">{{ __('Phone Number') }}</label><input name="contact" type="text" id="contact" placeholder="" required class="form-control @error('contact') is-invalid @enderror"></div>
                    @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group"><label for="email" class=" form-control-label">{{ __('E-mail Address') }}</label><input name="email" type="text" id="email" placeholder="" required class="form-control @error('email') is-invalid @enderror"></div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <button type="submit" class="btn btn-primary" >Submit</button>
                    <button type="reset" class="btn btn-primary">Refresh</button>                         
                </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection