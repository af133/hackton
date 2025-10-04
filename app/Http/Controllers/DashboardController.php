<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        // $komunitas= auth()->user()->communities()->with('messages.user','users')->get();
        $ikutKelas = auth()->user()->detailPembelians()->with('kelas')->get();
        $kelas = auth()->user()->load('kelas');
        return view('dashboard.index', compact('kelas','ikutKelas','komunitas'));
    }

}
