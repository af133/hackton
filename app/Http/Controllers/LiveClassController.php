<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\LiveClas;
use App\Models\LiveCommunity;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LiveClassController extends Controller
{
        public function show(Request $request, $room,$kelasId,$jenisLive)
    {
        return view('kelas.live', compact('room','kelasId','jenisLive'));
    }
  public function index()
{
    $liveClasses = LiveClas::with('kelas')->get();
    return view('kelas.listLiveClasses', compact('liveClasses'));
}



}
