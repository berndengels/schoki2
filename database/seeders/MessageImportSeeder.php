<?php
namespace Database\Seeders;

use App\Models\Message;
use Database\Seeders\Inc\Importer;

class MessageImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'message',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new Message();
        parent::__construct();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::import();
    }
}
