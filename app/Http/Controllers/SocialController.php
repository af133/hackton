<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
class SocialController extends Controller
{
    public function index()
    {
        $communities = Community::all();
        $ikutKomunitas= auth()->user()->communities()->with('messages.user','users')->get();
        return view('sosial.index',compact('communities','ikutKomunitas'));
    }
    public function showdetail($id)
    {
        $komunitas = Community::with('messages.user','users')->findOrFail($id);
        return view('sosial.detail',compact('komunitas'));
    }
    public function create()
    {
        return view('sosial.create');
    }
    public function showpost()
    {
        return view('sosial.post');
    }
}
