<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

use App\Models\FileImage;

use Illuminate\Support\Facades\Storage;//8/12追記

class MypageController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = DB::table('users')->find($id);
        // $data = FileImage::all();
        return view('/mypage/profile_edit', ['id' => $id]);
    }


    public function myPageUpdate(EditUser $request)
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
        dd($_FILES['name']);
        exit;

        $user = Auth::user();
        $user_form = $request->all();
        if ($request->file('image')->isValid()) {
            $file = $user_form['image'];
            // $request->file('image')->store('public/img_prof');
            $path = Storage::disk('s3')->put('/',$file, 'public');
            // $user->profile_image = 'storage/img_prof/' . $request->file('image')->hashName();
        }
        $user->fill($user_form)->save();
        return redirect('/');


        // $tweet = new Tweet();

        // if($request->file('image')->isValid()) {
        //     $file = $params['image'];
        //     //バケットにフォルダを作ってないとき(裸で保存)
        //     $path = Storage::disk('s3')->put('/',$file, 'public');
        //     //バケットに「test」フォルダを作っているとき
        //     $path = Storage::disk('s3')->put('/test',$file, 'public');
        //     $tweet->image = $path;
        // }

        // $tweet->save();
        // return redirect('/tweets');

    }

}