<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antena extends Model
{
    protected $table = 'optimcj_antenas';

    protected $fillable = ['bscrnc', 'siteid', 'cell', 'mech', 'elec', 'tot', 'dir', 'height', 'bw', 'type'];
}
