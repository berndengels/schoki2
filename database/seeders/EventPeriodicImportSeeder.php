<?php
namespace Database\Seeders;

use App\Models\EventPeriodic;
use Database\Seeders\Inc\Importer;

class EventPeriodicImportSeeder extends Importer
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->import(new EventPeriodic);
    }
}
