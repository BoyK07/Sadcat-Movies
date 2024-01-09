<x-app-layout>
    <div class="p-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-5 text-gray-900 dark:text-gray-100">
                <form action="{{ route('search.search') }}" method="POST">
                    <div class="relative text-gray-600 dark:text-gray-400 ">
                        <input type="search" name="search" placeholder="Search" value="{{ request()->get('search') }}"
                            class="bg-white dark:bg-gray-800 h-10 px-5 pr-10 py-6 rounded-full text-lg focus:outline-none w-full">
                        <button type="submit" class="absolute right-0 top-0 mt-4 mr-6">
                            <i class="fa-solid fa-search"></i>
                        </button>
                        {{ csrf_field() }}
                </form>
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 lg:grid-cols-6 gap-4">
                    @foreach ($results['results'] as $result)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                @php
                                    $mediaType = $result['media_type'] != 'tv' ? 'mv' : 'tv';
                                    $posterPath = isset($result['poster_path']) ? $imageHelper->getUrl($result['poster_path'], 'w300') : asset('img/placeholder.png');
                                @endphp

                                <a href="{{ route($mediaType . '.info', $result['id']) }}">
                                    <img src="{{ $posterPath }}" alt="image"
                                        class="rounded-md shadow-lg imageHover">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-app-layout>
