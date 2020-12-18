<?php
namespace Database\Seeders;

use App\Models\EventPeriodic;
use App\Libs\MySeedImporter as Importer;

class EventPeriodicImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'event_periodic',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new EventPeriodic();
        parent::__construct();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->sanitizeTimeColumn('event_time');
        $this->import(false);
    }
}
