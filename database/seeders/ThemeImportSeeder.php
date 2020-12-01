<?php

namespace Database\Seeders;

use App\Models\Theme;
use Database\Seeders\Inc\Importer;

class ThemeImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'theme',
        'sourceCols' => ['id','name','slug','icon'],
        'destCols' => ['id','name','slug','icon'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::import(new Theme);
    }
}
