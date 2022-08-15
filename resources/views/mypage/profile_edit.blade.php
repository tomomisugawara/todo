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
        <div class="col col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">プロフィール</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('mypage.update') }}" class="p-5" enctype="multipart/form-data">
                        @csrf
                        {{-- 画像 --}}
                        <span class="avatar-image">
                            <input type="file" name="image" class="form-control" accept="image/png,image/jpeg,image/gif" id="avatar" style="display:none;">
                            <label for="avatar" class="d-inline-block">
                                @if (isset(Auth::user()->profile_image))
                                <!-- <img src="../../{{ Auth::user()->profile_image }}" class="img-circle"> -->
                                <img src="../../{{ Storage::disk('s3')->url($user->image) }}" class="img-circle">
                                @else
                                <img src="../../image/no-image.png" class="img-circle">
                                @endif
                            </label>
                        </span>

                        {{-- ニックネーム --}}
                        <div class="panel-title">
                            <label for="name">ニックネーム</label>
                        </div>
                        <div class="panel-body">
                            <input id="name" type="text" class="form-control panel-body @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- メールアドレス --}}
                        <div class="panel-title">
                            <label for="mail">メールアドレス</label>
                        </div>
                        <div class="panel-body">
                            <input id="mail" type="text" class="form-control @error('mail') is-invalid @enderror" name="email" value="{{ old('mail', Auth::user()->email) }}" autocomplete="mail" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- 保存 --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"">
                                保存
                            </button>
                        </div>

                        {{-- 退会 --}}
                        <div class="form-group_Withdraw">
                            <a href="{{ route('delete_confirm',['id' => Auth::user()->id]) }}" type="submit" class="">
                                退会
                            </a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection



    @include('share.img.scripts')