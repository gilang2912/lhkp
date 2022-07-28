<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferensiJabatan extends Model
{
    protected $table = 'sub_ref_jabatan';

    protected $fillable = ['kd_jabatan', 'nama', 'jns_pekerjaan'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'kd_jabatan', 'kd_jabatan');
    }
}
