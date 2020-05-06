@extends('layouts.field')

@section('title', 'Daily Journals')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">

    <div class="card">
        <div class="card-header"><strong><h3>Daily Journal of {{$fname}} {{$other}}</h3></strong></div>
            <div class="card-body card-block">
                @foreach($journals as $journal)
                <form method="POST" action="/fieldFillJournal/{{$journal->id}}">

                    {{ csrf_field() }}
                    @if(session()->has('Success'))
                            <div class="alert alert-success alert-block" role="">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="card-body">
                                    {{session()->get('Success')}}
                                </div>
                            </div>
                        @endif

                    <div class="form-group"><label for="field_comment" class=" form-control-label">{{ __("Field Supervisor's Comment") }}</label><textarea rows="10" cols="30" name="field_comment" value="{{ $journal->field_supervisor_comments }}" type="text" id="field_comment" required class="form-control @error('field_comment') is-invalid @enderror">{{ $journal->field_supervisor_comments }}</textarea>
                        @error('field_comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div> 

                    <div class="form-group"><label for="score" class=" form-control-label">{{ __('Score') }}</label>
                        <select id="score" type="text"  name="score" class="form-control @error('score') is-invalid @enderror" value="{{ old('score')}}" id="score" required autocomplete="score">
                                    <option value="0" @php if($journal->score == "0") echo 'selected="selected"'; @endphp>0</option>
                                    <option value="1" @php if($journal->score == "1") echo 'selected="selected"'; @endphp>1</option>
                                    <option value="2" @php if($journal->score == "2") echo 'selected="selected"'; @endphp>2</option>
                                    <option value="3" @php if($journal->score == "3") echo 'selected="selected"'; @endphp>3</option>
                                    <option value="4" @php if($journal->score == "4") echo 'selected="selected"'; @endphp>4</option>
                                    <option value="5" @php if($journal->score == "5") echo 'selected="selected"'; @endphp>5</option>
                        </select>
                        @error('score')
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


