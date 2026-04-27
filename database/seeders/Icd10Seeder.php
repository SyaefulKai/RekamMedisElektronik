<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class Icd10Seeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeders/csvs/icd10.csv';
        $this->tablename = 'icd10s';
    }

    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }
}
