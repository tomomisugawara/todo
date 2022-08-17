@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col col-md-4">
      <nav class="panel panel-default">
        <div class="panel-heading text-center">フォルダ</div>
        <div class="panel-body">
          <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
            フォルダを追加する
          </a>
        </div>
        <div class="list-group btn-folder">
          @foreach($folders as $folder)
          <div class="folder-flex">
            <a href="{{ route('tasks.index', ['folder' => $folder->id]) }}" class="list-group-item btn-folder__link {{ $current_folder_id === $folder->id ? 'active' : '' }}">
              <span>{{ $folder->title }}</span>
            </a>

            <a href="{{ route('folder.delete', ['folder' => $folder->id]) }}" onClick="delete_alert(event);">
              <button class="btn-folder__delete" type="button" class="btn btn-default" aria-label="Left Align">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
            </a>

          </div>
          @endforeach
        </div>
      </nav>
    </div>
    <div class="column col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading text-center">タスク</div>
        <div class="panel-body">
          <div class="text-right">
            <a href="{{ route('tasks.create', ['folder' => $current_folder_id]) }}" class="btn btn-default btn-block">
              タスクを追加する
            </a>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>タイトル</th>
              <!-- <th>期限</th> -->
              <th>状態</th>
              <th>編集</th>
              <th>削除</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tasks as $task)
            <tr>
              <td>{{ $task->title }}</td>

              <td>
                <div class="table_innar">
                  <!-- status_class呼び出す、idを取得する -->
                  <span class="label {{ $task->status_class }}" data-folderid="{{ $task->folder_id }}" data-taskid="{{ $task->id }}" style="cursor: hand; cursor:pointer;">{{ $task->status_label }}</span>
                </div>
              </td>

              <td>
                <div class="table_innar">
                  <a href="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                </div>
              </td>

              <!-- 削除 -->
              <td>
                <a href="{{ route('task.delete', ['folder' => $task->folder_id, 'task' => $task->id]) }}" onClick="delete_alert(event);">
                  <button class="btn-task__delete" type="button" class="btn btn-default" aria-label="Left Align">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- jsメッセージ -->
<div class="complete-msg">
  <p class="complete-msg__text"></p>
  <div class="complete-msg__img">
    <img src="/image/neko1.png" alt="">
  </div>
</div>


@endsection
@include('share.confirm.scripts')
@include('share.complete.scripts')