<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'password',
        'tempat_lahir',
        'tgl_lahir',
        'jns_kelamin',
        'golongan',
        'kd_jabatan'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function jabatan()
    {
        return $this->hasOne(ReferensiJabatan::class, 'kd_jabatan', 'kd_jabatan');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
