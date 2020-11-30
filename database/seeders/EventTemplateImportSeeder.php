<?php
namespace Database\Seeders;

use App\Models\EventTemplate;
use Database\Seeders\Inc\Importer;

class EventTemplateImportSeeder extends Importer
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->import(new EventTemplate);
    }
}
