<x-app-layout>
    <div class="py-12">
        <div class="max-w-10xl mx-auto px-2 sm:px-4 lg:px-6">
            <div class="flex-grow p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold mb-4 text-white">Watchlist</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($watchlist as $item)
                        @if ($item->type == "mv")
                            <a href="{{ route('mv.info', $item->tmdb_id) }}" class="flex flex-col items-center">
                        @elseif ($item->type == "tv")
                            <a href="{{ route('tv.info', $item->tmdb_id) }}" class="flex flex-col items-center">
                        @endif
                        <div class="block mb-6 hover:bg-gray-100 dark:hover:bg-gray-700 p-3 rounded-lg transition duration-300">
                            <div class="flex-none relative">
                                <img src="{{$item->imageurl}}" alt="Poster" class="w-148 h-52 rounded-lg shadow-md">
                                <div class="absolute inset-0 bg-black opacity-40"></div>
                                <img src="{{$item->logo_url}}" alt="Logo" class="absolute w-1/2 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">    
                            </div>
                        </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
