<?php

use Illuminate\Database\Seeder;
use App\OfferingService;

class OfferingServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name'=>'Farm visits', 'chargesperhour'=>2000],  
            ['name'=>'Vertinary services', 'chargesperhour'=>1500], 
        ];
    
        OfferingService::insert($services);
    }
}
