<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'user1@gmail.com'
        ]);

        factory(User::class)->create([
            'email' => 'user2@gmail.com'
        ]);

    }
}
