<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Follow extends Model
{
    use HasFactory;
    protected $table = 'follows';
}
