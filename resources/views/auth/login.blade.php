@extends('layout')

@section('content')
<div class="container">

<div class="balloon-box">

  <div class="login-neko">
<img src="../image/neko1.png" alt="">
</div>

  <div class="balloon-text">
    <div class="balloon-innar">
      吾輩はTODOアプリ<br>
      TIIKOTUであるにゃ。<br>
      ちいさなことからこつこつとできたらいい。<br>
      そんな思いから生まれたのにゃ。<br>
    </div>
  </div>
  </div>

  <div class="login_container">
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
        <div class=" text-center">
                  <a href="{{ route('password.request') }}">パスワードの変更はこちらから</a>
              </div>
          </div>
      </div>
    </div>

  </div>
  @endsection