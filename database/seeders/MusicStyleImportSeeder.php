<?php
namespace Database\Seeders;

use App\Models\MusicStyle;
use App\Libs\MySeedImporter as Importer;

class MusicStyleImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'music_style',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new MusicStyle();
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
