@extends('app')

@section('title', 'Wedding Wishes')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 to-blue-50 py-10 px-6">

    {{-- Header --}}
    <div class="text-center mb-14">

        <h1 class="text-5xl font-bold text-pink-300 mb-4">
            Wedding Wishes
        </h1>

        <p class="text-gray-500 text-lg mb-8">
            Thank you for being part of our special day 🤍
        </p>

        {{-- Add Button --}}
        <a href="{{ route('registration.create') }}"
           class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-300 to-blue-300 hover:from-pink-400 hover:to-blue-400 text-white px-7 py-3 rounded-full shadow-lg shadow-pink-100/50 transition duration-300">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4" />
            </svg>

            Add Wishes
        </a>

    </div>

    {{-- Guest Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        @forelse($guests as $guest)

            <div class="bg-white/80 backdrop-blur-sm border border-pink-100 rounded-[32px] p-6 shadow-lg shadow-pink-100/50 flex flex-col items-center text-center transition duration-300 hover:scale-105">

                {{-- Photo --}}
                <img
                    src="{{ $guest->photo_url }}"
                    alt="{{ $guest->name }}"
                    class="w-24 h-24 rounded-full object-cover border-4 border-white shadow mb-5"
                >

                {{-- Message --}}
                <p class="text-gray-600 text-sm leading-relaxed mb-5">
                    "{{ $guest->message }}"
                </p>

                {{-- Name --}}
                <h2 class="text-xl font-bold text-gray-800">
                    {{ $guest->name }}
                </h2>

                {{-- Company --}}
                <p class="text-blue-300 text-sm mt-1">
                    {{ $guest->company }}
                </p>

            </div>

        @empty

            <div class="col-span-full text-center py-20">

                <p class="text-gray-400 text-lg">
                    No wishes yet 🤍
                </p>

            </div>

        @endforelse

    </div>

</div>
@endsection