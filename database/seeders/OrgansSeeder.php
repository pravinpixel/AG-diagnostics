<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Organ;


class OrgansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organ::create([
            'organs' => 'Heart',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Liver',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Lungs',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Kidney',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Bone',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Endocrine System',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Nervous System',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Thyroid',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Skin',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Reproductive',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'System',
            'status' => '1'
        ]);
        Organ::create([
            'organs' => 'Pancreas',
            'status' => '1'
        ]);
    }
}
