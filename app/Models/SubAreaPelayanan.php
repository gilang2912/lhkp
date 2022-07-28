<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubAreaPelayanan extends Model
{
    protected $table = 'sub_area_pelayanan';

    protected $fillable = ['id_area', 'kd_area', 'substansi'];

    public $timestamps = false;

    public function area()
    {
        return $this->belongsTo(AreaPelayanan::class, 'id', 'id_area');
    }
}
