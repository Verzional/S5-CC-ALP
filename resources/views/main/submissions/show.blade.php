<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('submissions.index') }}"
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
                        Submission Detail
                    </span>
                    <h1 class="text-3xl font-extrabold text-slate-800">{{ $submission->student_name }}</h1>
                    <p class="text-slate-500 flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5 text-[#764BA2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        {{ $submission->assignment->title }}
                    </p>
                </div>
                <div class="flex items-center gap-4 self-end sm:self-start">
                    <span class="text-xs font-semibold text-slate-400 bg-slate-100 px-3 py-1.5 rounded-full">
                        {{ $submission->created_at->format('M d, Y') }}
                    </span>
                    <a href="{{ route('submissions.edit', $submission) }}"
                        class="p-2.5 bg-white rounded-xl shadow-sm text-slate-400 hover:text-[#764BA2] hover:shadow-md transition-all border border-slate-200">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="p-6 sm:p-8 space-y-10">
                <div class="grid grid-cols-1 gap-8">
                    <section class="space-y-3">
                        <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Assignment
                            Description</h3>
                        <div
                            class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-slate-600 leading-relaxed font-medium">
                            {{ $submission->assignment->description }}
                        </div>
                    </section>

                    <section class="space-y-3">
                        <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Submitted File
                        </h3>
                        <div
                            class="flex items-center justify-between p-5 border border-slate-100 rounded-2xl bg-white group hover:bg-slate-50 transition-colors">
                            <div class="flex items-center gap-4 overflow-hidden">
                                <div
                                    class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center shadow-sm shrink-0 border border-red-100">
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="truncate">
                                    <p class="font-bold text-slate-700 text-sm truncate uppercase tracking-tight">
                                        {{ basename($submission->file_path) }}</p>
                                    <p class="text-[10px] text-slate-400 uppercase font-black tracking-widest">PDF
                                        Document</p>
                                </div>
                            </div>
                            <a href="{{ route('submissions.download', $submission) }}"
                                class="px-6 py-2.5 bg-white text-[#764BA2] border-2 border-[#764BA2]/20 text-xs font-bold rounded-xl hover:bg-[#764BA2] hover:text-white hover:border-[#764BA2] transition-all whitespace-nowrap shadow-sm">
                                Download
                            </a>
                        </div>
                    </section>
                </div>

                @if (!$submission->result)
                    <div
                        class="bg-indigo-50/40 rounded-3xl p-8 border border-dashed border-indigo-200 text-center space-y-4">
                        <div
                            class="inline-flex p-3.5 bg-white rounded-2xl shadow-sm text-[#764BA2] border border-indigo-50">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-extrabold text-slate-800">Ready to Evaluate?</h2>
                        <p class="text-sm text-slate-500 max-w-sm mx-auto font-medium leading-relaxed">
                            AI will analyze the submission based on logical reasoning and assigned criteria.
                        </p>

                        <form id="grade-form" action="{{ route('submissions.grade', $submission) }}" method="POST">
                            @csrf
                            <button id="grade-button" type="submit"
                                class="mt-4 px-10 py-4 bg-[#764BA2] hover:bg-[#633e8a] text-white font-bold rounded-2xl shadow-lg shadow-indigo-200/50 transition-all flex items-center justify-center gap-2 mx-auto active:scale-95">
                                Start AI Grading Analysis
                            </button>
                        </form>
                    </div>
                @endif

                @if ($submission->result)
                    <section class="bg-slate-50/80 rounded-[2.5rem] p-6 sm:p-10 border border-slate-100 space-y-10">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-[#764BA2] rounded-2xl shadow-md text-white">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.364-6.364l-.707-.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M12 11a3 3 0 110-6 3 3 0 010 6z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-slate-800 tracking-tight">AI Analysis Report</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <span
                                    class="text-[10px] font-black text-[#764BA2] uppercase tracking-[0.2em] ml-1">Logical
                                    Reasoning</span>
                                <div
                                    class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 min-h-[140px] text-slate-600 leading-relaxed font-medium">
                                    {{ $submission->result->reasoning }}
                                </div>
                            </div>
                            <div class="space-y-3">
                                <span
                                    class="text-[10px] font-black text-[#764BA2] uppercase tracking-[0.2em] ml-1">Overall
                                    Feedback</span>
                                <div
                                    class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 min-h-[140px] text-slate-600 leading-relaxed font-medium">
                                    "{{ $submission->result->feedback ?? 'No additional feedback provided.' }}"
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <span class="text-[10px] font-black text-[#764BA2] uppercase tracking-[0.2em] ml-1">Notable
                                Points</span>
                            <div class="bg-white p-6 rounded-2xl border-l-4 border-[#764BA2] shadow-sm">
                                <ul class="space-y-3">
                                    @php $points = explode("\n", $submission->result->notable_points); @endphp
                                    @foreach ($points as $point)
                                        @if (trim($point) !== '')
                                            <li
                                                class="flex items-start gap-3 text-slate-600 leading-relaxed font-semibold text-sm">
                                                <span
                                                    class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#764BA2] shrink-0"></span>
                                                <span>{{ $point }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        @if ($submission->result->breakdown)
                            <div x-data="{ open: false }"
                                class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm transition-all duration-500 hover:shadow-md hover:border-[#764BA2]/20">

                                <button @click="open = !open"
                                    class="w-full px-8 py-6 flex items-center justify-between group focus:outline-none bg-white transition-colors duration-300"
                                    :class="open ? 'bg-slate-50/30' : ''">

                                    <div class="flex items-center gap-5 text-left">
                                        <div
                                            class="hidden sm:flex items-center justify-center w-12 h-12 rounded-2xl bg-indigo-50 text-[#764BA2] transition-transform duration-500 group-hover:scale-110">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span
                                                class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] leading-none mb-1 block">Assessment
                                                Analysis</span>
                                            <h3 class="text-xl font-black text-slate-800 tracking-tight">Criterion
                                                Breakdown</h3>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-8">
                                        <div class="flex flex-col items-end border-r border-slate-200 pr-6">
                                            <span
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Final
                                                Result</span>
                                            <div class="flex items-baseline gap-1">
                                                <span
                                                    class="text-3xl font-black text-[#764BA2] leading-none tracking-tighter">{{ $submission->result->grade }}</span>
                                                <span class="text-xs font-bold text-slate-300">/100</span>
                                            </div>
                                        </div>

                                        <div
                                            class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center group-hover:bg-[#764BA2] group-hover:text-white transition-all duration-300 shadow-inner">
                                            <svg class="w-5 h-5 transition-transform duration-500 ease-in-out"
                                                :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </button>

                                <div x-show="open" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 -translate-y-4"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="px-8 pb-8 bg-white border-t border-slate-100">

                                    <div class="pt-6 space-y-4">
                                        @foreach ($submission->result->breakdown as $item)
                                            <div
                                                class="group/item flex flex-col md:flex-row md:items-center gap-6 p-5 rounded-2xl transition-all duration-300 hover:bg-[#F8F9FF] border border-transparent hover:border-indigo-50">

                                                <div class="flex-1 space-y-1">
                                                    <h4
                                                        class="text-sm font-black text-slate-700 uppercase tracking-tight group-hover/item:text-[#764BA2] transition-colors">
                                                        {{ $item['criterion'] }}
                                                    </h4>
                                                </div>

                                                <div class="flex items-center gap-6 md:w-3/5">
                                                    <div class="shrink-0 text-right min-w-[80px]">
                                                        <span
                                                            class="text-2xl font-black text-[#764BA2] tracking-tighter">{{ $item['score'] }}</span>
                                                        <span
                                                            class="text-xs font-bold text-slate-300">/{{ $item['max_score'] }}</span>
                                                    </div>

                                                    <div class="flex-1 space-y-2">
                                                        <div
                                                            class="flex justify-between items-center text-[10px] font-black text-slate-300 uppercase tracking-tighter">
                                                            <span>Efficiency</span>
                                                            <span>{{ round(($item['score'] / $item['max_score']) * 100) }}%</span>
                                                        </div>
                                                        <div
                                                            class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden p-0.5 shadow-inner">
                                                            <div class="bg-gradient-to-r from-[#764BA2] to-[#A276D1] h-full rounded-full transition-all duration-1000 shadow-sm"
                                                                style="width: {{ ($item['score'] / $item['max_score']) * 100 }}%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </section>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('grade-form')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            const button = document.getElementById('grade-button');
            button.disabled = true;
            button.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing AI Analysis...
            `;

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await response.json();
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                    button.disabled = false;
                    button.innerHTML = 'Retry AI Grading';
                }
            } catch (error) {
                alert('Communication error with AI service.');
                button.disabled = false;
                button.innerHTML = 'Start AI Grading Analysis';
            }
        });
    </script>
</x-app-layout>
