<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    //
    protected $table = 'optimcj_remarks';

    protected  $fillable = ['bscrnc', 'cell', 'area', 'kpi', 'kategori', 'date_ex', 'date_close', 'remark', 'status', 'created_by', 'update_by'];
}
