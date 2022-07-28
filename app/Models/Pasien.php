<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'nik',
        'nama',
        'norm',
        'id_area',
        'id_sub_area',
        'tempat_lahir',
        'tgl_lahir',
        'jns_kelamin',
        'alamat',
        'hp',
        'nip_perawat'
    ];

    public function area()
    {
        return $this->hasOne(AreaPelayanan::class, 'id', 'id_area');
    }

    public function subarea()
    {
        return $this->hasOne(SubAreaPelayanan::class, 'id', 'id_sub_area');
    }
}
