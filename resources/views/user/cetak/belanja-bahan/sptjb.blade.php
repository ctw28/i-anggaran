<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK SURAT PERNYATAAN TANGGUNG JAWAB BELANJA </title>
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

        <!--TITLE-->
        <h2 class="text-center"><u>SURAT PERNYATAAN TANGGUNG JAWAB BELANJA</u></h2>
        <h3 class="text-center">NOMOR : <span id="sptjb-nomor"></span>
        </h3>

        <br />
        <!--TITLE END-->


        <table border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width:6.5cm">1. Kode Satuan Kerja</td>
                    <td style="width:0.5cm">:</td>
                    <td style="width:20.7cm">307665</td>
                </tr>
                <tr>
                    <td>2. Nama Satuan Kerja</td>
                    <td>:</td>
                    <td>Institut Agama Islam Negeri Kendari</td>
                </tr>
                <tr>
                    <td>3. Tanggal / No. DIPA</td>
                    <td>:</td>
                    <td>02 Desember 2024/ DIPA-025.04.2.307665/2025</td>
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
                <tr>
                    <th style="width:1cm" rowspan="2">No.</th>
                    <th style="width:1.5cm" rowspan="2">Akun</th>
                    <th style="width:4.5cm" rowspan="2">Penerima</th>
                    <th style="width:19.2cm" rowspan="2">Uraian</th>
                    <th style="width:3cm" rowspan="2">Jumlah</th>
                    <th style="width:6cm" colspan="2">Pajak yang dipungut</th>
                </tr>
                <tr>
                    <th style="width:3cm">PPN</th>
                    <th style="width:3cm">PPh</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td><span id="akun"></span></td>
                    <td><span id="penerima-nama"></span></td>
                    <td class="text-justify">
                        Pembayaran
                        <span id="pencairan-nama"></span> sesuai <span id="dasar"></span>.
                    </td>
                    <td class="text-center">
                        <span id="jumlah"></span>
                    </td>
                    <td class="text-center">
                        <span id="ppn"></span>

                    </td>
                    <td class="text-center">
                        <span id="pph"></span>
                    </td>
                </tr>
            </tbody>
            <tfooter>
                <tr>
                    <th colspan="4">Jumlah</th>
                    <th id="keseluruhan"></th>
                    <th id="ppn-total">-</th>
                    <th id="pph-total">-</th>
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
        let subkegiatan = `${response.data.kegiatan.sub_kegiatan_kode1}.${response.data.kegiatan.sub_kegiatan_kode2}.${response.data.kegiatan.sub_kegiatan_kode3}.${response.data.kegiatan.sub_kegiatan_kode4}.${response.data.kegiatan.sub_kegiatan_kode5}`
        document.querySelector('#pencairan-nama').innerText = response.data.pencairan_nama
        document.querySelector('#tanggal-dokumen').innerText = response.data.detail.tanggal_dokumen_indonesia
        document.querySelector('#ppk-nama').innerText = response.data.detail.ppk.nama_pejabat
        document.querySelector('#ppk-nip').innerText = response.data.detail.ppk.pegawai.pegawai_nomor_induk
        document.querySelector('#jumlah').innerText = formatRupiah(response.data.total)
        document.querySelector('#keseluruhan').innerText = formatRupiah(response.data.total)
        document.querySelector('#pph').innerText = formatRupiah(response.data.belanja_bahan.reduce((sum, item) => sum + (Number(item.pph) || 0), 0))
        document.querySelector('#pph-total').innerText = formatRupiah(response.data.belanja_bahan.reduce((sum, item) => sum + (Number(item.pph) || 0), 0))
        document.querySelector('#ppn').innerText = formatRupiah(response.data.belanja_bahan.reduce((sum, item) => sum + (Number(item.ppn) || 0), 0))
        document.querySelector('#ppn-total').innerText = formatRupiah(response.data.belanja_bahan.reduce((sum, item) => sum + (Number(item.ppn) || 0), 0))
        document.querySelector('#penerima-nama').innerText = response.data.detail.penerima_nama
        document.querySelector('#akun').innerText = response.data.kode_akun.kode
        document.querySelector('#klasifikasi-anggaran').innerText = `${subkegiatan}.${response.data.kode_akun.kode}`
        document.querySelector('#sptjb-nomor').innerText = response.data.detail.sptjb_nomor
        // Jika SK dicentang
        let contentDasar = "";
        const isSK = response.data.detail.dasar.isSK;
        const isKuitansi = response.data.detail.dasar.isKuitansi;
        const nomorSK = response.data.detail.nomor_sk;
        const tanggalSK = response.data.detail.tanggal_sk_indonesia;
        const nomorKuitansi = response.data.detail.kuitansi_nomor;
        const tanggalIndonesia = response.data.detail.tanggal_dokumen_indonesia;

        if (isSK) {
            contentDasar += `SK No. ${nomorSK} tanggal ${tanggalSK}`;
        }

        // Jika Kuitansi dicentang
        if (isKuitansi) {
            // Kalau sudah ada isi sebelumnya (ada SK), tambahkan " dan "
            if (contentDasar !== "") {
                contentDasar += " dan ";
            }

            contentDasar += `Kuitansi No. ${nomorKuitansi} tanggal ${tanggalIndonesia}`;
        }

        document.querySelector('#dasar').innerText = contentDasar;
        // console.log("Total PPN:", totalPPN);
        // console.log("Total PPH:", totalPPH);

    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }
</script>

</html>