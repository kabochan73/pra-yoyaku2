<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Reservation;

class HomeController extends Controller
{
    public function index()
    {
        $court = Court::first();
        $reservations = Reservation::where('status', 'confirmed')->get();

        return view('home', compact('court', 'reservations'));
    }
}
