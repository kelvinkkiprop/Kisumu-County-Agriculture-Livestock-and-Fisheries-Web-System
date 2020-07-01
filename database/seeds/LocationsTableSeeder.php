<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            ['name'=>'Kisumu East'], ['name'=>'Kisumu West'],  ['name'=>'Kisumu Central'],  
            ['name'=>'Mohoroni'], ['name'=>'Nyakach'], ['name'=>'Nyando'],  ['name'=>'Seme'],
        ];
    
           Location::insert($locations);
    }
}
