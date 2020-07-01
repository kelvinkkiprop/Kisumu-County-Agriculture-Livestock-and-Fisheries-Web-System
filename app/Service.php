<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services'; 
    public $timestamps = true;
    public $primaryKey = 'id';
}
