@extends('app')

@section('title', 'Add Wishes')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-pink-50 to-blue-50 flex items-center justify-center px-6 py-12">

    <div class="w-full max-w-xl bg-[#ecf0f3] rounded-[40px] p-10 shadow-[12px_12px_24px_#d1d9e6,-12px_-12px_24px_#ffffff]">

        {{-- Title --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-pink-300 mb-2">
                Leave Your Wishes 🤍
            </h1>

            <p class="text-gray-500">
                Share your beautiful moment with us
            </p>
        </div>

        <form action="{{ route('registration.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-7">

            @csrf

            {{-- Name --}}
            <div>
                <label class="block mb-3 text-gray-600 font-medium">
                    Your Name
                </label>

                <input type="text"
                       name="name"
                       placeholder="Enter your name"
                       class="w-full px-6 py-4 rounded-2xl bg-[#ecf0f3] shadow-[inset_6px_6px_12px_#d1d9e6,inset_-6px_-6px_12px_#ffffff] outline-none focus:ring-2 focus:ring-pink-200">
            </div>

            {{-- Company --}}
            <div>
                <label class="block mb-3 text-gray-600 font-medium">
                    Company
                </label>

                <input type="text"
                       name="company"
                       placeholder="Your company"
                       class="w-full px-6 py-4 rounded-2xl bg-[#ecf0f3] shadow-[inset_6px_6px_12px_#d1d9e6,inset_-6px_-6px_12px_#ffffff] outline-none focus:ring-2 focus:ring-blue-200">
            </div>

            {{-- Message --}}
            <div>
                <label class="block mb-3 text-gray-600 font-medium">
                    Wishes Message
                </label>

                <textarea name="message"
                          rows="5"
                          placeholder="Write your wishes..."
                          class="w-full px-6 py-4 rounded-2xl bg-[#ecf0f3] shadow-[inset_6px_6px_12px_#d1d9e6,inset_-6px_-6px_12px_#ffffff] outline-none resize-none focus:ring-2 focus:ring-pink-200"></textarea>
            </div>

            {{-- Photo --}}
            <div>
                <label class="block mb-3 text-gray-600 font-medium">
                    Upload Photo
                </label>

                <input type="file"
                       name="photo_url"
                       class="w-full px-4 py-4 rounded-2xl bg-[#ecf0f3] shadow-[inset_6px_6px_12px_#d1d9e6,inset_-6px_-6px_12px_#ffffff] text-gray-500">
            </div>

            {{-- Button --}}
            <button type="submit"
                    class="w-full py-4 rounded-2xl bg-gradient-to-r from-pink-300 to-blue-300 text-white font-semibold shadow-[6px_6px_12px_#d1d9e6,-6px_-6px_12px_#ffffff] hover:scale-[1.02] transition duration-300">

                Submit Wishes ✨

            </button>

        </form>

    </div>

</div>

@endsection