<?php
namespace Database\Seeders;

use App\Models\EventTemplate;
use Database\Seeders\Inc\Importer;

class EventTemplateImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'event_template',
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
        $this->import(new EventTemplate);
    }
}
