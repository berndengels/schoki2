<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeSeeder extends Seeder
{
    private $table = 'product_size';
    private $data = [
        ['name'  => 'S'],
        ['name'  => 'M'],
        ['name'  => 'L'],
        ['name'  => 'XL'],
        ['name'  => 'XXL'],
        ['name'  => '3XL'],
        ['name'  => '4XL'],
        ['name'  => '5XL'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table($this->table)->truncate();
        DB::statement("ALTER TABLE $this->table AUTO_INCREMENT=1;");
        foreach($this->data as $item) {
            DB::table($this->table)->insert($item);
        }
    }
}
