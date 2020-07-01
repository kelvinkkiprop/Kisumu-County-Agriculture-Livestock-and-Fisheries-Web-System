<?php

use Illuminate\Database\Seeder;
use App\DriverCharges;

class DriverChargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $charges = [
        ['driver'=>1, 'charges'=>370],
        ['driver'=>2, 'charges'=>230],
    ];

      DriverCharges::insert($charges);
   }
}
