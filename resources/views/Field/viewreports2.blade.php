@extends('layouts.field')

@section('title', 'Weekly Progress Report')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">

    <div class="card">
        <div class="card-header"><strong><h3>Weekly Progress Report of {{$fname}} {{$other}}</h3></strong></div>
            <div class="card-body card-block">
                @foreach($reports as $report)
                <form method="POST" action="/fieldFillReport/{{$report->id}}">

                    {{ csrf_field() }}
                    @if(session()->has('Success'))
                            <div class="alert alert-success alert-block" role="">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="card-body">
                                    {{session()->get('Success')}}
                                </div>
                            </div>
                        @endif

                    <div class="form-group"><label for="date" class=" form-control-label">{{ __("Date") }}</label><input name="date" value="{{ $report->date }}" type="date" id="date" required class="form-control @error('date') is-invalid @enderror">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group"><label for="task_completed" class=" form-control-label">{{ __("Task Completed") }}</label><textarea rows="10" cols="30" name="task_completed" value="{{ $report->task_completed }}" type="text" id="task_completed" required class="form-control @error('task_completed') is-invalid @enderror">{{ $report->task_completed }}</textarea>
                        @error('task_completed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group"><label for="task_in_progress" class=" form-control-label">{{ __("Tasks in Progress") }}</label><textarea rows="10" cols="30" name="task_in_progress" value="{{ $report->task_in_progress }}" type="text" id="task_in_progress" required class="form-control @error('task_in_progress') is-invalid @enderror">{{ $report->task_in_progress }}</textarea>
                        @error('task_in_progress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>     
                    
                    <div class="form-group"><label for="next_day_tasks" class=" form-control-label">{{ __("Next Day's Tasks") }}</label><textarea rows="10" cols="30" name="next_day_tasks" value="{{ $report->next_day_tasks }}" type="text" id="next_day_tasks" required class="form-control @error('next_day_tasks') is-invalid @enderror">{{ $report->next_day_tasks }}</textarea>
                        @error('next_day_tasks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>                                 

                    <div class="form-group"><label for="problems" class=" form-control-label">{{ __("Problems/challenges") }}</label><textarea rows="10" cols="30" name="problems" value="{{ $report->problems }}" type="text" id="problems" required class="form-control @error('problems') is-invalid @enderror">{{ $report->problems }}</textarea>
                        @error('problems')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="field_comment" class=" form-control-label">{{ __("Field Supervisor's Comment") }}</label><textarea rows="10" cols="30" name="field_comment" value="{{ $report->field_supervisor_comments }}" type="text" id="field_comment" required class="form-control @error('field_comment') is-invalid @enderror">{{ $report->field_supervisor_comments }}</textarea>
                        @error('field_comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 
                    
                    <button type="submit" class="btn btn-primary" >Edit</button>
                    <button type="reset" class="btn btn-primary">Refresh</button>
                </form>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 


