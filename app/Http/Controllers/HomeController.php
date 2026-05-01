<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Reservation;

class HomeController extends Controller
{
    public function index()
    {
        $court = Court::first();
        $calendarEvents = Reservation::where('status', 'confirmed')
            ->get()
            ->map(function ($r) {
                return [
                    'title' => '予約済み ' . substr($r->start_time, 0, 5) . '〜' . substr($r->end_time, 0, 5),
                    'start' => $r->date . 'T' . $r->start_time,
                    'end'   => $r->date . 'T' . $r->end_time,
                    'color' => '#ef4444',
                ];
            });

        return view('home', compact('court', 'calendarEvents'));
    }
}
