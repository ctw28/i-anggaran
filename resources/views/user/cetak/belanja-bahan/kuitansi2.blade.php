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


        <!--TITLE-->
        <!--TITLE END-->

        <div style="border: 2px solid #000; padding: 20px">
            <h3 class="text-center">KUITANSI PEMBAYARAN LANGSUNG</h3>
            <br>


            <table border="0" cellpadding="0" cellspacing="0" style="padding-left:7cm;">
                <tbody>
                    <tr>
                        <td style="width:4.0cm">TA</td>
                        <td style="width:0.5cm">:</td>
                        <td style="width:5.0cm">2024</td>
                    </tr>
                    <tr>
                        <td>Nomor Bukti</td>
                        <td>:</td>
                        <td id="nomor-bukti"></td>
                    </tr>
                    <tr>
                        <td>Mata Anggaran</td>
                        <td>:</td>
                        <td id="kode-akun"></td>
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
                        <td style="width:15.5cm">Pejabat Pembuat Komitmen Satker IAIN kendari</td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr style="padding-top: 12px">
                        <td>Jumlah Uang</td>
                        <td>:</td>
                        <td id="total-seluruhnya"></td>
                    </tr>
                    <tr>
                        <td>Terbilang</td>
                        <td>:</td>
                        <td id="terbilang"></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr style="padding-top: 12px">
                        <td>Untuk pembayaran</td>
                        <td>:</td>
                        <td id="pencairan-nama"></td>
                    </tr>
                </tbody>
            </table>

            <br>
            <br>
            <br>

            <table border="0" cellpadding="2" cellspacing="2">
                <tbody>
                    <tr>
                        <td style="width:10.5cm">
                            a.n. Kuasa Pengguna Anggara,<br>
                            Pejabat Pembuat Komitmen
                        </td>
                        <td style="width:5.5cm">
                        </td>
                        <td style="width:10.7cm">
                            Kendari,
                            <span id="tanggal-dokumen">30 November 2024</span>,<br />
                            <span id="penerima-jabatan">Sekertarisa</span>
                        </td>
                    </tr>
                    <tr>
                        <td><br><br><br></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b><span id="ppk-nama">Hasnah</span></b></td>
                        <td></td>
                        <td><b><span id="penerima-nama">Ibrahim</span></b></td>
                    </tr>
                    <tr>
                        <td>NIP. <span id="ppk-nip">1901901901</span></td>
                        <td></td>
                        <td><span id="penerima-nip">-</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="border: 2px solid #000; padding: 20px; border-top:none">

            <p>Barang/Pekerjaan tersebut telah diterima/diselesaikan dengan lengkap dan baik</p>
            <p>Pejabat yang bertanggung Jawab</p>
            <br>
            <br>
            <p><u><span id="sptjk-nama">Sakri, S.Si</span></u>
                <br>
                NIP. <span id="sptjk-nip">19999999</span>
            </p>
        </div>
    </div>
</body>
<script>
    loadSesiData()
    async function loadSesiData() {
        let url = '{{route("belanja.bahan.index",":id")}}'
        url = url.replace(":id", "{{$sesi_id}}")
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        })
        response = await sendRequest.json()
        console.log(response);
        let subkegiatan = `${response.data[0].kegiatan.sub_kegiatan_kode1}.${response.data[0].kegiatan.sub_kegiatan_kode2}.${response.data[0].kegiatan.sub_kegiatan_kode3}.${response.data[0].kegiatan.sub_kegiatan_kode4}.${response.data[0].kegiatan.sub_kegiatan_kode5}`
        document.querySelector('#pencairan-nama').innerText = response.data[0].pencairan_nama
        document.querySelector('#tanggal-dokumen').innerText = response.data[0].tanggal_dokumen_indonesia
        document.querySelector('#ppk-nama').innerText = response.data[0].ppk.nama_pejabat
        document.querySelector('#ppk-nip').innerText = response.data[0].ppk.pegawai.pegawai_nomor_induk
        document.querySelector('#total-seluruhnya').innerText = `Rp. ${formatRupiah(response.data[0].total)}`
        document.querySelector('#terbilang').innerText = `${response.data[0].terbilang} Rupiah`
        document.querySelector('#kode-akun').innerText = response.data[0].kode_akun.kode
        document.querySelector('#nomor-bukti').innerText = response.data[0].pelaksanaan_dasar.nomor
        document.querySelector('#penerima-nama').innerText = response.data[0].penerima_nama
        document.querySelector('#penerima-jabatan').innerText = response.data[0].penerima_jabatan
        document.querySelector('#penerima-nip').innerText = response.data[0].penerima_jabatan
        document.querySelector('#sptjk-nama').innerText = response.data[0].sptjk_nama
        document.querySelector('#sptjk-nip').innerText = response.data[0].sptjk_nip
        // document.querySelector('#spjtk-jabatan').innerText = response.data[0].sptjk_jabatan
        document.querySelector('#penerima-nip').innerText = response.data[0].penerima_nomor

    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }
</script>

</html>