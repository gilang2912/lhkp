<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferensiInstansi extends Model
{
    protected $table = 'instansi';

    protected $fillable = ['kd_instansi', 'nama'];

    public $timestamps = false;
}
