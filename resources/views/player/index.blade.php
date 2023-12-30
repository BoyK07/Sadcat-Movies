<x-app-layout>
    <div class="py-5">
        <div class="max-w-10xl mx-auto px-2 sm:px-4 lg:px-6">
            <div class="h-fit bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 border-gray-200 dark:bg-gray-800 dark:text-white">
<<<<<<< Updated upstream
                    <div class="flex">
=======
                    <div class="flex justify-between h-max">
>>>>>>> Stashed changes
                        <div>
                            <!-- Dropdown for providers -->
                            <select id="providerSelect" class="mb-4 dark:bg-gray-800 dark:text-white rounded-md">
                                @if ($type == 'mv')
                                    @php $default = "https://multiembed.mov/?video_id=$tmdb_id&tmdb=1" @endphp
                                    <option value="https://multiembed.mov/?video_id={{ $tmdb_id }}&tmdb=1">
                                        SuperEmbed</option>
                                    <option value="https://autoembed.to/movie/tmdb/{{ $tmdb_id }}">Auto Embed
                                    </option>
                                @elseif($type == 'tv')
                                    @php $default = "https://multiembed.mov/?video_id=$tmdb_id&tmdb=1&s=$season&e=$episode" @endphp
                                    <option
                                        value="https://multiembed.mov/?video_id={{ $tmdb_id }}&tmdb=1&s={{ $season }}&e={{ $episode }}">
                                        SuperEmbed</option>
                                    <option
                                        value="https://autoembed.to/tv/tmdb/{{ $tmdb_id }}-{{ $season }}-{{ $episode }}">
                                        Auto Embed</option>
                                @endif
                            </select>
                        </div>
                        @if ($type == 'tv')
<<<<<<< Updated upstream
                            <div class="flex flex-col md:flex-row ml-auto mr-3 pb-5 space-y-2 md:space-y-0 md:space-x-5">
=======
                        <div class="flex justify-between gap-4 ml-auto mr-3 pb-5 space-y-2 md:space-y-0 md:space-x-5">
                            <div>
>>>>>>> Stashed changes
                                <form action="{{ route('player.add', $tmdb_id) }}" method="POST" class="w-full md:w-auto">
                                    @csrf
                                    <input type="hidden" name="tmdb_id" value="{{ $tmdb_id }}">
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    <input type="hidden" name="season" value="{{ $season }}">
                                    <input type="hidden" name="episode" value="{{ $episode + 1 }}">
                                    <button type="submit" name="next" value="1"
<<<<<<< Updated upstream
                                        class="inline-block w-full md:w-auto bg-white text-black text-lg px-5 py-2 rounded-md font-bold">
                                        <i class="fa-solid fa-play pr-2"></i><span>Next Episode</span>
                                    </button>
                                </form>
=======
                                            class="w-full md:w-auto bg-white text-black text-lg px-5 py-2 rounded-md font-bold">
                                        <i class="fa-solid fa-play pr-2"></i><span>Next Episode</span>
                                    </button>
                                </form>
                            </div>
                            <div>
>>>>>>> Stashed changes
                                <form action="{{ route('player.add', $tmdb_id) }}" method="POST" class="w-full md:w-auto">
                                    @csrf
                                    <input type="hidden" name="tmdb_id" value="{{ $tmdb_id }}">
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    <input type="hidden" name="season" value="{{ $season + 1 }}">
                                    <input type="hidden" name="episode" value="{{ $episode = 1 }}">
                                    <button type="submit" name="next" value="1"
<<<<<<< Updated upstream
                                        class="inline-block w-full md:w-auto bg-white text-black text-lg px-5 py-2 rounded-md font-bold">
=======
                                            class="w-full md:w-auto bg-white text-black text-lg px-5 py-2 rounded-md font-bold">
>>>>>>> Stashed changes
                                        <i class="fa-solid fa-play pr-2"></i><span>Next Season</span>
                                    </button>
                                </form>
                            </div>
<<<<<<< Updated upstream
=======
                        </div>
>>>>>>> Stashed changes
                        @endif
                    </div>
                    <!-- iFrame for movie -->
                    <iframe id="movieFrame" 
                            src="{{ $default }}" 
<<<<<<< Updated upstream
                            width="100%" 
                            class="h-3/4-screen md:h-4/5-screen lg:h-[700px]" 
=======
                            width="100%"
                            height="100%"
>>>>>>> Stashed changes
                            frameborder="0"
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Listen for changes on the dropdown
        document.getElementById('providerSelect').addEventListener('change', function() {
            var selectedURL = this.value;

            // Check if the selected URL is not the current page URL
            if (selectedURL !== window.location.href) {
                document.getElementById('movieFrame').src = selectedURL;
            } else {
                console.log("Attempting to load the same page within the iframe. Action prevented.");
            }
        });
    </script>
</x-app-layout>
