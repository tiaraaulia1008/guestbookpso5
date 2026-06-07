<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function index(Request $request): View
    {
        $page = $request->query('page');
        $search = $request->query('search');

        $guests = Guest::when($search, function (Builder $query, ?string $search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('company', 'LIKE', "%{$search}%")
                ->orWhere('ucapan', 'LIKE', "%{$search}%");
        })
            ->latest()
            ->paginate()
            ->withQueryString();

        if ($page > $guests->lastPage() && $page > 1) {
            abort(404);
        }

        return view('guests.index', compact('guests', 'search'));
    }

    public function create(): View
    {
        return view('guests.create');
    }

    public function store(StoreGuestRequest $request): RedirectResponse
    {
        $guest = new Guest;
        $guest->name = $request->input('name');
        $guest->email = $request->input('email');
        $guest->company = $request->input('company');
        $guest->ucapan = $request->input('ucapan');
        $guest->save();

        return redirect()->route('guests.index')
            ->with('message', 'The guest has been created.');
    }

    public function show(Guest $guest): View
    {
        return view('guests.show', compact('guest'));
    }

    public function edit(Guest $guest): View
    {
        return view('guests.edit', compact('guest'));
    }

    public function update(UpdateGuestRequest $request, Guest $guest): RedirectResponse
    {
        $guest->name = $request->input('name');
        $guest->email = $request->input('email');
        $guest->company = $request->input('company');
        $guest->ucapan = $request->input('ucapan');
        $guest->save();

        return redirect()->route('guests.index')
            ->with('message', 'The guest has been updated.');
    }

    public function destroy(Guest $guest): RedirectResponse
    {
        $guest->delete();

        return redirect()->route('guests.index')
            ->with('message', 'The guest has been deleted.');
    }
}