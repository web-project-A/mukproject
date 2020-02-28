@extends('layouts.app')

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
                <div class="panel-heading"><h2 class="st">Academic Supervisor Dashboard</h2></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Welcome, this is the the Academic Supervisor Dashboard.</p>
                     You must be privileged to be here !
                </div>
            </div>
        </div>
    </div>
</div>
@endsection