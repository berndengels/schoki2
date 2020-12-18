<?php
namespace Database\Seeders;

use App\Models\AdminUser;
use App\Libs\MySeedImporter as Importer;

class AdminUserImportSeeder extends Importer
{
    protected $tableParams = [
        'sourceTable' => 'my_user',
        'sourceCols' => ['id','username','email','password','remember_token','enabled','last_login','created_at','updated_at'],
        'destCols' => ['id','first_name','email','password','remember_token','activated','last_login_at','created_at','updated_at'],
    ];

    public function __construct()
    {
        $this->model = new AdminUser();
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
