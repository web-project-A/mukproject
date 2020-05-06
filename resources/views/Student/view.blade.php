@extends('layouts.stud')

@section('title', 'File')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
    <div class="form">
        <div class="card">
            <div class="card-header"><h3><strong>File</strong></h3></div>
          
                <div class="card-body card-block">
               
                        {{ csrf_field() }}
                        @if(session()->has('Success'))
                                <div class="alert alert-success alert-block" role="">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <div class="card-body">
                                        {{session()->get('Success')}}
                                    </div>
                                </div>
                        @endif
                        <div class="container">
                        <h6>{{ $upload->name}}</h6> 
                        </div> 
                       <form method="get"  action="/view/{{$upload->name}}">
                           <div class="container">
                                <button type="submit" class="btn btn-primary" >View File</button>      
                           </div> 
                       </form>
                       <br>  
                       <form method="post" action="/delete/{{$upload->name}}/">
                        @csrf 
                        <div class="container">
                            <a class="btn btn-primary"  style="float:right;"  href="/Student/viewdocuments">{{ __('Back') }}</a> 
                            <button type="submit" onclick="return confirm('Are you sure? This will delete the current file.')" onclick="location.href='/Student/reupload'" class="btn btn-primary">Re-upload</button>      
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
