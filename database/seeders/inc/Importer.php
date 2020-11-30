<?php
namespace Database\Seeders\Inc;

use Exception;
use Illuminate\Support\Facades\Log;
use PDO;
use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console;

/**
 * Class Importer
 * @package Database\Seeders\Inc
 */
class Importer extends Seeder
{
    /**
     * @var array[]
     */
    protected $tables = [
        'admin_users' => [
            'sourceTable' => 'my_user',
            'sourceCols' => ['id','username','email','password','remember_token','enabled','last_login','created_at','updated_at'],
            'destCols' => ['id','first_name','email','password','remember_token','activated','last_login_at','created_at','updated_at'],
        ],
        'category'  => [
            'sourceTable' => 'category',
            'sourceCols' => ['id','name','slug','icon'],
            'destCols' => ['id','name','slug','icon'],
        ],
        'theme' => [
            'sourceTable' => 'theme',
            'sourceCols' => ['id','name','slug','icon'],
            'destCols' => ['id','name','slug','icon'],
        ],
        'event' => [
            'sourceTable' => 'event',
//            'sourceCols' => ['id','','','','','','','','','','','','','','','',''],
            'sourceCols' => null,
            'destCols' => null,
        ],
        'event_periodic' => [
            'sourceTable' => 'event_periodic',
//            'sourceCols' => ['id','','','','','','','','','','','','','','','',''],
            'sourceCols' => null,
            'destCols' => null,
        ],
        'event_template' => [
            'sourceTable' => 'event_template',
//            'sourceCols' => ['id','','','','','','','','','','','','','','','',''],
            'sourceCols' => null,
            'destCols' => null,
        ],
    ];
    /**
     * @var Connection $sourceConnection
     */
    protected $sourceConnection;
    /**
     * @var Connection $destConnection
     */
    protected $destConnection;
    /**
     * @var string
     */
    protected $table;
    /**
     * @var Model
     */
    protected $model;
    /**
     * @var int
     */
    protected $count;

    /**
     * Importer constructor.
     */
    public function __construct()
    {
        $this->sourceConnection = DB::connection('mysql_old');
        $this->destConnection   = DB::connection('mysql');
        $this->table = $this->model->getTable();
    }

    /**
     * @param Model $model
     * @return array
     */
    private function getTableColumns() {
        return $this
            ->model
            ->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($this->model->getTable());
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function import($delayed = false) {
        $source = $this->getSourceData();
        $data = $this->prepare($source);
        $delayed ? $this->insertDelayed($data) : $this->insert($data);
    }

    protected function insert($data)
    {
        try {
            $this->model->insertOrIgnore($data);
            $output = "<info>Success: import $this->count rows in $this->table</info>";
        } catch(Exception $e) {
            $output = "<error>Error: cant't import $this->table: " . $e->getMessage() . "</error>";
            Log::error("Error: cant't import $this->table: " . $e->getMessage());
        }

        $this->command->getOutput()->writeln($output);
    }

    protected function insertDelayed($data)
    {
        $success = 0;
        $error = 0;
        foreach($data as $row) {
            try {
                $this->model->insertOrIgnore($row);
                $success++;
            } catch(Exception $e) {
                $error++;
                Log::error("Error: cant't import $this->table: " . $e->getMessage());
            }
        }
        $msg = "all Data: $this->count, imported: $success, errors: $error";
        $this->command->getOutput()->writeln("<info>$msg</info>");
    }

    private function prepare($source)
    {
        $data = [];
        if($this->tables[$this->table]['destCols']) {
            $data   = [];
            foreach( $source as $index => $row) {
                $i = 0;
                $data[$index] = [];
                foreach($row as $key => $value) {
                    $data[$index][$this->tables[$this->table]['destCols'][$i]] = $value;
                    $i++;
                }
            }
        } else {
            $data = $source;
        }
        return $data;
    }

    private function getSourceData()
    {
        Schema::disableForeignKeyConstraints();
        $this->model->truncate();
        $source = $this->sourceConnection
            ->table($this->tables[$this->table]['sourceTable'])
            ->select($this->tables[$this->table]['sourceCols'] ?? $this->getTableColumns($this->model))
            ->get()
        ;
        $this->count = $source->count();
        Schema::enableForeignKeyConstraints();
        return json_decode(json_encode($source), true);
    }

}
