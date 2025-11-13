<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Checklist Perjadin</title>
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
        <table border="1" cellpadding="1" cellspacing="0" style="width:100%;" class="text-center">
            <tr>
                <td style="text-align: center; vertical-align: top;">
                    <img src="https://simpeg.iainkendari.ac.id/./upload/logo/49sqk.png" style="width: 50px; float:left" />
                    <div>
                        <span style="font-size:16px; font-weight:600">KEMENTERIAN AGAMA REPUBLIK INDONESIA</span><br />
                        <span style="font-size:16px; font-weight:600">INSTITUT AGAMA ISLAM NEGERI (IAIN) KENDARI</span></strong><br />

                    </div>
                    <div style=" margin-top:25px">
                        <span style="font-size:16px">FORMULIR <br>VERIFIKASI PERJALANAN DINAS</span>
                    </div>
                </td>
                <td style="text-align: left; vertical-align: middle; width: 40%;">
                    Nomor Surat Tugas :<br>
                    &nbsp;&nbsp;&nbsp;{{$data->perjadin->no_surat_tugas}}<br>
                    Tanggal, {{ \Carbon\Carbon::parse($data->perjadin->tanggal_dokumen)->translatedFormat('d F Y') }}
                </td>
            </tr>
        </table>
        <!--KOP END-->

        <div style="border: 2px solid #000; padding: 0; border-top:none">
            <table>
                <tr>
                    <td width="25px">1.</td>
                    <td>IDENTITAS</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td width="180px">NAMA</td>
                    <td width="10px">:</td>
                    <td>{{$data->nama}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{$data->nip}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>WILAYAH/SUBBAG</td>
                    <td>:</td>
                    <td>{{$data->jabatan}}</td>
                </tr>
            </table>
        </div>
        <div style="border: 2px solid #000; padding: 0; border-top:none">
            <table>
                <tr>
                    <td width="25px">2.</td>
                    <td>PERJALANAN DINAS</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td width="200px">KEGIATAN</td>
                    <td width="10px">:</td>
                    <td>{{$data->perjadin->pencairan->pencairan_nama}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>KOTA TUJUAN</td>
                    <td>:</td>
                    <td>{{$data->perjadin->kota_tujuan}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>LAMA PELAKSANAAN</td>
                    <td>:</td>
                    <td>2 Hari</td>
                </tr>
            </table>
        </div>
        <div style="border: 2px solid #000; padding: 0; border-top:none">
            <table>
                <tr>
                    <td width="25px">3.</td>
                    <td>RINCIAN BAIAYA RILL PERJALANAN DINAS</td>
                    <td></td>
                </tr>
            </table>
            <div style="padding:0 35px;">
                <table border=" 1" cellspacing="0" cellpadding="2" style="width:100%;margin-bottom:5px">
                    <thead>
                        <th>JENIS PENGELUARAN</th>
                        <th>PENGELUARAN RIIL</th>
                        <th>KETERANGAN</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Uang Harian 1</td>
                            <td>
                                Rp. {{ number_format($data->rincian->uang_harian1 ?? 0, 0, ',', '.') }}
                                x {{ $data->rincian->uang_harian1_hari ?? 0 }} hari =

                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="position: relative;">Rp.
                                <span style="float:right;">
                                    {{ number_format($rincianTotal['uang_harian1_total'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Uang Harian 2</td>
                            <td>
                                Rp. {{ number_format($data->rincian->uang_harian2 ?? 0, 0, ',', '.') }}
                                x {{ $data->rincian->uang_harian2_hari ?? 0 }} hari =

                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="position: relative;">Rp.
                                <span style="float:right;">
                                    {{ number_format($rincianTotal['uang_harian2_total'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Uang Representatif</td>
                            <td>
                                Rp. {{ number_format($data->rincian->representatif ?? 0, 0, ',', '.') }}
                                x {{ $data->rincian->representatif_hari ?? 0 }} hari =
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="position: relative;">Rp.
                                <span style="float:right;">
                                    {{ number_format($rincianTotal['representatif_total'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Biaya Penginapan 1</td>
                            <td>
                                Rp. {{ number_format($data->rincian->penginapan1 ?? 0, 0, ',', '.') }}
                                x {{ $data->rincian->penginapan1_malam ?? 0 }} malam =

                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="position: relative;">Rp.
                                <span style="float:right;">
                                    {{ number_format($rincianTotal['penginapan1_total'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Biaya Penginapan 2</td>
                            <td>
                                Rp. {{ number_format($data->rincian->penginapan2 ?? 0, 0, ',', '.') }}
                                x {{ $data->rincian->penginapan2_malam ?? 0 }} malam =

                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="position: relative;">Rp.
                                <span style="float:right;">
                                    {{ number_format($rincianTotal['penginapan2_total'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tiket Pergi</td>
                            <td>
                                <span style="float:right;">
                                    Rp. {{ number_format($rincianTotal['tiket_pergi'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Tiket Pulang</td>
                            <td>
                                <span style="float:right;">
                                    Rp. {{ number_format($rincianTotal['tiket_pulang'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Transport Dalam Kota</td>
                            <td>
                                <span style="float:right;">
                                    Rp. {{ number_format($rincianTotal['transport_kota_2'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Kantor - B/S/T<sup>**</sup> (PP)</td>
                            <td>
                                <span style="float:right;">
                                    Rp. {{ number_format($rincianTotal['kantor_bst'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>B/S/T<sup>**</sup> - Lokasi (PP)</td>
                            <td>
                                <span style="float:right;">
                                    Rp. {{ number_format($rincianTotal['transport2'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Airport Tax Pergi</td>
                            <td>
                                <span style="float:right;">
                                    Rp. {{ number_format($rincianTotal['airport_tax_pergi'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Airport Tax Pulang</td>
                            <td>
                                <span style="float:right;">
                                    Rp. {{ number_format($rincianTotal['airport_tax_pulang'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td style="text-align:center;"><strong>JUMLAH</strong></td>
                            <td>
                                <span style="float:right;">
                                    <strong>Rp. {{ number_format($rincianTotal['total'], 0, ',', '.') }}</strong>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
        <div style="border: 2px solid #000; padding: 0; border-top:none">
            <table>
                <tr>
                    <td width="25px">4.</td>
                    <td width="500px">BUKTI PERJALANAN DINAS<sup>*</sup></td>
                    <td></td>
                </tr>
            </table>
            <div style="padding:0 25px;">

                <table>
                    <tr>
                        <td></td>
                        <td width="200px">a. Surat Tugas</td>
                        <td width="30px" style="border: 1px solid #888"></td>
                        <td width="150px">Ada</td>
                        <td width="200px">e. Airport Tax Pergi</td>
                        <td width="30px" style="border: 1px solid #888"></td>
                        <td>Ada</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="200px">b. SPPD</td>
                        <td width="30px" style="border: 1px solid #888"></td>
                        <td width="150px">Ada</td>
                        <td width="200px">e. Airport Tax Pulang</td>
                        <td width="30px" style="border: 1px solid #888"></td>
                        <td>Ada</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="200px">c. Undangan</td>
                        <td width="30px" style="border: 1px solid #888"></td>
                        <td width="150px">Ada</td>
                        <td width="200px">g. Tiket Pergi</td>
                        <td width="30px" style="border: 1px solid #888"></td>
                        <td>Ada</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="200px">d. Invoice Hotel</td>
                        <td width="30px" style="border: 1px solid #888"></td>
                        <td width="150px">Ada</td>
                        <td width="200px">h. Tiket Pulang</td>
                        <td width="30px" style="border: 1px solid #888"></td>
                        <td>Ada</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="200px"></td>
                        <td width="30px"></td>
                        <td width="150px"></td>
                        <td width="200px">i. Kuitansi kota 2</td>
                        <td width="30px" style="border: 1px solid #888"></td>
                        <td>Ada</td>
                    </tr>

                </table>
            </div>
        </div>

        <div style="border: 2px solid #000; padding: 0; border-top:none">
            <table>
                <tr>
                    <td width="25px">5.</td>
                    <td width="500px">KETERANGAN</td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div style="border: 2px solid #000; padding: 0; border-top:none">

            <table border="1" cellpadding="2" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="width:8cm;">
                            <div style="text-align:center">Saya menyatakan bahwa<br />
                                form ini diisi dengan sebenarnya</div>
                            <br>
                            <span style="text-align:left">Tanggal,</span>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div style="text-align:center">{{$data->nama}}<br>
                                {{$data->nip}}
                            </div>

                        </td>
                        <td style="width:7cm;">
                            <div style="text-align: center;">
                                Pejabat Pembuat Komitmen<br />
                                Kendari, {{$data->perjadin->pencairan->tanggal_dokumen}}
                                <br>
                                <br>
                                <br>
                                Hasnah
                                NIP. 120912981928971827917
                            </div>
                            <hr>
                            Verifikasi : <br>
                            Tanggal,
                            <br>
                            <br>
                            <div style="text-align: center;">
                                _____________________
                            </div>

                        </td>
                        <td style="width:7cm; vertical-align:top">
                            Catatan :
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-left : 30px; margin-top:5px">
            Catatan <br>
            <sup>*</sup> Diisi oleh Petugas<br>
            <sup>**</sup> B/S/T Bandara/Stasiun/Terminal
        </div>
    </div>
</body>

</html>