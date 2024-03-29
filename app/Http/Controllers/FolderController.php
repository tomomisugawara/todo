<?php

namespace App\Http\Controllers;
use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        // フォルダ追加画面を表示する
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;

        // ★ ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    //  削除機能
    public function delete(Folder $folder)
    {
        $folder->delete();
        $folder->tasks()->delete();

        // リダイレクト
        return redirect()->route('home',
        // [
        //     'folder' => $folder->id,
        // ]
    );
    }
}
