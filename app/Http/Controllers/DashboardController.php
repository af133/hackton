<?php
namespace App\Http\Controllers;
use App\Models\CommunityUser;
use App\Models\detailPembelian;
use App\Models\LiveClas;
use App\Models\LiveCommunity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $komunitass = CommunityUser::where('user_id', auth()->user()->id)
                                    ->with('community')
                                    ->get();
        $ikutKelas = auth()->user()->detailPembelians()->with('kelas')->get();
        $kelas = auth()->user()->kelas()->get();
        $userId = auth()->user()->id;
        $liveClasses = LiveCommunity::whereIn('community_id', function ($query) {
        $query->select('community_id')
            ->from('community_user')
            ->where('user_id', auth()->id());})->get();

        $allLiveClasses = collect();
        foreach($kelas as $k){
            $liveClasses = LiveClas::where('kelas_id', $k->id)->get();
            $allLiveClasses = $allLiveClasses->merge($liveClasses);
        }
        $rating =DetailPembelian::whereHas('kelas', function($q) use ($userId) {
            $q->where('dibuat_oleh', $userId);
        })->avg('rating') ?? 0;


        return view('dashboard.index', compact('liveClasses','allLiveClasses','kelas','ikutKelas','komunitass','rating'));
    }

}
