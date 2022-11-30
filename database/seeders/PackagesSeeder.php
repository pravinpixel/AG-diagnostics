<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PackagesSeeder extends Seeder
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
        // $responsePackages = Http::withBasicAuth($key,$secret)
        // ->get('https://agdmatrix.dyndns.org/a/Pixel/Packages');
        // $responsePackages = json_decode($responsePackages);
        insertApiPackagesData();


        
    }
}
