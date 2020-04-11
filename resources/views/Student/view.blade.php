@extends('layouts.stud')

@section('title', 'File')

@section('content')
<div class="container">
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
                    <form method="post"  action="/delete/{{$upload->name}}">
                            @csrf 
                            <div class="container">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Delete') }}
                                </button>      
                            </div>
                        
                        </form>     
                </div>
            </div>
        </div>
    </div>
    <div>
</div>
@endsection
