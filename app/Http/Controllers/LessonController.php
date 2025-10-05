<?php

namespace App\Http\Controllers;
use App\Models\Modul;
use App\Models\Lesson;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class LessonController extends Controller
{
     
    public function index($id)
        {
            $kelas = Kelas::with('moduls.lessons')->findOrFail($id);
            $moduls = $kelas->moduls;
            $lessons = $moduls->flatMap->lessons;

            return view('kelas.modul.index', compact('kelas', 'moduls', 'lessons'));
        }
   public function show(Kelas $kelas, Modul $modul, Lesson $lesson)
{
    $lessons = $modul->lessons()->orderBy('id')->get();
    $index = $lessons->search(fn($l) => $l->id === $lesson->id);

    $prevLesson = $lessons[$index - 1] ?? null;
    $nextLesson = $lessons[$index + 1] ?? null;

    // Next Lesson: cek modul berikutnya jika current modul sudah habis
    if (!$nextLesson) {
        $nextModul = $kelas->moduls()->where('id', '>', $modul->id)->orderBy('id')->first();
        if ($nextModul) {
            $nextLesson = $nextModul->lessons()->orderBy('id')->first();
        }
    }

    // Previous Lesson: cek modul sebelumnya jika current modul belum ada sebelumnya
    if (!$prevLesson) {
        $prevModul = $kelas->moduls()->where('id', '<', $modul->id)->orderBy('id', 'desc')->first();
        if ($prevModul) {
            $prevLesson = $prevModul->lessons()->orderBy('id', 'desc')->first();
        }
    }

    return view('kelas.modul.index', compact('kelas', 'modul', 'lesson', 'prevLesson', 'nextLesson'));
}



    public function showcreate($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        return view('kelas.modul.create', compact('kelasId', 'kelas'));
    }
    public function handleFile(Lesson $lesson, $action)
    {
        if ($lesson->type === 'pdf' && $lesson->content) {
            $file = Storage::disk('public')->path($lesson->content);

            if (!file_exists($file)) {
                return back()->with('error', 'File tidak ditemukan.');
            }

            if ($action === 'download') {
                return response()->download($file);
            }

            if ($action === 'preview') {
                return response()->file($file, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="'.basename($file).'"'
                ]);
            }
        }

        return back()->with('error', 'File tidak tersedia.');
    }
   public function store(Request $request)
{
    $request->validate([
        'class_id' => 'required|exists:kelass,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'lessons' => 'nullable|array',
        'lessons.*.title' => 'required_with:lessons|string|max:255',
        'lessons.*.type' => 'required_with:lessons|string',
    ]);

    // Simpan modul
    $modul = Modul::create([
        'class_id'    => $request->class_id,
        'title'       => $request->title,
        'description' => $request->description,
    ]);

    // Simpan pelajaran jika ada
    if ($request->has('lessons')) {
        foreach ($request->lessons as $lesson) {
            $data = [
                'module_id' => $modul->id,
                'title'     => $lesson['title'],
                'type'      => $lesson['type'],
            ];

            // === VIDEO ===
            if ($lesson['type'] === 'video' && !empty($lesson['content'])) {
                $data['content'] = $lesson['content'];
            }

            // === PDF ===
            elseif ($lesson['type'] === 'pdf' && isset($lesson['file']) && $lesson['file'] instanceof \Illuminate\Http\UploadedFile) {
                $path = $lesson['file']->store('pdf_lessons', 'public');
                $data['content'] = $path;
            }

            Lesson::create($data);
        }
    }

    return redirect()
        ->route('modul.create', $request->class_id)
        ->with('success', 'Modul berhasil ditambahkan!');
}

}
