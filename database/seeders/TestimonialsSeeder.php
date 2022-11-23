<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class TestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testimonials')->insert([
            'title' => 'Operations',
            'date' => '2022-11-10',
            'type' => '1',
            'description' => 'It was a great experience at A.G Diagnostics Pvt. Ltd. Very much impressed at the enterance.Reception and other staff gave a good welcome. The lab is very clean and arrangements are excellent.Courtious staff is a big highlight and modern equipments and sterile environment. Keep it up in future also',
            'video_url' => 'Operations',
            'photo' => 'upload/testimonial/photo/dummy.jpg',
            'video_cover_image' => 'Operations',
            'given_by' => 'agdiagnostics',
            'designation' => 'Test',
            'Status' => '1',
        ]);
    }
}
