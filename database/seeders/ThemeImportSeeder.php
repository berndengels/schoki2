<?php

namespace Database\Seeders;

use App\Models\Theme;
use Database\Seeders\Inc\Importer;

class ThemeImportSeeder extends Importer
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::import(new Theme);
    }
}
