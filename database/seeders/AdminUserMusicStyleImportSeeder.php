<?php
namespace Database\Seeders;

use App\Libs\MySeedImporter as Importer;
use App\Models\AdminUsersMusicStyle;

class AdminUserMusicStyleImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable'   => 'user_music_styles',
        'sourceCols'    => ['user_id','music_style_id'],
        'destCols'      => ['admin_user_id','music_style_id'],
    ];

    public function __construct()
    {
        $this->model = new AdminUsersMusicStyle();
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
