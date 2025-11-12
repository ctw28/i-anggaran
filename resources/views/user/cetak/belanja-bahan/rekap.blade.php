<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK REKAP</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 29.7cm lanscape;
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
    <div style="width:29.7cm;margin:0 auto; font-size:18px">
        <h1 class="text-center"><u>REKAP</u></h1>
        <br />

        <table border="1" cellpadding="2" cellspacing="0" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th style="width:1cm">No.</th>
                    <th style="width:19.7cm">Uraian</th>
                    <th style="width:3cm">Jumlah</th>
                    <th style="width:3cm">Pajak</th>
                    <th style="width:3cm">Jumlah Rupiah</th>
                </tr>
            </thead>
            <tbody>
                @php
                $pph = $data->belanjaBahan->sum(fn($item) => $item->pph ?? 0);
                $ppn = $data->belanjaBahan->sum(fn($item) => $item->ppn ?? 0);
                $total_pajak = $pph + $ppn;
                $terima = ($data->terima ?? 0) - $total_pajak;
                $dasar = '';

                if (!empty($data->detail->dasar['isSK'])) {
                $dasar .= "SK No. {$data->detail->nomor_sk} tanggal {$data->detail->tanggal_sk_indonesia}";
                }
                if (!empty($data->detail->dasar['isKuitansi'])) {
                if ($dasar !== '') $dasar .= ' dan ';
                $dasar .= "Kuitansi No. {$data->detail->kuitansi_nomor} tanggal {$data->detail->tanggal_dokumen_indonesia}";
                }
                @endphp
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-justify">
                        Pembayaran {{ $data->pencairan_nama ?? '-' }} sesuai {{ $dasar }}
                    </td>
                    <td class="text-center">
                        Rp {{ number_format($data->total ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="text-center">
                        Rp {{ number_format($total_pajak, 0, ',', '.') }}
                    </td>
                    <td class="text-center">
                        Rp {{ number_format($terima, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Jumlah</th>
                    <th>Rp {{ number_format($data->total ?? 0, 0, ',', '.') }}</th>
                    <th>Rp {{ number_format($total_pajak, 0, ',', '.') }}</th>
                    <th>Rp {{ number_format($terima, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

        <br>

        <table border="0" cellpadding="2" cellspacing="2" style="width:100%;">
            <tbody>
                <tr>
                    <td style="width:9.5cm">
                        Mengetahui,<br>
                        Pejabat Pembuat Komitmen
                    </td>
                    <td style="width:9.5cm"></td>
                    <td style="width:10.7cm">
                        Kendari, {{ $data->detail->tanggal_dokumen_indonesia ?? '-' }}<br />
                        Bendahara Pengeluaran
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
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