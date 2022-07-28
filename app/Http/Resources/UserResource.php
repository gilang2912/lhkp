<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'nip' => $this->nip,
            'tempat_lahir' => $this->tempat_lahir,
            'tgl_lahir' => $this->tgl_lahir,
            'jns_kelamin' => $this->jns_kelamin,
            'golongan' => $this->golongan,
            'jabatan' => [
                'kd_jabatan' => $this->jabatan->kd_jabatan,
                'nama' => $this->jabatan->nama,
                'jns_pekerjaan' => $this->jabatan->jns_pekerjaan
            ],
            'created_at' => ($this->created_at)->format('d-m-Y H:i:s'),
            'updated_at' => ($this->updated_at)->format('d-m-Y H:i:s')
        ];
    }
}
