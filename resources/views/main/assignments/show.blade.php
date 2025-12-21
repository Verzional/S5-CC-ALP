<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('assignments.index') }}"
                class="inline-flex items-center gap-2 text-slate-500 font-semibold hover:text-[#764BA2] transition-colors group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
            <div
                class="bg-[#F8F9FF] p-6 sm:p-8 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start gap-4">
                <div class="space-y-2">
                    <span
                        class="inline-block bg-[#764BA2] text-white text-[10px] px-2.5 py-1 rounded-lg font-bold uppercase tracking-widest shadow-sm">
                        Assignment Detail
                    </span>
                    <h1 class="text-3xl font-extrabold text-slate-800">{{ $assignment->title }}</h1>
                    <p class="text-slate-500 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5 text-[#764BA2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Created on {{ $assignment->created_at->format('M d, Y') }}
                    </p>
                </div>
                <div class="flex items-center gap-3 self-end sm:self-start">
                    <a href="{{ route('assignments.edit', $assignment->id) }}"
                        class="p-2.5 bg-white rounded-xl shadow-sm text-slate-400 hover:text-[#764BA2] hover:shadow-md transition-all border border-slate-200">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST"
                        onsubmit="return confirm('Delete this assignment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="p-2.5 bg-white rounded-xl shadow-sm text-slate-400 hover:text-red-500 hover:shadow-md transition-all border border-slate-200">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">



                <div class="lg:col-span-2 space-y-6">

                    <div>

                        <h3 class="text-lg font-bold text-gray-800 mb-3 border-b border-gray-100 pb-2">Description</h3>

                        <div class="prose text-gray-600 leading-relaxed">

                            {{ $assignment->description ?? 'No description provided.' }}

                        </div>

                    </div>

                </div>



                <div class="bg-gray-50 rounded-2xl p-6 h-fit border border-gray-100">

                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Grading Criteria</h3>



                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mb-4">

                        <div class="text-xs text-gray-500 mb-1">Rubric Name</div>

                        <div class="font-bold text-[#764BA2] text-lg">

                            {{ $assignment->rubric->subject_name ?? 'Unknown' }}

                        </div>

                    </div>



                    <a href="{{ route('rubrics.show', $assignment->rubric_id) }}"
                        class="block w-full py-2.5 text-center bg-[#EBEBFF] text-[#764BA2] font-bold rounded-xl hover:bg-[#dadaff] transition-colors text-sm">
                        View Full Rubric
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
