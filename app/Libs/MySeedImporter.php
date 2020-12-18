<?php
namespace App\Libs;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Importer
 * @package Database\Seeders\Inc
 */
class MySeedImporter extends Seeder
{

    /**
     * @var array[]
     */
    protected $tableParams = null;
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
    protected $table = null;
    /**
     * @var Model
     */
    protected $model = null;
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
    public function import($delayed = true) {
        if(!$this->tableParams) {
            $this->command->getOutput()->writeln("<error>Bitte \$tableParams für $this->table Seeder setzen!</error>");
        } else {
            $source = $this->getSourceData();
            $data = $this->prepare($source);
            $delayed ? $this->insertDelayed($data) : $this->insert($data);
        }
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
        $this->command->getOutput()->writeln("Import progress for table $this->table");
        $this->command->withProgressBar($data, function($row) use (&$success, &$error) {
                try {
                    $this->model->insertOrIgnore($row);
                    $success++;
                } catch(Exception $e) {
                    $error++;
                    Log::error("Error: cant't import $this->table: " . $e->getMessage());
                }
            });

        $this->command->newLine();
        $msg = "all Data: $this->count, imported: $success, errors: $error";
        $this->command->getOutput()->writeln("<info>$msg</info>");
    }

    private function prepare($source)
    {
        if(is_array($this->tableParams['destCols']) && count($this->tableParams['destCols']) > 0) {
            $data   = [];
            foreach( $source as $index => $row) {
                $i = 0;
                $data[$index] = [];
                foreach($row as $key => $value) {
                    $data[$index][$this->tableParams['destCols'][$i]] = $value;
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
            ->table($this->tableParams['sourceTable'])
            ->select($this->tableParams['sourceCols'] ?? $this->getTableColumns($this->model))
            ->get()
        ;
        $this->count = $source->count();
        Schema::enableForeignKeyConstraints();
        return json_decode(json_encode($source), true);
    }

    protected function sanitizeTimeColumn($column)
    {
        $data = [];
        $query = $this->sourceConnection->table($this->table);

        if(0 === $query->where($column, '=', '')->count()) {
            return null;
        }

        $query
            ->select(['id',$column])
            ->get()
            ->each(function ($model) use (&$data, $column) {
                if('' === $model->$column) {
                    $data[$model->id] = [$column => '19:00:00'];
                } else {
                    preg_match('/^([0-9]{2})(:[0-9]{0,2})([a-z ]*)$/i', $model->$column, $matches);
                    if(count($matches) > 0 && '' !== $matches[1]) {
                        $newValue = $matches[1];
                        if('' !== $matches[2]) {
                            $newValue .= $matches[2];
                        } else {
                            $newValue .= ':00';
                        }
                        $data[$model->id] = [$column => $newValue];
                    }
                }
            });

        if(count($data) > 0) {
            $this->model->lockForUpdate();
            foreach ($data as $id => $item) {
                $eventTime = $item[$column];
                $this->sourceConnection
                    ->update("UPDATE $this->table SET $column = '?' where id = ?", [$eventTime, $id])
                ;
            }
            $this->model->lock(false);
        }
    }
}
