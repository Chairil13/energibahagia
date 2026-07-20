<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Berita;
use App\Models\Donasi;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\HeroSection;
use App\Models\KategoriProgram;
use App\Models\Kontak;
use App\Models\ProfileHero;
use App\Models\ProgramDonasi;
use App\Models\SejarahLembaga;
use App\Models\User;
use App\Models\VisiMisi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyFeatureDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@donasiku.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        $donaturs = collect([
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 45, RT 05/RW 03',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12190',
                'identity_number' => '3172010101900001',
                'birth_date' => '1990-01-15',
                'gender' => 'L',
                'occupation' => 'Software Engineer',
                'emergency_contact' => '081234567891',
                'emergency_name' => 'Siti Nurhaliza',
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@example.com',
                'phone' => '081298765432',
                'address' => 'Jl. Gatot Subroto No. 12, RT 02/RW 01',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40285',
                'identity_number' => '3273010202900002',
                'birth_date' => '1985-05-20',
                'gender' => 'P',
                'occupation' => 'Guru',
                'emergency_contact' => '081298765433',
                'emergency_name' => 'Ahmad Hidayat',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@example.com',
                'phone' => '085678901234',
                'address' => 'Jl. Diponegoro No. 78, RT 08/RW 04',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60231',
                'identity_number' => '3578010303950003',
                'birth_date' => '1995-03-25',
                'gender' => 'L',
                'occupation' => 'Dokter',
                'emergency_contact' => '085678901235',
                'emergency_name' => 'Dewi Lestari',
            ],
        ])->mapWithKeys(function (array $donatur): array {
            $user = User::updateOrCreate(
                ['email' => $donatur['email']],
                array_merge($donatur, [
                    'password' => Hash::make('password123'),
                    'role' => 'donatur',
                    'is_active' => true,
                ])
            );

            return [$donatur['email'] => $user];
        });

        HeroSection::updateOrCreate(
            ['id' => 1],
            [
                'badge_text' => 'Platform Donasi Terpercaya',
                'title_first' => 'Bersama Wujudkan',
                'title_highlight' => 'Energi Bahagia',
                'title_last' => 'untuk Semua',
                'description' => 'Mari berbagi kebaikan dan menciptakan kebahagiaan melalui program donasi yang transparan, mudah, dan berdampak.',
                'button_primary_text' => 'Mulai Donasi',
                'button_primary_link' => '/program',
                'button_secondary_text' => 'Pelajari',
                'button_secondary_link' => '/profile',
                'hero_image' => '1781691218_6a327352bd632.png',
                'is_active' => true,
            ]
        );

        ProfileHero::updateOrCreate(
            ['id' => 1],
            [
                'badge_text' => 'Tentang Kami',
                'title_first' => 'Tentang',
                'title_highlight' => 'Energi Bahagia',
                'description' => 'Lembaga sosial yang menghubungkan para donatur dengan program kebaikan di bidang pendidikan, kesehatan, kemanusiaan, dan pemberdayaan.',
                'button_primary_text' => 'Jelajahi Profil',
                'button_primary_link' => '#sejarah',
                'button_secondary_text' => 'Hubungi Kami',
                'button_secondary_link' => '/kontak',
                'hero_image' => '1781691270_6a32738618b2c.png',
                'is_active' => true,
            ]
        );

        SejarahLembaga::updateOrCreate(
            ['id' => 1],
            [
                'badge_text' => 'PERJALANAN KAMI',
                'title' => 'Sejarah Lembaga',
                'content' => 'Energi Bahagia lahir dari gerakan kecil para relawan yang rutin membantu keluarga prasejahtera. Gerakan ini kemudian berkembang menjadi lembaga sosial yang mengelola donasi secara lebih terstruktur, transparan, dan berorientasi pada dampak jangka panjang.',
                'institution_name' => 'Yayasan Energi Bahagia Indonesia',
                'is_active' => true,
            ]
        );

        VisiMisi::updateOrCreate(
            ['id' => 1],
            [
                'badge_text' => 'ARAH & TUJUAN',
                'title' => 'Visi & Misi',
                'visi' => 'Menjadi lembaga sosial terpercaya yang menggerakkan energi kebaikan masyarakat untuk program pemberdayaan berkelanjutan.',
                'misi' => [
                    'Mengelola donasi masyarakat secara transparan dan akuntabel.',
                    'Membantu akses pendidikan, kesehatan, dan kebutuhan dasar keluarga rentan.',
                    'Membangun kolaborasi dengan komunitas, sekolah, dan relawan lokal.',
                    'Menghadirkan laporan program yang mudah dipahami oleh donatur.',
                ],
                'is_active' => true,
            ]
        );

        Kontak::updateOrCreate(
            ['id' => 1],
            [
                'hero_badge' => 'HUBUNGI KAMI',
                'hero_title_first' => 'Mari',
                'hero_title_highlight' => 'Terhubung Dengan Kami',
                'hero_description' => 'Hubungi tim Energi Bahagia untuk pertanyaan donasi, kolaborasi program, atau informasi relawan.',
                'office_address' => 'Jl. Kebaikan Raya No. 12, Jakarta Selatan, DKI Jakarta',
                'office_map_link' => 'https://maps.google.com/?q=Jakarta+Selatan',
                'phone_kantor' => '021-555-0101',
                'phone_hotline' => '0812-3456-7890',
                'phone_darurat' => '0812-9876-5432',
                'email_umum' => 'info@energibahagia.id',
                'email_donasi' => 'donasi@energibahagia.id',
                'email_humas' => 'humas@energibahagia.id',
                'social_facebook' => 'https://facebook.com/energibahagia',
                'social_instagram' => 'https://instagram.com/energibahagia',
                'social_twitter' => 'https://twitter.com/energibahagia',
                'social_youtube' => 'https://youtube.com/@energibahagia',
                'social_linkedin' => 'https://linkedin.com/company/energibahagia',
                'whatsapp_number' => '6281234567890',
                'is_active' => true,
            ]
        );

        $categories = collect([
            ['nama_kategori' => 'Pendidikan', 'icon' => 'fa-graduation-cap', 'warna' => '#8AD337', 'urutan' => 1, 'deskripsi' => 'Program bantuan pendidikan, beasiswa, dan perlengkapan sekolah.'],
            ['nama_kategori' => 'Kesehatan', 'icon' => 'fa-heartbeat', 'warna' => '#FF6B6B', 'urutan' => 2, 'deskripsi' => 'Program layanan kesehatan dan bantuan pengobatan.'],
            ['nama_kategori' => 'Sosial', 'icon' => 'fa-hand-holding-heart', 'warna' => '#4ECDC4', 'urutan' => 3, 'deskripsi' => 'Program bantuan sosial untuk keluarga rentan.'],
            ['nama_kategori' => 'Lingkungan', 'icon' => 'fa-tree', 'warna' => '#45B7D1', 'urutan' => 4, 'deskripsi' => 'Program penghijauan dan kebersihan lingkungan.'],
            ['nama_kategori' => 'Ekonomi', 'icon' => 'fa-chart-line', 'warna' => '#F7B731', 'urutan' => 5, 'deskripsi' => 'Program pemberdayaan ekonomi dan UMKM.'],
            ['nama_kategori' => 'Kemanusiaan', 'icon' => 'fa-people-carry', 'warna' => '#E74C3C', 'urutan' => 6, 'deskripsi' => 'Program bantuan bencana dan tanggap darurat.'],
        ])->mapWithKeys(function (array $category): array {
            $model = KategoriProgram::updateOrCreate(
                ['nama_kategori' => $category['nama_kategori']],
                array_merge($category, ['is_active' => true])
            );

            return [$category['nama_kategori'] => $model];
        });

        $programImages = [
            '1776214929_69dee391d09b5.jpg',
            '1781691461_6a32744558a53.png',
            '1781694888_6a3281a835ac8.png',
            '1781695065_6a32825908193.png',
            '1781695242_6a32830ad8f48.png',
            '1781695381_6a3283954243e.png',
        ];

        $programs = collect([
            ['judul' => 'Beasiswa Pelajar Cerdas', 'kategori' => 'Pendidikan', 'deskripsi_singkat' => 'Beasiswa dan perlengkapan sekolah untuk pelajar berprestasi dari keluarga kurang mampu.', 'deskripsi_lengkap' => 'Program ini membantu pelajar agar tetap dapat belajar dengan tenang melalui bantuan biaya sekolah, buku, seragam, dan pendampingan belajar.', 'target_dana' => 300000000, 'dana_terkumpul' => 87500000, 'penerima' => 120, 'jumlah_donatur' => 42, 'tanggal_mulai' => '2026-01-10', 'tanggal_berakhir' => '2026-12-31', 'is_featured' => true],
            ['judul' => 'Layanan Kesehatan Gratis', 'kategori' => 'Kesehatan', 'deskripsi_singkat' => 'Pemeriksaan kesehatan, konsultasi dokter, dan obat gratis untuk warga prasejahtera.', 'deskripsi_lengkap' => 'Donasi digunakan untuk mendukung layanan kesehatan keliling, pembelian obat dasar, dan edukasi pola hidup sehat.', 'target_dana' => 220000000, 'dana_terkumpul' => 54500000, 'penerima' => 800, 'jumlah_donatur' => 31, 'tanggal_mulai' => '2026-02-01', 'tanggal_berakhir' => '2026-11-30', 'is_featured' => true],
            ['judul' => 'Paket Sembako Keluarga Rentan', 'kategori' => 'Sosial', 'deskripsi_singkat' => 'Paket kebutuhan pokok untuk keluarga rentan, lansia, dan pekerja harian.', 'deskripsi_lengkap' => 'Setiap paket berisi beras, minyak, telur, gula, dan kebutuhan rumah tangga dasar untuk membantu kebutuhan satu keluarga.', 'target_dana' => 180000000, 'dana_terkumpul' => 39250000, 'penerima' => 500, 'jumlah_donatur' => 27, 'tanggal_mulai' => '2026-03-05', 'tanggal_berakhir' => '2026-10-31', 'is_featured' => false],
            ['judul' => 'Bantuan Korban Banjir', 'kategori' => 'Kemanusiaan', 'deskripsi_singkat' => 'Bantuan darurat berupa makanan, air bersih, selimut, dan perlengkapan kebersihan.', 'deskripsi_lengkap' => 'Program tanggap darurat ini disalurkan kepada keluarga terdampak banjir melalui posko relawan dan mitra komunitas setempat.', 'target_dana' => 500000000, 'dana_terkumpul' => 156750000, 'penerima' => 1500, 'jumlah_donatur' => 88, 'tanggal_mulai' => '2026-04-01', 'tanggal_berakhir' => '2026-09-30', 'is_featured' => true],
            ['judul' => 'Modal Usaha Ibu Tangguh', 'kategori' => 'Ekonomi', 'deskripsi_singkat' => 'Bantuan modal dan pelatihan sederhana untuk pelaku UMKM perempuan.', 'deskripsi_lengkap' => 'Penerima manfaat mendapatkan pelatihan pencatatan keuangan, pemasaran sederhana, dan modal awal untuk mengembangkan usaha.', 'target_dana' => 250000000, 'dana_terkumpul' => 61000000, 'penerima' => 75, 'jumlah_donatur' => 36, 'tanggal_mulai' => '2026-05-01', 'tanggal_berakhir' => '2026-12-15', 'is_featured' => false],
            ['judul' => 'Gerakan Tanam 10.000 Pohon', 'kategori' => 'Lingkungan', 'deskripsi_singkat' => 'Penanaman pohon produktif dan edukasi lingkungan bersama komunitas lokal.', 'deskripsi_lengkap' => 'Program ini berfokus pada penanaman pohon di lahan kritis, perawatan bibit, serta edukasi lingkungan untuk sekolah dan warga.', 'target_dana' => 150000000, 'dana_terkumpul' => 28500000, 'penerima' => 0, 'jumlah_donatur' => 19, 'tanggal_mulai' => '2026-06-01', 'tanggal_berakhir' => '2026-12-31', 'is_featured' => false],
        ])->values()->mapWithKeys(function (array $program, int $index) use ($categories, $programImages): array {
            $model = ProgramDonasi::updateOrCreate(
                ['judul' => $program['judul']],
                [
                    'deskripsi_singkat' => $program['deskripsi_singkat'],
                    'deskripsi_lengkap' => $program['deskripsi_lengkap'],
                    'gambar' => $programImages[$index] ?? null,
                    'id_kategori' => $categories[$program['kategori']]->id,
                    'target_dana' => $program['target_dana'],
                    'dana_terkumpul' => $program['dana_terkumpul'],
                    'penerima' => $program['penerima'],
                    'jumlah_donatur' => $program['jumlah_donatur'],
                    'tanggal_mulai' => $program['tanggal_mulai'],
                    'tanggal_berakhir' => $program['tanggal_berakhir'],
                    'penulis' => 'Admin',
                    'status' => 'Aktif',
                    'is_featured' => $program['is_featured'],
                ]
            );

            return [$program['judul'] => $model];
        });

        $beritaImages = ['1776211184_69ded4f0c63a9.jpg', '1781693246_6a327b3ea6348.jpeg', '1782475433_6a3e6aa9a3d11.png'];

        foreach ([
            ['judul' => 'Penyaluran Bantuan Pendidikan untuk 100 Pelajar', 'deskripsi_singkat' => 'Energi Bahagia menyalurkan bantuan pendidikan berupa paket sekolah dan beasiswa awal semester.', 'konten' => 'Program bantuan pendidikan telah disalurkan kepada pelajar dari keluarga prasejahtera. Bantuan meliputi tas, buku, seragam, dan dukungan biaya sekolah.', 'kategori' => 'Pendidikan', 'views' => 128, 'is_featured' => true],
            ['judul' => 'Relawan Kesehatan Gelar Pemeriksaan Gratis', 'deskripsi_singkat' => 'Tim relawan membuka pos layanan kesehatan gratis bagi warga di wilayah padat penduduk.', 'konten' => 'Kegiatan pemeriksaan kesehatan gratis mencakup cek tekanan darah, konsultasi dokter umum, dan edukasi kesehatan keluarga.', 'kategori' => 'Kesehatan', 'views' => 96, 'is_featured' => false],
            ['judul' => 'Kolaborasi Komunitas untuk Paket Sembako', 'deskripsi_singkat' => 'Komunitas lokal ikut membantu pendataan dan distribusi paket sembako agar tepat sasaran.', 'konten' => 'Kolaborasi bersama komunitas membuat distribusi paket sembako lebih cepat, tertib, dan menjangkau keluarga yang benar-benar membutuhkan.', 'kategori' => 'Sosial', 'views' => 74, 'is_featured' => false],
        ] as $index => $berita) {
            Berita::updateOrCreate(
                ['judul' => $berita['judul']],
                [
                    'deskripsi_singkat' => $berita['deskripsi_singkat'],
                    'konten' => $berita['konten'],
                    'gambar' => $beritaImages[$index] ?? null,
                    'penulis' => 'Admin',
                    'tanggal_publish' => now()->subDays($index + 1),
                    'kategori' => $berita['kategori'],
                    'views' => $berita['views'],
                    'status' => 'publish',
                    'is_featured' => $berita['is_featured'],
                ]
            );
        }

        $gallery = Gallery::firstOrNew(['judul' => 'Dokumentasi Program Energi Bahagia']);
        $gallery->fill([
            'deskripsi' => 'Kumpulan dokumentasi kegiatan penyaluran bantuan, edukasi, dan kolaborasi relawan.',
            'gambar_utama' => '1782477040_cover.jpeg',
            'status' => 'active',
            'urutan' => 1,
        ]);
        $gallery->save();

        foreach ([
            ['foto' => '1782476954_0.jpeg', 'keterangan' => 'Penyerahan bantuan pendidikan kepada pelajar.', 'urutan' => 1],
            ['foto' => '1782476966_0.jpeg', 'keterangan' => 'Kegiatan relawan saat distribusi paket sembako.', 'urutan' => 2],
            ['foto' => '1782477070_0.jpeg', 'keterangan' => 'Dokumentasi layanan kesehatan gratis.', 'urutan' => 3],
        ] as $photo) {
            GalleryPhoto::updateOrCreate(
                ['gallery_id' => $gallery->id, 'foto' => $photo['foto']],
                $photo
            );
        }

        $banks = collect([
            ['nama_bank' => 'Bank Negara Indonesia (BNI)', 'kode' => 'BNI', 'nomor_rekening' => '1234567890', 'atas_nama' => 'Yayasan Energi Bahagia', 'icon' => 'fa-university', 'warna' => '#183D57', 'urutan' => 1],
            ['nama_bank' => 'Bank Central Asia (BCA)', 'kode' => 'BCA', 'nomor_rekening' => '1234567891', 'atas_nama' => 'Yayasan Energi Bahagia', 'icon' => 'fa-university', 'warna' => '#0055A4', 'urutan' => 2],
            ['nama_bank' => 'Bank Mandiri', 'kode' => 'MANDIRI', 'nomor_rekening' => '1234567892', 'atas_nama' => 'Yayasan Energi Bahagia', 'icon' => 'fa-university', 'warna' => '#FF8C00', 'urutan' => 3],
            ['nama_bank' => 'Bank Syariah Indonesia (BSI)', 'kode' => 'BSI', 'nomor_rekening' => '1234567893', 'atas_nama' => 'Yayasan Energi Bahagia', 'icon' => 'fa-university', 'warna' => '#2E7D32', 'urutan' => 4],
        ])->mapWithKeys(function (array $bank): array {
            $model = Bank::updateOrCreate(
                ['kode' => $bank['kode']],
                array_merge($bank, ['is_active' => true])
            );

            return [$bank['kode'] => $model];
        });

        foreach ([
            ['kode_unik' => 'DON-DUMMY-PENDING-001', 'user' => 'budi@example.com', 'program' => 'Beasiswa Pelajar Cerdas', 'bank' => 'BNI', 'nominal' => 150000, 'status' => 'pending', 'admin_note' => null],
            ['kode_unik' => 'DON-DUMMY-PENDING-002', 'user' => 'siti@example.com', 'program' => 'Bantuan Korban Banjir', 'bank' => 'BCA', 'nominal' => 250000, 'status' => 'pending', 'admin_note' => null],
            ['kode_unik' => 'DON-DUMMY-CONFIRMED-001', 'user' => 'ahmad@example.com', 'program' => 'Layanan Kesehatan Gratis', 'bank' => 'MANDIRI', 'nominal' => 500000, 'status' => 'confirmed', 'admin_note' => 'Dummy: donasi sudah dikonfirmasi.'],
            ['kode_unik' => 'DON-DUMMY-CONFIRMED-002', 'user' => 'budi@example.com', 'program' => 'Paket Sembako Keluarga Rentan', 'bank' => 'BSI', 'nominal' => 100000, 'status' => 'confirmed', 'admin_note' => 'Dummy: bukti transfer valid.'],
            ['kode_unik' => 'DON-DUMMY-CANCELLED-001', 'user' => 'siti@example.com', 'program' => 'Modal Usaha Ibu Tangguh', 'bank' => 'BNI', 'nominal' => 75000, 'status' => 'cancelled', 'admin_note' => 'Dummy: nominal tidak sesuai instruksi transfer.'],
        ] as $index => $donasi) {
            $user = $donaturs[$donasi['user']];

            Donasi::updateOrCreate(
                ['kode_unik' => $donasi['kode_unik']],
                [
                    'user_id' => $user->id,
                    'program_id' => $programs[$donasi['program']]->id,
                    'bank_id' => $banks[$donasi['bank']]->id,
                    'nama' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'pesan' => 'Semoga program ini memberi manfaat luas.',
                    'nominal' => $donasi['nominal'],
                    'bukti_transfer' => $donasi['status'] === 'pending' ? null : '1776255652_DON-UPHTBZKN-1776255425.jpg',
                    'status' => $donasi['status'],
                    'expires_at' => now()->addDays(3),
                    'confirmed_at' => $donasi['status'] === 'confirmed' ? now()->subDays($index + 1) : null,
                    'admin_note' => $donasi['admin_note'],
                    'confirmed_by' => $donasi['status'] === 'confirmed' ? $admin->id : null,
                ]
            );
        }
    }
}
