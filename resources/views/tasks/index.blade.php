@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col col-md-4">
      <nav class="panel panel-default">
        <div class="panel-heading">フォルダ</div>
        <div class="panel-body">
          <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
            フォルダを追加する
          </a>
        </div>
        <div class="list-group btn-folder">
          @foreach($folders as $folder)
          <a href="{{ route('tasks.index', ['folder' => $folder->id]) }}" class="list-group-item btn-folder__link {{ $current_folder_id === $folder->id ? 'active' : '' }}">
            <span>{{ $folder->title }}</span>
          </a>
          <!-- <button class="btn-folder__delete">削除</button> -->
          <button class="btn-folder__delete" type="button" class="btn btn-default" aria-label="Left Align">
          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button> 
          @endforeach
        </div>
      </nav>
    </div>
    <div class="column col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">タスク</div>
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
              <th>状態</th>
              <th>期限</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($tasks as $task)
            <tr>
              <td>{{ $task->title }}</td>
              <td>
                <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
              </td>
              <td>{{ $task->formatted_due_date }}</td>
              <td><a href="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
              <!-- <td><button class="">削除</button></td> -->
              <td><button class="" type="button" class="btn btn-default" aria-label="Left Align">
          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection