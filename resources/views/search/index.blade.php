<x-app-layout>
    <div class="p-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('search.search') }}" method="POST">
                    <div class="relative text-gray-600 dark:text-gray-400 ">
                        <input type="search" name="search" placeholder="Search" value="{{ request()->get('search') }}"
                            class="bg-white dark:bg-gray-800 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                        <button type="submit" class="absolute right-0 top-0 mt-2 mr-4">
                            <i class="fa-solid fa-search"></i>
                        </button>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
