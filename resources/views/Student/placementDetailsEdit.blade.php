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

                    <div class="form-group"><label for="city" class=" form-control-label">{{ __('City') }}</label>
                    <input name="city" value="{{ $org->city }}" type="text" id="city" placeholder="" required class="form-control @error('city') is-invalid @enderror">
                        @error('city')
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


