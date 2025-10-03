<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    // Menampilkan semua komunitas
    public function index()
    {
        $chats = Chat::where('type','group')->with('users','messages.user')->get();
        return view('communities.index', compact('chats'));
    }

    // Membuat komunitas baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $chat = Chat::create([
            'type' => 'group',
            'name' => $request->name
        ]);

        // Tambahkan creator sebagai anggota
        $chat->users()->attach(Auth::id());

        return redirect()->back()->with('success','Komunitas berhasil dibuat!');
    }

    // Bergabung ke komunitas
    public function join(Chat $chat)
    {
        $chat->users()->syncWithoutDetaching(Auth::id());
        return redirect()->back()->with('success','Berhasil bergabung ke komunitas!');
    }

    // Keluar dari komunitas
    public function leave(Chat $chat)
    {
        $chat->users()->detach(Auth::id());
        return redirect()->back()->with('success','Berhasil keluar dari komunitas!');
    }

    // Mengirim pesan teks, gambar, PDF
    public function sendMessage(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $type = 'text';
        $filePath = null;

        if($request->hasFile('file')){
            $file = $request->file('file');
            $filePath = $file->store('chat_files','public');

            $ext = $file->extension();
            if(in_array($ext,['jpg','jpeg','png'])) $type = 'image';
            elseif($ext=='pdf') $type = 'pdf';
        }

        $chat->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'file' => $filePath,
            'type' => $type
        ]);

        return redirect()->back()->with('success','Pesan berhasil dikirim!');
    }
}
