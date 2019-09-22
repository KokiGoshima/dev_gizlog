@extends ('common.user')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'attendance.registerAbsence']) !!}
    {!! Form::hidden('date', Carbon::now()->format('Y-m-d')) !!}
      <div class="form-group">
        {!! Form::textarea('absence_reason', null, ['class' => 'form-control', 'placeholder' => '欠席理由を入力してください。']) !!}
      </div>
      {!! Form::submit('登録', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

