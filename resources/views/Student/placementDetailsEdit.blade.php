@extends('layouts.stud')

@section('title', 'Placement Details')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">

    <div class="card">
        <div class="card-header"><strong><h3>PLACEMENT</h3></strong></div>
            <div class="card-body card-block">
                <form method="POST" action="/Studentplacementedit/{{$student->id}}">

                    {{ csrf_field() }}
                    @if(session()->has('Success'))
                            <div class="alert alert-success alert-block" role="">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="card-body">
                                    {{session()->get('Success')}}
                                </div>
                            </div>
                        @endif             
                    
                    @foreach($fields as $field)
                    <div class="form-group"><label for="field_supervisor_fname" class=" form-control-label">{{ __("Field Supervisor's First Name") }}</label><input name="field_supervisor_fname" value="{{ $field->fname }}" type="text" id="field_supervisor_fname" placeholder="" required class="form-control @error('field_supervisor_fname') is-invalid @enderror">
                        @error('field_supervisor_fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group"><label for="field_supervisor_other" class=" form-control-label">{{ __("Field Supervisor's Other Names") }}</label><input name="field_supervisor_other" value="{{ $field->other }}" type="text" id="field_supervisor_lname" placeholder="" required class="form-control @error('field_supervisor_other') is-invalid @enderror">
                        @error('field_supervisor_other')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>       

                    <div class="form-group"><label for="phonenumber" class=" form-control-label">{{ __("Field Supervisor's Phone Number") }}</label><input name="phonenumber" value="{{ $field->phonenumber }}" type="text" id="phonenumber" placeholder="" required class="form-control @error('phonenumber') is-invalid @enderror">
                        @error('phonenumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>      

                    <div class="form-group"><label for="field_email" class=" form-control-label">{{ __("Field Supervisor's Email Address") }}</label><input name="field_email" value="{{ $field->email }}" type="text" id="field_email" placeholder="" required class="form-control @error('field_email') is-invalid @enderror">
                        @error('field_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                    @endforeach

                    @foreach($studs as $stud)
                    <div class="form-group"><label for="start_date" class=" form-control-label">{{ __('Start Date') }}</label><input name="start_date" value="{{ $stud->start_date }}" type="date" id="start_date" placeholder="yyyy/MM/dd" required class="form-control @error('start_date') is-invalid @enderror">
                        @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group"><label for="end_date" class=" form-control-label">{{ __('End Date') }}</label><input name="end_date" value="{{ $stud->end_date }}" type="date" id="end_date" placeholder="yyyy/MM/dd" required class="form-control @error('end_date') is-invalid @enderror">
                        @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @endforeach

            </div>

                    <div class="card-header"><strong><h3>ORGANISATION DETAILS</h3></strong></div>
                    <div class="card-body card-block">
                     <!--need to place google map feature-->
                     @foreach($orgs as $org)

                     <div class="form-group"><label for="organisation" class=" form-control-label">{{ __('Name') }}</label><input name="organisation" value="{{ $org->name }}" type="text" id="organisation" placeholder="" required class="form-control @error('organisation') is-invalid @enderror">
                        @error('organisation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group"><label for="address" class=" form-control-label">{{ __('Address') }}</label><input name="address" value="{{ $org->address }}" type="text" id="address" placeholder="" required class="form-control @error('address') is-invalid @enderror">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!--end of google map feature-->
                    <div class="form-group"><label for="additional_information" class=" form-control-label">{{ __('Additional Address Information') }}</label><input name="additional_information" value="{{ $org->additional_address_info }}" type="text" id="additional_information" placeholder="" required class="form-control @error('additional_information') is-invalid @enderror">
                        @error('additional_information')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>


                    <div class="form-group"><label for="region" class=" form-control-label">{{ __('Region') }}</label>
                    <input name="region" value="{{ $org->region }}" type="text" id="region" placeholder="" required class="form-control @error('region') is-invalid @enderror">
                        @error('region')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                    </div>

                    <div class="form-group"><label for="town" class=" form-control-label">{{ __('Town') }}</label>
                    <input name="town" value="{{ $org->town }}" type="text" id="town" placeholder="" required class="form-control @error('town') is-invalid @enderror">
                        @error('town')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>


                    <div class="form-group"><label for="contact" class=" form-control-label">{{ __('Phone Number') }}</label><input name="contact" value="{{ $org->phonenumber }}" type="text" id="contact" placeholder="" required class="form-control @error('contact') is-invalid @enderror">
                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group"><label for="email" class=" form-control-label">{{ __('E-mail Address') }}</label><input name="email" value="{{ $org->email }}" type="text" id="email" placeholder="" required class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary" >Edit</button>
                    <button type="reset" class="btn btn-primary">Refresh</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection 


