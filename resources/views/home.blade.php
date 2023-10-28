<x-app-layout>
    <div class="py-12">
        <div class="max-w-10xl mx-auto px-2 sm:px-4 lg:px-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  border-gray-200 dark:bg-gray-800 dark:text-white">
                    <h1 class="text-2xl font-bold mb-4">Popular Movies</h1>
                    <div class="carousel-container relative">
                        <div class="owl-carousel">
                            @foreach ($popularMV as $movie)
                                <div class="item p-1">
                                    <a href="#">
                                        <img src="{{ $imageHelper->getUrl($movie->getPosterImage(), 'w400') }}" alt="Movie Poster" class="rounded-md shadow-lg imageHover">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>                    
                
                    <h1 class="text-2xl font-bold mb-4">Top Rated Movies</h1>
                    <div class="carousel-container relative">
                        <div class="owl-carousel">
                            @foreach ($topRatedMV as $movie)
                                <div class="item p-1">
                                    <a href="#">
                                        <img src="{{ $imageHelper->getUrl($movie->getPosterImage(), 'w400') }}" alt="Movie Poster" class="rounded-md shadow-lg imageHover">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>    
                    
                    <h1 class="text-2xl font-bold mb-4">Popular TV Shows</h1>
                    <div class="carousel-container relative">
                        <div class="owl-carousel">
                            @foreach ($popularTV as $tv)
                                <div class="item p-1">
                                    <a href="#">
                                        <img src="{{ $imageHelper->getUrl($tv->getPosterImage(), 'w400') }}" alt="tv Poster" class="rounded-md shadow-lg imageHover">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>   

                    <h1 class="text-2xl font-bold mb-4">Top Rated TV shows</h1>
                    <div class="carousel-container relative">
                        <div class="owl-carousel">
                            @foreach ($topRatedTV as $tv)
                                <div class="item p-1">
                                    <a href="#">
                                        <img src="{{ $imageHelper->getUrl($tv->getPosterImage(), 'w400') }}" alt="tv Poster" class="rounded-md shadow-lg imageHover">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>