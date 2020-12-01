<?php
namespace Database\Seeders;

use App\Models\Event;
use Database\Seeders\Inc\Importer;

class AddressCategoryImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'address_category',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new Event;
        parent::__construct();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}
