<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Follow extends Model
{
    use HasFactory;
    protected $table = 'follows';

    public function get_follow_id($id)
    {
        return Follow::where('follow_user_id',$id)->where('user_id',Auth::id())->first()->follow_user_id;
    }

    public function already_follow($follow_user_id)
    {
        return Follow::where('follow_user_id',$follow_user_id)->where('user_id',Auth::id())->exists();
    }

    // フォロワー取得
    public function get_followers()
    {
      return Follow::where('follow_user_id',Auth::id())->get();
    }

    public function get_follower_user()
    {
      return $this->belongsTo('App\Models\User','user_id');
    }

    // フォロー取得
    public function get_follows()
    {
        return Follow::where('user_id',Auth::id())->get();
    }

    public function get_follow_user()
    {
      return $this->belongsTo('App\Models\User','follow_user_id');
    }
}
