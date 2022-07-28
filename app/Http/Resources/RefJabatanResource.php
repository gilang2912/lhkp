<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RefJabatanResource extends JsonResource
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
            'kd_jabatan' => $this->kd_jabatan,
            'nama' => $this->nama,
            'jns_pekerjaan' => $this->jns_pekerjaan
        ];
    }
}
