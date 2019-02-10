<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JournalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('journals')->insert([
            'date' => '2018-12-31',
            'debit' => 7,
            'debit_sub_account' => '',
            'credit' => 5,
            'credit_sub_account' => '',
            'amount' => 4000,
            'remark' => '資本金の払い込み',
            'user_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }
}
