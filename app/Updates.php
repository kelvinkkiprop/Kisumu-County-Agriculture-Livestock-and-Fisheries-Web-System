<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Updates extends Model
{
    protected $table = 'updates'; 
    public $timestamps = true;
    public $primaryKey = 'id';
}
