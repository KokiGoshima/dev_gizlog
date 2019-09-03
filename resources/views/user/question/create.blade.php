@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.store']) !!}
    {!! Form::input('hidden', 'user_id', Auth::id()) !!}
      <div class="form-group">
       {!! Form::select('tag_category_id',
         ['Select category', 'front', 'back', 'infra', 'others'],
         0,
         ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id'])
       !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder'  => 'Please write down your question here...']) !!}
        <span class="help-block"></span>
      </div>
      {!! Form::submit('create', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

