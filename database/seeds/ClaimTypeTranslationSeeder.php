<?php

use Illuminate\Database\Seeder;

class ClaimTypeTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('claim_type_translation')->insert([
            ['id' => '1', 'name' => 'nezaplatená faktúra', 'language_id' => '2', 'claim_type_id' => '1'],
            ['id' => '2', 'name' => 'nesplatená pôžička', 'language_id' => '2', 'claim_type_id' => '2'],
            ['id' => '3', 'name' => 'nevyplatené zmenky', 'language_id' => '2', 'claim_type_id' => '3'],
            ['id' => '4', 'name' => 'nevyplatené nájomné', 'language_id' => '2', 'claim_type_id' => '4'],
            ['id' => '5', 'name' => 'nevyplatené mzdy', 'language_id' => '2', 'claim_type_id' => '5'],
            ['id' => '6', 'name' => 'nevyplatené poistné plnenie', 'language_id' => '2', 'claim_type_id' => '6'],
            ['id' => '7', 'name' => 'náhrada škody', 'language_id' => '2', 'claim_type_id' => '7'],

            ['id' => '8', 'name' => 'invoice', 'language_id' => '1', 'claim_type_id' => '1'],
            ['id' => '9', 'name' => 'loan', 'language_id' => '1', 'claim_type_id' => '2'],
            ['id' => '10', 'name' => 'bill', 'language_id' => '1', 'claim_type_id' => '3'],
            ['id' => '11', 'name' => 'rent', 'language_id' => '1', 'claim_type_id' => '4'],
            ['id' => '12', 'name' => 'salary', 'language_id' => '1', 'claim_type_id' => '5'],
            ['id' => '13', 'name' => 'insurance', 'language_id' => '1', 'claim_type_id' => '6'],
            ['id' => '14', 'name' => 'indemnity', 'language_id' => '1', 'claim_type_id' => '7'],

            ['id' => '15', 'name' => 'nezaplacená faktura', 'language_id' => '3', 'claim_type_id' => '1'],
            ['id' => '16', 'name' => 'nesplacená půjčka', 'language_id' => '3', 'claim_type_id' => '2'],
            ['id' => '17', 'name' => 'nevyplacené směnky', 'language_id' => '3', 'claim_type_id' => '3'],
            ['id' => '18', 'name' => 'nevyplacené nájemné', 'language_id' => '3', 'claim_type_id' => '4'],
            ['id' => '19', 'name' => 'nevyplacené mzdy', 'language_id' => '3', 'claim_type_id' => '5'],
            ['id' => '20', 'name' => 'nevyplacené pojistné plnění', 'language_id' => '3', 'claim_type_id' => '6'],
            ['id' => '21', 'name' => 'náhrada škody', 'language_id' => '3', 'claim_type_id' => '7'],
        ]);
    }
}
