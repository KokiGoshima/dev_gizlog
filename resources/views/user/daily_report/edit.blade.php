@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['daily_report.update', $report->id], 'metod' => 'PUT']) !!}
{{--       <input class="form-control" name="user_id" type="hidden" value="4"> --}}
    {!! Form::input('hidden', 'user_id', $report->user_id, ['class' => 'form-control']) !!}
      <div class="form-group form-size-small">
        {{-- <input class="form-control" name="reporting_time" type="date"> --}}
        {!! Form::input("date", "reporting_time", $report->reporting_time, ["class" => "form-control"]) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {{-- <input class="form-control" placeholder="Title" name="title" type="text"> --}}
        {!! Form::input("text", "title", $report->title, ["class" => "form-control"]) !!}
      <span class="help-block"></span>
      </div>
      <div class="form-group">
        {{-- <textarea class="form-control" placeholder="本文" name="contents" cols="50" rows="10">本文</textarea> --}}
        {!! Form::text("content", $report->content, ["class" => "form-control"]) !!}
      <span class="help-block"></span>
      </div>
      <button type="submit" class="btn btn-success pull-right">Update</button>
    </form>
  </div>
</div>

@endsection

