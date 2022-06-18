<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
              'name'=>'Denis',
              'email'=>'test@test.com',
              'password'=>bcrypt("000000")
            ]
          ]);
    }
}