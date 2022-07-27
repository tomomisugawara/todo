<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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


    public function my_page_update(Request $request)
    {
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

            Auth::user()->profile_image = 'storage/' . $dir . '/' . $request->file('image')->hashName();

            //保存　fill更新したいプロパティがたくさんある場合一行で修正できる
            $user->fill($user_form)->save();

        }
        return redirect('/');
    }


}
