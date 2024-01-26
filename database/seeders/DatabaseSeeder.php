<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $fatik = "Fakultas Tarbiyah dan Ilmu Keguruan";
        $febi = "Fakultas Ekonomi dan Bisnis Islam";
        $fasya = "Fakultas Syariah";
        $fuad = "Fakultas Ushuluddin Adab dan Dakwah";
        $pascasarjana = "Pascasarjana";

        DB::table('roles')->insert([
            ["role_nama" => "admin", "role_keterangan" => "atur tahun anggaran"],
            ["role_nama" => "user_organisasi", "role_keterangan" => "User yang akan buat RPD dan dokumen pencairan"],
            ["role_nama" => "spi", "role_keterangan" => "Akun SPI"],
            ["role_nama" => "keuangan", "role_keterangan" => "Akun Keuangan"],
            ["role_nama" => "pimpinan", "role_keterangan" => "Akun Pimpinan"],
            ["role_nama" => "ppk", "role_keterangan" => "Akun PPK"],
            ["role_nama" => "bendahara", "role_keterangan" => "Akun Bendahar"],
        ]);
        DB::table('kode_akuns')->insert([
            ["kode" => "524114", "nama_akun" => "Belanja Perjalanan Dinas Paket Meeting Dalam Kota", 'keterangan' => '', 'jenis_kuitansi' => 1, 'is_pajak' => 0],
            ["kode" => "521211", "nama_akun" => "Belanja Bahan", 'keterangan' => '', 'jenis_kuitansi' => 2, 'is_pajak' => 1],
            ["kode" => "521213", "nama_akun" => "Belanja Honor Output Kegiatan", 'keterangan' => '', 'jenis_kuitansi' => 1, 'is_pajak' => 1],
        ]);
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'username' => 'uci',
                'email' => 'uci@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'username' => 'hasnah',
                'email' => 'hasnah@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'username' => 'musdin',
                'email' => 'musdin@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'username' => 'sukadir',
                'email' => 'sukadir@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'username' => 'lily',
                'email' => 'lily@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'username' => 'lita',
                'email' => 'lita@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'username' => 'arif',
                'email' => 'arif@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'username' => 'rigo',
                'email' => 'rigo@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'username' => 'tommy',
                'email' => 'tommy@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
        ]);
        DB::table('user_roles')->insert([
            ["user_id" => 1, "role_id" => 1, "is_default" => true], //role administrator
            ["user_id" => 2, "role_id" => 7, "is_default" => true], //role bendahara
            ["user_id" => 3, "role_id" => 6, "is_default" => true], //role ppk
            ["user_id" => 4, "role_id" => 6, "is_default" => true], //role ppk
            ["user_id" => 5, "role_id" => 3, "is_default" => true], //role spi
            ["user_id" => 6, "role_id" => 3, "is_default" => true], //role spi
            ["user_id" => 7, "role_id" => 3, "is_default" => true], //role spi
            ["user_id" => 8, "role_id" => 3, "is_default" => true], //role spi
            ["user_id" => 9, "role_id" => 2, "is_default" => true], //role user_organisasi
            ["user_id" => 9, "role_id" => 1, "is_default" => false], //role user_organisasi
            ["user_id" => 10, "role_id" => 2, "is_default" => true], //role user_organisasi
        ]);
        DB::table('satkers')->insert([
            [
                "kode_satker" => "307665", "nama_satker" => "Institut Agama Islam Negeri Kendari",
                "alamat" => "Jalan Sultan Qaimuddin", "is_current" => true
            ],
        ]);
        DB::table('satker_npwps')->insert([
            [
                "satker_id" => 1, "npwp_nomor" => "123npwpnomor",
                "npwp_alamat" => "Jalan Sultan Qaimuddin"
            ],
        ]);
        DB::table('organisasi_grups')->insert([
            [
                "grup_nama" => "Institusi",
                "grup_singkatan" => "Institusi",
                'pimpinan_sebutan' => "Rektor",
                'grup_flag' => "rektor",
                'grup_keterangan' => "Grup Institusi"
            ], [
                "grup_nama" => "Fakultas",
                "grup_singkatan" => "Fakultas",
                'pimpinan_sebutan' => "Dekan",
                'grup_flag' => "dekan",
                'grup_keterangan' => "Grup Fakultas"
            ], [
                "grup_nama" => "Program Studi",
                "grup_singkatan" => "Prodi",
                'pimpinan_sebutan' => "Kepal Program Studi",
                'grup_flag' => "prodi",
                'grup_keterangan' => "Grup Prodi"
            ], [
                "grup_nama" => "Pascasarjana",
                "grup_singkatan" => "Pascasarjana",
                'pimpinan_sebutan' => "Direktur",
                'grup_flag' => "pasca",
                'grup_keterangan' => "Grup Pascasarjana"
            ], [
                "grup_nama" => "Lembaga",
                "grup_singkatan" => "Lembaga",
                'pimpinan_sebutan' => "ketua",
                'grup_flag' => "lembaga",
                'grup_keterangan' => "Grup Lembaga"
            ], [
                "grup_nama" => "Unit Pelaksana Teknis",
                "grup_singkatan" => "UPT",
                'pimpinan_sebutan' => "Kepala",
                'grup_flag' => "upt",
                'grup_keterangan' => "Grup Unit Pelaksana Teknis"
            ],
            [
                "grup_nama" => "Biro Administrasi Umum Akademik Kemahasiswaan",
                "grup_singkatan" => "Biro AUAK",
                'pimpinan_sebutan' => "Kepala Biro",
                'grup_flag' => "karo",
                'grup_keterangan' => "-"
            ],
            [
                "grup_nama" => "Organisasi Kemahasiswaan",
                "grup_singkatan" => "UK Lembaga",
                'pimpinan_sebutan' => "Ketua",
                'grup_flag' => "uklembaga",
                'grup_keterangan' => "-"
            ],

        ]);
        DB::table('organisasis')->insert([
            [
                "organisasi_nama" => "Rektorat",
                "organisasi_singkatan" => "Rektorat",
                "organisasi_grup_id" => 1,
                'organisasi_parent_id' => null,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => $fatik,
                "organisasi_singkatan" => "FATIK",
                "organisasi_grup_id" => 2,
                'organisasi_parent_id' => null,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => $fasya,
                "organisasi_singkatan" => "FASYA",
                "organisasi_grup_id" => 2,
                'organisasi_parent_id' => null,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => $fuad,
                "organisasi_singkatan" => "FUAD",
                "organisasi_grup_id" => 2,
                'organisasi_parent_id' => null,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => $pascasarjana,
                "organisasi_singkatan" => "PASCASARJANA",
                "organisasi_grup_id" => 4,
                'organisasi_parent_id' => null,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => $febi,
                "organisasi_singkatan" => "FEBI",
                "organisasi_grup_id" => 2,
                'organisasi_parent_id' => null,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Pendidikan Agama Islam",
                "organisasi_singkatan" => "PAI",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Pendidikan Bahasa Arab",
                "organisasi_singkatan" => "PBA",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Manajemen Pendidikan Islam",
                "organisasi_singkatan" => "MPI",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Pendidikan Guru Madrasah Ibtidaiyah",
                "organisasi_singkatan" => "PGMI",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Pendidikan Islam Anak Usia Dini",
                "organisasi_singkatan" => "PIAUD",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Tadris Bahasa Inggris",
                "organisasi_singkatan" => "TBI",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Tadris IPA",
                "organisasi_singkatan" => "TIPA",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Tadris Biologi",
                "organisasi_singkatan" => "TBLG",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Tadris Fisika",
                "organisasi_singkatan" => "TFSK",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Tadris Matematika",
                "organisasi_singkatan" => "TMTK",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 2,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Hukum Keluarga Islam (Ahwal Syakhshiyyah)",
                "organisasi_singkatan" => "AS",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 3,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Hukum Ekonomi Syariah (Mua'malah)",
                "organisasi_singkatan" => "MU",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 3,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Hukum Tatanegara (Siyasah Syar'iyyah)",
                "organisasi_singkatan" => "HTN",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 3,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Komunikasi dan Penyiaran Islam",
                "organisasi_singkatan" => "KPI",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 4,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Bimbingan Penyuluhan Islam",
                "organisasi_singkatan" => "BPI",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 4,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Manajemen Dakwah",
                "organisasi_singkatan" => "MD",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 4,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Ilmu Al-Qur'an dan Tafsir",
                "organisasi_singkatan" => "IQT",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 4,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Manajemen Pendidikan Islam",
                "organisasi_singkatan" => "MPI S2",
                "organisasi_grup_id" => 3,
                "organisasi_keterangan" => "",
                'organisasi_parent_id' => 5,
            ],
            [
                "organisasi_nama" => "Pendidikan Agama Islam",
                "organisasi_singkatan" => "PAI S2",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 5,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Hukum Keluarga Islam (Ahwal Syakhshiyyah)",
                "organisasi_singkatan" => "HKI S2",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 5,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Ekonomi Syariah",
                "organisasi_singkatan" => "ESY S2",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 5,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Ekonomi Syariah",
                "organisasi_singkatan" => "ESY",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 6,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Perbankan Syariah",
                "organisasi_singkatan" => "PBS",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 6,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Manajemen Bisnis Syariah",
                "organisasi_singkatan" => "MBS",
                "organisasi_grup_id" => 3,
                'organisasi_parent_id' => 6,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Lembaga Penelitian dan Pengabdian Kepada Masyarakat",
                "organisasi_singkatan" => "LPPM",
                "organisasi_grup_id" => 5,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Lembaga Penjamin Mutu",
                "organisasi_singkatan" => "LPM",
                "organisasi_grup_id" => 5,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Teknologi Informasi dan Pangkalan Data",
                "organisasi_singkatan" => "UPT TIPD",
                "organisasi_grup_id" => 6,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Perpustakaan",
                "organisasi_singkatan" => "UPT Perpustakaaan",
                "organisasi_grup_id" => 6,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Pengembangan Bahasa",
                "organisasi_singkatan" => "UPT Bahasa",
                "organisasi_grup_id" => 6,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Ma'had Al Jamiah",
                "organisasi_singkatan" => "UPT Ma'had",
                "organisasi_grup_id" => 6,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Satuan Pengawas Internal",
                "organisasi_singkatan" => "SPI",
                "organisasi_grup_id" => 1,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Bagian Perencanaan dan Keuangan",
                "organisasi_singkatan" => "Keuangan",
                "organisasi_grup_id" => 7,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Bagian Umum",
                "organisasi_singkatan" => "Umum",
                "organisasi_grup_id" => 7,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Bagian Akademik dan Kemahasiswaan",
                "organisasi_singkatan" => "AKMA",
                "organisasi_grup_id" => 7,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],
            [
                "organisasi_nama" => "Kelompok Jabatan Fungsional",
                "organisasi_singkatan" => "Jafung",
                "organisasi_grup_id" => 7,
                'organisasi_parent_id' => 1,
                "organisasi_keterangan" => "",
            ],

        ]);
        DB::table('organisasi_jabatans')->insert([
            [
                'jabatan_nama' => "Rektor",
                "jabatan_singkatan" => "Rektor",
                "jabatan_keterangan" => "Pimpinan Universitas",
                "jabatan_untuk" => "pegawai",
                "jabatan_flag" => "rektor",
            ],
            [
                'jabatan_nama' => "Wakil Rektor 1",
                "jabatan_singkatan" => "Warek 1",
                "jabatan_keterangan" => "Wakil Rektor Urusan ....",
                "jabatan_untuk" => "pegawai",
                "jabatan_flag" => "warek1",
            ],
            [
                'jabatan_nama' => "Wakil Rektor 2",
                "jabatan_singkatan" => "Warek 2",
                "jabatan_keterangan" => "Wakil Rektor Urusan ....",
                "jabatan_untuk" => "pegawai",
                "jabatan_flag" => "warek2",
            ],
            [
                'jabatan_nama' => "Wakil Rektor 3",
                "jabatan_singkatan" => "Warek 3",
                "jabatan_keterangan" => "Wakil Rektor Urusan ....",
                "jabatan_untuk" => "pegawai",
                "jabatan_flag" => "warek3",
            ],
            [
                'jabatan_nama' => "Kepala Biro AUAK",
                "jabatan_singkatan" => "Karo",
                "jabatan_keterangan" => "Kepala Pegawai",
                "jabatan_untuk" => "pegawai",
                "jabatan_flag" => "karo",
            ],
            [
                'jabatan_nama' => "Dekan",
                "jabatan_singkatan" => "Dekan",
                "jabatan_keterangan" => "Pimpinan Fakultas",
                "jabatan_untuk" => "fakultas",
                "jabatan_flag" => "dekan",
            ],
            [
                'jabatan_nama' => "Wakil Dekan 1",
                'jabatan_singkatan' => "Wadek 1",
                "jabatan_keterangan" => "Wakil Pimpinan Fakultas 1",
                "jabatan_untuk" => "fakultas",
                "jabatan_flag" => "wadek1",
            ],
            [
                'jabatan_nama' => "Wakil Dekan 2",
                'jabatan_singkatan' => "Wadek 2",
                "jabatan_keterangan" => "Wakil Pimpinan Fakultas 2",
                "jabatan_untuk" => "fakultas",
                "jabatan_flag" => "wadek2",
            ],
            [
                'jabatan_nama' => "Wakil Dekan 3",
                'jabatan_singkatan' => "Wadek 3",
                "jabatan_keterangan" => "Wakil Pimpinan Fakultas 3",
                "jabatan_untuk" => "fakultas",
                "jabatan_flag" => "wadek3",
            ],
            [
                'jabatan_nama' => "Direktur",
                'jabatan_singkatan' => "Direktur",
                "jabatan_keterangan" => "Pimpinan Pascasarjana",
                "jabatan_untuk" => "fakultas",
                "jabatan_flag" => "direktur",
            ],
            [
                'jabatan_nama' => "Kepala Prodi",
                'jabatan_singkatan' => "Kaprodi",
                "jabatan_keterangan" => "Pimpinan Prodi",
                "jabatan_untuk" => "fakultas",
                "jabatan_flag" => "kaprodi",
            ],
            [
                'jabatan_nama' => "Bendahara Pengeluaran",
                'jabatan_singkatan' => "Bendahara Pengeluaran",
                "jabatan_keterangan" => "Bendaharan Pengeluaran 1 IAIN",
                "jabatan_untuk" => "rektorat",
                "jabatan_flag" => "bendahara_pengeluaran",
            ],
            [
                'jabatan_nama' => "PPK",
                'jabatan_singkatan' => "PPK",
                "jabatan_keterangan" => "PPK IAIN",
                "jabatan_untuk" => "rektorat dan fakultas",
                "jabatan_flag" => "ppk",
            ],
            [
                'jabatan_nama' => "Kepala SPI",
                'jabatan_singkatan' => "Ka. SPI",
                "jabatan_keterangan" => "Kepala SPI",
                "jabatan_untuk" => "spi",
                "jabatan_flag" => "ka_spi",
            ],
            [
                'jabatan_nama' => "Sekretatis SPI",
                'jabatan_singkatan' => "Sek. SPI",
                "jabatan_keterangan" => "Sekretaris SPI",
                "jabatan_untuk" => "spi",
                "jabatan_flag" => "sek_spi",
            ],
            [
                'jabatan_nama' => "Verifikator SPI",
                'jabatan_singkatan' => "Verifikator SPI",
                "jabatan_keterangan" => "Verifikator SPI",
                "jabatan_untuk" => "spi",
                "jabatan_flag" => "verifikator_spi",
            ],
            [
                'jabatan_nama' => "Bendahara Pemasukkan",
                'jabatan_singkatan' => "Bendahara Penerimaan",
                "jabatan_keterangan" => "Bendahara Pemasukkan IAIN",
                "jabatan_untuk" => "rektorat",
                "jabatan_flag" => "bendahara_pemasukkan",
            ],
        ]);
        DB::table('user_organisasis')->insert([
            ["user_role_id" => 9, "organisasi_id" => 33, "is_aktif" => true], //tipd
            ["user_role_id" => 11, "organisasi_id" => 40, "is_aktif" => true], //akma
        ]);
        DB::table('tahun_anggarans')->insert([
            ["satker_id" => 1, "tahun" => 2024, "sebutan" => "Tahun Anggaran 2024"]
        ]);

        DB::table('organisasi_rpds')->insert([
            ["tahun_anggaran_id" => 1, "organisasi_id" => 2],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 3],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 4],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 5],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 6],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 31],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 32],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 33],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 34],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 35],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 36],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 37],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 38],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 39],
            ["tahun_anggaran_id" => 1, "organisasi_id" => 40],
        ]);
        DB::table('pegawai_kategoris')->insert([
            ['pegawai_kategori_nama' => 'Pegawai Negeri Sipil', "singkatan" => "PNS", 'is_asn' => true, 'sebutan_nomor_pegawai' => 'NIP'],
            ['pegawai_kategori_nama' => 'Pegawai Pemerintah dengan Perjanjian Kerja', "singkatan" => "PPPK", 'is_asn' => true, 'sebutan_nomor_pegawai' => 'NI PPPK'],
            ['pegawai_kategori_nama' => 'Non-ASN', "singkatan" => "Non-ASN", 'is_asn' => false, 'sebutan_nomor_pegawai' => 'Nomor Pegawai'],
        ]);
        DB::table('pegawai_jenis')->insert([
            [
                'pegawai_jenis_nama' => 'Tenaga Kependidikan',
                "singkatan" => "Tendik",
                "alias" => "Pegawai",
                'is_dosen' => false,
                'if_asn' => true
            ],
            [
                'pegawai_jenis_nama' => 'Tenaga Pendidik',
                "singkatan" => "Dosen",
                "alias" => "Dosen",
                'is_dosen' => true,
                'if_asn' => true
            ],
            [
                'pegawai_jenis_nama' => 'Non-PNS',
                "singkatan" => "Non-PNS",
                "alias" => "Honorer",
                'is_dosen' => false,
                'if_asn' => false
            ],
        ]);
        DB::table('data_diris')->insert([
            [
                "nik" => 123,
                "nama_lengkap" => "nisful",
                "jenis_kelamin" => "P",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
            [
                "nik" => 324,
                "nama_lengkap" => "hasna",
                "jenis_kelamin" => "P",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
            [
                "nik" => 445,
                "nama_lengkap" => "musdin",
                "jenis_kelamin" => "L",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
            [
                "nik" => 678,
                "nama_lengkap" => "sukadir",
                "jenis_kelamin" => "L",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
            [
                "nik" => 736,
                "nama_lengkap" => "lili",
                "jenis_kelamin" => "P",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
            [
                "nik" => 987,
                "nama_lengkap" => "lita",
                "jenis_kelamin" => "P",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
            [
                "nik" => 967,
                "nama_lengkap" => "Arif",
                "jenis_kelamin" => "L",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
            [
                "nik" => 999,
                "nama_lengkap" => "rigo",
                "jenis_kelamin" => "L",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
            [
                "nik" => 876,
                "nama_lengkap" => "tommy",
                "jenis_kelamin" => "L",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
            [
                "nik" => 806,
                "nama_lengkap" => "YUNITA ANDRIANI",
                "jenis_kelamin" => "P",
                "lahir_tempat" => 'kendari',
                "lahir_tanggal" => '2023-02-20',
                "no_hp" => '0852',
                "alamat_ktp" => 'alamat ktp',
                "alamat_domisili" => 'alamat domisili'
            ],
        ]);
        DB::table('pegawais')->insert([
            [
                "idpeg" => 1,
                "pegawai_nomor_induk" => "198409132009012006 ",
                "data_diri_id" => 1,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 1
            ],
            [
                "idpeg" => 2,
                "pegawai_nomor_induk" => "197005062000122002  ",
                "data_diri_id" => 1,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 1
            ],
            [
                "idpeg" => 3,
                "pegawai_nomor_induk" => "196805101998031002",
                "data_diri_id" => 1,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 1
            ],
            [
                "idpeg" => 4,
                "pegawai_nomor_induk" => "197509282005011004",
                "data_diri_id" => 4,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 2
            ],
            [
                "idpeg" => 5,
                "pegawai_nomor_induk" => "198102282011012007",
                "data_diri_id" => 5,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 2
            ],
            [
                "idpeg" => 6,
                "pegawai_nomor_induk" => "199005062020122024",
                "data_diri_id" => 6,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 2
            ],
            [
                "idpeg" => 7,
                "pegawai_nomor_induk" => "197002022006041001",
                "data_diri_id" => 7,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 1
            ],
            [
                "idpeg" => 8,
                "pegawai_nomor_induk" => "199206282020121011",
                "data_diri_id" => 8,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 1
            ],
            [
                "idpeg" => 9,
                "pegawai_nomor_induk" => "198510212009011008 ",
                "data_diri_id" => 9,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 1
            ],
            [
                "idpeg" => 10,
                "pegawai_nomor_induk" => "198203052005012005  ",
                "data_diri_id" => 10,
                "pegawai_kategori_id" => 1,
                "pegawai_jenis_id" => 1
            ],
        ]);
        DB::table('organisasi_jabatan_sesis')->insert([
            [
                "tahun_anggaran_id" => 1,
                "organisasi_id" => 1,
                "organisasi_jabatan_id" => 12, //jabatan bendahara pengeluaran
                "jabatan_parent_sesi" => NULL,
                "pegawai_id" => 1, //bu uci
                "nama_pejabat" => "Nisful Hijah",
                "jabatan_sesi_nama" => "Bendahara Pengeluaran",
                "jabatan_sesi_singkatan" => "Bendahara Pengeluaran",
                "jabatan_keterangan" => '-',
                "jabatan_urutan" => 1,
                "is_aktif" => true,
            ],
            [
                "tahun_anggaran_id" => 1,
                "organisasi_id" => 1,
                "organisasi_jabatan_id" => 17, //jabatan bendahara pengeluaran
                "jabatan_parent_sesi" => NULL,
                "pegawai_id" => 1, //bu uci
                "nama_pejabat" => "YUNITA ANDRIANI",
                "jabatan_sesi_nama" => "Bendahara Pemasukkan",
                "jabatan_sesi_singkatan" => "Bendahara Pemasukkan",
                "jabatan_keterangan" => '-',
                "jabatan_urutan" => 1,
                "is_aktif" => true,
            ],
            [
                "tahun_anggaran_id" => 1,
                "organisasi_id" => 1,
                "pegawai_id" => 2, //bu hasna
                "organisasi_jabatan_id" => 13, //jabatan ppk
                "jabatan_parent_sesi" => NULL,
                "nama_pejabat" => "Hasna",
                "jabatan_sesi_nama" => "PPK",
                "jabatan_sesi_singkatan" => "PPK",
                "jabatan_keterangan" => 'PPK Rektorat',
                "jabatan_urutan" => 1,
                "is_aktif" => true,
            ],
            [
                "tahun_anggaran_id" => 1,
                "organisasi_id" => 2,
                "pegawai_id" => 3, //musdin
                "organisasi_jabatan_id" => 13, //jabatan ppk
                "jabatan_parent_sesi" => NULL,
                "nama_pejabat" => "Musdin",
                "jabatan_sesi_nama" => "PPK",
                "jabatan_sesi_singkatan" => "PPK",
                "jabatan_keterangan" => 'PPK Fatik',
                "jabatan_urutan" => 1,
                "is_aktif" => true,
            ],
            [
                "tahun_anggaran_id" => 1,
                "organisasi_id" => 37,
                "pegawai_id" => 4, //sukadir
                "organisasi_jabatan_id" => 14, //jabatan kepala spi
                "jabatan_parent_sesi" => NULL,
                "nama_pejabat" => "Sukadir Kete",
                "jabatan_sesi_nama" => "Kepala Satuan Pengawas Internal",
                "jabatan_sesi_singkatan" => "Ka. SPI",
                "jabatan_keterangan" => '-',
                "jabatan_urutan" => 1,
                "is_aktif" => true,
            ],
            [
                "tahun_anggaran_id" => 1,
                "organisasi_id" => 37,
                "pegawai_id" => 5, //lily
                "organisasi_jabatan_id" => 15, //jabatan sekretaris spi
                "jabatan_parent_sesi" => 5,
                "nama_pejabat" => "Lily Ulfia",
                "jabatan_sesi_nama" => "Sekretaris Satuan Pengawas Internal",
                "jabatan_sesi_singkatan" => "Sek. SPI",
                "jabatan_keterangan" => '-',
                "jabatan_urutan" => 1,
                "is_aktif" => true,
            ],
            [
                "tahun_anggaran_id" => 1,
                "organisasi_id" => 37,
                "pegawai_id" => 6, //lita
                "organisasi_jabatan_id" => 13, //jabatan verifkator spi
                "jabatan_parent_sesi" => 5,
                "nama_pejabat" => "Arlita",
                "jabatan_sesi_nama" => "Verifikator Satuan Pengawas Internal",
                "jabatan_sesi_singkatan" => "Verifikator SPI",
                "jabatan_keterangan" => '-',
                "jabatan_urutan" => 2,
                "is_aktif" => true,
            ],
            [
                "tahun_anggaran_id" => 1,
                "organisasi_id" => 37,
                "pegawai_id" => 7, //arif
                "organisasi_jabatan_id" => 13, //jabatan verifkator spi
                "jabatan_parent_sesi" => 5,
                "nama_pejabat" => "Arif",
                "jabatan_sesi_nama" => "Verifikator Satuan Pengawas Internal",
                "jabatan_sesi_singkatan" => "Verifikator SPI",
                "jabatan_keterangan" => '-',
                "jabatan_urutan" => 1,
                "is_aktif" => true,
            ],
        ]);
        DB::table('user_pegawais')->insert([
            ["user_id" => 2, "pegawai_id" => 1, "is_aktif" => true], //uci
            ["user_id" => 3, "pegawai_id" => 2, "is_aktif" => true], //hasnah
            ["user_id" => 4, "pegawai_id" => 3, "is_aktif" => true], //musdin
            ["user_id" => 5, "pegawai_id" => 4, "is_aktif" => true], //sukadir
            ["user_id" => 6, "pegawai_id" => 5, "is_aktif" => true], //lily
            ["user_id" => 7, "pegawai_id" => 6, "is_aktif" => true], //lita
            ["user_id" => 8, "pegawai_id" => 7, "is_aktif" => true], //arif
            ["user_id" => 9, "pegawai_id" => 8, "is_aktif" => true], //rigo
            ["user_id" => 10, "pegawai_id" => 9, "is_aktif" => true], //tommy
        ]);
    }
}
