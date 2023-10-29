<x-app-layout>
    <div class="relative bg-[#191928] opacity-100 overflow-x-hidden" style="height: calc(100vh - 66px); width: 100%;">
        <img src="https://image.tmdb.org/t/p/original{{ $backimage }}" alt="Background Image" class="absolute inset-0 w-full h-full object-cover">
        
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black opacity-40"></div>
        
        <!-- Main Content Container -->
        <div class="absolute z-10 top-20 text-white w-full padding-container flex flex-col h-full" style="max-height: calc(100% - 120px);">
            
            <!-- Wrapper with left-8 spacing -->
            <div class="left-8 flex-grow flex flex-col justify-between">
                
                <!-- Overlay Text -->
                <div class="space-y-3">
                    <img src="https://image.tmdb.org/t/p/original{{ $logo }}" draggable="false" alt="Logo Image" class="w-1/8 h-auto mb-4" style="max-height: 300px; max-width: 500px;"> 
                    
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
                        <p><span>{{ $release }}</span><span class="pl-2 pr-2">•</span><span>DURATION</span></p>
                    </div>
                    
                    <p class="mt-3 font-bold" style="max-width: 750px;">{{$description}}</p>
                    {{-- TODO! Play button --}}
                    <a href="#">
                        <div class="inline-block bg-white text-black text-xl px-8 py-4 rounded-md mt-3 font-bold">
                            <i class="fa-solid fa-play pr-3"></i>
                            <span>Play</span>
                        </div>
                    </a>

                    <h1 class="text-2xl font-bold border-violet-700 w-fit border-b-4">Suggested</h1>
                    <div class="border-b-4 border-gray-700 mb-2"></div>
                    <!-- Carousel Container -->
                    <div class="carousel-container relative overflow-hidden">
                    <div class="owl-carousel">
                        @foreach ($suggested as $suggestion)
                        <div class="item">
                            <a href="{{route('mv.info', $suggestion->getId())}}">
                                <img src="{{ $imageHelper->getUrl($suggestion->getPosterImage(), 'w400') }}" alt="Movie Poster" class="rounded-md shadow-lg imageHover max-w-full h-auto">
                            </a>
                        </div>
                        @endforeach
                    </div>  
                </div>
                
            </div>
            
            
        </div>
    </div>
</x-app-layout>
