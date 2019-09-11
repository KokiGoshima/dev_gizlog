@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper">
    <div class="search-box">
      {!! Form::open(['route' => 'question.index', 'method' => 'GET']) !!}
        @if(isset($category_num))
          {!! Form::input('hidden', 'tag_category_id', $category_num) !!}
        @endif
        {!! Form::text('search_word', null, ['class' => 'form-control search-form', 'placeholder' => 'Search words...']) !!}
        {!! Form::button('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'search-icon', 'type' => 'submit']) !!}
      {!! Form::close() !!}
    </div>
    <a class="btn" href="{{ route('question.create') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
    <a class="btn" href="{{ route('question.mypage') }}">
      <i class="fa fa-user" aria-hidden="true"></i>
    </a>
  </div>
  {!! Form::open(['route' => 'question.index', 'method' => 'GET', 'id' => 'category-form']) !!}
    <div class="category-wrap">
      <div class="btn all" id="0">all</div>
      @foreach($tag_categories as $key => $tag_category)
        <div class="btn {{ $tag_category->name }}" id="{{ $key + 1 }}">{{ $tag_category->name }}</div>
      @endforeach
      {!! Form::input('hidden', 'tag_category_id', '', ['id' => 'category-val']) !!}
    </div>
  {!! Form::close() !!}
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-1">user</th>
          <th class="col-xs-2">category</th>
          <th class="col-xs-6">title</th>
          <th class="col-xs-1">comments</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      @foreach ($questions as $question)
        <tbody>
          <tr class="row">
            <td class="col-xs-1"><img src="{{ $question->user->avatar }}" class="avatar-img"></td>
            <td class="col-xs-2">{{ $question->tagCategory->name }}</td>
            <td class="col-xs-6">{{ Str::limit($question->title, 30, ' ...') }}</td>
            <td class="col-xs-1"><span class="point-color">{{ count($question->comments) }}</span></td>
            <td class="col-xs-2">
              <a class="btn btn-success" href="{{ route('question.show', $question->id) }}">
                <i class="fa fa-comments-o" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        </tbody>
      @endforeach
    </table>
    <div aria-label="Page navigation example" class="text-center"></div>
  </div>
</div>

@endsection
