<?php

namespace App\Http\Controllers;

use App\Helpers\LogActions;
use App\Http\Resources\LogActionResource;
use App\Models\LogAction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogActionController extends Controller
{
    public function index()
    {
        $log = LogActions::logActionList();

        return LogActionResource::collection($log);
    }

    public function showByUserId($id)
    {
        $log = LogAction::where('user_id', $id)->get();

        if (count($log) <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Data log perawat tidak ditemukan.'
            ], 404);
        }

        return LogActionResource::collection($log);
    }

    public function showByDate(Request $request)
    {
        $startDate = Carbon::createFromFormat('d-m-Y', $request->start_date);
        $endDate = Carbon::createFromFormat('d-m-Y', $request->end_date);

        $log = LogAction::whereBetween('created_at', [$startDate, $endDate])->get();

        if (count($log) <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Data log perawat tidak ditemukan.'
            ], 404);
        }

        return LogActionResource::collection($log);
    }
}
