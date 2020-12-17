<?php

use Illuminate\Database\Seeder;

class ClaimStatusTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('claim_status_translation')->insert([
            ['id' => '1', 'name' => 'vytvorená', 'task' => 'task', 'language_id' => '2', 'claim_status_id' => '1'],

            ['id' => '2', 'name' => 'created', 'task' => 'task', 'language_id' => '1', 'claim_status_id' => '1'],

            ['id' => '3', 'name' => 'vytvořená', 'task' => 'task', 'language_id' => '3', 'claim_status_id' => '1'],
        ]);
    }
}
