<?php
namespace Database\Seeders;

use App\Models\Address;
use App\Libs\MySeedImporter as Importer;

class AddressImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'address',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new Address();
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
