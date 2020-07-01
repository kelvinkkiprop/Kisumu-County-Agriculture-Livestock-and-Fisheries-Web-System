<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = 'vacancies'; 
    public $timestamps = true;
    public $primaryKey = 'id';
}
