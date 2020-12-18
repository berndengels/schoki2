<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionsAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $file = '20201218_permissions_and_roles.sql';
            $sql = file_get_contents(database_path() . '/dumps/' . $file);
            DB::unprepared($sql);
            $output = "<info>Success: permissions and roles imported</info>";

        } catch(Exception $e) {
            $output = "<error>Error: cant't import permissions and roles: " . $e->getMessage() . "</error>";
            Log::error("Error: cant't import permissions and roles " . $e->getMessage());
        }

        $this->command->getOutput()->writeln($output);
    }
}
