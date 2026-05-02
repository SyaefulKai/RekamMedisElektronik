<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class Icd9Seeder extends CsvSeeder
{

    public function __construct()
    {
        $this->file = '/database/seeders/csvs/icd9.csv';
        $this->tablename = 'icd9s';
        $this->delimiter = ',';
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::disableQueryLog();
        parent::run();
    }
}
