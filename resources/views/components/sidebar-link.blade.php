@props(['active'])

@php
$classes = $active
            ? 'flex items-center px-4 py-3 rounded-xl transition-all group relative bg-white text-[#764BA2] shadow-sm font-bold'
            : 'flex items-center px-4 py-3 rounded-xl transition-all group relative text-gray-500 hover:text-[#764BA2] hover:bg-indigo-50 font-medium';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($active)
        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#764BA2] rounded-l-xl"></div>
    @endif
    {{ $slot }}
</a>
