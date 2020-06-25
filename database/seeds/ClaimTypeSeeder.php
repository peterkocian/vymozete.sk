<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClaimTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('claim_type')->insert([
            [
                'key' => 'invoice',
                'name' => 'nezaplatená faktúra',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'key' => 'alimony',
                'name' => 'nezaplatené výživné',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'key' => 'loan',
                'name' => 'nesplatená pôžička',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'key' => 'bill',
                'name' => 'nevyplatené zmenky',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'key' => 'rent',
                'name' => 'nevyplatené nájomné',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'key' => 'salary',
                'name' => 'nevyplatené mzdy',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'key' => 'insurance',
                'name' => 'nevyplatené poistné plnenie',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ],[
                'key' => 'indemnity',
                'name' => 'náhrada škody',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
