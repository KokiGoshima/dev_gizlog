@extends ('common.user')
@section ('content')

<h2 class="brand-header">修正申請</h2>
<div class="main-wrap">
  <div class="container">
    <form>
      <div class="form-group form-size-small">
        <input class="form-control" name="" type="date" value="">
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="修正申請の内容を入力してください。" name="" cols="50" rows="10"></textarea>
      </div>
      <input class="btn btn-success pull-right" type="submit" value="申請">
    </form>
  </div>
</div>

@endsection

