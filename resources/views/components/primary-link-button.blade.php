@props(['href'])

<a href="{{ $href }}"
    class="w-full sm:w-auto px-6 py-3 bg-[#764BA2] hover:bg-[#633e8a]
           text-white font-bold rounded-xl shadow-lg shadow-indigo-200
           transition-transform transform hover:-translate-y-0.5
           flex items-center justify-center gap-2">
    {{ $slot }}
</a>
