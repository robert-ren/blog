<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'user_flights';
    //

    protected $fillable = array('name', 'airline', 'status');


}
