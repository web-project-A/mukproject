@extends('layouts.template')

@section('title', 'Update Profile')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row-md-8">
            <div class="">
            <span class="login100-form-title p-b-32">
                <div class="card-header">{{ __('Update Profile') }}</div>
                <style>
                    .card-header{
                      color: maroon;
                    }
                </style>
            </span>
                <style>
                    .card-header{
                        color: maroon;
                    }
                </style>
                <div class="card-body">
                    <form method="POST" action="/users/update">
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
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ $user->fname}}" required autocomplete="fname" autofocus>

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
                                <input id="other" type="text" class="form-control @error('other') is-invalid @enderror" name="other" value="{{ $user->other }}" required autocomplete="name" autofocus>

                                @error('other')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ $user->gender }}" required autocomplete="gender" autofocus>
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

                            <label for="phoneCode" class="col-md-4 col-form-label text-md-right">{{ __('Phone Code') }}</label>
                            <div class="col-md-6">

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


                                @error('number')
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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

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
