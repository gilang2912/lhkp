<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportKinerjaPerawatResource extends JsonResource
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
            'nip' => $this->nip,
            'jabatan' => $this->jabatan->nama,
            'uraian_tugas' => $this->tugas->uraian_tugas,
            'uraian_kegiatan' => $this->kegiatan->uraian_kegiatan,
            'area' => $this->area->nama,
            'sub_area' => $this->subarea->substansi,
            'pasien' => [
                'nik' => $this->pasien->nik,
                'nama' => $this->pasien->nama,
                'norm' => $this->pasien->norm
            ],
            'target' => $this->target,
            'hasil_tindakan' => $this->hasil_tindakan,
            'satuan_hasil' => $this->satuan_hasil,
            'keterangan' => $this->keterangan
        ];
    }
}
