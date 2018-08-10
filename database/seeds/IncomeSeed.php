<?php

use Illuminate\Database\Seeder;

class IncomeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'income_category_id' => 1, 'entry_date' => '2018-08-16', 'amount' => '10000', 'branch_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Income::create($item);
        }
    }
}
