<?php

use App\Folder;
use App\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index')->name('home');

	Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
	Route::post('/folders/create', 'FolderController@create');

	Route::group(['middleware' => 'can:view,folder'], function () {
		Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

		Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
		Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

		Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
		Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');

		//// 削除機能 ////
		Route::get('/folders/{folder}/softdelete', 'FolderController@delete')->name('folder.delete');

		Route::get('/folders/{folder}/tasks/{task}/softdelete', 'TaskController@delete')->name('task.delete');

		Route::post('/folders/{folder}/tasks/{task}/update', 'TaskController@flagUpdate');
	});

	Route::get('/mypage/{id}/profile_edit', 'MypageController@index')->name('mypage.profile_edit');

	Route::post('/mypage/{id}/profile_edit', 'MypageController@myPageUpdate')->name('mypage.update');

	//// 7.31追記 ////
	Route::resource('users', 'Auth\SoftDeleteUserController')->only([
		'show', 'destroy'
	]);
	// 引数（任意の名前？， コントローラ， CRUD）
	Route::get('/mypage/{id}/delete_confirm', 'Auth\SoftDeleteUserController@delete_confirm')->name('delete_confirm');

});



Auth::routes();
