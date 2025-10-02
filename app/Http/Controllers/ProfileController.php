<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.index');
    }
    public function edit()
    {
        return view('profile.edit');
    }
    public function mission()
    {
        return view('profile.mission');
    }
}
