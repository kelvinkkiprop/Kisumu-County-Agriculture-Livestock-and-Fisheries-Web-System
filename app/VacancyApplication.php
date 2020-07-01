<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacancyApplication extends Model
{
    protected $table = 'vacancy_applications'; 
    public $timestamps = true;
    public $primaryKey = 'id';
}
