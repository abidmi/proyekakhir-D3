<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'optimcj_sites';

    protected $fillable = ['bcsrnc', 'siteid', 'sitename', 'longitude', 'latitude', 'celltype', 'mbc', 'collsite'];
}
