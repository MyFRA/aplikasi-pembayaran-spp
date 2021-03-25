<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;

class PetugasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Petugas::create([
            'username'      => 'admin',
            'nama_petugas'  => 'admin',
            'password'      => Hash::make('admin-53356'),
            'level'         => 'admin',
        ]);
    }
}
