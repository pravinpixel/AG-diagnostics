<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Condition;

class ConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::create([
            'condition' => 'Abortion',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'AIDS',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Allergy',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Anaemia',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Arthritis',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Bad Obstetrics',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Blood Disorders',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Bone & Mineral',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Breast Cancer',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Cancer',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Coagulation',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Diabetes',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Female Infertility',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Fever',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Genetic Disorders',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Immunity',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Kidney Stones',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Kidney disease',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Leukemia',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Lymphoma',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Multiple Myeloma',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Multiple Sclerosis',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Male Infertility',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Osteoporosis',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Ovarian Cancer',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Pregnancy',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Prenatal Diagnosis',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Respiratory',
            'status' => '1'
        ]);

        Condition::create([
            'condition' => 'Disorders',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Skin Disorders',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Surgical Pathology',
            'status' => '1'
        ]);

        Condition::create([
            'condition' => 'Tuberculosis',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Thyroid Disorders',
            'status' => '1'
        ]);
        Condition::create([
            'condition' => 'Viral Infections',
            'status' => '1'
        ]);
    }

}
