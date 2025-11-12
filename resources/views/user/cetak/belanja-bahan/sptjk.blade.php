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
                font-size: 19px;

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

<body style="color:#000;font-size:19px;">

    <div style="width:21cm;margin:0 auto;">

        <!--KOP-->
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%;" class="text-center">
            <tr>
                <td style="text-align: center; vertical-align: middle; width: 15%;">
                    <img src="https://simpeg.iainkendari.ac.id/./upload/logo/49sqk.png" style="width: 70px;" />
                </td>
                <td style="vertical-align: top; width: 70%;"><strong>
                        <span style="font-size:18">KEMENTERIAN AGAMA REPUBLIK INDONESIA</span><br />
                        <span style="font-size:17">INSTITUT AGAMA ISLAM NEGERI (IAIN) KENDARI</span></strong><br />
                    <span style="font-size:12">
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
        <!--KOP END-->

        <!--TITLE-->
        <h3 class="text-center">LEMBAR PERNYATAAN TANGGUNG JAWAB KEGIATAN</h3>
        <br />
        <!--TITLE END-->

        <p>Yang bertanda tangan di bawah ini :</p>
        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:6cm">Nama</td>
                    <td style="width:0.5cm">:</td>
                    <td style="width:14.5cm"><b>{{ $data->detail->sptjk_nama ?? '-' }}</b></td>
                </tr>
                <tr>
                    <td style="width:5cm">Jabatan dalam kegiatan</td>
                    <td style="width:0.5cm">:</td>
                    <td style="width:10.7cm">{{ $data->detail->sptjk_jabatan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <p>Dengan ini menyatakan :</p>
        <ol style="text-align:justify">
            <li>
                Bertanggungjawab sepenuhnya atas pelaksanaan dan pengeluaran semua dana/anggaran yang dipergunakan
                dalam <b>{{ $data->pencairan_nama ?? '-' }}</b>
                sesuai
                @php
                $dasar = [];
                if (!empty($data->detail->dasar->isSK)) {
                $dasar[] = 'SK No. ' . ($data->detail->nomor_sk ?? '-') . ' tanggal ' . ($data->detail->tanggal_sk_indonesia ?? '-');
                }
                if (!empty($data->detail->dasar->isKuitansi)) {
                $dasar[] = 'Kuitansi No. ' . ($data->detail->kuitansi_nomor ?? '-') . ' tanggal ' . ($data->detail->tanggal_dokumen_indonesia ?? '-');
                }
                @endphp
                <i>{{ implode(' dan ', $dasar) }}</i>
                sebesar <b>{{ number_format($data->total ?? 0, 0, ',', '.') }}</b>
                (<i>{{ $data->terbilang ?? '-' }} Rupiah</i>)
            </li>
            <li>
                Apabila dikemudian hari terbukti dalam pelaksanaannya tidak benar dan menimbulkan kerugian negara,
                saya bersedia menyetorkan kerugian negara tersebut ke Kas Negara.
            </li>
        </ol>
        <p>
            Demikian pernyataan ini dibuat dengan sebenarnya, dalam keadaan sadar tidak dibawah tekanan dan mempunyai kekuatan hukum.
            <br><br><br>
            Wassalamu Alaikum Wr. Wb.
        </p>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:9.5cm"></td>
                    <td style="width:9.5cm"></td>
                    <td style="width:10.7cm">
                        Kendari, {{ $data->detail->tanggal_dokumen_indonesia ?? '-' }}<br />
                    </td>
                </tr>
                <tr>
                    <td>Mengetahui,<br>Pejabat Pembuat Komitmen</td>
                    <td></td>
                    <td>Yang Membuat Pernyataan</td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>{{ $data->detail->ppk->nama_pejabat ?? '-' }}</b></td>
                    <td></td>
                    <td><b>{{ $data->detail->sptjk_nama ?? '-' }}</b></td>
                </tr>
                <tr>
                    <td>NIP. {{ $data->detail->ppk->pegawai->pegawai_nomor_induk ?? '-' }}</td>
                    <td></td>
                    <td>NIP. {{ $data->detail->sptjk_nip ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>