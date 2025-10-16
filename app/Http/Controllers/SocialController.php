<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\CommunityUser;
use App\Models\CommunityPost;
use App\Models\LiveCommunity;
use App\Models\CommunityPostReply;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // <-- 1. Tambahkan ini

class SocialController extends Controller
{
    public function index()
    {
        $communities = Community::latest()->get();
        $ikutKomunitas = CommunityUser::where('user_id', Auth::id())
                                ->with('community', 'user')
                                ->get();

        return view('sosial.index', compact('communities', 'ikutKomunitas'));
    }

    // 📄 Detail komunitas (lihat info + postingan)
    public function showdetail($id)
    {
        $liveCommunity = LiveCommunity::where('komunitas_id', $id)->get();
        $komunitas = Community::with(['users', 'CommunityUser'])->findOrFail($id);
        $isMember = $komunitas->users->contains(Auth::id());
        $posts = CommunityPost::where('community_id', $id)
                        ->with('user')
                        ->latest()
                        ->get();
        $member = CommunityUser::where('community_id', $id)
                        ->with('user')
                        ->latest()
                        ->get();
        $user= auth()->user();
        return view('sosial.detail', compact('komunitas', 'isMember', 'posts','member','user','liveCommunity'));
    }

    public function create()
    {
        return view('sosial.create');
    }


    public function store(Request $request)
    {
        // 2. Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255|unique:communities',
            'description' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Maksimal 5MB
        ]);

        $avatarPath = null;

        // 3. Logika upload ke Cloudinary jika ada file avatar
        if ($request->hasFile('avatar')) {
            // 'community_avatars' adalah nama folder di Cloudinary
            // 'cloudinary' adalah nama disk yang dikonfigurasi di filesystems.php
            $avatarPath = $request->file('avatar')->store('community_avatars', 'cloudinary');
        }

        // 4. Simpan data komunitas ke database
        $community = Community::create([
            'user_id' => Auth::id(), // Pembuat komunitas sebagai admin/owner
            'name' => $request->name,
            'description' => $request->description,
            'avatar' => $avatarPath, // Simpan path dari Cloudinary
        ]);

        // 5. Otomatis gabungkan pembuat komunitas ke dalam komunitasnya
        $community->users()->attach(Auth::id());

        // 6. Redirect ke halaman detail komunitas yang baru dibuat
        return redirect()->route('', $community->id)->with('success', 'Komunitas berhasil dibuat!');
    }


    // 📬 Form buat postingan baru (kalau kamu pakai halaman terpisah)
    public function show($id)
    {
        $post = CommunityPost::with('user')->findOrFail($id);

        return view('sosial.post', compact('post'));
    }

    // ✅ Join komunitas
    public function join($id)
    {
        $community = Community::findOrFail($id);
        $community->users()->syncWithoutDetaching(Auth::id());

        return back()->with('success', 'Kamu telah bergabung ke komunitas ini!');
    }

    // ❌ Keluar komunitas
    public function leave($id)
    {
        $community = Community::findOrFail($id);
        $community->users()->detach(Auth::id());

        return back()->with('success', 'Kamu telah keluar dari komunitas.');
    }

    // 📝 Kirim post baru di komunitas
    public function storePost(Request $request, $communityId)
    {
        $request->validate([
            'content' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $community = Community::findOrFail($communityId);

        if (! $community->users->contains(Auth::id())) {
            return back()->with('error', 'Kamu harus join dulu untuk membuat post.');
        }

        CommunityPost::create([
            'community_id' => $communityId,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'image_url' => $request->image_url,
        ]);

        return back()->with('success', 'Post berhasil dibuat!');
    }

    // 📄 Lihat satu postingan + reply-nya
    public function showSinglePost($id)
    {
        $post = CommunityPost::with(['user', 'replies.user'])->findOrFail($id);
        return view('sosial.post', compact('post'));
    }

    // 💬 Balas postingan (reply)
    public function reply(Request $request, $postId)
    {
        $request->validate(['message' => 'required|string']);

        CommunityPostReply::create([
            'post_id' => $postId,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back()->with('success', 'Balasan terkirim!');
    }
}
