<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\PostController;
use Illuminate\Database\Eloquent\Model;
class Replies extends Model
{
    use HasFactory;
    protected $table = 'Replies';

    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
