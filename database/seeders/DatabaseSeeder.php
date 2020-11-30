<?php

namespace Database\Seeders;

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
        $this->call([
//            CategoryImportSeeder::class,
//            ThemeImportSeeder::class,
//            AdminUserImportSeeder::class,
//            EventImportSeeder::class,
            EventPeriodicImportSeeder::class,
            EventTemplateImportSeeder::class,
        ]);
    }
}
