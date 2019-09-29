@extends ('common.user')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'attendance.registerAbsence']) !!}
      <div class="form-group @if(!empty($errors->first('absence_reason'))) has-error @endif">
        {!! Form::textarea('absence_reason', null, ['class' => 'form-control', 'placeholder' => '欠席理由を入力してください。']) !!}
        <span class="help-block">{{ $errors->first('absence_reason') }}</span>
      </div>
      {!! Form::submit('登録', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) !!}
    {!! Form::close() !!}
  </div>
</div>
@endsection