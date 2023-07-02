<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSlidersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('home_slides')->insert([
      [
        'id' => '1',
        'title' => 'Best Product in the shortest time now',
        'short_title' => 'Rasalina based product design & visual designer focused on crafting clean & user-friendly experiences',
        'home_slide' => Null,
        'video_url' => 'https://youtu.be/XHOmBV4js_E',
        'created_at' => Null,
        'updated_at' => Null,
      ],

    ]);
  }
}
