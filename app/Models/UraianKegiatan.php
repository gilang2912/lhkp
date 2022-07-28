<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UraianKegiatan extends Model
{
    protected $table = 'bbp_uraian_kegiatan';

    protected $fillable = ['id_tugas', 'kd_jabatan', 'uraian_kegiatan'];

    public $timestamps = false;

    public function tugas()
    {
        return $this->belongsTo(UraianTugas::class, 'id', 'id_tugas');
    }
}
