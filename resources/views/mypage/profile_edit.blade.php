@extends('layout')

@section('title')
    プロフィール
@endsection

@section('content')
    <div id="profile-edit-form" class="container">
        <div class="row">


            <div class="col-8 offset-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                @endif
            </div>


        </div>
        <div class="row">
            <div class="col-4">

                <h2 class="profile-title">プロフィール</h2>

                <form method="POST" action="{{ route('mypage.update') }}" class="p-5" enctype="multipart/form-data">
                    @csrf
                    {{-- 画像 --}}
                    <span class="avatar-image">
                        <input type="file" name="image" class="form-control" accept="image/png,image/jpeg,image/gif" id="avatar" style="display:none;">
                        <label for="avatar" class="d-inline-block">
                            @if (isset(Auth::user()->profile_image))
                                <img src="../../{{ Auth::user()->profile_image }}" class="img-circle">
                            @else
                                <img src="../../image/no-image.png" class="img-circle">
                            @endif
                        </label>
                    </span>


                    {{-- ニックネーム --}}
                    <div class="panel-heading">
                        <label for="name">ニックネーム</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', Auth::user()->name) }}" autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- メールアドレス --}}
                    <div class="panel-heading">
                        <label for="mail">メールアドレス</label>
                        <input id="mail" type="text" class="form-control @error('mail') is-invalid @enderror"
                            name="email" value="{{ old('mail', Auth::user()->email) }}" autocomplete="mail" autofocus>
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


                        {{-- 退会 --}}
                    <div class="">
                        <a href="{{ route('delete_confirm',['id' => Auth::user()->id]) }}" type="submit" class="">
                            退会
                        </a>

                </form>
            </div>
        </div>
    </div>
@endsection



@include('share.img.scripts')
