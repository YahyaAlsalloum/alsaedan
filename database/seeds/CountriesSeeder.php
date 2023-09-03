<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::query()->truncate();

        $country = new Country();
        $country->name = 'United States Of America';
        $country->code = '001';
        $country->timezone = 'America/New_York';
        $country->save();
        
        $country = new Country();
        $country->name = 'United Emarites';
        $country->code = '00967';
        $country->timezone = 'Asia/Dubai';
        $country->save();

        $country = new Country();
        $country->name = 'Lebanon';
        $country->code = '00961';
        $country->timezone = 'Asia/Beirut';
        $country->save();

        $country = new Country();
        $country->name = 'Saudi Arabia';
        $country->code = '00966';
        $country->timezone = 'Asia/Riyadh';
        $country->save();
        
        $country = new Country();
        $country->name = 'Qatar';
        $country->code = '00974';
        $country->timezone = 'Asia/Qatar';
        $country->save();
    }
}
