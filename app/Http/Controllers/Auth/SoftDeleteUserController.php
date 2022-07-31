<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; //追記
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Http\Controllers\Controller;
use App\User;

class SoftDeleteUserController extends Controller
{
	// use Notifiable;
	// use SoftDeletes; //追記
	// protected $dates = ['deleted_at'];

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		return redirect('/');
	}

	public function delete_confirm()
	{
		return view('mypage/delete_confirm');
	}
}
