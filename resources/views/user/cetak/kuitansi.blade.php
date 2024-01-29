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
            body {
                background-color: #FFFFFF;
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

<body style="color:#000;font-size:12;">

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
        <h2 class="text-center">KWITANSI</h2><br />
        <br />
        <!--TITLE END-->


        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:3.5cm">Sub Kegiatan</td>
                    <td style="width:0.5cm">:</td>
                    <td style="width:16cm"><span id="sub_kegiatan"></span></td>
                </tr>
                <tr>
                    <td>Akun</td>
                    <td>:</td>
                    <td><span id="akun"></span></td>
                </tr>
                <tr>
                    <td>No. Bukti</td>
                    <td>:</td>
                    <td><span id="no-bukti"></span></td>
                </tr>
                <tr>
                    <td>Telah Terima Dari</td>
                    <td>:</td>
                    <td>Kuasa Pengguna Anggaran IAIN Kendari</td>
                </tr>
                <tr>
                    <td class="text-up">Uang Sejumlah</td>
                    <td>:</td>
                    <td style="border:1px solid #000">Rp
                        <span id="total-seluruhnya"></span>
                    </td>
                </tr>
                <tr>
                    <td class="text-up">Untuk Pembayaran</td>
                    <td>:</td>
                    <td style="border:1px solid #000; text-transform:uppercase">
                        Pembayaran
                        <span id="pencairan-nama"></span>
                    </td>
                </tr>
                <tr>
                    <td>Terbilang</td>
                    <td>:</td>
                    <td class="trapezium"><span id="terbilang"></span> Rupiah,-</td>
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
                        Kendari,
                        <span id="tanggal-dokumen"></span>,<br />
                        Yang Menerima
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b><span id="ppk-nama"></span></b></td>
                    <td><b><span id="bendahara-nama"></span></b></td>
                    <td><b><span id="penerima-nama"></span></b></td>
                </tr>
                <tr>
                    <td>NIP. <span id="ppk-nip"></span></td>
                    <td>NIP. <span id="bendahara-nip"></span></td>
                    <td><span id="penerima-nomor"></span></td>
                </tr>
            </tbody>
        </table>

    </div>
</body>
<script>
    loadSesiData()
    async function loadSesiData() {
        let url = '{{route("daftar.nominal.index",":id")}}'
        url = url.replace(":id", "{{$sesi_id}}")
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        })
        response = await sendRequest.json()
        console.log(response);
        let subkegiatan = `${response.data[0].kegiatan.sub_kegiatan_kode1}.${response.data[0].kegiatan.sub_kegiatan_kode2}.${response.data[0].kegiatan.sub_kegiatan_kode3}.${response.data[0].kegiatan.sub_kegiatan_kode4}.${response.data[0].kegiatan.sub_kegiatan_kode5}`
        document.querySelector('#sub_kegiatan').innerText = subkegiatan
        document.querySelector('#akun').innerText = response.data[0].kode_akun.kode
        document.querySelector('#pencairan-nama').innerText = response.data[0].pencairan_nama
        document.querySelector('#tanggal-dokumen').innerText = response.data[0].tanggal_dokumen_indonesia
        document.querySelector('#ppk-nama').innerText = response.data[0].ppk.nama_pejabat
        document.querySelector('#ppk-nip').innerText = response.data[0].ppk.pegawai.pegawai_nomor_induk
        document.querySelector('#bendahara-nama').innerText = response.data[0].bendahara.nama_pejabat
        document.querySelector('#bendahara-nip').innerText = response.data[0].bendahara.pegawai.pegawai_nomor_induk
        document.querySelector('#penerima-nama').innerText = response.data[0].penerima_nama
        document.querySelector('#penerima-nomor').innerText = response.data[0].penerima_nomor
        document.querySelector('#total-seluruhnya').innerText = formatRupiah(response.data[0].total)
        document.querySelector('#terbilang').innerText = response.data[0].terbilang

    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }
</script>

</html>