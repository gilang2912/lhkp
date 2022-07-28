<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UraianKegiatanResource extends JsonResource
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
            'uraian_kegiatan' => $this->uraian_kegiatan
        ];
    }
}
