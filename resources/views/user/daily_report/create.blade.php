@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
{!! Form::open(["route" => "daily_report.store"]) !!}
<div class="main-wrap">
  <div class="container">
    {{-- <input class="form-control" name="user_id" type="hidden"> --}}
    {!! Form::input("hidden", "user_id", null, ["class" => "form-control"]) !!}
    <div class="form-group form-size-small">
      {{-- <input class="form-control" name="reporting_time" type="date"> --}}
      {!! Form::input("date", "reporting_time", null, ["class" => "form-control"]) !!}
      <span class="help-block"></span>
    </div>
    <div class="form-group">
      {{-- <input class="form-control" placeholder="Title" name="title" type="text"> --}}
      {!! Form::input("text", "title", null, ["class" => "form-control"]) !!}
      @if ($errors->has('title'))
      <p class="text-danger">{{ $errors->first('title') }}</p>
      @endif
      <span class="help-block"></span>
    </div>
    <div class="form-group">
      {{-- <textarea class="form-control" placeholder="Content" name="contents" cols="50" rows="10"></textarea> --}}
      {!! Form::text("content", null, ["class" => "form-control", "placeholder" => "Content"]) !!}
      @if ($errors->has('content'))
      <p class="text-danger">{{ $errors->first('content') }}</p>
      @endif
      <span class="help-block"></span>
    </div>
    {{-- <button type="submit" class="btn btn-success pull-right">Add</button> --}}
    {!! Form::submit("Add", ["class" => "btn btn-success pull-right"]) !!}
  </div>
</div>
{!! Form::close() !!}

@endsection

