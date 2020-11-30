<?php

namespace Database\Seeders;

use Brackets\AdminAuth\Models\AdminUser;
use Database\Seeders\Inc\Importer;

class AdminUserImportSeeder extends Importer
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::import(new AdminUser);
    }
}
