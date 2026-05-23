<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class GuestRegistrationController extends Controller
{
    public function create(): View
    {
        return view('home.registration');
    }

    public function store(Request $request): RedirectResponse
    {
        $guest = new Guest();

        $guest->name = $request->name;
        $guest->company = $request->company;
        $guest->message = $request->message;

        if ($request->photo_data) {

            $image = $request->photo_data;

            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);

            $imageName = time() . '.png';

            File::put(
                public_path('uploads/') . $imageName,
                base64_decode($image)
            );

            $guest->photo_url = 'uploads/' . $imageName;
        }

        $guest->save();

        return redirect('/')
            ->with('success', 'Wishes submitted successfully ✨');
    }
}