<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Post extends Model
{
  use HasFactory;
  //テーブル名指定
  protected $table = 'posts';

  //主キー指定
  protected $guarded = array('id');

  //自動日付挿入 無
  public $timestamp = 'false';

  public function get_post() {
    $data = DB::table($this->table)->get();
    return $data;
  }
}
