<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
            'name' => 'required',
            'message' => 'required'
        ]);

        $photoUrl = null;

        if ($request->photo_data) {

            $image = str_replace(
                'data:image/png;base64,',
                '',
                $request->photo_data
            );

            $image = base64_decode($image);

            $fileName =
                'guest_' .
                time() .
                '.png';

            Http::withHeaders([
                'Authorization' =>
                    'Bearer ' .
                    env('SUPABASE_SERVICE_KEY'),

                'apikey' =>
                    env('SUPABASE_SERVICE_KEY'),

                'Content-Type' =>
                    'image/png'
            ])
            ->withBody(
                $image,
                'image/png'
            )
            ->post(
                env('SUPABASE_URL') .
                '/storage/v1/object/' .
                env('SUPABASE_BUCKET') .
                '/' .
                $fileName
            );

            $photoUrl =
                env('SUPABASE_URL')
                . '/storage/v1/object/public/'
                . env('SUPABASE_BUCKET')
                . '/'
                . $fileName;
        }

        Guest::create([
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'message' => $request->message,
            'photo_url' => $photoUrl
        ]);

        return redirect('/')
            ->with(
                'success',
                'Wishes submitted successfully ✨'
            );
    }
}