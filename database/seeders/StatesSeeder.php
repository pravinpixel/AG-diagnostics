<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $key ='agdpixel';
        // $secret ='p1x3l@agd';
        // $responseState = Http::withBasicAuth($key,$secret)
        // ->get('https://agdmatrix.dyndns.org/a/Pixel/States');
        // $responseState = json_decode($responseState);
        insertApiStateData();
        



    }
}
