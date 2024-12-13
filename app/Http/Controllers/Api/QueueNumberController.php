<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QueueNumberController extends Controller
{
    public function getQueueNumber(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        try {
            $queueNumber = DaftarPoli::where('schedule_id', $request->schedule_id)
                ->where('dokter_id', $request->dokter_id)
                ->whereDate('created_at', Carbon::today())
                ->max('no_antrian');

            $nextQueueNumber = ($queueNumber ?? 0) + 1;

            // Log the calculation for debugging
            logger()->info('Queue number calculation:', [
                'schedule_id' => $request->schedule_id,
                'dokter_id' => $request->dokter_id,
                'current_max' => $queueNumber,
                'next_number' => $nextQueueNumber
            ]);

            return response()->json([
                'queueNumber' => $nextQueueNumber
            ]);
        } catch (\Exception $e) {
            logger()->error('Error generating queue number:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Failed to generate queue number'
            ], 500);
        }
    }
}