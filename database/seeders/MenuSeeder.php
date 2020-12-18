<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $file   = '20201218_menu.sql';
            $sql    = file_get_contents(database_path() . '/dumps/' . $file);
            DB::table('menu')->lock();
            DB::table('menu')->delete();
            DB::statement("ALTER TABLE menu AUTO_INCREMENT=1;");
            DB::unprepared($sql);
            DB::table('menu')->lock(false);
            $output = "<info>Success: new menu imported</info>";

        } catch(Exception $e) {
            $output = "<error>Error: cant't import countries: " . $e->getMessage() . "</error>";
            Log::error("Error: cant't import countries " . $e->getMessage());
        }

        $this->command->getOutput()->writeln($output);
    }
}
