<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ClaimTypeSeeder::class);
        $this->call(ClaimStatusSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(ClaimTypeTranslationSeeder::class);
        $this->call(InterestRateSeeder::class);
    }
}
