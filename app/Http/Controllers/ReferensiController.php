<?php

namespace App\Http\Controllers;

use App\Http\Resources\RefJabatanResource;
use App\Models\ReferensiJabatan;
use Illuminate\Http\Request;

class ReferensiController extends Controller
{
    public function jabatan()
    {
        $param = request()->get('q');

        if (isset($param)) {
            $jabatan = ReferensiJabatan::where('kd_jabatan', $param)->first();
            return new RefJabatanResource($jabatan);
        } else {
            $jabatan = ReferensiJabatan::all();
            return RefJabatanResource::collection($jabatan);
        }
    }
}
