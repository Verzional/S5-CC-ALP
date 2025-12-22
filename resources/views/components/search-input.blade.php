@props(['action', 'placeholder' => 'Search...'])

<form method="GET" action="{{ $action }}" class="relative w-full sm:w-72">
    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </span>

    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ $placeholder }}"
        class="w-full py-2.5 pl-10 pr-4 bg-gray-50 border border-gray-200
       text-gray-700 rounded-xl focus:outline-none
       focus:ring-2 focus:ring-[#764BA2]
       transition-all placeholder-gray-400">

    @if (request('search'))
        <a href="{{ $action }}"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500">
            ✕
        </a>
    @endif
</form>
