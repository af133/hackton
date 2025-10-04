<?php

namespace App\Http\Controllers;

use App\Models\detailPembelian;
use App\Models\pembelian;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
   public function show()
    {
        $semuaKelas = Kelas::where('is_draft', false)->get();
        $kelasDiikuti = Kelas::whereHas('detailPembelians.pembelian', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();

        $kelasSaya = Kelas::where('dibuat_oleh', auth()->id())
            ->with('detailPembelians')
            ->get();

        return view('kelas.index', compact('semuaKelas', 'kelasDiikuti', 'kelasSaya'));
    }

    public function showkelas($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $pemilik = User::find($kelas->dibuat_oleh);
        $moduls = $kelas->moduls()->orderBy('id')->get();
        $lessons = $moduls->flatMap->lessons;
        $pembelian = detailPembelian::whereHas('pembelian', function ($q) {
            $q->where('user_id', auth()->id());
        })->where('kelas_id', $kelasId)->first();   
        $sudahBeli = false;
        if($pembelian || $kelas->dibuat_oleh == auth()->id())
        {
            $sudahBeli = true;
        }

        return view('kelas.detail', compact('kelas', 'lessons','moduls', 'pemilik', 'sudahBeli'));
    }
    public function toggleStatus($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->is_draft = !$kelas->is_draft; // Toggle status
        $kelas->save();

        return redirect()->back()->with('success', 'Status kelas berhasil diubah!');
    }
    public function beli($id)
{
    $kelas = Kelas::findOrFail($id);
    $user = Auth::user();
    $pemilik = User::findOrFail($kelas->dibuat_oleh);

    // cek saldo cukup?
    if ($user->koin < $kelas->harga) {
        return back()->with('error', 'Saldo koin tidak cukup untuk membeli kelas ini.');
    }

    // Kurangi koin user
    $user->koin -= $kelas->harga_koin;
    $user->save();

    // Tambahkan koin ke pemilik kelas
    $pemilik->koin += $kelas->harga_koin;
    $pemilik->save();

    // Buat pembelian
    $pembelian = Pembelian::create([
        'user_id' => $user->id,
        'kelas_id' => $kelas->id,
    ]);

    // Buat detail pembelian
    detailPembelian::create([
        'pembelian_id' => $pembelian->id, 
        'kelas_id' => $kelas->id,
        'tanggal_beli' => now(),
        'rating'=>0

        
    ]);

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
            $file = $request->file('thumbnail');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('kelas', $filename, 'public');
            $kelas->path_gambar = $filename;
        } else {
            $kelas->path_gambar = 'default-thumbnail.jpg'; 
        }

        $kelas->save();

        return redirect()->route('kelas.create')->with('success', 'Kelas berhasil disimpan!');
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

