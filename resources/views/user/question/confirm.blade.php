@extends ('common.user')
@section ('content')

<h2 class="brand-header">投稿内容確認</h2>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      {{ $user->name }}さんの質問
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $input['title'] }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! nl2br(e($input['content'])) !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-bottom-wrapper">

    @if (strpos(url()->previous(), 'create') !== false)
       {!! Form::open(['route' => 'question.store']) !!}
    @else
       {!! Form::open(['route' => ['question.update', $input['id']], 'method' => 'PUT']) !!}
    @endif
      {!! Form::input('hidden', 'tag_category_id', $input['tag_category_id']) !!}
      {!! Form::input('hidden', 'title', $input['title']) !!}
      {!! Form::input('hidden', 'content', $input['content']) !!}
      {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
