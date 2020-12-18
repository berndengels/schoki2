<?php
namespace Database\Seeders;

use App\Models\EventTemplate;
use App\Libs\MySeedImporter as Importer;

class EventTemplateImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'event_template',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new EventTemplate();
        parent::__construct();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->import(false);
    }
}
