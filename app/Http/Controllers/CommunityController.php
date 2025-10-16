<?php

namespace App\Http\Controllers;

use App\Models\CommunityUser;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::all();
        $ikutKomunitas= CommunityUser::where('user_id',auth()->user()->id)->with('community','user')->get();
        return view('sosial.index', compact('communities','ikutKomunitas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:5120',
        ]);

        $avatarPath = null;
            if ($request->hasFile('avatar')) {
        try {
            $upload = $request->file('avatar')->storeOnCloudinary('avatar');
            $avatarPath = $upload->getSecurePath(); // URL langsung ke gambar di Cloudinary
        } catch (\Exception $e) {
            \Log::error('Gagal upload ke Cloudinary: ' . $e->getMessage());
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }
        }

        $community = Community::create([
            'name' => $request->name,
            'type' => 'Publik',
            'avatar' => $avatarPath,
            'creator_id' => Auth::id(),
            'description' => $request->description ?? null,
        ]);

        $community->users()->attach(Auth::id());
        return redirect()->route('sosial')
                        ->with('success', 'Komunitas berhasil dibuat!');
    }


        public function join(Request $request)
        {

            CommunityUser::create([
                'community_id' => $request->community_id,
                'user_id' => auth()->id(),
            ]);

            return back()->with('success', 'Berhasil bergabung ke komunitas!');
        }

    public function leave(Community $community)
    {
        $community->users()->detach(auth()->id());
        return back();
    }
}
