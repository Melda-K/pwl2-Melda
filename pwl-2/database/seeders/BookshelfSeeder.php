<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Bookshelf;

class BookshelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookshelfs')->insert(
            [
                [
                    'id' => '1',
                    'code' => '620',
                    'name' => 'Engineering',
                ],
                [
                    'id' => '2',
                    'code' => '621',
                    'name' => 'Mechanical',
                ],
                [
                    'id' => '3',
                    'code' => '622',
                    'name' => 'Topographical',
                ]
            ]
        );
    }
}
