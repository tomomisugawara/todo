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
  <!-- googl fontus -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400;500&family=Noto+Sans+JP:wght@100&family=Noto+Serif+JP:wght@200&family=Potta+One&family=Yomogi&display=swap" rel="stylesheet">

<body>
  <div class="wrapper">
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
              <img src="{{ Storage::disk('s3')->url(Auth::user()->profile_image) }}">
              @else
              <img src="../../../../image/no-image.png">
              @endif
            </a>
          </div>
          @endauth

          @if(Auth::check())
          <div class="my-navbar_block">

            <a href="{{ route('mypage.profile_edit',['id' => Auth::user()->id]) }}" class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</a>

            <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

          </div>
          @csrf
          </form>
          @else
          <div class="my-navbar_block-inner">
            <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>

            <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
          </div>
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


    <footer>
      {{-- 肉球HTML --}}
      <div class="footer_flax">
        <div class="steps"></div>
        <img class="kuroneko" src="../../../../image/kuroneko.png" alt="">
      </div>
      <div class="copy">
        <small>&copy; 2022 t-sugawara</small>
      </div>
    </footer>

  </div>

</body>

</html>