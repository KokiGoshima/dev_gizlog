@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.confirm', 'method' => 'GET']) !!}
    {!! Form::input('hidden', 'id', $question->id) !!}
      <div class="form-group @if(!empty($errors->first('tag_category_id'))) has-error @endif">
        {!! Form::select('tag_category_id',
         ['Select category', 'front', 'back', 'infra', 'others'],
         $question->tag_category->id,
         ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id'])
       !!}
        <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        {!! Form::text('title', $question->title, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('content'))) has-error @endif">
        {!! Form::textarea('content', $question->content, ['class' => 'form-control', 'placeholder'  => 'Please write down your question here...']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::submit('update', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
