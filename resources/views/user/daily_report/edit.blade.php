@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
{!! Form::open(['route' => ['daily_report.update', $report->id], 'method' => 'PUT']) !!}
<div class="main-wrap">
  <div class="container">
    {!! Form::input('hidden', 'user_id', $report->user_id, ['class' => 'form-control']) !!}
    <div class="form-group form-size-small">
      {!! Form::input("date", "reporting_time", $report->reporting_time, ["class" => "form-control"]) !!}
      <span class="help-block"></span>
    </div>
    <div class="form-group">
      {!! Form::input("text", "title", $report->title, ["class" => "form-control"]) !!}
      <span class="help-block"></span>
    </div>
    <div class="form-group">
      {!! Form::text("content", $report->content, ["class" => "form-control"]) !!}
      <span class="help-block"></span>
    </div>
    {!! Form::submit('UPDATE', ['class' => 'btn btn-success pull-right']) !!}
  </div>
</div>
{!! Form::close() !!}


@endsection

