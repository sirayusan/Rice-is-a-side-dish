<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
    use HasFactory;
    //テーブル名指定
    protected $table = 'posts';

    //主キー指定
    protected $guarded = array('id');

}
