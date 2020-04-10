@extends('layouts.stud')

@section('title', 'RE-UPLOAD')
@section('content')
<div class="container">
    <div class="form">
        <div class="card">
            <div class="card-header"><strong><h3>RE-UPLOAD FILE</h3></strong></div>
          
                <div class="card-body card-block">
                    <form method="post" action="/reupload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if(session()->has('Success'))
                                <div class="alert alert-success alert-block" role="">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <div class="card-body">
                                        {{session()->get('Success')}}
                                    </div>
                                </div>
                        @endif
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                         @endif

                            <div class="form-group">
                                  <input type="file" name="file" class="card">
                            </div>
                       
                        <button type="submit" class="btn btn-primary" >Submit</button>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>


</div>
@endsection
