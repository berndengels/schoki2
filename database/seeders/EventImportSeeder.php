<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Libs\MySeedImporter as Importer;
use Illuminate\Support\Facades\Log;

class EventImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'event',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new Event;
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
        $this->import();
    }
}
