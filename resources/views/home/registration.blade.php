@extends('app')


@section('title', 'Add Wishes')


@section('content')
    <div class="min-h-screen bg-gradient-to-br from-pink-100 via-blue-100 to-pink-50 py-10 px-4">


        <div class="max-w-2xl mx-auto">


            <div class="bg-white/80 backdrop-blur-md rounded-[40px] shadow-2xl p-8 border border-white">


                {{-- Header --}}
                <div class="relative flex items-center justify-center mb-8">

                    {{-- Tombol Back dibuat absolute agar bebas dan tidak mendorong teks --}}
                    <a href="{{ route('home.index') }}"
                        class="absolute left-0 w-12 h-12 rounded-full bg-pink-200 hover:bg-pink-300 transition flex items-center justify-center text-pink-700 text-xl">
                        ←
                    </a>

                    <h1 class="text-3xl font-bold text-pink-500 text-center">
                        Add Wishes ✨
                    </h1>

                </div>


                {{-- Form --}}
                <form action="{{ route('registration.store') }}" method="POST">


                    @csrf


                    {{-- Name --}}
                    <div class="mb-6">


                        <label class="block text-pink-500 font-semibold mb-2">
                            Your Name
                        </label>


                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="Type your beautiful name..."
                            class="w-full rounded-3xl border-0 bg-pink-50 px-5 py-4 focus:ring-4 focus:ring-pink-200 outline-none">


                    </div>


                    {{-- Company --}}
                    <div class="mb-6">


                        <label class="block text-blue-500 font-semibold mb-2">
                            Company / School
                        </label>


                        <input type="text" name="company" value="{{ old('company') }}"
                            placeholder="Your company or school..."
                            class="w-full rounded-3xl border-0 bg-blue-50 px-5 py-4 focus:ring-4 focus:ring-blue-200 outline-none">


                    </div>

                    <div class="mb-6">

                        <label class="block text-blue-500 font-semibold mb-2">
                            Email 💌
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com"
                            class="w-full rounded-3xl border-0 bg-blue-50 px-5 py-4 focus:ring-4 focus:ring-blue-200 outline-none">

                    </div>


                    {{-- Message --}}
                    <div class="mb-6">


                        <label class="block text-pink-500 font-semibold mb-2">
                            Wishes Message 💌
                        </label>


                        <textarea name="message" rows="5" placeholder="Write your sweet wishes here..."
                            class="w-full rounded-[30px] border-0 bg-pink-50 px-5 py-4 focus:ring-4 focus:ring-pink-200 outline-none resize-none">{{ old('message') }}</textarea>


                    </div>


                    {{-- Camera --}}
                    <div class="mb-8">


                        <label class="block text-blue-500 font-semibold mb-3">
                            Take Photo 📸
                        </label>


                        <video id="camera" autoplay playsinline class="w-full rounded-[30px] shadow-lg mb-4 bg-black">
                        </video>


                        <canvas id="canvas" class="hidden"></canvas>


                        <input type="hidden" name="photo_data" id="photo_data">


                        <button type="button" onclick="takePhoto()"
                            class="w-full bg-blue-300 hover:bg-blue-400 text-white font-semibold py-3 rounded-3xl transition mb-4">


                            Capture Photo ✨


                        </button>


                        <div id="preview-container" class="hidden">


                            <p class="text-center text-pink-500 font-semibold mb-3">
                                Photo Preview 🤍
                            </p>


                            <img id="preview"
                                class="w-48 h-48 object-cover rounded-3xl mx-auto shadow-lg border-4 border-white">


                        </div>


                    </div>


                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-pink-400 to-blue-400 hover:scale-[1.02] transition-all duration-300 text-white font-bold py-4 rounded-3xl shadow-xl">


                        Submit Wishes ✨


                    </button>


                </form>


            </div>


        </div>


    </div>


    <script>
        const video = document.getElementById('camera');
        const canvas = document.getElementById('canvas');
        const photoData = document.getElementById('photo_data');
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('preview-container');


        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(error => {
                console.error(error);
                alert('Camera access denied 😭');
            });


        function takePhoto() {


            const context = canvas.getContext('2d');


            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;


            context.drawImage(video, 0, 0);


            const image = canvas.toDataURL('image/png');


            photoData.value = image;


            preview.src = image;


            previewContainer.classList.remove('hidden');


        }
    </script>


@endsection
