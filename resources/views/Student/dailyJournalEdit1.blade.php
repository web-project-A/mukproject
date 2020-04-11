@extends('layouts.stud')

@section('title', 'Daily Journal')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">

    <div class="card">
        <div class="card-header"><strong><h3>DAILY JOURNAL</h3></strong></div>
            <div class="card-body card-block">
            
                <form method="POST" action="/editJournal/{{ $user->id }}">

                    {{ csrf_field() }}
                    @if(session()->has('Success'))
                            <div class="alert alert-success alert-block" role="">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="card-body">
                                    {{session()->get('Success')}}
                                </div>
                            </div>
                        @endif

                    <div class="form-group"><label for="org_name" class=" form-control-label">{{ __("Name of the Organisation") }}</label><input name="org_name" value="{{ old('org_name') }}" type="text" id="org_name" required class="form-control @error('org_name') is-invalid @enderror">
                        @error('org_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="org_address" class=" form-control-label">{{ __("Organisation Address") }}</label><input name="org_address" value="{{ old('org_address') }}"  type="text" id="org_address" required class="form-control @error('org_address') is-invalid @enderror">
                        @error('org_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="org_number" class=" form-control-label">{{ __("Organisation Phone Number") }}</label><input name="org_number" value="{{ old('org_number') }}"  type="text" id="org_number" required class="form-control @error('org_number') is-invalid @enderror">
                        @error('org_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="field_supervisor_fname" class=" form-control-label">{{ __("Field Supervisor's First Name") }}</label><input name="field_supervisor_fname" value="{{ old('field_supervisor_fname') }}" type="text" id="field_supervisor_fname" required class="form-control @error('field_supervisor_fname') is-invalid @enderror">
                        @error('field_supervisor_fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>  

                    <div class="form-group"><label for="field_supervisor_other" class=" form-control-label">{{ __("Field Supervisor's Other Names") }}</label><input name="field_supervisor_other" value="{{ old('field_supervisor_other') }}" type="text" id="field_supervisor_other" required class="form-control @error('field_supervisor_other') is-invalid @enderror">
                        @error('field_supervisor_other')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                    @endforeach

                    @foreach($logbooks as $logbook)
                    <div class="form-group"><label for="academic_supervisor_fname" class=" form-control-label">{{ __("Academic Supervisor's First Name") }}</label><input name="academic_supervisor_fname" value="{{ $logbook->academic_supervisor_fname }}" type="text" id="academic_supervisor_fname" required class="form-control @error('academic_supervisor_fname') is-invalid @enderror">
                        @error('academic_supervisor_fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>         

                    <div class="form-group"><label for="academic_supervisor_other" class=" form-control-label">{{ __("Academic Supervisor's Other Names") }}</label><input name="academic_supervisor_other" value="{{ $logbook->academic_supervisor_other }}" type="text" id="academic_supervisor_other" required class="form-control @error('academic_supervisor_other') is-invalid @enderror">
                        @error('academic_supervisor_other')
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


