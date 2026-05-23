<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GuestRegistrationController extends Controller
{
    public function create(): View
    {
        return view('home.registration');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Guest::create([
            'name' => $request->name,
            'company' => $request->company,
            'message' => $request->message,
        ]);

        return redirect('/')
            ->with('success', 'Wishes submitted successfully ✨');
    }
}