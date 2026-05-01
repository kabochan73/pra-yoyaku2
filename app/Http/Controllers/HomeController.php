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
                    'title' => '×',
                    'start' => $r->date . 'T' . $r->start_time,
                    'end'   => $r->date . 'T' . $r->end_time,
                    'color' => '#ff0000',
                ];
            });

        return view('home', compact('court', 'calendarEvents'));
    }
}
