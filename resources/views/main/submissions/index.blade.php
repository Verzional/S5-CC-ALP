<x-index-layout title="Submissions List" description="Manage student submissions and AI grading results.">
    <x-slot name="actions">
        <form method="GET" action="{{ route('submissions.index') }}" class="relative w-full sm:w-72">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search submissions..."
                class="w-full py-2.5 pl-10 pr-4 bg-gray-50 border border-gray-200
               text-gray-700 rounded-xl focus:outline-none
               focus:ring-2 focus:ring-[#764BA2]
               transition-all placeholder-gray-400">

            @if (request('search'))
                <a href="{{ route('submissions.index') }}"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500">
                    ✕
                </a>
            @endif
        </form>


        <a href="{{ route('submissions.create') }}"
            class="w-full sm:w-auto px-6 py-3 bg-[#764BA2] hover:bg-[#633e8a]
                   text-white font-bold rounded-xl shadow-lg shadow-indigo-200
                   transition-transform transform hover:-translate-y-0.5
                   flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Upload Submission
        </a>
    </x-slot>

    <x-toast :message="session('success')" type="success" />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($submissions as $submission)
            <div
                class="bg-[#EBEBFF] rounded-2xl p-6 relative hover:shadow-md transition-shadow group border border-indigo-50 min-h-[200px] flex flex-col justify-between">

                <div class="absolute top-4 right-4 flex gap-2 z-20">
                    <a href="{{ route('submissions.edit', $submission) }}"
                        class="w-8 h-8 flex items-center justify-center bg-[#D0D3F5] text-[#764BA2] rounded-lg hover:bg-[#764BA2] hover:text-white hover:scale-110 transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>

                    <form action="{{ route('submissions.destroy', $submission) }}" method="POST"
                        onsubmit="return confirm('Delete this submission?');">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="w-8 h-8 flex items-center justify-center bg-[#ffdede] text-red-500 rounded-lg hover:bg-red-500 hover:text-white hover:scale-110 transition-all">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>

                <a href="{{ route('submissions.show', $submission) }}" class="block">
                    <div
                        class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mb-4 text-[#764BA2] shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                    </div>

                    <h3
                        class="text-lg font-bold text-gray-700 mb-1 pr-16 leading-tight group-hover:text-[#764BA2] transition-colors">
                        {{ $submission->assignment->title }}
                    </h3>

                    <p class="text-sm text-gray-600 font-medium mb-4 flex items-center gap-1">
                        {{ $submission->student_name }}
                    </p>

                    <div
                        class="pt-4 border-t border-indigo-200/50 text-[10px] text-gray-400 font-bold uppercase tracking-widest flex justify-between items-center">
                        <span>Uploaded {{ $submission->created_at->diffForHumans() }}</span>
                        @if ($submission->result)
                            <span
                                class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-[10px] font-bold">GRADED</span>
                        @else
                            <span
                                class="bg-gray-200 text-gray-500 px-2 py-0.5 rounded text-[10px] font-bold">PENDING</span>
                        @endif
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full py-16 text-center">
                <p class="text-gray-500">No submissions found.</p>
            </div>
        @endforelse
    </div>
</x-index-layout>
