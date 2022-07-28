<?php

namespace App\Http\Controllers;

use App\Helpers\LogActions;
use App\Http\Resources\PasienResource;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        LogActions::store("Lihat data pasien");

        $query = request()->get('q');

        $pasien = Pasien::with('area', 'subarea')->latest()->get();

        if (isset($query)) {
            $pasien = Pasien::with('area', 'subarea')
                ->where('norm', 'LIKE', '%' . $query . '%')
                ->orWhere('nama', 'LIKE', '%' . $query . '%')
                ->orWhere('nik', 'LIKE', '%' . $query . '%')
                ->latest()
                ->get();
        }

        return PasienResource::collection($pasien);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required|string|unique:pasien,nik',
            'nama' => 'required|string',
            'norm' => 'required|string',
            'id_area' => 'required',
            'id_sub_area' => 'required'
        ]);

        try {
            LogActions::store('Menambah data pasien');

            $pasien = Pasien::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'norm' => $request->norm,
                'id_area' => $request->id_area,
                'id_sub_area' => $request->id_sub_area,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->date('tgl_lahir', 'Y-m-d'),
                'jns_kelamin' => $request->jns_kelamin,
                'alamat' => $request->alamat,
                'hp' => $request->no_hp,
                'nip_perawat' => $request->nip
            ]);

            if ($pasien) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data pasien berhasil ditambahkan.'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function show($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json([
                'status' => false,
                'message' => 'Data pasien tidak ditemukan.'
            ], 404);
        }

        LogActions::store('Lihat detail pasien a/n ' . $pasien->nama);

        return new PasienResource($pasien);
    }

    public function update($id, Request $request)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json([
                'status' => false,
                'message' => 'Data pasien tidak ditemukan.'
            ], 404);
        }

        $this->validate($request, [
            'nik' => 'required|string',
            'nama' => 'required|string',
            'norm' => 'required|string',
            'id_area' => 'required',
            'id_sub_area' => 'required'
        ]);

        LogActions::store('Update data pasien a/n ' . $pasien->nama);

        $pasien->nik = $request->nik;
        $pasien->nama = $request->nama;
        $pasien->norm = $request->norm;
        $pasien->id_area = $request->id_area;
        $pasien->id_sub_area = $request->id_sub_area;
        $pasien->tempat_lahir = $request->tempat_lahir;
        $pasien->tgl_lahir = $request->date('tgl_lahir', 'd-m-Y');
        $pasien->jns_kelamin = $request->jns_kelamin;
        $pasien->alamat = $request->alamat;
        $pasien->hp = $request->no_hp;

        $pasien->save();

        return response()->json([
            'status' => true,
            'message' => 'Data pasien berhasil di upadte.'
        ]);
    }

    public function destroy($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json([
                'status' => false,
                'message' => 'Data pasien tidak ditemukan.'
            ], 404);
        }

        LogActions::store('Hapus data pasien a/n ' . $pasien->nama);
        $pasien->delete();

        return response()->json([], 204);
    }

    public function getByIdPerawat()
    {
        LogActions::store("Lihat data pasien");
        $pasien = Pasien::with('area', 'subarea')
            ->where('nip_perawat', auth()->user()->nip)
            ->latest()
            ->get();

        return PasienResource::collection($pasien);
    }
}
