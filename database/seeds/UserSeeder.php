<?php

use Illuminate\Database\Seeder;
use Tsny\Models\User;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();

        User::create([
            'name' => 'admin',
            'email' => 'admin@ceuhelper.com',
            'password' => 'password'
        ]);

        factory(User::class, 10)->create();


    }
}
