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
                    @foreach($users as $user)
                    <form method="POST" action="/registration/{{ $user->id }}">
                    @endforeach
                        @csrf

                        <div class="form-group row">
                            <h5><i>Please set your password to proceed.</i></h5>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
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
