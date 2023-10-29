<x-app-layout>
    <div class="relative bg-[#191928] opacity-100" style="height: calc(100vh - 66px); width: 100%;">
        <img src="https://image.tmdb.org/t/p/original{{ $backimage }}" alt="Background Image" class="absolute inset-0 w-full h-full object-cover">
        
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black opacity-40"></div>
        
        <!-- Overlay Text -->
        <div class="absolute top-32 left-8 z-10 text-white space-y-4">
            <!-- Adjusted logo styles with max-height and max-width -->
            <img src="https://image.tmdb.org/t/p/original{{ $logo }}" alt="Logo Image" class="w-1/8 h-auto mb-4" style="max-height: 300px; max-width: 500px;">
            
            <div class="flex space-x-4 items-center">
                {{-- Genres --}}
                <div>
                    @foreach ($genres as $genre)
                    <a href="#">
                        <span class="inline-block bg-gray-700 text-white px-2 rounded-md mr-1 mb-1">{{ $genre }}</span>
                    </a>
                    @endforeach
                </div>
                <!-- Release Box -->
                    {{-- TODO! Add duration --}}
                    <p><span>{{ $release }}</span><span class="pl-2 pr-2">•</span><span>DURATION</span></p>
            </div>
            
            <p class="mt-4 text-lg font-bold" style="max-width: 550px;">{{$description}}</p>
        </div>
        
        <!-- Suggested Movies Section -->
        <div class="absolute bottom-0 left-0 right-0 bg-[#191928] opacity-100 z-10">   
            <h2 class="text-2xl font-bold text-white text-center mb-6">Suggested Movies</h2>
            <!-- Add your suggested movies content here -->   
        </div>
    </div>
</x-app-layout>
