<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
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
            <div class="bg-[#F8F9FF] p-6 sm:p-8 border-b border-slate-100">
                <span
                    class="inline-block bg-[#764BA2] text-white text-[10px] px-2.5 py-1 rounded-lg font-bold uppercase tracking-widest shadow-sm mb-3">
                    Edit Mode
                </span>
                <h2 class="text-2xl font-extrabold text-slate-800">Edit Submission</h2>
                <p class="text-slate-500 text-sm font-medium mt-1">You can update the student name, assignment category,
                    or replace the PDF file.</p>
            </div>

            <form method="POST" action="{{ route('submissions.update', $submission) }}" id="submissionForm"
                enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label for="student_name"
                        class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                        Student Full Name
                    </label>
                    <input type="text" name="student_name" id="student_name"
                        value="{{ old('student_name', $submission->student_name) }}"
                        class="block w-full px-4 py-3 rounded-xl border-slate-200 text-slate-700 font-medium focus:border-[#764BA2] focus:ring focus:ring-[#764BA2]/10 transition-all"
                        required>
                </div>

                <div class="space-y-2">
                    <label for="assignment_id"
                        class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                        Assignment Category
                    </label>
                    <select name="assignment_id" id="assignment_id"
                        class="block w-full px-4 py-3 rounded-xl border-slate-200 text-slate-700 font-medium focus:border-[#764BA2] focus:ring focus:ring-[#764BA2]/10 transition-all">
                        @foreach ($assignments as $assignment)
                            <option value="{{ $assignment->id }}"
                                {{ $submission->assignment_id == $assignment->id ? 'selected' : '' }}>
                                {{ $assignment->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="pdf_file" class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                        Replace PDF File (Optional)
                    </label>
                    <div class="bg-slate-50 border border-slate-100 p-4 rounded-xl">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-indigo-50 text-[#764BA2] rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="overflow-hidden">
                                <p
                                    class="text-[10px] text-slate-400 font-bold uppercase tracking-tight leading-none mb-1">
                                    Current File</p>
                                <p class="text-sm text-slate-600 font-medium truncate">
                                    {{ basename($submission->file_path) }}</p>
                            </div>
                        </div>

                        <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-[#764BA2] hover:file:bg-indigo-100 transition-all cursor-pointer">
                    </div>
                    <p class="text-[10px] text-slate-400 italic ml-1">*Uploading a new file will replace the old
                        document and its extraction.</p>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row items-center justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('submissions.index') }}"
                        class="w-full sm:w-auto px-6 py-3 text-slate-500 font-bold text-sm hover:text-slate-700 transition-colors text-center">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-10 py-3 bg-[#764BA2] hover:bg-[#633e8a] text-white font-bold rounded-2xl shadow-lg shadow-indigo-200/50 transition-all active:scale-95">
                        Update Submission
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
