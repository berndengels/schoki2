<?php
namespace Database\Seeders;

use App\Models\Category;
use Database\Seeders\Inc\Importer;

class CategoryImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'category',
        'sourceCols' => ['id','name','slug','icon'],
        'destCols' => ['id','name','slug','icon'],
    ];

    public function __construct()
    {
        $this->model = new Category();
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
