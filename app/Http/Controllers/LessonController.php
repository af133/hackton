<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        return view('kelas.modul.index');
    }
    public function showcreate()
    {
        return view('kelas.modul.create');
    }
}
