<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Cetak Kwitansi</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 29.7cm portrait;
            /* A4 size */
            margin: 1cm 2cm 1cm 2cm;
            /* this affects the margin in the printer settings */
        }

        @media all {
            table {
                font-size: 18px;
            }

            body {
                background-color: #FFFFFF;
                font-family: arial;

            }

            .page-break {
                display: none;
                display: block;
                page-break-after: always;
            }

            .text-center {
                text-align: center;
                margin: 0 auto;
            }

            .text-up {
                vertical-align: top;
            }

            .trapezium {
                transform: skew(-20deg);
                border: 1px solid #000
            }
        }
    </style>
</head>
<!--
<body onload="window.print()" onfocus="window.close()">
-->

<body style="color:#000;font-size:18px;">

    <div style="width:21cm;margin:0 auto;">

        <!--KOP-->
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%;" class="text-center">
            <tr>
                <td style="text-align: center; vertical-align: middle; width: 15%;">
                    <img src="https://simpeg.iainkendari.ac.id/./upload/logo/49sqk.png" style="width: 70px;" />
                </td>
                <td style="vertical-align: top; width: 70%;"><strong>
                        <span style="font-size:20px">KEMENTERIAN AGAMA REPUBLIK INDONESIA</span><br />
                        <span style="font-size:20px">INSTITUT AGAMA ISLAM NEGERI (IAIN) KENDARI</span></strong><br />
                    <span style="font-size:12px">
                        Jl. Sultan Qaimuddin No. 17, Telp (0401) 3192081 Fax (0401) 3193710<br />
                        Email : humas@iainkendari.ac.id, Website : iainkendari.ac.id
                    </span>
                </td>
                <td style="text-align: center; vertical-align: middle; width: 15%;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center; vertical-align: top;border-top:2px #000 solid;">&nbsp;</td>
            </tr>
        </table>

        <h2 class="text-center">KUITANSI</h2><br /><br />

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:4.5cm">Sub Kegiatan</td>
                    <td style="width:0.5cm">:</td>
                    <td style="width:15cm">{{ $data->kegiatan->sub_kegiatan_kode1 }}.{{ $data->kegiatan->sub_kegiatan_kode2 }}.{{ $data->kegiatan->sub_kegiatan_kode3 }}.{{ $data->kegiatan->sub_kegiatan_kode4 }}.{{ $data->kegiatan->sub_kegiatan_kode5 }}</td>
                </tr>
                <tr>
                    <td>Akun</td>
                    <td>:</td>
                    <td>{{ $data->kodeAkun->kode ?? '-' }}</td>
                </tr>
                <tr>
                    <td>No. Bukti</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Telah Terima Dari</td>
                    <td>:</td>
                    <td>Kuasa Pengguna Anggaran IAIN Kendari</td>
                </tr>
                <tr>
                    <td>Uang Sejumlah</td>
                    <td>:</td>
                    <td style="border:1px solid #000">Rp {{ number_format($data->total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Untuk Pembayaran</td>
                    <td>:</td>
                    <td style="border:1px solid #000;">
                        Pembayaran {{ $data->pencairan_nama }}
                    </td>
                </tr>
                <tr>
                    <td>Terbilang</td>
                    <td>:</td>
                    <td class="trapezium">{{ $data->terbilang }} Rupiah,-</td>
                </tr>
            </tbody>
        </table>

        <br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:7cm">
                        Setuju Bayar,<br />
                        Pejabat Pembuat Komitmen
                    </td>
                    <td style="width:7cm">
                        Lunas Bayar,<br />
                        Bendahara Pengeluaran
                    </td>
                    <td style="width:7cm">
                        Kendari, {{ $data->detail->tanggal_dokumen_indonesia }}<br />
                        Yang Menerima
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{ $data->detail->ppk->nama_pejabat }}</td>
                    <td>{{ $data->detail->bendahara->nama_pejabat }}</td>
                    <td>{{ $data->detail->penerima_nama }}</td>
                </tr>
                <tr>
                    <td>NIP. {{ $data->detail->ppk->pegawai->pegawai_nomor_induk }}</td>
                    <td>NIP. {{ $data->detail->bendahara->pegawai->pegawai_nomor_induk }}</td>
                    <td>{{ $data->detail->penerima_nomor == '-' ? '' : $data->detail->penerima_nomor }}</td>
                </tr>
            </tbody>
        </table>

    </div>



</body>



</html>