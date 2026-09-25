<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::query()->insert([
            [
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rapat Proyek Web',
                'description' => 'Membahas pembagian tugas kelompok.',
                'activity_date' => '2026-09-28',
                'category' => 'Rapat',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mengerjakan Modul 2',
                'description' => 'Menyelesaikan tugas JavaScript dan DOM.',
                'activity_date' => '2026-09-20',
                'category' => 'Tugas',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Belajar Route Binding',
                'description' => 'Membaca dokumentasi resmi Laravel.',
                'activity_date' => '2026-10-15',
                'category' => 'Belajar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
