<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('file_type')->insert([
            [
                'key' => 'upload',
            ],
            [
                'key' => 'contract',
            ],
            [
                'key' => 'appeal',
            ],
            [
                'key' => 'repayment_calendar',
            ]
        ]);
    }
}
