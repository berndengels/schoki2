<?php
namespace Database\Seeders;

use App\Models\Page;
use App\Libs\MySeedImporter as Importer;

class PageImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'page',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new Page();
        parent::__construct();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::import(false);
    }
}
