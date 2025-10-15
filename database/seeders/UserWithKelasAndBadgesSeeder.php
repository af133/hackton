<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Badge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserWithKelasAndBadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::transaction(function () {
            $mentor = User::updateOrCreate(
                ['email' => 'aisyah.mentor@skillswap.com'],
                [
                    'name' => 'Aisyah Farah',
                    'password' => Hash::make('password'),
                    'status_id' => 1,
                    'description' => 'Seorang UI/UX Designer berpengalaman dengan passion untuk mengajar dan berbagi ilmu. Telah bekerja di industri selama lebih dari 5 tahun.',
                    'no_hp' => '081234567890',
                    'instagram_url' => 'https://instagram.com/aisyah',
                    'linkedin_url' => 'https://linkedin.com/in/aisyah',
                ]
            );

            $kelasData = [
                [
                    'judul_kelas' => 'Pengenalan UI/UX Design untuk Pemula',
                    'deskripsi' => 'Pelajari dasar-dasar User Interface dan User Experience design dari nol. Cocok untuk Anda yang baru memulai karir di dunia digital.',
                    'kategori' => 'UI/UX Design',
                    'path_gambar' => 'images/kelas/ui-ux-beginner.png',
                    'level_kelas' => 'Beginner',
                    'harga_koin' => 50,
                    'tags' => ['UI', 'UX', 'Design', 'Pemula'],
                    'is_draft' => false,
                    'rating' => 4.8,
                ],
                [
                    'judul_kelas' => 'Mastering Figma: Dari Dasar hingga Prototyping',
                    'deskripsi' => 'Kuasai Figma, tool desain terpopuler saat ini. Kita akan belajar membuat wireframe, high-fidelity design, hingga interactive prototype.',
                    'kategori' => 'UI/UX Design',
                    'path_gambar' => 'images/kelas/figma-mastery.png',
                    'level_kelas' => 'Intermediate',
                    'harga_koin' => 75,
                    'tags' => ['Figma', 'Prototyping', 'Design System'],
                    'is_draft' => false,
                    'rating' => 4.9,
                ],
            ];

            foreach ($kelasData as $data) {
                $mentor->kelas()->create($data);
            }

            $badges = Badge::whereIn('key', ['fast-learner', 'top-mentor', 'master-teacher'])->get()->keyBy('key');

            if ($badges->isNotEmpty()) {
                if (isset($badges['fast-learner'])) {
                    $mentor->badges()->attach($badges['fast-learner']->id, [
                        'unlocked_at' => Carbon::now(),
                        'progress' => 100
                    ]);
                }

                if (isset($badges['top-mentor'])) {
                    $mentor->badges()->attach($badges['top-mentor']->id, [
                        'progress' => 60
                    ]);
                }

                if (isset($badges['master-teacher'])) {
                    $mentor->badges()->attach($badges['master-teacher']->id, [
                        'progress' => 40 
                    ]);
                }
            }

            $this->command->info('Seeder untuk User Mentor, Kelas, dan Badge berhasil dijalankan!');
        });
    }
}
