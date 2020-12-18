<?php
namespace Database\Seeders;

use App\Models\MenuItemType;
use App\Libs\MySeedImporter as Importer;

class MenuItemTypeSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'menu_item_type',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new MenuItemType();
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
