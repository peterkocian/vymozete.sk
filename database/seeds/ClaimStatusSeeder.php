<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClaimStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('claim_status')->insert([
            [
                'key'           => 'created',
                'next_step'     => 'next step popis co treba urobit v tomto kroku spracovania',
                'schedule_ntf'  => 'schedule_ntf',
                'timeout'       => 'timeout',
            ]
        ]);
    }
}
