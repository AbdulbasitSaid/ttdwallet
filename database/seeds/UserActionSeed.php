<?php

use Illuminate\Database\Seeder;

class UserActionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'user_id' => 1, 'action' => 'created', 'action_model' => 'income_categories', 'action_id' => 1,],
            ['id' => 2, 'user_id' => 1, 'action' => 'created', 'action_model' => 'income_categories', 'action_id' => 2,],
            ['id' => 3, 'user_id' => 1, 'action' => 'created', 'action_model' => 'incomes', 'action_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\UserAction::create($item);
        }
    }
}
