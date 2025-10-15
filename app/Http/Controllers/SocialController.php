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

class SocialController extends Controller
{
    // 🧭 Halaman utama komunitas (list semua)
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

    // ➕ Form buat komunitas
    public function create()
    {
        return view('sosial.create');
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
