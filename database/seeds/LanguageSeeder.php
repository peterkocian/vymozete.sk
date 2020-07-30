<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
        DB::table('language')->insert([
            [
                'key' => 'en',
                'name' => 'English',
                'default' => 0,
            ],
            [
                'key' => 'sk',
                'name' => 'Slovak',
                'default' => 1,
            ],
            [
                'key' => 'cs',
                'name' => 'Czech',
                'default' => 0,
            ],
        ]);
    }
}
