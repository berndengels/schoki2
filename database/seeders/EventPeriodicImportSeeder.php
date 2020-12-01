<?php
namespace Database\Seeders;

use App\Models\EventPeriodic;
use Database\Seeders\Inc\Importer;

class EventPeriodicImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'event_periodic',
        'sourceCols' => null,
        'destCols' => null,
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->sanitizeTimeColumn('event_time');
        $this->import(new EventPeriodic);
    }
}
