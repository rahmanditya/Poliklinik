<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    public function run()
    {
        $medicines = [
            // Common Medicines
            ['nama' => 'Paracetamol', 'kemasan' => 'Tablet 500mg', 'harga' => 5000.000],
            ['nama' => 'Amoxicillin', 'kemasan' => 'Kapsul 250mg', 'harga' => 15000.000],
            ['nama' => 'Ibuprofen', 'kemasan' => 'Tablet 200mg', 'harga' => 10000.000],
            ['nama' => 'Vitamin C', 'kemasan' => 'Tablet 500mg', 'harga' => 7000.000],
            
            // Specialized Medicines
            ['nama' => 'Metformin', 'kemasan' => 'Tablet 500mg', 'harga' => 12000.000], // Diabetes
            ['nama' => 'Captopril', 'kemasan' => 'Tablet 12.5mg', 'harga' => 8000.000], // Hypertension
            ['nama' => 'Amlodipine', 'kemasan' => 'Tablet 5mg', 'harga' => 9000.000], // Hypertension
            ['nama' => 'Simvastatin', 'kemasan' => 'Tablet 10mg', 'harga' => 11000.000], // Cholesterol
            
            // Antibiotics
            ['nama' => 'Cefixime', 'kemasan' => 'Kapsul 100mg', 'harga' => 25000.000],
            ['nama' => 'Ciprofloxacin', 'kemasan' => 'Tablet 500mg', 'harga' => 20000.000],
            
            // Pediatric Medicines
            ['nama' => 'Paracetamol', 'kemasan' => 'Sirup 120mg/5mL', 'harga' => 15000.000],
            ['nama' => 'Ibuprofen', 'kemasan' => 'Sirup 100mg/5mL', 'harga' => 18000.000],
            ['nama' => 'Multivitamin Anak', 'kemasan' => 'Sirup 5mL', 'harga' => 12000.000],
            
            // Painkillers and Muscle Relaxants
            ['nama' => 'Ketorolac', 'kemasan' => 'Tablet 10mg', 'harga' => 15000.000],
            ['nama' => 'Methocarbamol', 'kemasan' => 'Tablet 500mg', 'harga' => 20000.000],
            
            // Others
            ['nama' => 'Ranitidine', 'kemasan' => 'Tablet 150mg', 'harga' => 8000.000],
            ['nama' => 'Omeprazole', 'kemasan' => 'Kapsul 20mg', 'harga' => 17000.000],
            ['nama' => 'Lansoprazole', 'kemasan' => 'Kapsul 30mg', 'harga' => 25000.000],
            ['nama' => 'Aspirin', 'kemasan' => 'Tablet 75mg', 'harga' => 12000.000],
            ['nama' => 'Salbutamol', 'kemasan' => 'Sirup 2mg/5mL', 'harga' => 20000.000],
        ];

        DB::table('obats')->insert($medicines);
    }
}
