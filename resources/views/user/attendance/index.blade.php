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
      <form>
        <input id="date-time-target" name="start_time" type="hidden" value="2019-07-03 12:38:41">
        <input name="user_id" type="hidden" value="4">
        <input name="date" type="hidden" value="2019-07-03">
        <a href="#close" class="cancel-btn">Cancel</a>
        <input class="yes-btn" type="submit" value="Yes">
      </form>
    </div>
  </div>
</div>

@endsection

