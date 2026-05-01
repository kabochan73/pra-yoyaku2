<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        $reservations = $request->user()
            ->reservations()
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        return view('mypage.index', compact('reservations'));
    }

    public function cancel(Request $request, Reservation $reservation)
    {
        $this->authorize('cancel', $reservation);

        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', '予約をキャンセルしました。');
    }
}
