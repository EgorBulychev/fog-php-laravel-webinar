<?php

use Illuminate\Database\Seeder;

class PhoneNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment() === 'testing') {

        } else {
            factory(App\PhoneNote::class, 1000)->create();
        }
    }
}
