@extends('layouts.template')

@section('title', 'Update Profile')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row-md-8">
            <div class="">
            <span class="login100-form-title p-b-32">
                <div class="card-header">{{ __('Update Profile') }}</div>
            </span>
                <div>
                    <a class="btn btn" href="/back">
                        <b><h4>{{ __('Cancel') }}</h4></b>
                    </a>
                </div>

                <style>
                    .card-header{
                        color: maroon;
                    }
                </style>
                <div class="card-body">
                    <form method="POST" action="/users/updateStud/{{$student->id}}">
                        @csrf

                        @if(session()->has('Success'))
                            <div class="alert alert-success alert-block" role="">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="card-body">
                                    {{session()->get('Success')}}
                                </div>
                            </div>
                        @endif


                        <div class="form-group row">
                            <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ $student->fname}}" required autocomplete="fname" autofocus>

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
                                <input id="other" type="text" class="form-control @error('other') is-invalid @enderror" name="other" value="{{ $student->other }}" required autocomplete="name" autofocus>

                                @error('other')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @foreach($studs as $stud)
                        <div id="extra" name="extra">
                            <div class="form-group row" id="">
                                <label for="std_number" class="col-md-4 col-form-label text-md-right">{{ __('Student Number') }}</label>

                                <div class="col-md-6">
                                    <input id="std_number" type="text" class="form-control @error('std_number') is-invalid @enderror" name="std_number" value="{{ $stud->std_number }}" required autocomplete="std_number" autofocus>

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
                                    <input id="reg_number" type="text" class="form-control @error('reg_number') is-invalid @enderror" name="reg_number" value="{{ $stud->reg_number }}" required autocomplete="reg_number" autofocus>

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
                                    <input id="course" type="text" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ $stud->course }}" required autocomplete="course" autofocus>

                                    @error('course')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ $student->gender }}" required autocomplete="gender" autofocus>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                        </div>
                          <div class="form-group row">

                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">


                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ $student->phonenumber }}" required autocomplete="number" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $student->email }}" required autocomplete="email">

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
                                    {{ __('UPDATE') }}
                                </button>
                            </div>
                        </div> <br>
                        <div class="form-group row mb-0">
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn" onclick="location.href='/Student'">
                                    {{ __('Back') }}
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
