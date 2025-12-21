<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <a href="{{ route('rubrics.index') }}"
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
                        Rubric Detail
                    </span>
                    <h1 class="text-3xl font-extrabold text-slate-800">{{ $rubric->subject_name }}</h1>
                    <p class="text-slate-500 flex items-center gap-2 font-medium text-sm">
                        <svg class="w-5 h-5 text-[#764BA2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Created on {{ $rubric->created_at->format('M d, Y') }}
                    </p>
                </div>

                <div class="flex items-center gap-3 self-end sm:self-start">
                    <a href="{{ route('rubrics.edit', $rubric->id) }}"
                        class="p-2.5 bg-white rounded-xl shadow-sm text-slate-400 hover:text-[#764BA2] hover:shadow-md transition-all border border-slate-200">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <form action="{{ route('rubrics.destroy', $rubric->id) }}" method="POST"
                        onsubmit="return confirm('Delete this rubric? This might affect assignments.');">
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

            <div class="p-8">

                @php
                    // Logic Decode JSON Criteria
                    $criteriaList = is_string($rubric->criteria)
                        ? json_decode($rubric->criteria, true)
                        : $rubric->criteria;
                    $criteriaList = is_array($criteriaList) ? $criteriaList : [];

                    // Hitung Total Weight
                    $totalWeight = array_reduce(
                        $criteriaList,
                        function ($carry, $item) {
                            return $carry + ($item['weight'] ?? 0);
                        },
                        0,
                    );
                @endphp

                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-700 border-l-4 border-[#764BA2] pl-3">
                        Assessment Criteria
                    </h3>

                    <div class="flex items-center gap-2 bg-indigo-50 px-4 py-2 rounded-xl border border-indigo-100">
                        <span class="text-xs font-bold text-gray-500 uppercase">Total Weight</span>
                        <span class="text-lg font-bold {{ $totalWeight == 100 ? 'text-green-600' : 'text-red-500' }}">
                            {{ $totalWeight }}%
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4">

                    @forelse($criteriaList as $index => $item)
                        <div
                            class="group bg-white rounded-2xl p-5 border border-gray-100 hover:border-indigo-200 hover:shadow-md transition-all flex flex-col md:flex-row gap-5 items-start">

                            <div
                                class="flex-shrink-0 w-12 h-12 bg-[#F0F2FF] text-[#764BA2] rounded-xl flex items-center justify-center font-bold text-lg group-hover:bg-[#764BA2] group-hover:text-white transition-colors">
                                {{ $loop->iteration }}
                            </div>

                            <div class="flex-grow">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-lg font-bold text-gray-700">{{ $item['name'] }}</h4>
                                    <span
                                        class="md:hidden bg-indigo-50 text-[#764BA2] px-2 py-1 rounded text-xs font-bold">{{ $item['weight'] }}%</span>
                                </div>
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    {{ $item['description'] ?? 'No specific description provided for this criterion.' }}
                                </p>
                            </div>

                            <div
                                class="hidden md:flex flex-col items-end justify-center self-center pl-6 border-l border-gray-100 min-w-[100px]">
                                <span
                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Weight</span>
                                <span class="text-2xl font-bold text-[#764BA2]">{{ $item['weight'] }}%</span>
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-gray-400 font-medium">No criteria found.</p>
                        </div>
                    @endforelse

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
