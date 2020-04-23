
@extends('layouts.stud')

@section('title', 'Student')
@section('content')
<style type="text/css">
        	.st{
        		color: green;
        	}
        </style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card">
                        @foreach($upload as $upload)
                            @if($upload->user_id == $user->id)
                                <h4 class="card-header"><strong>Uploaded Documents</strong></h4>
                                @break
                            @endif
                        @endforeach
                        <div class="">
                            @foreach($file as $file)
                                @if($file->user_id == $user->id)
                                    <div class="container">
                                    <a href="/Student/view/{{ $file->id }}/{{ $file->user_id }}"><h6>{{ $file->name }}</h6> </a>
                                    </div>              
                                @endif
                            @endforeach               
                        </div>                        
                    </div> <br>
                    @foreach($display as $display)
                    @if($display->user_id == $user->id)
                    <a class="btn btn-primary" href="/Student/placementletter">{{ __('Re-upload') }}</a> 
                        @break
                    @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
