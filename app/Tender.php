<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $table = 'tenders'; 
    public $timestamps = true;
    public $primaryKey = 'id';
}
