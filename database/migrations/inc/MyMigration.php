<?php
//namespace Database\Migrations\Inc;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class MyMigration extends Migration
{
    protected $dbServerVersion = null;
    protected $dbServerName = null;
    protected $mustVersion = '10.2.7';
    protected $jsonSupported = false;

    public function __construct() {
        $result = DB::select( DB::raw('SHOW VARIABLES LIKE "version"') );
        if($result && count($result) > 0) {
            list($this->dbServerVersion, $this->dbServerName) = explode('-', $result[0]->Value);
            if($this->dbServerVersion >= $this->mustVersion) {
                $this->jsonSupported = true;
            }
        }
    }
}
