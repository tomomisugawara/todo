<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>ToDo App TIIKOTU</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">

<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">TIIKOTU</a>
      <div class="my-navbar-control">

      {{-- ログインしてたら画像表示 --}}
       @auth
        <div class="hd-prof-img">
          {{-- file変数 --}}
          <a href="{{ route('mypage.profile_edit',['id' => Auth::user()->id]) }}">
            @if(isset(Auth::user()->profile_image))
              <img src="../../../../{{ Auth::user()->profile_image }}">
            @else
              <img src="../../image/no-image.png">
            @endif
          </a>
        </div>
        @endauth

        @if(Auth::check())
        <a href="{{ route('mypage.profile_edit',['id' => Auth::user()->id]) }}" class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</a>
        ｜
        <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        @else
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        ｜
        <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
        @endif
      </div>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>
  @if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
  @endif
  @yield('scripts')
</body>
<footer>

  <div class="steps"></div>

</footer>
</html>