@extends('layout')

@section('content')
<div class="container">

<div class="balloon">
    <div class="balloon login-text">
      <h5>ちいさなことからこつこつと。</h5><br>
      そんな思いから誕生したのがTODOアプリ「TIIKOTU」にゃ!<br>
      TIIKOTUは期限を気にせずいつでも気軽につかってほしいのにゃ。<br>
      たとえば、前日より５分早く起きるとか、帰ったら手を洗うとか、スリッパを揃えるとか、何でもいいのにゃ。<br>
      タスクを達成するとTIIKOTUがほめてくれたり、くれなかったり、たまに独り言をつぶやいたりするのにゃ。<br>
      TIIKOTUと一緒に楽しくすごそうにゃ!<br>
    </div>
  </div>

  <div class="login_container">
    <img class="login-neko" src="../image/neko1.png" alt="">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">ログイン</div>
          <div class="panel-body">
            @if($errors->any())
            <div class="alert alert-danger">
              @foreach($errors->all() as $message)
              <p>{{ $message }}</p>
              @endforeach
            </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
              </div>
              <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success"">送信</button>
              </div>
            </form>
          </div>
        </nav>
        <div class="text-center">
          <a href="{{ route('password.request') }}">パスワードの変更はこちらから</a>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection