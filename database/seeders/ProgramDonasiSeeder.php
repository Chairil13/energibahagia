<?php

namespace Database\Seeders;

use App\Models\ProgramDonasi;
use App\Models\KategoriProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramDonasiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID kategori
        $sosialId = KategoriProgram::where('nama_kategori', 'Sosial')->first()->id ?? 1;
        $pendidikanId = KategoriProgram::where('nama_kategori', 'Pendidikan')->first()->id ?? 2;
        $kesehatanId = KategoriProgram::where('nama_kategori', 'Kesehatan')->first()->id ?? 3;
        $ekonomiId = KategoriProgram::where('nama_kategori', 'Ekonomi')->first()->id ?? 4;
        $lingkunganId = KategoriProgram::where('nama_kategori', 'Lingkungan')->first()->id ?? 5;
        $kemanusiaanId = KategoriProgram::where('nama_kategori', 'Kemanusiaan')->first()->id ?? 6;

        $programs = [
            [
                'judul' => 'Bantuan Korban Banjir Jakarta',
                'deskripsi_singkat' => 'Bantuan darurat untuk korban banjir di wilayah Jakarta dan sekitarnya. Salurkan donasi Anda untuk meringankan beban saudara kita yang terdampak banjir.',
                'deskripsi_lengkap' => 'Banjir besar melanda wilayah Jakarta dan sekitarnya, ribuan warga terpaksa mengungsi dan kehilangan tempat tinggal. Donasi Anda akan digunakan untuk membeli sembako, pakaian layak pakai, selimut, perlengkapan kebersihan, dan obat-obatan. Mari kita bantu saudara kita yang sedang kesulitan.',
                'id_kategori' => $kemanusiaanId,
                'target_dana' => 500000000,
                'dana_terkumpul' => 150000000,
                'penerima' => 500,
                'jumlah_donatur' => 156,
                'tanggal_mulai' => '2026-01-01',
                'tanggal_berakhir' => '2026-06-30',
                'penulis' => 'Admin',
                'status' => 'Aktif',
                'is_featured' => true,
            ],
            [
                'judul' => 'Beasiswa Pelajar Cerdas',
                'deskripsi_singkat' => 'Beasiswa untuk pelajar berprestasi dari keluarga kurang mampu. Bantu mereka meraih mimpi dan masa depan yang lebih cerah.',
                'deskripsi_lengkap' => 'Masih banyak anak bangsa yang memiliki potensi besar namun terkendala biaya pendidikan. Program beasiswa ini akan membantu 100 pelajar berprestasi dari keluarga kurang mampu untuk melanjutkan pendidikan mereka ke jenjang yang lebih tinggi.',
                'id_kategori' => $pendidikanId,
                'target_dana' => 300000000,
                'dana_terkumpul' => 75000000,
                'penerima' => 100,
                'jumlah_donatur' => 89,
                'tanggal_mulai' => '2026-01-15',
                'tanggal_berakhir' => '2026-07-15',
                'penulis' => 'Admin',
                'status' => 'Aktif',
                'is_featured' => true,
            ],
            [
                'judul' => 'Layanan Kesehatan Gratis',
                'deskripsi_singkat' => 'Pelayanan kesehatan gratis untuk masyarakat kurang mampu. Donasi Anda membantu mereka mendapatkan akses kesehatan yang layak.',
                'deskripsi_lengkap' => 'Kesehatan adalah hak dasar setiap manusia. Program ini akan menyediakan layanan kesehatan gratis seperti pemeriksaan umum, konsultasi dokter, dan pembagian obat-obatan bagi masyarakat yang tidak mampu.',
                'id_kategori' => $kesehatanId,
                'target_dana' => 200000000,
                'dana_terkumpul' => 45000000,
                'penerima' => 1000,
                'jumlah_donatur' => 67,
                'tanggal_mulai' => '2026-02-01',
                'tanggal_berakhir' => '2026-08-31',
                'penulis' => 'Admin',
                'status' => 'Aktif',
                'is_featured' => false,
            ],
            [
                'judul' => 'Pemberdayaan UMKM Perempuan',
                'deskripsi_singkat' => 'Pelatihan dan modal usaha untuk perempuan pengusaha UMKM. Bantu mereka mandiri secara ekonomi.',
                'deskripsi_lengkap' => 'Program pemberdayaan ekonomi untuk perempuan ini akan memberikan pelatihan keterampilan, manajemen usaha, dan bantuan modal usaha bagi 100 perempuan pengusaha UMKM. Dengan program ini, mereka diharapkan dapat mandiri dan meningkatkan kesejahteraan keluarga.',
                'id_kategori' => $ekonomiId,
                'target_dana' => 250000000,
                'dana_terkumpul' => 50000000,
                'penerima' => 100,
                'jumlah_donatur' => 34,
                'tanggal_mulai' => '2026-03-01',
                'tanggal_berakhir' => '2026-09-30',
                'penulis' => 'Admin',
                'status' => 'Aktif',
                'is_featured' => false,
            ],
            [
                'judul' => 'Penanaman 10.000 Pohon',
                'deskripsi_singkat' => 'Gerakan reboisasi untuk melestarikan lingkungan. Setiap pohon yang ditanam adalah investasi untuk masa depan bumi.',
                'deskripsi_lengkap' => 'Program penghijauan ini bertujuan menanam 10.000 pohon di lahan kritis dan daerah aliran sungai. Selain mengurangi dampak perubahan iklim, program ini juga akan melibatkan masyarakat lokal untuk menjaga kelestarian lingkungan.',
                'id_kategori' => $lingkunganId,
                'target_dana' => 150000000,
                'dana_terkumpul' => 30000000,
                'penerima' => 0,
                'jumlah_donatur' => 45,
                'tanggal_mulai' => '2026-04-01',
                'tanggal_berakhir' => '2026-10-31',
                'penulis' => 'Admin',
                'status' => 'Aktif',
                'is_featured' => false,
            ],
            [
                'judul' => 'Program Anak Jalanan',
                'deskripsi_singkat' => 'Pembinaan dan pendidikan untuk anak jalanan. Berikan mereka kesempatan untuk meraih masa depan yang lebih baik.',
                'deskripsi_lengkap' => 'Program ini akan memberikan pembinaan, pendidikan non-formal, dan keterampilan hidup bagi anak-anak jalanan. Target kami adalah menjangkau 150 anak jalanan di wilayah Jakarta dan sekitarnya.',
                'id_kategori' => $sosialId,
                'target_dana' => 200000000,
                'dana_terkumpul' => 25000000,
                'penerima' => 150,
                'jumlah_donatur' => 23,
                'tanggal_mulai' => '2026-05-01',
                'tanggal_berakhir' => '2026-11-30',
                'penulis' => 'Admin',
                'status' => 'Aktif',
                'is_featured' => false,
            ],
            [
                'judul' => 'Bantuan Gempa Cianjur',
                'deskripsi_singkat' => 'Bantuan darurat untuk korban gempa bumi di Cianjur. Waktu cepat, bantuan sangat dibutuhkan.',
                'deskripsi_lengkap' => 'Gempa bumi yang melanda Cianjur menyebabkan kerusakan parah pada ribuan rumah dan fasilitas umum. Donasi Anda akan segera disalurkan dalam bentuk tenda darurat, makanan, air bersih, obat-obatan, dan perlengkapan sekolah untuk anak-anak.',
                'id_kategori' => $kemanusiaanId,
                'target_dana' => 600000000,
                'dana_terkumpul' => 400000000,
                'penerima' => 2000,
                'jumlah_donatur' => 342,
                'tanggal_mulai' => '2026-02-15',
                'tanggal_berakhir' => '2026-05-15',
                'penulis' => 'Admin',
                'status' => 'Aktif',
                'is_featured' => true,
            ],
            [
                'judul' => 'Sekolah Lapang Petani',
                'deskripsi_singkat' => 'Pelatihan pertanian berkelanjutan untuk petani lokal. Tingkatkan hasil panen dan kesejahteraan petani.',
                'deskripsi_lengkap' => 'Program pelatihan ini akan memberikan pengetahuan tentang pertanian organik, pengelolaan lahan, dan pasca panen kepada 200 petani di daerah pedesaan. Diharapkan program ini dapat meningkatkan hasil panen dan pendapatan petani.',
                'id_kategori' => $ekonomiId,
                'target_dana' => 100000000,
                'dana_terkumpul' => 20000000,
                'penerima' => 200,
                'jumlah_donatur' => 18,
                'tanggal_mulai' => '2026-06-01',
                'tanggal_berakhir' => '2026-12-31',
                'penulis' => 'Admin',
                'status' => 'Aktif',
                'is_featured' => false,
            ],
        ];

        foreach ($programs as $program) {
            ProgramDonasi::create($program);
        }
    }
}
