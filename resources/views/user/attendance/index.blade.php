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
      <a class="button start-btn" id="register-attendance" href=#openModal>出社時間登録</a>
  </div>
  <ul class="button-wrap">
    <li>
      <a class="at-btn absence" href="{{ route('attendance.absence') }}">欠席登録</a>
    </li>
    <li>
      <a class="at-btn modify" href="{{ route('attendance.modify') }}">修正申請</a>
    </li>
    <li>
      <a class="at-btn my-list" href="/attendance/mypage">マイページ</a>
    </li>
  </ul>
</div>

<div id="openModal" class="modalDialog">
  <div>
    <div class="register-text-wrap"><p>12:38 で出社時間を登録しますか？</p></div>
    <div class="register-btn-wrap">
      {!! Form::open(['route' => 'attendance.reportAttendance']) !!}
        {!! Form::hidden('start_time', '2019-07-03 12:38:41', ['id' => 'date-time-target']) !!}
        {!! Form::hidden('user_id', '4') !!}
        {!! Form::hidden('date', '2019-07-03') !!}
        <a href="#close" class="cancel-btn">Cancel</a>
        {!! Form::submit('Yes', ['class' => 'yes-btn']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

