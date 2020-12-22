<?php

use Illuminate\Database\Seeder;

class FileTypeTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('file_type_translation')->insert([
            ['name' => 'upload', 'language_id' => '2', 'file_type_id' => '1'],
            ['name' => 'zmluva', 'language_id' => '2', 'file_type_id' => '2'],
            ['name' => 'výzva', 'language_id' => '2', 'file_type_id' => '3'],
            ['name' => 'splátkový kalendár', 'language_id' => '2', 'file_type_id' => '4'],

            ['name' => 'upload', 'language_id' => '1', 'file_type_id' => '1'],
            ['name' => 'contract', 'language_id' => '1', 'file_type_id' => '2'],
            ['name' => 'appeal', 'language_id' => '1', 'file_type_id' => '3'],
            ['name' => 'repayment calendar', 'language_id' => '1', 'file_type_id' => '4'],

            ['name' => 'upload', 'language_id' => '3', 'file_type_id' => '1'],
            ['name' => 'smlouva', 'language_id' => '3', 'file_type_id' => '2'],
            ['name' => 'výzva', 'language_id' => '3', 'file_type_id' => '3'],
            ['name' => 'splátkový kalendář', 'language_id' => '3', 'file_type_id' => '4'],
        ]);
    }
}
