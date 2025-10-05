<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::all();
        $ikutKomunitas= auth()->user()->communities()->with('messages.user','users')->get();
        return view('sosial.index', compact('communities','ikutKomunitas'));
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'avatar' => 'nullable|image|max:5120', // max 5MB
    ]);

    // Upload avatar jika ada
    $avatarPath = $request->hasFile('avatar') 
        ? $request->file('avatar')->store('avatars', 'public') 
        : null;

    // Simpan komunitas
    $community = Community::create([
        'name' => $request->name,
        'type' => 'Publik', // atau bisa ditambah input select jika mau
        'avatar' => $avatarPath,
        'creator_id' => Auth::id(),
        'description' => $request->description ?? null,
    ]);

    // Auto-join creator
    $community->users()->attach(Auth::id());

    return redirect()->route('sosial')
                     ->with('success', 'Komunitas berhasil dibuat!');
}


    public function join(Community $community)
    {
        $community->users()->attach(auth()->id());
        return back();
    }

    public function leave(Community $community)
    {
        $community->users()->detach(auth()->id());
        return back();
    }
}
