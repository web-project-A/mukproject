@extends('layouts.stud')

@section('title', 'Placement Letter')

@section('content')
<div class="container">

    <div class="form1">
        <div class="card">
            <div class="card-header"><h3><strong>UPLOAD FILE</strong></h3></div>

                <div class="card-body card-block">
                    <form method="post" action="/placementletter/{{ $user->id}}" enctype="multipart/form-data">
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
                                  <input type="file" name="file" class="form">
                            </div>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button type="reset" class="btn btn-primary">Refresh</button>
                    </form>
                     
                </div>
            </div>
        </div>
    </div>
    <div>


</div>
@endsection
