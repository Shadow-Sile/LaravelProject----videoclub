<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $libro = [
        'titulo' => '1986',
        'paquito' => 'lolito',
        'created_at' => now(),
        'updated_at' => now()
    ];

    }
}
