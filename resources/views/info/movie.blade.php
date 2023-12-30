<x-app-layout>
    <div class="relative bg-[#191928] opacity-100 overflow-x-hidden" style="height: calc(100vh - 66px); width: 100%; background-image: url('https://image.tmdb.org/t/p/original{{ $backimage }}'); background-size: cover; background-position: center; background-attachment: fixed;">

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black opacity-40"></div>

        <!-- Main Content Container -->
        <div class="absolute z-10 top-20 text-white w-full padding-container flex flex-col h-full" style="max-height: calc(100% - 120px);">

            <!-- Wrapper with left-8 spacing -->
            <div class="left-8 flex-grow flex flex-col justify-between">

                <!-- Overlay Text -->
                <div class="space-y-3">
                    <img src="https://image.tmdb.org/t/p/original{{ $logo }}" draggable="false" alt="Logo Image" class="w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4 h-auto mb-4 max-h-[300px] max-w-[500px]">

                    <div class="flex space-x-4 items-center">
                        {{-- Genres --}}
                        <div>
                            @foreach ($genres as $genre)
                                <span class="inline-block bg-gray-700 text-white px-2 rounded-md mr-1 mb-1">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <!-- Release Box -->
                        <p><span>{{ $release }}</span><span class="pl-2 pr-2">•</span><span>{{$duration}}</span></p>
                    </div>

                    <p class="mt-3 font-bold" style="max-width: 750px;">{{$description}}</p>
<<<<<<< Updated upstream
                    {{-- Play button --}}
                    <div class="flex item-center">
=======
                    <div class="flex item-center">
                        {{-- Play button --}}
>>>>>>> Stashed changes
                        <form action="{{ route('player.add', $id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="title" value="{{ $title }}">
                            <input type="hidden" name="type" value="mv">
                            <input type="hidden" name="imageurl" value="https://image.tmdb.org/t/p/original{{$backimage}}">
                            <input type="hidden" name="logo_url" value="https://image.tmdb.org/t/p/original{{$logo}}">
                            <button type="submit" class="inline-block bg-white text-black text-xl px-8 py-4 rounded-md mt-3 font-bold">
                                <span><i class="fa-solid fa-play pr-2"></i>Play</span>
                            </button>
                        </form>
<<<<<<< Updated upstream

                            @if (Auth::user() != null)
                            <div class="ml-5 inline-block bg-white text-black text-xl px-8 py-4 rounded-md mt-3 font-bold">
                            @if (!$isInWatchlist)
                                <form action="{{ route('watchlist.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="title" value="{{ $title }}">
                                    <input type="hidden" name="type" value="mv">
                                    <input type="hidden" name="imageurl" value="https://image.tmdb.org/t/p/original{{$backimage}}">
                                    <input type="hidden" name="logo_url" value="https://image.tmdb.org/t/p/original{{$logo}}">
                                    <input type="hidden" name="tmdb_id" value="{{ $id }}">
                                    <button type="submit" class="flex items-center">
                                        <img src="/storage/images/watchlist.png" alt="Watchlist" class="w-6 h-6">
                                        <span class="pl-3">Add to watchlist</span>
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('watchlist.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="title" value="{{ $title }}">
                                    <input type="hidden" name="type" value="mv">
                                    <input type="hidden" name="imageurl" value="https://image.tmdb.org/t/p/original{{$backimage}}">
                                    <input type="hidden" name="logo_url" value="https://image.tmdb.org/t/p/original{{$logo}}">
                                    <input type="hidden" name="tmdb_id" value="{{ $id }}">
                                    <button type="submit" class="flex items-center">
                                        <i class="fa-solid fa-check"></i>
                                        <span class="pl-3">Added to watchlist</span>
                                    </button>
                                </form>
                                @endif
                            </div>
=======
                            @if (Auth::user() != null)
                                <div class="ml-5 inline-block bg-white text-black text-xl px-8 py-4 rounded-md mt-3 font-bold">
                                @if (!$isInWatchlist)
                                    <form action="{{ route('watchlist.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="title" value="{{ $title }}">
                                        <input type="hidden" name="type" value="mv">
                                        <input type="hidden" name="imageurl" value="https://image.tmdb.org/t/p/original{{$backimage}}">
                                        <input type="hidden" name="logo_url" value="https://image.tmdb.org/t/p/original{{$logo}}">
                                        <input type="hidden" name="tmdb_id" value="{{ $id }}">

                                        <button type="submit" class="flex items-center">
                                            <i class="fa-solid fa-bookmark"></i>
                                            <span class="pl-3">Add to watchlist</span>
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('watchlist.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="title" value="{{ $title }}">
                                        <input type="hidden" name="type" value="mv">
                                        <input type="hidden" name="imageurl" value="https://image.tmdb.org/t/p/original{{$backimage}}">
                                        <input type="hidden" name="logo_url" value="https://image.tmdb.org/t/p/original{{$logo}}">
                                        <input type="hidden" name="tmdb_id" value="{{ $id }}">

                                        <button type="submit" class="flex items-center">
                                            <i class="fa-solid fa-check"></i>
                                            <span class="pl-3">Added to watchlist</span>
                                        </button>
                                    </form>
                                    @endif
                                </div>
>>>>>>> Stashed changes
                            @endif
                            <a class="ml-5 inline-block bg-white text-black text-xl px-8 py-4 rounded-md mt-3 font-bold"
                            href="https://bitsearch.to/search?q={{ str_replace(' ', '+', $title) }}"
                            target="_blank">
                            <i class="fa-solid fa-download"></i>
                                <span class="pl-3">Download</span>
                            </a>
                    </div>

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
    </div>
</x-app-layout>
