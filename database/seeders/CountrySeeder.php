<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strJsonFileContents = file_get_contents("final_all.json");
        $countries = json_decode($strJsonFileContents, true);
        collect($countries)->each(function ($country){
            Country::create($country);
        });
    }
}
