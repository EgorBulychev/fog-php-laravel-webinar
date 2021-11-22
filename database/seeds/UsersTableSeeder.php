<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\User::class, 20)->create();

        // todo разобраться с сидерами и фабриками
        // https://laravel.com/docs/5.5/seeding
        // if (config('app.env') == 'production') {
        //     DB::table('users')->insert([
        //         'name' => str_random(10),
        //         'email' => str_random(10).'@gmail.com',
        //         'password' => bcrypt('secret'),
        //     ]);
        // }
        // if (config('app.env') == 'develop') {
        //     factory();
        // }
    }
}