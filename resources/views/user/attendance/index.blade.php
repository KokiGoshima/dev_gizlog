@extends ('common.user')
@section ('content')

<h2 class="brand-header">勤怠登録</h2>

<div class="main-wrap">

  <div id="clock" class="light">
    <div class="display">
      <div class="weekdays"></div>
      <div class="today"></div>
      <div class="digits"></div>
    </div>
  </div>
  <div class="button-holder">
    @if (empty($todayAttendance->start_time) && empty($todayAttendance->end_time))
      <a class="button start-btn" id="register-attendance" href=#openModal>出社時間登録</a>
    @elseif (isset($todayAttendance->start_time) && empty($todayAttendance->end_time))
      <a class="button end-btn" id="register-attendance" href=#openModal>退社時間登録</a>
    @else
      <a class="button disabled" id="register-attendance" href=#openModal>退社済み</a>
    @endif
  </div>
  <ul class="button-wrap">
    <li>
      <a class="at-btn absence" href="{{ route('attendance.absence') }}">欠席登録</a>
    </li>
    <li>
      <a class="at-btn modify" href="{{ route('attendance.correction') }}">修正申請</a>
    </li>
    <li>
      <a class="at-btn my-list" href="/attendance/mypage">マイページ</a>
    </li>
  </ul>
</div>

<div id="openModal" class="modalDialog">
  <div>
    @if(empty($todayAttendance->start_time))
      <div class="register-text-wrap"><p>12:38 で出社時間を登録しますか？</p></div>
      <div class="register-btn-wrap">
        {!! Form::open(['route' => 'attendance.reportArrival']) !!}
          {!! Form::hidden('start_time', Carbon::now()->format('H:i:s'), ['id' => 'date-time-target']) !!}
          {!! Form::hidden('date', Carbon::now()->format('Y-m-d')) !!}
          <a href="#close" class="cancel-btn">Cancel</a>
          {!! Form::submit('Yes', ['class' => 'yes-btn']) !!}
        {!! Form::close() !!}
      </div>
    @else
      <div class="register-text-wrap"><p>12:38 で退社時間を登録しますか？</p></div>
      <div class="register-btn-wrap">
        {!! Form::open(['route' => 'attendance.reportLeaving']) !!}
          {!! Form::hidden('end_time', Carbon::now()->format('H:i:s'), ['id' => 'date-time-target']) !!}
          {!! Form::hidden('date', Carbon::now()->format('Y-m-d')) !!}
          <a href="#close" class="cancel-btn">Cancel</a>
          {!! Form::submit('Yes', ['class' => 'yes-btn']) !!}
        {!! Form::close() !!}
      </div>
    @endif
  </div>
</div>

@endsection

