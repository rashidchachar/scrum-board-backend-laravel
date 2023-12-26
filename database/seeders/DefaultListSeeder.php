<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boardList = [
            [
                'title' => 'Drafts',
                'order' => 0,
            ],
            [
                'title' => 'In Progress',
                'order' => 1,
            ],
            [
                'title' => 'In Review',
                'order' => 2,
            ],
            [
                'title' => 'Completed',
                'order' => 3,
            ],
        ];

        DB::table('board_lists')->truncate();
        DB::table('board_lists')->insert($boardList);
    }
}
