<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        return view('sosial.index');
    }
    public function showdetail()
    {
        return view('sosial.detail');
    }
    public function showpost()
    {
        return view('sosial.post');
    }
}
