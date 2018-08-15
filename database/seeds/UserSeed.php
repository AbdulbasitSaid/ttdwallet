<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'abdulfatar@me.com', 'password' => '$2y$10$f/8akizwNQA9VGkvzUxO6OtL1cDSzYPALgh65o0NTaGHcYBC0dil.', 'role_id' => 1, 'remember_token' => '',],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
