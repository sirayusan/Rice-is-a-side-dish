<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class Postseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
      $now = new DateTime();
      $now->format('Y-m-d');
      DB::table('posts')->insert([
        'user_id' => '999',
        'comment' => Str::random(10),
        'created_at' => $now,
      ]);
    }
}
