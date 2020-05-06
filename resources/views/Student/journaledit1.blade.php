@extends('layouts.stud')

@section('title', 'Weekly Progress Report')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">

    <div class="card">
        <div class="card-header"><strong><h3>EDIT DAILY JOURNALS</h3></strong></div>
            <div class="card-body card-block">
                @foreach($journals as $journal)
                <form method="POST" action="/filljournalEdit/{{$journal->id}}">

                    {{ csrf_field() }}
                    @if(session()->has('Success'))
                            <div class="alert alert-success alert-block" role="">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="card-body">
                                    {{session()->get('Success')}}
                                </div>
                            </div>
                        @endif

                    <div class="form-group"><label for="date" class=" form-control-label">{{ __("Date") }}</label><input name="date" value="{{ $journal->date }}" type="date" id="date" required class="form-control @error('date') is-invalid @enderror">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group"><label for="task_completed" class=" form-control-label">{{ __("Task Completed") }}</label><textarea rows="10" cols="30" name="task_completed" value="{{ $journal->task_completed }}" type="text" id="task_completed" required class="form-control @error('task_completed') is-invalid @enderror">{{ $journal->task_completed }}</textarea>
                        @error('task_completed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group"><label for="task_in_progress" class=" form-control-label">{{ __("Tasks in Progress") }}</label><textarea rows="10" cols="30" name="task_in_progress" value="{{ $journal->task_in_progress }}" type="text" id="task_in_progress" required class="form-control @error('task_in_progress') is-invalid @enderror">{{ $journal->task_in_progress }}</textarea>
                        @error('task_in_progress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>     
                    
                    <div class="form-group"><label for="next_day_tasks" class=" form-control-label">{{ __("Next Day's Tasks") }}</label><textarea rows="10" cols="30" name="next_day_tasks" value="{{ $journal->next_day_tasks }}" type="text" id="next_day_tasks" required class="form-control @error('next_day_tasks') is-invalid @enderror">{{ $journal->next_day_tasks }}</textarea>
                        @error('next_day_tasks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>                                 

                    <div class="form-group"><label for="problems" class=" form-control-label">{{ __("Problems/challenges") }}</label><textarea rows="10" cols="30" name="problems" value="{{ $journal->problems }}" type="text" id="problems" required class="form-control @error('problems') is-invalid @enderror">{{ $journal->problems }}</textarea>
                        @error('problems')
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


