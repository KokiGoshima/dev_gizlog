@extends ('common.admin')
@section ('content')

<h2 class="brand-header">個別勤怠管理</h2>
<div class="main-wrap">
  <div class="user-info-box clearfix">
    <div class="left-info">
      <img src="{{ $user->avatar }}"><p class="user-name">{{ $user->name }}</p>
      <i class="fa fa-envelope-o" aria-hidden="true"><p class="user-email">{{ $user->email }}</p></i>
    </div>
    <div class="right-info">
      <div class="my-info absence-info">
        <p>欠席回数</p>
        <div class="study-hour-box clearfix">
          <div class="userinfo-box"><i class="fa fa-ban fa-2x" aria-hidden="true"></i></div>
          <p class="study-hour"><span>{{ $user->countTotalAbsenceTime() }}</span>回</p>
        </div>
      </div>
      <div class="my-info day-info">
        <p>遅刻回数</p>
        <div class="study-hour-box clearfix">
          <div class="userinfo-box"><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></div>
          <p class="study-hour"><span>{{ $user->countTotalLateTime() }}</span>回</p>
        </div>
      </div>
      <div class="my-info">
        <p>研修開始日</p>
        <div class="study-hour-box clearfix">
          <p class="study-hour study-date"><span>{{ $user->created_at->format('Y/m/d') }}</span></p>
        </div>
      </div>
    </div>
  </div>
  <div class="btn-wrapper">
    <a href="{{ route('admin.attendance.create', $user->id) }}" class="btn btn-icon">
      <i class="fa fa-plus" aria-hidden="true"></i>
    </a>
  </div>
  <div class="content-wrapper table-responsive">
    <p>件数：{{ $attendances->total() }}</p>
    {{ $attendances->links() }}
    <table class="table">
      <thead>
        <tr class="row">
          <th class="col-xs-1">日付</th>
          <th class="col-xs-1">曜日</th>
          <th class="col-xs-2">状態</th>
          <th class="col-xs-2">出社時間</th>
          <th class="col-xs-2">退社時間</th>
          <th class="col-xs-2">修正申請</th>
          <th class="col-xs-2">修正</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($attendances as $attendance)
          <tr class="row {{ $attendance->absence_flag === 1 ? "absent-row" : "" }}">
            <td class="col-xs-1">{{ $attendance->date->format('m/d') }}</td>
            <td class="col-xs-1">{{ $attendance->date->format('D') }}</td>
            <td class="col-xs-2">
              @if (isset($attendance->start_time) && isset($attendance->end_time))
                {{ '出勤' }}
              @elseif ($attendance->absence_flag === 1)
                {{ '欠席' }}
              @elseif (isset($attendance->start_time) && empty($attendance->end_time))
                {{ '研修中' }}
              @else
                {{ '-' }}
              @endif
            </td>
            <td class="col-xs-2">{{ isset($attendance->start_time) ? $attendance->start_time : "-" }}</td>
            <td class="col-xs-2">{{ isset($attendance->end_time) ? $attendance->end_time : "-" }}</td>
            <td class="col-xs-2">{{ $attendance->correction_flag === 1 ? "あり" : "-" }}</td>
            <td class="col-xs-2">
              <a href="{{ route('admin.attendance.edit', [$user->id, $attendance->id]) }}" class="btn btn-sucssess btn-small">
                <i class="fa fa-pencil" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection