<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\LiveClas;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LiveClassController extends Controller
{
        public function show(Request $request, $room,$kelasId)
    {
        $user = Auth::user();
        $kelas= Kelas::where('dibuat_oleh',$user->id)? true : null;
        
        if($kelas==true){
            $isHost = 'guru';
        }
        else{
            $isHost = 'peserta';

        }
        

        return view('kelas.live', compact('room', 'isHost'));
    }

}
