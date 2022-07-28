<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaPelayanan extends Model
{
    protected $table = 'area_pelayanan';

    protected $fillable = ['nama', 'kd_area'];

    public $timestamps = false;

    public function substansi()
    {
        return $this->hasMany(SubAreaPelayanan::class, 'id_area', 'id');
    }
}
