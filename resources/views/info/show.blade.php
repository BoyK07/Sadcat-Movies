<x-app-layout>
    <div class="relative bg-[#191928] opacity-100 overflow-x-hidden" style="height: calc(100vh - 66px); width: 100%; background-image: url('https://image.tmdb.org/t/p/original{{ $backimage }}'); background-size: cover; background-position: center; background-attachment: fixed;">

        <!-- Dark Overlay -->
        <div class="sticky top-0 inset-x-0 bg-black opacity-40 h-full"></div>

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
                        <p><span>{{ $release }}</span></p>
                    </div>

                    <p class="mt-3 font-bold" style="max-width: 750px;">{{$description}}</p>
                    {{-- Play button --}}
                    <div class="flex item-center">
                        <a href="#">
                            <div class="inline-block bg-white text-black text-xl px-8 py-4 rounded-md mt-3 font-bold">
                                <i class="fa-solid fa-play pr-3"></i>
                                <span>Play</span>
                            </div>
                        </a>
                        @if (Auth::user() != null)
                            <div class="ml-5 inline-block bg-white text-black text-xl px-8 py-4 rounded-md mt-3 font-bold">
                                @if (!$isInWatchlist)
                                <form action="{{ route('watchlist.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="title" value="{{ $title }}">
                                    <input type="hidden" name="type" value="tv">
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
                                    <input type="hidden" name="type" value="tv">
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
                        @endif
                    </div>                    

                    <div class="flex items-center border-b-4 border-gray-700 mb-2">
                        <h1 class="text-2xl font-bold w-fit toggle-section active-section hover-mouse" id="episode-header">Episodes</h1>
                        <h1 class="text-2xl ml-10 font-bold w-fit toggle-section hover-mouse" id="suggestion-header">Suggestions</h1>
                    </div>
                    
                    <div class="flex flex-col">
                        <div class="absolute items-center section-content" id="episode-content">
                            <!-- Seasons (Fixed Position at Top) -->
                            <div class="seasons-container">
                                @php $i = 0 @endphp
                                @foreach ($seasons as $season)
                                    @if ($season->getName() != "Specials")
                                        @php $i++; @endphp
                                        <span class="season-name text-lg font-bold hover-mouse mr-8" data-season="{{ $i }}">
                                            {{$season->getName()}}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                                            
                            <div class="episodes-container mt-4 overflow-y-auto">
                                @php $i = 0; @endphp
                                @foreach ($seasons as $season)
                                    @if ($season->getName() != "Specials")
                                        @php $i++; $j = 0 @endphp
                                        <div class="episodes grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-5" data-episodes-for="{{ $i }}">
                                            @foreach ($tvsrepo->load($id, $i)->getEpisodes() as $episode)
                                                @php $j++; @endphp
                                                <a href="#">
                                                    <img src="https://image.tmdb.org/t/p/w300{{$episode->getStillImage()}}" alt="{{$episode->getName()}}" class="rounded-md hover imageHover">
                                                    <span>{{$j}}. {{$episode->getName()}}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    
            
                    <div class="suggestion-container section-content hidden" id="suggestion-content">
                        <div class="carousel-container relative overflow-hidden">
                            <div class="owl-carousel">
                                @foreach ($suggested as $suggestion)
                                <div class="item">
                                    <a href="{{route('tv.info', $suggestion->getId())}}">
                                        <img src="{{ $imageHelper->getUrl($suggestion->getPosterImage(), 'w400') }}" alt="TvShow Poster" class="rounded-md shadow-lg imageHover max-w-full h-auto">
                                    </a>
                                </div>
                                @endforeach
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
