<?php
namespace Database\Seeders;

use App\Models\Theme;
use App\Libs\MySeedImporter as Importer;

class ThemeImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'theme',
        'sourceCols' => ['id','name','slug','icon'],
        'destCols' => ['id','name','slug','icon'],
    ];

    public function __construct()
    {
        $this->model = new Theme();
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
