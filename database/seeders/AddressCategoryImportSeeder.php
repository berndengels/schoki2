<?php
namespace Database\Seeders;

use App\Models\AddressCategory;
use App\Libs\MySeedImporter as Importer;

class AddressCategoryImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'address_category',
        'sourceCols' => null,
        'destCols' => null,
    ];

    public function __construct()
    {
        $this->model = new AddressCategory();
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
