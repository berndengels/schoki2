<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $file = '20201210_countries.sql';
            $sql = file_get_contents(database_path() . '/dumps/' . $file);
            DB::table('countries')->delete();
            DB::statement("ALTER TABLE countries AUTO_INCREMENT=1;");
            DB::unprepared($sql);
            $output = "<info>Success: countries imported</info>";

        } catch(Exception $e) {
            $output = "<error>Error: cant't import countries: " . $e->getMessage() . "</error>";
            Log::error("Error: cant't import countries " . $e->getMessage());
        }

        $this->command->getOutput()->writeln($output);
    }
}
