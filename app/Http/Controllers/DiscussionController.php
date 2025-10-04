<?php
namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function store(Request $request, Lesson $lesson)
    {
        $request->validate(['content' => 'required|string|max:1000']);

        $lesson->discussions()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back(); // refresh halaman
    }
}
