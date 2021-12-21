<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        if (app()->environment() === 'testing') {
            DB::table('users')->insert([
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => Hash::make('password'),
                'role' => 'user'
            ]);

            DB::table('users')->insert([
                'name' => 'Moderator',
                'email' => 'moderator@moderator.com',
                'password' => Hash::make('password'),
                'role' => 'moderator'
            ]);

            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]);
        } else {
            factory(App\User::class, 20)->create();
        }

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