<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;

class AchievementService
{
    /**
     * Periksa semua achievement yang mungkin dan berikan jika syarat terpenuhi.
     */
    public function checkAndAward(User $user)
    {
        $this->checkFastLearner($user);
        $this->checkKnowledgeSeeker($user);
        $this->checkSkillCollector($user);
        $this->checkMasterTeacher($user);
        $this->checkWelcomeAboard($user);
    }

    private function checkWelcomeAboard(User $user): void
    {
        if ($user->kelasDiikuti->count() === 1) {
            $this->grantBadge($user, 'welcome-aboard');
        }
    }

    /**
     * Memberikan lencana kepada pengguna jika belum dimiliki.
     */
    private function grantBadge(User $user, string $badgeKey): void
    {
        if ($user->badges()->where('key', $badgeKey)->exists()) {
            return;
        }

        $badge = Badge::where('key', $badgeKey)->first();

        if ($badge) {
            $user->badges()->attach($badge->id, ['unlocked_at' => now()]);
        }
    }

    /**
     * Cek: Menyelesaikan kursus pertama dalam 7 hari setelah mendaftar.
     */
    private function checkFastLearner(User $user): void
    {
        // Jika pengguna baru membeli 1 kelas & akun dibuat kurang dari 7 hari yang lalu
        if ($user->kelasDiikuti->count() === 1 && $user->created_at->diffInDays(now()) <= 7) {
            $this->grantBadge($user, 'fast-learner');
        }
    }

    /**
     * Cek: Mendaftar di 5 kursus yang berbeda.
     */
    private function checkKnowledgeSeeker(User $user): void
    {
        if ($user->kelasDiikuti->count() >= 5) {
            $this->grantBadge($user, 'knowledge-seeker');
        }
    }

    /**
     * Cek: Menyelesaikan kursus dari 3 kategori yang berbeda.
     */
    private function checkSkillCollector(User $user): void
    {
        $uniqueCategoriesCount = $user->kelasDiikuti->pluck('kategori')->unique()->count();
        if ($uniqueCategoriesCount >= 3) {
            $this->grantBadge($user, 'skill-collector');
        }
    }

    /**
     * Cek: Menerbitkan 5 kursus dengan rating rata-rata di atas 4.5.
     */
    private function checkMasterTeacher(User $user): void
    {
        $qualifiedCourses = $user->kelas()
            ->where('is_draft', false)
            ->where('rating', '>=', 4.5)
            ->count();

        if ($qualifiedCourses >= 5) {
            $this->grantBadge($user, 'master-teacher');
        }
    }
}
