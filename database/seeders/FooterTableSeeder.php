<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('footers')->insert([
      [
        'id' => '1',
        'number' => '81383 766 284',
        'short_description' => 'Easy There are many variations of passages of lorem ipsum available but the majority have suffered alteration in some form is also here.',
        'adress' => 'Level 13, 2 Elizabeth Steereyt set Melbourne, USA',
        'email' => 'Support@easylearningbd.com',
        'facebook' => 'https://www.facebook.com/ele',
        'twitter' => 'https://www.twitter.com/ele',
        'copyright' => '© Easy Learning 20223',
        'created_at' => NULL,
        'updated_at' => '2022-03-22 02:11:20',
      ],
    ]);
  }
}
