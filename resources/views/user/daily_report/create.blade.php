@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
{!! Form::open(["route" => "daily_report.store"]) !!}
<div class="main-wrap">
  <div class="container">
    {!! Form::input("hidden", "user_id", null, ["class" => "form-control"]) !!}
    <div class="form-group form-size-small">
      {!! Form::input("date", "reporting_time", null, ["class" => "form-control"]) !!}
      <span class="help-block"></span>
    </div>
    <div class="form-group">
      {!! Form::input("text", "title", null, ["class" => "form-control"]) !!}
      @if ($errors->has('title'))
      <p class="text-danger">{{ $errors->first('title') }}</p>
      @endif
      <span class="help-block"></span>
    </div>
    <div class="form-group">
      {!! Form::textarea("content", null, ["class" => "form-control", "placeholder" => "Content"]) !!}
      @if ($errors->has('content'))
      <p class="text-danger">{{ $errors->first('content') }}</p>
      @endif
      <span class="help-block"></span>
    </div>
    {!! Form::submit('Add', ['class' => 'btn btn-success pull-right']) !!}
  </div>
</div>
{!! Form::close() !!}

@endsection

