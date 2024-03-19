<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK SURAT PERNYATAAN TANGGUNG JAWAB BELANJA </title>
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

    <!-- <div style="width:29.7cm;margin:0 auto;"> -->
    <div style="width:21cm;margin:0 auto; font-size: 18px">

        <!--TITLE-->
        <h2 class="text-center"><u>SURAT PERNYATAAN TANGGUNG JAWAB BELANJA</u></h2>
        <h3 class="text-center">NOMOR : <span id="sptjb-nomor"></span>
        </h3>

        <br />
        <!--TITLE END-->


        <table border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width:5.0cm">1. Kode Satuan Kerja</td>
                    <td style="width:0.5cm">:</td>
                    <td style="width:15.7cm">307665</td>
                </tr>
                <tr>
                    <td>2. Nama Satuan Kerja</td>
                    <td>:</td>
                    <td>Institut Agama Islam Negeri Kendari</td>
                </tr>
                <tr>
                    <td>3. Tanggal / No. DIPA</td>
                    <td>:</td>
                    <td id="dipa">dipa</td>
                </tr>
                <tr>
                    <td>4. Klasifikasi Anggaran</td>
                    <td>:</td>
                    <td><span id="klasifikasi-anggaran"></span></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom:2px solid #000">&nbsp;</td>
                </tr>
            </tbody>
        </table>

        <p class="text-justify">
            Yang bertanda tangan dibawah ini atas nama Kuasa Pengguna Anggaran Satuan Kerja IAIN Kendari menyatakan
            bahwa saya
            bertanggung jawab secara formal dan material dan kebenaran perhitungan pemungutan pajak atas segala
            pembayaran tagihan yang
            telah kami perintahkan dalam SPM ini dengan perincian sebagai berikut :
        </p>

        <table border="1" cellpadding="0" cellspacing="0">
            <thead>
                <tr style="background-color: #0AB0D9">
                    <th style=" width:1cm" rowspan="2">No.</th>
                    <th style="width:1.5cm" rowspan="2">Akun</th>
                    <th style="width:4.5cm" rowspan="2">Penerima</th>
                    <th style="width:19.2cm" rowspan="2">Uraian</th>
                    <th style="width:3cm" rowspan="2">Jumlah</th>
                    <th style="width:6cm" colspan="2">Pajak yang dipungut</th>
                </tr>
                <tr style="background-color: #0AB0D9">
                    <th style=" width:3cm">PPN</th>
                    <th style="width:3cm">PPh</th>
                </tr>
            </thead>
            <tbody id="data">

            </tbody>
            <tfooter>
                <tr style="background-color: #0AB0D9">
                    <th colspan="4">Jumlah</th>
                    <th id="total-nilai">-</th>
                    <th id="total-ppn">-</th>
                    <th id="total-pph">-</th>
                </tr>
            </tfooter>
        </table>

        <p class="text-justify">
            Bukti-bukti pengeluaran anggaran dan asli setoran pajak (SSP/BPN) Tersebut diatas disimpan oleh Pengguna
            Anggaran/Kuasa Pengguna Anggaran Untuk Kelengkapan administrasi dan pemeriksaan aparat pengawasan
            fungsional.
        </p>
        <p class="text-justify">
            Demikian Surat Pernyataan ini dibuat dengan sebenarnya.
        </p>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:9.5cm">
                    </td>
                    <td style="width:9.5cm">
                    </td>
                    <td style="width:10.7cm">
                        Kendari,
                        <span id="tanggal-dokumen"></span>,<br />
                        Pejabat Pembuat Komitmen
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b><span id="ppk-nama"></span></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>NIP. <span id="ppk-nip"></span></td>
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
        document.querySelector('#klasifikasi-anggaran').innerText = `${subkegiatan}.${response.data[0].kode_akun.kode}`
        document.querySelector('#sptjb-nomor').innerText = response.data[0].sptjb_nomor

        let contents = ''
        let totalNilai = 0
        let totalPPN = 0
        let totalPPH = 0
        response.data[0].belanja_bahan.map((data, index) => {
            totalNilai = totalNilai + parseInt(data.nilai)
            totalPPN = totalPPN + parseInt(data.ppn)
            totalPPH = totalPPH + parseInt(data.pph)
            contents += `
            <tr>
                    <td class="text-center">${index+1}</td>
                    <td class="text-center">${response.data[0].kode_akun.kode}</td>
                    <td class="text-center">${response.data[0].penerima_nama}</td>
                    <td class="text-justify">
                        ${data.item} kegiatan ${response.data[0].kegiatan.kegiatan_nama} sesuai Kuitansi No ${response.data[0].kuitansi_nomor} tanggal ${response.data[0].tanggal_dokumen_indonesia}
                    </td>
                    <td class="text-center">
                         ${formatRupiah(data.nilai)}
                    </td>
                    <td class="text-center">
                        ${formatRupiah(data.ppn)}
                    </td>
                    <td class="text-center">
                    ${formatRupiah(data.pph)}

                    </td>
                </tr>
            `
        })
        document.querySelector('#total-nilai').innerText = formatRupiah(totalNilai)
        document.querySelector('#total-ppn').innerText = formatRupiah(totalPPN)
        document.querySelector('#total-pph').innerText = formatRupiah(totalPPH)

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