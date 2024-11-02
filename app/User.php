<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //リレーション１対多
    public function posts(){
        return $this->hasMany('App\Post');
}
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',//カラム名
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //followingの多対多
    public function follows(){
            return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');//followsテーブルのカラム
    }

    //followedの多対多
    public function followers(){
            return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');//カラムの順番によってどちらに自分を入れるのかにって順番が変わる/3番が自分
    }

//フォローカウント
    public function followingCount()
{
    return $this->follows()->count();
}
//フォロワーカウント
public function followersCount()
{
    return $this->followers()->count();
}

    //中間テーブル　アタッチ
    public function follow(Int $user_id){
        return $this->follows()->attach($user_id);
    }

    //中間テーブル　デタッチ
    public function unfollow(Int $user_id){
        return $this->follows()->detach($user_id);//followsは登録するテーブルを記載
    }
    //フォローの人数取得
    public function isFollowing(Int $user_id){
        // dd($user_id);
        return (boolean) $this->follows()->where('followed_id',$user_id)->first
        (['follows.id']);
        //booleanは重複しないようにすでにフォローしているかしていないかを「真偽値」で返している
    }
    //フォローワーの取得人数
    public function isFollowed(Int $user_id){
        return (boolean) $this->followers()->where('followed_id',$user_id)->first(['follows.id']);
    }

}
