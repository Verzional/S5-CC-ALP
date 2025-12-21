<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-4">
        <div class="bg-white rounded-3xl shadow-xl shadow-indigo-100 overflow-hidden border border-indigo-50">
            <div class="bg-[#764BA2] p-6 text-white text-center">
                <h2 class="text-2xl font-bold">Submit New Work</h2>
                <p class="opacity-80">Fill in the details to upload student assignments.</p>
            </div>

            <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data"
                class="p-8 space-y-6" x-data="{ files: null }"> @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Assignment Target</label>
                    <select name="assignment_id"
                        class="w-full rounded-xl border-gray-200 focus:border-[#764BA2] focus:ring focus:ring-indigo-100 transition-all"
                        required>
                        <option value="">Select an Assignment</option>
                        @foreach ($assignments as $assignment)
                            <option value="{{ $assignment->id }}">{{ $assignment->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Student Name</label>
                    <input type="text" name="student_name" placeholder="Enter student's full name"
                        class="w-full rounded-xl border-gray-200 focus:border-[#764BA2] focus:ring focus:ring-indigo-100 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Upload PDF Files (Multiple)</label>
                    <div class="relative border-2 border-dashed rounded-2xl p-8 text-center transition-all duration-300"
                        :class="files ? 'border-green-400 bg-green-50' : 'border-gray-200 hover:border-[#764BA2]'">

                        <input type="file" name="pdf_files[]" accept=".pdf" multiple required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                            @change="files = $event.target.files">
                        <div class="space-y-2">
                            <svg class="w-10 h-10 mx-auto mb-2 transition-colors duration-300"
                                :class="files ? 'text-green-500' : 'text-gray-400'" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path x-show="!files" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                <path x-show="files" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <template x-if="!files">
                                <p class="text-sm text-gray-500">Click to upload or drag and drop</p>
                            </template>

                            <template x-if="files">
                                <div class="space-y-1">
                                    <p class="text-sm font-bold text-green-700">Selected files:</p>
                                    <div class="flex flex-wrap justify-center gap-2">
                                        <template x-for="file in Array.from(files)" :key="file.name">
                                            <span
                                                class="bg-white border border-green-200 text-green-600 text-xs px-3 py-1 rounded-full shadow-sm"
                                                x-text="file.name"></span>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('submissions.index') }}"
                        class="text-gray-400 font-bold hover:text-gray-600 transition-colors">Cancel</a>
                    <button type="submit"
                        class="px-8 py-3 bg-[#764BA2] hover:bg-[#633e8a] text-white font-bold rounded-xl shadow-lg transition-all">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
