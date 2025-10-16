<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            // Individual Badges
            [
                'key' => 'fast-learner',
                'name' => 'Fast Learner',
                'description' => 'Diberikan kepada pengguna yang menyelesaikan kursus pertama mereka dalam 7 hari.',
                'icon_path' => 'images/badge/FastLearner.png',
                'type' => 'individual',
            ],
            [
                'key' => 'active-learner',
                'name' => 'Active Learner',
                'description' => 'Didapatkan dengan berpartisipasi aktif dalam 10 diskusi materi.',
                'icon_path' => 'images/badge/ActiveLearner.png',
                'type' => 'individual',
            ],
            [
                'key' => 'knowledge-seeker',
                'name' => 'Knowledge Seeker',
                'description' => 'Diberikan setelah mendaftar di 5 kursus yang berbeda.',
                'icon_path' => 'images/badge/KnowledgeSeeker.png',
                'type' => 'individual',
            ],
            [
                'key' => 'skill-collector',
                'name' => 'Skill Collector',
                'description' => 'Dapatkan dengan menyelesaikan kursus dari 3 kategori yang berbeda.',
                'icon_path' => 'images/badge/SkillCollector.png',
                'type' => 'individual',
            ],

            // General Badges
            [
                'key' => 'top-mentor',
                'name' => 'Top Mentor',
                'description' => 'Menjadi 10% mentor teratas berdasarkan rating dan jumlah siswa.',
                'icon_path' => 'images/generalbadge/TopMentor.png',
                'type' => 'general',
            ],
            [
                'key' => 'master-teacher',
                'name' => 'Master Teacher',
                'description' => 'Menerbitkan 5 kursus dengan rating rata-rata di atas 4.5.',
                'icon_path' => 'images/generalbadge/MasterTeacher.png',
                'type' => 'general',
            ],
            [
                'key' => 'inspiring-mentor',
                'name' => 'Inspiring Mentor',
                'description' => 'Mendapatkan 50 ulasan positif dari para siswa.',
                'icon_path' => 'images/generalbadge/InspiringMentor.png',
                'type' => 'general',
            ],
            [
                'key' => 'generous-sharer',
                'name' => 'Generous Sharer',
                'description' => 'Dikenal karena sering membagikan sumber daya yang bermanfaat di komunitas.',
                'icon_path' => 'images/generalbadge/GenerousSharer.png',
                'type' => 'general',
            ],
            [
                'key' => 'welcome-aboard',
                'name' => 'Welcome Aboard',
                'description' => 'Diberikan kepada pengguna yang berhasil melakukan pembelian kelas pertama mereka.',
                'icon_path' => 'images/badge/WelcomeAboard.png',
                'type' => 'individual',
            ],
        ];

        // Looping untuk memasukkan data
        foreach ($badges as $badgeData) {
            Badge::updateOrCreate(
                ['key' => $badgeData['key']],
                $badgeData // Data yang akan di-insert atau di-update
            );
        }
    }
}
