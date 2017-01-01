<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        \App\Api\V1\Models\User::create(array(
            'firstname'=> 'Ronny',
            'lastname' => 'Freites',
            'email'    => 'ronnyangelo.freites@gmail.com',
	        'admin'    => true,
            'password' => \Illuminate\Support\Facades\Hash::make('nextdots'),
        ));
    }
}
