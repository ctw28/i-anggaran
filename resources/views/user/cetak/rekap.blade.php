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

        <!--TITLE-->
        <h1 class="text-center"><u>REKAP</u></h1>


        <br />
        <!--TITLE END-->

        <table border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr>
                    <th style="width:1cm">No.</th>
                    <th style="width:19.7cm">Uraian</th>
                    <th style="width:3cm">Jumlah</th>
                    <th style="width:3cm">PPh Pasal 21</th>
                    <th style="width:3cm">Jumlah Rupiah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-justify" style="text-transform:uppercase">
                        Pembayaran
                        <span id="pencairan-nama"></span>
                    </td>
                    <td class="text-center">
                        <span id="jumlah"></span>
                    </td>
                    <td class="text-center">
                        <span id="pajak"></span>
                    </td>
                    <td class="text-center">
                        <span id="terima"></span>
                    </td>
                </tr>
            </tbody>
            <tfooter>
                <tr>
                    <th colspan="2">Jumlah</th>
                    <th id="total"></th>
                    <th id="total-pajak"></th>
                    <th id="total-terima"></th>
                </tr>
            </tfooter>
        </table>
        <br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:9.5cm">
                        Mengetahui,<br>
                        Pejabat Pembuat Komitmen
                    </td>
                    <td style="width:9.5cm">
                    </td>
                    <td style="width:10.7cm">
                        Kendari,
                        <span id="tanggal-dokumen"></span>,<br />
                        Bendahara Pengeluaran
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b><span id="ppk-nama"></span></b></td>
                    <td></td>
                    <td><b><span id="bendahara-nama"></span></b></td>
                </tr>
                <tr>
                    <td>NIP. <span id="ppk-nip"></span></td>
                    <td></td>
                    <td>NIP. <span id="bendahara-nip"></span></td>
                </tr>
            </tbody>
        </table>

    </div>
</body>
<script>
    loadSesiData()
    async function loadSesiData() {
        let jenis = "{{$jenis}}"
        let url = '{{route("cetak.nominal","$pencairan_id")}}'
        if (jenis == "belanja")
            url = '{{route("cetak.belanja","$pencairan_id")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        })
        response = await sendRequest.json()
        console.log(response);
        const pph = response.data.daftar_nominal.reduce((sum, item) => sum + (Number(item.pph) || 0), 0)
        // const ppn = response.data.daftar_nominal.reduce((sum, item) => sum + (Number(item.ppn) || 0), 0)
        const total = pph
        let subkegiatan = `${response.data.kegiatan.sub_kegiatan_kode1}.${response.data.kegiatan.sub_kegiatan_kode2}.${response.data.kegiatan.sub_kegiatan_kode3}.${response.data.kegiatan.sub_kegiatan_kode4}.${response.data.kegiatan.sub_kegiatan_kode5}`
        document.querySelector('#pencairan-nama').innerText = response.data.pencairan_nama
        document.querySelector('#tanggal-dokumen').innerText = response.data.detail.tanggal_dokumen_indonesia
        document.querySelector('#ppk-nama').innerText = response.data.detail.ppk.nama_pejabat
        document.querySelector('#ppk-nip').innerText = response.data.detail.ppk.pegawai.pegawai_nomor_induk
        document.querySelector('#bendahara-nama').innerText = response.data.detail.bendahara.nama_pejabat
        document.querySelector('#bendahara-nip').innerText = response.data.detail.bendahara.pegawai.pegawai_nomor_induk
        document.querySelector('#jumlah').innerText = formatRupiah(response.data.total)
        document.querySelector('#pajak').innerText = formatRupiah(total)
        document.querySelector('#terima').innerText = formatRupiah(response.data.terima)
        document.querySelector('#total').innerText = formatRupiah(response.data.total)
        document.querySelector('#total-pajak').innerText = formatRupiah(total)
        document.querySelector('#total-terima').innerText = formatRupiah(response.data.terima)


    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }
</script>

</html>