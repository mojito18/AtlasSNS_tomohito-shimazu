<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

//新規登録ルーティング表示
Route::get('/register', 'Auth\RegisterController@register');
//新規登録処理，機能
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ミドルウェア
Route::group(['Middleware'=>'Auth'],function(){

  //ログイン中のページ
Route::get('/top','PostsController@index');
//ログアウトルーティング
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/profile','UsersController@profile');

//検索機能
Route::get('/search','UsersController@search');//indexをsearchに変更
Route::post('/search','UsersController@search');//

Route::get('/follow-list','followsController@followList');
Route::get('/follower-list','followsController@followerList');

//投稿フォーム
Route::get('/post','PostsController@index');
Route::post('/post/create','PostsController@create');

//フォロー機能
Route::post('/user/{id}','FollowsController@follow');
Route::get('/user/{id}/unfollow','FollowsController@unfollow');
});
 //削除機能
 Route::get('/post/{id}/delete','PostsController@destroy');
