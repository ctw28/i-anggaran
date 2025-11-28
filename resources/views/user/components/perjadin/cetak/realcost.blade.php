<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK RILL COST </title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 29.7cm landscape;
            /* A4 size */
            margin: 1cm 2cm 1cm 2cm;
            /* this affects the margin in the printer settings */
        }

        @media all {

            body,
            table {
                background-color: #FFFFFF;
                color: #000;
                font-size: 18px;
                font-family: arial;
            }

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

            .text-justify {
                text-align: justify;
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

<body>
    <div style="width:21.0cm;margin:0 auto; font-size:18px">
        <!--KOP-->
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%;" class="text-center">
            <tr>
                <td style="text-align: center; vertical-align: middle; width: 15%;">
                    <img src="https://simpeg.iainkendari.ac.id/./upload/logo/49sqk.png" style="width: 70px;" />
                </td>
                <td style="vertical-align: top; width: 70%;"><strong>
                        <span style="font-size:20px">KEMENTERIAN AGAMA REPUBLIK INDONESIA</span><br />
                        <span style="font-size:20px">INSTITUT AGAMA ISLAM NEGERI (IAIN) KENDARI</span></strong><br />
                </td>
                <td style="text-align: center; vertical-align: middle; width: 15%;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center; vertical-align: top;border-top:2px #000 solid;">&nbsp;</td>
            </tr>
        </table>
        <!--TITLE-->
        <h4 class="text-center">DAFTAR PENGELUARAN RIIL</h4>

        <!--TITLE END-->


        <p class="text-justify">
            Yang bertanda tangan dibawah ini :
        </p>
        <table style="padding-left: 20px;">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>Sakri, S.Si., M.Pd </td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td>197504172005011009</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Kasubag Layanan Akademik</td>
            </tr>
        </table>

        <p class="text-justify">
            berdasarkan Surat Perjalanan Dinas (SPD) Nomor : 395/In.23/PPK/KU.01.1/10/2025, tanggal 31 Oktober 2025 dengan ini kami menyatakan dengan sesungguhnya bahwa :
        </p>
        <ol style="padding-left: 20px;">
            <li>Biaya transport pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperoleh bukti-bukti pengeluarannya, meliputi :</li>
        </ol>

        <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="width:1cm" rowspan="2">No.</th>
                    <th style="width:9cm" rowspan="2">Uraian</th>
                    <th style="width:5cm" rowspan="2">Jumlah</th>
            </thead>
            <tbody>
                <tr style="vertical-align:top;">
                    <td style="height:200px; padding:5px" class="text-center">1</td>
                    <td style="height:200px; padding:5px">beli kamar</td>
                    <td style="height:200px; padding:5px">200.000</td>
                </tr>
                <tr>
                    <td style="padding:5px"></td>
                    <td style="padding:5px" class="text-center">Jumlah</td>
                    <td style="padding:5px">Rp.200.000</td>
                </tr>
                <tr>
                    <td style="padding:5px" colspan="3">Terbilang : Rupiah</td>
                </tr>
            </tbody>
        </table>
        <ol style="padding-left: 20px;" start="2">
            <li>Jumlah tersebut pada angka 1 diatas benar-benah dikeluarkan untuk pelaksanaan perjalanan dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut ke Kas Negara.

            </li>
        </ol>
        <p class="text-justify">
            Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.
        </p>

        <table border="0" cellpadding="2" cellspacing="2" style="width:100%;">
            <tbody>
                <tr>
                    <td style="width:9.5cm">
                        Mengetahui,<br>
                        Pejabat Pembuat Komitmen
                    </td>
                    <td style="width:9.5cm"></td>
                    <td style="width:10.7cm">
                        Kendari, {{ $data->tanggal_dokumen_indonesia ?? '-' }}<br />
                        Pelaksana SPD
                    </td>
                </tr>

                <tr>
                    <td colspan="3"><br><br><br><br></td>
                </tr>

                <tr>
                    <td><b>{{ $data->detail->ppk->nama_pejabat ?? '-' }}</b></td>
                    <td></td>
                    <td><b>{{ $data->detail->bendahara->nama_pejabat ?? '-' }}</b></td>
                </tr>

                <tr>
                    <td>NIP. {{ $data->detail->ppk->pegawai->pegawai_nomor_induk ?? '-' }}</td>
                    <td></td>
                    <td>NIP. {{ $data->detail->bendahara->pegawai->pegawai_nomor_induk ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>