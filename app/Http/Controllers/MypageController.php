<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = DB::table('users')->find($id);
        return view('/mypage/profile_edit', ['id' => $id]);
    }


    public function my_page_update(Request $request)
    {
        if ($request->hasFile('top_imag')) {
            $id = Auth::id();
            $photo_path = $request->file('top_image')->store('public/top_file');
            $top_image_pass = basename($photo_path);
            // DBの対象カラムを更新する
            $affected = DB::table('users')
                ->where('id', $id)
                ->update(['profile_photo_path' => $top_image_pass]);
            // 画像に表示させる
            return redirect("/mypage")->with([
                "message" => "マイページ画像を変更しました。",
                "top_image_pass" => $top_image_pass
            ]);
        }
    }
}
