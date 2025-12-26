<x-show-layout badge="Rubric Detail" :title="$rubric->subject_name" :subtitle="'Created on ' . $rubric->created_at->format('M d, Y')" :backRoute="route('rubrics.index')" :editRoute="route('rubrics.edit', $rubric->id)"
    :deleteRoute="route('rubrics.destroy', $rubric->id)" deleteConfirm="Delete this rubric? This might affect assignments.">

    <x-slot name="subtitleIcon">
        <svg class="w-5 h-5 text-[#764BA2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </x-slot>

    @php
        $criteriaList = is_string($rubric->criteria) ? json_decode($rubric->criteria, true) : $rubric->criteria;
        $criteriaList = is_array($criteriaList) ? $criteriaList : [];

        $totalWeight = array_reduce(
            $criteriaList,
            function ($carry, $item) {
                return $carry + ($item['weight'] ?? 0);
            },
            0,
        );
    @endphp

    {{-- Criteria Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
            Assessment Criteria
        </h3>

        <div class="flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Weight</span>
            <span class="text-lg font-bold {{ $totalWeight == 100 ? 'text-green-600' : 'text-red-500' }}">
                {{ $totalWeight }}%
            </span>
        </div>
    </div>

    {{-- Criteria List --}}
    <div class="grid grid-cols-1 gap-4">
        @forelse($criteriaList as $index => $item)
            <div
                class="group bg-slate-50 rounded-2xl p-5 border border-slate-100 hover:border-[#764BA2]/30 hover:shadow-md transition-all flex flex-col md:flex-row gap-5 items-start">

                {{-- Number Badge --}}
                <div
                    class="flex-shrink-0 w-12 h-12 bg-white text-[#764BA2] rounded-xl flex items-center justify-center font-bold text-lg group-hover:bg-[#764BA2] group-hover:text-white transition-colors border border-slate-100 shadow-sm">
                    {{ $loop->iteration }}
                </div>

                {{-- Content --}}
                <div class="flex-grow min-w-0">
                    <div class="flex items-center justify-between mb-2 gap-2">
                        <h4 class="text-lg font-bold text-slate-700">{{ $item['name'] }}</h4>
                        <span
                            class="md:hidden bg-[#764BA2]/10 text-[#764BA2] px-2 py-1 rounded-lg text-xs font-bold">{{ $item['weight'] }}%</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        {{ $item['description'] ?? 'No specific description provided for this criterion.' }}
                    </p>
                </div>

                {{-- Weight Badge (Desktop) --}}
                <div
                    class="hidden md:flex flex-col items-end justify-center self-center pl-6 border-l border-slate-200 min-w-[100px]">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Weight</span>
                    <span class="text-2xl font-bold text-[#764BA2]">{{ $item['weight'] }}%</span>
                </div>

            </div>
        @empty
            <div class="text-center py-12 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-slate-400 font-medium">No criteria found.</p>
            </div>
        @endforelse
    </div>
</x-show-layout>
