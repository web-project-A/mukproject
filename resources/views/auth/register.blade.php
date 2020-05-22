@extends('layouts.template')

@section('title', 'Register')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row-md-8">
            <div class="">
            <span class="login100-form-title p-b-32">

                <div class="card-header">{{ __('Register') }} </div>
                <style>
                .card-header{
                    color: maroon;
                }
                </style>
            </span>
                <div class="card-body">
                    <form method="POST" action="/registration">
                        @csrf

                        <div class="form-group row">
                            <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="other" class="col-md-4 col-form-label text-md-right">{{ __('Other Names') }}</label>

                            <div class="col-md-6">
                                <input id="other" type="text" class="form-control @error('other') is-invalid @enderror" name="other" value="{{ old('other') }}" required autocomplete="name" autofocus>

                                @error('other')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('Type of User') }}</label>

                            <div class="col-md-6">
                                <select onchange="checkIfStudent()" onmouseover="checkIfStudent()" id="user_type" type="text" class="form-control @error('std_number') is-invalid @enderror" name="user_type" value="{{ old('user_type') }}" required autocomplete="user_type" autofocus>
                                    <option id="" value="">Select User Type</option>
                                    <option id="Student" value="Student" {{ old('user_type') == "Student" ? 'selected' : '' }}>Student</option>
                                    <option id="Faculty Member" value="Faculty Member" {{ old('user_type') == "Faculty Member" ? 'selected' : '' }}>Faculty Member</option>
                                </select>
                                @error('std_number')
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="extra" name="extra" style="display: none">
                            <div class="form-group row" id="">
                                <label for="std_number" class="col-md-4 col-form-label text-md-right">{{ __('Student Number') }}</label>

                                <div class="col-md-6">
                                    <input id="std_number" type="text" class="form-control @error('std_number') is-invalid @enderror" name="std_number" value="{{ old('std_number') }}" autocomplete="std_number" autofocus>

                                    @error('std_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="">
                                <label for="reg_number" class="col-md-4 col-form-label text-md-right">{{ __('Registration Number') }}</label>

                                <div class="col-md-6">
                                    <input id="reg_number" type="text" class="form-control @error('reg_number') is-invalid @enderror" name="reg_number" value="{{ old('reg_number') }}" autocomplete="reg_number" autofocus>

                                    @error('reg_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="">
                                <label for="course" class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>

                                <div class="col-md-6">
                                    <select id="course" type="text" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}" autocomplete="course" autofocus>
                                        <option value="">Select Course</option>
                                        <option value="BSC" {{ old('course') == "BSC" ? 'selected' : '' }}>BSC</option>
                                        <option value="BSSE" {{ old('course') == "BSSE" ? 'selected' : '' }}>BSSE</option>
                                        <option value="BIST" {{ old('course') == "BIST" ? 'selected' : '' }}>BIST</option>
                                    </select>
                                    @error('course')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                    <option value="Male" {{ old('gender') == "Male" ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == "Female" ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phoneCode" class="col-md-4 col-form-label text-md-right">{{ __('Phone Code') }}</label>
                            <div class="col-md-6">
                                <input id="phoneCode" type="text"  name="phoneCode" class="form-control @error('phoneCode') is-invalid @enderror" value="{{ old('phoneCode')}}" required autocomplete="phoneCode" placeholder="+256" autofocus>
                                @error('phoneCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="number" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                            <span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						    </span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function checkIfStudent() {
        if(document.getElementById('user_type').value == 'Student'){
            document.getElementById('extra').style.display = '';
            document.getElementById('std_number').disabled = false;
            document.getElementById('reg_number').disabled = false;
            document.getElementById('course').disabled = false;
        }else{
            document.getElementById('extra').style.display = 'none';
            document.getElementById('std_number').disabled = true;
            document.getElementById('reg_number').disabled = true;
            document.getElementById('course').disabled = true;
        }
    }
</script>
@endsection
