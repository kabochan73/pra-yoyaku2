<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'court'])
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $court = Court::first();
        $users = User::where('role', 'user')->get();

        return view('admin.reservations.create', compact('court', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'duration' => ['required', 'integer', 'min:1', 'max:3'],
        ]);

        $court = Court::first();
        $startTime = $validated['start_time'];
        $endTime = date('H:i', strtotime($startTime . ' +' . $validated['duration'] . ' hours'));

        // 同日1予約チェック
        $alreadyReserved = Reservation::where('user_id', $validated['user_id'])
            ->where('date', $validated['date'])
            ->where('status', 'confirmed')
            ->exists();

        if ($alreadyReserved) {
            return back()->withErrors(['date' => 'このユーザーは同じ日にすでに予約があります。'])->withInput();
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
            'user_id' => $validated['user_id'],
            'court_id' => $court->id,
            'date' => $validated['date'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'type' => 'phone',
            'status' => 'confirmed',
        ]);

        return redirect()->route('admin.reservations.index')->with('success', '予約を登録しました。');
    }

    public function cancel(Reservation $reservation)
    {
        $this->authorize('cancel', $reservation);

        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', '予約をキャンセルしました。');
    }
}
