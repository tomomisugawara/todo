@extends('layout')

@section('title')
    プロフィール編集
@endsection

@section('content')
    <div id="profile-edit-form" class="container">
        <div class="row">
            <div class="col-8 offset-2">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
j
        <div class="row">
            <div class="col-8 offset-2 bg-white">

                <div class="text-center border-bottom pb-3 pt-3" style="font-size: 24px">プロフィール編集</div>

                <form method="POST" action="{{ route('mypage.update') }}" class="p-5" enctype="multipart/form-data">
                    @csrf
                    {{-- アバター画像 --}}
                    <span class="">
                        <input type="file" name="image" class="form-control" accept="image/png,image/jpeg,image/gif" id="img">
                        <label for="avatar" class="d-inline-block">
                            @if(isset(Auth::user()->profile_image))
                            <img src="../../{{ Auth::user()->profile_image }}" class="img-circle" style="object-fit: cover; width: 200px; height: 200px;">
                            @else
                            <img src="../../image/no-image.png" class="img-circle" style="object-fit: cover; width: 200px; height: 200px;">
                            @endif
                        </label>
                    </span>


                    {{-- ニックネーム --}}
                    <div class="form-group row-xs-4">
                        <label for="name">ニックネーム</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- メールアドレス --}}
                    <div class="form-group row-xs-4">
                        <label for="mail">メールアドレス</label>
                        <input id="mail" type="text" class="form-control @error('mail') is-invalid @enderror" name="email" value="{{ old('mail', Auth::user()->email) }}" required autocomplete="mail" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-0 mt-3 center-block">
                        <button type="submit" class="btn btn-primary">
                            保存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@include('share.img.scripts')