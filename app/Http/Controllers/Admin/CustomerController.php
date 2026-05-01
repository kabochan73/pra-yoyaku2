<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::where('role', 'user')
            ->withCount('reservations')
            ->get();

        return view('admin.customers.index', compact('users'));
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        $reservations = $user->reservations()
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.customers.show', compact('user', 'reservations'));
    }
}
