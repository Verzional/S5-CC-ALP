@props(['title', 'description'])

<x-app-layout>
    <div>
        <h2 class="text-2xl font-bold text-gray-700">{{ $title }}</h2>
        <p class="text-gray-500">{{ $description }}</p>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 mt-5">
        {{ $actions ?? '' }}
    </div>

    {{ $slot }}
</x-app-layout>
