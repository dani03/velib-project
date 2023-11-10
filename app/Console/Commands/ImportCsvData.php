<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use League\Csv\Reader;

class ImportCsvData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'importation des données de mon CSV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //dd(storage_path('app/public/velib-disponibilite-en-temps-reel.csv'));
        $csv = Reader::createFromPath(storage_path('app/public/velib-disponibilite-en-temps-reel.csv'), 'r');
        $csv->setHeaderOffset(0);


        $data = [];
        foreach ($csv->getRecords() as $records) {
            // dd($records);
            foreach ($records as $key => $value) {
                $headerArray = explode(";", $key);
                $valuesArray = explode(";", $value);
                $result = array_combine($headerArray, $valuesArray);   
            }
            print_r($result);
            //Redis::hmset($result["theid"], $result);
            Redis::command('hmset', [$result["theid"], $result]);
        }

        $this->info('données importés.');
    }
}
