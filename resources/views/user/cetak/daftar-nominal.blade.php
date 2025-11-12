<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK AMPRA</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 29.7cm portrait;
            margin: 1cm 2cm 1cm 2cm;
        }

        body,
        table {
            background-color: #FFFFFF;
            color: #000;
            font-size: 18px;
            font-family: arial;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div style="width:21cm;margin:0 auto; font-size:18px">
        <h4 class="text-center" style="text-transform:uppercase">
            PEMBAYARAN {{ $data->pencairan_nama }}
        </h4>
        <br />

        <table border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr style="font-size:12px;">
                    <th style="width:0.5cm">NO.</th>
                    <th style="width:5.5cm">NAMA</th>
                    <th style="width:1cm">GOL</th>
                    <th style="width:1.5cm">JABATAN</th>
                    <th style="width:6cm">JUMLAH HONOR (Rp)</th>
                    <th style="width:1.7cm">PAJAK (Rp)</th>
                    <th style="width:2cm">JUMLAH YANG DITERIMA (Rp)</th>
                    <th style="width:2cm">NOMOR REKENING</th>
                </tr>
                <tr style="font-size:18px;" class="text-center">
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                </tr>
            </thead>

            <tbody>
                @foreach($data->daftarNominal as $row)
                <tr>
                    <td class="text-center">{{ $row->urutan }}</td>
                    <td>{{ $row->nama }}</td>
                    <td class="text-center">{{ $row->golongan }}</td>
                    <td class="text-center">{{ $row->jabatan }}</td>
                    <td class="text-center">
                        {{ number_format($row->jumlah,0,',','.') }} {{ $row->satuan }} x
                        {{ number_format($row->honor,0,',','.') }} =
                        {{ number_format($row->total,0,',','.') }}
                    </td>
                    <td class="text-center">{{ number_format($row->pph,0,',','.') }}</td>
                    <td class="text-center">{{ number_format($row->diterima,0,',','.') }}</td>
                    <td class="text-center"></td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="4" class="text-center">JUMLAH</th>
                    <th class="text-center">{{ number_format($data->total,0,',','.') }}</th>
                    <th class="text-center">{{ number_format($data->pajak,0,',','.') }}</th>
                    <th class="text-right">{{ number_format($data->terima,0,',','.') }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <br><br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:1cm"></td>
                    <td style="width:7cm;">
                        Setuju Bayar,<br />
                        Pejabat Pembuat Komitmen
                    </td>
                    <td style="width:5cm"></td>
                    <td style="width:7cm">
                        Kendari, {{ $data->detail->tanggal_dokumen_indonesia }}<br />
                        Lunas Bayar<br>
                        Tgl.<br>
                        Bendahara Pengeluaran
                    </td>
                    <td style="width:1cm"></td>
                </tr>

                <tr>
                    <td colspan="5" style="height:100px;"></td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <b>{{ $data->detail->ppk->nama_pejabat }}</b><br>
                        NIP. {{ $data->detail->ppk->pegawai->pegawai_nomor_induk }}
                    </td>
                    <td></td>
                    <td>
                        <b>{{ $data->detail->bendahara->nama_pejabat }}</b><br>
                        NIP. {{ $data->detail->bendahara->pegawai->pegawai_nomor_induk }}
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>



</body>

</html>