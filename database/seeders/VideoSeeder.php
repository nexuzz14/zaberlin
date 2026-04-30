<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            [
                'title'      => 'Belajar Laravel dari Nol untuk Pemula',
                'description'=> 'Tutorial lengkap Laravel 11 dari instalasi hingga deploy. Cocok untuk pemula yang ingin belajar framework PHP terbaik.',
                'category'   => 'edukasi',
                'type'       => 'youtube',
                'url'        => 'https://www.youtube.com/watch?v=MYyJ4PuL4pY',
                'thumbnail'  => null,
                'views'      => 15420,
                'owner_name' => 'Zaberlin Academy',
            ],
            [
                'title'      => 'Podcast: Membangun Startup dari Nol',
                'description'=> 'Cerita inspiratif founder startup Indonesia yang berhasil membangun bisnis dari nol. Tips dan trik memulai usaha digital.',
                'category'   => 'podcast',
                'type'       => 'youtube',
                'url'        => 'https://www.youtube.com/watch?v=9bZkp7q19f0',
                'thumbnail'  => null,
                'views'      => 8900,
                'owner_name' => 'Startup Stories ID',
            ],
            [
                'title'      => 'Tips Produktivitas untuk Developer',
                'description'=> 'Cara meningkatkan produktivitas sebagai developer: tools, workflow, dan kebiasaan yang efektif.',
                'category'   => 'edukasi',
                'type'       => 'youtube',
                'url'        => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail'  => null,
                'views'      => 5200,
                'owner_name' => 'Dev Talks ID',
            ],
            [
                'title'      => 'Podcast Teknologi: AI di Masa Depan',
                'description'=> 'Diskusi mendalam tentang perkembangan kecerdasan buatan dan dampaknya terhadap dunia kerja di Indonesia.',
                'category'   => 'podcast',
                'type'       => 'youtube',
                'url'        => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail'  => null,
                'views'      => 12300,
                'owner_name' => 'Tech Talks Indonesia',
            ],
            [
                'title'      => 'Mahir JavaScript dalam 30 Hari',
                'description'=> 'Panduan komprehensif belajar JavaScript modern dari dasar hingga tingkat lanjut.',
                'category'   => 'edukasi',
                'type'       => 'youtube',
                'url'        => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail'  => null,
                'views'      => 9870,
                'owner_name' => 'CodeMaster ID',
            ],
            [
                'title'      => 'Podcast: Karir di Bidang IT',
                'description'=> 'Pengalaman dan saran dari para profesional IT Indonesia tentang membangun karir di bidang teknologi.',
                'category'   => 'podcast',
                'type'       => 'youtube',
                'url'        => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail'  => null,
                'views'      => 4500,
                'owner_name' => 'IT Career ID',
            ],
            [
                'title'      => 'Belajar UI/UX Design Figma',
                'description'=> 'Tutorial desain UI/UX menggunakan Figma dari level pemula. Buat prototype aplikasi mobile profesional.',
                'category'   => 'edukasi',
                'type'       => 'youtube',
                'url'        => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail'  => null,
                'views'      => 7600,
                'owner_name' => 'Design Studio ID',
            ],
            [
                'title'      => 'Podcast Bisnis: Digital Marketing 2024',
                'description'=> 'Strategi digital marketing terbaru untuk mengembangkan bisnis online di era kompetitif.',
                'category'   => 'podcast',
                'type'       => 'youtube',
                'url'        => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail'  => null,
                'views'      => 6700,
                'owner_name' => 'Bisnis Digital ID',
            ],
        ];

        foreach ($videos as $data) {
            Video::create($data);
        }
    }
}
