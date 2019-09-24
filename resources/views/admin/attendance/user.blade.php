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
          <p class="study-hour"><span>{{ $countAbsence }}</span>回</p>
        </div>
      </div>
      <div class="my-info day-info">
        <p>遅刻回数</p>
        <div class="study-hour-box clearfix">
          <div class="userinfo-box"><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></div>
          <p class="study-hour"><span>{{ $countLate }}</span>回</p>
        </div>
      </div>
      <div class="my-info">
        <p>研修開始日</p>
        <div class="study-hour-box clearfix">
          <p class="study-hour study-date"><span>2017/04/03</span></p>
        </div>
      </div>
    </div>
  </div>
  <div class="btn-wrapper">
    <a href="" class="btn btn-icon">
      <i class="fa fa-plus" aria-hidden="true"></i>
    </a>
  </div>
  <div class="content-wrapper table-responsive">
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
        <tr class="row absent-row">
          <td class="col-xs-1">07/03</td>
          <td class="col-xs-1">Wed</td>
          <td class="col-xs-2">欠席</td>
          <td class="col-xs-2">-</td>
          <td class="col-xs-2">-</td>
          <td class="col-xs-2">-</td>
          <td class="col-xs-2">
            <a href="" class="btn btn-sucssess btn-small">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
        <tr class="row ">
          <td class="col-xs-1">07/02</td>
          <td class="col-xs-1">Tue</td>
          <td class="col-xs-2">出社</td>
          <td class="col-xs-2">10:03</td>
          <td class="col-xs-2">19:30</td>
          <td class="col-xs-2"><span class="attention">あり</span></td>
          <td class="col-xs-2">
            <a href="" class="btn btn-sucssess btn-small">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
        <tr class="row ">
          <td class="col-xs-1">07/01</td>
          <td class="col-xs-1">Mon</td>
          <td class="col-xs-2">出社</td>
          <td class="col-xs-2">09:29</td>
          <td class="col-xs-2">19:58</td>
          <td class="col-xs-2">-</td>
          <td class="col-xs-2">
            <a href="" class="btn btn-sucssess btn-small">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection

