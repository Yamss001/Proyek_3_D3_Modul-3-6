<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->upsert([
            [
                'name' => 'Seminar',
                'slug' => 'seminar',
            ],
            [
                'name' => 'Workshop',
                'slug' => 'workshop',
            ],
            [
                'name' => 'Rapat',
                'slug' => 'rapat',
            ],
            [
                'name' => 'Tugas',
                'slug' => 'tugas',
            ],
            [
                'name' => 'Belajar',
                'slug' => 'belajar',
            ],
            [
                'name' => 'GaTau',
                'slug' => 'gatau',
            ],
        ], ['slug'], ['name']);
    }
}
