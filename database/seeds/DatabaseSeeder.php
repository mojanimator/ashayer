<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('madrese')->insert([
            ['name' => 'مدرسه عشایر 1', 'location' => '29.009154207916822, 56.752853202513485', 'students_num' => 31],
            ['name' => 'مدرسه عشایر 2', 'location' => '29.109154207916822, 56.543453202513485', 'students_num' => 12],
            ['name' => 'مدرسه عشایر 3', 'location' => '29.012344207916822, 56.135453202513485', 'students_num' => 5],
        ]);

    }
}
