<?php

namespace App\Http\Controllers;

use App\Http\Resources\AreaPelayananResource;
use App\Http\Resources\SubAreaPelayananResource;
use App\Models\AreaPelayanan;
use App\Models\SubAreaPelayanan;
use Illuminate\Http\Request;

class AreaPelayananController extends Controller
{
    public function index()
    {
        $areaPelayanan = AreaPelayanan::with('substansi')->get();

        return AreaPelayananResource::collection($areaPelayanan);
    }

    public function showSubArea($id)
    {
        $subArea = SubAreaPelayanan::where('id_area', $id)->get();

        if (count($subArea) <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Data sub area pelayanan tidak ditemukan.'
            ], 404);
        }

        return SubAreaPelayananResource::collection($subArea);
    }
}
