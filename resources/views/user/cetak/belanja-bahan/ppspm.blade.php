<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Cetak Lembar Permohonan Pemeriksaan Berkas Pencairan Anggaran</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 29.7cm portrait;
            /* A4 size */
            margin: 1cm 2cm 1cm 2cm;
            /* this affects the margin in the printer settings */
        }

        @media all {
            body {
                background-color: #FFFFFF;
                font-family: arial;
            }

            body,
            table {
                font-size: 18px;

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

<body>

    <div style="width:21cm;margin:0 auto;">

        <!-- KOP -->
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%;" class="text-center">
            <tr>
                <td style="text-align: center; vertical-align: middle; width: 15%;">
                    <img src="https://simpeg.iainkendari.ac.id/upload/logo/49sqk.png" style="width: 70px;" />
                </td>
                <td style="vertical-align: top; width: 70%;">
                    <strong>
                        <span style="font-size:18px;">KEMENTERIAN AGAMA REPUBLIK INDONESIA</span><br />
                        <span style="font-size:17px;">INSTITUT AGAMA ISLAM NEGERI (IAIN) KENDARI</span>
                    </strong><br />
                    <span style="font-size:12px;">
                        Jl. Sultan Qaimuddin No. 17, Telp (0401) 3192081 Fax (0401) 3193710<br />
                        Email: humas@iainkendari.ac.id, Website: iainkendari.ac.id
                    </span>
                </td>
                <td style="text-align: center; vertical-align: middle; width: 15%;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center; vertical-align: top;border-top:2px #000 solid;">&nbsp;</td>
            </tr>
        </table>
        <!-- KOP END -->

        <!-- TITLE -->
        <h3 class="text-center">
            LEMBAR PERMOHONAN PEMERIKSAAN BERKAS<br />PENCAIRAN ANGGARAN
        </h3>
        <br />

        <!-- BODY -->
        <p>
            Kepada Yth :<br>
            Pejabat Penanda Tangan Surat Perintah Membayar IAIN Kendari<br>
            Di -<br>
            Kendari
        </p><br>

        <p style="text-align:justify">Assalamu Alaikum Warahmatullahi Wabarakatuh</p>
        @php
        $dasar = '';

        if (!empty($data->detail->dasar['isSK'])) {
        $dasar .= "SK No. {$data->detail->nomor_sk} tanggal {$data->detail->tanggal_sk_indonesia}";
        }
        if (!empty($data->detail->dasar['isKuitansi'])) {
        if ($dasar !== '') $dasar .= ' dan ';
        $dasar .= "Kuitansi No. {$data->detail->kuitansi_nomor} tanggal {$data->detail->tanggal_dokumen_indonesia}";
        }
        @endphp
        <p>
            Dengan ini kami mengajukan permintaan pembayaran
            <b><i>{{ $data->pencairan_nama ?? '-' }}</i></b>
            sesuai {{ $dasar }}
            sebesar
            <b><i>Rp. {{ number_format($data->total ?? 0, 0, ',', '.') }}, –
                    ({{ $data->terbilang ?? '-' }} Rupiah).</i></b>
        </p>

        <p>
            Demikian, permohonan ini atas kerjasamanya diucapkan terima kasih.
        </p>

        <br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:7cm"></td>
                    <td style="width:7cm"></td>
                    <td style="width:7cm">
                        Kendari, {{ $data->tanggal_dokumen_indonesia ?? '-' }}<br />
                        Pejabat Pembuat Komitmen
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><br><br><br><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>{{ $data->detail->ppk->nama_pejabat ?? '-' }}</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>NIP. {{ $data->detail->ppk->pegawai->pegawai_nomor_induk ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

    </div>

</body>

</html>