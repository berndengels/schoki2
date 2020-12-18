<?php
namespace Database\Seeders;

use App\Models\Menu;
use App\Libs\MySeedImporter as Importer;

class MenuImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'menu',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new Menu();
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
