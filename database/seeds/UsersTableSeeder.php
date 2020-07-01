<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //Create default users
     $users = [
         ['type'=>'Driver', 'is_super'=>'N', 'status'=>1, 
         'name'=>'Driver', 'email'=>'driver@gmail.com', 'phone_number'=>'0720000000',
         'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
         'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],

         ['type'=>'Driver', 'is_super'=>'N', 'status'=>1, 
         'name'=>'Driver 2', 'email'=>'driver2@gmail.com', 'phone_number'=>'0720000000',
         'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
         'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],

        ['type'=>'Admin', 'is_super'=>'Y', 'status'=>1, 
        'name'=>'System Admin', 'email'=>'admin@gmail.com', 'phone_number'=>'0720000000',
        'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
        'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],

        ['type'=>'HR', 'is_super'=>'N', 'status'=>1, 
        'name'=>'HR', 'email'=>'hr@gmail.com', 'phone_number'=>'0720000000',
        'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
        'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],

        ['type'=>'Supplier', 'is_super'=>'N', 'status'=>1, 
        'name'=>'Supplier', 'email'=>'supplier@gmail.com', 'phone_number'=>'0720000000',
        'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
        'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],

        ['type'=>'Finance', 'is_super'=>'N', 'status'=>1, 
        'name'=>'Finance', 'email'=>'finance@gmail.com', 'phone_number'=>'0720000000',
        'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
        'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],

        ['type'=>'Farmer', 'is_super'=>'N', 'status'=>1, 
        'name'=>'Farmer', 'email'=>'farmer@gmail.com', 'phone_number'=>'0720000000',
        'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
        'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],

        ['type'=>'Veterinary', 'is_super'=>'N', 'status'=>1, 
        'name'=>'Veterinary', 'email'=>'veterinary@gmail.com', 'phone_number'=>'0720000000',
        'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
        'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],

        ['type'=>'Agricultural Officer', 'is_super'=>'N', 'status'=>1, 
        'name'=>'Agricultural Officer', 'email'=>'agriculturalofficer@gmail.com', 'phone_number'=>'0720000000',
        'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
        'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],

        ['type'=>'Procurement', 'is_super'=>'N', 'status'=>1, 
        'name'=>'Procurement', 'email'=>'procurement@gmail.com', 'phone_number'=>'0720000000',
        'password'=>Hash::make('secret'), 'remember_token'=>str_random(50),
        'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
     ];

       User::insert($users);
    }
}
