<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUserMusicStyleImportSeeder extends Seeder
{
    protected $tableParams = [
        'sourceTable'   => 'user_music_styles',
        'targetTable'   => 'admin_users_music_style',
        'sourceCols'    => null,
        'destCols'      => null,
    ];
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
