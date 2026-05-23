@extends('app')

@section('title', 'Add Wishes')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-pink-100 via-blue-100 to-pink-50 py-10 px-4">

    <div class="max-w-2xl mx-auto">

        <div class="bg-white/80 backdrop-blur-md rounded-[40px] shadow-2xl p-8 border border-white">

            {{-- Header --}}
            <div class="text-center mb-8">

                <h1 class="text-4xl font-black text-pink-400 mb-2">
                    Leave Your Wishes ✨
                </h1>

                <p class="text-gray-500">
                    Share your sweet message here 💖
                </p>

            </div>

            {{-- Success Alert --}}
            @if(session('success'))
                <div class="mb-6 rounded-3xl bg-green-100 text-green-700 px-5 py-4 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form --}}
            <form
                action="{{ route('registration.store') }}"
                method="POST"
            >

                @csrf

                {{-- Name --}}
                <div class="mb-6">

                    <label class="block text-pink-500 font-semibold mb-2">
                        Your Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Type your beautiful name..."
                        class="w-full rounded-3xl border-0 bg-pink-50 px-5 py-4 focus:ring-4 focus:ring-pink-200 outline-none"
                        required
                    >

                    @error('name')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Company --}}
                <div class="mb-6">

                    <label class="block text-blue-500 font-semibold mb-2">
                        Company / School
                    </label>

                    <input
                        type="text"
                        name="company"
                        value="{{ old('company') }}"
                        placeholder="Your company or school..."
                        class="w-full rounded-3xl border-0 bg-blue-50 px-5 py-4 focus:ring-4 focus:ring-blue-200 outline-none"
                    >

                    @error('company')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Message --}}
                <div class="mb-8">

                    <label class="block text-pink-500 font-semibold mb-2">
                        Wishes Message 💌
                    </label>

                    <textarea
                        name="message"
                        rows="5"
                        placeholder="Write your sweet wishes here..."
                        class="w-full rounded-[30px] border-0 bg-pink-50 px-5 py-4 focus:ring-4 focus:ring-pink-200 outline-none resize-none"
                        required
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-pink-400 to-blue-400 hover:scale-[1.02] transition-all duration-300 text-white font-bold py-4 rounded-3xl shadow-xl"
                >

                    Submit Wishes ✨

                </button>

            </form>

        </div>

    </div>

</div>

@endsection