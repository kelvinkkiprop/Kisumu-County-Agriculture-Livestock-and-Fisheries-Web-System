<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks'; 
    public $timestamps = true;
    public $primaryKey = 'id';
}
