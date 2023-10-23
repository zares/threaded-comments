<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $sqlDump = base_path('database/dumps/data.sql');

        DB::unprepared(
            file_get_contents($sqlDump)
        );
    }
}
