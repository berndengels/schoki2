<?php
namespace App\Libs;

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
            if(version_compare($this->dbServerVersion, $this->mustVersion, '>=')) {
                $this->jsonSupported = true;
            }
        }
    }

    public function info()
    {
        echo 'we need version: '.$this->mustVersion.', you have: '.$this->dbServerVersion .', json support: '.($this->jsonSupported ? 'OK' : 'NO') ;
    }

    /**
     * @return null
     */
    public function getDbServerVersion()
    {
        return $this->dbServerVersion;
    }

    /**
     * @return null
     */
    public function getDbServerName()
    {
        return $this->dbServerName;
    }

    /**
     * @return string
     */
    public function getMustVersion(): string
    {
        return $this->mustVersion;
    }

    /**
     * @return bool
     */
    public function isJsonSupported(): bool
    {
        return $this->jsonSupported;
    }
}
