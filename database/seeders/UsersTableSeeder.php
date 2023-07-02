<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
        'name' => 'Admin',
        'profile_image' => Null,
        'email' => 'admin@gmail.com',
        'username' => 'admin1',
        'password' => Hash::make('password123'),
        'created_at' => Null,
        'updated_at' => Null,
      ],

    ]);
  }
}
