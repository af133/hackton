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
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'name' => 'required|string|max:255|unique:communities',
            'description' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Maksimal 5MB
        ]);

        $avatarPath = null;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('community_avatars', 'cloudinary');
        }

        $community = Community::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'avatar' => $avatarPath,
        ]);

        $community->users()->attach(Auth::id());

        return redirect()->route('', $community->id)->with('success', 'Komunitas berhasil dibuat!');
    }


    public function show($id)
    {
        $post = CommunityPost::with('user')->findOrFail($id);

        return view('sosial.post', compact('post'));
    }

    public function join($id)
    {
        $community = Community::findOrFail($id);
        $community->users()->syncWithoutDetaching(Auth::id());

        return back()->with('success', 'Kamu telah bergabung ke komunitas ini!');
    }

    public function leave($id)
    {
        $community = Community::findOrFail($id);
        $community->users()->detach(Auth::id());

        return back()->with('success', 'Kamu telah keluar dari komunitas.');
    }

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

    public function showSinglePost($id)
    {
        $post = CommunityPost::with(['user', 'replies.user'])->findOrFail($id);
        return view('sosial.post', compact('post'));
    }

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
