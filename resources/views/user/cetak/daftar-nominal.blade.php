<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK AMPRA</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 29.7cm portrait;
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

            .page-break {
                display: none;
                display: block;
                page-break-after: always;
            }

            .border {
                border-top: none;
                border-bottom: none;
            }

            .text-center {
                text-align: center;
                margin: 0 auto;
            }

            .text-right {
                text-align: right;
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

    <div style="width:21cm;margin:0 auto; font-size:18px">

        <!--TITLE-->
        <h4 class="text-center" style="text-transform:uppercase">
            PEMBAYARAN <span id="pencairan-nama"></span>
        </h4>
        <br />
        <!--TITLE END-->

        <!--CONTENT-->
        <table border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr style="font-size:12px;">
                    <th style="width:0.5cm">NO.</th>
                    <th style="width:5.5cm">NAMA</th>
                    <th style="width:1cm">GOL</th>
                    <th style="width:1.5cm">JABATAN</th>
                    <th style="width:6cm">JUMLAH HONOR (Rp)</th>
                    <th style="width:1.7cm">PAJAK (Rp)</th>
                    <th style="width:2cm">JUMLAH YANG <br>DITERIMA(Rp)</th>
                    <th style="width:2cm">NOMOR <br> REKENING</th>
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
            <tbody id="nominal-data">
                <!-- <td class="border text-center"></td> -->

            </tbody>
            <tfooter>
                <tr>
                    <th colspan="4" class="text-center">JUMLAH</th>
                    <th class="text-center" id="total-kotor"></th>
                    <th class="text-center" id="total-pajak"></th>
                    <th class="text-right" id="total-diterima"></th>
                    <th></th>
                </tr>
            </tfooter>
        </table>

        <br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:1cm">&nbsp;</td>
                    <td style="width:7cm;vertical-align:bottom;">
                        Setuju Bayar,<br />
                        Pejabat Pembuat Komitmen
                    </td>
                    <td style="width:5cm">&nbsp;</td>
                    <td style="width:7cm">
                        Kendari, <span id="tanggal-dokumen"></span><br />
                        Lunas Bayar<br>
                        Tgl.<br>
                        Bendahara Pengeluaran
                    </td>
                    <td style="width:1cm">&nbsp;</td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b id="ppk"></b><br>
                        NIP. <span id="ppk-nip"></span>
                    </td>
                    <td></td>
                    <td>
                        <b id="bendahara"></b><br>
                        NIP. <span id="bendahara-nip"></span>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

<script>
    loadSesiData()
    async function loadSesiData() {
        let url = '{{route("cetak.nominal","$pencairan_id")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        })
        response = await sendRequest.json()
        console.log(response);
        document.querySelector('#pencairan-nama').innerText = response.data.pencairan_nama
        document.querySelector('#tanggal-dokumen').innerText = response.data.detail.tanggal_dokumen_indonesia
        document.querySelector('#ppk').innerText = response.data.detail.ppk.nama_pejabat
        document.querySelector('#ppk-nip').innerText = response.data.detail.ppk.pegawai.pegawai_nomor_induk
        document.querySelector('#bendahara').innerText = response.data.detail.bendahara.nama_pejabat
        document.querySelector('#bendahara-nip').innerText = response.data.detail.bendahara.pegawai.pegawai_nomor_induk

        document.querySelector('#total-kotor').innerText = formatRupiah(response.data.total)
        document.querySelector('#total-pajak').innerText = formatRupiah(response.data.pajak)
        document.querySelector('#total-diterima').innerText = formatRupiah(response.data.terima)




        let tbody = document.getElementById('nominal-data');
        let contents = ''
        response.data.daftar_nominal.map(data => {
            contents += `
            <tr>
            <td class="border text-center">${data.urutan}</td>
            <td class="border">${data.nama}</td>
            <td class="border text-center">${data.golongan}</td>
            <td class="border text-center">${data.jabatan}</td>
            <td class="border text-center">${formatRupiah(data.jumlah)} ${data.satuan} x ${formatRupiah(data.honor)} = ${formatRupiah(data.total)}</td>
            <td class="border text-center">${formatRupiah(data.pph)}</td>
            <td class="border text-center">${formatRupiah(data.diterima)}</td>
            <td class="border text-center"></td>
            </tr>
            `
        })
        tbody.innerHTML = ''
        tbody.innerHTML = contents
    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }
</script>

</html>