<?php

namespace Database\Seeders;

use App\Models\Event;
use Database\Seeders\Inc\Importer;
use Illuminate\Support\Facades\Log;

class EventImportSeeder extends Importer
{
    public function __construct()
    {
        $this->model = new Event;
        parent::__construct();
    }

    private function sanitize()
    {
        $data = [];
        $query = $this->sourceConnection->table('event');
        if(0 === $query->where('event_time', '=', '')->count()) {
            return;
        }
        $query
            ->select(['id','event_time'])
            ->get()
            ->each(function ($evt) use (&$data) {
                if('' === $evt->event_time) {
                    $data[$evt->id] = ['event_time' => '19:00:00'];
                } else {
                    preg_match('/^([0-9]{2})(:[0-9]{0,2})([a-z ]*)$/i', $evt->event_time, $matches);
                    if(count($matches) > 0 && '' !== $matches[1]) {
                        $newValue = $matches[1];
                        if('' !== $matches[2]) {
                            $newValue .= $matches[2];
                        } else {
                            $newValue .= ':00';
                        }
                        $data[$evt->id] = ['event_time' => $newValue];
                    }
                }
            });

        if(count($data) > 0) {
            foreach ($data as $id => $item) {
                $eventTime = $item['event_time'];
                $this->sourceConnection
                        ->update('UPDATE event SET event_time = ? where id = ?', [$eventTime, $id])
                ;
            }
        }
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->sanitize();
        $this->import(true);
    }
}
