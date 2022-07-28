<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiKinerjaPerawat extends Model
{
    protected $table = 'nilai_kinerja_perawat';

    protected $fillable = [
        'nip',
        'kd_jabatan',
        'id_uraian_tugas',
        'id_uraian_kegiatan',
        'kd_area',
        'id_sub_area',
        'id_pasien',
        'target',
        'hasil_tindakan',
        'satuan_hasil',
        'keterangan'
    ];

    public function jabatan()
    {
        return $this->hasOne(ReferensiJabatan::class, 'kd_jabatan', 'kd_jabatan');
    }

    public function tugas()
    {
        return $this->hasOne(UraianTugas::class, 'id', 'id_uraian_tugas');
    }

    public function kegiatan()
    {
        return $this->hasOne(UraianKegiatan::class, 'id', 'id_uraian_kegiatan');
    }

    public function area()
    {
        return $this->hasOne(AreaPelayanan::class, 'kd_area', 'kd_area');
    }

    public function subarea()
    {
        return $this->hasOne(SubAreaPelayanan::class, 'id', 'id_sub_area');
    }

    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'id', 'id_pasien');
    }
}
