<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
class CourseController extends Controller
{
    public function show()
    {
        $kelasSaya = auth()->user()->kelas()->with('detailPembelians')->get();

        
        return view('kelas.index', compact('kelasSaya'));
    }
    public function showkelas()
    {
        return view('kelas.detail');
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
}
