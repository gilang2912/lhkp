<?php

namespace App\Http\Controllers;

use App\Http\Resources\BukuBantuPerawatResource;
use App\Http\Resources\UraianKegiatanResource;
use App\Http\Resources\UraianTugasResource;
use App\Models\UraianKegiatan;
use App\Models\UraianTugas;
use Illuminate\Http\Request;

class BukuBantuPerawatController extends Controller
{
    public function index()
    {
        $bbp = UraianTugas::with('kegiatan')->get();

        return BukuBantuPerawatResource::collection($bbp);
    }

    public function tugas($kd_jabatan)
    {
        $tugas = UraianTugas::where('kd_jabatan', $kd_jabatan)
            ->orderBy('id', 'DESC')
            ->get();

        return UraianTugasResource::collection($tugas);
    }

    public function kegiatan($id_tugas)
    {
        $kegiatan = UraianKegiatan::where('id_tugas', $id_tugas)
            ->orderBy('id', 'DESC')
            ->get();

        return UraianKegiatanResource::collection($kegiatan);
    }
}
