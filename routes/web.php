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
Route::get('/top','PostsController@index')->name('topPage');
//ログアウトルーティング
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/profile','UsersController@profile');

//検索機能
Route::get('/search','UsersController@search');//indexをsearchに変更
Route::post('/search','UsersController@search');//

//フォローリスト表示
Route::get('/follow-list','followsController@followList')->name('follow-listPage');
//フォロワーリスト表示
Route::get('/follower-list','followsController@followerList')->name('follower-listPage');

//投稿フォーム
Route::get('/post','PostsController@index');
Route::post('/post/create','PostsController@create');
//投稿編集アップロード
//Route::get('/post/{id}/updateForm','PostsController@updateForm');
//投稿編集完了　10/29
Route::post('/post/update','PostsController@update');

//9/20 ユーザー投稿一覧
//Route::get('/user/{id}/posts', 'PostController@userPosts');
Route::get('/users/{user}', 'UsersController@profile')->name('users.profile');
//プロフィール編集 9/26更新
Route::put('/profile/update','UsersController@update');
//フォロワーリストから他のユーザー画面表示
Route::get('users/{user}/profile', 'UsersController@OtherUsers')->name('users.OtherUsers');


//フォロー機能
Route::post('/user/{id}','FollowsController@follow');
Route::post('/user/unfollow/{id}','FollowsController@unfollow');//getからpostに変更．．/user/{id}/unfollow/→/user/unfollow/{id}
});
 //削除機能
Route::get('/post/{id}/delete','PostsController@destroy');
