<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('skills', 'experiences', 'badges');

        $limit = 3;

        $kelasDimiliki = $user->kelas()
            ->latest()
            ->take($limit)
            ->get();

        $kelasDiikuti = $user->kelasDiikuti
            ->sortByDesc('created_at')
            ->take($limit);
        return view('profile.index', compact('user', 'kelasDimiliki', 'kelasDiikuti'));
    }

    public function edit()
    {
        $user = Auth::user()->load('skills', 'experiences');
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15',
            'description' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048',
            'cv_path' => 'nullable|url',
            'portfolio_path' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
        ]);

        $user->fill($request->only([
            'name',
            'email',
            'no_hp',
            'description',
            'instagram_url',
            'linkedin_url',
            'cv_path',
            'portfolio_path'
        ]));

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('cloudinary')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('profile_photo')->store('profile_photos', 'cloudinary');
        }

        $user->save();

        $user->skills()->delete();
        if ($request->has('skills')) {
            foreach ($request->skills as $skill) {
                if (!empty($skill['name']) && !empty($skill['level'])) {
                    $user->skills()->create($skill);
                }
            }
        }

        $user->experiences()->delete();
        if ($request->has('experiences')) {
            foreach ($request->experiences as $experience) {
                if (!empty($experience['title'])) {
                    $user->experiences()->create([
                        'title' => $experience['title'],
                        'company' => $experience['company'] ?? null,
                        'start_date' => $experience['start_date'] ?? null,
                        'end_date' => $experience['end_date'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    public function mission()
    {
        $user = Auth::user()->load('badges');

        $allBadges = Badge::all();

        $unlockedBadges = $user->badges()->whereNotNull('unlocked_at')->get();
        $inProgressBadges = $user->badges()->whereNull('unlocked_at')->where('progress', '>', 0)->get();

        $userBadgeIds = $user->badges->pluck('id');

        $lockedBadges = $allBadges->whereNotIn('id', $userBadgeIds);

        return view('profile.mission', compact('user', 'unlockedBadges', 'inProgressBadges', 'lockedBadges'));
    }
}
