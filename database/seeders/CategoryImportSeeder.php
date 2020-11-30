<?php
namespace Database\Seeders;

use App\Models\Category;
use Database\Seeders\Inc\Importer;

class CategoryImportSeeder extends Importer
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::import(new Category);
    }
}
