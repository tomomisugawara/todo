{{-- ////7.31追加//// --}}
@extends('layout')

@section('title')
    退会
@endsection

@section('content')
    <div class="delete_container">
        <div class="card border-dark mb-3">
            <div class="card-header">
                <h4>退会の確認</h4>
            </div>
            <div class="card-body">
                <p class="card-text">退会をすると全て削除されます。</p>
                <p class="card-text">それでも退会をしますか？</p>
            </div>
    </div>

        <div class="btn-group">
            {{-- {!! Form::open(['route' => ['/mypage/{id}/delete_confirm.destroy', Auth::user()->id], 'method' => 'delete']) !!} --}}
			 {!! Form::open(['route' => ['users.destroy', Auth::user()->id], 'method' => 'delete']) !!}
            {!! Form::submit('退会', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}


            {{-- <a href="{{ route(['route' => ['SoftDeleteUserController.destroy', Auth::user()->id], 'method' => 'delete']) }}"
                onclick="confirm('本当に退会しますか？');
                event.preventDefault();
                document.getElementById('withdrawal-form').submit();">
                退会する
            </a>

            <form id="withdrawal-form" action="{{ route('user.withdrawal') }}" method="post" style="display: none;">
                {{ csrf_field() }}
            </form> --}}


            <div class="ml-3">
                <a href="/" class="btn btn-success"">キャンセル</a>
            </div>
        </div>
    </div>
@endsection



@include('share.img.scripts')
