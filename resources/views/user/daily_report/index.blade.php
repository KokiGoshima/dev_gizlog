@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper daily-report">
    {!! Form::open(['route' => 'dailyReport.index', 'method' => 'GET']) !!}
      {!! Form::input('month', 'month', null, ['class' => "form-control"]) !!}
      <button type="submit" class="btn btn-icon"><i class="fa fa-search"></i></button>
    {!! Form::close() !!}
    <a class="btn btn-icon" href="{{ route("dailyReport.create") }}"><i class="fa fa-plus"></i></a>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">Date</th>
          <th class="col-xs-3">Title</th>
          <th class="col-xs-5">Content</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reports as $report)
          <tr class="row">
            <td class="col-xs-2">{{ $report->reporting_time->format('m/d(D)') }}</td>
            <td class="col-xs-3">{{ $report->title }}</td>
            <td class="col-xs-5">{{ mb_strimwidth($report->content, 0, 50, '...') }}</td>
            <td class="col-xs-2"><a class="btn" href="{{ route('dailyReport.show', $report->id) }}"><i class="fa fa-book"></i></a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection