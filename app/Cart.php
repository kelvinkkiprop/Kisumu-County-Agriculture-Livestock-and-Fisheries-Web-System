<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts'; 
    public $timestamps = true;
    public $primaryKey = 'id';
}
