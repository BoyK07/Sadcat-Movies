<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white">
                    <h1 class="text-2xl font-bold mb-4">Popular</h1>
                    <div class="carousel-container relative">
                        <div class="owl-carousel">
                            @foreach ($movies as $movie)
                                <div class="item">
                                    <img src="{{ $imageHelper->getUrl($movie->getPosterImage(), 'w400') }}" alt="Movie Poster" class="rounded-md shadow-lg">
                                </div>
                            @endforeach
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>