
@extends('layouts.placement')


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
                <div class="panel-heading"><h2 class="st">Student Dashboard</h2></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>Placement Details</h2>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
