<?php

use App\Doc;
use App\Koochro;
use App\Saabet;
use App\School;
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

        School::truncate();
        Koochro::truncate();
        Saabet::truncate();
        Doc::truncate();

        DB::table('hoozes')->insert([
            ['name' => 'کهنوج', 'parent_id' => null], ['name' => 'عنبرآباد', 'parent_id' => null], ['name' => 'جیرفت', 'parent_id' => null],
            ['name' => 'اسفندقه', 'parent_id' => null], ['name' => 'بافت', 'parent_id' => null],
            ['name' => 'رابر', 'parent_id' => null], ['name' => 'سیرجان', 'parent_id' => null],
            ['name' => 'شرق استان', 'parent_id' => null], ['name' => 'نجف شهر', 'parent_id' => 7],

        ]);

        factory(School::class, 30)->create();
        factory(Koochro::class, 10)->create();
        factory(Saabet::class, 10)->create();

        factory(Doc::class, 30)->create();

        DB::table('users')->insert([
            ['username' => 'mojraj', 'email' => 'moj2raj2@gmail.com', 'phone_number' => '0917',
                'name' => 'مجتبی', 'family' => 'رجبی', 'password' => '$2y$10$ES608U3ByfwiJlLmoJSYvuScaf2depjcMSk0PBNmCTCMMGX3J6EDW',
                'verified' => '1', 'role' => '0'],
        ]);
    }
}
