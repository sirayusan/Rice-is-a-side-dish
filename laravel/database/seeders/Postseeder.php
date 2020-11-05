<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('posts')->insert([
        'user_id' => '1',
        'comment' => Str::random(10),
      ]);
    }
}
