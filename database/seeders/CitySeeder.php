<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;


class CitySeeder extends Seeder
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
        // $responseCity = Http::withBasicAuth($key,$secret)
        // ->get('https://agdmatrix.dyndns.org/a/Pixel/Cities');
        // $responseCity = json_decode($responseCity);
        insertApiCityData();

    }
}
