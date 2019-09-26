@extends ('common.admin')
@section ('content')

<h2 class="brand-header">個別勤怠編集</h2>
<div class="main-wrap">
  <div class="user-info-box clearfix">
    <div class="left-info">
      <img src="{{ $user->avatar }}"><p class="user-name">{{ $user->name }}</p>
      <i class="fa fa-envelope-o" aria-hidden="true"><p class="user-email">{{ $user->email }}</p></i>
    </div>
    <div class="right-info">
      <div class="my-info day-info">
        <p>編集日</p>
        <div class="study-hour-box clearfix">
          <div class="userinfo-box"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></div>
          <p class="study-hour study-date"><span>{{ $attendance->date->format('m/d') }}</span></p>
        </div>
      </div>
      <div class="my-info">
        <p>研修開始日</p>
        <div class="study-hour-box clearfix">
          <p class="study-hour study-date"><span>2019/07/02</span></p>
        </div>
      </div>
    </div>
  </div>
  @if(isset($attendance->correction_reason))
    <div class="request-box">
      <div class="request-title">
        <img src="{{ $user->avatar }}" class="avatar-img">
        <p>修正申請内容</p>
      </div>
      <div class="request-content">
        {{ $attendance->correction_reason }}
      </div>
    </div>
  @endif
  <div class="attendance-modify-box">
    {!! Form::open(['route' => ['admin.attendance.update', $user->id, $attendance->id], 'method' => 'PUT']) !!}
      <div class="form-group">
        <input class="form-control" name="" type="time" value="10:56">
        <span class="help-block"></span>
      </div>
      <p class="to-time">to</p>
      <div class="form-group">
        <input class="form-control" name="end_time" type="time" value="19:26">
        <span class="help-block"></span>
      </div>
      <button type="submit" class="btn btn-modify">修正</button>
    </form>
    <form>
      <button type="submit" class="btn btn-danger">欠席</button>
    </form>
  </div>
</div>

@endsection

