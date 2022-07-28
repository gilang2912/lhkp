<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PasienResource extends JsonResource
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
            'nik' => $this->nik,
            'nama' => $this->nama,
            'norm' => $this->norm,
            'area' => $this->area->nama,
            'sub_area' => rtrim($this->subarea->substansi),
            'tempat_lahir' => $this->tempat_lahir,
            'tgl_lahir' => $this->tgl_lahir,
            'jns_kelamin' => $this->jns_kelamin,
            'alamat' => $this->alamat,
            'no_hp' => $this->hp,
            'id_perawat' => $this->nip_perawat,
            'created_at' => ($this->created_at)->format('d-m-Y H:i:s'),
            'updated_at' => ($this->updated_at)->format('d-m-Y H:i:s')
        ];
    }
}
