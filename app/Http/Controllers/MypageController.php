<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

use App\Models\FileImage;

class MypageController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = DB::table('users')->find($id);
        // $data = FileImage::all();
        return view('/mypage/profile_edit', ['id' => $id]);
    }

/* 2022/07/28 退避 バリデーション
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [], [
            'name' => 'ユーザー名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ]);
    }
    */

    public function my_page_update(Request $request)
    {
        /* 2022/07/28 退避
        if ($request->hasFile('image')) { //イメージが変更されてたら

             //// 画像のアップロード ////
            $dir = 'img_prof'; // ディレクトリ名

            // sampleディレクトリに画像を保存
            $request->file('image')->store('public/' . $dir);

             //// ファイル情報をDBに保存 ////
            $user_form = $request->all();

            $user = Auth::user();

            //不要な「_token」の削除
            // unset($user_form['_token']);

            // Auth::user()->profile_image = 'storage/' . $dir . '/' . $request->file('image')->hashName();
            $user->profile_image = 'storage/' . $dir . '/' . $request->file('image')->hashName();
            
            //保存　fill更新したいプロパティがたくさんある場合一行で修正できる
            $user->fill($user_form)->save();

        }
        */

        $user = Auth::user();
        $user_form = $request->all();
        if ($request->hasFile('image')) {
           $request->file('image')->store('public/img_prof');
           $user->profile_image = 'storage/img_prof/' . $request->file('image')->hashName();
       }
        $user->fill($user_form)->save();
        return redirect('/');
    }


}
