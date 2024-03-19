<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK REKAP</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            /* size: 21cm 29.7cm lanscape; */
            size: 29.7cm 21cm portrait;
            /* A4 size */
            margin: 1cm 2cm 1cm 2cm;
            /* this affects the margin in the printer settings */
        }

        @media all {
            .head-color {
                background-color: #0AB0D9
            }

            body,
            table {
                background-color: #FFFFFF;
                color: #000;
                font-size: medium;
                font-family: arial;
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

        @media print {
            .head-color {
                background-color: #0AB0D9
            }
        }

        .head-color {
            background-color: #0AB0D9
        }
    </style>
</head>
<!--
<body onload="window.print()" onfocus="window.close()">
-->

<body>

    <div style="width:21cm;margin:0 auto; font-size:18px">

        <!--TITLE-->
        <h3 class="text-center" style="text-transform: uppercase;">REKAP BELANJA BAHAN KEGIATAN <span id="kegiatan-nama"></span></h3>


        <br />
        <!--TITLE END-->

        <table border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr class="head-color">
                    <th style="width:1cm">No.</th>
                    <th style="width:10.7cm">Uraian</th>
                    <th style="width:3cm">Jumlah</th>
                    <th style="width:3cm">Pajak</th>
                    <th style="width:3cm">Jumlah yang<br> diterima</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody id="data">

            </tbody>
            <tfooter>
                <tr class="head-color">
                    <th colspan="2">Jumlah</th>
                    <th id="total-nilai">total
                    </th>
                    <th id="total-pajak">total</th>
                    <th id="total-terima"> total

                    </th>
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
        let url = '{{route("belanja.bahan.index",":id")}}'
        url = url.replace(":id", "{{$sesi_id}}")
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        })
        response = await sendRequest.json()
        console.log(response.data[0]);
        let subkegiatan = `${response.data[0].kegiatan.sub_kegiatan_kode1}.${response.data[0].kegiatan.sub_kegiatan_kode2}.${response.data[0].kegiatan.sub_kegiatan_kode3}.${response.data[0].kegiatan.sub_kegiatan_kode4}.${response.data[0].kegiatan.sub_kegiatan_kode5}`
        document.querySelector('#tanggal-dokumen').innerText = response.data[0].tanggal_dokumen_indonesia
        document.querySelector('#ppk-nama').innerText = response.data[0].ppk.nama_pejabat
        document.querySelector('#ppk-nip').innerText = response.data[0].ppk.pegawai.pegawai_nomor_induk
        document.querySelector('#bendahara-nama').innerText = response.data[0].bendahara.nama_pejabat
        document.querySelector('#bendahara-nip').innerText = response.data[0].bendahara.pegawai.pegawai_nomor_induk
        document.querySelector('#kegiatan-nama').innerText = response.data[0].kegiatan.kegiatan_nama
        let contents = ''
        let totalNilai = 0
        let totalPajak = 0
        let totalTerima = 0
        response.data[0].belanja_bahan.map((data, index) => {
            totalNilai = totalNilai + parseInt(data.nilai)
            totalPajak = totalPajak + (data.pph + data.ppn)
            totalTerima = totalTerima + (data.nilai - (data.pph + data.ppn))
            contents += `
            <tr>
                    <td class="text-center">${index+1}</td>
                    <td class="text-justify">
                        ${data.item} kegiatan ${response.data[0].kegiatan.kegiatan_nama} 
                        
                        sesuai Kuitansi No ${response.data[0].kuitansi_nomor} 
                        
                        tanggal ${response.data[0].tanggal_dokumen_indonesia}
                    </td>
                    <td class="text-center">
                    ${formatRupiah(data.nilai)}
                    </td>
                    <td class="text-center">
                        ${formatRupiah(data.pph + data.ppn)}
                    </td>
                    <td class="text-center">
                    ${formatRupiah(data.nilai - (data.pph + data.ppn))}
                    </td>
                </tr>
            `
        })

        document.querySelector('#total-nilai').innerText = formatRupiah(totalNilai)
        document.querySelector('#total-pajak').innerText = formatRupiah(totalPajak)
        document.querySelector('#total-terima').innerText = formatRupiah(totalTerima)

        document.querySelector('#data').innerHTML = ''
        document.querySelector('#data').innerHTML = contents

    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }
</script>

</html>