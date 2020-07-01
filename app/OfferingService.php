<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferingService extends Model
{
    protected $table = 'offering_services'; 
    public $timestamps = true;
    public $primaryKey = 'id';
}
