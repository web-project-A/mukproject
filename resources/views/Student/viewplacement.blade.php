
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
                    <div class="form">
                         <div class="card">
                            <div class="container"><br>
                            <h5> @php echo $upload_check; @endphp </h5>
                        </div>
                           
                            @foreach($upload as $upload)
                            @if($upload->user_id == $user->id)
                                <h4 class="card-header"><strong>Uploaded Documents</strong></h4>
                                @break
                            @endif
                        @endforeach
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                    <div class="card-body card-block">
                            @foreach($file as $file)
                                @if($file->user_id == $user->id)
                                    <div class="container">
                                    <a href="/Student/view/{{ $file->id }}/{{ $file->user_id }}"><h6>{{ $file->name }}</h6> </a>
                                    </div>              
                                @endif
                            @endforeach               
                     </div>                         
                    </div> 
                </div> 
                    <br>
                    @foreach($display as $display)
                    @if($display->user_id == $user->id)
                   
                    <button type="submit" class="btn btn-primary" style="float:right;" onclick="location.href='/Student'">Back</button>      
                        @break
                    @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection
