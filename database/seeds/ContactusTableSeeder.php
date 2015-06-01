<?php

use Illuminate\Database\Seeder;

class ContactusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\Contactus',1)->create();
    }
}
