<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $specializations = [
            'Penyakit Dalam',
            'Bedah',
            'Anak',
            'Umum',
            'Gigi',
            'Fisioterapi',
            'Syaraf',
            'Kandungan',
        ];

        foreach ($specializations as $specialization) {
            DB::table('poli')->insert(['name' => $specialization]);
        }
    }
}
