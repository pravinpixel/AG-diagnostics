<?php

namespace Database\Seeders;

use App\Models\Admin\Speciality;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::create([
            'speciality' => 'Cardiology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Diabetology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Paediatrics',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Dermatology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Endocrinology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Gynaecology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Haematology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Nephrology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Neurology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Oncology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Rheumatology',
            'status' => '1'
        ]);
        Speciality::create([
            'speciality' => 'Surgery',
            'status' => '1'
        ]);
    }
}
