<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>ToDo App Tiikotu</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">ToDo App Tiikotu</a>
      <div class="my-navbar-control">
      <!-- ログインしてたら画像表示 -->
       @auth
        <div class="hd-prof-img">
          <!-- file変数 -->
            @if (!empty($file))
              <img id="preview" src="data:image/{{$mimeType}};base64,{{$file}}">
            @else
              <img id="preview" src="{{ asset('/storage/img_prof/no-image.jpg') }}">
            @endif
        </div>

        <input type="file" name="image" id="imageUpload" accept='image/*'>
        @endauth
        
        @if(Auth::check())
        <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
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

</html>