<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UraianTugasResource extends JsonResource
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
            'uraian_tugas' => $this->uraian_tugas,
            'hasil' => (int)$this->hasil,
            'satuan_hasil' => $this->satuan_hasil
        ];
    }
}
