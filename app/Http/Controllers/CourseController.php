<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show()
    {
        return view('kelas.index');
    }
    public function showkelas()
    {
        return view('kelas.detail');
    }
    public function showcreate()
    {
        return view('kelas.create');
    }
    public function showdetail()
    {
        return view('kelas.manajemen');
    }
}
