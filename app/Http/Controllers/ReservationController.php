<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create()
    {
        $court = Court::first();

        return view('reservations.create', compact('court'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'duration' => ['required', 'integer', 'min:1', 'max:3'],
        ]);

        $court = Court::first();
        $startTime = $validated['start_time'];
        $endTime = date('H:i', strtotime($startTime . ' +' . $validated['duration'] . ' hours'));

        // 同日1予約チェック
        $alreadyReserved = Reservation::where('user_id', $request->user()->id)
            ->where('date', $validated['date'])
            ->where('status', 'confirmed')
            ->exists();

        if ($alreadyReserved) {
            return back()->withErrors(['date' => '同じ日にすでに予約があります。'])->withInput();
        }

        // 時間帯の重複チェック
        $overlap = Reservation::where('court_id', $court->id)
            ->where('date', $validated['date'])
            ->where('status', 'confirmed')
            ->where('start_time', '<', $endTime)
            ->where('end_time', '>', $startTime)
            ->exists();

        if ($overlap) {
            return back()->withErrors(['start_time' => 'その時間帯はすでに予約されています。'])->withInput();
        }

        Reservation::create([
            'user_id' => $request->user()->id,
            'court_id' => $court->id,
            'date' => $validated['date'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'type' => 'online',
            'status' => 'confirmed',
        ]);

        return redirect()->route('mypage.index')->with('success', '予約が完了しました。');
    }
}
