<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportKinerjaPerawatResource;
use App\Models\NilaiKinerjaPerawat;
use Illuminate\Http\Request;
use App\Helpers\LogActions;

class ReportKinerjaPerawatController extends Controller
{
    public function index()
    {
        $report = NilaiKinerjaPerawat::with('jabatan', 'tugas', 'kegiatan', 'area', 'subarea', 'pasien')
            ->latest()->get();

        return ReportKinerjaPerawatResource::collection($report);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string',
            'kd_jabatan' => 'required|string',
            'id_uraian_tugas' => 'required',
            'id_uraian_kegiatan' => 'required',
            'kd_area' => 'required',
            'id_sub_area' => 'required',
            'id_pasien' => 'required'
        ]);

        try {
            LogActions::store('Menambah laporan kinerja perawat');
            $report = NilaiKinerjaPerawat::create([
                'nip' => $request->nip,
                'kd_jabatan' => $request->kd_jabatan,
                'id_uraian_tugas' => $request->id_uraian_tugas,
                'id_uraian_kegiatan' => $request->id_uraian_kegiatan,
                'kd_area' => $request->kd_area,
                'id_sub_area' => $request->id_sub_area,
                'id_pasien' => $request->id_pasien,
                'target' => $request->target,
                'hasil_tindakan' => $request->hasil_tindakan,
                'satuan_hasil' => $request->satuan_hasil,
                'keterangan' => $request->keterangan
            ]);

            if ($report) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data kinerja perawat berhasil di tambahkan.'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'id_uraian_tugas' => 'required',
            'id_uraian_kegiatan' => 'required',
            'kd_area' => 'required',
            'id_sub_area' => 'required',
        ]);

        $report = NilaiKinerjaPerawat::find($id);

        if (!$report) {
            return response()->json([
                'status' => false,
                'message' => 'Data laporan nilai kinerja tidak ditemukan.'
            ], 422);
        }

        LogActions::store('Update laporan kinerja perawat');

        $report->id_uraian_tugas = $request->id_uraian_tugas;
        $report->id_uraian_kegiatan = $request->id_uraian_kegiatan;
        $report->kd_area = $request->kd_area;
        $report->id_sub_area = $request->id_sub_area;
        $report->target = $request->target;
        $report->hasil_tindakan = $request->hasil_tindakan;
        $report->keterangan = $request->keterangan;

        $report->save();

        return response()->json([
            'status' => true,
            'message' => 'Laporan kinerja perawat berhasil di update.'
        ]);
    }

    public function getByKdJabatan($kd_jabatan)
    {
        $report = NilaiKinerjaPerawat::with('jabatan', 'tugas', 'kegiatan', 'area', 'subarea', 'pasien')
            ->where('kd_jabatan', $kd_jabatan)
            ->latest()
            ->get();

        return ReportKinerjaPerawatResource::collection($report);
    }

    public function getByNip($nip)
    {
        $report = NilaiKinerjaPerawat::with('jabatan', 'tugas', 'kegiatan', 'area', 'subarea', 'pasien')
            ->where('nip', $nip)
            ->latest()
            ->get();

        return ReportKinerjaPerawatResource::collection($report);
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)) {
            $report = NilaiKinerjaPerawat::find($request->id);
        }
        if (isset($request->nip)) {
            $report = NilaiKinerjaPerawat::where('nip', $request->nip);
        }

        LogActions::store('Hapus laporan kinerja perawat');
        $report->delete();

        return response()->json([], 204);
    }
}
