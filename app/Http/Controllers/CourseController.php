<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Modul;
use App\Models\LiveClas;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Events\CoursePurchased;
use App\Models\DetailPembelian;

class CourseController extends Controller
{
    public function liveClassStore(Request $request){
         $request->validate([
        'kelas_id' => 'required|exists:kelass,id',
        'judul' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'waktu_mulai' => 'required|date_format:H:i',
        'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        'zona_waktu' => 'required|string|max:10',
    ]);

    LiveClas::create([
        'kelas_id' => $request->kelas_id,
        'judul' => $request->judul,
        'tanggal' => $request->tanggal,
        'waktu_mulai' => $request->waktu_mulai,
        'waktu_selesai' => $request->waktu_selesai,
        'zona_waktu' => $request->zona_waktu,
    ]);

    return redirect()->back()->with('success', 'Live class berhasil ditambahkan!');
    }
    public function liveClass()
    {
        return view('kelas.live');
    }

    public function kelasSaya(Request $request)
    {
        $userId = auth()->id();
        $search = $request->input('search');

        $semuaKelas = Kelas::query()
            ->when($search, function ($query, $search) {
                $query->where('judul_kelas', 'like', "%{$search}%");
            })
            ->with(['DetailPembelians'])
            ->latest()
            ->get();

        $kelasDiikuti = Kelas::whereHas('detailPembelians.pembelian', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->when($search, function ($query, $search) {
                $query->where('judul_kelas', 'like', "%{$search}%");
            })
            ->with('DetailPembelians')
            ->latest()
            ->get();

        $kelasSaya = Kelas::where('dibuat_oleh', $userId)
            ->when($search, function ($query, $search) {
                $query->where('judul_kelas', 'like', "%{$search}%");
            })
            ->with('DetailPembelians')
            ->latest()
            ->get();

        return view('kelas.index', compact('semuaKelas', 'kelasDiikuti', 'kelasSaya'));
    }

    public function beriRating(Request $request, Kelas $kelas)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5'
        ]);

        $userId = auth()->id();

        $detail = DetailPembelian::where('kelas_id', $kelas->id)
            ->whereHas('pembelian', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->first();

        if (!$detail) {
            return redirect()->back()->with('error', 'Record detail pembelian tidak ditemukan!');
        }

        $detail->rating = $request->rating;
        $detail->save();

        $kelas->updateAverageRating();

        return redirect()->back()->with('success', 'Rating berhasil disimpan!');
    }

    public function show()
    {
        $semuaKelas = Kelas::where('is_draft', false)->get();
        $kelasDiikuti = Kelas::whereHas('DetailPembelians.pembelian', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();

        $kelasSaya = Kelas::where('dibuat_oleh', auth()->id())
            ->with('DetailPembelians')
            ->get();

        return view('kelas.index', compact('semuaKelas', 'kelasDiikuti', 'kelasSaya'));
    }

    public function showkelas(Kelas $kelas)
    {
        $pemilik = User::find($kelas->dibuat_oleh);
        $moduls = $kelas->moduls()->orderBy('id')->get();
        $lessons = $moduls->flatMap->lessons;
        $sesiLive = $kelas->sesiLive()->orderBy('tanggal', 'desc')->get();

        $sudahBeli = false;
        $userRating = 0;

        if (auth()->check()) {
            $pembelian = DetailPembelian::whereHas('pembelian', function ($q) {
                $q->where('user_id', auth()->id());
            })->where('kelas_id', $kelas->id)->first();

            if ($pembelian || $kelas->dibuat_oleh == auth()->id()) {
                $sudahBeli = true;
                if ($pembelian) {
                    $userRating = $pembelian->rating;
                }
            }
        }

        return view('kelas.detail', compact(
            'kelas',
            'lessons',
            'moduls',
            'pemilik',
            'sudahBeli',
            'sesiLive',
            'userRating'
        ));
    }

    public function toggleStatus($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->is_draft = !$kelas->is_draft;
        $kelas->save();

        return redirect()->back()->with('success', 'Status kelas berhasil diubah!');
    }

    public function beli($id)
    {
        $kelas = Kelas::findOrFail($id);
        $user = auth()->user();
        $pemilik = User::findOrFail($kelas->dibuat_oleh);

        if ($user->koin < $kelas->harga) {
            return back()->with('error', 'Saldo koin tidak cukup untuk membeli kelas ini.');
        }

        $user->koin -= $kelas->harga_koin;
        $user->save();

        $pemilik->koin += $kelas->harga_koin;
        $pemilik->save();

        $pembelian = Pembelian::create([
            'user_id' => $user->id,
            'kelas_id' => $kelas->id,
        ]);

        DetailPembelian::create([
            'pembelian_id' => $pembelian->id,
            'kelas_id' => $kelas->id,
            'tanggal_pembelian' => now()->toDateString(),
            'rating'=>0
        ]);
        CoursePurchased::dispatch($user, $kelas);

        return redirect()->route('kelas.show', $kelas->id)->with('success', 'Kelas berhasil dibeli! 🎉');
    }

    public function showcreate()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'level' => 'required|string',
            'credit' => 'required|numeric|min:0',
        ]);

        $kelas = new Kelas();
        $kelas->judul_kelas = $request->title;
        $kelas->deskripsi = $request->description;
        $kelas->kategori = $request->category;
        $kelas->level_kelas = $request->level;
        $kelas->harga_koin = $request->credit;
        $kelas->dibuat_oleh = auth()->id();
        $kelas->is_draft = $request->action === 'draft';
        $kelas->tags = $request->tags ? json_decode($request->tags) : [];

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnail', 'cloudinary');
            $kelas->path_gambar = $path;
        }

        $kelas->save();

        return redirect()->route('kelas.show')->with('success', 'Kelas berhasil disimpan!');
    }

    public function showdetail()
    {
        return view('kelas.manajemen');
    }

    public function mulai($kelasId)
    {
        $kelas = Kelas::with('moduls.lessons')->findOrFail($kelasId);
        $modul = $kelas->moduls->first();
        if (!$modul || $modul->lessons->isEmpty()) {
            return redirect()->back()->with('error', 'Modul atau materi belum tersedia.');
        }
        $lesson = $modul->lessons->first();
        return redirect()->route('modul.show', [$modul->id, $lesson->id]);
    }
}

