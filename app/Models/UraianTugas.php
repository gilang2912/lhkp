<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UraianTugas extends Model
{
    protected $table = 'bbp_uraian_tugas';

    protected $fillable = [
        'kd_jabatan', 'uraian_tugas', 'target', 'hasil', 'satuan_hasil'
    ];

    public $timestamps = false;

    public function kegiatan()
    {
        return $this->hasMany(UraianKegiatan::class, 'id_tugas', 'id');
    }
}
