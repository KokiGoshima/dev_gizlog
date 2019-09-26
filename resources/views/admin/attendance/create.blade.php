@extends ('common.admin')
@section ('content')

<h2 class="brand-header">個別勤怠作成</h2>
<div class="main-wrap">
  <div class="user-info-box clearfix">
    <div class="left-info">
      <img src="{{ $user->avatar }}"><p class="user-name">{{ $user->name }}</p>
      <i class="fa fa-envelope-o" aria-hidden="true"><p class="user-email">{{ $user->email }}</p></i>
    </div>
    <div class="right-info">
      <div class="my-info">
        <p>研修開始日</p>
        <div class="study-hour-box clearfix">
          <p class="study-hour study-date"><span>{{ $user->created_at->format('Y/m/d') }}</span></p>
        </div>
      </div>
    </div>
  </div>
  <div class="attendance-modify-box">
    <ul>
      @if($errors->any())
        <ul>
          @foreach($errors->all() as $message)
            <li class="text-left text-danger" style="padding-left: 30px;">{{ $message }}</li>
          @endforeach
        </ul>
      @endif
    </ul>
    {!! Form::open(['route' => ['admin.attendance.store', $user->id]]) !!}
      <div class="form-group date-form">
        {!! Form::date('date', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::time('start_time', null, ['class' => 'form-control']) !!}
      </div>
      <p class="to-time">to</p>
      <div class="form-group">
        {!! Form::time('end_time', null, ['class' => 'form-control']) !!}
      </div>
      {!! Form::button('作成', ['type' => 'submit', 'class' => 'btn btn-modify']) !!}
    {!! Form::close() !!}
    {!! Form::open(['route' => ['admin.attendance.storeAbsence', $user->id]]) !!}
      {!! Form::button('欠席', ['type' => 'submit', 'class' => 'btn btn-danger', 'id' => 'create-absence']) !!}
      {!! Form::hidden('date', null, ['id' => 'date-target']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection



