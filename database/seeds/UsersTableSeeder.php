<?php

class UsersTableSeeder
{
    public function run()
    {
        // todo разобраться с сидерами и фабриками
        // https://laravel.com/docs/5.5/seeding
        if (config('app.env') == 'production') {
            DB::table('users')->insert([
                'name' => str_random(10),
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),
            ]);
        }
        if (config('app.env') == 'develop') {
            factory();
        }
    }
}