<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function store(Request $request, Lesson $lesson)
{
    $request->validate([
        'content' => 'required|string|max:2000',
    ]);

    $lesson->discussions()->create([
        'user_id' => auth()->id(),
        'content' => $request->input('content'),
    ]);

     return redirect()->back();
}

}
