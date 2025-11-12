<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>KUITANSI <span id="judul"></span></title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 29.7cm portrait;
            /* A4 size */
            margin: 1cm;
            /* margin: 1cm 2cm 1cm 2cm; */
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

            .p0 {
                margin-block-start: 0;
                margin-block-end: 0;
            }
        }
    </style>
</head>
<!--
<body onload="window.print()" onfocus="window.close()">
-->

<body style="color:#000;font-size:18px;">
    <div style="width:21cm;margin:0 auto;">
        <div class="text-center" style="margin-bottom:10px">
            <img src="https://simpeg.iainkendari.ac.id/./upload/logo/49sqk.png" style="width: 100px;" />
        </div>

        <h3 class="text-center">
            KEMENTERIAN AGAMA REPUBLIK INDONESIA<br />
            INSTITUT AGAMA ISLAM NEGERI KENDARI
        </h3><br />

        <div style="border: 2px solid #000; padding: 20px">
            <h3 class="text-center">KUITANSI PEMBAYARAN LANGSUNG</h3>
            <br>

            <table border="0" cellpadding="0" cellspacing="0" style="padding-left:7cm;">
                <tbody>
                    <tr>
                        <td style="width:4.0cm">TA</td>
                        <td style="width:0.5cm">:</td>
                        <td style="width:5.0cm">2025</td>
                    </tr>
                    <tr>
                        <td>Nomor Bukti</td>
                        <td>:</td>
                        <td>{{ $data->detail->kuitansi_nomor ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Mata Anggaran</td>
                        <td>:</td>
                        <td>{{ $data->kodeAkun->kode ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>

            <br>
            <h3 class="text-center">KUITANSI / BUKTI PEMBAYARAN</h3>
            <br>

            <table border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="width:5.0cm">Sudah Terima Dari</td>
                        <td style="width:0.5cm">:</td>
                        <td style="width:15.5cm">Pejabat Pembuat Komitmen Satker IAIN Kendari</td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>

                    <tr>
                        <td>Jumlah Uang</td>
                        <td>:</td>
                        <td>Rp {{ number_format($data->total ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Terbilang</td>
                        <td>:</td>
                        <td>{{ $data->terbilang ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td><br></td>
                    </tr>

                    <tr>
                        <td>Untuk pembayaran</td>
                        <td>:</td>
                        <td>{{ $data->pencairan_nama ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>

            <br><br><br>

            <table border="0" cellpadding="2" cellspacing="2">
                <tbody>
                    <tr>
                        <td style="width:10.5cm">
                            a.n. Kuasa Pengguna Anggaran,<br>
                            Pejabat Pembuat Komitmen
                        </td>
                        <td style="width:5.5cm"></td>
                        <td style="width:10.7cm">
                            Kendari, {{ $data->detail->tanggal_dokumen_indonesia ?? '-' }}<br />
                            {{ $data->detail->penerima_jabatan ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td><br><br><br></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><b>{{ $data->detail->ppk->nama_pejabat ?? '-' }}</b></td>
                        <td></td>
                        <td><b>{{ $data->detail->penerima_nama ?? '-' }}</b></td>
                    </tr>
                    <tr>
                        <td>NIP. {{ $data->detail->ppk->pegawai->pegawai_nomor_induk ?? '-' }}</td>
                        <td></td>
                        <td>{{ $data->detail->penerima_nomor == '-' ? '' : $data->detail->penerima_nomor }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="border: 2px solid #000; padding: 20px; border-top:none">
            <p>Barang/Pekerjaan tersebut telah diterima/diselesaikan dengan lengkap dan baik</p>
            <p>Pejabat yang bertanggung jawab</p>
            <br><br>
            <p>
                <u>{{ $data->detail->sptjk_nama ?? '-' }}</u><br>
                NIP. {{ $data->detail->sptjk_nip ?? '-' }}
            </p>
        </div>
    </div>
</body>


</html>