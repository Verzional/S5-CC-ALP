<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $submissions = Submission::with('assignment')
            ->when($request->search, function ($query, $search) {
                $query->where('student_name', 'like', "%{$search}%")
                    ->orWhereHas('assignment', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->get();
            
        return view('main.submissions.index', compact('submissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assignments = Assignment::all();

        return view('main.submissions.create', compact('assignments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pdf_files' => 'required|array|min:1',
            'pdf_files.*' => 'mimes:pdf',
            'assignment_id' => 'required|exists:assignments,id',
            'student_name' => 'nullable|string',
        ]);

        $name = $request->input('student_name', 'Anonymous');
        $parser = new Parser;

        foreach ($request->file('pdf_files') as $file) {
            $path = $file->store('submissions');
            $pdf = $parser->parseFile(storage_path('app/' . $path));
            $text = $pdf->getText();

            Submission::create([
                'assignment_id' => $request->assignment_id,
                'student_name' => $name,
                'file_path' => $path,
                'extracted_text' => $text,
            ]);
        }

        return redirect()->route('submissions.index')->with('success', 'Submission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        $submission->load('result');
        return view('main.submissions.show', compact('submission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submission $submission)
    {
        $assignments = Assignment::all();
        return view('main.submissions.edit', compact('submission', 'assignments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'student_name' => 'required|string',
            'assignment_id' => 'required|exists:assignments,id',
            'pdf_file' => 'nullable|mimes:pdf|max:20480',
        ]);

        $submission->student_name = $request->student_name;
        $submission->assignment_id = $request->assignment_id;

        // Cek jika ada file baru yang diunggah
        if ($request->hasFile('pdf_file')) {
            // 1. Hapus file lama dari storage
            if (Storage::exists($submission->file_path)) {
                Storage::delete($submission->file_path);
            }

            // 2. Simpan file baru
            $file = $request->file('pdf_file');
            $path = $file->store('submissions');

            // 3. Ekstraksi teks baru
            $parser = new Parser();
            $pdf = $parser->parseFile(storage_path('app/' . $path));
            $text = $pdf->getText();

            // 4. Update path dan teks
            $submission->file_path = $path;
            $submission->extracted_text = $text;

            // Opsi: Hapus hasil grading lama jika file berubah karena konten sudah berbeda
            if ($submission->result) {
                $submission->result->delete();
            }
        }

        $submission->save();
        return redirect()->route('submissions.index')->with('success', 'Submission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        if ($submission->file_path && Storage::exists($submission->file_path)) {
            Storage::delete($submission->file_path);
        }

        if ($submission->result) {
            $submission->result->delete();
        }

        $submission->delete();

        return redirect()->route('submissions.index')->with('success', 'Submission deleted successfully.');
    }

    /**
     * Download the submission file.
     */
    public function download(Submission $submission)
    {
        $path = storage_path('app/' . $submission->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path, basename($submission->file_path));
    }
}
