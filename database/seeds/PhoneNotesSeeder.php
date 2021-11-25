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
        factory(App\PhoneNote::class, 1000)->create();
    }
}
