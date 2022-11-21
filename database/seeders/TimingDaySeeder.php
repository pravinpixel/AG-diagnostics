<?php

namespace Database\Seeders;
use App\Models\Admin\TimingDay;
use Illuminate\Database\Seeder;

class TimingDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TimingDay::create([
            'days' => 'Weekdays',
            'status' => '1'
        ]);
        TimingDay::create([
            'days' => 'Sunday',
            'status' => '1'
        ]);
        TimingDay::create([
            'days' => 'Holiday',
            'status' => '1'
        ]);
        TimingDay::create([
            'days' => 'Working Days',
            'status' => '1'
        ]);
        TimingDay::create([
            'days' => 'Working Hours',
            'status' => '1'
        ]);
    }
}
