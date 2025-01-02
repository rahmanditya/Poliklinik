<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;

use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return abort(404, 'User not found');
        }

        if ($user->role_id != 2) {
            return abort(403, 'Access denied');
        }

        $dokter = Dokter::where('user_id', $user->id)->first();

        if (!$dokter) {
            return abort(404, 'Dokter not found');
        }

        $schedule = Schedule::where('dokter_id', $dokter->id)->get();

        $activeSchedule = Schedule::where('dokter_id', $dokter->id)->where('is_active', true)->first();
        $pastSchedules = Schedule::where('dokter_id', $dokter->id)->where('is_active', false)->get();

        return view('dokter.schedule.index', compact('activeSchedule', 'pastSchedules', 'schedule'));
    }

    public function create()
    {
        return view('dokter.schedule.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_active' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Retrieve the dokter_id based on the user (assuming user_id is linked to dokter)
        $dokter = Dokter::where('user_id', $user->id)->first();

        if (!$dokter) {
            // Handle the case where the dokter record is not found
            return back()->withErrors(['dokter' => 'Dokter record not found.'])->withInput();
        }

        $daysMap = [
            'Senin' => Carbon::now()->startOfWeek(), // Monday
            'Selasa' => Carbon::now()->startOfWeek()->addDay(1), // Tuesday
            'Rabu' => Carbon::now()->startOfWeek()->addDay(2), // Wednesday
            'Kamis' => Carbon::now()->startOfWeek()->addDay(3), // Thursday
            'Jumat' => Carbon::now()->startOfWeek()->addDay(4), // Friday
            'Sabtu' => Carbon::now()->startOfWeek()->addDay(5), // Saturday
            'Minggu' => Carbon::now()->startOfWeek()->addDay(6), // Sunday
        ];


        $scheduleDate = $daysMap[$validated['hari']]->format('Y-m-d');

        $validated['dokter_id'] = $dokter->id;
        $validated['schedule_date'] = $scheduleDate;

        // Check for overlapping schedules
        $schedule = new Schedule();
        if ($schedule->hasOverlap($validated['start_time'], $validated['end_time'], $validated['hari'])) {
            return back()->withErrors(['overlap' => 'Schedule overlaps with existing schedule'])->withInput();
        }
        // Create the schedule
        Schedule::create($validated);

        return redirect()->route('dokter.schedule.index')
            ->with('success', 'Jadwal berhasil dibuat');
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_active' => 'boolean',
            'notes' => 'nullable|string'
        ]);

        // Check for overlapping schedules excluding current schedule
        if ($schedule->hasOverlap(
            $validated['start_time'],
            $validated['end_time'],
            $validated['hari'],
            $schedule->id
        )) {
            return back()->withErrors(['overlap' => 'Schedule overlaps with existing schedule'])->withInput();
        }

        $schedule->update($validated);

        return redirect()->route('dokter.schedule.index')
            ->with('success', 'Schedule updated successfully');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        if (!$schedule->is_active) {
            return redirect()->route('dokter.schedule.index')->withErrors('Cannot edit past schedules.');
        }
        return view('dokter.schedule.edit', compact('schedule'));
    }
}
