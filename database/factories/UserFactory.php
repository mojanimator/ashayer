<?php

use App\Doc;
use App\Koochro;
use App\Saabet;
use App\School;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(School::class, function (\Faker\Generator $faker) {
//    $i = $faker->imageUrl();
//    $date = jdate();
    $date = Carbon\Carbon::now();
    return [
        'province_id' => 1,
        'schoolable_type' => $faker->randomElement(['App\Saabet', 'App\Koochro']),
        'schoolable_id' => $faker->numberBetween(2, 10),
        'is_roozane' => $faker->randomElement([true, false]),
        'name' => $faker->name,
        'code_madrese' => $faker->numberBetween(1, 10),
        'code_faza' => $faker->numberBetween(1, 10),
        'sale_tasis' => '13' . $faker->randomNumber(2),
        'doore' => $faker->randomElement(['0', '0$1', '0$1$2',]),
        'tedad_daneshamooz' => $faker->numberBetween(5, 30),
        'vaziat' => $faker->randomElement(['m', 'm', 'd$4$6', 'a$1']),
        'jensiat' => $faker->randomElement(['a', 'b', 'g',]),
        'tedad_paye_tahsili' => $faker->numberBetween(2, 5),
        'tedad_hamkaran' => $faker->numberBetween(2, 10),
        'noe_fazaye_amoozeshi' => $faker->randomElement(['c', 's', 'k',]), //chador sakhteman kaneks
        'hooze_namayandegi_id' => $faker->numberBetween(1, 9),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
$factory->define(Saabet::class, function (\Faker\Generator $faker) {
    $date = Carbon\Carbon::now();
    return [
        'address' => $faker->address,
        'loc' => '30.28' . $faker->numberBetween(10, 50) . ',' . '57.05' . $faker->numberBetween(10, 50),
        'fasele_az_shahrestan' => $faker->randomNumber(2),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
$factory->define(Koochro::class, function (\Faker\Generator $faker) {
    $date = Carbon\Carbon::now();
    return [
        'type' => $faker->randomElement(['s', 'n',]),
        'address_yeylagh' => $faker->address,
        'loc_yeylagh' => '30.28' . $faker->numberBetween(10, 50) . ',' . '57.05' . $faker->numberBetween(10, 50),
        'fasele_az_shahrestan_yeylagh' => $faker->randomNumber(2),
        'address_gheshlagh' => $faker->address,
        'loc_gheshlagh' => '30.28' . $faker->numberBetween(10, 50) . ',' . '57.05' . $faker->numberBetween(10, 50),
        'fasele_az_shahrestan_gheshlagh' => $faker->randomNumber(2),
        'masire_kooch' => $faker->latitude . ',' . $faker->longitude . '$' . $faker->latitude . ',' . $faker->longitude,
        'masafate_kooch' => $faker->randomNumber(2),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});

$factory->define(Doc::class, function (\Faker\Generator $faker) {
    $date = Carbon\Carbon::now();
    return [
        'school_id' => $faker->numberBetween(1, 20),
        'uploader_id' => $faker->numberBetween(1, 3),
        'doc_type' => 'img/jpg',
        'path' => 'img/school-' . $faker->numberBetween(1, 6) . '.jpg',
        'created_at' => $date,
        'updated_at' => $date,
    ];
});