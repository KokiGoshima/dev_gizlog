@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
{!! Form::open(['route' => ['dailyReport.update', $report->id], 'method' => 'PUT']) !!}
<div class="main-wrap">
  <div class="container">
    <div class="form-group form-size-small @if($errors->has('reporting_time')) has-error @endif">
      {!! Form::input("date", "reporting_time", $report->reporting_time->format('Y-m-d'), ["class" => "form-control"]) !!}
      @if ($errors->has('reporting_time'))
      <p class="text-danger">{{ $errors->first('reporting_time') }}</p>
      @endif
      <span class="help-block"></span>
    </div>
    <div class="form-group @if($errors->has('title')) has-error @endif">
      {!! Form::text('title', $report->title, ['class' => 'form-control']) !!}
      @if ($errors->has('title'))
      <p class="text-danger">{{ $errors->first('title') }}</p>
      @endif
      <span class="help-block"></span>
    </div>
    <div class="form-group @if($errors->has('content')) has-error @endif">
      {!! Form::textarea('content', $report->content, ['class' => 'form-control']) !!}
      @if ($errors->has('content'))
      <p class="text-danger">{{ $errors->first('content') }}</p>
      @endif
      <span class="help-block"></span>
    </div>
    {!! Form::submit('UPDATE', ['class' => 'btn btn-success pull-right']) !!}
  </div>
</div>
{!! Form::close() !!}

@endsection