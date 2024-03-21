<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SPISeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('periksa_kategoris')->insert([
            ["nama_kategori" => "Pelaksanaan Kegiatan", "keterangan" => ""],
            ["nama_kategori" => "Honorarium / Insentif Bulanan", "keterangan" => ""],
            ["nama_kategori" => "Uang Persediaan", "keterangan" => ""],
            ["nama_kategori" => "Ganti Uang Persediaan", "keterangan" => ""],
            ["nama_kategori" => "Perjalanan Dinas", "keterangan" => ""],
            ["nama_kategori" => "Lembur", "keterangan" => ""],
        ]);
        DB::table('periksa_lists')->insert([
            ["nama_list" => "Uraian Kegiatan", "keterangan" => ""], //1
            ["nama_list" => "Tor / Rab", "keterangan" => ""], //2
            ["nama_list" => "Jadwal Kegiatan", "keterangan" => ""], //3
            ["nama_list" => "SPTJM", "keterangan" => ""], //4
            ["nama_list" => "SK", "keterangan" => ""], //5
            ["nama_list" => "Ampra Honorarium", "keterangan" => ""], //6
            ["nama_list" => "Realisasi Anggaran*", "keterangan" => ""], //7
            ["nama_list" => "Absen Kegiatan*", "keterangan" => ""], //8
            ["nama_list" => "Bukti Pengeluaran*", "keterangan" => ""], //9
            ["nama_list" => "Dokumentasi Kegiatan*", "keterangan" => ""], //10
            ["nama_list" => "SPTJB**/SPP", "keterangan" => ""], //11
            ["nama_list" => "Riwayat Narasumber*/**", "keterangan" => ""], //12
            ["nama_list" => "Kuitansi*/**/Materai", "keterangan" => ""], //13
            ["nama_list" => "Sertifikat*/**", "keterangan" => ""], //14
            ["nama_list" => "Daftar Nominatif", "keterangan" => ""], //15
            ["nama_list" => "SPTK / Rekomendasi", "keterangan" => ""], //16
            ["nama_list" => "Faktur / Invoice", "keterangan" => ""], //17
            ["nama_list" => "SK", "keterangan" => ""], //18
            ["nama_list" => "Ampra", "keterangan" => ""], //19
            ["nama_list" => "Daftar Nominatif", "keterangan" => ""], //20
            ["nama_list" => "RAB", "keterangan" => ""], //21
            ["nama_list" => "Surat Pernyataan Penetapan Uang Persediaan", "keterangan" => ""], //22
            ["nama_list" => "SPTJB", "keterangan" => ""], //23
            ["nama_list" => "Bukti", "keterangan" => ""], //24
            ["nama_list" => "Surat Tugas", "keterangan" => ""], //25
            ["nama_list" => "SPPD", "keterangan" => ""], //26
            ["nama_list" => "Tiket Transportasi Udara/Air/Laut", "keterangan" => ""], //27
            ["nama_list" => "Boarding Pass", "keterangan" => ""], //28
            ["nama_list" => "Bukti Registasi Kegiatan**", "keterangan" => ""], //29
            ["nama_list" => "Akomodasi", "keterangan" => ""], //30
            ["nama_list" => "Airporttaxx**", "keterangan" => ""], //31
            ["nama_list" => "Retribusi**", "keterangan" => ""], //32
            ["nama_list" => "Laporan Perjadin", "keterangan" => ""], //33
            ["nama_list" => "Fotocopy Paspor***", "keterangan" => ""], //34
            ["nama_list" => "Foto/Dokumentasi***", "keterangan" => ""], //35
            ["nama_list" => "Surat Izin Setneg***", "keterangan" => ""], //36
            ["nama_list" => "SPTJB**", "keterangan" => ""], //37
            ["nama_list" => "SPTK / Rekomendasi", "keterangan" => ""], //38
            ["nama_list" => "Surat Permohonan Lembur", "keterangan" => ""], //39
            ["nama_list" => "Surat Perintah Kerja Lembur", "keterangan" => ""], //40
            ["nama_list" => "Output SPKL", "keterangan" => ""], //41
            ["nama_list" => "Daftar Hadir Lembur", "keterangan" => ""], //42
            ["nama_list" => "Rekapitulasi Perhitungan Pembayaran", "keterangan" => ""], //43
            ["nama_list" => "SPTJB*", "keterangan" => ""], //44
            ["nama_list" => "Kwitansi", "keterangan" => ""], //45
            ["nama_list" => "Foto Kegiatan Lembur", "keterangan" => ""], //46
        ]);
        DB::table('periksa_kategori_lists')->insert([
            //PELAKSANAAN KEGIATAN
            ["periksa_kategori_id" => 1, "periksa_list_id" => 1, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 2, "item" => "item1", "urutan" => 2],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 3, "item" => "item1", "urutan" => 3],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 4, "item" => "item1", "urutan" => 4],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 5, "item" => "item1", "urutan" => 5],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 6, "item" => "item1", "urutan" => 6],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 7, "item" => "item1", "urutan" => 7],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 8, "item" => "item1", "urutan" => 8],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 9, "item" => "item1", "urutan" => 9],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 10, "item" => "item1", "urutan" => 10],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 11, "item" => "item1", "urutan" => 11],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 12, "item" => "item1", "urutan" => 12],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 13, "item" => "item1", "urutan" => 13],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 14, "item" => "item1", "urutan" => 14],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 15, "item" => "item1", "urutan" => 15],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 16, "item" => "item1", "urutan" => 16],
            ["periksa_kategori_id" => 1, "periksa_list_id" => 17, "item" => "item1", "urutan" => 17],
            //HONORARIUM / INSETIF BULANAN
            ["periksa_kategori_id" => 2, "periksa_list_id" => 18, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 2, "periksa_list_id" => 19, "item" => "item1", "urutan" => 2],
            ["periksa_kategori_id" => 2, "periksa_list_id" => 20, "item" => "item1", "urutan" => 3],
            ["periksa_kategori_id" => 2, "periksa_list_id" => 11, "item" => "item1", "urutan" => 4],
            ["periksa_kategori_id" => 2, "periksa_list_id" => 13, "item" => "item1", "urutan" => 5],
            //UANG PERSEDIAAN
            ["periksa_kategori_id" => 3, "periksa_list_id" => 21, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 3, "periksa_list_id" => 4, "item" => "item1", "urutan" => 2],
            ["periksa_kategori_id" => 3, "periksa_list_id" => 22, "item" => "item1", "urutan" => 3],

            //GANTI UANG PERSEDIAAN
            ["periksa_kategori_id" => 4, "periksa_list_id" => 23, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 4, "periksa_list_id" => 4, "item" => "item1", "urutan" => 2],
            ["periksa_kategori_id" => 4, "periksa_list_id" => 24, "item" => "item1", "urutan" => 3],

            //PERJALANAN DINAS
            ["periksa_kategori_id" => 5, "periksa_list_id" => 4, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 25, "item" => "item1", "urutan" => 2],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 26, "item" => "item1", "urutan" => 3],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 27, "item" => "item1", "urutan" => 4],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 28, "item" => "item1", "urutan" => 5],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 29, "item" => "item1", "urutan" => 6],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 30, "item" => "item1", "urutan" => 7],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 31, "item" => "item1", "urutan" => 8],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 32, "item" => "item1", "urutan" => 9],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 33, "item" => "item1", "urutan" => 10],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 34, "item" => "item1", "urutan" => 11],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 35, "item" => "item1", "urutan" => 12],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 36, "item" => "item1", "urutan" => 13],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 37, "item" => "item1", "urutan" => 14],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 15, "item" => "item1", "urutan" => 15],
            ["periksa_kategori_id" => 5, "periksa_list_id" => 38, "item" => "item1", "urutan" => 16],

            //LEMBUR
            ["periksa_kategori_id" => 6, "periksa_list_id" => 39, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 6, "periksa_list_id" => 40, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 6, "periksa_list_id" => 41, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 6, "periksa_list_id" => 42, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 6, "periksa_list_id" => 43, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 6, "periksa_list_id" => 4, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 6, "periksa_list_id" => 44, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 6, "periksa_list_id" => 44, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 6, "periksa_list_id" => 25, "item" => "item1", "urutan" => 1],
            ["periksa_kategori_id" => 6, "periksa_list_id" => 26, "item" => "item1", "urutan" => 1],

        ]);

        DB::table('periksa_templates')->insert([
            ["nama_template" => "Template 1", "is_default" => 1],
        ]);
        DB::table('verifikators')->insert([
            ["pegawai_id" => 6, "sebutan_jabatan" => 'Analis Audit Kepatuhan & Keuangan', "is_aktif" => 1],
            ["pegawai_id" => 7, "sebutan_jabatan" => 'Analis Audit Kepatuhan & Keuangan', "is_aktif" => 1],
            ["pegawai_id" => 13, "sebutan_jabatan" => 'Analis Audit Kepatuhan & Keuangan', "is_aktif" => 1],
        ]);

        DB::table('periksa_daftars')->insert([
            //PELAKSANAAN KEGIATAN
            ["periksa_template_id" => 1, "periksa_kategori_id" => 1],
            //HONORARIUM / INSETIF BULANAN
            ["periksa_template_id" => 1, "periksa_kategori_id" => 2],
            //UANG PERSEDIAAN
            ["periksa_template_id" => 1, "periksa_kategori_id" => 3],
            //GANTI UANG PERSEDIAAN
            ["periksa_template_id" => 1, "periksa_kategori_id" => 4],
            //PERJALANAN DINAS
            ["periksa_template_id" => 1, "periksa_kategori_id" => 5],
            //LEMBUR
            ["periksa_template_id" => 1, "periksa_kategori_id" => 6],
        ]);
        DB::table('periksa_barjas_kategoris')->insert([
            ["nama_kategori" => 'Nama Dokumen', "keterangan" => ''],
            ["nama_kategori" => 'Dokumen Kontrak', "keterangan" => ''],
            ["nama_kategori" => 'Dokumen Rejakanan (Kelengkapannya)', "keterangan" => ''],
        ]);
        DB::table('periksa_barjas_lists')->insert([
            ["periksa_barjas_kategori_id" => 1, "nama_dokumen" => 'Ringkasan Kontrak', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 1, "nama_dokumen" => 'SPTJB', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 1, "nama_dokumen" => 'Berita Acara Pembayaran Sekaligus', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 1, "nama_dokumen" => 'Surat Pernyataan Untuk SPP-LS', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 1, "nama_dokumen" => 'Surat Pernyataan Tanggung Jawab Kegiatan', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 1, "nama_dokumen" => 'Faktur Pajak', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 1, "nama_dokumen" => 'SSP', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 1, "nama_dokumen" => 'Berita Acara Serah Terima Pekerjaan', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 1, "nama_dokumen" => 'Kwitansi Pembayaran Langsung', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Surat Pesanan / Perjanjian', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Surat Perintah Kerja', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Syarat Umum / syarat khusus', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Pengumuman', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Penetapan Pemenang', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Berita Acara Hasil Pengadaan Langsung', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Berita Acara Hasil Kualifikasi Negosiasi', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Berita Acara Hasil Evaluasi Dokumen Penawaran', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Berita Acara Pemasukan & Pembukaan Dokumen Penawaran', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Berita Acara Pemasukan & Pembukaan Dokumen Penawaran', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'RAB', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Jaminan Penawaran', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Evaluasi Harga Satuan Pekerjaan', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'HPS (Harga Perkiraan Sendiri)', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Pemeriksaan Arittmatik', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Dokumen Penawaran', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Dokumen Kualifikasi', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Fakta Integritas', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 2, "nama_dokumen" => 'Formulir Isian Kualifikasi', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'Surat Izin Usaha Perdagangan ', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'Surat Domisili Perusahaan', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'Tanda Daftar Persekutuan Komanditer', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'Surat Pengukuhan PKP', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'Surat Keterangan Terdaftar (Pada Kantor Pajak)', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'NPWP', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'KTP Pemilik Rekanan', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'Akta Notaris', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'Tanda Terima SPT Tahunan Terbaru', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'Pemberian Nomor Seri Faktur Pajak', "keterangan" => ''],
            ["periksa_barjas_kategori_id" => 3, "nama_dokumen" => 'Rekening Koran Terbaru', "keterangan" => ''],
        ]);
    }
}
