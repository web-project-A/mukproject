@extends('layouts.stud')

@section('title', 'Placement Details')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">

    <div class="card">
        <div class="card-header"><strong><h3>PLACEMENT</h3></strong></div>
            <div class="card-body card-block">
                <form method="POST" action="/Studentplacement/{{$student->id}}">

                    {{ csrf_field() }}
                    @if(session()->has('Success'))
                            <div class="alert alert-success alert-block" role="">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="card-body">
                                    {{session()->get('Success')}}
                                </div>
                            </div>
                        @endif

                    <div class="form-group"><label for="field_supervisor_fname" class=" form-control-label">{{ __("Field Supervisor's First Name") }}</label><input name="field_supervisor_fname" value="{{ old('field_supervisor_fname') }}" type="text" id="field_supervisor_fname" placeholder="" required class="form-control @error('field_supervisor_fname') is-invalid @enderror">
                        @error('field_supervisor_fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group"><label for="field_supervisor_other" class=" form-control-label">{{ __("Field Supervisor's Other Names") }}</label><input name="field_supervisor_other" value="{{ old('field_supervisor_other') }}" type="text" id="field_supervisor_lname" placeholder="" required class="form-control @error('field_supervisor_other') is-invalid @enderror">
                        @error('field_supervisor_other')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>     

                    <div class="form-group"><label for="phoneCode" class=" form-control-label">{{ __('Phone Code') }}</label>
                        <select id="phoneCode" type="text"  name="phoneCode" class="form-control @error('phoneCode') is-invalid @enderror" value="{{ old('phoneCode')}}" required autocomplete="phoneCode" autofocus>
                                      <option value="+256">+256</option>
                                      <option value="+254">+254</option>
                                      <option value="+257">+255</option>
                                      <option value="+253">+250</option>
                                      <option value="+253">+263</option>
                                      <option value="+253">+258</option>
                                      <option value="+253">+248</option>
                                      <option value="+253">+257</option>
                                      <option value="+253">+20</option>
                                      <option value="+253">+233</option>
                                      <option value="+253">+234</option>
                                      <option value="+253">+211</option>
                                      <option value="+253">+27</option>
                                      <option value="+253">+221</option>
                                      <option value="+253">+237</option>
                                      <option value="+253">+267</option>
                                      <option value="+253">+244</option>
                                      <option value="+253">+86</option>
                                      <option value="+253">+91</option>
                        </select>
                        @error('phoneCode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                    </div>   

                    <div class="form-group"><label for="phonenumber" class=" form-control-label">{{ __("Field Supervisor's Phone Number") }}</label><input name="phonenumber" value="{{ old('phonenumber') }}" type="text" id="phonenumber" placeholder="" required class="form-control @error('phonenumber') is-invalid @enderror">
                        @error('phonenumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>      

                    <div class="form-group"><label for="field_email" class=" form-control-label">{{ __("Field Supervisor's Email Address") }}</label><input name="field_email" value="{{ old('field_email') }}" type="text" id="field_email" placeholder="" required class="form-control @error('field_email') is-invalid @enderror">
                        @error('field_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>         
                    
                    <div class="form-group"><label for="start_date" class=" form-control-label">{{ __('Start Date') }}</label><input name="start_date" value="{{ old('start_date') }}" type="date" id="start_date" placeholder="yyyy/MM/dd" required class="form-control @error('start_date') is-invalid @enderror">
                        @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group"><label for="end_date" class=" form-control-label">{{ __('End Date') }}</label><input name="end_date" value="{{ old('end_date') }}" type="date" id="end_date" placeholder="yyyy/MM/dd" required class="form-control @error('end_date') is-invalid @enderror">
                        @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

            </div>

                    <div class="card-header"><strong><h3>ORGANISATION DETAILS</h3></strong></div>
                    <div class="card-body card-block">
                     <!--need to place google map feature-->
                    <div class="form-group"><label for="organisation" class=" form-control-label">{{ __('Name') }}</label><input name="organisation" value="{{ old('organisation') }}" type="text" id="organisation" placeholder="" required class="form-control @error('organisation') is-invalid @enderror">
                        @error('organisation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group"><label for="address" class=" form-control-label">{{ __('Address') }}</label><input name="address" value="{{ old('address') }}" type="text" id="address" placeholder="" required class="form-control @error('address') is-invalid @enderror">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!--end of google map feature-->
                    <div class="form-group"><label for="additional_information" class=" form-control-label">{{ __('Additional Address Information') }}</label><input name="additional_information" value="{{ old('additional_information') }}" type="text" id="additional_information" placeholder="" required class="form-control @error('additional_information') is-invalid @enderror">
                        @error('additional_information')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>


                    <div class="form-group"><label for="region" class=" form-control-label">{{ __('Region') }}</label>

                        <select id="region" type="text" class="form-control @error('region') is-invalid @enderror dynamic" name="region" value="{{ old('region') }}" data-dependent="city" required autocomplete="region">
                            <option value="">Select Region</option>
                            @foreach($regions as $region)
                            <option value="{{$region->region}}">{{$region->region}}</option>
                            @endforeach
                        </select>
                        @error('region')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                    </div>

                    <div class="form-group"><label for="city" class=" form-control-label">{{ __('City') }}</label>
                        <select name="city" value="{{ old('city') }}" type="text" id="city" required class="form-control @error('city') is-invalid @enderror">
                            <option value="">Select City</option>
                        </select>
                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>


                    <div class="form-group"><label for="contact" class=" form-control-label">{{ __('Phone Number') }}</label><input name="contact" value="{{ old('contact') }}" type="text" id="contact" placeholder="" required class="form-control @error('contact') is-invalid @enderror">
                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group"><label for="email" class=" form-control-label">{{ __('E-mail Address') }}</label><input name="email" value="{{ old('email') }}" type="text" id="email" placeholder="" required class="form-control @error('email') is-invalid @enderror">
                        @error('email')
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
@section('scripts')
<script>
$(document).ready(function(){
    $('.dynamic').change(function(){
        if($(this).val() != '')
        {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name = "_token"]').val();
            $.ajax({
                url:"{{route('StudentController.fetch')}}",
                method:"POST",
                data:{select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    $('#'+dependent).html(result);
                }
            })
        }
    });
});
</script>
@endsection

